<?php
	$writableCssError = $this->check_writing( SKIN_BM_PATH );
	
	$selectOptionData = array(
		array( 'value' => 0, 'text'	=> '------' ),
		array( 'value' => '1-column', 'text' => esc_html__('Grid - Blog 1 Column', 'otw_bm') ),
		array( 'value' => '2-column', 'text' => esc_html__('Grid - Blog 2 Columns', 'otw_bm') ),
		array( 'value' => '3-column', 'text' => esc_html__('Grid - Blog 3 Columns', 'otw_bm') ),
		array( 'value' => '4-column', 'text' => esc_html__('Grid - Blog 4 Columns', 'otw_bm') ),
		array( 'value' => '1-column-lft-img', 'text' => esc_html__('Image Left - Blog 1 Column', 'otw_bm') ),
		array( 'value' => '2-column-lft-img', 'text' => esc_html__('Image Left - Blog 2 Columns', 'otw_bm') ),
		array( 'value' => '1-column-rght-img', 'text' => esc_html__('Image Right - Blog 1 Column', 'otw_bm') ),
		array( 'value' => '2-column-rght-img', 'text' => esc_html__('Image Right - Blog 2 Columns', 'otw_bm') ),
		array( 'value' => '2-column-news', 'text' => esc_html__('Newspaper - Blog 2 Columns', 'otw_bm') ),
		array( 'value' => '3-column-news', 'text' => esc_html__('Newspaper - Blog 3 Columns', 'otw_bm') ),
		array( 'value' => '4-column-news', 'text' => esc_html__('Newspaper - Blog 4 Columns', 'otw_bm') ),
		array( 'value' => 'widget-lft', 'text' => esc_html__('Widget Style - Image Left', 'otw_bm') ),
		array( 'value' => 'widget-rght', 'text' => esc_html__('Widget Style - Image Right', 'otw_bm') ),
		array( 'value' => 'widget-top', 'text' => esc_html__('Widget Style - Image Top', 'otw_bm') ),
		array( 'value' => 'timeline', 'text' => esc_html__('Timeline', 'otw_bm') ),
		array( 'value' => 'slider', 'text' => esc_html__('Slider', 'otw_bm') ),
		array( 'value' => '3-column-carousel', 'text' => esc_html__('Carousel - 3 Columns', 'otw_bm') ),
		array( 'value' => '4-column-carousel', 'text' => esc_html__('Carousel - 4 Columns', 'otw_bm') ),
		array( 'value' => '5-column-carousel', 'text' => esc_html__('Carousel - 5 Columns', 'otw_bm') ),
		array( 'value' => '2-column-carousel-wid', 'text' => esc_html__('Widget Carousel - 2 Columns', 'otw_bm') ),
		array( 'value' => '3-column-carousel-wid', 'text' => esc_html__('Widget Carousel - 3 Columns', 'otw_bm') ),
		array( 'value' => '4-column-carousel-wid', 'text' => esc_html__('Widget Carousel - 4 Columns', 'otw_bm') ),
	);

	$selectPaginationData = array(
		array( 'value' => '0', 'text' => esc_html__('None (default)', 'otw_bm') ),
		array( 'value' => 'pagination', 'text' => esc_html__('Standard Pagination', 'otw_bm') ),
		array( 'value' => 'load-more', 'text' => esc_html__('Load More Pagination', 'otw_bm') ),
		array( 'value' => 'infinit-scroll', 'text' => esc_html__('Infinit Scroll', 'otw_bm') ),
	);	

	$selectSocialData = array(
		array( 'value' => '0', 'text' => esc_html__('None (default)', 'otw_bm') ),
		array( 'value' => 'share_icons', 'text' => esc_html__('Share Icons', 'otw_bm') ),
		array( 'value' => 'share_btn_small', 'text' => esc_html__('Share Buttons Small', 'otw_bm') ),
		array( 'value' => 'share_btn_large', 'text' => esc_html__('Share Buttons Large', 'otw_bm') ),
		array( 'value' => 'like_buttons', 'text' => esc_html__('Like Buttons', 'otw_bm') ),
		array( 'value' => 'custom_icons', 'text' => esc_html__('Custom Social Icons', 'otw_bm') )
	);	

	$selectOrderData = array(
		array( 'value' => 'date_desc', 'text' => esc_html__('Latest Created (default)', 'otw_bm') ),
		array( 'value' => 'date_asc', 'text' => esc_html__('Oldest Created', 'otw_bm') ),
		array( 'value' => 'modified_desc', 'text' => esc_html__('Latest Modified', 'otw_bm') ),
		array( 'value' => 'modified_asc', 'text' => esc_html__('Oldest Modified', 'otw_bm') ),
		array( 'value' => 'title_asc', 'text' => esc_html__('Alphabetically: A-Z', 'otw_bm') ),
		array( 'value' => 'title_desc', 'text' => esc_html__('Alphabetically: Z-A', 'otw_bm') ),
		array( 'value' => 'rand_', 'text' => esc_html__('Random', 'otw_bm') )
	);

	$selectHoverData = array(
		array( 'value' => 'hover-none', 'text' => esc_html__('None', 'otw_bm') ),
		array( 'value' => 'hover-style-1-full', 'text' => esc_html__('Full (default)', 'otw_bm') ),
		array( 'value' => 'hover-style-2-shadowin', 'text' => esc_html__('Shadowin', 'otw_bm') ),
		array( 'value' => 'hover-style-3-border', 'text' => esc_html__('Border', 'otw_bm') ),
		array( 'value' => 'hover-style-4-slidetop', 'text' => esc_html__('Slide Top', 'otw_bm') ),
		array( 'value' => 'hover-style-5-slideright', 'text' => esc_html__('Slide Right', 'otw_bm') ),
		array( 'value' => 'hover-style-6-zoom', 'text' => esc_html__('Zoom', 'otw_bm') ),
		array( 'value' => 'hover-style-7-shadowout', 'text' => esc_html__('Shadow Out', 'otw_bm') ),
		array( 'value' => 'hover-style-8-slidedown', 'text' => esc_html__('Slide Down', 'otw_bm') ),
		array( 'value' => 'hover-style-9-slideleft', 'text' => esc_html__('Slide Left', 'otw_bm') ),
		array( 'value' => 'hover-style-14-desaturate', 'text' => esc_html__('Desaturate', 'otw_bm') ),
		array( 'value' => 'hover-style-15-blur', 'text' => esc_html__('Blur', 'otw_bm') ),
		array( 'value' => 'hover-style-16-orton', 'text' => esc_html__('Orton', 'otw_bm') ),
		array( 'value' => 'hover-style-17-glow', 'text' => esc_html__('Glow', 'otw_bm') ),
	);

	$selectIconData = array(
		array( 'value' => 0, 'text' => esc_html__('None (default)', 'otw_bm') ),
		array( 'value' => 'icon-expand', 'text' => esc_html__('Icon Expand', 'otw_bm') ),
		array( 'value' => 'icon-youtube-play', 'text' => esc_html__('Icon YouTube Play', 'otw_bm') ),
		array( 'value' => 'icon-file', 'text' => esc_html__('Icon File', 'otw_bm') ),
		array( 'value' => 'icon-book', 'text' => esc_html__('Icon Book', 'otw_bm') ),
		array( 'value' => 'icon-check-sign', 'text' => esc_html__('Icon Check Sign', 'otw_bm') ),
		array( 'value' => 'icon-comments', 'text' => esc_html__('Icon Comments', 'otw_bm') ),
		array( 'value' => 'icon-ok-sign', 'text' => esc_html__('Icon OK Sign', 'otw_bm') ),
		array( 'value' => 'icon-zoom-in', 'text' => esc_html__('Icon Zoom In', 'otw_bm') ),
		array( 'value' => 'icon-thumbs-up-alt', 'text' => esc_html__('Icon Thumbs Up Alt', 'otw_bm') ),
		array( 'value' => 'icon-plus-sign', 'text' => esc_html__('Icon Plus Sign', 'otw_bm') ),
		array( 'value' => 'icon-cloud', 'text' => esc_html__('Icon Cloud', 'otw_bm') ),
		array( 'value' => 'icon-chevron-sign-right', 'text' => esc_html__('Icon Chevron Sign Right', 'otw_bm') ),
		array( 'value' => 'icon-hand-right', 'text' => esc_html__('Icon Hand Right', 'otw_bm') ),
		array( 'value' => 'icon-fullscreen', 'text' => esc_html__('Icon Fullscreen', 'otw_bm') ),
	);
	
	$selectLinkData = array(
		array( 'value' => 'single', 'text' => esc_html__('Single Post (default)', 'otw_bm') ),
		array( 'value' => 'lightbox', 'text' => esc_html__('Lightbox', 'otw_bm') ),
		array( 'value' => 'no-link', 'text' => esc_html__('No Link', 'otw_bm') ),
	);

	$selectMetaData = array(
		array( 'value' => 'horizontal', 'text' => esc_html__('Horizontal (default)', 'otw_bm') ),
		array( 'value' => 'vertical', 'text' => esc_html__('Vertical', 'otw_bm') ),
	);
	
	$selectStripTags = array(
		array( 'value' => 'yes', 'text' => esc_html__('Yes (default)', 'otw_bm') ),
		array( 'value' => 'no', 'text' => esc_html__('No', 'otw_bm') ),
	);
	
	$selectStripShortcodes = array(
		array( 'value' => 'yes', 'text' => esc_html__('Yes (default)', 'otw_bm') ),
		array( 'value' => 'no', 'text' => esc_html__('No', 'otw_bm') ),
	);
	
	$selectSliderAlignmentData = array(
		array( 'value' => 'left', 'text' => esc_html__('Left (default)', 'otw_bm') ),
		array( 'value' => 'center', 'text' => esc_html__('Center', 'otw_bm') ),
		array( 'value' => 'right', 'text' => esc_html__('Right', 'otw_bm') ),
	);

	$selectMosaicData = array(
		array( 'value' => 'full', 'text' => esc_html__('Full Content on Hover (default)', 'otw_bm') ),
		array( 'value' => 'slide', 'text' => esc_html__('Slide Content on Hover', 'otw_bm') ),
	);

	$selectFontSizeData = array(
		array( 'value' => '', 'text' => esc_html__('None (default)', 'otw_bm') ),
		array( 'value' => '8', 'text' => '8px' ),
		array( 'value' => '10', 'text' => '10px' ),
		array( 'value' => '12', 'text' => '12px' ),
		array( 'value' => '14', 'text' => '14px' ),
		array( 'value' => '16', 'text' => '16px' ),
		array( 'value' => '18', 'text' => '18px' ),
		array( 'value' => '20', 'text' => '20px' ),
		array( 'value' => '22', 'text' => '22px' ),
		array( 'value' => '24', 'text' => '24px' ),
		array( 'value' => '26', 'text' => '26px' ),
		array( 'value' => '28', 'text' => '28px' ),
		array( 'value' => '30', 'text' => '30px' ),
		array( 'value' => '32', 'text' => '32px' ),
		array( 'value' => '34', 'text' => '34px' ),
		array( 'value' => '36', 'text' => '36px' ),
		array( 'value' => '38', 'text' => '38px' ),
		array( 'value' => '40', 'text' => '40px' ),
	);

	$selectFontStyleData = array(
		array( 'value' => '', 'text' => esc_html__('None (default)', 'otw_bm') ),
		array( 'value' => 'regular', 'text' => esc_html__('Regular', 'otw_bm') ),
		array( 'value' => 'bold', 'text' => esc_html__('Bold', 'otw_bm') ),
		array( 'value' => 'italic', 'text' => esc_html__('Italic', 'otw_bm') ),
		array( 'value' => 'bold_italic', 'text' => esc_html__('Bold and Italic', 'otw_bm') ),
	);

	$selectViewTargetData = array(
		array( 'value' => '_self', 'text' => esc_html__('Same Window / Tab (default)', 'otw_bm') ),
		array( 'value' => '_blank', 'text' => esc_html__('New Window / Tab', 'otw_bm') ),
	);

	$selectCategoryTagRelation = array(
		array( 'value' => 'OR', 'text' => esc_html__('categories OR tags (default)', 'otw_bm') ),
		array( 'value' => 'AND', 'text' => esc_html__('categories AND tags', 'otw_bm') )
	);
	
	$selectBorderStyleData = array(
		array( 'value' => '', 'text' => esc_html__('None (default)', 'otw_bm') ),
		array( 'value' => 'solid', 'text' => 'Solid' ),
		array( 'value' => 'dashed', 'text' => 'Dashed' ),
		array( 'value' => 'dotted', 'text' => 'Dotted' )
	);
	
	$selectBorderSizeData = array(
		array( 'value' => '', 'text' => esc_html__('None (default)', 'otw_bm') ),
		array( 'value' => '1', 'text' => '1px' ),
		array( 'value' => '2', 'text' => '2px' ),
		array( 'value' => '3', 'text' => '3px' ),
		array( 'value' => '4', 'text' => '4px' )
	);
	
	$thumb_format_options = array(
		'' => esc_html__('Keep original file format (default)', 'otw_bm' ),
		'jpg' => 'jpg',
		'png' => 'png',
		'gif' => 'gif'
	);
	
	$js_template_options = array();
	
	if( isset( $templateOptions ) && is_array( $templateOptions ) ){
		
		foreach( $templateOptions as $t_option ){
			$js_template_options[ $t_option['name'] ] = $t_option;
		}
	}
	
