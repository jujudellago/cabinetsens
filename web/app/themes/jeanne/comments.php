<?php

/**
 * The template for displaying comments and the comment form
 *
 * @since 1.0.0
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}

$no_comments_class = '';
if ( ! have_comments() ) {
 	$no_comments_class = 'no-comments';
}

?>

<section id="comments" class="<?php echo esc_attr( implode( ' ', array( 'comments content-section-wrapper content-width clearfix', $no_comments_class ) ) ); ?>">
	<div class="inner-content-section-wrapper">
			
		<h3 class="section-title"><?php comments_number( esc_html__( 'No Comments', 'jeanne' ), esc_html__( '1 Comment', 'jeanne' ), esc_html__( '% Comments', 'jeanne' ) ); ?></h3>
		<div class="section-content clearfix">
			
			<?php if ( have_comments() ) : ?>
				
				<ul class="comment-list">
					<?php
						wp_list_comments( array(
							'style'       => 'ul',
							'short_ping'  => true,
							'avatar_size' => 100,
							'callback'	  => 'jeanne_create_custom_comment',
						) );
					?>
				</ul>
				
				<?php 
				
					$type = get_theme_mod( 'jeanne_ctmzr_other_options_comment_navigation_type', 'next-prev' );
					
					if ( 'numbers' === $type ) {
							
						the_comments_pagination( array(
							'prev_text' => '<i class="fas fa-chevron-circle-left"></i><span class="screen-reader-text">' . esc_html__( 'Previous', 'jeanne' ) . '</span>',
							'next_text' => '<span class="screen-reader-text">' . esc_html__( 'Next', 'jeanne' ) . '</span><i class="fas fa-chevron-circle-right"></i>',
						) );
						
					} else {
						the_comments_navigation();
					}
				
				?>
				
			<?php endif; // End if ( have_comments() ) ?>
			
			<?php
				// If comments are closed and there are comments, let's leave a little note, shall we?
				if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
			?>
				<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'jeanne' ); ?></p>
			<?php endif; ?>
			
			<?php
				// Display a comment form
				comment_form( array(
					'title_reply_before' => '<h3 id="reply-title" class="comment-reply-title">',
					'title_reply_after'  => '</h3>',
				) );
			?>
			
		</div>
		
	</div>
</section>