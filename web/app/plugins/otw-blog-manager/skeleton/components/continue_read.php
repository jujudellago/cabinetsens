<div class="otw_blog_manager-blog-content">
<a href="<?php echo esc_attr( get_permalink($post->ID) );?>" class="otw_blog_manager-blog-continue-reading">
  <?php 
    (!empty($this->listOptions['continue_reading']))?  $read_link = $this->listOptions['continue_reading'] : $read_link = esc_html_e('Continue reading →', 'otw_bm');
    echo $read_link;
  ?>
</a>
</div>