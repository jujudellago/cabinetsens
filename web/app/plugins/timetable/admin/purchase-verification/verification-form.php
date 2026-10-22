<?php
if(isset($page_title))
{
?>
<div class="wrap ql-license-title-section first">
	<h2><?php echo esc_html($page_title); ?></h2>
</div>
<?php
}
?>
<div class="ql-license-message<?php echo (!empty($result["message"]) ? " updated" : (!empty($result["error"]) ? " error" : " ql-license-hide")); ?>"> 
	<p>
		<?php echo (!empty($result["message"]) ? $result["message"] : (!empty($result["error"]) ? $result["error"] : "")); ?>
	</p>
</div>
<?php
if(!empty($result["info"]))
{
?>
<div class="ql-license-message notice"> 
	<p>
		<?php echo $result["info"]; ?>
	</p>
</div>
<?php
}
?>
<form action="<?php echo esc_url($_SERVER['REQUEST_URI']); ?>" method="post" id="ql-license">
	<div>
		<table class="ql-license-table form-table">
			<tr valign="top">
				<th>
					<label for="ql-license-domain"><?php esc_html_e("Domain: ", "timetable"); ?></label>
				</th>
				<td>
					<input type="text" class="regular-text" name="ql_license_domain" id="ql-license-domain" value="<?php echo esc_attr($ql_license->license_data["domain"]);?>" autocomplete="off" readonly />
				</td>
			</tr>
			<tr valign="top"<?php echo (empty($ql_license->license_data["verification_date"]) ? ' class="ql-license-hide"' : ''); ?>>
				<th>
					<label for="ql-license-verification-date"><?php esc_html_e("Verification date: ", "timetable"); ?></label>
				</th>
				<td>
					<input type="text" class="regular-text ql-license-field-clearable" name="ql_license_verification_date" id="ql-license-verification-date" value="<?php echo (!empty($ql_license->license_data["verification_date"]) ? esc_attr(date_i18n(get_option("date_format") . " " . get_option("time_format"), strtotime($ql_license->license_data["verification_date"]))) : "");?>" autocomplete="off" readonly />
				</td>
			</tr>
			<tr valign="top"<?php echo (empty($ql_license->license_data["supported_until"]) ? ' class="ql-license-hide"' : ''); ?>>
				<th>
					<label for="ql-license-supported-until"><?php esc_html_e("Supported until: ", "timetable"); ?></label>
				</th>
				<td>
					<input type="hidden" name="ql_license_item_id" id="ql-license-item-id" value="<?php echo esc_attr($ql_license->license_data["item_id"]);?>" autocomplete="off" readonly />
					<input type="hidden" class="ql-license-field-clearable" name="ql_license_sold_at" id="ql-license-sold-at" value="<?php echo esc_attr($ql_license->license_data["sold_at"]);?>" autocomplete="off" readonly />
					<input type="text" class="regular-text ql-license-field-clearable<?php echo (!$ql_license->has_valid_support ? ' ql-support-expired' : ''); ?>" name="ql_license_supported_until" id="ql-license-supported-until" value="<?php echo (!empty($ql_license->license_data["supported_until"]) ? esc_attr(date_i18n(get_option("date_format") . " " . get_option("time_format"), strtotime($ql_license->license_data["supported_until"]))) : "");?>" autocomplete="off" readonly />
				</td>
				<td>
					<?php
					if(!$ql_license->has_valid_support)
					{
						echo sprintf(wp_kses(__("Your support has expired. <a href='%s' title='Renew support' target='_blank'>Renew support now</a>", 'timetable'), array("a" => array("href" => array(), "title" => array(), "target" => array()))), sprintf(esc_url("https://codecanyon.net/checkout/from_item/%d?support=renew_6month"), $ql_license->license_data["item_id"]));
					}
					else
					{
						echo sprintf(wp_kses(__("%s days of support remaining. <a href='%s' title='Extend support' target='_blank'>Extend now</a>", 'timetable'), array("a" => array("href" => array(), "title" => array(), "target" => array()))), $result["diff"]->format("%a"), sprintf(esc_url("https://codecanyon.net/checkout/from_item/%d?support=extend_6month"), $ql_license->license_data["item_id"]));
					}
					?>				
				</td>
			</tr>
			<tr valign="top">
				<th>
					<label for="ql-license-purchase-code"><?php esc_html_e("Purchase code: ", "timetable"); ?></label>
				</th>
				<td>
					<input type="text" class="regular-text ql-license-field-clearable" name="ql_license_purchase_code" id="ql-license-purchase-code" value="<?php echo esc_attr($ql_license->license_data["purchase_code"]);?>" autocomplete="off" <?php echo ($ql_license->license_verified ? " readonly" : ""); ?> />
				</td>
				<td>
					<span class="description long"><?php echo sprintf(__("You can find the purchase code in the <a title='License certificate' href='%s' class='thickbox'>License certificate</a>", 'timetable'), esc_url("https://support.quanticalabs.com/wp-content/themes/forum/images/purchase_code.png")); ?></span>
				</td>
			</tr>
			<tr valign="top" class="no-border">
				<td colspan="3">
					<a class="button button-primary<?php echo ($ql_license->license_verified ? ' button-disabled' : ''); ?>" name="ql_verify_license" id="ql-verify-license" href="#"><?php esc_html_e('Verify license', 'timetable'); ?></a>
					<a class="button button-remove<?php echo (!$ql_license->license_verified ? ' button-disabled' : ''); ?>" name="ql_remove_license" id="ql-remove-license" href="#"><?php esc_html_e('Remove license', 'timetable'); ?></a>
					<span class="ql-spinner spinner"></span>
					<a class="button button-secondary<?php echo (empty($ql_license->getRefreshToken()) || $ql_license->license_verified ? ' button-disabled' : ''); ?>" name="ql_reauthorize_api" id="ql-reauthorize-api" href="#"><?php esc_html_e('Re-authorize Envato API', 'timetable'); ?></a>					
				</td>
			</tr>
		</table>
	</div>
</form>