?>


<div class="wrap">
	<div id="icon-edit" class="icon32"></div>
	<h2>
		<?php
			if( empty($this->errors) && !empty($content['list_name']) ) {
				echo esc_html__( 'Edit Blog List', 'otw_bm' ); 	
			} else {
				echo esc_html__( 'Create New Blog List', 'otw_bm' );
			}
		?>
		<a class="add-new-h2" href="admin.php?page=otw-bm"><?php esc_html_e('Back', 'otw_bm');?></a>
	</h2>
	<?php
		if( $writableCssError ) {
			$message = esc_html__('The folder \''.SKIN_BM_PATH.'\' is not writable. Please make sure you add read/write permissions to this folder.', 'otw_bm');
			 echo '<div class="error"><p>'.$message.'</p></div>';
		}
	?>
	<?php
	if( !empty( otw_get( 'success', '' ) ) && otw_get( 'success', '' ) == 'true' ) {
			$message = esc_html__('Item was saved.', 'otw_bm');
			echo '<div class="updated"><p>'.$message.'</p></div>';
	}
	?>
	<form name="otw-bm-list" method="post" action="" class="validate">

		<input type="hidden" name="id" value="<?php echo esc_attr( $nextID );?>" />
		<input type="hidden" name="edit" value="<?php echo esc_attr( $edit );?>" />
		<input type="hidden" name="date_created" value="<?php echo esc_attr( $content['date_created'] );?>" />
		<input type="hidden" name="user_id" value="<?php echo esc_attr( get_current_user_id() );?>" />

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
		<script type="text/javascript">
		<?php
			
			echo 'var js_template_options='.json_encode( $js_template_options ).';'
		?>
		</script>
		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row"><label for="list_name" class="required"><?php esc_html_e('Blog List Name', 'otw_bm');?></label></th>
					<td>
						<input type="text" name="list_name" id="list_name" size="53" value="<?php echo esc_attr( $content['list_name'] );?>" />
						<p class="description"><?php esc_html_e( 'Note: The List Name is going to be used ONLY for the admin as a reference.', 'otw_bm');?></p>
						<div class="inline-error">
							<?php 
								( !empty($this->errors['list_name']) )? $errorMessage = $this->errors['list_name'] : $errorMessage = ''; 
								echo $errorMessage;
							?>
						</div>
					</td>
				</tr>				
				<tr valign="top">
					<th scope="row"><label for="template" class="required"><?php esc_html_e('Choose Template', 'otw_bm');?></label></th>
					<td>
						<select id="template" name="template" class="js-template-style">
						<?php 
						foreach( $selectOptionData as $optionData ): 
							$selected = '';
							if( $optionData['value'] === $content['template'] ) {
								$selected = 'selected="selected"';
							}
							echo "<option value=\"".$optionData['value']."\" ".$selected.">".$optionData['text']."</option>";
							
						endforeach;
						?>
						</select>
						<div class="inline-error">
							<?php 
								( !empty($this->errors['template']) )? $errorMessage = $this->errors['template'] : $errorMessage = ''; 
								echo $errorMessage;
							?>
						</div>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						<label for="categories"><?php esc_html_e('Categories:', 'otw_bm');?></label>
					</th>
					<td>
						<?php 
								$categoriesCount 	= wp_count_terms( 'category', array( 'number' => '', 'hide_empty' => false  ) );
								$categoriesStatus = 'otw-admin-hidden';
								$categoriesAll 		= '';
								$categoriesInput 	= '';
								
								if( !empty($content['select_categories']) ) {
									
									$categoriesStatus = '';
									$categoriesAll = 'checked="checked"';
									$categoriesInput = 'disabled="disabled"';
								}
						?>
						<select name="categories[]" id="categories" class="js-categories" multiple="multiple" data-value="<?php echo esc_attr( $content['categories'] );?>" <?php echo $categoriesInput ?>></select><br />
						<?php esc_html_e('- OR -', 'otw_bm'); ?><br/>
						<input type="hidden" name="all_categories" class="js-categories-select" value="<?php echo esc_attr( $content['all_categories'] );?>" />
						<input type="checkbox" name="select_categories" value="1" data-size="<?php echo esc_attr( $categoriesCount );?>" class="js-select-categories" id="select_all_categories" data-section="categories" <?php echo $categoriesAll;?> />
						<label for="select_all_categories">
							<?php esc_html_e('Select All', 'otw_bm');?>
							<span class="js-categories-count <?php echo $categoriesStatus; ?>">
								(
								<span class="js-categories-counter"><?php echo esc_html( $categoriesCount );?></span>
								<?php esc_html_e(' categories selected', 'otw_bm');?>
								)
							</span>
						</label>
						<p class="description"><?php esc_html_e( 'Choose categories to include posts from those categories in your list or use the Select all checkbox to include posts from all categories.', 'otw_bm');?></p>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						<label for="exclude_categories"><?php esc_html_e('Exclude Categories:', 'otw_bm');?></label>
					</th>
					<td>
						<?php 
								$exclude_categoriesAll 		= '';
								$exclude_categoriesInput 	= '';
						?>
						<select name="exclude_categories[]" id="exclude_categories" class="js-exclude_categories" multiple="multiple" data-value="<?php echo esc_attr( $content['exclude_categories'] );?>" <?php echo $exclude_categoriesInput ?>></select><br />
						<p class="description"><?php esc_html_e( 'Choose categories to exclude posts from those categories in your list.', 'otw_bm');?></p>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						<label for="tags"><?php esc_html_e('Tags:', 'otw_bm');?></label>
					</th>
					<td>
						<?php 
								$tagsCount 	= wp_count_terms( 'post_tag', array( 'number' => '', 'hide_empty' => false  ) );
								
								$tagsStatus = 'otw-admin-hidden';
								$tagsAll 		= '';
								$tagsInput 	= '';
								if( !empty($content['select_tags']) ) {
									
									$tagsStatus = '';
									$tagsAll = 'checked="checked"';
									$tagsInput = 'disabled="disabled"';
								}
						?>
						<select name="tags[]" id="tags" class="js-tags" multiple="multiple" data-value="<?php echo esc_attr( $content['tags'] );?>" <?php echo $tagsInput;?>></select><br />
						<?php esc_html_e('- OR -', 'otw_bm'); ?><br/>
						<input type="hidden" name="all_tags" class="js-tags-select" value="<?php echo esc_attr( $content['all_tags'] );?>" />
						<input type="checkbox" name="select_tags" value="1" class="js-select-tags" data-size="<?php echo esc_attr( $tagsCount );?>" id="select_all_tags" data-section="tags" <?php echo $tagsAll;?>/>
						<label for="select_all_tags">
							<?php esc_html_e('Select All', 'otw_bm'); ?>
							<span class="js-tags-count <?php echo $tagsStatus;?>">
								(
								<span class="js-tags-counter"><?php echo esc_html( $tagsCount );?></span>
								<?php esc_html_e(' tags selected', 'otw_bm');?>
								)
							</span>
						</label>
						<p class="description"><?php esc_html_e( 'Choose tags to include posts from those tags in your list or use the Select all checkbox to include posts from all tags.', 'otw_bm');?></p>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						<label for="exclude_tags"><?php esc_html_e('Exclude Tags:', 'otw_bm');?></label>
					</th>
					<td>
						<?php 
								$exclude_tagsAll 		= '';
								$exclude_tagsInput 	= '';
						?>
						<select name="exclude_tags[]" id="exclude_tags" class="js-exclude_tags" multiple="multiple" data-value="<?php echo esc_attr( $content['exclude_tags'] );?>" <?php echo $exclude_tagsInput ?>></select><br />
						<p class="description"><?php esc_html_e( 'Choose tags to exclude posts from those tags in your list.', 'otw_bm');?></p>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						<label for="authors"><?php esc_html_e('Post Author:', 'otw_bm');?></label>
					</th>
					<td>
						<?php 
								$count_users = count_users();
								$usersCount = $count_users['total_users'];
								$usersStatus = 'otw-admin-hidden';
								$usersAll 		= '';
								$usersInput 	= '';
								if( !empty($content['select_users']) ) {
									
									$usersStatus = '';
									$usersAll = 'checked="checked"';
									$usersInput = 'disabled="disabled"';
								}
						?>
						<select name="users[]" id="users" class="js-users" multiple="multiple" data-value="<?php echo esc_attr( $content['users'] );?>" <?php echo $usersInput ?>></select><br />
						<?php esc_html_e('- OR -', 'otw_bm'); ?><br/>
						<input type="hidden" name="all_users" class="js-users-select" value="<?php echo esc_attr( $content['all_users'] );?>" />
						<input type="checkbox" name="select_users" value="1" data-size="<?php echo esc_attr( $usersCount ); ?>" class="js-select-users" id="select_all_users" data-section="users" <?php echo $usersAll;?>/>
						<label for="select_all_users">
							<?php esc_html_e('Select All', 'otw_bm'); ?>
							<span class="js-users-count <?php echo $usersStatus; ?>">
								(
								<span class="js-users-counter"><?php echo esc_html( $usersCount ); ?></span>
								<?php esc_html_e(' authors selected', 'otw_bm');?>
								)
							</span>
						</label>
						<p class="description"><?php esc_html_e( 'Choose authors to include posts from those authors in your list or use the Select all checkbox to include posts from all authors.', 'otw_bm');?></p>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						<label for="exclude_users"><?php esc_html_e('Exclude Authors:', 'otw_bm');?></label>
					</th>
					<td>
						<?php 
								$exclude_usersAll 		= '';
								$exclude_usersInput 	= '';
						?>
						<select name="exclude_users[]" id="exclude_users" class="js-exclude_users" multiple="multiple" data-value="<?php echo esc_attr( $content['exclude_users'] );?>" <?php echo $exclude_usersInput ?>></select><br />
						<p class="description"><?php esc_html_e( 'Choose authors to exclude posts from those authors in your list.', 'otw_bm');?></p>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						<label for="exclude_current_post"><?php esc_html_e('Exclude current post:', 'otw_bm');?></label>
					</th>
					<td>
						<select id="exclude_current_post" name="exclude_current_post">
							<option value="no"<?php echo ( $content['exclude_current_post'] != 'yes' )?'selected="selected"':''?>><?php esc_html_e('No', 'otw_bm');?></option>
							<option value="yes"<?php echo ( $content['exclude_current_post'] == 'yes' )?'selected="selected"':''?>><?php esc_html_e('Yes', 'otw_bm');?></option>
						</select>
						<p class="description"><?php esc_html_e( 'Enable this to exclude the current post. This is mostly used when displaying a list of posts on a single post page.', 'otw_bm');?></p>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						<label for="enable_sticky_posts"><?php esc_html_e('Enable Sticky Posts:', 'otw_bm');?></label>
					</th>
					<td>
						<select id="enable_sticky_posts" name="enable_sticky_posts">
							<option value="no"<?php echo ( $content['enable_sticky_posts'] != 'yes' )?'selected="selected"':''?>><?php esc_html_e('No', 'otw_bm');?></option>
							<option value="yes"<?php echo ( $content['enable_sticky_posts'] == 'yes' )?'selected="selected"':''?>><?php esc_html_e('Yes', 'otw_bm');?></option>
						</select>
						<p class="description"><?php esc_html_e( 'Enable this to include sticky posts.', 'otw_bm');?></p>
					</td>
				</tr>
				<tr>
					<th></th>
					<td>
						<div class="inline-error">
							<?php 
								( !empty($this->errors['content']) )? $errorMessage = $this->errors['content'] : $errorMessage = ''; 
								echo $errorMessage;
							?>
						</div>
					</td>
				</tr>

			</tbody>
		</table>

		<div class="accordion-container">
			<ul class="outer-border">
				
				<!-- List Elements and Order -->
				<li class="control-section accordion-section  add-page top">
					<h3 class="accordion-section-title hndl" tabindex="0" title="<?php esc_html_e('List Elements and Order', 'otw_bm');?>"><?php esc_html_e('List Elements and Order', 'otw_bm');?></h3>
					<div class="accordion-section-content" style="display: none;">
						<div class="inside">
							<table class="form-table">
								<tbody>
									<tr>
										<th scope="row">
											<label for="meta_order"><?php esc_html_e('Blog List Items', 'otw_bm');?></label>
										</th>
										<td>
											<div class="active_elements">
												<h3><?php esc_html_e('Active Elements', 'otw_bm');?></h3>
												<input type="hidden" name="blog-items" class="js-blog-items" value="<?php echo esc_attr( $content['blog-items'] );?>"/>
												<ul id="meta-active" class="b-bl-box js-bl-active">
												</ul>
											</div>
											<div class="inactive_elements">
												<h3><?php esc_html_e('Inactive Elements', 'otw_bm');?></h3>
												<ul id="meta-inactive" class="b-bl-box js-bl-inactive">
													<li data-item="main" data-value="media" class="b-bl-items js-bl--item"><?php esc_html_e('Media', 'otw_bm');?></li>
													<li data-item="main" data-value="title" class="b-bl-items js-bl--item"><?php esc_html_e('Title', 'otw_bm');?></li>
													<li data-item="main" data-value="meta" class="b-bl-items js-bl--item"><?php esc_html_e('Meta', 'otw_bm');?></li>
													<li data-item="main" data-value="description" class="b-bl-items js-bl--item"><?php esc_html_e('Description / Excerpt', 'otw_bm');?></li>
													<li data-item="main" data-value="continue-reading" class="b-bl-items js-bl--item"><?php esc_html_e('Continue Reading', 'otw_bm');?></li>
												</ul>
											</div>
											<p class="description">
												<?php esc_html_e('Drag & drop the items that you\'d like to show in the Active Elements area on the left. Arrange them however you want to see them in your list.', 'otw_bm');?>
											</p>
											<p class="description">
												<?php esc_html_e('The setting will not affect the following templates: Slider, Carousel, Widget Style, Carousel Widget', 'otw_bm'); ?>
											</p>
										</td>
									</tr>
									<tr valign="top">
										<th scope="row">
											<label for="show-pagination"><?php esc_html_e('Show Pagination', 'otw_bm');?></label>
										</th>
										<td>
											
										<select id="show-pagination" name="show-pagination">
											<?php 
											foreach( $selectPaginationData as $optionData ): 
												$selected = '';
												if( $optionData['value'] === $content['show-pagination'] ) {
													$selected = 'selected="selected"';
												}
												echo "<option value=\"".$optionData['value']."\" ".$selected.">".$optionData['text']."</option>";
												
											endforeach;
											?>
											</select>
											<p class="description">
												<?php esc_html_e('Choose pagination type for your template.', 'otw_bm'); ?><br/>
												<strong><?php esc_html_e('Note:', 'otw_bm');?></strong><br/>
												<?php esc_html_e('Widget Style templates support only Load More Pagination.', 'otw_bm'); ?><br/>
												<?php esc_html_e('Slider templates do not support pagination.', 'otw_bm'); ?><br/>
												<?php esc_html_e('Timeline template will have the Infinite Scroll by default.', 'otw_bm'); ?>
											</p>
										</td>
									</tr>
									<tr valign="top">
										<th scope="row">
											<label for="show-post-icon"><?php esc_html_e('Show Post Type Icon', 'otw_bm');?></label>
										</th>
										<td>
											<?php
												$yes = ''; $no = ''; 
												($content['show-post-icon'])? $yes = 'checked="checked"' : $no = 'checked="checked"'; 
											?>
											<input type="radio" name="show-post-icon" id="show-post-icon-no" value="0" <?php echo $no;?> /> 
											<label for="show-post-icon-no"><?php esc_html_e('No (default)', 'otw_bm');?></label>

											<input type="radio" name="show-post-icon" id="show-post-icon-yes" value="1" <?php echo $yes;?>/> 
											<label for="show-post-icon-yes"><?php esc_html_e('Yes', 'otw_bm');?></label>
											<p class="description"><?php esc_html_e('Enable the post type icon over the media. This is the icon that shows what is the type of the post.', 'otw_bm');?></p>
										</td>
									</tr>
									<tr valign="top">
										<th scope="row">
											<label for="show-delimiter"><?php esc_html_e('Show Delimiter', 'otw_bm');?></label>
										</th>
										<td>
											<?php
												$yes = ''; $no = ''; 
												($content['show-delimiter'])? $yes = 'checked="checked"' : $no = 'checked="checked"'; 
											?>
											<input type="radio" name="show-delimiter" id="show-delimiter-no" value="0" <?php echo $no;?> /> 
											<label for="show-delimiter-no"><?php esc_html_e('No (default)', 'otw_bm');?></label>

											<input type="radio" name="show-delimiter" id="show-delimiter-yes" value="1" <?php echo $yes;?> /> 
											<label for="show-delimiter-yes"><?php esc_html_e('Yes', 'otw_bm');?></label>
											<p class="description"><?php esc_html_e('Enable 1px line after post.', 'otw_bm');?></p>
										</td>
									</tr>
									<tr valign="top">
										<th scope="row">
											<label for="show-border"><?php esc_html_e('Show Border', 'otw_bm');?></label>
										</th>
										<td>
											<?php
												$yes = ''; $no = ''; 
												($content['show-border'])? $yes = 'checked="checked"' : $no = 'checked="checked"'; 
											?>
											<input type="radio" name="show-border" id="show-border-no" value="0" <?php echo $no;?> /> 
											<label for="show-border-no"><?php esc_html_e('No (default)', 'otw_bm');?></label>

											<input type="radio" name="show-border" id="show-border-yes" value="1" <?php echo $yes;?> /> 
											<label for="show-border-yes"><?php esc_html_e('Yes', 'otw_bm');?></label>
											<p class="description"><?php esc_html_e("A border (1px) is going to be applied to all of your posts within the list", 'otw_bm');?></p>
										</td>
									</tr>
									<tr valign="top">
										<th scope="row">
											<label for="show-background"><?php esc_html_e('Show Background', 'otw_bm');?></label>
										</th>
										<td>
											<?php
												$yes = ''; $no = ''; 
												($content['show-background'])? $yes = 'checked="checked"' : $no = 'checked="checked"'; 
											?>
											<input type="radio" name="show-background" id="show-background-no" value="0" <?php echo $no;?> /> 
											<label for="show-background-no"><?php esc_html_e('No (default)', 'otw_bm');?></label>

											<input type="radio" name="show-background" id="show-background-yes" value="1" <?php echo $yes;?>/> 
											<label for="show-background-yes"><?php esc_html_e('Yes', 'otw_bm');?></label>
											<p class="description"><?php esc_html_e("A background is going to be present on all of the posts within the list", 'otw_bm');?></p>
										</td>
									</tr>
									<tr valign="top">
										<th scope="row">
											<label for="show-social-icons"><?php esc_html_e('Show Social Icons', 'otw_bm');?></label>
										</th>
										<td>
											<?php
												$yes = ''; $no = ''; 
												($content['show-social-icons'])? $yes = 'checked="checked"' : $no = 'checked="checked"'; 
											?>
											<select id="show-social-icons" name="show-social-icons">
											<?php 
											foreach( $selectSocialData as $optionData ): 
												$selected = '';
												if( $optionData['value'] === $content['show-social-icons'] ) {
													$selected = 'selected="selected"';
												}
												echo "<option value=\"".$optionData['value']."\" ".$selected.">".$optionData['text']."</option>";
												
											endforeach;
											?>
											</select>
											<p class="description">
												<?php 
												esc_html_e("Social Icons will make your posts easy to share in social networks. Note that to use 
													\"Share buttons small\" and \"Share buttons large\" you need to have CURL installed on your server.
													", 'otw_bm');
												?>
											</p>
										</td>
									</tr>
									<tr id="otw-show-social-icons-type">
										<th scope="row">
											<label for="show-social-icons-type"><?php esc_html_e('Select Social Icons', 'otw_bm');?></label>
										</th>
										<td>
											<input type="checkbox" id="show-social-icons-type" name="show-social-icons-facebook" value="1" <?php echo ( $content['show-social-icons-facebook'] )?' checked="checked"':''?> /><label for="show-social-icons-type"><?php esc_html_e('Facebook', 'otw_bm');?></label>
											<input type="checkbox" id="show-social-icons-twitter" name="show-social-icons-twitter" value="1" <?php echo ( $content['show-social-icons-twitter'] )?' checked="checked"':''?>/><label for="show-social-icons-twitter"><?php esc_html_e('Twitter', 'otw_bm');?></label>
											<input type="checkbox" id="show-social-icons-googleplus" name="show-social-icons-googleplus" value="1" <?php echo ( $content['show-social-icons-googleplus'] )?' checked="checked"':''?>/><label for="show-social-icons-googleplus"><?php esc_html_e('Google+', 'otw_bm');?></label>
											<input type="checkbox" id="show-social-icons-linkedin" name="show-social-icons-linkedin" value="1" <?php echo ( $content['show-social-icons-linkedin'] )?' checked="checked"':''?>/><label for="show-social-icons-linkedin"><?php esc_html_e('LinkedIn', 'otw_bm');?></label>
											<input type="checkbox" id="show-social-icons-pinterest" name="show-social-icons-pinterest" value="1" <?php echo ( $content['show-social-icons-pinterest'] )?' checked="checked"':''?>/><label for="show-social-icons-pinterest"><?php esc_html_e('Pinterest', 'otw_bm');?></label>
											<p class="description"><?php esc_html_e( 'Select the social icons that will be displayed.', 'otw_bm');?></p>
										</td>
									</tr>
									<tr id="otw-show-social-icons-custom">
										<th scope="row">
											<label for="show-social-icons-custom"><?php esc_html_e('Custom Social Icons', 'otw_bm');?></label>
										</th>
										<td>
											<textarea id="show-social-icons-custom" name="show-social-icons-custom" rows="6" cols="80"><?php echo esc_textarea( $content['show-social-icons-custom'] )?></textarea>
											<p class="description"><?php esc_html_e( 'Insert your Custom Social Icons. HTML and Shortcodes are allowed.', 'otw_bm');?></p>
										</td>
									</tr>

								</tbody>
							</table>
						</div><!-- .inside -->
					</div><!-- .accordion-section-content -->

				</li><!-- .accordion-section -->
				<!-- END List Elements and Order -->

				<!-- Post Order and Limits -->
				<li class="control-section accordion-section add-page top">
					<h3 class="accordion-section-title hndl" tabindex="1" title="<?php esc_html_e('Posts Order and Limits', 'otw_bm');?>"><?php esc_html_e('Posts Order and Limits', 'otw_bm');?></h3>
					<div class="accordion-section-content" style="display: none;">
						<div class="inside">
							<table class="form-table">
								<tbody>
									<tr valign="top">
										<th scope="row">
											<label for="posts_limit"><?php esc_html_e('Number of Posts in the List:', 'otw_bm');?></label>
										</th>
										<td>
											<input type="text" name="posts_limit" id="posts_limit" value="<?php echo esc_attr( $content['posts_limit'] );?>" />
											<p class="description"><?php esc_html_e('Please leave empty for all posts.', 'otw_bm');?></p>
										</td>
									</tr>
									<tr valign="top">
										<th scope="row">
											<label for="posts_limit_skip"><?php esc_html_e('Number of Posts to Skip:', 'otw_bm');?></label>
										</th>
										<td>
											<input type="text" name="posts_limit_skip" id="posts_limit_skip" value="<?php echo esc_attr( $content['posts_limit_skip'] );?>" />
											<p class="description"><?php esc_html_e('By default this field is empty which means no posts will be skipped.', 'otw_bm');?></p>
										</td>
									</tr>
									<tr valign="top">
										<th scope="row">
											<label for="posts_limit_page"><?php esc_html_e('Number of Posts per Page:', 'otw_bm');?></label>
										</th>
										<td>
											<input type="text" name="posts_limit_page" id="posts_limit_page" value="<?php echo esc_attr( $content['posts_limit_page'] );?>" />
											<p class="description"><?php esc_html_e('Show pagination should be ebabled in the section above in order for this option to work.', 'otw_bm');?></p>
										</td>
									</tr>
									<tr valign="top">
										<th scope="row">
											<label for="posts_order"><?php esc_html_e('Order of Posts:', 'otw_bm');?></label>
										</th>
										<td>
											<select name="posts_order" id="posts_order">
											<?php 
											foreach( $selectOrderData as $optionData ): 
												$selected = '';
												if( $optionData['value'] === $content['posts_order'] ) {
													$selected = 'selected="selected"';
												}
												echo "<option value=\"".$optionData['value']."\" ".$selected.">".$optionData['text']."</option>";
												
											endforeach;
											?>
											</select>
											<p class="description"><?php esc_html_e('Choose the order of the posts in the list. Timeline Template will ignore this selection and use Latest Created. Note that when Random is selected and pagination is enabled there might be posts displayed on more than one of the pagination pages.', 'otw_bm');?></p>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div><!-- .accordion-section-content -->

				</li><!-- .accordion-section -->
				<!-- END Post Order and Limits -->

				<!-- Settings -->
				<li class="control-section accordion-section add-page top">
					<h3 class="accordion-section-title hndl" tabindex="2" title="<?php esc_html_e('Settings', 'otw_bm');?>"><?php esc_html_e('Settings', 'otw_bm');?></h3>
					<div class="accordion-section-content" style="display: none;">
						<div class="inside">
							<table class="form-table">
								<tbody>
									<tr valign="top">
										<th scope="row">
											<label for="blog_list_title"><?php esc_html_e('Blog List Title:', 'otw_bm');?></label>
										</th>
										<td>
											<input type="text" name="blog_list_title" id="blog_list_title" value="<?php echo esc_attr( $content['blog_list_title'] );?>" size="53" />
											<p class="description"><?php esc_html_e('This is the title on top of your list. If empty no title will be displayed.', 'otw_bm');?></p>
										</td>
									</tr>
									<tr valign="top">
										<th scope="row">
											<label for="view_all_page"><?php esc_html_e('View All Link:', 'otw_bm');?></label>
										</th>
										<td>
											<select name="view_all_page" id="view_all_page" class="js-pages" data-value="<?php echo esc_attr( $content['view_all_page'] );?>" data-allow-clear="true"></select>
											<br/><?php esc_html_e('- OR -', 'otw_bm'); ?><br/>
											<input type="text" name="view_all_page_link" value="<?php echo esc_attr( $content['view_all_page_link'] );?>" size="53" placeholder="http://www.google.com"/>
											<p class="description"><?php esc_html_e('Choose the page you want "view all" to link to. Or enter an URL.', 'otw_bm');?></p>
										</td>
									</tr>
									<tr valign="top">
										<th scope="row">
											<label for="view_all_page_text"><?php esc_html_e('View All Link Text:', 'otw_bm');?></label>
										</th>
										<td>
											<input type="text" name="view_all_page_text" id="view_all_page_text" value="<?php echo esc_attr( $content['view_all_page_text'] );?>" size="53"/>
											<p class="description"><?php esc_html_e('Enter View all link text. By default the text is “View all”.', 'otw_bm');?></p>
										</td>
									</tr>
									<tr valign="top">
										<th scope="row">
											<label for="view_all_target"><?php esc_html_e('View All Link Target:', 'otw_bm');?></label>
										</th>
										<td>
											<select name="view_all_target">
											<?php 
											foreach( $selectViewTargetData as $optionData ): 
												$selected = '';
												if( $optionData['value'] === $content['view_all_target'] ) {
													$selected = 'selected="selected"';
												}
												echo "<option value=\"".$optionData['value']."\" ".$selected.">".$optionData['text']."</option>";
												
											endforeach;
											?>
											</select>		
											<p class="description"><?php esc_html_e('Select if you would like to open the link in a new window / tab or the same window / tab.', 'otw_bm');?></p>
										</td>
									</tr>
									<tr valign="top">
										<th scope="row">
											<label for="excerpt_length"><?php esc_html_e('Excerpt Length:', 'otw_bm');?></label>
										</th>
										<td>
											<input type="text" name="excerpt_length" id="excerpt_length" value="<?php echo esc_attr( $content['excerpt_length'] );?>" size="53"/>
											<p class="description"><?php esc_html_e('Excerpt is pulled from excerpt field for each post. If excerpt fields is empty excerpt is pulled from the text area (the post editor). The More tag is supported. If Excerpt length is empty or 0 this means pull the entire text.', 'otw_bm');?></p>
										</td>
									</tr>
									<tr valign="top">
										<th scope="row">
											<label for="strip_tags"><?php esc_html_e('Strip HTML Tags:', 'otw_bm');?></label>
										</th>
										<td>
											<select name="strip_tags" id="strip_tags">
											<?php 
											foreach( $selectStripTags as $optionData ): 
												$selected = '';
												if( $optionData['value'] === $content['strip_tags'] ) {
													$selected = 'selected="selected"';
												}
												echo "<option value=\"".$optionData['value']."\" ".$selected.">".$optionData['text']."</option>";
												
											endforeach;
											?>
											</select>
											<p class="description"><?php esc_html_e('Strip HTML tags from the excerpt in your blog lists.', 'otw_bm');?>
										</td>
									</tr>
									<tr valign="top">
										<th scope="row">
											<label for="strip_shortcodes"><?php esc_html_e('Strip Shortcodes:', 'otw_bm');?></label>
										</th>
										<td>
											<select name="strip_shortcodes" id="strip_shortcodes">
											<?php 
											foreach( $selectStripShortcodes as $optionData ): 
												$selected = '';
												if( $optionData['value'] === $content['strip_shortcodes'] ) {
													$selected = 'selected="selected"';
												}
												echo "<option value=\"".$optionData['value']."\" ".$selected.">".$optionData['text']."</option>";
												
											endforeach;
											?>
											</select>
											<p class="description"><?php esc_html_e('Strip Shortcodes from the excerpt in your blog lists.', 'otw_bm');?>
										</td>
									</tr>
									<tr valign="top">
										<th scope="row">
											<label for="continue_reading"><?php esc_html_e('Continue Reading Text:', 'otw_bm');?></label>
										</th>
										<td>
											<input type="text" name="continue_reading" id="continue_reading" value="<?php echo esc_attr( $content['continue_reading'] );?>" size="53" />
											<p class="description"><?php esc_html_e('Enter the text for your continue reading link under each post. If left empty ‘Continue reading’ is displayed.', 'otw_bm');?></p>
										</td>
									</tr>
									<tr valign="top">
										<th scope="row">
											<label for="image_link"><?php esc_html_e('Click on Image Links to?', 'otw_bm');?></label>
										</th>
										<td>
											<select name="image_link" id="image_link">
											<?php 
											foreach( $selectLinkData as $optionData ): 
												$selected = '';
												if( $optionData['value'] === $content['image_link'] ) {
													$selected = 'selected="selected"';
												}
												echo "<option value=\"".$optionData['value']."\" ".$selected.">".$optionData['text']."</option>";
												
											endforeach;
											?>
											</select>									
											<p class="description"><?php esc_html_e('Choose where a click on the image links to.', 'otw_bm');?></p>
										</td>
									</tr>
									<tr valign="top">
										<th scope="row">
											<label for="title_link"><?php esc_html_e('Click on Title Links to?', 'otw_bm');?></label>
										</th>
										<td>
											<select name="title_link" id="title_link">
											<?php 
											foreach( $selectLinkData as $optionData ): 
												$selected = '';
												if( $optionData['value'] === $content['title_link'] ) {
													$selected = 'selected="selected"';
												}
												echo "<option value=\"".$optionData['value']."\" ".$selected.">".$optionData['text']."</option>";
												
											endforeach;
											?>
											</select>									
											<p class="description"><?php esc_html_e('Choose where a click on the title links to.', 'otw_bm');?></p>
										</td>
									</tr>
									<tr valign="top">
										<th scope="row">
											<label for="image_hover"><?php esc_html_e('Hover Effect', 'otw_bm');?></label>
										</th>
										<td>
											<select name="image_hover" id="image_hover">
											<?php 
											foreach( $selectHoverData as $optionData ): 
												$selected = '';
												if( $optionData['value'] === $content['image_hover'] ) {
													$selected = 'selected="selected"';
												}
												echo "<option value=\"".$optionData['value']."\" ".$selected.">".$optionData['text']."</option>";
												
											endforeach;
											?>
											</select>									
											<p class="description"><?php esc_html_e('Choose the hover for the images in the posts list.', 'otw_bm');?></p>
											<p class="description">
												<?php esc_html_e('The setting will not affect the following templates since they have their own specific hovers: Slider, Carousel.', 'otw_bm'); ?> 
											</p>
											<p class="description">
												<?php esc_html_e('Widget Templates support only Full and None hover options.', 'otw_bm'); ?> 
											</p>
										</td>
									</tr>
									<tr valign="top">
										<th scope="row">
											<label for="icon_hover"><?php esc_html_e('Icon Hover Effect', 'otw_bm');?></label>
										</th>
										<td>
											<select name="icon_hover" id="icon_hover">
											<?php 
											foreach( $selectIconData as $optionData ): 
												$selected = '';
												if( $optionData['value'] === $content['icon_hover'] ) {
													$selected = 'selected="selected"';
												}
												echo "<option value=\"".$optionData['value']."\" ".$selected.">".$optionData['text']."</option>";
												
											endforeach;
											?>
											</select>									
											<p class="description"><?php esc_html_e('You can add an icon that will be displayed with the hover.', 'otw_bm');?></p>
											<p class="description"><?php esc_html_e('Icon Hover Effects will work with the following Hover Effects: Slide Top, Slide Right, Slide Down, Slide Left.', 'otw_bm');?></p>
										</td>
									</tr>
									<tr valign="top">
										<th scope="row">
											<label for="thumb_width"><?php esc_html_e('Thumbnail Width', 'otw_bm');?></label>
										</th>
										<td>
											<?php ( !isset($content['thumb_width']) )? $thumbWidth = '' : $thumbWidth = $content['thumb_width']; ?>
											<input type="text" name="thumb_width" id="thumb_width" size="3" value="<?php echo esc_attr( $thumbWidth );?>" />
											<p class="description"><?php esc_html_e('The width for your thumbnails in px. If left empty the default value will be used. Default value for the selected template is: ', 'otw_bm');?><span class="default_thumb_width"></span></p>
										</td>
									</tr>
									<tr valign="top">
										<th scope="row">
											<label for="thumb_height"><?php esc_html_e('Thumbnail Height', 'otw_bm');?></label>
										</th>
										<td>
											<?php ( !isset($content['thumb_height']) )? $thumbHeight = '' : $thumbHeight = $content['thumb_height']; ?>
											<input type="text" name="thumb_height" id="thumb_height" size="3" value="<?php echo esc_attr( $thumbHeight );?>" />
											<p class="description"><?php esc_html_e('The height for your thumbnails in px. If left empty the default value will be used. Default value for the selected template is: ', 'otw_bm');?><span class="default_thumb_height"></span></p>
										</td>
									</tr>
									<tr valign="top">
										<th scope="row">
											<label for="thumb_format"><?php esc_html_e('Thumbnail Format', 'otw_bm');?></label>
										</th>
										<td>
											<?php ( !isset($content['thumb_format']) )? $thumbFormat = '' : $thumbFormat = $content['thumb_format']; ?>
											<select id="thumb_format" name="thumb_format">
											<?php foreach( $thumb_format_options as $key => $name ){?>
												<?php
													$selected = '';
													if( $thumbFormat == $key ){
														$selected = ' selected="selected"';
													}
												?>
												<option value="<?php echo esc_attr( $key )?>"<?php echo $selected?>><?php echo esc_html( $name )?></option>
											<?php }?>
											</select>
											<p class="description"><?php esc_html_e('The format for your thumbnails.', 'otw_bm');?></p>
										</td>
									</tr>
									<tr valign="top">
										<th scope="row">
											<label for="thumb_crop"><?php esc_html_e('Thumnail Crop', 'otw_bm');?></label>
										</th>
										<td>
											<?php ( !isset($content['thumb_crop']) )? $thumbCrop = '' : $thumbCrop = $content['thumb_crop']; ?>
											<select name="thumb_crop" id="thumb_crop">
												<option value="center_center" <?php echo ( $thumbCrop == 'center_center' )?'selected="selected"':'';?> ><?php esc_html_e( 'Crop center-center (default)', 'otw_bm');?></option>
												<option value="center_left" <?php echo ( $thumbCrop == 'center_left' )?'selected="selected"':'';?> ><?php esc_html_e( 'Crop center-left', 'otw_bm');?></option>
												<option value="center_right" <?php echo ( $thumbCrop == 'center_right' )?'selected="selected"':'';?> ><?php esc_html_e( 'Crop center-right', 'otw_bm');?></option>
												<option value="top_center" <?php echo ( $thumbCrop == 'top_center' )?'selected="selected"':'';?> ><?php esc_html_e( 'Crop top-center', 'otw_bm');?></option>
												<option value="top_left" <?php echo ( $thumbCrop == 'top_left' )?'selected="selected"':'';?> ><?php esc_html_e( 'Crop top-left', 'otw_bm');?></option>
												<option value="top_right" <?php echo ( $thumbCrop == 'top_right' )?'selected="selected"':'';?> ><?php esc_html_e( 'Crop top-right', 'otw_bm');?></option>
												<option value="bottom_center" <?php echo ( $thumbCrop == 'bottom_center' )?'selected="selected"':'';?> ><?php esc_html_e( 'Crop bottom-center', 'otw_bm');?></option>
												<option value="bottom_left" <?php echo ( $thumbCrop == 'bottom_left' )?'selected="selected"':'';?> ><?php esc_html_e( 'Crop bottom-left', 'otw_bm');?></option>
												<option value="botom_right" <?php echo ( $thumbCrop == 'bottom_right' )?'selected="selected"':'';?> ><?php esc_html_e( 'Crop bottom-right', 'otw_bm');?></option>
												<option value="no" <?php echo ( $thumbCrop == 'no' )?'selected="selected"':'';?> ><?php esc_html_e( 'No cropping, resize only', 'otw_bm');?></option>
											</select>
											<p class="description"><?php esc_html_e('Crop or just resize the thumbnail.', 'otw_bm');?></p>
										</td>
									</tr>
									<tr valign="top">
										<th scope="row">
											<label for="white_spaces"><?php esc_html_e('Small Images', 'otw_bm');?></label>
										</th>
										<td>
											<?php ( empty($content['white_spaces']) )? $whiteSpaces = 'yes' : $whiteSpaces = $content['white_spaces']; ?>
											<select name="white_spaces" id="white_spaces">
												<option value="yes" <?php echo ( $whiteSpaces != 'no' )?'selected="selected"':'';?> ><?php esc_html_e( 'Add background (default)', 'otw_bm');?></option>
												<option value="no" <?php echo ( $whiteSpaces == 'no' )?'selected="selected"':'';?> ><?php esc_html_e( 'Don\'t add background', 'otw_bm');?></option>
											</select>
											<p class="description"><?php esc_html_e('This option will affect only images which original size is smaller than the desired size. \'Add background\' will add background to complete the image size to the desired image size. \'Don\'t add background\' will not add background and it will leave the images as they originally are.', 'otw_bm');?></p>
										</td>
									</tr>
									<tr valign="top" id="white_spaces_color_container">
										<th scope="row">
											<label for="white_spaces_color"><?php esc_html_e('Image Background Color:', 'otw_bm');?></label>
										</th>
										<td>
											<?php
												if( empty( $content['white_spaces_color'] ) ){
													$content['white_spaces_color'] = '#FFFFFF';
												}
											?>
											<div class="otw-bm-color-picker">
												<div class="js-color-picker-icon js-color-picker">
													<div class="js-color-container" style="background-color: <?php echo $content['white_spaces_color'];?>;"></div>
												</div>
												<input type="text" name="white_spaces_color" class="js-color-picker-value" value="<?php echo esc_attr( $content['white_spaces_color'] );?>"/>
											</div>
											<!-- END Excpert Font Color -->
											<p class="description"><?php esc_html_e('The extra background color to complete the image to the desired size.', 'otw_bm'); ?></p>
										</td>
									</tr>
									<tr valign="top">
										<th scope="row">
											<label for="thumb_alt_attr"><?php esc_html_e('Add alt tag', 'otw_bm');?></label>
										</th>
										<td>
											<?php ( empty($content['thumb_alt_attr']) )? $thumb_alt_attr = 'no' : $thumb_alt_attr = $content['thumb_alt_attr']; ?>
											<select name="thumb_alt_attr" id="thumb_alt_attr">
												<option value="no" <?php echo ( $thumb_alt_attr == 'no' )?'selected="selected"':'';?> ><?php esc_html_e( 'No (default)', 'otw_bm');?></option>
												<option value="media_settings" <?php echo ( $thumb_alt_attr == 'media_settings' )?'selected="selected"':'';?> ><?php esc_html_e( 'Use what is set in the Media Library', 'otw_bm');?></option>
											</select>
											<p class="description"><?php esc_html_e('The alt tag helps position your images in search engines.', 'otw_bm');?></p>
										</td>
									</tr>
									<tr valign="top">
										<th scope="row">
											<label for="thumb_title_attr"><?php esc_html_e('Add title tag', 'otw_bm');?></label>
										</th>
										<td>
											<?php ( empty($content['thumb_title_attr']) )? $thumb_title_attr = 'no' : $thumb_title_attr = $content['thumb_title_attr']; ?>
											<select name="thumb_title_attr" id="thumb_title_attr">
												<option value="no" <?php echo ( $thumb_title_attr == 'no' )?'selected="selected"':'';?> ><?php esc_html_e( 'No (default)', 'otw_bm');?></option>
												<option value="media_settings" <?php echo ( $thumb_title_attr == 'media_settings' )?'selected="selected"':'';?> ><?php esc_html_e( 'Use what is set in the Media Library', 'otw_bm');?></option>
											</select>
											<p class="description"><?php esc_html_e('The title tag helps position your images in search engines and is displayed on hover of the image.', 'otw_bm');?></p>
										</td>
									</tr>

									<tr>
										<th scope="row">
											<label for="meta_order"><?php esc_html_e('Meta Elements and Order', 'otw_bm');?></label>
										</th>
										<td>
											<div class="active_elements">
												<h3><?php esc_html_e('Active Elements', 'otw_bm');?></h3>
												<input type="hidden" name="meta-items" class="js-meta-items" value="<?php echo esc_attr( $content['meta-items'] );?>"/>
												<ul class="b-meta-box js-meta-active">
												</ul>
											</div>
											<div class="inactive_elements">
												<h3><?php esc_html_e('Inactive Elements', 'otw_bm');?></h3>
												<ul class="b-meta-box js-meta-inactive">
													<li data-item="meta" data-value="author" class="b-meta-items js-meta--item"><?php esc_html_e('author', 'otw_bm');?></li>
													<li data-item="meta" data-value="date" class="b-meta-items js-meta--item"><?php esc_html_e('date', 'otw_bm');?></li>
													<li data-item="meta" data-value="category" class="b-meta-items js-meta--item"><?php esc_html_e('category', 'otw_bm');?></li>
													<li data-item="meta" data-value="tags" class="b-meta-items js-meta--item"><?php esc_html_e('tags', 'otw_bm');?></li>
													<li data-item="meta" data-value="comments" class="b-meta-items js-meta--item"><?php esc_html_e('comments', 'otw_bm');?></li>
												</ul>
											</div>
											<p class="description"><?php esc_html_e('Drag & drop the items that you\'d like to show in the Active Elements area on the left. Arrange them however you want to see them in your list.', 'otw_bm');?></p>
										</td>
									</tr>

									<tr valign="top">
										<th scope="row">
											<label for="meta_type_align"><?php esc_html_e('Meta Type:', 'otw_bm');?></label>
										</th>
										<td>
											<select name="meta_type_align" id="meta_type_align">
											<?php 
											foreach( $selectMetaData as $optionData ): 
												$selected = '';
												if( $optionData['value'] === $content['meta_type_align'] ) {
													$selected = 'selected="selected"';
												}
												echo "<option value=\"".$optionData['value']."\" ".$selected.">".$optionData['text']."</option>";
												
											endforeach;
											?>
											</select>
											<p class="description"><?php esc_html_e('Choose between horizontal and vertical meta style.', 'otw_bm');?></p>
										</td>
									</tr>
									<tr valign="top">
										<th scope="row">
											<label for="meta_icons"><?php esc_html_e('Meta Icons:', 'otw_bm');?></label>
										</th>
										<td>
											<?php
												$yes = ''; $no = ''; 
												($content['meta_icons'])? $yes = 'checked="checked"' : $no = 'checked="checked"'; 
											?>
											<input type="radio" name="meta_icons" id="meta_icons-no" value="0" <?php echo $no;?>/> 
											<label for="meta_icons-no"><?php esc_html_e('No (default)', 'otw_bm');?></label>

											<input type="radio" name="meta_icons" id="meta_icons-yes" value="1" <?php echo $yes;?>/> 
											<label for="meta_icons-yes"><?php esc_html_e('Yes', 'otw_bm');?></label>
											<p class="description"><?php esc_html_e('Choose yes if you want to have icons instead of labels in your meta.', 'otw_bm');?>
										</td>
									</tr>
								</tbody>
							</table>
						</div> <!-- .inside -->
					</div><!-- .accordion-section-content -->

				</li><!-- .accordion-section -->
				<!-- END Settings -->


				<!-- Style Tab -->
				<li class="control-section accordion-section add-page top">
					<h3 class="accordion-section-title hndl" tabindex="4" title="<?php esc_html_e('Styles', 'otw_bm');?>"><?php esc_html_e('Styles', 'otw_bm');?></h3>
					<div class="accordion-section-content" style="display: none;">
						<div class="inside">
							<table class="form-table">
								<tbody>
									<tr valign="top">
										<th scope="row">
											<label for="blog_list_title"><?php esc_html_e('Title Style:', 'otw_bm');?></label>
										</th>
										<td>
											<!-- Title Font Size -->
											<select name="title-font-size" id="title-font-size">
											<?php 
											foreach( $selectFontSizeData as $optionData ): 
												$selected = '';
												if( $optionData['value'] === $content['title-font-size'] ) {
													$selected = 'selected="selected"';
												}
												echo "<option value=\"".$optionData['value']."\" ".$selected.">".$optionData['text']."</option>";
												
											endforeach;
											?>
											</select>
											<!-- END Title Font Size -->

											<!-- Title Font Style -->
											<select name="title-font-style" id="title-font-style">
											<?php 
											foreach( $selectFontStyleData as $optionData ): 
												$selected = '';
												if( $optionData['value'] === $content['title-font-style'] ) {
													$selected = 'selected="selected"';
												}
												echo "<option value=\"".$optionData['value']."\" ".$selected.">".$optionData['text']."</option>";
												
											endforeach;
											?>
											</select>
											<!-- END Title Font Style -->

											<!-- Title Font Family -->
											<select name="title_font"  class="js-fonts" data-placeholder="<?php esc_attr_e( 'Font Family', 'otw_bm' )?>" data-value="<?php echo ( !empty( $content['title_font'] ) )? esc_attr( $content['title_font'] ):'';?>" data-allow-clear="true"></select>
											<!-- END Title Font Family -->

											<!-- Title Font Color -->
											<div class="otw-bm-color-picker">
												<div class="js-color-picker-icon js-color-picker">
													<div class="js-color-container" style="background-color: <?php echo $content['title-color'];?>;"></div>
												</div>
												<input type="text" name="title-color" class="js-color-picker-value" value="<?php echo esc_attr( $content['title-color'] );?>"/>
											</div>
											<!-- END Title Font Color -->
											<p class="description"><?php esc_html_e('Adjust the style of the Title of each post in your list', 'otw_bm'); ?></p>
										</td>
									</tr>
									<tr valign="top">
										<th scope="row">
											<label for="blog_list_title"><?php esc_html_e('Meta Items Style:', 'otw_bm');?></label>
										</th>
										<td>

											<!-- Meta Items Font Size -->
											<select name="meta-font-size" id="meta-font-size">
											<?php 
											foreach( $selectFontSizeData as $optionData ): 
												$selected = '';
												if( $optionData['value'] === $content['meta-font-size'] ) {
													$selected = 'selected="selected"';
												}
												echo "<option value=\"".$optionData['value']."\" ".$selected.">".$optionData['text']."</option>";
												
											endforeach;
											?>
											</select>
											<!-- END Meta Items Font Size -->

											<!-- Meta Font Style -->
											<select name="meta-font-style" id="meta-font-style">
											<?php 
											foreach( $selectFontStyleData as $optionData ): 
												$selected = '';
												if( $optionData['value'] === $content['meta-font-style'] ) {
													$selected = 'selected="selected"';
												}
												echo "<option value=\"".$optionData['value']."\" ".$selected.">".$optionData['text']."</option>";
												
											endforeach;
											?>
											</select>
											<!-- END Meta Font Style -->

											<!-- Title Font Family -->
											<select name="meta_font"  class="js-fonts" data-placeholder="<?php esc_attr_e( 'Font Family', 'otw_bm' )?>" data-value="<?php echo ( !empty( $content['meta_font'] ) )? esc_attr( $content['meta_font'] ):'';?>" data-allow-clear="true"></select>
											<!-- END Meta Font Family -->

											<!-- Meta Font Color -->
											<div class="otw-bm-color-picker">
												<div class="js-color-picker-icon js-color-picker">
													<div class="js-color-container" style="background-color: <?php echo $content['meta-color'];?>;"></div>
												</div>
												<input type="text" name="meta-color" class="js-color-picker-value" value="<?php echo esc_attr( $content['meta-color'] );?>"/>
											</div>
											<!-- END Meta Font Color -->

											<p class="description"><?php esc_html_e('Adjust the style of the Meta Items (e.g.: Author, Comments) of each post in your list', 'otw_bm'); ?></p>
										</td>
									</tr>
									<tr valign="top">
										<th scope="row">
											<label for="blog_list_title"><?php esc_html_e('Excpert Style:', 'otw_bm');?></label>
										</th>
										<td>
											<!-- Excpert Font Size -->
											<select name="excpert-font-size" id="meta-font-size">
											<?php 
											foreach( $selectFontSizeData as $optionData ): 
												$selected = '';
												if( $optionData['value'] === $content['excpert-font-size'] ) {
													$selected = 'selected="selected"';
												}
												echo "<option value=\"".$optionData['value']."\" ".$selected.">".$optionData['text']."</option>";
												
											endforeach;
											?>
											</select>
											<!-- END Excpert Font Size -->

											<!-- Excpert Font Style -->
											<select name="excpert-font-style" id="excpert-font-style">
											<?php 
											foreach( $selectFontStyleData as $optionData ): 
												$selected = '';
												if( $optionData['value'] === $content['excpert-font-style'] ) {
													$selected = 'selected="selected"';
												}
												echo "<option value=\"".$optionData['value']."\" ".$selected.">".$optionData['text']."</option>";
												
											endforeach;
											?>
											</select>
											<!-- END Excpert Font Style -->

											<!-- Excpert Font Family -->
											<select name="excpert_font"  class="js-fonts" data-placeholder="<?php esc_attr_e( 'Font Family', 'otw_bm' )?>" data-value="<?php echo ( !empty( $content['excpert_font'] ) )? esc_attr( $content['excpert_font'] ):'';?>" data-allow-clear="true"></select>
											<!-- END Excpert Font Family -->

											<!-- Excpert Font Color -->
											<div class="otw-bm-color-picker">
												<div class="js-color-picker-icon js-color-picker">
													<div class="js-color-container" style="background-color: <?php echo $content['excpert-color'];?>;"></div>
												</div>
												<input type="text" name="excpert-color" class="js-color-picker-value" value="<?php echo esc_attr( $content['excpert-color'] );?>"/>
											</div>
											<!-- END Excpert Font Color -->
											<p class="description"><?php esc_html_e('Adjust the style of the Excpert of each post in your list', 'otw_bm'); ?></p>
										</td>
									</tr>
									<tr valign="top">
										<th scope="row">
											<label for="blog_list_title"><?php esc_html_e('Continue Reading Style:', 'otw_bm');?></label>
										</th>
										<td>
											<!-- Excpert Font Size -->
											<select name="read-more-font-size" id="meta-font-size">
											<?php 
											foreach( $selectFontSizeData as $optionData ): 
												$selected = '';
												if( $optionData['value'] === $content['read-more-font-size'] ) {
													$selected = 'selected="selected"';
												}
												echo "<option value=\"".$optionData['value']."\" ".$selected.">".$optionData['text']."</option>";
												
											endforeach;
											?>
											</select>
											<!-- END Excpert Font Size -->

											<!-- Excpert Font Style -->
											<select name="read-more-font-style" id="read-more-font-style">
											<?php 
											foreach( $selectFontStyleData as $optionData ): 
												$selected = '';
												if( $optionData['value'] === $content['read-more-font-style'] ) {
													$selected = 'selected="selected"';
												}
												echo "<option value=\"".$optionData['value']."\" ".$selected.">".$optionData['text']."</option>";
												
											endforeach;
											?>
											</select>
											<!-- END Excpert Font Style -->

											<!-- Excpert Font Family -->
											<select name="read-more_font"  class="js-fonts" data-placeholder="<?php esc_attr_e( 'Font Family', 'otw_bm' )?>" data-value="<?php echo ( !empty( $content['read-more_font'] ) )? esc_attr( $content['read-more_font'] ):'';?>" data-allow-clear="true"></select>
											<!-- END Excpert Font Family -->

											<!-- Excpert Font Color -->
											<div class="otw-bm-color-picker">
												<div class="js-color-picker-icon js-color-picker">
													<div class="js-color-container" style="background-color: <?php echo $content['read-more-color'];?>;"></div>
												</div>
												<input type="text" name="read-more-color" class="js-color-picker-value" value="<?php echo esc_attr( $content['read-more-color'] );?>"/>
											</div>
											<!-- END Excpert Font Color -->
											<p class="description"><?php esc_html_e('Adjust the style of the Continue Reading of each post in your list', 'otw_bm'); ?></p>
										</td>
									</tr>
									<tr valign="top">
										<th scope="row">
											<label for="border-style"><?php esc_html_e('Border Style:', 'otw_bm');?></label>
										</th>
										<td>
											<!--  Font Size -->
											<select name="border-style" id="border-style">
											<?php 
											foreach( $selectBorderStyleData as $optionData ): 
												$selected = '';
												if( $optionData['value'] === $content['border-style'] ) {
													$selected = 'selected="selected"';
												}
												echo "<option value=\"".$optionData['value']."\" ".$selected.">".$optionData['text']."</option>";
												
											endforeach;
											?>
											</select>
											<select name="border-size" id="border-size">
											<?php 
											foreach( $selectBorderSizeData as $optionData ): 
												$selected = '';
												if( $optionData['value'] === $content['border-size'] ) {
													$selected = 'selected="selected"';
												}
												echo "<option value=\"".$optionData['value']."\" ".$selected.">".$optionData['text']."</option>";
												
											endforeach;
											?>
											</select>
											<div class="otw-bm-color-picker">
												<div class="js-color-picker-icon js-color-picker">
													<div class="js-color-container" style="background-color: <?php echo $content['border-color'];?>;"></div>
												</div>
												<input type="text" name="border-color" class="js-color-picker-value" value="<?php echo esc_attr( $content['border-color'] );?>"/>
											</div>
											<p class="description"><?php esc_html_e('Adjust the style of the Border from the Lists elements and order tab.', 'otw_bm'); ?></p>
										</td>
									</tr>
									<tr valign="top">
										<th scope="row">
											<label for="background-color"><?php esc_html_e('Background Color:', 'otw_bm');?></label>
										</th>
										<td>
											<div class="otw-bm-color-picker">
												<div class="js-color-picker-icon js-color-picker">
													<div class="js-color-container" style="background-color: <?php echo $content['background-color'];?>;"></div>
												</div>
												<input type="text" name="background-color" class="js-color-picker-value" value="<?php echo esc_attr( $content['background-color'] );?>"/>
											</div>
											<p class="description"><?php esc_html_e('Adjust the style of the Background from the Lists elements and order tab.', 'otw_bm'); ?></p>
										</td>
									</tr>
									<tr valign="top">
										<th scope="row">
											<label for="background-color-opacity"><?php esc_html_e('Background Opacity:', 'otw_bm');?></label>
										</th>
										<td>
											<input type="text" name="background-color-opacity" id="background-color-opacity" size="4" value="<?php echo esc_attr( $content['background-color-opacity'] );?>" />
											<p class="description"><?php esc_html_e('The opacity of the background. Could be between 0 and 1. For example 0.61. Leave empty for not opacity', 'otw_bm');?></p>
										</td>
									</tr>
									<tr valign="top">
										<th scope="row">
											<label for="blog_list_title"><?php esc_html_e('Custom CSS:', 'otw_bm');?></label>
										</th>
										<td>
											<textarea name="custom_css" cols="70" rows="10"><?php echo esc_textarea( str_replace('\\', '', $content['custom_css']) );?></textarea>
										</td>
									</tr>

								</tbody>
							</table>
						</div> <!-- .inside -->
					</div><!-- .accordion-section-content -->

				</li><!-- .accordion-section -->
				<!-- Style Tab -->

				<!-- Query Selection Tab -->
				<li class="control-section accordion-section add-page top">
					<h3 class="accordion-section-title hndl" tabindex="5" title="<?php esc_attr_e('Post Selection Method - Advanced Users', 'otw_bm');?>">
						<?php esc_html_e('Post Selection Method - Advanced Users', 'otw_bm');?>
					</h3>
					<div class="accordion-section-content" style="display: none;">
						<div class="inside">

							<table class="form-table">
								<tbody>
									<tr valign="top">
										<th scope="row">
											<label for="blog_list_title">
												<?php esc_html_e('Between Categories and Tags result-sets Selection Method:', 'otw_bm');?>
											</label>
										</th>
										<td>
											<!-- Category / Tag relation -->
											<select name="cat-tag-relation" id="cat-tag-relation">
											<?php 
											foreach( $selectCategoryTagRelation as $optionData ): 
												$selected = '';
												if( $optionData['value'] === $content['cat-tag-relation'] ) {
													$selected = 'selected="selected"';
												}
												echo "<option value=\"".$optionData['value']."\" ".$selected.">".$optionData['text']."</option>";
												
											endforeach;
											?>
											</select>
											<!-- END Category / Tag relation -->
											<p class="description">
												<?php esc_html_e('categories OR tags means: WHERE post_id IN categories-result-set OR post_id IN tags-result-set. In other words your list will include all posts that are in categories-result-set or tags-result-set.', 'otw_bm'); ?>
											</p>
											<p class="description">
												<?php esc_html_e('categories AND tags means: WHERE post_id IN categories-result-set AND post_id IN tags-result-set. In other words your list will include all posts that are in both result-sets categories-result-set and tags-result-set in the same time (If a post is only in categories-result-set, it will not be included in the list).', 'otw_bm'); ?>
											</p>
										</td>
									</tr>
									<tr valign="top">
										<th scope="row">
											<label for="author-relation">
												<?php esc_html_e('Before Authors result-set Selection Method:', 'otw_bm');?>
											</label>
										</th>
										<td>
											<select name="author-relation" id="author-relation">
												<option value="or" <?php echo ( isset( $content['author-relation'] ) && ( $content['author-relation'] === 'or' ) )?'selected="selected"':''?>><?php esc_html_e( 'OR authors', 'otw_bm' )?></option>
												<option value="and" <?php echo ( !isset( $content['author-relation'] ) || ( $content['author-relation'] !== 'or' ) )?'selected="selected"':''?>><?php esc_html_e( 'AND authors(default)', 'otw_bm' )?></option>
											</select>
											<p class="description">
												<?php esc_html_e( 'AND authors means: WHERE post_id IN categories-and-tags-result-set AND post_id IN authors -result-set. In other words your list will include all posts that are in both result-sets categories-and-tags-result-set and authors-result-set in the same time (If a post is only in categories-and-tags-result-set, it will not be included in the list).', 'otw_bm'); ?>
											</p>
											<p class="description">
												<?php esc_html_e('OR authors means: WHERE post_id IN categories-and-tags-result-set OR post_id IN authors-result-set. In other words your list will include all posts that are in result-sets categories-and-tags-result-set or authors-result-set.', 'otw_bm'); ?>
											</p>
										</td>
									</tr>
								</tbody>
							</table>

						</div>
					</div>
				</li>
				<!-- End Query Selection Tab -->

				<!-- Mosaic Settings Tab -->
				<?php
				$mosaicSettings = 'otw-admin-hidden';
				if( !empty($content['template']) && ( $content['template'] == '1-3-mosaic' || $content['template'] == '1-4-mosaic') ) {
					$mosaicSettings = '';
				}
				?>
				<li class="control-section accordion-section add-page top js-mosaic-settings <?php echo $mosaicSettings;?>">
					<h3 class="accordion-section-title hndl" tabindex="4" title="<?php esc_attr_e('Mosaic Settings', 'otw_bm');?>"><?php esc_html_e('Mosaic Settings', 'otw_bm');?></h3>
					<div class="accordion-section-content" style="display: none;">
						<div class="inside">
							<table class="form-table">
								<tbody>
									<tr valign="top">
										<th scope="row">
											<label for="blog_list_title"><?php esc_html_e('Space Tiles:', 'otw_bm');?></label>
										</th>
										<td>
											<?php
												$yes = ''; $no = ''; 
												($content['space-tiles'])? $yes = 'checked="checked"' : $no = 'checked="checked"'; 
											?>
											<input type="radio" name="space-tiles" id="space-tiles-no" value="0" <?php echo $no;?> /> 
											<label for="space-tiles-no"><?php esc_html_e('No (default)', 'otw_bm');?></label>

											<input type="radio" name="space-tiles" id="space-tiles-yes" value="1" <?php echo $yes;?> /> 
											<label for="space-tiles-yes"><?php esc_html_e('Yes', 'otw_bm');?></label>

											<p class="description"><?php esc_html_e('Add Space between the Mosaic Tiles.', 'otw_bm');?></p>
										</td>
									</tr>
									<tr valign="top">
										<th scope="row">
											<label for="meta_type"><?php esc_html_e('Display Blog List Items as Hover:', 'otw_bm');?></label>
										</th>
										<td>
											<?php
												$yes = ''; $no = ''; 
												($content['mosaic-content'])? $yes = 'checked="checked"' : $no = 'checked="checked"'; 
											?>
											<input type="radio" name="mosaic-content" id="mosaic-content-no" value="0" <?php echo $no;?> /> 
											<label for="mosaic-content-no"><?php esc_html_e('No', 'otw_bm');?></label>

											<input type="radio" name="mosaic-content" id="mosaic-content-yes" value="1" <?php echo $yes;?> /> 
											<label for="mosaic-content-yes"><?php esc_html_e('Yes (default)', 'otw_bm');?></label>
											<p class="description"><?php esc_html_e('Enable the Blog List Items as Hover.', 'otw_bm');?></p>
										</td>
									</tr>

									<tr valign="top">
										<th scope="row">
											<label for="show-mosaic-cat-filter-yes"><?php esc_html_e('Show Category Filter:', 'otw_bm');?></label>
										</th>
										<td>
											<?php
												$yes = ''; $no = ''; 
												($content['show-mosaic-cat-filter'])? $yes = 'checked="checked"' : $no = 'checked="checked"'; 
											?>
											<input type="radio" name="show-mosaic-cat-filter" id="show-mosaic-cat-filter-no" value="0" <?php echo $no;?> /> 
											<label for="show-mosaic-cat-filter-no"><?php esc_html_e('No', 'otw_bm');?></label>

											<input type="radio" name="show-mosaic-cat-filter" id="show-mosaic-cat-filter-yes" value="1" <?php echo $yes;?> /> 
											<label for="show-mosaic-cat-filter-yes"><?php esc_html_e('Yes (default)', 'otw_bm');?></label>

											<p class="description"><?php esc_html_e('Enable the Category filter on top of your list.', 'otw_bm');?></p>
										</td>
									</tr>

									<tr valign="top">
										<th scope="row">
											<label for="show-mosaic-sort-filter-yes"><?php esc_html_e('Show Sort Filter:', 'otw_bm');?></label>
										</th>
										<td>
											<?php
												$yes = ''; $no = ''; 
												($content['show-mosaic-sort-filter'])? $yes = 'checked="checked"' : $no = 'checked="checked"'; 
											?>
											<input type="radio" name="show-mosaic-sort-filter" id="show-mosaic-sort-filter-no" value="0" <?php echo $no;?> /> 
											<label for="show-mosaic-sort-filter-no"><?php esc_html_e('No', 'otw_bm');?></label>

											<input type="radio" name="show-mosaic-sort-filter" id="show-mosaic-sort-filter-yes" value="1" <?php echo $yes;?> /> 
											<label for="show-mosaic-sort-filter-yes"><?php esc_html_e('Yes (default)', 'otw_bm');?></label>

											<p class="description"><?php esc_html_e('Enable the Sort filter on top of your list.', 'otw_bm');?></p>
										</td>
									</tr>

								</tbody>
							</table>
						</div> <!-- .inside -->
					</div><!-- .accordion-section-content -->

				</li><!-- .accordion-section -->
				<!-- Mosaic Settings Tab -->

				<!-- Horizontal Tab -->
				<?php
				$horizontalSettings = 'otw-admin-hidden';
				if( !empty($content['template']) && ( $content['template'] == 'horizontal-layout' ) ) {
					$horizontalSettings = '';
				}
				?>
				<li class="control-section accordion-section add-page top js-horizontal-settings <?php echo $horizontalSettings;?>">
					<h3 class="accordion-section-title hndl" tabindex="4" title="<?php esc_attr_e('Horizontal Layout Settings', 'otw_bm');?>">
						<?php esc_html_e('Horizontal Layout Settings', 'otw_bm');?>
					</h3>
					<div class="accordion-section-content" style="display: none;">
						<div class="inside">
							<table class="form-table">
								<tbody>
									<tr valign="top">
										<th scope="row">
											<label for="horizontal-space-tiles-no"><?php esc_html_e('Space Tiles:', 'otw_bm');?></label>
										</th>
										<td>
											<?php
												$yes = ''; $no = ''; 
												($content['horizontal-space-tiles'])? $yes = 'checked="checked"' : $no = 'checked="checked"'; 
											?>
											<input type="radio" name="horizontal-space-tiles" id="horizontal-space-tiles-no" value="0" <?php echo $no;?> /> 
											<label for="horizontal-space-tiles-no"><?php esc_html_e('No (default)', 'otw_bm');?></label>

											<input type="radio" name="horizontal-space-tiles" id="horizontal-space-tiles-yes" value="1" <?php echo $yes;?> /> 
											<label for="horizontal-space-tiles-yes"><?php esc_html_e('Yes', 'otw_bm');?></label>

											<p class="description"><?php esc_html_e('Add Space between the Tiles.', 'otw_bm');?></p>
										</td>
									</tr>
									<tr valign="top">
										<th scope="row">
											<label for="horizontal-content-no"><?php esc_html_e('Display Blog List Items as Hover:', 'otw_bm');?></label>
										</th>
										<td>
											<?php
												$yes = ''; $no = ''; 
												($content['horizontal-content'])? $yes = 'checked="checked"' : $no = 'checked="checked"'; 
											?>
											<input type="radio" name="horizontal-content" id="horizontal-content-no" value="0" <?php echo $no;?> /> 
											<label for="horizontal-content-no"><?php esc_html_e('No', 'otw_bm');?></label>

											<input type="radio" name="horizontal-content" id="horizontal-content-yes" value="1" <?php echo $yes;?> /> 
											<label for="horizontal-content-yes"><?php esc_html_e('Yes (default)', 'otw_bm');?></label>
											<p class="description"><?php esc_html_e('Enable the Blog List Items as Hover.', 'otw_bm');?></p>
										</td>
									</tr>
								</tbody>
							</table>
						</div> <!-- .inside -->
					</div><!-- .accordion-section-content -->

				</li><!-- .accordion-section -->
				<!-- Horizontal Slider Tab -->

				<!-- Slider Settings Tab -->
				<?php
				$sliderSettings = 'otw-admin-hidden';
	      $sliderArray = array(
	        'slider', '3-column-carousel', '4-column-carousel', '5-column-carousel',
	        '2-column-carousel-wid', '3-column-carousel-wid', '4-column-carousel-wid'
	      );
				if( !empty($content['template']) && in_array( $content['template'], $sliderArray ) ) {
					$sliderSettings = '';
				}
				?>
				<li class="control-section accordion-section  add-page top js-slider-settings <?php echo $sliderSettings; ?>">
					<h3 class="accordion-section-title hndl" tabindex="4" title="<?php esc_attr_e('Slider and Carousel Settings', 'otw_bm');?>">
						<?php esc_html_e('Slider and Carousel Settings', 'otw_bm');?>
					</h3>
					<div class="accordion-section-content" style="display: none;">
						<div class="inside">
							<table class="form-table">
								<tbody>
									<tr valign="top">
										<th scope="row">
											<label for="slider_title"><?php esc_html_e('Enable Title and Excerpt:', 'otw_bm');?></label>
										</th>
										<td>
											<?php
												$yes = ''; $no = ''; 
												($content['show-slider-title'])? $yes = 'checked="checked"' : $no = 'checked="checked"'; 
											?>
											<input type="radio" name="show-slider-title" id="show-slider-title-no" value="0" <?php echo $no;?> /> 
											<label for="show-slider-title-no"><?php esc_html_e('No', 'otw_bm');?></label>

											<input type="radio" name="show-slider-title" id="show-slider-title-yes" value="1" <?php echo $yes;?> /> 
											<label for="show-slider-title-yes"><?php esc_html_e('Yes (default)', 'otw_bm');?></label>

											<p class="description"><?php esc_html_e('Displays the post title and excerpt as caption for the slider. Displays only the post title for Carousel Templates. This will not affect the Widget Carousel Templates.', 'otw_bm');?></p>
										</td>
									</tr>

									<tr valign="top">
										<th scope="row">
											<label for="slider_title_bg"><?php esc_html_e('Enable Title and Excerpt Background:', 'otw_bm');?></label>
										</th>
										<td>
											<?php
												$yes = ''; $no = ''; 
												($content['slider_title_bg'])? $yes = 'checked="checked"' : $no = 'checked="checked"'; 
											?>
											<input type="radio" name="slider_title_bg" id="slider_title_bg-no" value="0" <?php echo $no;?> /> 
											<label for="slider_title_bg-no"><?php esc_html_e('No', 'otw_bm');?></label>

											<input type="radio" name="slider_title_bg" id="slider_title_bg-yes" value="1" <?php echo $yes;?> /> 
											<label for="slider_title_bg-yes"><?php esc_html_e('Yes (default)', 'otw_bm');?></label>
											<p class="description"><?php esc_html_e('Enables a background for the title and excerpt. This will not affect the Widget Carousel Templates.', 'otw_bm');?></p>
										</td>
									</tr>

									<tr valign="top">
										<th scope="row">
											<label for="carousel-auto-scroll"><?php esc_html_e('Enable Auto Scroll:', 'otw_bm');?></label>
										</th>
										<td>
											<?php
												$yes = ''; $no = ''; 
												($content['slider-auto-scroll'])? $yes = 'checked="checked"' : $no = 'checked="checked"'; 
											?>
											<input type="radio" name="slider-auto-scroll" id="slider-auto-scroll-no" value="0" <?php echo $no;?> /> 
											<label for="slider-auto-scroll-no"><?php esc_html_e('No', 'otw_bm');?></label>

											<input type="radio" name="slider-auto-scroll" id="slider-auto-scroll-yes" value="1" <?php echo $yes;?> /> 
											<label for="slider-auto-scroll-yes"><?php esc_html_e('Yes (default)', 'otw_bm');?></label>

											<p class="description"><?php esc_html_e('Enables auto scroll.', 'otw_bm');?></p>
										</td>
									</tr>

									<tr valign="top">
										<th scope="row">
											<label for="slider_nav"><?php esc_html_e('Show Navigation:', 'otw_bm');?></label>
										</th>
										<td>
											<?php
												$yes = ''; $no = ''; 
												($content['slider_nav'])? $yes = 'checked="checked"' : $no = 'checked="checked"'; 
											?>
											<input type="radio" name="slider_nav" id="slider_nav-no" value="0" <?php echo $no;?> /> 
											<label for="slider_nav-no"><?php esc_html_e('No', 'otw_bm');?></label>

											<input type="radio" name="slider_nav" id="slider_nav-yes" value="1" <?php echo $yes;?> /> 
											<label for="slider_nav-yes"><?php esc_html_e('Yes (default)', 'otw_bm');?></label>

											<p class="description"><?php esc_html_e('Display arrows and bullet navigation for the slider and carousels. Note that when "Title and Excerpt" is enabled only the arrows navigation will be displayed.', 'otw_bm');?></p>
										</td>
									</tr>

									<tr valign="top">
										<th scope="row">
											<label for="slider_border"><?php esc_html_e('Show Border:', 'otw_bm');?></label>
										</th>
										<td>
											<?php
												$yes = ''; $no = ''; 
												($content['slider_border'])? $yes = 'checked="checked"' : $no = 'checked="checked"'; 
											?>
											<input type="radio" name="slider_border" id="slider_border-no" value="0" <?php echo $no;?> /> 
											<label for="slider_border-no"><?php esc_html_e('No (default)', 'otw_bm');?></label>

											<input type="radio" name="slider_border" id="slider_border-yes" value="1" <?php echo $yes;?> /> 
											<label for="slider_border-yes"><?php esc_html_e('Yes', 'otw_bm');?></label>

											<p class="description"><?php esc_html_e('This will add 1px border to the slider and carousels container. This will not affect the Widget Carousel Templates.', 'otw_bm');?></p>
										</td>
									</tr>

									<tr valign="top">
										<th scope="row">
											<label for="slider_title_alignment"><?php esc_html_e('Title and Excerpt Alignment:', 'otw_bm');?></label>
										</th>
										<td>
											<select id="slider_title_alignment" name="slider_title_alignment">
											<?php 
											foreach( $selectSliderAlignmentData as $optionData ): 
												$selected = '';
												if( $optionData['value'] === $content['slider_title_alignment'] ) {
													$selected = 'selected="selected"';
												}
												echo "<option value=\"".$optionData['value']."\" ".$selected.">".$optionData['text']."</option>";
												
											endforeach;
											?>
											</select>

											<p class="description"><?php esc_html_e('Choose the alignment for the title and excerpt. This will not affect the Widget Carousel Templates.', 'otw_bm');?></p>
										</td>
									</tr>
								</tbody>
							</table>
						</div> <!-- .inside -->
					</div><!-- .accordion-section-content -->

				</li><!-- .accordion-section -->
				<!-- Slider Settings Tab -->

				<!-- News Settings Tab -->
				<?php
				$newsSettings = 'otw-admin-hidden';
				if( !empty($content['template']) && strpos($content['template'], 'news') ) {
					$newsSettings = '';
				}
				?>
				<li class="control-section accordion-section  add-page top js-news-settings <?php echo $newsSettings; ?>">
					<h3 class="accordion-section-title hndl" tabindex="4" title="<?php esc_attr_e('Newspaper Settings', 'otw_bm');?>"><?php esc_html_e('Newspaper Settings', 'otw_bm');?></h3>
					<div class="accordion-section-content" style="display: none;">
						<div class="inside">
							<table class="form-table">
								<tbody>
									<tr valign="top">
										<th scope="row">
											<label for="slider_title"><?php esc_html_e('Show Category Filter:', 'otw_bm');?></label>
										</th>
										<td>
											<?php
												$yes = ''; $no = ''; 
												($content['show-news-cat-filter'])? $yes = 'checked="checked"' : $no = 'checked="checked"'; 
											?>
											<input type="radio" name="show-news-cat-filter" id="show-news-cat-filter-no" value="0" <?php echo $no;?> /> 
											<label for="show-news-cat-filter-no"><?php esc_html_e('No', 'otw_bm');?></label>

											<input type="radio" name="show-news-cat-filter" id="show-news-cat-filter-yes" value="1" <?php echo $yes;?> /> 
											<label for="show-news-cat-filter-yes"><?php esc_html_e('Yes (default)', 'otw_bm');?></label>

											<p class="description"><?php esc_html_e('Enable the Category filter on top of your list.', 'otw_bm');?></p>
										</td>
									</tr>

									<tr valign="top">
										<th scope="row">
											<label for="slider_title"><?php esc_html_e('Show Sort Filter:', 'otw_bm');?></label>
										</th>
										<td>
											<?php
												$yes = ''; $no = ''; 
												($content['show-news-sort-filter'])? $yes = 'checked="checked"' : $no = 'checked="checked"'; 
											?>
											<input type="radio" name="show-news-sort-filter" id="show-news-sort-filter-no" value="0" <?php echo $no;?> /> 
											<label for="show-news-sort-filter-no"><?php esc_html_e('No', 'otw_bm');?></label>

											<input type="radio" name="show-news-sort-filter" id="show-news-sort-filter-yes" value="1" <?php echo $yes;?> /> 
											<label for="show-news-sort-filter-yes"><?php esc_html_e('Yes (default)', 'otw_bm');?></label>

											<p class="description"><?php esc_html_e('Enable the Category filter on top of your list.', 'otw_bm');?></p>
										</td>
									</tr>
								</tbody>
							</table>
						</div> <!-- .inside -->
					</div><!-- .accordion-section-content -->

				</li><!-- .accordion-section -->
				<!-- END News Settings Tab -->

			</ul><!-- .outer-border -->
			
		</div>

		<p class="submit">
			<?php wp_nonce_field( 'otw_bm_save_list', '_otw_bm_wpnonce' );?>
			<input type="submit" value="<?php esc_html_e( 'Save', 'otw_bm') ?>" name="submit-otw-bm" class="button button-primary button-hero"/>
		</p>

	</form>

<div class="live_preview js-preview"></div>