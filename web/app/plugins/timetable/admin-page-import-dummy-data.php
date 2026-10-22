<div class="wrap timetable_settings_section first">
	<h2><?php esc_html_e("Timetable Dummy Content", "timetable"); ?></h2>
</div>
<div>
	<?php
	if(!file_exists(dirname( __FILE__ ) . '/vendor/freemius/start.php') || (!get_option("timetable_converted") || (isset($tbsfw_fs) && !(int)$tbsfw_fs->has_any_license())))
	{
		$ql_license = QL_License::getInstance("7010836");
	}
	if((!file_exists(dirname( __FILE__ ) . '/vendor/freemius/start.php') || (!get_option("timetable_converted") || (isset($tbsfw_fs) && !(int)$tbsfw_fs->has_any_license()))) && (empty($ql_license->license_data["supported_until"]) || empty($ql_license->license_data["domain"]) || $ql_license->license_data["domain"]!=$_SERVER["HTTP_HOST"]))
	{
	?>
		<p><?php echo sprintf(wp_kses(__("License not verified%s. Please verify your license <a href='%s' title='License Verification'>here</a> to enable dummy content import", 'timetable'), array("a" => array("href" => array(), "title" => array()))), (empty($ql_license->license_data["domain"]) || $ql_license->license_data["domain"]!=$_SERVER["HTTP_HOST"] ? esc_html__(" for the current domain", 'timetable') : ""), esc_url(admin_url("admin.php?page=" . $ql_license->license_page))); ?></p>
	<?php
	}
	else
	{
	?>
	<a class="button button-primary" name="timetable_import_dummy" id="import_dummy"><?php esc_html_e('Import dummy content', 'timetable'); ?></a>
	<span class="spinner" style="float: none; margin-top: 4px;"></span>
	<img id="dummy_content_tick" src="<?php echo esc_url(plugins_url('admin/images/tick.png', __FILE__));?>" />
	<div id="dummy_content_info"></div>
	<?php
	}
	?>
</div>