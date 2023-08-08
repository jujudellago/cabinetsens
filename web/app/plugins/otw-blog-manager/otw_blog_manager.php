<?php
/**
 * Plugin Name: Blog Manager
 * Plugin URI: http://OTWthemes.com 
 * Description: Blog Manager for WordPress adds tons of blog functionality in terms of layout variation, styling options, content re-arrangement, etc. to your WordPress based website. Create as many blog post lists as you like. This plugin comes with over 20 templates to choose from. Select list content, modify layout and style your list to get the content and the look you want. Use the list’s shortcode or a widget to place your lists anywhere in your site – WYSIWYG editor of your page/post, any sidebar, template files.
 * Author: OTWthemes
 * Version: 2.07
 * Author URI: https://codecanyon.net/user/otwthemes/portfolio?ref=OTWthemes
 */
/**
 * Global Constants that are need for this plugin
 */
  // Directory Separator
	if( !defined( 'DS' ) ){
		define( 'DS', '/' );
	}
	
	if( !defined( 'OTW_PLUGIN_BLOG_MANAGER' ) ){
		define( 'OTW_PLUGIN_BLOG_MANAGER', 1 );
	}
	
  // Plugin Folder Name
  if( function_exists( 'plugin_basename' ) ){
	define( 'OTW_BM_PATH', preg_replace( "/\/otw\_blog\_manager\.php$/", '', plugin_basename( __FILE__ ) ) );
  }else{
	define( 'OTW_BM_PATH', 'otw-blog-manager' );
  }
  // Full map 
  define( 'OTW_BM_SERVER_PATH', dirname(__FILE__) );
  
	load_plugin_textdomain('otw_bm' ,false,dirname(plugin_basename(__FILE__)) . '/languages/');
	
	$upload_dir = wp_upload_dir();
	
	if( isset( $upload_dir['basedir'] ) ){
		
		define( 'SKIN_BM_URL', set_url_scheme( $upload_dir['baseurl'] ).DS.'otwbm'.DS.'skins'.DS );
		define( 'SKIN_BM_PATH', $upload_dir['basedir'].DS.'otwbm'.DS.'skins'.DS );
		define( 'UPLOAD_BM_PATH', $upload_dir['basedir'].DS );
	}else{
		define( 'SKIN_BM_URL',  plugins_url(). DS . 'wp-content' . DS . 'uploads'. DS .'otwbm'. DS .'skins' . DS );
		define( 'SKIN_BM_PATH', $_SERVER['DOCUMENT_ROOT'] . DS . 'wp-content'. DS .'uploads' . DS .'otwbm'. DS . 'skins' .DS );
		define( 'UPLOAD_BM_PATH', $_SERVER['DOCUMENT_ROOT'] . DS . 'wp-content'. DS .'uploads' . DS );
	}
	$otw_bm_plugin_url = plugin_dir_url( __FILE__);
	global $otw_bm_plugin_id;
	include_once( 'include/settings.php' );
	
	
	$otw_bm_factory_component = false;
	$otw_bm_factory_object = false;

	$otw_bm_image_component = false;
	$otw_bm_image_object = false;
	$otw_bm_image_profile = false;
	
	//load core component functions
	@include_once( 'include/otw_components/otw_functions/otw_functions.php' );
	
	if( !function_exists( 'otw_register_component' ) ){
		wp_die( 'Please include otw components' );
	}
	
	otw_set_up_memory_limit( '256M' );
	
	//register factory component
	otw_register_component( 'otw_factory', dirname( __FILE__ ).'/include/otw_components/otw_factory/', $otw_bm_plugin_url.'include/otw_components/otw_factory/' );
	
	//register image component
	otw_register_component( 'otw_image', dirname( __FILE__ ).'/include/otw_components/otw_image/', '/include/otw_components/otw_image/' );


