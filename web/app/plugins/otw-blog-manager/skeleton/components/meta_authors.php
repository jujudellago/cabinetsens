<!-- Post Author -->
<div class="otw_blog_manager-blog-author">
  <?php if( !$this->listOptions['meta_icons'] ) : ?>
  <span class="head"><?php esc_html_e('By:', 'otw_bm');?></span>
  <?php else: ?>
  <span class="head"><i class="icon-user"></i></span>
  <?php endif; ?>

  <a href="<?php echo get_author_posts_url( $post->post_author ); ?>" title="<?php esc_attr_e('Posts by ', 'otw_bm'); the_author_meta('display_name', $post->post_author);?>" rel="author">
    <?php the_author_meta('display_name', $post->post_author); ?>
  </a>
</div>
<!-- End Post Author -->