<?php
/**
 * The template to display the Structured Data Snippets
 *
 * @package WordPress
 * @subpackage CALLIE-BRITT
 * @since CALLIE-BRITT 1.0.30
 */

// Structured data snippets
if (callie_britt_is_on(callie_britt_get_theme_option('seo_snippets'))) {
	?><div class="structured_data_snippets">
		<meta content="<?php echo esc_attr(get_the_title()); ?>">
		<meta content="<?php echo esc_attr(get_the_date('Y-m-d')); ?>">
		<meta content="<?php echo esc_attr(get_the_modified_date('Y-m-d')); ?>">
		<div itemscope itemtype="https://schema.org/Organization">
			<meta content="<?php echo esc_attr(get_bloginfo( 'name' )); ?>">
			<meta content="">
			<meta content="">
			<?php
			$callie_britt_logo_image = callie_britt_get_logo_image();
			if (!empty($callie_britt_logo_image)) {
				?><meta itemtype="https://schema.org/ImageObject" content="<?php echo esc_url($callie_britt_logo_image); ?>"><?php
			}
			?>
		</div>
		<?php
		if ( callie_britt_get_theme_option('show_author_info')!=1 || !is_single() || is_attachment() || !get_the_author_meta('description') ) {	// || 	!is_multi_author()
			?><div itemscope itemtype="https://schema.org/Person">
				<meta content="<?php echo esc_attr(get_the_author()); ?>">
			</div><?php
		}
	?></div><?php
}
?>