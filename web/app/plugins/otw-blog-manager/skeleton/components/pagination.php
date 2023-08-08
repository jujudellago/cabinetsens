<?php 

if( $this->listOptions['show-pagination'] == 'pagination' && !empty( $this->listOptions['posts_limit_page'] ) ) :
  // If we have more then one Page, show pagination
  if( $otw_bm_posts->max_num_pages > 1 ) :

    $big = 99999;
    $currentPage = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
    if( !preg_match( "/^\d+$/", get_query_var( 'paged' ) ) && preg_match( "/^\d+$/", get_query_var( 'page' ) ) ){
    	$currentPage = ( get_query_var( 'page' ) )?get_query_var( 'page' ):1;
    }
    
    if( otw_get( 'bmi', false ) && preg_match( "/^\d+$/", otw_get( 'bmi', '' ) ) ){
    	
    		if( otw_get( 'bmi', '' ) != $this->listOptions['id'] ){
    			$currentPage = 1;
    		}
    }

    $pagedArgs = array(
      'base'          => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
      'format'        => '?paged=%#%',
      'current'       => max( 1, $currentPage ),
      'total'         => $otw_bm_posts->max_num_pages,
      'show_all'      => false,
      'end_size'      => 2,
      'mid_size'      => 3,
      'prev_next'     => true,
      'prev_text'     => esc_html__('« Previous', 'otw_bm'),
      'next_text'     => esc_html__('Next »', 'otw_bm'),
      'type'          => 'array',
      'add_args'      => array( 'bmi' => $this->listOptions['id'] ),
      'add_fragment'  => ''
    );  

    $pages = paginate_links( $pagedArgs );
?>
<div class="otw-row">
 <div class="otw-twentyfour otw-columns">
    <div class="otw_blog_manager-pagination">
      <span class="pages">
        <?php
          esc_html_e('Page', 'otw_bm');
          echo ' '.$currentPage.' ';
          esc_html_e('of', 'otw_bm');
          echo ' '.$otw_bm_posts->max_num_pages;
        ?>
      </span>
      <?php 
        foreach( $pages as $page ): 
          echo $page;
        endforeach;
      ?>
    </div>
  </div>
</div>
<?php 
  endif;
endif;
?>

<!-- Load More Pagination -->
<?php 
  $newsArray = array( '2-column-news', '3-column-news', '4-column-news', '1-3-mosaic', '1-4-mosaic' );

  $paginationClass = 'otw_blog_manager-pagination';
  $paginationLoadMore = 'otw_blog_manager-load-more';

  if( in_array( $this->listOptions['template'], $newsArray ) ) {
    $paginationClass = 'otw_blog_manager-load-more-newspapper';
    $paginationLoadMore = 'otw_blog_manager-load-more-newspapper';
  }
  
  if( $this->listOptions['show-pagination'] == 'load-more' && !empty( $this->listOptions['posts_limit_page'] ) ) :

    $uniqueHash = wp_create_nonce("otw_bm_get_posts_nonce"); 
    $listID = $this->listOptions['id'];
    // $paginationPage is set from the otw_blog_manager.php
    ( !isset($paginationPage) )? $page = 2 : $page = $paginationPage;

    $ajaxURL = admin_url( 'admin-ajax.php?action=get_posts&bmi='. $listID .'&nonce='. $uniqueHash .'&page='. $page );
?>
<div class="otw-row">
 <div class="otw-twentyfour otw-columns">

    <div class="js-pagination_container">
      <div class="<?php echo esc_attr( $paginationClass );?> hide">
        <a href="<?php echo esc_attr( $ajaxURL );?>" class="js-pagination-no"><?php echo esc_html( $page );?></a>
      </div>
      <div class="<?php echo esc_attr( $paginationLoadMore );?> js-otw_blog_manager-load-more">
        <a href="<?php echo esc_attr( $ajaxURL );?>" data-empty="<?php esc_attr_e('No more posts to load.', 'otw_bm');?>" data-isotope="true"><?php esc_html_e('Load More...', 'otw_bm');?></a>
      </div>
    </div> <!-- End Pagination -->

  </div><!-- End Cols -->
</div><!-- End Rows -->

<?php endif; ?>
<!-- End Load More Pagination -->

<?php 
  if( $this->listOptions['show-pagination'] == 'infinit-scroll' && !empty( $this->listOptions['posts_limit_page'] )) : 
    $uniqueHash = wp_create_nonce("otw_bm_get_posts_nonce"); 
    $listID = $this->listOptions['id'];

    // $paginationPage is set from the otw_blog_manager.php
    ( !isset($paginationPage) )? $page = 2 : $page = $paginationPage;
    $ajaxURL = admin_url( 'admin-ajax.php?action=get_posts&post_id='. $listID .'&nonce='. $uniqueHash .'&page='. $page );
?>

<!-- Infinite Scroll -->
<div class="otw_blog_manager-pagination hide">
  <a href="<?php echo esc_attr( $ajaxURL );?>" data-empty="<?php esc_attr_e('No more posts to load.', 'otw_bm');?>" data-isotope="true">2</a>
</div>
<!-- End Infinite Scroll -->
<?php endif; ?>