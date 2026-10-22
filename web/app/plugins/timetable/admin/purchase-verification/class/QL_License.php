<?php
class QL_License
{
	private static $instances = [];
	private $item_id = "";
	private $item_name = "";
	private $item_slug = "";
	public $license_page = "";
	private $referral_url = "";
	public $license_data = array();
	public $license_verified = false;
	public $has_valid_support = false;
	
	private function __construct($item_id, $item_name, $item_slug, $license_page, $referral_url)
	{
		$this->item_id = $item_id;
        $this->item_name = $item_name;
		$this->item_slug = $item_slug;
        $this->license_page = $license_page;
		$this->referral_url = $referral_url;
		add_action("admin_enqueue_scripts", [$this, "enqueueScripts"]);
		add_action("wp_ajax_ql_save_license", [$this, "saveLicense"]);
		add_action("wp_ajax_ql_remove_license", [$this, "removeLicense"]);
		add_action("admin_notices", [$this, "licenseNotice"]);
		add_action("after_plugin_row_" . $this->item_slug, [$this, "licenseInfo"], 10, 2);
		
		if(!wp_next_scheduled("ql_license_cron_" . (int)$this->item_id))
		{
			wp_schedule_event(time(), "daily", "ql_license_cron_" . (int)$this->item_id);
		}
		add_action("ql_license_cron_" . (int)$this->item_id, [$this, "verifyLicenseCron"]);
		/*if(isset($_GET["test"]) && $_GET["test"]==1)
		{
			$timestamp = wp_next_scheduled("ql_license_cron_" . (int)$this->item_id);
			echo date('Y/m/d H:i:s', $timestamp);
			//wp_unschedule_event($timestamp, "ql_license_cron_" . (int)$this->item_id);
			//$this->verifyLicenseCron();
		}*/
	}
	
	public static function getInstance($item_id = "", $item_name = "", $item_slug = "", $license_page = "", $referral_url = "")
	{
		if(!isset(self::$instances[$item_id]))
		{
			self::$instances[$item_id] = new self($item_id, $item_name, $item_slug, $license_page, $referral_url);
		}
		return self::$instances[$item_id];
    }
	
	public function enqueueScripts()
	{
		wp_enqueue_style("purchase-verification-style", (strpos(wp_normalize_path(__FILE__), wp_normalize_path(WP_PLUGIN_DIR))!== false ? plugins_url("../style/style.css", __FILE__) : get_template_directory_uri() . "/admin/purchase-verification/style/style.css"));
		wp_enqueue_script("jquery-purchaseVerification", (strpos(wp_normalize_path(__FILE__), wp_normalize_path(WP_PLUGIN_DIR))!== false ? plugins_url("../js/jquery.purchaseVerification.js", __FILE__) : get_template_directory_uri() . "/admin/purchase-verification/js/jquery.purchaseVerification.js"), array("jquery"), false, true);
		//wp_enqueue_script("purchase-verification-script", (strpos(wp_normalize_path(__FILE__), wp_normalize_path(WP_PLUGIN_DIR))!== false ? plugins_url("../js/purchase-verification.js", __FILE__) : get_template_directory_uri() . "/admin/purchase-verification/js/purchase-verification.js"), array("jquery"), false, true);
		add_thickbox();
		$refresh_token = false;
		$run_verification = false;
		if(!empty($_GET["refresh_token"]))
		{
			$refresh_token = $_GET["refresh_token"];
			if($refresh_token!=$this->getRefreshToken())
			{
				$run_verification = true;
			}
		}
		else
		{
			$refresh_token = $this->getRefreshToken();
		}
		$data = array(
			'verify_url' => esc_url("https://quanticalabs.com/purchase-verification/verify.php"),
			'verify_url_test' => esc_url("http://localhost/purchase-verification/verify.php"),
			'verify_return_url' => esc_url(admin_url("admin.php?page=" . $this->license_page)),
			'refresh_token' => esc_js($refresh_token),
			'run_verification' => $run_verification,
			'http_host' => $_SERVER['HTTP_HOST'],
			'license_verified_message' => esc_html__("License verified successfully.", 'timetable'),
			'license_not_verified_message' => esc_html__("License not verified. Please provide a valid purchase code and click the 'Verify License' button.", 'timetable'),
			'license_confirm_remove_message' => esc_html__("Please confirm! You are about to remove a license.", 'timetable'),
			'license_processing_message' => esc_html__("Processing...", 'timetable'),
			'purchase_code_error_message' => esc_html__("Please enter the purchase code.", 'timetable'),
			'item_id' => $this->item_id,
			'ql_purchase_verification_ajax_nonce' => wp_create_nonce('ql_purchase_verification_ajax_nonce')
		);
		$params = array(
			'l10n_print_after' => 'ql_config = ' . json_encode($data) . ';'
		);
		wp_localize_script('jquery-purchaseVerification', 'ql_config', $params);
	}
	