if( !class_exists('OTWBlogManager') ) {

class OTWBlogManager {

  // Query Class Instance
  public $otwBMQuery = null;
  
  // CSS Class Instance
  public $otwCSS = null;

  // Tempalte Dispatcher
  public $otwDispatcher = null;

  public $fontsArray = null;

  // Validation errors array
  public $errors = null;

  // Form data on error
  public $errorData = null;

  /**
   * Initialize plugin
   */
  public function __construct() {
    
    // Create an instance of the OTWBMQuery Class
    $this->otwBMQuery = new OTWBMQuery();

    $this->otwCSS = new OTWCss();

    $this->otwDispatcher = new OTWDispatcher();

    require_once( 'include' . DS . 'fonts.php' );
    $this->fontsArray = json_decode($allFonts);
    
    add_action('init', array($this, 'load_resources') );

    // Add Admin Menu only if role is Admin
    if( is_admin() ) {
      
      // Add Admin Assets
      add_action( 'admin_init', array($this, 'register_resources') );
      // Add Admin menu
      add_action( 'admin_menu', array($this, 'register_menu') );
      // Add Meta Box 
      add_action( 'add_meta_boxes', array($this, 'bm_meta_boxes'), 10, 2 );
      // Save Meta Box Data
      add_action( 'save_post', array($this, 'bm_save_meta_box') );
      
      add_action( 'wp_ajax_otw_bm_select2_options', array($this, 'get_select2_options') );
      
	//filter for factory messages
	add_filter( 'otwfcr_notice', array( $this, 'factory_message' ) );

    }
    
    
    // Load Short Code
    add_shortcode( 'otw-bm-list', array($this, 'bm_list_shortcode') );

    // Include Widgets Functionality
    add_action( 'widgets_init', array($this, 'bm_register_widgets') );

    /**
     * Init Front End template functions
     */

    // Enque template JS and CSS files
    add_action( 'wp_enqueue_scripts', array($this, 'register_fe_resources') );

    // Ajax FE Actions - Load More Pagination
    add_action( 'wp_ajax_get_posts', array($this, 'otw_bm_get_posts') );
    add_action( 'wp_ajax_nopriv_get_posts', array($this, 'otw_bm_get_posts') );
    
    // Ajax FE Social Share
    add_action( 'wp_ajax_social_share', array($this, 'otw_bm_social_share') );
    add_action( 'wp_ajax_nopriv_social_share', array($this, 'otw_bm_social_share') );
  }


	public function get_select2_options(){
	
		$options = array();
		$options['results'] = array();
		
		$options_type = '';
		$options_limit = 100;
		
		if( otw_post( 'otw_options_type', false ) ){
			$options_type = sanitize_text_field( otw_post( 'otw_options_type', '' ) );
		}
		
		if( otw_post( 'otw_options_limit', false ) ){
			$options_limit = sanitize_text_field( otw_post( 'otw_options_limit', '' ) );
		}
		
		switch( $options_type ){
			
			case 'category':
					$args = array();
					$args['hide_empty']      = 0;
					$args['number']          = $options_limit;
					
					if( otw_post( 'otw_options_ids', false ) && strlen( otw_post( 'otw_options_ids', '' ) ) ){
						
						$args['include'] = array();
						$include_items = explode( ',', sanitize_text_field( otw_post( 'otw_options_ids', '' ) ) );
						
						foreach( $include_items as $i_item ){
							
							if( intval( $i_item ) ){
								$args['include'][] = $i_item;
							}
						}
					}
					
					if( otw_post( 'otw_options_search', false ) && strlen( otw_post( 'otw_options_search', '' ) ) ){
						$args['search'] = sanitize_textarea_field( urldecode( otw_post( 'otw_options_search', '' ) ) );
					}
					
					$all_items = get_categories( $args );
					
					if( is_array( $all_items ) && count( $all_items ) ){
						foreach( $all_items as $item ){
							$o_key = count( $options['results'] );
							$options['results'][ $o_key ] = array();
							$options['results'][ $o_key ]['id'] = $item->term_id;
							$options['results'][ $o_key ]['text'] = $item->name;
						}
					}
				break;
			case 'tag':
					$args = array();
					$args['hide_empty']      = 0;
					$args['number']          = $options_limit;
					
					if( otw_post( 'otw_options_ids', false ) && strlen( otw_post( 'otw_options_ids', '' ) ) ){
						
						$args['include'] = array();
						$include_items = explode( ',', sanitize_text_field( otw_post( 'otw_options_ids', '' ) ) );
						
						foreach( $include_items as $i_item ){
							
							if( intval( $i_item ) ){
								$args['include'][] = $i_item;
							}
						}
					}
					
					if( otw_post( 'otw_options_search', false ) && strlen( otw_post( 'otw_options_search', '' ) ) ){
						$args['search'] = sanitize_textarea_field( urldecode( otw_post( 'otw_options_search', '' ) ) );
					}
					
					$all_items = get_tags( $args );
					
					if( is_array( $all_items ) && count( $all_items ) ){
						foreach( $all_items as $item ){
							$o_key = count( $options['results'] );
							$options['results'][ $o_key ] = array();
							$options['results'][ $o_key ]['id'] = $item->term_id;
							$options['results'][ $o_key ]['text'] = $item->name;
						}
					}
				break;
			case 'user':
					$args = array();
					
					if( otw_post( 'otw_options_ids', false ) && strlen( otw_post( 'otw_options_ids', '' ) ) ){
						
						$args['include'] = array();
						$include_items = explode( ',', sanitize_text_field( otw_post( 'otw_options_ids', '' ) ) );
						
						foreach( $include_items as $i_item ){
							
							if( intval( $i_item ) ){
								$args['include'][] = $i_item;
							}
						}
					}
					
					if( otw_post( 'otw_options_search', false ) && strlen( otw_post( 'otw_options_search', '' ) ) ){
						$args['search'] = '*'.sanitize_textarea_field( urldecode( otw_post( 'otw_options_search', '' ) ) ).'*';
					}
					
					$all_items = get_users( $args );
					
					if( is_array( $all_items ) && count( $all_items ) ){
						foreach( $all_items as $item ){
							$o_key = count( $options['results'] );
							$options['results'][ $o_key ] = array();
							$options['results'][ $o_key ]['id'] = $item->ID;
							$options['results'][ $o_key ]['text'] = $item->user_login;
						}
					}
				break;
			case 'page':
					$args = array();
					$args['post_type'] = 'page';
					$args['number']          = $options_limit;
					
					if( otw_post( 'otw_options_ids', false ) && strlen( otw_post( 'otw_options_ids', '' ) ) ){
						
						$args['post__in'] = array();
						$include_items = explode( ',', sanitize_text_field( otw_post( 'otw_options_ids', '' ) ) );
						
						foreach( $include_items as $i_item ){
							
							if( intval( $i_item ) ){
								$args['post__in'][] = $i_item;
							}
						}
					}
					
					if( otw_post( 'otw_options_search', false ) && strlen( otw_post( 'otw_options_search', '' ) ) ){
						$args['s'] = sanitize_textarea_field( urldecode( otw_post( 'otw_options_search', '' ) ) );
					}
					
					$query = new WP_Query( $args );
					$all_items = $query->posts;
					
					if( is_array( $all_items ) && count( $all_items ) ){
						foreach( $all_items as $item ){
							$o_key = count( $options['results'] );
							$options['results'][ $o_key ] = array();
							$options['results'][ $o_key ]['id'] = $item->ID;
							$options['results'][ $o_key ]['text'] = $item->post_title;
						}
					}
				break;
		}
		
		echo json_encode( $options );
		die;
	}


  /**
   * Add Menu To WP Backend
   * This menu will be available only for Admin users
   */
	public function register_menu() {
	
		global $otw_bm_factory_object, $otw_bm_plugin_id;
		
		add_menu_page( esc_html__('Blog Manager', 'otw_bm'), esc_html__('Blog Manager', 'otw_bm'), 'manage_options', 'otw-bm', array( $this , 'bm_list' ), plugins_url() . DS . OTW_BM_PATH . DS .'assets'. DS .'img'. DS .'menu_icon.png' );
		
		if( $otw_bm_factory_object->is_plugin_active( $otw_bm_plugin_id ) ){
			
			add_submenu_page( 'otw-bm', esc_html__('Blog Manager Lists', 'otw_bm'), esc_html__('Blog Lists', 'otw_bm'), 'manage_options', 'otw-bm', array( $this , 'bm_list' ) );
			add_submenu_page( 'otw-bm', esc_html__('Blog Manager | Add Lists', 'otw_bm'), esc_html__('Add Lists', 'otw_bm'), 'manage_options', 'otw-bm-add', array( $this , 'bm_add' ) );
			add_submenu_page(  __FILE__,  esc_html__('Blog Manager | Duplicate List', 'otw_bm'), esc_html__('Duplicated List', 'otw_bm'), 'manage_options', 'otw-bm-copy', array( $this , 'bm_copy' ) );
			add_submenu_page( 'otw-bm', esc_html__('Blog Manager | Options', 'otw_bm'), esc_html__('Options', 'otw_bm'), 'manage_options', 'otw-bm-settings', array( $this , 'bm_settings' ) );
		}
	}

/**
  * Add components
  */
public function load_resources(){
	
	global $otw_bm_image_component, $otw_bm_image_profile, $otw_bm_image_object, $otw_bm_factory_component, $otw_bm_factory_object, $otw_bm_plugin_id;
	
	$otw_bm_factory_component = otw_load_component( 'otw_factory' );
	$otw_bm_factory_object = otw_get_component( $otw_bm_factory_component );
	$otw_bm_factory_object->add_plugin( $otw_bm_plugin_id, __FILE__, array( 'menu_parent' => 'otw-bm', 'lc_name' => esc_html__( 'License Manager', 'otw_bm' ), 'menu_key' => 'otw-bm' ) );
	
	include_once( plugin_dir_path( __FILE__ ).'include/otw_labels/otw_bm_factory_object.labels.php' );
	$otw_bm_factory_object->init();
	
	
	$otw_bm_image_component = otw_load_component( 'otw_image' );
	
	$otw_bm_image_object = otw_get_component( $otw_bm_image_component );
	
	$otw_bm_image_object->init();
	
	$img_location = wp_upload_dir();
	
	$otw_bm_image_profile = $otw_bm_image_object->add_profile( $img_location['basedir'].'/', $img_location['baseurl'].'/', 'otwbm' );
	

}

  /**
   * Add Styles and Scripts needed by the Admin interface
   */
	public function register_resources () {
		
		global $otw_bm_factory_object, $otw_bm_plugin_id;
		
		if( !function_exists( 'wp_enqueue_media' ) ){
			wp_enqueue_media(); //WP 3.5 media uploader
		}
		
		//check the skin folder
		$upload_dir = wp_upload_dir();
		
		global $wp_filesystem;
		
		if( otw_init_filesystem() ){
			
			if( isset( $upload_dir['basedir'] ) && $wp_filesystem->is_writable( $upload_dir['basedir'] ) && !$wp_filesystem->is_dir( SKIN_BM_PATH ) ){
				
				if( !$wp_filesystem->is_dir( $upload_dir['basedir'].DS.'otwbm' ) ){
					$wp_filesystem->mkdir( $upload_dir['basedir'].DS.'otwbm' );
				}
				if( $wp_filesystem->is_dir( $upload_dir['basedir'].DS.'otwbm' ) && !$wp_filesystem->is_dir( SKIN_BM_PATH ) ){
					$wp_filesystem->mkdir( SKIN_BM_PATH );
				}
			}
		}
		
		
		add_action('admin_print_styles', array( $this, 'enqueue_admin_styles' ) );
		add_action('admin_enqueue_scripts', array( $this, 'enqueue_admin_scripts' ) );
		
		// Save and redirect are done before any headers are loaded
		if( $otw_bm_factory_object->is_plugin_active( $otw_bm_plugin_id ) ){
			$this->saveAction();
		}
	}
	
	public function enqueue_admin_styles( $requested_page ){
		
		if( function_exists( 'get_current_screen' ) ){
			
			$screen = get_current_screen();
			
			if( isset( $screen->id ) && strlen( $screen->id ) ){
				$requested_page = $screen->id;
			}
		}
		switch( $requested_page ){
			
			case 'toplevel_page_otw-bm':
			case 'blog-manager_page_otw-bm-add':
			case 'post':
					wp_register_style( 'colorpicker', plugins_url() . DS . OTW_BM_PATH . DS . 'assets'.DS.'css'.DS.'colorpicker.css' );
					wp_register_style( 'otw-admin-bm-default', plugins_url() . DS . OTW_BM_PATH . DS . 'assets'.DS.'css'.DS.'otw-blog-list-default.css' );
					wp_register_style( 'select2', plugins_url() . DS . OTW_BM_PATH . DS . 'assets'.DS.'css'.DS.'select2.min.css' );
					
					wp_enqueue_style( 'colorpicker' );
					wp_enqueue_style( 'otw-admin-bm-default' );
					wp_enqueue_style( 'select2' );
				break;
		}
	}
	
	public function enqueue_admin_scripts( $requested_page ){
		
		if( function_exists( 'get_current_screen' ) ){
			
			$screen = get_current_screen();
			
			if( isset( $screen->id ) && strlen( $screen->id ) ){
				$requested_page = $screen->id;
			}
		}
		
		switch( $requested_page ){
			
			case 'toplevel_page_otw-bm':
			case 'blog-manager_page_otw-bm-add':
			case 'post':
					
					// Get ALL categories to be used in SELECT 2
					$categoriesData     = array();
					$catCount = 0;
					
					// Get ALL tags to be used in SELECT 2
					$tagsData           = array();
					$tagCount           = 0;
					
					// Get ALL users Authors
					$usersData          = array();
					$userCount          = 0;
					
					$pagesData          = array();
					$pageCount          = 0;
					
					// Custom Messages that are required in JS
					// Added here because of translation
					$messages = array(
						'delete_confirm'  => esc_html__('Are you sure you want to delete ', 'otw_bm'),
						'modal_title'     => esc_html__('Select Images', 'otw_bm'),
						'modal_btn'       => esc_html__('Add Image', 'otw_bm')
					);
					
					wp_register_script( 'jquery-colorpicker', plugins_url() . DS . OTW_BM_PATH . DS . 'assets'.DS.'js'.DS.'plugins'.DS.'colorpicker.js', array('jquery') );
					wp_register_script( 'select2', plugins_url() . DS . OTW_BM_PATH . DS . 'assets'.DS.'js'.DS.'plugins'.DS.'select2.full.min.js', array('jquery') );
					wp_register_script( 'otw-admin-variables', plugins_url() . DS . OTW_BM_PATH . DS . 'assets'.DS.'js'.DS.'otw-admin-bm-variables.js' );
					wp_register_script( 'otw-admin-functions', plugins_url() . DS . OTW_BM_PATH . DS . 'assets'.DS.'js'.DS.'otw-admin-bm-functions.js' );
					wp_register_script( 'otw-admin-fonts', plugins_url() . DS . OTW_BM_PATH . DS . 'assets'.DS.'js'.DS.'fonts.js' );
					
					// Custom Scripts + Plugins
					wp_enqueue_script( 'jquery-colorpicker' );
					wp_enqueue_script( 'select2' );
					wp_enqueue_script( 'otw-admin-otwpreview' );
					wp_enqueue_script( 'otw-admin-fonts');
					wp_enqueue_script( 'otw-admin-functions');
					wp_enqueue_script( 'otw-admin-variables');
					
					// Core Scripts
					wp_enqueue_script( 'jquery' );
					wp_enqueue_script( 'jquery-ui-core' );
					wp_enqueue_script( 'jquery-ui-draggable' );
					wp_enqueue_script( 'jquery-ui-droppable' );
					wp_enqueue_script( 'jquery-ui-accordion' );
					wp_enqueue_script( 'jquery-ui-sortable' );
					
					wp_add_inline_script( 'otw-admin-functions', 'var categories = "'.addslashes( json_encode( $categoriesData ) ).'";', 'before' );
					wp_add_inline_script( 'otw-admin-functions', 'var tags = "'.addslashes( json_encode( $tagsData ) ).'";', 'before' );
					wp_add_inline_script( 'otw-admin-functions', 'var users = "'.addslashes( json_encode( $usersData ) ).'";', 'before' );
					wp_add_inline_script( 'otw-admin-functions', 'var pages = "'.addslashes( json_encode( $pagesData ) ).'";', 'before' );
					wp_add_inline_script( 'otw-admin-functions', 'var messages = "'.addslashes( json_encode( $messages ) ).'";', 'before' ) ;
					wp_add_inline_script( 'otw-admin-functions', 'var frontendURL = '.json_encode( plugins_url() . DS . OTW_BM_PATH . DS . 'frontend/' ), 'before' );
				break;
		}
	}
  /**
   * Add Meta Boxes 
   */
  public function bm_meta_boxes () {
    // Add Support for POSTS
    add_meta_box(
      'otw-bm-meta-box', 
      esc_html__('OTW Media Item', 'otw_bm'), 
      array($this, 'otw_blog_manager_media_meta_box'), 
      'post', 
      'normal', 
      'default'
    );
  }

  /**
   * Add Custom HTML Meta Box on POSTS and PAGES 
   */
  public function otw_blog_manager_media_meta_box ( $post ) {

    $otw_bm_meta_data = get_post_meta( $post->ID, 'otw_bm_meta_data', true );
    require_once( 'views'. DS .'otw_blog_manager_meta_box.php' );
  }

  /**
   * Save Meta Box Data
   * @param $post_id - int - Current POST ID beeing edited
   */
  function bm_save_meta_box ( $post_id ) {

    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ){
      return;
    }

    if( !empty( $_POST ) && !empty( otw_post( 'otw-bm-list-media_type', '' )) ) {


      $otw_meta_data = array(
        'media_type'      => sanitize_text_field( otw_post( 'otw-bm-list-media_type', '' ) ),
        'youtube_url'     => sanitize_text_field( otw_post( 'otw-bm-list-youtube_url', '' ) ),
        'vimeo_url'       => sanitize_text_field( otw_post( 'otw-bm-list-vimeo_url', '' ) ),
        'soundcloud_url'  => sanitize_text_field( otw_post( 'otw-bm-list-soundcloud_url', '' ) ),
        'img_url'         => sanitize_text_field( otw_post( 'otw-bm-list-img_url', '' ) ),
        'slider_url'      => sanitize_text_field( otw_post( 'otw-bm-list-slider_url', '' ) )
    
      );
      /**
       * Add Custom POST Meta Data
       * If POST is found in the DB it will just be ignored and return FALSE
       */

      add_post_meta($post_id, 'otw_bm_meta_data', $otw_meta_data, true);

      // If POST is in the DB update it
      update_post_meta($post_id, 'otw_bm_meta_data', $otw_meta_data);
    }elseif( !empty( $_POST ) &&  otw_post( 'otw-bm-list-media_type', false )  ){
	delete_post_meta($post_id, 'otw_bm_meta_data');
    }
  }

  /**
   * OTW Blog Manager List Page
   */
  public function bm_list () {
    $action = $_GET;

    // Check if writing permissions
    $writableCssError = $this->check_writing( SKIN_BM_PATH );
    $writableError    = $this->check_writing( UPLOAD_BM_PATH );

    $otw_bm_lists = get_option( 'otw_bm_lists' );

    if( !empty( $action['action'] ) && $action['action'] === 'delete' ) {
	
	//validate the nonce
	$this->errors = null;
	
	if( !otw_get( '_otw_bm_wpnonce', false ) || !wp_verify_nonce( otw_get( '_otw_bm_wpnonce', '' ), 'otw_bm_delete_list' ) ){
		
		$error = new WP_Error( 'invalid_nonce', esc_html__( 'Error in the nonce for deleting blog list.', 'otw_bm' ) );
		$this->errors['wpnonce'] = $error->get_error_message();
	}else{
		$list_id = otw_get( 'otw-bm-list-id', '' );
		$item = 'otw-bm-list-'.$list_id;
		unset( $otw_bm_lists['otw-bm-list'][ $item ] );
		update_option( 'otw_bm_lists', $otw_bm_lists );
	}
    }
    require_once('views' . DS . 'otw_blog_manager_list.php');
  }

  /**
   * OTW Blog Manager Copy List
   */
  public function bm_copy () {
  
	include( 'include' . DS . 'content.php' );
	
	if( !empty(otw_get( 'otw-bm-list-id', '' )) ){
		$listID = (int) otw_get( 'otw-bm-list-id', '' );
		
		$content = $this->otwBMQuery->getItemById( $listID );
		
		$content['new_list_name'] = esc_html__('Copy of', 'otw_bm').' '.$content['list_name'];
		
		require_once('views' . DS . 'otw_blog_manager_copy_list.php');
	}
  }

  /**
   * OTW Blog Manager Add / Edit Page
   */
  public function bm_add () {

    // Default Values 
    // $content and $widgets
    include( 'include' . DS . 'content.php' );

    $default_content = $content;

    // Edit field - used to determin if we are on an edit or add action
    $edit = false;

    // Reload $_POST data on error
    if( !empty( $this->errors ) ) {
      $content = $this->errorData;
    }

    // Edit - Load Values for current list
    if( !empty(otw_get( 'otw-bm-list-id', '' )) ) {
      
      $listID = (int) otw_get( 'otw-bm-list-id', '' );
      $nextID = $listID;
      $edit = true;
      $content = $this->otwBMQuery->getItemById( $listID );
      
		foreach( $default_content as $content_key => $content_value ){
			
			if( !array_key_exists( $content_key, $content ) ){
				$content[ $content_key ] = $content_value;
			}
		}
    }

    // Make manipulations to the $content in order to be used in the UI
    if( !empty( $content ) ) {
      // Replace escaping \ in order to display in textarea
      $content['custom_css'] = str_replace('\\', '', $content['custom_css']);

      // Select All functionality, remove all items from the list if Select All is used
      // We use this approach in order not to show any items in the text field if select all is used
      if( !empty( $content['all_categories'] ) ) { $content['categories'] = ''; }
      if( !empty( $content['all_tags'] ) ) { $content['tags'] = ''; }
      if( !empty( $content['all_users'] ) ) { $content['users'] = ''; }

      if( !array_key_exists('select_categories' , $content ) ) { $content['select_categories'] = ''; }
      if( !array_key_exists('select_tags' , $content ) ) { $content['select_tags'] = ''; }
      if( !array_key_exists('select_users' , $content ) ) { $content['select_users'] = ''; }
    }

    require_once('views' . DS . 'otw_blog_manager_add_list.php');
  }

  /**
   * saveAction - Validate form and save + redirect
   * @return void
   */
  public function saveAction() {
  
	global $otw_bm_factory_object, $otw_bm_plugin_id, $wp_filesystem;
	
	if( !$otw_bm_factory_object->is_plugin_active( $otw_bm_plugin_id ) ){
		return;
	}

    if( !empty( $_POST ) &&  otw_post( 'submit-otw-bm-copy', false )  ){
	
	
	$this->errors = null;
	
	if( !otw_post( '_otw_bm_wpnonce', false ) || !wp_verify_nonce( otw_post( '_otw_bm_wpnonce', '' ), 'otw_bm_copy_list' ) ){
		
		$error = new WP_Error( 'invalid_nonce', esc_html__( 'Error validating form nonce.', 'otw_bm' ) );
		$this->errors['wpnonce'] = $error->get_error_message();
		return;
	}
	
	$credentials = request_filesystem_credentials( self_admin_url() );
	
	if( !$credentials || !WP_Filesystem( $credentials ) ){
		
		$error = new WP_Error( 'no_filesystem_rights', esc_html__( 'Can not write custom css into disk.', 'otw_bm' ) );
		$this->errors['no_filesystem_rights'] = $error->get_error_message();
		return;
	}
	
	// Get Current Items in the DB
	$otw_bm_list = $this->otwBMQuery->getLists();
	
	if( empty( otw_post( 'id', '' ) ) || !isset( $otw_bm_list['otw-bm-list'] ) || !isset( $otw_bm_list['otw-bm-list']['otw-bm-list-'.otw_post( 'id', '' ) ] )){
		$this->errors['source_list_name'] = esc_html__('Source Blog List Not found', 'otw_bm');
	}
	
	if( empty( otw_post( 'list_name', '' ) ) ){
		$this->errors['list_name'] = esc_html__('New Blog List Name is Required', 'otw_bm');
	}
	
	// Errors have been detected persist data
	if( !empty( $this->errors ) ){
		$this->errorData = $_POST;
		return null;
	}
	
	if( isset( $otw_bm_list['otw-bm-list']['next_id'] ) ){
		
		$otw_bm_list['otw-bm-list'][ 'otw-bm-list-'.$otw_bm_list['otw-bm-list']['next_id'] ] = $otw_bm_list['otw-bm-list']['otw-bm-list-'.intval( sanitize_text_field( otw_post( 'id', '' ) ) ) ];
		$otw_bm_list['otw-bm-list'][ 'otw-bm-list-'.$otw_bm_list['otw-bm-list']['next_id'] ]['id'] = $otw_bm_list['otw-bm-list']['next_id'];
		$otw_bm_list['otw-bm-list'][ 'otw-bm-list-'.$otw_bm_list['otw-bm-list']['next_id'] ]['list_name'] = sanitize_text_field( otw_post( 'list_name', '' ) );
		$otw_bm_list['otw-bm-list'][ 'otw-bm-list-'.$otw_bm_list['otw-bm-list']['next_id'] ]['edit'] = false;
		$otw_bm_list['otw-bm-list'][ 'otw-bm-list-'.$otw_bm_list['otw-bm-list']['next_id'] ]['date_created'] = date('Y/m/d');
		$otw_bm_list['otw-bm-list'][ 'otw-bm-list-'.$otw_bm_list['otw-bm-list']['next_id'] ]['user_id'] = get_current_user_id();
		
		$source_customCssFile = SKIN_BM_PATH .'otw-bm-list-'.intval( sanitize_text_field( otw_post( 'id', '' ) ) ).'-custom.css';
		$customCssFile = SKIN_BM_PATH . DS .'otw-bm-list-'.$otw_bm_list['otw-bm-list']['next_id'].'-custom.css';
		
		if( $wp_filesystem->exists( $source_customCssFile ) ){
		
			$css_file_content = $wp_filesystem->get_contents( $source_customCssFile );
			
			$css_file_content = str_replace( 'otw-bm-list-'.intval( sanitize_text_field( otw_post( 'id', '' ) ) ), 'otw-bm-list-'.$otw_bm_list['otw-bm-list']['next_id'], $css_file_content );
			
			$wp_filesystem->put_contents( $customCssFile, $css_file_content );
			
			$otw_bm_list['otw-bm-list'][ 'otw-bm-list-'.$otw_bm_list['otw-bm-list']['next_id'] ]['has_custom_css_file'] = 1;
		}else{
			$otw_bm_list['otw-bm-list'][ 'otw-bm-list-'.$otw_bm_list['otw-bm-list']['next_id'] ]['has_custom_css_file'] = 0;
		}
		
		$otw_bm_list['otw-bm-list']['next_id']++;
		update_option( 'otw_bm_lists', $otw_bm_list );
		
		$this->redirect('admin.php?page=otw-bm&success=true');
		exit;
	}
    
    }else if( !empty( $_POST ) &&  otw_post( 'submit-otw-bm', false )  ){
	$this->errors = null;
	
	if( !otw_post( '_otw_bm_wpnonce', false ) || !wp_verify_nonce( otw_post( '_otw_bm_wpnonce', '' ), 'otw_bm_save_list' ) ){
		
		$error = new WP_Error( 'invalid_nonce', esc_html__( 'Error validating form nonce.', 'otw_bm' ) );
		$this->errors['wpnonce'] = $error->get_error_message();
		return;
	}
	
	$credentials = request_filesystem_credentials( self_admin_url() );
	
	if( !$credentials || !WP_Filesystem( $credentials ) ){
		
		$error = new WP_Error( 'no_filesystem_rights', esc_html__( 'Can not write custom css into disk.', 'otw_bm' ) );
		$this->errors['no_filesystem_rights'] = $error->get_error_message();
		return;
	}
    
      // Check if Blog List Name is present
      if( empty( otw_post( 'list_name', '' ) ) ) {
        $this->errors['list_name'] = esc_html__('Blog List Name is Required', 'otw_bm');
      }

      // Check if Blog List Template is present
      if( empty( otw_post( 'template', '' ) ) || otw_post( 'template', '' ) === 0 ) {
        $this->errors['template'] = esc_html__('Please select a Blog List Template', 'otw_bm');
      }

      //Check Selection of content: Category OR Tag OR Author
      if( 
          ( empty( otw_post( 'categories', '' ) ) && empty( otw_post( 'tags', '' ) ) && empty( otw_post( 'users', '' ) ) ) &&
          ( empty( otw_post( 'all_categories', '' ) ) && empty( otw_post( 'all_tags', '' ) ) && empty( otw_post( 'all_users', '' ) ) )
        ) {
        $this->errors['content'] = esc_html__('Please select a Category or Tag or Author.', 'otw_bm');
      }

      // Add dates  created or modified  to current post
      if( empty( otw_post( 'date_created', '' ) ) && empty( $this->errors ) ) {
        otw_spost( 'date_created', date('Y/m/d') );
        otw_spost( 'date_modified', date('Y/m/d') );
      }

      // Update modified if post is edited
      if( !empty( otw_post( 'id', '' ) ) ) {
        // Inject Date Modified into $_POST
        otw_spost( 'date_modified', date('Y/m/d') );
      }

      /** 
       * If select All functionality is used, adjust the POST
       */
      if( !empty( otw_post( 'all_categories', '' ) ) ) {
        otw_spost( 'categories', otw_post( 'all_categories', '' ) );
      }
      if( !empty( otw_post( 'all_tags', '' ) ) ) {
        otw_spost( 'tags', otw_post( 'all_tags', '' ) );
      }
      if( !empty( otw_post( 'all_users', '' ) ) ) {
        otw_spost( 'users', otw_post( 'all_users', '' ) );
      }

      // Errors have been detected persist data
      if( !empty( $this->errors ) ) {
        $this->errorData = $_POST;
        return null;
      }

      // This is a new list get the ID
      if( empty( otw_post( 'edit', '' ) ) &&  empty( $this->errors ) ) {
        $otw_bm_lists = $this->otwBMQuery->getLists();

        // This is the first list generated
        if( empty( $otw_bm_lists ) ) {
	      otw_spost( 'id', 1 );
        } else {
          otw_spost( 'id', $otw_bm_lists['otw-bm-list']['next_id'] );
        }
      }

      // Assign $_POST to variable in order to fill form on error / edit
      $content = $_POST;

      /**
      * Create Custom CSS file for inline styles such as: Title, Meta Items, Excpert, Continue Reading
      */
      $customCssFile = SKIN_BM_PATH . DS .'otw-bm-list-'.otw_post( 'id', '' ).'-custom.css';

      // Make sure all the older CSS rules are deleted in order for a fresh save
      $wp_filesystem->put_contents( $customCssFile, '' );

      // Write Custom CSS
      $this->otwCSS->writeCSS( str_replace('\\', '', otw_post( 'custom_css', '' )),  $customCssFile );

      $metaStyles = array(
        'font'        => (!empty(otw_post( 'meta_font', '' )) && isset( $this->fontsArray[ otw_post( 'meta_font', '' ) ] ) )? $this->fontsArray[ otw_post( 'meta_font', '' ) ]->text : '',
        'color'       => (!empty(otw_post( 'meta-color', '' )))? otw_post( 'meta-color', '' ) : '',
        'size'        => (!empty(otw_post( 'meta-font-size', '' )))? otw_post( 'meta-font-size', '' ) : '',
        'font-style'  => (!empty(otw_post( 'meta-font-style', '' )))? otw_post( 'meta-font-style', '' ) : '',
        'container'   => '#otw-bm-list-'.otw_post( 'id', '' ).' .otw_blog_manager-blog-meta-wrapper'
      );

      $this->otwCSS->buildCSS( $metaStyles, $customCssFile );

      $metaLinkStyles = array(
        'font'        => (!empty(otw_post( 'meta_font', '' )) && isset( $this->fontsArray[ otw_post( 'meta_font', '' ) ] ) )? $this->fontsArray[ otw_post( 'meta_font', '' ) ]->text : '',
        'size'        => (!empty(otw_post( 'meta-font-size', '' )))? otw_post( 'meta-font-size', '' ) : '',
        'font-style'  => (!empty(otw_post( 'meta-font-style', '' )))? otw_post( 'meta-font-style', '' ) : '',
        'container'   => '#otw-bm-list-'.otw_post( 'id', '' ).' .otw_blog_manager-blog-meta-wrapper a'
      );

      $this->otwCSS->buildCSS( $metaLinkStyles, $customCssFile );

      $metaLabelStyles = array(
        'font'        => (!empty(otw_post( 'meta_font', '' )))? $this->fontsArray[ otw_post( 'meta_font', '' ) ]->text : '',
        'color'       => (!empty(otw_post( 'meta-color', '' )))? otw_post( 'meta-color', '' ) : '',
        'size'        => (!empty(otw_post( 'meta-font-size', '' )))? otw_post( 'meta-font-size', '' ) : '',
        'font-style'  => (!empty(otw_post( 'meta-font-style', '' )))? otw_post( 'meta-font-style', '' ) : '',
        'container'   => '#otw-bm-list-'.otw_post( 'id', '' ).' .otw_blog_manager-blog-meta-wrapper .head'
      );

      $this->otwCSS->buildCSS( $metaLabelStyles, $customCssFile );

      $titleNoLinkStyles = array(
        'font'        => (!empty(otw_post( 'title_font', '' )))? $this->fontsArray[ otw_post( 'title_font', '' ) ]->text : '',
        'color'       => (!empty(otw_post( 'title-color', '' )))? otw_post( 'title-color', '' ) : '',
        'size'        => (!empty(otw_post( 'title-font-size', '' )))? otw_post( 'title-font-size', '' ) : '',
        'font-style'  => (!empty(otw_post( 'title-font-style', '' )))? otw_post( 'title-font-style', '' ) : '',
        'container'   => '#otw-bm-list-'.otw_post( 'id', '' ).' .otw_blog_manager-blog-title'
      );
      
      $this->otwCSS->buildCSS( $titleNoLinkStyles, $customCssFile );

      $titleWidgetStyles = array(
        'font'        => (!empty(otw_post( 'title_font', '' )))? $this->fontsArray[ otw_post( 'title_font', '' ) ]->text : '',
        'color'       => (!empty(otw_post( 'title-color', '' )))? otw_post( 'title-color', '' ) : '',
        'size'        => (!empty(otw_post( 'title-font-size', '' )))? otw_post( 'title-font-size', '' ) : '',
        'font-style'  => (!empty(otw_post( 'title-font-style', '' )))? otw_post( 'title-font-style', '' ) : '',
        'container'   => '#otw-bm-list-'.otw_post( 'id', '' ).' .otw-widget-title'
      );

      $this->otwCSS->buildCSS( $titleWidgetStyles, $customCssFile );

      $titleWLinkStyles = array(
        'font'        => (!empty(otw_post( 'title_font', '' )))? $this->fontsArray[ otw_post( 'title_font', '' ) ]->text : '',
        'color'       => (!empty(otw_post( 'title-color', '' )))? otw_post( 'title-color', '' ) : '',
        'size'        => (!empty(otw_post( 'title-font-size', '' )))? otw_post( 'title-font-size', '' ) : '',
        'font-style'  => (!empty(otw_post( 'title-font-style', '' )))? otw_post( 'title-font-style', '' ) : '',
        'container'   => '#otw-bm-list-'.otw_post( 'id', '' ).' .otw_blog_manager-blog-title a'
      );

      $this->otwCSS->buildCSS( $titleWLinkStyles, $customCssFile );

      $excpertStyles = array(
        'font'        => (!empty(otw_post( 'excpert_font', '' )))? $this->fontsArray[ otw_post( 'excpert_font', '' ) ]->text : '',
        'color'       => (!empty(otw_post( 'excpert-color', '' )))? otw_post( 'excpert-color', '' ) : '',
        'size'        => (!empty(otw_post( 'excpert-font-size', '' )))? otw_post( 'excpert-font-size', '' ) : '',
        'font-style'  => (!empty(otw_post( 'excpert-font-style', '' )))? otw_post( 'excpert-font-style', '' ) : '',
        'container'   => '#otw-bm-list-'.otw_post( 'id', '' ).' .otw_blog_manager-blog-content p'
      );

      $this->otwCSS->buildCSS( $excpertStyles, $customCssFile );

      $excpertWidgetStyles = array(
        'font'        => (!empty(otw_post( 'excpert_font', '' )))? $this->fontsArray[ otw_post( 'excpert_font', '' ) ]->text : '',
        'color'       => (!empty(otw_post( 'excpert-color', '' )))? otw_post( 'excpert-color', '' ) : '',
        'size'        => (!empty(otw_post( 'excpert-font-size', '' )))? otw_post( 'excpert-font-size', '' ) : '',
        'font-style'  => (!empty(otw_post( 'excpert-font-style', '' )))? otw_post( 'excpert-font-style', '' ) : '',
        'container'   => '#otw-bm-list-'.otw_post( 'id', '' ).' .otw-widget-content'
      );

      $this->otwCSS->buildCSS( $excpertWidgetStyles, $customCssFile );

      $linkStyles = array(
        'font'        => (!empty(otw_post( 'read-more_font', '' )))? $this->fontsArray[ otw_post( 'read-more_font', '' ) ]->text : '',
        'color'       => (!empty(otw_post( 'read-more-color', '' )))? otw_post( 'read-more-color', '' ) : '',
        'size'        => (!empty(otw_post( 'read-more-font-size', '' )))? otw_post( 'read-more-font-size', '' ) : '',
        'font-style'  => (!empty(otw_post( 'read-more-font-style', '' )))? otw_post( 'read-more-font-style', '' ) : '',
        'container'   => '#otw-bm-list-'.otw_post( 'id', '' ).' .otw_blog_manager-blog-continue-reading'
      );

      $this->otwCSS->buildCSS( $linkStyles, $customCssFile );

      $titleSliderStyles = array(
        'font'        => (!empty(otw_post( 'title_font', '' )))? $this->fontsArray[ otw_post( 'title_font', '' ) ]->text : '',
        'color'       => (!empty(otw_post( 'title-color', '' )))? otw_post( 'title-color', '' ) : '',
        'size'        => (!empty(otw_post( 'title-font-size', '' )))? otw_post( 'title-font-size', '' ) : '',
        'font-style'  => (!empty(otw_post( 'title-font-style', '' )))? otw_post( 'title-font-style', '' ) : '',
        'container'   => '#otw-bm-list-'.otw_post( 'id', '' ).' .otw_blog_manager-caption-title a'
      );

      $this->otwCSS->buildCSS( $titleSliderStyles, $customCssFile );

      $excpertSliderStyles = array(
        'font'        => (!empty(otw_post( 'excpert_font', '' )))? $this->fontsArray[ otw_post( 'excpert_font', '' ) ]->text : '',
        'color'       => (!empty(otw_post( 'excpert-color', '' )))? otw_post( 'excpert-color', '' ) : '',
        'size'        => (!empty(otw_post( 'excpert-font-size', '' )))? otw_post( 'excpert-font-size', '' ) : '',
        'font-style'  => (!empty(otw_post( 'excpert-font-style', '' )))? otw_post( 'excpert-font-style', '' ) : '',
        'container'   => '#otw-bm-list-'.otw_post( 'id', '' ).' .otw_blog_manager-caption-excpert'
      );

      $this->otwCSS->buildCSS( $excpertSliderStyles, $customCssFile );
      
      $borderStyles = array(
    	    'border-style' => (!empty(otw_post( 'border-style', '' )))? otw_post( 'border-style', '' ) : '',
    	    'border-size' => (!empty(otw_post( 'border-size', '' )))? otw_post( 'border-size', '' ) : '',
    	    'border-color' => (!empty(otw_post( 'border-color', '' )))? otw_post( 'border-color', '' ) : '',
    	    'container'   => '#otw-bm-list-'.otw_post( 'id', '' ).' .with-border'
      );
    
      $this->otwCSS->buildCSS( $borderStyles, $customCssFile );
      
	if( !empty( otw_post( 'background-color', '' ) ) ){
		global $otw_bm_image_object;

		$bgcolors = $otw_bm_image_object->html2rgb( preg_replace( "/^\#/", '', otw_post( 'background-color', '' ) ) );
		
		
		if( is_array( $bgcolors ) && count( $bgcolors ) == 3 ){
			
			$opacity = '';
			
			if( otw_post( 'background-color-opacity', false ) && strlen( trim( otw_post( 'background-color-opacity', '' ) ) ) ){
				$opacity = otw_post( 'background-color-opacity', '' );
			}
			
			if( $opacity != '' ){
				$backgroundStyles = array(
					'background-color' => 'rgba('.$bgcolors[0].','.$bgcolors[1].', '.$bgcolors[2].', '.$opacity.')',
					'container'   => '#otw-bm-list-'.otw_post( 'id', '' ).' .with-bg'
				);
			}else{
				$backgroundStyles = array(
					'background-color' => 'rgb('.$bgcolors[0].','.$bgcolors[1].', '.$bgcolors[2].')',
					'container'   => '#otw-bm-list-'.otw_post( 'id', '' ).' .with-bg'
				);
			}
			
			$this->otwCSS->buildCSS( $backgroundStyles, $customCssFile );
		}
	}



      // Get Current Items in the DB
      $otw_bm_list = $this->otwBMQuery->getLists();

      // Create new entry 
      $otw_bm_list_data['otw-bm-list'][ 'otw-bm-list-' . otw_post( 'id', '' ) ] = $_POST;
      
	//reformat select2 values
	$select2_vars = array( 'categories', 'tags', 'users', 'exclude_categories', 'exclude_tags', 'exclude_users' );
	
	foreach( $select2_vars as $select2_name ){
	
		if( isset( $otw_bm_list_data['otw-bm-list'][ 'otw-bm-list-' . otw_post( 'id', '' ) ][ $select2_name ] ) && is_array( $otw_bm_list_data['otw-bm-list'][ 'otw-bm-list-' . otw_post( 'id', '' ) ][ $select2_name ] ) ){
			
			if( count( $otw_bm_list_data['otw-bm-list'][ 'otw-bm-list-' . otw_post( 'id', '' ) ][ $select2_name ] ) ){
				$otw_bm_list_data['otw-bm-list'][ 'otw-bm-list-' . otw_post( 'id', '' ) ][ $select2_name ] = implode( ',', $otw_bm_list_data['otw-bm-list'][ 'otw-bm-list-' . otw_post( 'id', '' ) ][ $select2_name ] );
			}else{
				$otw_bm_list_data['otw-bm-list'][ 'otw-bm-list-' . otw_post( 'id', '' ) ][ $select2_name ] = '';
			}
		}else{
			$otw_bm_list_data['otw-bm-list'][ 'otw-bm-list-' . otw_post( 'id', '' ) ][ $select2_name ] = '';
		}
	}

	$default_empty_fields = array( 'show-social-icons-facebook', 'show-social-icons-twitter', 'show-social-icons-googleplus', 'show-social-icons-linkedin', 'show-social-icons-pinterest' );
	
	foreach( $default_empty_fields as $f_key ){
		
		if( !array_key_exists( $f_key, $otw_bm_list_data['otw-bm-list'][ 'otw-bm-list-' . otw_post( 'id', '' ) ] ) ){
			$otw_bm_list_data['otw-bm-list'][ 'otw-bm-list-' . otw_post( 'id', '' ) ][ $f_key ] = 0;
		}
	}


      // We setup the next_id value. This will apply to the first save only
      if( empty($otw_bm_list['otw-bm-list']['next_id']) && empty( otw_post( 'edit', '' ) ) ) {
        // We assume this is the first save with ID is 1, next ID has to be 2. Count starts from 1 because of short-code
        $otw_bm_list_data['otw-bm-list']['next_id'] = 2;      
      } elseif ( empty( otw_post( 'edit', '' ) ) ) {
        $otw_bm_list['otw-bm-list']['next_id'] = $otw_bm_list['otw-bm-list']['next_id'] + 1;
        $otw_bm_list_data['otw-bm-list']['next_id'] =  $otw_bm_list['otw-bm-list']['next_id'];
      }

      // Merge the 2 arrays
      if ( $otw_bm_list === false || empty( $otw_bm_list ) ) {
        $listData = $otw_bm_list_data;
      } elseif ( !empty($otw_bm_list) ) {
        // Do not remove the otw-bm-list from they array_merge. There is a strange behavior related to this
        $listData['otw-bm-list'] = array_merge( $otw_bm_list['otw-bm-list'], $otw_bm_list_data['otw-bm-list'] );
      }

      // Update
      if( empty($this->errors) ) {
        
        // Get $widget from included file
        include( 'include' . DS . 'content.php' );

        if( in_array( otw_post( 'template', '' ), $widgets) ) {
          // It's a widget
          $listData['otw-bm-list'][ 'otw-bm-list-' . otw_post( 'id', '' ) ]['widget'] = 1;
        } else {
          // It's NOT a Widget
          $listData['otw-bm-list'][ 'otw-bm-list-' . otw_post( 'id', '' ) ]['widget'] = 0;
        }
        
        $customCssFile = SKIN_BM_PATH . DS .'otw-bm-list-'.otw_post( 'id', '' ).'-custom.css';
        
        if( $wp_filesystem->exists( $customCssFile ) ){
    		$listData['otw-bm-list'][ 'otw-bm-list-' . otw_post( 'id', '' ) ]['has_custom_css_file'] = 1;
	}else{
		$listData['otw-bm-list'][ 'otw-bm-list-' . otw_post( 'id', '' ) ]['has_custom_css_file'] = 0;
	}
        update_option( 'otw_bm_lists', $listData );
        
        $this->redirect('admin.php?page=otw-bm-add&action=edit&otw-bm-list-id='.otw_post( 'id', '' ).'&success=true');
        exit;
        
      } // End update

    } // End if (!empty($_POST))
  }

  /**
   * OTW Blog Manager Settings Page
   */
  public function bm_settings () {
	
	global $wp_filesystem;
	
	$this->errors = null;
	
	$customCss = '';
	$cssPath = SKIN_BM_PATH . DS . 'custom.css';
	
	// Check if writing permissions
	$writableCssError = $this->check_writing( SKIN_BM_PATH );
	
	if( $credentials = request_filesystem_credentials( self_admin_url() ) ){
		
		if( !WP_Filesystem( $credentials ) ){
			$error = new WP_Error( 'invalid_write_perms', esc_html__( 'No write perimtions to save settings.', 'otw_bm' ) );
			$this->errors['write_perms'] = $error->get_error_message();
		}
	}else{
		$error = new WP_Error( 'invalid_write_perms', esc_html__( 'No write perimtions to save settings.', 'otw_bm' ) );
		$this->errors['write_perms'] = $error->get_error_message();
	}
	// Open File for edit
	if( empty( $_POST ) && !$writableCssError  ) {
		if( $wp_filesystem->exists( $cssPath ) ){
			$customCss = $wp_filesystem->get_contents( $cssPath );
		}else{
			$customCss = '';
		}
	}
	
	// Save File on disk and redirect.
	if( !empty( $_POST ) && otw_post( 'save_settings', false ) ) {
	
		if(!otw_post( '_otw_bm_wpnonce', false ) || !wp_verify_nonce( otw_post( '_otw_bm_wpnonce', '' ), 'otw_bm_save_settings' ) ){
			
			$error = new WP_Error( 'invalid_nonce', esc_html__( 'Error in the nonce for saving the settings.', 'otw_bm' ) );
			$this->errors['wpnonce'] = $error->get_error_message();
		
		}else{
			$customCSS = str_replace('\\', '', otw_post( 'otw_css', '' ));
			
			$wp_filesystem->put_contents( $cssPath, $customCSS );
			
			if( strlen( trim( $customCSS ) ) ){
				update_option( 'otw_bm_has_custom_css', 1 );
			}else{
				update_option( 'otw_bm_has_custom_css', 0 );
			}
			
			if( otw_post( 'otw_bm_delete_data', false ) && !empty( otw_post( 'otw_bm_delete_data', '' ) ) ){
				update_option( 'otw_bm_delete_data', otw_post( 'otw_bm_delete_data', '' ) );
			}
			
			if( otw_post( 'otw_bm_promotions', false ) && !empty( otw_post( 'otw_bm_promotions', '' ) ) ){
				
				global $otw_bm_factory_object, $otw_bm_plugin_id;
				
				update_option( $otw_bm_plugin_id.'_dnms', otw_post( 'otw_bm_promotions', '' ) );
				
				if( is_object( $otw_bm_factory_object ) ){
					$otw_bm_factory_object->retrive_plungins_data( true );
				}
			}
			echo "<script>window.location = 'admin.php?page=otw-bm-settings&success_css=true';</script>";
			die;
		}
	}
	
	require_once('views' . DS . 'otw_blog_manager_settings.php');
  }

  /**
   * Check Writing Permissions
   */
  public function check_writing( $path ) {
	
	$writableCssError = false;
	
	global $wp_filesystem;
	
	if( otw_init_filesystem() ){
		
		if( !$wp_filesystem->is_writable( $path ) ) {
			$writableCssError = true;
		}
	}
	
	return $writableCssError;
  }


  /*****
    Front End Related Actions
   ****/

  /**
   * Load Lists on the Front End using short code
   * @param $attr - array
   */
  public function bm_list_shortcode( $attr ) {
  
 	global $otw_bm_factory_object, $otw_bm_plugin_id, $wp_filesystem;
	
	if( !$otw_bm_factory_object->is_plugin_active( $otw_bm_plugin_id ) ){
		
		return;
	} 

    $listID = $attr['id'];

    // Get Current Items in the DB
    $otw_bm_options = $this->otwBMQuery->getItemById( $listID );


    if( !empty( $otw_bm_options ) ) {
	
	if( !isset( $otw_bm_options['has_custom_css_file'] ) || ( $otw_bm_options['has_custom_css_file'] == 1 ) ){
		
		wp_register_style( 'otw-bm-custom-css-'.$listID, SKIN_BM_URL .'otw-bm-list-'.$listID.'-custom.css' );
		wp_enqueue_style( 'otw-bm-custom-css-'.$listID );
	}

      $customFonts = array(
        'title'         => $otw_bm_options['title_font'],
        'meta'          => $otw_bm_options['meta_font'],
        'excpert'       => $otw_bm_options['excpert_font'],
        'continue_read' => $otw_bm_options['read-more_font']
      );

      $googleFonts = $this->otwCSS->getGoogleFonts( $customFonts, $this->fontsArray  );
      
      if( !empty( $googleFonts ) ) {
        $httpFonts = (!empty($_SERVER['HTTPS'])) ? "https" : "http";
        $url = $httpFonts.'://fonts.googleapis.com/css?family='.$googleFonts.'&variant=italic:bold';
        wp_enqueue_style('otw-bm-googlefonts',$url, null, null);
      }
    
      // Load $templateOptions - array
      include('include' . DS . 'content.php');

      $currentPage = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
      
      if( !preg_match( "/^\d+$/", get_query_var( 'paged' ) ) && preg_match( "/^\d+$/", get_query_var( 'page' ) ) ){
    		$currentPage = ( get_query_var( 'page' ) )?get_query_var( 'page' ):1;
      }

      if( otw_get( 'bmi', false ) && preg_match( "/^\d+$/", otw_get( 'bmi', '' ) ) ){
    	
    		if( otw_get( 'bmi', '' ) != $listID ){
    			$currentPage = 1;
    		}
      }else{
    	    $currentPage = 1;
      }
      
      $otw_posts_result = $this->otwBMQuery->getPosts( $otw_bm_options, $currentPage );

      return $this->otwDispatcher->generateTemplate( $otw_bm_options, $otw_posts_result, $templateOptions );

    } else {
      $errorMsg = '<p>';
      $errorMsg .= esc_html__('Woops, we have encountered an error. The List you are trying to use can not be found: ', 'otw_bm');
      $errorMsg .= 'otw-bm-list-'.$attr['id'].'<br/>';
      $errorMsg .= '</p>';

      return $errorMsg;
    }
  }

  /**
   * Load Widget Class
   * Init Widget Class
   */
  public function bm_register_widgets () {
    register_widget( 'OTWBM_Widget' );
  }

  /**
   * Load Resources for FE - CSS and JS
   */
  public function register_fe_resources () {
    $uniqueHash = wp_create_nonce("otw_bm_social_share"); 
    $socialShareLink = admin_url( 'admin-ajax.php?action=social_share&nonce='. $uniqueHash );

    wp_register_script( 
      'fancybox', 
      plugins_url() . DS . OTW_BM_PATH . DS .'frontend'. DS .'js'. DS .'jquery.fancybox.min.js', 
      array( 'jquery' )
    );
    wp_register_script( 
      'flexslider', 
      plugins_url() . DS . OTW_BM_PATH . DS .'frontend'. DS .'js'. DS .'jquery.flexslider.min.js', 
      array( 'jquery' )
    );
    wp_register_script( 
      'infinitescroll', 
      plugins_url() . DS . OTW_BM_PATH . DS .'frontend'. DS .'js'. DS .'jquery.infinitescroll.min.js', 
      array( 'jquery' )
    );
    wp_register_script( 
      'isotope', 
      plugins_url() . DS . OTW_BM_PATH . DS .'frontend'. DS .'js'. DS .'isotope.pkgd.min.js', 
      array( 'jquery' )
    );
    wp_register_script( 
      'pixastic', 
      plugins_url() . DS . OTW_BM_PATH . DS .'frontend'. DS .'js'. DS .'pixastic.custom.min.js', 
      array( 'jquery' )
    );
    wp_register_script( 
      'fitvid',
      plugins_url() . DS . OTW_BM_PATH . DS .'frontend'. DS .'js'. DS .'jquery.fitvids.js', 
      array( 'jquery' )
    );
    wp_register_script( 
      'otw-bm-main-script', 
      plugins_url() . DS . OTW_BM_PATH . DS .'frontend'. DS .'js'. DS .'script.js', 
      array( 'jquery' ), '', true
    );
    

    // Custom Scripts + Plugins
    wp_enqueue_script( 'fancybox' );
    wp_enqueue_script( 'flexslider' );
    wp_enqueue_script( 'infinitescroll' );
    wp_enqueue_script( 'isotope' );
    wp_enqueue_script( 'pixastic' );
    wp_enqueue_script( 'fitvid' );
    wp_enqueue_script( 'otw-bm-main-script' );

	$otw_js_labels = array( 'otw_bm_loading_text' =>esc_html__( 'Loading posts...', 'otw_bm' ),
			    'otw_bm_no_more_posts_text' => esc_html__( 'No More Posts Found', 'otw_bm' )
			);
	wp_add_inline_script( 'otw-bm-main-script', 'var otw_bm_js_labels = '.json_encode( $otw_js_labels ).';', 'before' );
	wp_add_inline_script( 'otw-bm-main-script', 'var socialShareURL = '.json_encode( $socialShareLink ).';', 'before' ); 


    wp_register_style( 
      'otw-bm-default', 
      plugins_url() . DS . OTW_BM_PATH . DS .'frontend'. DS .'css'. DS .'default.css' 
    );
    wp_register_style( 
      'font-awesome', 
      plugins_url() . DS . OTW_BM_PATH . DS .'frontend'. DS .'css'. DS .'font-awesome.min.css' 
    );
    wp_register_style( 
      'otw-bm-bm', 
      plugins_url() . DS . OTW_BM_PATH . DS .'frontend'. DS .'css'. DS .'otw-blog-manager.css' 
    );
    wp_register_style( 
      'otw-bm-grid', 
      plugins_url() . DS . OTW_BM_PATH . DS .'frontend'. DS .'css'. DS .'otw-grid.css' 
    );
    
    if( get_option( 'otw_bm_has_custom_css' ) !== '0' ){
	wp_register_style( 'otw-bm-custom', SKIN_BM_URL .'custom.css'  );
    }

    wp_enqueue_style( 'otw-bm-default' );
    wp_enqueue_style( 'font-awesome' );
    wp_enqueue_style( 'otw-bm-bm' );
    wp_enqueue_style( 'otw-bm-grid' );
    
    if( get_option( 'otw_bm_has_custom_css' ) !== '0' ){
	wp_enqueue_style( 'otw-bm-custom' );
    }

  }

  public function otw_bm_get_posts () {
    // Load $templateOptions - array
    include('include' . DS . 'content.php');

    $otw_bm_options = $this->otwBMQuery->getItemById( otw_get( 'bmi', '' ) );
    $otw_bm_results = $this->otwBMQuery->getPosts( $otw_bm_options, otw_get( 'page', '' ) );
    $paginationPageNo = (int) otw_get( 'page', '' ) + 1;

    if( !empty($otw_bm_results->posts) ) {
      echo $this->otwDispatcher->generateTemplate( $otw_bm_options, $otw_bm_results, $templateOptions, true, $paginationPageNo );
    } else {
      echo ' ';  
    }
    exit;
  }

  public function otw_bm_social_share () {
    include( 'social-shares.php' );

    if( otw_post( 'url', false )  && otw_post( 'url', '' ) != '' && filter_var(otw_post( 'url', '' ), FILTER_VALIDATE_URL)){
      $url = otw_post( 'url', '' );
      $otw_social_shares = new otw_social_shares($url);
      
      echo $otw_social_shares->otw_get_shares();
    } else {
      echo json_encode(array('info' => 'error', 'msg' => 'URL is not valid!'));
    }
    exit;
  }
  
	public function redirect( $location ){
		
		header("Location: $location" );
		
		return true;
	}
	
	function factory_message( $params ){
		
		global $otw_bm_plugin_id;
		
		if( isset( $params['plugin'] ) && $otw_bm_plugin_id == $params['plugin'] ){
			
			//filter out some messages if need it
		}
		if( isset( $params['message'] ) )
		{
			return $params['message'];
		}
		return $params;
	}


} // End OTWBlogManager Class

} // End IF Class Exists

// DB Query
require_once( 'classes' . DS . 'otw_bm_query.php' );

// Template Dispatcher
require_once( 'classes' . DS . 'otw_dispatcher.php' );

// Custom CSS
require_once( 'classes' . DS . 'otw_css.php' );

// Add Image Crop Functionality
require_once( 'classes' . DS . 'otw_image_crop.php' );

// Register Widgets
require_once( 'classes' . DS . 'otw_blog_manager_widgets.php' );

// Register VC add on
require_once( 'classes' . DS . 'otw_blog_manager_vc_addon.php' );

$otwBlogMangerPlugin = new OTWBlogManager();
