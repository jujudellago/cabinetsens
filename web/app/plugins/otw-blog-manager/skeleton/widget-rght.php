<!-- Sidebar -->
<aside class="otw-twentyfour otw-columns otw_blog_manager-sidebar icon__small otw-bm-list-section" id="otw-bm-list-<?php echo $this->listOptions['id'];?>">
  <ul class="bm_clearfix">
    <li class="widget otw_blog_manager-widget-blog-latest right-image bm_clearfix">
      <?php echo $this->loadWidgetComp( 'list_title' ); ?>
      <ul class="bm_clearfix js-widget-list">
        <?php
          foreach( $otw_bm_posts->posts as $widgetPost ):
        ?>
        <li class="otw_blog_manager-format-image otw_blog_manager-blog-full otw-widget-content <?php echo $this->containerBG; ?> <?php echo $this->containerBorder; ?><?php echo $this->postClass( $widgetPost );?>">
          <?php echo $this->buildInterfaceBlogItems( $widgetPost ); ?>
          <?php echo $this->getDelimiter( $widgetPost ); ?>
        </li>
        <?php
          endforeach;
        ?>
      </ul>
    </li>
  </ul>

  <div class="js-otw_blog_manager-widget-pagination-holder">
    <?php echo $this->getWidgetPagination( $otw_bm_posts ); ?>
  </div>

</aside>
<!-- End Sidebar -->