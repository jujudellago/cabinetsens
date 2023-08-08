<?php
	$selectOptionData = array(
		array(
			'value' => 0,
			'text'	=> '------'
		),
		array(
			'value'	=> 'youtube',
			'text'	=> esc_html__('YouTube', 'otw_bm')
		),
		array(
			'value'	=> 'vimeo',
			'text'	=> esc_html__('Vimeo', 'otw_bm')
		),
		array(
			'value'	=> 'soundcloud',
			'text'	=> esc_html__('Sound Cloud', 'otw_bm')
		),
		array(
			'value'	=> 'img',
			'text'	=> esc_html__('Image', 'otw_bm')
		),
		array(
			'value'	=> 'slider',
			'text'	=> esc_html__('Slider', 'otw_bm')
		)
	);

	$imgTag 	= ''; // Image placeholder
	$img 			= 'otw-admin-hidden';
	$youtube 	= 'otw-admin-hidden';
	$vimeo 		= 'otw-admin-hidden';
	$soundcloud = 'otw-admin-hidden';
	$slider 	= 'otw-admin-hidden';
	$media 		= 'otw-admin-hidden';
	$audio 		= 'otw-admin-hidden';

	// Selected Media Type YouTube, Vimeo, SoundCloud, Image, Slider multiple images, Audio WP uploaded audio, Video
	( !empty( $otw_bm_meta_data['media_type'] ) )? $media_type = $otw_bm_meta_data['media_type'] : $media_type = 0;

	// Single Image Url
	( !empty( $otw_bm_meta_data['img_url'] ) )? $img_url = $otw_bm_meta_data['img_url'] : $img_url = '';

	// YouTube URL
	( !empty( $otw_bm_meta_data['youtube_url'] ) )? $youtube_url = $otw_bm_meta_data['youtube_url'] : $youtube_url = '';

	// Vimeo URL
	( !empty( $otw_bm_meta_data['vimeo_url'] ) )? $vimeo_url = $otw_bm_meta_data['vimeo_url'] : $vimeo_url = '';

	// SoundCloud URL
	( !empty( $otw_bm_meta_data['soundcloud_url'] ) )? $soundcloud_url = $otw_bm_meta_data['soundcloud_url'] : $soundcloud_url = '';

	// Uploaded Video URL - WP MP4
	( !empty( $otw_bm_meta_data['video_url'] ) )? $video_url = $otw_bm_meta_data['video_url'] : $video_url = '';

	// Uploaded Audio URL - WP MP3
	( !empty( $otw_bm_meta_data['audio_url'] ) )? $audio_url = $otw_bm_meta_data['audio_url'] : $audio_url = '';

	if( !empty( $otw_bm_meta_data['slider_url'] ) ) {
		$slider_url = $otw_bm_meta_data['slider_url'];
		$slider_imgs = explode(',', $slider_url);
	} else {
		$slider_url = '';
		$slider_imgs = array();
	}

	switch( $media_type ) {

		case ($media_type == 'img') :
			$img = '';
			$imgTag = '<img src="'.esc_attr( $img_url ).'" width="150" />';
		break;
		case ( $media_type == 'youtube' ) :
			$youtube = '';
		break;
		case ( $media_type == 'vimeo' ) :
			$vimeo = '';
		break;
		case ( $media_type == 'soundcloud' ) :
			$soundcloud = '';
		break;
		case ( $media_type == 'slider' ) :
			$slider = '';
		break;

	}
?>

<table class="form-table">
	<tbody>
		<!-- Select Drop Down -->
		<tr valign="top">
			<th scope="row"><label for="media_type"><?php esc_html_e('Choose Media Type', 'otw_bm');?></label></th>
			<td>
				<select id="media_type" name="otw-bm-list-media_type" class="js-otw-media-type">
					<?php 
					foreach( $selectOptionData as $optionData ): 
						$selected = '';
						if( $optionData['value'] === $media_type ) {
							$selected = 'selected="selected"';
						}
						echo "<option value=\"".$optionData['value']."\" ".$selected.">".$optionData['text']."</option>";
						
					endforeach;
					?>	
				</select>
			</td>
		</tr>
		<!-- Select Drop Down -->

		<!-- YouTube URL -->
		<tr valign="top" class="js-meta-youtube <?php echo $youtube;?>">
			<th scope="row"><label for="youtube_url"><?php esc_html_e('Enter YouTube URL', 'otw_bm');?></label></th>
			<td>
				<input type="text" id="youtube_url" name="otw-bm-list-youtube_url" class="js-otw-youtube-url" value="<?php echo esc_attr( $youtube_url ); ?>" size="53"/>
			</td>
		</tr>
		<!-- YouTube URL -->

		<!-- Vimeo URL -->
		<tr valign="top" class="js-meta-vimeo <?php echo $vimeo;?>">
			<th scope="row"><label for="vimeo_url"><?php esc_html_e('Enter Viemo URL', 'otw_bm');?></label></th>
			<td>
				<input type="text" id="vimeo_url" name="otw-bm-list-vimeo_url" class="js-otw-vimeo-url" value="<?php echo esc_attr( $vimeo_url ); ?>" size="53"/>
			</td>
		</tr>
		<!-- Vimeo URL -->

		<!-- ScoundCloud URL -->
		<tr valign="top" class="js-meta-soundcloud <?php echo $soundcloud;?>">
			<th scope="row"><label for="soundcloud_url"><?php esc_html_e('Enter SoundCloud URL', 'otw_bm');?></label></th>
			<td>
				<input type="text" id="soundcloud_url" name="otw-bm-list-soundcloud_url" class="js-otw-soundcloud-url" value="<?php echo esc_attr( $soundcloud_url ); ?>" size="53"/>
			</td>
		</tr>
		<!-- ScoundCloud URL -->

		<!-- Single Image -->
		<tr valign="top" class="js-meta-image <?php echo $img;?>">
			<th scope="row"><label for="img_upload"><?php esc_html_e('Select File', 'otw_bm');?></label></th>
			<td>
				<a href="#" class="js-add-image"><?php esc_html_e('Add File', 'otw_bm');?></a>
				<input type="hidden" name="otw-bm-list-img_url" class="js-img-url" value="<?php echo esc_attr( $img_url ); ?>" />
				<div class="js-img-preview"><?php echo otw_esc_text( $imgTag, 'cont' );?></div>
			</td>
		</tr>
		<!-- Single Image -->

		<!-- Slider -->
		<tr valign="top" class="js-meta-slider <?php echo $slider;?>">
			<th scope="row"><label for="slider"><?php esc_html_e('Slider Images', 'otw_bm');?></label></th>
			<td>
				<a href="#" class="js-add-image left"><?php esc_html_e('Add File', 'otw_bm');?></a><br/>
				<input type="hidden" name="otw-bm-list-slider_url" class="js-img-slider-url" value="<?php echo esc_attr( $slider_url ); ?>" size="53"/>
				<!-- Preview Items will be appended here -->
				<ul class="b-slider-preview left js-meta-slider-preview">
					<?php 

					foreach( $slider_imgs as $image ):
						?>
						<li class="b-slider__item" data-src="<?php echo esc_attr( $image ) ?>">
							<a href="#" class="b-delete_btn"></a>
							<img src="<?php echo esc_attr( $image ) ?>" width="100" />
						</li>
						<?php
					endforeach;
					?>
				</ul>
			</td>
		</tr>
		<!-- Slider -->

	</tbody>
	
</table>