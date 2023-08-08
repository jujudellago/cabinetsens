<div class="wrap">
	<div id="icon-edit" class="icon32"></div>
	<h2>
		<?php	echo esc_html__( 'Duplicate Blog List', 'otw_bm' ); ?>
		<a class="add-new-h2" href="admin.php?page=otw-bm"><?php esc_html_e('Back', 'otw_bm');?></a>
	</h2>
	<form name="otw-bm-copy-list" method="post" action="" class="validate">
		<?php
			if( !empty($this->errors) ){
			
				if( isset( $this->errors['wpnonce'] ) ){
					$errorMsg = $this->errors['wpnonce'];
				}else{
					$errorMsg = esc_html__('Oops! Please check form for errors.', 'otw_bm');
				}
				echo '<div class="error"><p>'.$errorMsg.'</p></div>';
			}

		?>
		<input type="hidden" name="id" value="<?php echo esc_attr( $listID );?>" />
		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row"><label for="list_name" class="required"><?php esc_html_e('Source Blog List Name', 'otw_bm');?></label></th>
					<td><?php echo esc_html( $content['list_name'] );?>
						<div class="inline-error">
							<?php 
								( !empty($this->errors['source_list_name']) )? $errorMessage = $this->errors['source_list_name'] : $errorMessage = ''; 
								echo $errorMessage;
							?>
						</div>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><label for="list_name" class="required"><?php esc_html_e('New Blog List Name', 'otw_bm');?></label></th>
					<td>
						<input type="text" name="list_name" id="list_name" size="53" value="<?php echo esc_attr( $content['new_list_name'] )?>" />
						<p class="description"><?php esc_html_e( 'Note: The List Name is going to be used ONLY for the admin as a reference.', 'otw_bm');?></p>
						<div class="inline-error">
							<?php 
								( !empty($this->errors['list_name']) )? $errorMessage = $this->errors['list_name'] : $errorMessage = ''; 
								echo $errorMessage;
							?>
						</div>
					</td>
				</tr>
			</tbody>
		</table>
		<p class="submit">
			<?php wp_nonce_field( 'otw_bm_copy_list', '_otw_bm_wpnonce' );?>
			<input type="submit" value="<?php esc_html_e( 'Duplicate', 'otw_bm') ?>" name="submit-otw-bm-copy" class="button button-primary button-hero"/>
		</p>
	</form>
</div>