	public function initLicense()
	{
		if(!empty($_GET["refresh_token"]))
		{
			$this->saveRefreshToken($_GET["refresh_token"]);
		}
		$this->license_data = $this->getLicense();
		$result = array();
		if(!empty($this->license_data["supported_until"]) && !empty($this->license_data["domain"]) && $this->license_data["domain"]==$_SERVER["HTTP_HOST"])
		{
			$result["message"] = esc_html__("License verified successfully.", 'timetable');
			$this->license_verified = true;
			$now = date_create(date("D M d H:i:s O Y"));
			$support_until = date_create(date("D M d H:i:s O Y", strtotime($this->license_data["supported_until"])));
			if($now<=$support_until)
			{
				$this->has_valid_support = true;
				$result["diff"] = date_diff($now, $support_until);
			}
		}
		else
		{
			$result["error"] = sprintf(esc_html__("License not verified%s. Please provide a valid purchase code and click the 'Verify License' button.", 'timetable'), (empty($this->license_data["domain"]) || $this->license_data["domain"]!=$_SERVER["HTTP_HOST"] ? esc_html__(" for the current domain", 'timetable') : ""));
			if(empty($this->license_data["purchase_code"]))
			{
				$result["info"] = sprintf(wp_kses(__("If you don't have a purchase code for the <a href='%s' title='Purchase %s' target='_blank'>%s</a>, please purchase a license <a href='%s' title='Purchase %s' target='_blank'>here</a>", 'timetable'), array("a" => array("href" => array(), "title" => array(), "target" => array()))), esc_url($this->referral_url), esc_html($this->item_name), esc_html($this->item_name), esc_url($this->referral_url), esc_attr($this->item_name));
			}
		}
		return $result;
	}
	
	public function getLicense()
	{
		$license_data = array(
			"item_id" => $this->item_id,
			"purchase_code" => "",
			"sold_at" => "",
			"verification_date" => "",
			"domain" => $_SERVER["HTTP_HOST"],
			"supported_until" => ""
		);
		$this->license_data = $this->stripslashesDeep(array_merge($license_data, (array)get_option("ql_license_" . esc_html($this->item_id))));
		return $this->license_data;
	}
	
	public function saveLicense($license_data = array())
	{
		ob_start();
		$result = array();
		$result["isOk"] = true;
		if(empty($license_data) && (!wp_doing_ajax() || !current_user_can("manage_options") || !isset($_POST["ql_purchase_verification_ajax_nonce"]) || !wp_verify_nonce($_POST["ql_purchase_verification_ajax_nonce"], 'ql_purchase_verification_ajax_nonce')))
		{
			$result["isOk"] = false;
		}
		else
		{
			if(empty($license_data))
			{
				$license_data = array(
					"item_id" => $_POST["ql_license_item_id"],
					"purchase_code" => $_POST["ql_license_purchase_code"],
					"sold_at" => (!empty($_POST["ql_license_sold_at"]) ? date_i18n(get_option("date_format") . " " . get_option("time_format"), strtotime($_POST["ql_license_sold_at"])) : ""),
					"verification_date" => (!empty($_POST["ql_license_verification_date"]) ? date_i18n(get_option("date_format") . " " . get_option("time_format"), strtotime($_POST["ql_license_verification_date"])) : ""),
					"domain" => $_SERVER["HTTP_HOST"],
					"supported_until" => (!empty($_POST["ql_license_supported_until"]) ? date_i18n(get_option("date_format") . " " . get_option("time_format"), strtotime($_POST["ql_license_supported_until"])) : "")
				);
			}
			if((int)$this->item_id==(int)$license_data["item_id"])
			{
				$this->license_data = $license_data;
				update_option("ql_license_" . esc_html($this->item_id), $this->license_data);
				$result["licence"] = $this->license_data;
				$result["message"] = esc_html__("The purchase code has been saved.", 'timetable');
			}
			else
			{
				$result["error_message"] = esc_html__("This purchase code belongs to a different item.", 'timetable');
				$result["isOk"] = false;
			}
		}

		$system_message = ob_get_clean();
		$result["system_message"] = $system_message;
		echo @json_encode($result);
		if(wp_doing_ajax())
		{
			exit();
		}
	}
	
