<?php
	global $otw_bm_plugin_id;
	
	$otw_bm_plugin_options = get_option( 'otw_bm_plugin_options' );
	
	$otw_bm_plugin_options['otw_bm_promotions'] = get_option( $otw_bm_plugin_id.'_dnms' );
	
	$otw_bm_plugin_options['otw_bm_delete_data'] = get_option( 'otw_bm_delete_data' );
	
	if( empty( $otw_bm_plugin_options['otw_bm_promotions'] ) ){
		$otw_bm_plugin_options['otw_bm_promotions'] = 'on';
	}
	
	if( empty( $otw_bm_plugin_options['otw_bm_delete_data'] ) ){
		$otw_bm_plugin_options['otw_bm_delete_data'] = 'no';
	}
?>
<div class="wrap">
	<div id="icon-options-general" class="icon32"></div>
	<h2><?php esc_html_e('Blog List Settings', 'otw_bm'); ?></h2>
  <?php
    if( $writableCssError ) {
      $message = esc_html__('The file \''.SKIN_BM_PATH.'custom.css\' is not writable. Please make sure you add read/write permissions to this file.', 'otw_bm');
      echo '<div class="error"><p>'.$message.'</p></div>';
    }

	if( !empty($this->errors) ){
			
		if( isset( $this->errors['wpnonce'] ) ){
			$errorMsg = $this->errors['wpnonce'];
		}else{
			$errorMsg = esc_html__('Oops! Please check form for errors.', 'otw_bm');
		}
		echo '<div class="error"><p>'.$errorMsg.'</p></div>';
	}
  ?>
	<?php
		if( !empty( otw_get( 'success_css', '' ) ) && otw_get( 'success_css', '' ) == 'true' ) {
			$message = esc_html__('Plugin settings have been updated.', 'otw_bm');
			echo '<div class="updated"><p>'.$message.'</p></div>';
		}
	?>
	
	
	<form name="otw-bm-list-style" method="post" action="" class="validate">
		<div class="otw_bm_sp_settings">
			<table class="form-table">
				<tr>
					<th>
						<label for="otw_bm_promotions"><?php esc_html_e('Show OTW Promotion Messages in my WordPress admin', 'otw_bm'); ?></label>
						<select id="otw_bm_promotions" name="otw_bm_promotions">
							<option value="on" <?php echo ( isset( $otw_bm_plugin_options['otw_bm_promotions'] ) && ( $otw_bm_plugin_options['otw_bm_promotions'] == 'on' ) )? 'selected="selected"':''?>>on(default)</option>
							<option value="off"<?php echo ( isset( $otw_bm_plugin_options['otw_bm_promotions'] ) && ( $otw_bm_plugin_options['otw_bm_promotions'] == 'off' ) )? 'selected="selected"':''?>>off</option>
						</select>
					</th>
				</tr>
				<tr>
					<th>
						<label for="otw_bm_delete_data"><?php esc_html_e('Erase plugin data after uninstall of the plugin', 'otw_bm'); ?></label>
						<select id="otw_bm_delete_data" name="otw_bm_delete_data">
							<option value="no"<?php echo ( isset( $otw_bm_plugin_options['otw_bm_delete_data'] ) && ( $otw_bm_plugin_options['otw_bm_delete_data'] == 'no' ) )? 'selected="selected"':''?>>No(keep the data)</option>
							<option value="yes" <?php echo ( isset( $otw_bm_plugin_options['otw_bm_delete_data'] ) && ( $otw_bm_plugin_options['otw_bm_delete_data'] == 'yes' ) )? 'selected="selected"':''?>>Yes</option>
						</select>
					</th>
				</tr>
			</table>
		</div>
		<p class="description"><?php esc_html_e('Adjust your own CSS for all of your Blog Lists. Please use with caution.', 'otw_bm'); ?></p>
		<textarea name="otw_css" cols="100" rows="35"><?php echo esc_textarea( $customCss );?></textarea>
		<p class="submit">
			<?php wp_nonce_field( 'otw_bm_save_settings', '_otw_bm_wpnonce' );?>
			<input type="submit" value="<?php esc_html_e( 'Save', 'otw_bm') ?>" name="save_settings" class="button button-primary button-hero"/>
		</p>
	</form>

</div>