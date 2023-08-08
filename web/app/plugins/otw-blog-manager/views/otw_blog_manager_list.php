<?php
	$_wp_column_headers['toplevel_page_otw-bm'] = array(
		'list_name'			=> esc_html__( 'Blog List Name', 'otw_bm' ),
		'shortcode'			=> esc_html__( 'Short Code', 'otw_bm' ),
		'user_id'				=> esc_html__( 'Author', 'otw_bm' ),
		'date_created'	=> esc_html__( 'Created', 'otw_bm' ),
		'date_modified'	=> esc_html__( 'Modified', 'otw_bm' ),
	);
?>
<div class="wrap">
	<div id="icon-edit" class="icon32"></div>
	<h2>
		<?php esc_html_e('Blog Lists', 'otw_bm'); ?>
		<a class="add-new-h2" href="admin.php?page=otw-bm-add"><?php esc_html_e('Add List', 'otw_bm');?></a>
	</h2>

	<?php
		if( !empty( $action['success'] ) && $action['success'] == 'true' ) {
			$message = esc_html__('Item was saved.', 'otw_bm');
			echo '<div class="updated"><p>'.$message.'</p></div>';
		}

		if( !empty( $action['success_css'] ) && $action['success_css'] == 'true' ) {
			$message = esc_html__('Custom CSS file has been updated.', 'otw_bm');
			echo '<div class="updated"><p>'.$message.'</p></div>';
		}

			if( $writableError ) {
				$message = esc_html__('The folder \'wp-content/uploads/\' is not writable. Please make sure you add read/write permissions to this folder.', 'otw_bm');
				echo '<div class="error"><p>'.$message.'</p></div>';
			}

			if( $writableCssError ) {
				$message = esc_html__('The file \''.SKIN_BM_PATH.'\' is not writable. Please make sure you add read/write permissions to this file.', 'otw_bm');
				echo '<div class="error"><p>'.$message.'</p></div>';
			}
		if( !empty($this->errors) ){
			
				if( isset( $this->errors['wpnonce'] ) ){
					$errorMsg = $this->errors['wpnonce'];
					echo '<div class="error"><p>'.$errorMsg.'</p></div>';
				}
				
		}
	?>
	<?php 
		if( is_array( $otw_bm_lists ) || !empty( $otw_bm_lists['otw-bm-list'] ) ) :
		
		if( is_array( $otw_bm_lists ) && is_array(  $otw_bm_lists['otw-bm-list'] ) ){
			$arraySearch = array_keys( $otw_bm_lists['otw-bm-list'] );
		}else if( !isset( $arraySearch ) ){
			$arraySearch = array();
		}
		
		if( preg_grep('/^otw-bm-list-.*/', $arraySearch) ) {
	?>

	<table class="widefat fixed" cellspacing="0">
		<thead>
			<tr>
				<?php foreach( $_wp_column_headers['toplevel_page_otw-bm'] as $key => $name ){?>
					<th><?php echo esc_html( $name )?></th>
				<?php }?>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<?php foreach( $_wp_column_headers['toplevel_page_otw-bm'] as $key => $name ){?>
					<th><?php echo esc_html( $name )?></th>
				<?php }?>
			</tr>
		</tfoot>
		<tbody>
			<?php 
				$index = 0;
				foreach( $otw_bm_lists['otw-bm-list'] as $otw_bm_item ): 
					
					if( is_array($otw_bm_item) ) {

						$user_info = get_userdata( $otw_bm_item['user_id'] );

						//Used to add color to even rows
						$alternate = '';
						if( $index % 2 == 0 ) {
							$alternate = 'class="alternate"';	
						}

						$edit_link = admin_url( 'admin.php?page=otw-bm-add&amp;action=edit&amp;otw-bm-list-id='.$otw_bm_item['id'] );
						$delete_link = wp_nonce_url( admin_url( 'admin.php?page=otw-bm&amp;action=delete&amp;otw-bm-list-id='.$otw_bm_item['id'] ), 'otw_bm_delete_list', '_otw_bm_wpnonce' );
						$duplicate_link = admin_url( 'admin.php?page=otw-bm-copy&amp;otw-bm-list-id='.$otw_bm_item['id'] );
			?>
			<tr <?php echo $alternate;?> >
				<td>
					<?php echo '<a href="'.esc_attr( $edit_link ).'">' . $otw_bm_item['list_name'] . '</a>'; ?>
					<div class="row-actions">
					<?php
						echo '<a href="'.esc_attr( $edit_link ).'">' . esc_html__('Edit', 'otw_bm') . '</a>';
						echo ' | <a href="'.esc_attr( $delete_link ).'" data-name="'.esc_attr( $otw_bm_item['list_name'] ).'" class="js-delete-item">' . esc_html__('Delete', 'otw_bm'). '</a>';
						echo ' | <a href="'.esc_attr( $duplicate_link ).'" data-name="'.esc_attr( $otw_bm_item['list_name'] ).'" class="js-duplicate-item">' . esc_html__('Duplicate', 'otw_bm'). '</a>';
					?>
					</div>
				</td>
				<td><?php echo '[otw-bm-list id="'.esc_attr( $otw_bm_item['id'] ).'"]'; ?></td>
				<td><?php echo esc_html( $user_info->display_name );?></td>
				<td><?php echo esc_html( $otw_bm_item['date_created'] );?></td>
				<td><?php echo esc_html( $otw_bm_item['date_modified'] );?></td>
			</tr>
			<?php 
				$index++;
				} //End if Array item
				endforeach; 
			?>
		</tbody>
	</table>

	<?php }else{ ?>
		<?php 
			$add_link = $edit_link = admin_url( 'admin.php?page=otw-bm-add' );
		?>
		<p>
			<strong><?php esc_html_e('No custom blog list found.', 'otw_bm')?></strong>
			<?php echo '<a href="'.esc_attr( $add_link ).'">' . esc_html__('Add a list', 'otw_bm') . '</a>'; ?>
		</p>

	<?php } ?>
	<?php endif; ?>

</div>