	public function removeLicense()
	{
		ob_start();
		$result = array();
		$result["isOk"] = true;
		if(wp_doing_ajax() && current_user_can("manage_options") && isset($_POST["ql_purchase_verification_ajax_nonce"]) && wp_verify_nonce($_POST["ql_purchase_verification_ajax_nonce"], 'ql_purchase_verification_ajax_nonce'))
		{
			$result["isOk"] = delete_option("ql_license_" . esc_html($this->item_id));
			if($result["isOk"])
			{
				$result["message"] = esc_html__("License has been removed.", 'timetable');
			}
			else
			{
				$result["error_message"] = esc_html__("Failed to remove the license.", 'timetable');
			}
		}
		else
		{
			$result["isOk"] = false;
		}
		$system_message = ob_get_clean();
		$result["system_message"] = $system_message;
		echo @json_encode($result);
		exit();
	}
	
	public function verifyLicenseCron()
	{
		$license_data = $this->getLicense();
		if(!empty($license_data["supported_until"]) && !empty($license_data["item_id"]) && !empty($license_data["purchase_code"]) && !empty($license_data["domain"]) && $license_data["domain"]==$_SERVER["HTTP_HOST"])
		{
			$ch = curl_init(esc_url("https://quanticalabs.com/purchase-verification/verify.php"));
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:136.0) Gecko/20100101 Firefox/136.0");
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, "item_id=" . $license_data["item_id"] . "&purchase_code=" . $license_data["purchase_code"] . "&refresh_token=" . $this->getRefreshToken() . "&domain=" . $_SERVER["HTTP_HOST"]);
			$data = curl_exec($ch);
			curl_close($ch);
			$json = json_decode($data, true);
			if(isset($json["isOk"]) && isset($json["buyer_purchase"]))
			{
				unset($json["buyer_purchase"]["id"]);
				unset($json["buyer_purchase"]["is_removed"]);
				unset($json["buyer_purchase"]["isInDB"]);
				if(!(int)$json["isOk"])
				{
					unset($json["buyer_purchase"]["supported_until"]);
				}
				$this->saveLicense($json["buyer_purchase"]);
			}
		}
	}
	
	public function getRefreshToken()
	{
		return get_option("ql_license_refresh_token");
	}
	
	public function saveRefreshToken($refresh_token)
	{
		update_option("ql_license_refresh_token", $refresh_token);
	}
	
	public function licenseInfo()
	{
		$license_data = $this->getLicense();
		if(empty($license_data["supported_until"]) || empty($license_data["domain"]) || $license_data["domain"]!=$_SERVER["HTTP_HOST"])
		{
			?>
			<tr class="plugin-update-tr<?php echo (is_plugin_active($this->item_slug) ? ' active' : ''); ?>">
				<td colspan="3" class="plugin-update colspanchange" colspan="3">
					<div class="update-message notice inline notice-error notice-alt">
						<p><?php echo sprintf(wp_kses(__("License not verified%s. Please verify your license <a href='%s' title='License Verification'>here</a>", 'timetable'), array("a" => array("href" => array(), "title" => array()))), (empty($license_data["domain"]) || $license_data["domain"]!=$_SERVER["HTTP_HOST"] ? esc_html__(" for the current domain", 'timetable') : ""), esc_url(admin_url("admin.php?page=" . $this->license_page))); ?></p>
					</div>
				</td>
			</tr>
			<?php
		}
	}

	public function licenseNotice()
	{
		if(empty($_GET["page"]) || $_GET["page"]!=$this->license_page)
		{
			$license_data = $this->getLicense();
			if(empty($license_data["supported_until"]) || empty($license_data["domain"]) || $license_data["domain"]!=$_SERVER["HTTP_HOST"])
			{
				?>
				<div class="notice notice-error is-dismissible">
					<p><?php echo sprintf(wp_kses(__("%s license not verified%s. Please verify your license <a href='%s' title='License Verification'>here</a>", 'timetable'), array("a" => array("href" => array(), "title" => array()))), esc_html($this->item_name), (empty($license_data["domain"]) || $license_data["domain"]!=$_SERVER["HTTP_HOST"] ? esc_html__(" for the current domain", 'timetable') : ""), esc_url(admin_url("admin.php?page=" . $this->license_page))); ?></p>
				</div>
				<?php
			}
		}
	}
	
	private function stripslashesDeep($value)
	{
		$value = is_array($value) ?
					array_map('stripslashes_deep', $value) :
					stripslashes($value);
		
		return $value;
	}
}
?>