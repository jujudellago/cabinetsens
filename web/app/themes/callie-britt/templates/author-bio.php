<?php
/**
 * The template to display the Author bio
 *
 * @package WordPress
 * @subpackage CALLIE-BRITT
 * @since CALLIE-BRITT 1.0
 */
?>

<div class="author_info scheme_dark author vcard" itemscope itemtype="http://schema.org/Person">

	<div class="author_avatar">
		<?php 
		$callie_britt_mult = callie_britt_get_retina_multiplier();
		echo get_avatar( get_the_author_meta( 'user_email' ), 120*$callie_britt_mult ); 
		?>
	</div><!-- .author_avatar -->

	<div class="author_description">
		<h5 class="author_title"><?php
			// Translators: Add the author's name in the <span> 
			echo wp_kses_data(sprintf(__('About %s', 'callie-britt'), '<span class="fn">'.get_the_author().'</span>'));
		?></h5>

		<div class="author_bio">
			<?php echo wp_kses_post(wpautop(get_the_author_meta( 'description' ))); ?>
			<a class="author_link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author"><?php
				// Translators: Add the author's name in the <span> 
				printf( esc_html__( 'View all posts by %s', 'callie-britt' ), '<span class="author_name">' . esc_html(get_the_author()) . '</span>' );
			?></a>
			<?php do_action('callie_britt_action_user_meta'); ?>
		</div><!-- .author_bio -->

	</div><!-- .author_description -->

</div><!-- .author_info -->
