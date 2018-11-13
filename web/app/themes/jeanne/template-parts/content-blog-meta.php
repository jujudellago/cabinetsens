<?php
/**
 * The template part for displaying blog meta
 * This must be used in the Loop
 *
 * @since 1.0.0
 */
?>

<?php

	$meta_info_display = jeanne_get_blog_meta_info_display();
	
	$author_display = true;
	if ( ! in_array( 'author', $meta_info_display ) ) {
		$author_display = false;
	}
	
	$comments_display = true;
	if ( ! in_array( 'comments', $meta_info_display ) ) {
		$comments_display = false;
	}

?>

<?php if ( $author_display || $comments_display ) : ?>

	<div class="post-meta-wrapper">
		
		<?php if ( $author_display ) : ?>
				
			<?php if ( is_home() || is_archive() ) : ?>
				<div class="meta-author">
					<span><?php echo esc_html__( 'Story by', 'jeanne' ); ?></span>
					<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">
						<?php the_author(); ?>
					</a>
				</div>
			<?php endif; ?>
			
		<?php endif; ?>
		
		
		<?php if ( $comments_display ) : ?>
					
			<?php if ( get_theme_mod( 'jeanne_ctmzr_settings_blog_enable_blog_comment', true ) && ! post_password_required() ) : ?>
				<div class="meta-comments">
					<span><?php echo esc_html__( 'Discussion', 'jeanne' ); ?></span>
					<?php comments_popup_link( esc_html__( 'No Comments', 'jeanne' ), esc_html__( '1 Comment', 'jeanne' ), esc_html__( '% Comments', 'jeanne' ) ); ?>
				</div>
			<?php endif; ?>
				
		<?php endif; ?>
		
	</div>

<?php endif; ?>