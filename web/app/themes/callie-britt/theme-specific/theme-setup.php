<?php
/**
 * Setup theme-specific fonts and colors
 *
 * @package WordPress
 * @subpackage CALLIE-BRITT
 * @since CALLIE-BRITT 1.0.22
 */

// If this theme is a free version of premium theme
if (!defined("CALLIE_BRITT_THEME_FREE"))		define("CALLIE_BRITT_THEME_FREE", false);
if (!defined("CALLIE_BRITT_THEME_FREE_WP"))	define("CALLIE_BRITT_THEME_FREE_WP", false);

// If this theme uses multiple skins
if (!defined("CALLIE_BRITT_ALLOW_SKINS"))	define("CALLIE_BRITT_ALLOW_SKINS", false);
if (!defined("CALLIE_BRITT_DEFAULT_SKIN"))	define("CALLIE_BRITT_DEFAULT_SKIN", 'default');

// Theme storage
// Attention! Must be in the global namespace to compatibility with WP CLI
$GLOBALS['CALLIE_BRITT_STORAGE'] = array(

	// Theme required plugin's slugs
	'required_plugins' => array_merge(

		// List of plugins for both - FREE and PREMIUM versions
		//-----------------------------------------------------
		array(
			// Required plugins
			// DON'T COMMENT OR REMOVE NEXT LINES!
			'trx_addons'					=> esc_html__('ThemeREX Addons', 'callie-britt'),
			//'callie-britt-addons'				=> esc_html__('Callie Britt Addons', 'callie-britt'),
			
			// If theme use OCDI instead (or both) ThemeREX Addons Installer
			//'one-click-demo-import'		=> esc_html__('One Click Demo Import', 'callie-britt'),

			// Recommended (supported) plugins for both (lite and full) versions
			// If plugin not need - comment (or remove) it
			'mailchimp-for-wp'				=> esc_html__('MailChimp for WP', 'callie-britt'),
			// GDPR Support: uncomment only one of two following plugins
			//'gdpr-framework'   => esc_html__( 'The GDPR Framework', 'callie-britt' ),
			'wp-gdpr-compliance' => esc_html__( 'WP GDPR Compliance', 'callie-britt' ),
		),

		// List of plugins for the FREE version only
		//-----------------------------------------------------
		CALLIE_BRITT_THEME_FREE 
			? array(
					// Recommended (supported) plugins for the FREE (lite) version
					) 

		// List of plugins for the PREMIUM version only
		//-----------------------------------------------------
			: array(
					// Recommended (supported) plugins for the PRO (full) version
					// If plugin not need - comment (or remove) it
					'essential-grid'			=> esc_html__('Essential Grid', 'callie-britt'),
					'revslider'					=> esc_html__('Revolution Slider', 'callie-britt'),
					'the-events-calendar'		=> esc_html__('The Events Calendar', 'callie-britt'),
					'js_composer'				=> esc_html__('WPBakery PageBuilder', 'callie-britt'),
					'booked'					=> esc_html__('Booked Appointments', 'callie-britt'),
					'vc-extensions-bundle'		=> esc_html__('All In One Addons for WPBakery Page Builder', 'callie-britt'),
					)
	),

	// Theme-specific blog layouts
	'blog_styles' => array_merge(
		// Layouts for both - FREE and PREMIUM versions
		//-----------------------------------------------------
		array(
			'excerpt'	=> array(
							'title'		=> esc_html__('Standard', 'callie-britt'),
							'archive'	=> 'index-excerpt',
							'item'		=> 'content-excerpt',
							'styles'	=> 'excerpt'
							),
			'classic'	=> array(
							'title'		=> esc_html__('Classic', 'callie-britt'),
							'archive'	=> 'index-classic',
							'item'		=> 'content-classic',
							'columns'	=> array(2,3),
							'styles'	=> 'classic'
							)
		),

		// Layouts for the FREE version only
		//-----------------------------------------------------
		CALLIE_BRITT_THEME_FREE 
		? array() 

		// Layouts for the PREMIUM version only
		//-----------------------------------------------------
		: array(
			'portfolio'	=> array(
							'title'		=> esc_html__('Portfolio', 'callie-britt'),
							'archive'	=> 'index-portfolio',
							'item'		=> 'content-portfolio',
							'columns'	=> array(2,3,4),
							'styles'	=> 'portfolio'
							),
			'chess'	=> array(
							'title'		=> esc_html__('Chess', 'callie-britt'),
							'archive'	=> 'index-chess',
							'item'		=> 'content-chess',
							'columns'	=> array(1,2,3),
							'styles'	=> 'chess'
							)
		)
	),

	// Key validator: market[env|loc]-vendor[axiom|ancora|themerex]
	'theme_pro_key'		=> CALLIE_BRITT_THEME_FREE 
								? 'env-axiom' 
								: '',

	// Theme-specific URLs (will be escaped in place of the output)
	'theme_demo_url'	=> 'http://callie-britt.axiomthemes.com',
	'theme_doc_url'		=> 'http://callie-britt.axiomthemes.com/doc',
	'theme_download_url'=> 'http://theme.download.url',

	'theme_support_url'	=> 'http://axiomthemes.ticksy.com',							// Axiom

	'theme_video_url'	=> 'https://www.youtube.com/channel/UCdIjRh7-lPVHqTTKpaf8PLA',	// Axiom


	// Comma separated slugs of theme-specific categories (for get relevant news in the dashboard widget)
	// (i.e. 'children,kindergarten')
	'theme_categories'  => '',

	// Responsive resolutions
	// Parameters to create css media query: min, max
	'responsive'		=> array(
						// By device
						'desktop'	=> array('min' => 1680),
						'notebook'	=> array('min' => 1280, 'max' => 1679),
						'tablet'	=> array('min' =>  768, 'max' => 1279),
						'mobile'	=> array('max' =>  767),
						// By size
						'xxl'		=> array('max' => 1679),
						'xl'		=> array('max' => 1439),
						'lg'		=> array('max' => 1279),
						'md'		=> array('max' => 1023),
						'nm'	=> array('max' => 960),
						'sm'		=> array('max' =>  767),
						'sm_wp'		=> array('max' =>  600),
						'xs'		=> array('max' =>  479)
						)
);

// Theme init priorities:
// Action 'after_setup_theme'
// 1 - register filters to add/remove lists items in the Theme Options
// 2 - create Theme Options
// 3 - add/remove Theme Options elements
// 5 - load Theme Options. Attention! After this step you can use only basic options (not overriden)
// 9 - register other filters (for installer, etc.)
//10 - standard Theme init procedures (not ordered)
// Action 'wp_loaded'
// 1 - detect override mode. Attention! Only after this step you can use overriden options (separate values for the shop, courses, etc.)

if ( !function_exists('callie_britt_customizer_theme_setup1') ) {
	add_action( 'after_setup_theme', 'callie_britt_customizer_theme_setup1', 1 );
	function callie_britt_customizer_theme_setup1() {

		// -----------------------------------------------------------------
		// -- ONLY FOR PROGRAMMERS, NOT FOR CUSTOMER
		// -- Internal theme settings
		// -----------------------------------------------------------------
		callie_britt_storage_set('settings', array(

			'duplicate_options'		=> 'child',		// none  - use separate options for the main and the child-theme
													// child - duplicate theme options from the main theme to the child-theme only
													// both  - sinchronize changes in the theme options between main and child themes

			'customize_refresh'		=> 'auto',		// Refresh method for preview area in the Appearance - Customize:
													// auto - refresh preview area on change each field with Theme Options
													// manual - refresh only obn press button 'Refresh' at the top of Customize frame

			'max_load_fonts'		=> 5,			// Max fonts number to load from Google fonts or from uploaded fonts

			'comment_after_name'	=> true,		// Place 'comment' field after the 'name' and 'email'

			'icons_selector'		=> 'internal',	// Icons selector in the shortcodes:
													// vc (default) - standard VC (very slow) or Elementor's icons selector (not support images and svg)
													// internal - internal popup with plugin's or theme's icons list (fast and support images and svg)

			'icons_type'			=> 'icons',		// Type of icons (if 'icons_selector' is 'internal'):
													// icons  - use font icons to present icons
													// images - use images from theme's folder trx_addons/css/icons.png
													// svg    - use svg from theme's folder trx_addons/css/icons.svg

			'socials_type'			=> 'icons',		// Type of socials icons (if 'icons_selector' is 'internal'):
													// icons  - use font icons to present social networks
													// images - use images from theme's folder trx_addons/css/icons.png
													// svg    - use svg from theme's folder trx_addons/css/icons.svg

			'instagram_app'			=> 'internal',	// Use internal Instagram App or user must create own application
													// to display photos from his account
													// internal - use our application
													// client   - user must create own application
			
			'check_min_version'		=> true,		// Check if exists a .min version of .css and .js and return path to it
													// instead the path to the original file
													// (if debug_mode is off and modification time of the original file < time of the .min file)

			'autoselect_menu'		=> false,		// Show any menu if no menu selected in the location 'main_menu'
													// (for example, the theme is just activated)

			'disable_jquery_ui'		=> false,		// Prevent loading custom jQuery UI libraries in the third-party plugins
		
			'use_mediaelements'		=> true,		// Load script "Media Elements" to play video and audio
			
			'tgmpa_upload'			=> false,		// Allow upload not pre-packaged plugins via TGMPA
			
			'allow_no_image'		=> false,		// Allow use image placeholder if no image present in the blog, related posts, post navigation, etc.

			'separate_schemes'		=> true, 		// Save color schemes to the separate files __color_xxx.css (true) or append its to the __custom.css (false)

			'allow_fullscreen'		=> false, 		// Allow cases 'fullscreen' and 'fullwide' for the body style in the Theme Options
													// In the Page Options this styles are present always (can be removed if filter 'callie_britt_filter_allow_fullscreen' return false)

			'attachments_navigation'=> false 		// Add arrows on the single attachment page to navigate to the prev/next attachment
		));


		// -----------------------------------------------------------------
		// -- Theme fonts (Google and/or custom fonts)
		// -----------------------------------------------------------------
		
		// Fonts to load when theme start
		// It can be Google fonts or uploaded fonts, placed in the folder /css/font-face/font-name inside the theme folder
		// Attention! Font's folder must have name equal to the font's name, with spaces replaced on the dash '-'
		// For example: font name 'TeX Gyre Termes', folder 'TeX-Gyre-Termes'
		callie_britt_storage_set('load_fonts', array(
			// Google font
			array(
				'name'	 => 'Domine',
				'family' => 'serif',
				'styles' => '400,700'		// Parameter 'style' used only for the Google fonts
				),
			array(
				'name'   => 'Poppins',
				'family' => 'sans-serif',
				'styles' => '100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i'
				),
			array(
				'name'   => 'Yesteryear',
				'family' => 'cursive',
				'styles' => ''
				)
		));
		
		// Characters subset for the Google fonts. Available values are: latin,latin-ext,cyrillic,cyrillic-ext,greek,greek-ext,vietnamese
		callie_britt_storage_set('load_fonts_subset', 'latin,latin-ext');
		
		// Settings of the main tags
		// Attention! Font name in the parameter 'font-family' will be enclosed in the quotes and no spaces after comma!
		// For example:	'font-family' => '"Roboto",sans-serif'	- is correct
		// 				'font-family' => '"Roboto", sans-serif'	- is incorrect
		// 				'font-family' => 'Roboto,sans-serif'	- is incorrect

		callie_britt_storage_set('theme_fonts', array(
			'p' => array(
				'title'				=> esc_html__('Main text', 'callie-britt'),
				'description'		=> esc_html__('Font settings of the main text of the site. Attention! For correct display of the site on mobile devices, use only units "rem", "em" or "ex"', 'callie-britt'),
				'font-family'		=> '"Domine",serif',
				'font-size' 		=> '1.07rem',
				'font-weight'		=> '300',
				'font-style'		=> 'normal',
				'line-height'		=> '1.75em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '-0.010em',
				'margin-top'		=> '0em',
				'margin-bottom'		=> '1.4em'
				),
			'h1' => array(
				'title'				=> esc_html__('Heading 1', 'callie-britt'),
				'font-family'		=> '"Poppins",sans-serif',
				'font-size' 		=> '4.285rem',
				'font-weight'		=> '700',
				'font-style'		=> 'normal',
				'line-height'		=> '1.25em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '-0.025em',
				'margin-top'		=> '1.1em',
				'margin-bottom'		=> '1.1em'
				),
			'h2' => array(
				'title'				=> esc_html__('Heading 2', 'callie-britt'),
				'font-family'		=> '"Poppins",sans-serif',
				'font-size' 		=> '3.571rem',
				'font-weight'		=> '600',
				'font-style'		=> 'normal',
				'line-height'		=> '1.2em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '-0.01em',
				'margin-top'		=> '1em',
				'margin-bottom'		=> '1em'
				),
			'h3' => array(
				'title'				=> esc_html__('Heading 3', 'callie-britt'),
				'font-family'		=> '"Poppins",sans-serif',
				'font-size' 		=> '2.571em',
				'font-weight'		=> '600',
				'font-style'		=> 'normal',
				'line-height'		=> '1.278em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '-0.025em',
				'margin-top'		=> '1.2em',
				'margin-bottom'		=> '1.2em'
				),
			'h4' => array(
				'title'				=> esc_html__('Heading 4', 'callie-britt'),
				'font-family'		=> '"Poppins",sans-serif',
				'font-size' 		=> '2.142rem',
				'font-weight'		=> '600',
				'font-style'		=> 'normal',
				'line-height'		=> '1.333em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '-0.025em',
				'margin-top'		=> '1.3em',
				'margin-bottom'		=> '1.3em'
				),
			'h5' => array(
				'title'				=> esc_html__('Heading 5', 'callie-britt'),
				'font-family'		=> '"Poppins",sans-serif',
				'font-size' 		=> '1.714rem',
				'font-weight'		=> '600',
				'font-style'		=> 'normal',
				'line-height'		=> '1.5em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '-0.025em',
				'margin-top'		=> '1.3em',
				'margin-bottom'		=> '1.3em'
				),
			'h6' => array(
				'title'				=> esc_html__('Heading 6', 'callie-britt'),
				'font-family'		=> '"Poppins",sans-serif',
				'font-size' 		=> '1.285rem',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1.722em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '-0.025em',
				'margin-top'		=> '1.1em',
				'margin-bottom'		=> '1.1em'
				),
			'logo' => array(
				'title'				=> esc_html__('Logo text', 'callie-britt'),
				'description'		=> esc_html__('Font settings of the text case of the logo', 'callie-britt'),
				'font-family'		=> '"Yesteryear",cursive',
				'font-size' 		=> '1.8em',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1.25em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '1px'
				),
			'button' => array(
				'title'				=> esc_html__('Buttons', 'callie-britt'),
				'font-family'		=> '"Poppins",sans-serif',
				'font-size' 		=> '1.1428rem',
				'font-weight'		=> '500',
				'font-style'		=> 'normal',
				'line-height'		=> '22px',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0'
				),
			'input' => array(
				'title'				=> esc_html__('Input fields', 'callie-britt'),
				'description'		=> esc_html__('Font settings of the input fields, dropdowns and textareas', 'callie-britt'),
				'font-family'		=> 'inherit',
				'font-size' 		=> '1em',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1.5em',	// Attention! Firefox don't allow line-height less then 1.5em in the select
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0px'
				),
			'info' => array(
				'title'				=> esc_html__('Post meta', 'callie-britt'),
				'description'		=> esc_html__('Font settings of the post meta: date, counters, share, etc.', 'callie-britt'),
				'font-family'		=> 'inherit',
				'font-size' 		=> '13px',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1.5em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0px',
				'margin-top'		=> '0.4em',
				'margin-bottom'		=> ''
				),
			'menu' => array(
				'title'				=> esc_html__('Main menu', 'callie-britt'),
				'description'		=> esc_html__('Font settings of the main menu items', 'callie-britt'),
				'font-family'		=> '"Poppins",sans-serif',
				'font-size' 		=> '1.0714em',
				'font-weight'		=> '300',
				'font-style'		=> 'normal',
				'line-height'		=> '1.5em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0px'
				),
			'submenu' => array(
				'title'				=> esc_html__('Dropdown menu', 'callie-britt'),
				'description'		=> esc_html__('Font settings of the dropdown menu items', 'callie-britt'),
				'font-family'		=> '"Poppins",sans-serif',
				'font-size' 		=> '0.8667em',
				'font-weight'		=> '300',
				'font-style'		=> 'normal',
				'line-height'		=> '1.5em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0px'
				)
		));
		
		
		// -----------------------------------------------------------------
		// -- Theme colors for customizer
		// -- Attention! Inner scheme must be last in the array below
		// -----------------------------------------------------------------
		callie_britt_storage_set('scheme_color_groups', array(
			'main'	=> array(
							'title'			=> __('Main', 'callie-britt'),
							'description'	=> __('Colors of the main content area', 'callie-britt')
							),
			'alter'	=> array(
							'title'			=> __('Alter', 'callie-britt'),
							'description'	=> __('Colors of the alternative blocks (sidebars, etc.)', 'callie-britt')
							),
			'extra'	=> array(
							'title'			=> __('Extra', 'callie-britt'),
							'description'	=> __('Colors of the extra blocks (dropdowns, price blocks, table headers, etc.)', 'callie-britt')
							),
			'inverse' => array(
							'title'			=> __('Inverse', 'callie-britt'),
							'description'	=> __('Colors of the inverse blocks - when link color used as background of the block (dropdowns, blockquotes, etc.)', 'callie-britt')
							),
			'input'	=> array(
							'title'			=> __('Input', 'callie-britt'),
							'description'	=> __('Colors of the form fields (text field, textarea, select, etc.)', 'callie-britt')
							),
			)
		);
		callie_britt_storage_set('scheme_color_names', array(
			'bg_color'	=> array(
							'title'			=> __('Background color', 'callie-britt'),
							'description'	=> __('Background color of this block in the normal state', 'callie-britt')
							),
			'bg_hover'	=> array(
							'title'			=> __('Background hover', 'callie-britt'),
							'description'	=> __('Background color of this block in the hovered state', 'callie-britt')
							),
			'bd_color'	=> array(
							'title'			=> __('Border color', 'callie-britt'),
							'description'	=> __('Border color of this block in the normal state', 'callie-britt')
							),
			'bd_hover'	=>  array(
							'title'			=> __('Border hover', 'callie-britt'),
							'description'	=> __('Border color of this block in the hovered state', 'callie-britt')
							),
			'text'		=> array(
							'title'			=> __('Text', 'callie-britt'),
							'description'	=> __('Color of the plain text inside this block', 'callie-britt')
							),
			'text_dark'	=> array(
							'title'			=> __('Text dark', 'callie-britt'),
							'description'	=> __('Color of the dark text (bold, header, etc.) inside this block', 'callie-britt')
							),
			'text_light'=> array(
							'title'			=> __('Text light', 'callie-britt'),
							'description'	=> __('Color of the light text (post meta, etc.) inside this block', 'callie-britt')
							),
			'text_link'	=> array(
							'title'			=> __('Link', 'callie-britt'),
							'description'	=> __('Color of the links inside this block', 'callie-britt')
							),
			'text_hover'=> array(
							'title'			=> __('Link hover', 'callie-britt'),
							'description'	=> __('Color of the hovered state of links inside this block', 'callie-britt')
							),
			'text_link2'=> array(
							'title'			=> __('Link 2', 'callie-britt'),
							'description'	=> __('Color of the accented texts (areas) inside this block', 'callie-britt')
							),
			'text_hover2'=> array(
							'title'			=> __('Link 2 hover', 'callie-britt'),
							'description'	=> __('Color of the hovered state of accented texts (areas) inside this block', 'callie-britt')
							),
			'text_link3'=> array(
							'title'			=> __('Link 3', 'callie-britt'),
							'description'	=> __('Color of the other accented texts (buttons) inside this block', 'callie-britt')
							),
			'text_hover3'=> array(
							'title'			=> __('Link 3 hover', 'callie-britt'),
							'description'	=> __('Color of the hovered state of other accented texts (buttons) inside this block', 'callie-britt')
							)
			)
		);
		callie_britt_storage_set('schemes', array(
		
			// Color scheme: 'default'
			'default' => array(
				'title'	 => esc_html__('Default', 'callie-britt'),
				'internal' => true,
				'colors' => array(
					
					// Whole block border and background
					'bg_color'			=> '#ffffff',
					'bd_color'			=> '#dbdbdb',
		
					// Text and links colors
					'text'				=> '#637375',
					'text_light'		=> '#a09f9d',
					'text_dark'			=> '#2f3030',
					'text_link'			=> '#7fb98d',
					'text_hover'		=> '#f89f73',
					'text_link2'		=> '#f89f73',
					'text_hover2'		=> '#7fb98d',
					'text_link3'		=> '#2f3030',
					'text_hover3'		=> '#ffffff',
		
					// Alternative blocks (sidebar, tabs, alternative blocks, etc.)
					'alter_bg_color'	=> '#ecebe6',
					'alter_bg_hover'	=> '#ecebe6',
					'alter_bd_color'	=> '#e2e1dc',
					'alter_bd_hover'	=> '#ffffff',
					'alter_text'		=> '#707171',
					'alter_light'		=> '#a09f9d',
					'alter_dark'		=> '#525855',
					'alter_link'		=> '#f89f73',
					'alter_hover'		=> '#7fb98d',
					'alter_link2'		=> '#ffffff',
					'alter_hover2'		=> '#f89f73',
					'alter_link3'		=> '#525855',
					'alter_hover3'		=> '#ecebe6',
		
					// Extra blocks (submenu, tabs, color blocks, etc.)
					'extra_bg_color'	=> '#7fb98d',
					'extra_bg_hover'	=> '#ffffff',
					'extra_bd_color'	=> '#99c7a4',
					'extra_bd_hover'	=> '#ffffff',
					'extra_text'		=> '#ffffff',
					'extra_light'		=> '#a09f9d',
					'extra_dark'		=> '#ffffff',
					'extra_link'		=> '#51825d',
					'extra_hover'		=> '#ffffff',
					'extra_link2'		=> '#7fb98d',
					'extra_hover2'		=> '#ffffff',
					'extra_link3'		=> '#ffffff',
					'extra_hover3'		=> '#ffffff',
		
					// Input fields (form's fields and textarea)
					'input_bg_color'	=> '#ffffff',
					'input_bg_hover'	=> '#ffffff',
					'input_bd_color'	=> '#ecebe6',
					'input_bd_hover'	=> '#78ad85',
					'input_text'		=> '#474747',
					'input_light'		=> '#ffffff',
					'input_dark'		=> '#474747',
					
					// Inverse blocks (text and links on the 'text_link' background)
					'inverse_bd_color'	=> '#ffffff',
					'inverse_bd_hover'	=> '#ffffff',
					'inverse_text'		=> '#ffffff',
					'inverse_light'		=> '#ffffff',
					'inverse_dark'		=> '#ffffff',
					'inverse_link'		=> '#ffffff',
					'inverse_hover'		=> '#ffffff'
				)
			),
		
			// Color scheme: 'dark'
			'dark' => array(
				'title'  => esc_html__('Dark', 'callie-britt'),
				'internal' => true,
				'colors' => array(
					
					// Whole block border and background
					'bg_color'			=> '#2f3030',
					'bd_color'			=> '#3c3d3d',
		
					// Text and links colors
					'text'				=> '#c8cecf',
					'text_light'		=> '#c8cecf',
					'text_dark'			=> '#ffffff',
					'text_link'			=> '#7fb98d',
					'text_hover'		=> '#ffa072',
					'text_link2'		=> '#f89f73',
					'text_hover2'		=> '#7fb98d',
					'text_link3'		=> '#2f3030',
					'text_hover3'		=> '#ffffff',

					// Alternative blocks (sidebar, tabs, alternative blocks, etc.)
					'alter_bg_color'	=> '#272828',
					'alter_bg_hover'	=> '#3c3d3d',
					'alter_bd_color'	=> '#3c3d3d',
					'alter_bd_hover'	=> '#ffffff',
					'alter_text'		=> '#c8cecf',
					'alter_light'		=> '#c8cecf',
					'alter_dark'		=> '#ffffff',
					'alter_link'		=> '#f89f73',
					'alter_hover'		=> '#f89f73',
					'alter_link2'		=> '#f89f73',
					'alter_hover2'		=> '#2f3030',
					'alter_link3'		=> '#525855',
					'alter_hover3'		=> '#ecebe6',

					// Extra blocks (submenu, tabs, color blocks, etc.)
					'extra_bg_color'	=> '#7fb98d',
					'extra_bg_hover'	=> '#3b4150',
					'extra_bd_color'	=> '#99c7a4',
					'extra_bd_hover'	=> '#ffffff',
					'extra_text'		=> '#c8cecf',
					'extra_light'		=> '#c8cecf',
					'extra_dark'		=> '#ffffff',
					'extra_link'		=> '#51825d',
					'extra_hover'		=> '#ffffff',
					'extra_link2'		=> '#ffffff',
					'extra_hover2'		=> '#ffffff',
					'extra_link3'		=> '#ffffff',
					'extra_hover3'		=> '#ffffff',

					// Input fields (form's fields and textarea)
					'input_bg_color'	=> '#3c3d3d',
					'input_bg_hover'	=> '#3c3d3d',
					'input_bd_color'	=> '#ffffff',
					'input_bd_hover'	=> '#78ad85',
					'input_text'		=> '#ffffff',
					'input_light'		=> '#ffffff',
					'input_dark'		=> '#ffffff',
					
					// Inverse blocks (text and links on the 'text_link' background)
					'inverse_bd_color'	=> '#ffffff',
					'inverse_bd_hover'	=> '#ffffff',
					'inverse_text'		=> '#ffffff',
					'inverse_light'		=> '#ffffff',
					'inverse_dark'		=> '#ffffff',
					'inverse_link'		=> '#ffffff',
					'inverse_hover'		=> '#ffffff'
				)
			)
		
		));
		
		// Simple schemes substitution
		callie_britt_storage_set('schemes_simple', array(
			// Main color	// Slave elements and it's darkness koef.
			'text_link'		=> array('alter_hover' => 1,	'extra_link' => 1, 'inverse_bd_color' => 0.85, 'inverse_bd_hover' => 0.7),
			'text_hover'	=> array('alter_link' => 1,		'extra_hover' => 1),
			'text_link2'	=> array('alter_hover2' => 1,	'extra_link2' => 1),
			'text_hover2'	=> array('alter_link2' => 1,	'extra_hover2' => 1),
			'text_link3'	=> array('alter_hover3' => 1,	'extra_link3' => 1),
			'text_hover3'	=> array('alter_link3' => 1,	'extra_hover3' => 1)
		));

		// Additional colors for each scheme
		// Parameters:	'color' - name of the color from the scheme that should be used as source for the transformation
		//				'alpha' - to make color transparent (0.0 - 1.0)
		//				'hue', 'saturation', 'brightness' - inc/dec value for each color's component
		callie_britt_storage_set('scheme_colors_add', array(
			'bg_color_0'		=> array('color' => 'bg_color',			'alpha' => 0),
			'bg_color_02'		=> array('color' => 'bg_color',			'alpha' => 0.2),
			'bg_color_07'		=> array('color' => 'bg_color',			'alpha' => 0.7),
			'bg_color_08'		=> array('color' => 'bg_color',			'alpha' => 0.8),
			'bg_color_09'		=> array('color' => 'bg_color',			'alpha' => 0.9),
			'alter_bg_color_07'	=> array('color' => 'alter_bg_color',	'alpha' => 0.7),
			'alter_bg_color_04'	=> array('color' => 'alter_bg_color',	'alpha' => 0.4),
			'alter_bg_color_02'	=> array('color' => 'alter_bg_color',	'alpha' => 0.2),
			'alter_bd_color_02'	=> array('color' => 'alter_bd_color',	'alpha' => 0.2),
			'inverse_bd_color_02'	=> array('color' => 'inverse_bd_color',	'alpha' => 0.2),
			'alter_link_02'		=> array('color' => 'alter_link',		'alpha' => 0.2),
			'alter_link_07'		=> array('color' => 'alter_link',		'alpha' => 0.7),
			'extra_bg_color_07'	=> array('color' => 'extra_bg_color',	'alpha' => 0.7),
			'extra_link_02'		=> array('color' => 'extra_link',		'alpha' => 0.2),
			'extra_link_07'		=> array('color' => 'extra_link',		'alpha' => 0.7),
			'text_dark_07'		=> array('color' => 'text_dark',		'alpha' => 0.7),
			'text_link_02'		=> array('color' => 'text_link',		'alpha' => 0.2),
			'text_link_07'		=> array('color' => 'text_link',		'alpha' => 0.7),
			'text_link_blend'	=> array('color' => 'text_link',		'hue' => 2, 'saturation' => -5, 'brightness' => 5),
			'alter_link_blend'	=> array('color' => 'alter_link',		'hue' => 2, 'saturation' => -5, 'brightness' => 5)
		));
		
		// Parameters to set order of schemes in the css
		callie_britt_storage_set('schemes_sorted', array(
													'color_scheme', 'header_scheme', 'menu_scheme', 'sidebar_scheme', 'footer_scheme'
													));
		
		
		// -----------------------------------------------------------------
		// -- Theme specific thumb sizes
		// -----------------------------------------------------------------
		callie_britt_storage_set('theme_thumbs', apply_filters('callie_britt_filter_add_thumb_sizes', array(
			// Width of the image is equal to the content area width (without sidebar)
			// Height is fixed
			'callie-britt-thumb-huge'		=> array(
												'size'	=> array(1278, 718, true),
												'title' => esc_html__( 'Huge image', 'callie-britt' ),
												'subst'	=> 'trx_addons-thumb-huge'
												),
			// Width of the image is equal to the content area width (with sidebar)
			// Height is fixed
			'callie-britt-thumb-big' 		=> array(
												'size'	=> array( 760, 428, true),
												'title' => esc_html__( 'Large image', 'callie-britt' ),
												'subst'	=> 'trx_addons-thumb-big'
												),

			// Width of the image is equal to the 1/3 of the content area width (without sidebar)
			// Height is fixed
			'callie-britt-thumb-med' 		=> array(
												'size'	=> array( 370, 208, true),
												'title' => esc_html__( 'Medium image', 'callie-britt' ),
												'subst'	=> 'trx_addons-thumb-medium'
												),

			// Small square image (for avatars in comments, etc.)
			'callie-britt-thumb-tiny' 		=> array(
												'size'	=> array(  90,  90, true),
												'title' => esc_html__( 'Small square avatar', 'callie-britt' ),
												'subst'	=> 'trx_addons-thumb-tiny'
												),

			// Width of the image is equal to the content area width (with sidebar)
			// Height is proportional (only downscale, not crop)
			'callie-britt-thumb-masonry-big' => array(
												'size'	=> array( 760,   0, false),		// Only downscale, not crop
												'title' => esc_html__( 'Masonry Large (scaled)', 'callie-britt' ),
												'subst'	=> 'trx_addons-thumb-masonry-big'
												),

			// Width of the image is equal to the 1/3 of the full content area width (without sidebar)
			// Height is proportional (only downscale, not crop)
			'callie-britt-thumb-masonry'		=> array(
												'size'	=> array( 370,   0, false),		// Only downscale, not crop
												'title' => esc_html__( 'Masonry (scaled)', 'callie-britt' ),
												'subst'	=> 'trx_addons-thumb-masonry'
												)
			))
		);
	}
}




//------------------------------------------------------------------------
// One-click import support
//------------------------------------------------------------------------

// Set theme specific importer options
if ( !function_exists( 'callie_britt_importer_set_options' ) ) {
	add_filter( 'trx_addons_filter_importer_options', 'callie_britt_importer_set_options', 9 );
	function callie_britt_importer_set_options($options=array()) {
		if (is_array($options)) {
			// Save or not installer's messages to the log-file
			$options['debug'] = false;
			// Allow import/export functionality
			$options['allow_import'] = true;
			$options['allow_export'] = true;
			// Prepare demo data
			$options['demo_url'] = esc_url(callie_britt_get_protocol() . '://demofiles.axiomthemes.com/callie-britt/');
			// Required plugins
			$options['required_plugins'] = array_keys(callie_britt_storage_get('required_plugins'));
			// Set number of thumbnails to regenerate when its imported (if demo data was zipped without cropped images)
			// Set 0 to prevent regenerate thumbnails (if demo data archive is already contain cropped images)
			$options['regenerate_thumbnails'] = 3;
			// Default demo
			$options['files']['default']['title'] = esc_html__('Callie Britt Demo', 'callie-britt');
			$options['files']['default']['domain_dev'] = esc_url(callie_britt_get_protocol().'://callie-britt.axiomthemes.com');		// Developers domain
			$options['files']['default']['domain_demo']= esc_url(callie_britt_get_protocol().'://callie-britt.axiomthemes.com');		// Demo-site domain
			// If theme need more demo - just copy 'default' and change required parameter
			// For example:
			// 		$options['files']['dark_demo'] = $options['files']['default'];
			// 		$options['files']['dark_demo']['title'] = esc_html__('Dark Demo', 'callie-britt');
			// Banners
			$options['banners'] = array(
				array(
					'image' => callie_britt_get_file_url('theme-specific/theme-about/images/frontpage.png'),
					'title' => esc_html__('Front Page Builder', 'callie-britt'),
					'content' => wp_kses_post(__("Create your front page right in the WordPress Customizer. There's no need any page builder. Simply enable/disable sections, fill them out with content, and customize to your liking.", 'callie-britt')),
					'link_url' => esc_url('//www.youtube.com/watch?v=VT0AUbMl_KA'),
					'link_caption' => esc_html__('Watch Video Introduction', 'callie-britt'),
					'duration' => 20
					),
				array(
					'image' => callie_britt_get_file_url('theme-specific/theme-about/images/layouts.png'),
					'title' => esc_html__('Layouts Builder', 'callie-britt'),
					'content' => wp_kses_post(__('Use Layouts Builder to create and customize header and footer styles for your website. With a flexible page builder interface and custom shortcodes, you can create as many header and footer layouts as you want with ease.', 'callie-britt')),
					'link_url' => esc_url('//www.youtube.com/watch?v=pYhdFVLd7y4'),
					'link_caption' => esc_html__('Learn More', 'callie-britt'),
					'duration' => 20
					),
				array(
					'image' => callie_britt_get_file_url('theme-specific/theme-about/images/documentation.png'),
					'title' => esc_html__('Read Full Documentation', 'callie-britt'),
					'content' => wp_kses_post(__('Need more details? Please check our full online documentation for detailed information on how to use Callie Britt.', 'callie-britt')),
					'link_url' => esc_url(callie_britt_storage_get('theme_doc_url')),
					'link_caption' => esc_html__('Online Documentation', 'callie-britt'),
					'duration' => 15
					),
				array(
					'image' => callie_britt_get_file_url('theme-specific/theme-about/images/video-tutorials.png'),
					'title' => esc_html__('Video Tutorials', 'callie-britt'),
					'content' => wp_kses_post(__('No time for reading documentation? Check out our video tutorials and learn how to customize Callie Britt in detail.', 'callie-britt')),
					'link_url' => esc_url(callie_britt_storage_get('theme_video_url')),
					'link_caption' => esc_html__('Video Tutorials', 'callie-britt'),
					'duration' => 15
					),
				array(
					'image' => callie_britt_get_file_url('theme-specific/theme-about/images/studio.png'),
					'title' => esc_html__('Mockingbird Website Customization Studio', 'callie-britt'),
					'content' => wp_kses_post(__("Need a website fast? Order our custom service, and we'll build a website based on this theme for a very fair price. We can also implement additional functionality such as website translation, setting up WPML, and much more.", 'callie-britt')),
					'link_url' => esc_url('//mockingbird.ticksy.com/'),
					'link_caption' => esc_html__('Contact Us', 'callie-britt'),
					'duration' => 25
					)
				);
		}
		return $options;
	}
}


//------------------------------------------------------------------------
// OCDI support
//------------------------------------------------------------------------

// Set theme specific OCDI options
if ( !function_exists( 'callie_britt_ocdi_set_options' ) ) {
	add_filter( 'trx_addons_filter_ocdi_options', 'callie_britt_ocdi_set_options', 9 );
	function callie_britt_ocdi_set_options($options=array()) {
		if (is_array($options)) {
			// Prepare demo data
			$options['demo_url'] = esc_url(callie_britt_get_protocol() . '://demofiles.axiomthemes.com/callie-britt/');
			// Required plugins
			$options['required_plugins'] = array_keys(callie_britt_storage_get('required_plugins'));
			// Demo-site domain			
			$options['files']['ocdi']['title'] = esc_html__('Callie Britt OCDI Demo', 'callie-britt');
			$options['files']['ocdi']['domain_demo'] = esc_url(callie_britt_get_protocol().'://callie-britt.axiomthemes.com');	
			// If theme need more demo - just copy 'default' and change required parameter
			// For example:
			//$options['files']['dota']['title'] = esc_html__('Dota Paradise Demo', 'callie-britt');			
			//$options['files']['dota']['domain_demo'] = esc_url(callie_britt_get_protocol().'://dota.themerex.net');	
		}
		return $options;
	}
}


// -----------------------------------------------------------------
// -- Theme options for customizer
// -----------------------------------------------------------------
if (!function_exists('callie_britt_create_theme_options')) {

	function callie_britt_create_theme_options() {

		// Message about options override. 
		// Attention! Not need esc_html() here, because this message put in wp_kses_data() below
		$msg_override = __('Attention! Some of these options can be overridden in the following sections (Blog, Plugins settings, etc.) or in the settings of individual pages', 'callie-britt');
		
		// Color schemes number: if < 2 - hide fields with selectors
		$hide_schemes = count(callie_britt_storage_get('schemes')) < 2;
		
		callie_britt_storage_set('options', array(
		
			// 'Logo & Site Identity'
			'title_tagline' => array(
				"title" => esc_html__('Logo & Site Identity', 'callie-britt'),
				"desc" => '',
				"priority" => 10,
				"type" => "section"
				),
			'logo_info' => array(
				"title" => esc_html__('Logo in the header', 'callie-britt'),
				"desc" => '',
				"priority" => 20,
				"type" => "info",
				),
			'logo_text' => array(
				"title" => esc_html__('Use Site Name as Logo', 'callie-britt'),
				"desc" => wp_kses_data( __('Use the site title and tagline as a text logo if no image is selected', 'callie-britt') ),
				"class" => "callie_britt_column-1_2 callie_britt_new_row",
				"priority" => 30,
				"std" => 1,
				"type" => CALLIE_BRITT_THEME_FREE ? "hidden" : "checkbox"
				),
			'logo_retina_enabled' => array(
				"title" => esc_html__('Allow retina display logo', 'callie-britt'),
				"desc" => wp_kses_data( __('Show fields to select logo images for Retina display', 'callie-britt') ),
				"class" => "callie_britt_column-1_2",
				"priority" => 40,
				"refresh" => false,
				"std" => 0,
				"type" => CALLIE_BRITT_THEME_FREE ? "hidden" : "checkbox"
				),
			'logo_zoom' => array(
				"title" => esc_html__('Logo zoom', 'callie-britt'),
				"desc" => wp_kses_data( __("Zoom the logo. 1 - original size. Maximum size of logo depends on the actual size of the picture", 'callie-britt') ),
				"std" => 1,
				"min" => 0.2,
				"max" => 2,
				"step" => 0.1,
				"refresh" => false,
				"type" => CALLIE_BRITT_THEME_FREE ? "hidden" : "slider"
				),
			// Parameter 'logo' was replaced with standard WordPress 'custom_logo'
			'logo_retina' => array(
				"title" => esc_html__('Logo for Retina', 'callie-britt'),
				"desc" => wp_kses_data( __('Select or upload site logo used on Retina displays (if empty - use default logo from the field above)', 'callie-britt') ),
				"class" => "callie_britt_column-1_2",
				"priority" => 70,
				"dependency" => array(
					'logo_retina_enabled' => array(1)
				),
				"std" => '',
				"type" => CALLIE_BRITT_THEME_FREE ? "hidden" : "image"
				),
			'logo_mobile_header' => array(
				"title" => esc_html__('Logo for the mobile header', 'callie-britt'),
				"desc" => wp_kses_data( __('Select or upload site logo to display it in the mobile header (if enabled in the section "Header - Header mobile"', 'callie-britt') ),
				"class" => "callie_britt_column-1_2 callie_britt_new_row",
				"std" => '',
				"type" => "image"
				),
			'logo_mobile_header_retina' => array(
				"title" => esc_html__('Logo for the mobile header for Retina', 'callie-britt'),
				"desc" => wp_kses_data( __('Select or upload site logo used on Retina displays (if empty - use default logo from the field above)', 'callie-britt') ),
				"class" => "callie_britt_column-1_2",
				"dependency" => array(
					'logo_retina_enabled' => array(1)
				),
				"std" => '',
				"type" => CALLIE_BRITT_THEME_FREE ? "hidden" : "image"
				),
			'logo_mobile' => array(
				"title" => esc_html__('Logo mobile', 'callie-britt'),
				"desc" => wp_kses_data( __('Select or upload site logo to display it in the mobile menu', 'callie-britt') ),
				"class" => "callie_britt_column-1_2 callie_britt_new_row",
				"std" => '',
				"type" => "image"
				),
			'logo_mobile_retina' => array(
				"title" => esc_html__('Logo mobile for Retina', 'callie-britt'),
				"desc" => wp_kses_data( __('Select or upload site logo used on Retina displays (if empty - use default logo from the field above)', 'callie-britt') ),
				"class" => "callie_britt_column-1_2",
				"dependency" => array(
					'logo_retina_enabled' => array(1)
				),
				"std" => '',
				"type" => CALLIE_BRITT_THEME_FREE ? "hidden" : "image"
				),
			
		
		
			// 'General settings'
			'general' => array(
				"title" => esc_html__('General Settings', 'callie-britt'),
				"desc" => wp_kses_data( $msg_override ),
				"priority" => 20,
				"type" => "section",
				),

			'general_layout_info' => array(
				"title" => esc_html__('Layout', 'callie-britt'),
				"desc" => '',
				"type" => "info",
				),
			'body_style' => array(
				"title" => esc_html__('Body style', 'callie-britt'),
				"desc" => wp_kses_data( __('Select width of the body content', 'callie-britt') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Content', 'callie-britt')
				),
				"refresh" => false,
				"std" => 'wide',
				"options" => callie_britt_get_list_body_styles(false),
				"type" => "select"
				),
			'page_width' => array(
				"title" => esc_html__('Page width', 'callie-britt'),
				"desc" => wp_kses_data( __("Total width of the site content and sidebar (in pixels). If empty - use default width", 'callie-britt') ),
				"dependency" => array(
					'body_style' => array('boxed', 'wide')
				),
				"std" => 1278,
				"min" => 1000,
				"max" => 1400,
				"step" => 10,
				"refresh" => false,
				"customizer" => 'page',			// SASS variable's name to preview changes 'on fly'
				"type" => CALLIE_BRITT_THEME_FREE ? "hidden" : "slider"
				),
			'boxed_bg_image' => array(
				"title" => esc_html__('Boxed bg image', 'callie-britt'),
				"desc" => wp_kses_data( __('Select or upload image, used as background in the boxed body', 'callie-britt') ),
				"dependency" => array(
					'body_style' => array('boxed')
				),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Content', 'callie-britt')
				),
				"std" => '',
				"hidden" => true,
				"type" => "image"
				),
			'remove_margins' => array(
				"title" => esc_html__('Remove margins', 'callie-britt'),
				"desc" => wp_kses_data( __('Remove margins above and below the content area', 'callie-britt') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Content', 'callie-britt')
				),
				"refresh" => false,
				"std" => 0,
				"type" => "checkbox"
				),

			'general_sidebar_info' => array(
				"title" => esc_html__('Sidebar', 'callie-britt'),
				"desc" => '',
				"type" => "info",
				),
			'sidebar_position' => array(
				"title" => esc_html__('Sidebar position', 'callie-britt'),
				"desc" => wp_kses_data( __('Select position to show sidebar', 'callie-britt') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Widgets', 'callie-britt')
				),
				"std" => 'right',
				"options" => array(),
				"type" => "switch"
				),
			'sidebar_widgets' => array(
				"title" => esc_html__('Sidebar widgets', 'callie-britt'),
				"desc" => wp_kses_data( __('Select default widgets to show in the sidebar', 'callie-britt') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Widgets', 'callie-britt')
				),
				"dependency" => array(
					'sidebar_position' => array('left', 'right')
				),
				"std" => 'sidebar_widgets',
				"options" => array(),
				"type" => "select"
				),
			'sidebar_width' => array(
				"title" => esc_html__('Sidebar width', 'callie-britt'),
				"desc" => wp_kses_data( __("Width of the sidebar (in pixels). If empty - use default width", 'callie-britt') ),
				"std" => 370,
				"min" => 150,
				"max" => 500,
				"step" => 10,
				"refresh" => false,
				"customizer" => 'sidebar',		// SASS variable's name to preview changes 'on fly'
				"type" => CALLIE_BRITT_THEME_FREE ? "hidden" : "slider"
				),
			'sidebar_gap' => array(
				"title" => esc_html__('Sidebar gap', 'callie-britt'),
				"desc" => wp_kses_data( __("Gap between content and sidebar (in pixels). If empty - use default gap", 'callie-britt') ),
				"std" => 47,
				"min" => 0,
				"max" => 100,
				"step" => 1,
				"refresh" => false,
				"customizer" => 'gap',			// SASS variable's name to preview changes 'on fly'
				"type" => CALLIE_BRITT_THEME_FREE ? "hidden" : "slider"
				),
			'expand_content' => array(
				"title" => esc_html__('Expand content', 'callie-britt'),
				"desc" => wp_kses_data( __('Expand the content width if the sidebar is hidden', 'callie-britt') ),
				"refresh" => false,
				"std" => 1,
				"type" => "checkbox"
				),

			'general_effects_info' => array(
				"title" => esc_html__('Design & Effects', 'callie-britt'),
				"desc" => '',
				"type" => "info",
				),
			'border_radius' => array(
				"title" => esc_html__('Border radius', 'callie-britt'),
				"desc" => wp_kses_data( __("Specify the border radius of the form fields and buttons in pixels", 'callie-britt') ),
				"std" => '2.3em',
				"min" => 0,
				"max" => 20,
				"step" => 1,
				"refresh" => false,
				"customizer" => 'rad',		// SASS name to preview changes 'on fly'
				"type" => CALLIE_BRITT_THEME_FREE ? "hidden" : "slider"
				),

			'general_misc_info' => array(
				"title" => esc_html__('Miscellaneous', 'callie-britt'),
				"desc" => '',
				"type" => CALLIE_BRITT_THEME_FREE ? "hidden" : "info",
				),
			'seo_snippets' => array(
				"title" => esc_html__('SEO snippets', 'callie-britt'),
				"desc" => wp_kses_data( __('Add structured data markup to the single posts and pages', 'callie-britt') ),
				"std" => 0,
				"type" => CALLIE_BRITT_THEME_FREE ? "hidden" : "checkbox"
				),
			'privacy_text' => array(
				"title" => esc_html__("Text with Privacy Policy link", 'callie-britt'),
				"desc" => wp_kses_data( __("Specify text with Privacy Policy link for the checkbox 'I agree ...'", 'callie-britt') ),
				"std" => wp_kses_post( __( 'I agree that my submitted data is being collected and stored.', 'callie-britt') ),
				"type" => "text"
			),
		
		
			// 'Header'
			'header' => array(
				"title" => esc_html__('Header', 'callie-britt'),
				"desc" => wp_kses_data( $msg_override ),
				"priority" => 30,
				"type" => "section"
				),

			'header_style_info' => array(
				"title" => esc_html__('Header style', 'callie-britt'),
				"desc" => '',
				"type" => "info"
				),
			'header_type' => array(
				"title" => esc_html__('Header style', 'callie-britt'),
				"desc" => wp_kses_data( __('Choose whether to use the default header or header Layouts (available only if the ThemeREX Addons is activated)', 'callie-britt') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Header', 'callie-britt')
				),
				"std" => 'default',
				"options" => callie_britt_get_list_header_footer_types(),
				"type" => CALLIE_BRITT_THEME_FREE || !callie_britt_exists_trx_addons() ? "hidden" : "switch"
				),
			'header_style' => array(
				"title" => esc_html__('Select custom layout', 'callie-britt'),
				"desc" => wp_kses_post( __("Select custom header from Layouts Builder", 'callie-britt') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Header', 'callie-britt')
				),
				"dependency" => array(
					'header_type' => array('custom')
				),
				"std" => CALLIE_BRITT_THEME_FREE ? 'header-custom-elementor-header-default' : 'header-custom-header-default',
				"options" => array(),
				"type" => "select"
				),
			'header_position' => array(
				"title" => esc_html__('Header position', 'callie-britt'),
				"desc" => wp_kses_data( __('Select position to display the site header', 'callie-britt') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Header', 'callie-britt')
				),
				"std" => 'default',
				"options" => array(),
				"type" => CALLIE_BRITT_THEME_FREE ? "hidden" : "switch"
				),
			'header_wide' => array(
				"title" => esc_html__('Header fullwidth', 'callie-britt'),
				"desc" => wp_kses_data( __('Do you want to stretch the header widgets area to the entire window width?', 'callie-britt') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Header', 'callie-britt')
				),
				"dependency" => array(
					'header_type' => array('default')
				),
				"std" => 1,
				"type" => CALLIE_BRITT_THEME_FREE ? "hidden" : "checkbox"
				),

			'menu_info' => array(
				"title" => esc_html__('Main menu', 'callie-britt'),
				"desc" => wp_kses_data( __('Select main menu style, position and other parameters', 'callie-britt') ),
				"type" => CALLIE_BRITT_THEME_FREE ? "hidden" : "info"
				),
			'menu_style' => array(
				"title" => esc_html__('Menu position', 'callie-britt'),
				"desc" => wp_kses_data( __('Select position of the main menu', 'callie-britt') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Header', 'callie-britt')
				),
				"std" => 'top',
				"options" => array(
					'top'	=> esc_html__('Top',	'callie-britt'),
				),
				"type" => CALLIE_BRITT_THEME_FREE || !callie_britt_exists_trx_addons() ? "hidden" : "switch"
				),
			'menu_side_stretch' => array(
				"title" => esc_html__('Stretch sidemenu', 'callie-britt'),
				"desc" => wp_kses_data( __('Stretch sidemenu to window height (if menu items number >= 5)', 'callie-britt') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Header', 'callie-britt')
				),
				"dependency" => array(
					'menu_style' => array('left', 'right')
				),
				"std" => 0,
				"type" => CALLIE_BRITT_THEME_FREE ? "hidden" : "checkbox"
				),
			'menu_side_icons' => array(
				"title" => esc_html__('Iconed sidemenu', 'callie-britt'),
				"desc" => wp_kses_data( __('Get icons from anchors and display it in the sidemenu or mark sidemenu items with simple dots', 'callie-britt') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Header', 'callie-britt')
				),
				"dependency" => array(
					'menu_style' => array('left', 'right')
				),
				"std" => 1,
				"type" => CALLIE_BRITT_THEME_FREE ? "hidden" : "checkbox"
				),
			'menu_mobile_fullscreen' => array(
				"title" => esc_html__('Mobile menu fullscreen', 'callie-britt'),
				"desc" => wp_kses_data( __('Display mobile and side menus on full screen (if checked) or slide narrow menu from the left or from the right side (if not checked)', 'callie-britt') ),
				"std" => 1,
				"type" => CALLIE_BRITT_THEME_FREE ? "hidden" : "checkbox"
				),
			'header_image_info'             => array(
				'title' => esc_html__( 'Header image', 'callie-britt' ),
				'desc'  => '',
				'type'  => CALLIE_BRITT_THEME_FREE ? 'hidden' : 'info',
				),

			'header_mobile_info' => array(
				"title" => esc_html__('Mobile header', 'callie-britt'),
				"desc" => wp_kses_data( __("Configure the mobile version of the header", 'callie-britt') ),
				"priority" => 500,
				"dependency" => array(
					'header_type' => array('default')
				),
				"type" => CALLIE_BRITT_THEME_FREE ? "hidden" : "info"
				),
			'header_mobile_enabled' => array(
				"title" => esc_html__('Enable the mobile header', 'callie-britt'),
				"desc" => wp_kses_data( __("Use the mobile version of the header (if checked) or relayout the current header on mobile devices", 'callie-britt') ),
				"dependency" => array(
					'header_type' => array('default')
				),
				"std" => 0,
				"type" => CALLIE_BRITT_THEME_FREE ? "hidden" : "checkbox"
				),
			'header_mobile_additional_info' => array(
				"title" => esc_html__('Additional info', 'callie-britt'),
				"desc" => wp_kses_data( __('Additional info to show at the top of the mobile header', 'callie-britt') ),
				"std" => '',
				"dependency" => array(
					'header_type' => array('default'),
					'header_mobile_enabled' => array(1)
				),
				"refresh" => false,
				"teeny" => false,
				"rows" => 20,
				"type" => CALLIE_BRITT_THEME_FREE ? "hidden" : "text_editor"
				),
			'header_mobile_hide_info' => array(
				"title" => esc_html__('Hide additional info', 'callie-britt'),
				"std" => 0,
				"dependency" => array(
					'header_type' => array('default'),
					'header_mobile_enabled' => array(1)
				),
				"type" => CALLIE_BRITT_THEME_FREE ? "hidden" : "checkbox"
				),
			'header_mobile_hide_logo' => array(
				"title" => esc_html__('Hide logo', 'callie-britt'),
				"std" => 0,
				"dependency" => array(
					'header_type' => array('default'),
					'header_mobile_enabled' => array(1)
				),
				"type" => CALLIE_BRITT_THEME_FREE ? "hidden" : "checkbox"
				),
			'header_mobile_hide_login' => array(
				"title" => esc_html__('Hide login/logout', 'callie-britt'),
				"std" => 0,
				"dependency" => array(
					'header_type' => array('default'),
					'header_mobile_enabled' => array(1)
				),
				"type" => CALLIE_BRITT_THEME_FREE ? "hidden" : "checkbox"
				),
			'header_mobile_hide_search' => array(
				"title" => esc_html__('Hide search', 'callie-britt'),
				"std" => 0,
				"dependency" => array(
					'header_type' => array('default'),
					'header_mobile_enabled' => array(1)
				),
				"type" => CALLIE_BRITT_THEME_FREE ? "hidden" : "checkbox"
				),
			'header_mobile_hide_cart' => array(
				"title" => esc_html__('Hide cart', 'callie-britt'),
				"std" => 0,
				"dependency" => array(
					'header_type' => array('default'),
					'header_mobile_enabled' => array(1)
				),
				"type" => CALLIE_BRITT_THEME_FREE ? "hidden" : "checkbox"
				),


		
			// 'Footer'
			'footer' => array(
				"title" => esc_html__('Footer', 'callie-britt'),
				"desc" => wp_kses_data( $msg_override ),
				"priority" => 50,
				"type" => "section"
				),
			'footer_type' => array(
				"title" => esc_html__('Footer style', 'callie-britt'),
				"desc" => wp_kses_data( __('Choose whether to use the default footer or footer Layouts (available only if the ThemeREX Addons is activated)', 'callie-britt') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Footer', 'callie-britt')
				),
				"std" => 'default',
				"options" => callie_britt_get_list_header_footer_types(),
				"type" => CALLIE_BRITT_THEME_FREE || !callie_britt_exists_trx_addons() ? "hidden" : "switch"
				),
			'footer_style' => array(
				"title" => esc_html__('Select custom layout', 'callie-britt'),
				"desc" => wp_kses_post( __("Select custom footer from Layouts Builder", 'callie-britt') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Footer', 'callie-britt')
				),
				"dependency" => array(
					'footer_type' => array('custom')
				),
				"std" => CALLIE_BRITT_THEME_FREE ? 'footer-custom-elementor-footer-default' : 'footer-custom-footer-default',
				"options" => array(),
				"type" => "select"
				),
			'footer_widgets' => array(
				"title" => esc_html__('Footer widgets', 'callie-britt'),
				"desc" => wp_kses_data( __('Select set of widgets to show in the footer', 'callie-britt') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Footer', 'callie-britt')
				),
				"dependency" => array(
					'footer_type' => array('default')
				),
				"std" => 'footer_widgets',
				"options" => array(),
				"type" => "select"
				),
			'footer_columns' => array(
				"title" => esc_html__('Footer columns', 'callie-britt'),
				"desc" => wp_kses_data( __('Select number columns to show widgets in the footer. If 0 - autodetect by the widgets count', 'callie-britt') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Footer', 'callie-britt')
				),
				"dependency" => array(
					'footer_type' => array('default'),
					'footer_widgets' => array('^hide')
				),
				"std" => 0,
				"options" => callie_britt_get_list_range(0,6),
				"type" => "select"
				),
			'footer_wide' => array(
				"title" => esc_html__('Footer fullwidth', 'callie-britt'),
				"desc" => wp_kses_data( __('Do you want to stretch the footer to the entire window width?', 'callie-britt') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Footer', 'callie-britt')
				),
				"dependency" => array(
					'footer_type' => array('default')
				),
				"std" => 0,
				"type" => "checkbox"
				),
			'logo_in_footer' => array(
				"title" => esc_html__('Show logo', 'callie-britt'),
				"desc" => wp_kses_data( __('Show logo in the footer', 'callie-britt') ),
				'refresh' => false,
				"dependency" => array(
					'footer_type' => array('default')
				),
				"std" => 0,
				"type" => "checkbox"
				),
			'logo_footer' => array(
				"title" => esc_html__('Logo for footer', 'callie-britt'),
				"desc" => wp_kses_data( __('Select or upload site logo to display it in the footer', 'callie-britt') ),
				"dependency" => array(
					'footer_type' => array('default'),
					'logo_in_footer' => array(1)
				),
				"std" => '',
				"type" => "image"
				),
			'logo_footer_retina' => array(
				"title" => esc_html__('Logo for footer (Retina)', 'callie-britt'),
				"desc" => wp_kses_data( __('Select or upload logo for the footer area used on Retina displays (if empty - use default logo from the field above)', 'callie-britt') ),
				"dependency" => array(
					'footer_type' => array('default'),
					'logo_in_footer' => array(1),
					'logo_retina_enabled' => array(1)
				),
				"std" => '',
				"type" => CALLIE_BRITT_THEME_FREE ? "hidden" : "image"
				),
			'socials_in_footer' => array(
				"title" => esc_html__('Show social icons', 'callie-britt'),
				"desc" => wp_kses_data( __('Show social icons in the footer (under logo or footer widgets)', 'callie-britt') ),
				"dependency" => array(
					'footer_type' => array('default')
				),
				"std" => 0,
				"type" => !callie_britt_exists_trx_addons() ? "hidden" : "checkbox"
				),
			'copyright' => array(
				"title" => esc_html__('Copyright', 'callie-britt'),
				"desc" => wp_kses_data( __('Copyright text in the footer. Use {Y} to insert current year and press "Enter" to create a new line', 'callie-britt') ),
				"translate" => true,
				"std" => esc_html__('Copyright &copy; {Y} by AxiomThemes. All rights reserved.', 'callie-britt'),
				"dependency" => array(
					'footer_type' => array('default')
				),
				"refresh" => false,
				"type" => "textarea"
				),
			
		
		
			// 'Blog'
			'blog' => array(
				"title" => esc_html__('Blog', 'callie-britt'),
				"desc" => wp_kses_data( __('Options of the the blog archive', 'callie-britt') ),
				"priority" => 70,
				"type" => "panel",
				),
		
				// Blog - Posts page
				'blog_general' => array(
					"title" => esc_html__('Posts page', 'callie-britt'),
					"desc" => wp_kses_data( __('Style and components of the blog archive', 'callie-britt') ),
					"type" => "section",
					),
				'blog_general_info' => array(
					"title" => esc_html__('General settings', 'callie-britt'),
					"desc" => '',
					"type" => "info",
					),
				'blog_style' => array(
					"title" => esc_html__('Blog style', 'callie-britt'),
					"desc" => '',
					"override" => array(
						'mode' => 'page',
						'section' => esc_html__('Content', 'callie-britt')
					),
					"dependency" => array(
						'#page_template' => array('blog.php')
					),
					"std" => 'excerpt',
					"options" => array(),
					"type" => "select"
					),
				'first_post_large' => array(
					"title" => esc_html__('First post large', 'callie-britt'),
					"desc" => wp_kses_data( __('Make your first post stand out by making it bigger', 'callie-britt') ),
					"override" => array(
						'mode' => 'page',
						'section' => esc_html__('Content', 'callie-britt')
					),
					"dependency" => array(
						'#page_template' => array('blog.php'),
						'blog_style' => array('classic', 'masonry')
					),
					"std" => 0,
					"type" => "checkbox"
					),
				'excerpt_length' => array(
					"title" => esc_html__('Excerpt length', 'callie-britt'),
					"desc" => wp_kses_data( __("Length (in words) to generate excerpt from the post content. Attention! If the post excerpt is explicitly specified - it appears unchanged", 'callie-britt') ),
					"dependency" => array(
						'blog_style' => array('excerpt'),
						'blog_content' => array('excerpt')
					),
					"std" => 60,
					"type" => "text"
					),
				'blog_columns' => array(
					"title" => esc_html__('Blog columns', 'callie-britt'),
					"desc" => wp_kses_data( __('How many columns should be used in the blog archive (from 2 to 4)?', 'callie-britt') ),
					"std" => 2,
					"options" => callie_britt_get_list_range(2,4),
					"type" => "hidden"
					),
				'post_type' => array(
					"title" => esc_html__('Post type', 'callie-britt'),
					"desc" => wp_kses_data( __('Select post type to show in the blog archive', 'callie-britt') ),
					"override" => array(
						'mode' => 'page',
						'section' => esc_html__('Content', 'callie-britt')
					),
					"dependency" => array(
						'#page_template' => array('blog.php')
					),
					"linked" => 'parent_cat',
					"refresh" => false,
					"hidden" => true,
					"std" => 'post',
					"options" => array(),
					"type" => "select"
					),
				'parent_cat' => array(
					"title" => esc_html__('Category to show', 'callie-britt'),
					"desc" => wp_kses_data( __('Select category to show in the blog archive', 'callie-britt') ),
					"override" => array(
						'mode' => 'page',
						'section' => esc_html__('Content', 'callie-britt')
					),
					"dependency" => array(
						'#page_template' => array('blog.php')
					),
					"refresh" => false,
					"hidden" => true,
					"std" => '0',
					"options" => array(),
					"type" => "select"
					),
				'posts_per_page' => array(
					"title" => esc_html__('Posts per page', 'callie-britt'),
					"desc" => wp_kses_data( __('How many posts will be displayed on this page', 'callie-britt') ),
					"override" => array(
						'mode' => 'page',
						'section' => esc_html__('Content', 'callie-britt')
					),
					"dependency" => array(
						'#page_template' => array('blog.php')
					),
					"hidden" => true,
					"std" => '',
					"type" => "text"
					),
				"blog_pagination" => array( 
					"title" => esc_html__('Pagination style', 'callie-britt'),
					"desc" => wp_kses_data( __('Show Older/Newest posts or Page numbers below the posts list', 'callie-britt') ),
					"override" => array(
						'mode' => 'page',
						'section' => esc_html__('Content', 'callie-britt')
					),
					"std" => "pages",
					"dependency" => array(
						'#page_template' => array('blog.php')
					),
					"options" => array(
						'pages'	=> esc_html__("Page numbers", 'callie-britt'),
					),
					"type" => "select"
					),
				'show_filters' => array(
					"title" => esc_html__('Show filters', 'callie-britt'),
					"desc" => wp_kses_data( __('Show categories as tabs to filter posts', 'callie-britt') ),
					"override" => array(
						'mode' => 'page',
						'section' => esc_html__('Content', 'callie-britt')
					),
					"dependency" => array(
						'#page_template' => array('blog.php'),
						'blog_style' => array('portfolio', 'gallery')
					),
					"hidden" => true,
					"std" => 0,
					"type" => CALLIE_BRITT_THEME_FREE ? "hidden" : "checkbox"
					),
	
				'blog_sidebar_info' => array(
					"title" => esc_html__('Sidebar', 'callie-britt'),
					"desc" => '',
					"type" => "info",
					),
				'sidebar_position_blog' => array(
					"title" => esc_html__('Sidebar position', 'callie-britt'),
					"desc" => wp_kses_data( __('Select position to show sidebar', 'callie-britt') ),
					"std" => 'right',
					"options" => array(),
					"type" => "switch"
					),
				'sidebar_widgets_blog' => array(
					"title" => esc_html__('Sidebar widgets', 'callie-britt'),
					"desc" => wp_kses_data( __('Select default widgets to show in the sidebar', 'callie-britt') ),
					"dependency" => array(
						'sidebar_position_blog' => array('left', 'right')
					),
					"std" => 'sidebar_widgets',
					"options" => array(),
					"type" => "select"
					),
				'expand_content_blog' => array(
					"title" => esc_html__('Expand content', 'callie-britt'),
					"desc" => wp_kses_data( __('Expand the content width if the sidebar is hidden', 'callie-britt') ),
					"refresh" => false,
					"std" => 1,
					"type" => "checkbox"
					),
	
				'blog_advanced_info' => array(
					"title" => esc_html__('Advanced settings', 'callie-britt'),
					"desc" => '',
					"type" => "info",
					),
				'no_image' => array(
					"title" => esc_html__('Image placeholder', 'callie-britt'),
					"desc" => wp_kses_data( __('Select or upload an image used as placeholder for posts without a featured image', 'callie-britt') ),
					"std" => '',
					"type" => "image"
					),
				'time_diff_before' => array(
					"title" => esc_html__('Easy Readable Date Format', 'callie-britt'),
					"desc" => wp_kses_data( __("For how many days to show the easy-readable date format (e.g. '3 days ago') instead of the standard publication date", 'callie-britt') ),
					"std" => 5,
					"type" => "text"
					),
				'sticky_style' => array(
					"title" => esc_html__('Sticky posts style', 'callie-britt'),
					"desc" => wp_kses_data( __('Select style of the sticky posts output', 'callie-britt') ),
					"std" => 'inherit',
					"options" => array(
						'inherit' => esc_html__('Decorated posts', 'callie-britt')
					),
					"type" => CALLIE_BRITT_THEME_FREE ? "hidden" : "select"
					),
				"blog_animation" => array( 
					"title" => esc_html__('Animation for the posts', 'callie-britt'),
					"desc" => wp_kses_data( __('Select animation to show posts in the blog. Attention! Do not use any animation on pages with the "wheel to the anchor" behaviour (like a "Chess 2 columns")!', 'callie-britt') ),
					"override" => array(
						'mode' => 'page',
						'section' => esc_html__('Content', 'callie-britt')
					),
					"dependency" => array(
						'#page_template' => array('blog.php')
					),
					"std" => "none",
					"options" => array(),
					"type" => CALLIE_BRITT_THEME_FREE ? "hidden" : "select"
					),
				'meta_parts' => array(
					"title" => esc_html__('Post meta', 'callie-britt'),
					"desc" => wp_kses_data( __("If your blog page is created using the 'Blog archive' page template, set up the 'Post Meta' settings in the 'Theme Options' section of that page. Post counters and Share Links are available only if plugin ThemeREX Addons is active", 'callie-britt') )
								. '<br>'
								. wp_kses_data( __("<b>Tip:</b> Drag items to change their order.", 'callie-britt') ),
					"override" => array(
						'mode' => 'page',
						'section' => esc_html__('Content', 'callie-britt')
					),
					"dependency" => array(
						'#page_template' => array('blog.php')
					),
					"dir" => 'vertical',
					"sortable" => true,
					"std" => 'categories=1|date=1|counters=1|author=0|share=0|edit=1',
					"options" => array(
						'categories' => esc_html__('Categories', 'callie-britt'),
						'date'		 => esc_html__('Post date', 'callie-britt'),
						'author'	 => esc_html__('Post author', 'callie-britt'),
						'counters'	 => esc_html__('Post counters', 'callie-britt'),
						'share'		 => esc_html__('Share links', 'callie-britt'),
						'edit'		 => esc_html__('Edit link', 'callie-britt')
					),
					"type" => CALLIE_BRITT_THEME_FREE ? "hidden" : "checklist"
				),
				'counters' => array(
					"title" => esc_html__('Post counters', 'callie-britt'),
					"desc" => wp_kses_data( __("Show only selected counters. Attention! Likes and Views are available only if ThemeREX Addons is active", 'callie-britt') ),
					"override" => array(
						'mode' => 'page',
						'section' => esc_html__('Content', 'callie-britt')
					),
					"dependency" => array(
						'#page_template' => array('blog.php')
					),
					"dir" => 'vertical',
					"sortable" => true,
					"std" => 'views=0|likes=0|comments=1',
					"options" => array(
						'views' => esc_html__('Views', 'callie-britt'),
						'likes' => esc_html__('Likes', 'callie-britt'),
						'comments' => esc_html__('Comments', 'callie-britt')
					),
					"type" => CALLIE_BRITT_THEME_FREE || !callie_britt_exists_trx_addons() ? "hidden" : "checklist"
				),

				
				// Blog - Single posts
				'blog_single' => array(
					"title" => esc_html__('Single posts', 'callie-britt'),
					"desc" => wp_kses_data( __('Settings of the single post', 'callie-britt') ),
					"type" => "section",
					),
				'hide_featured_on_single' => array(
					"title" => esc_html__('Hide featured image on the single post', 'callie-britt'),
					"desc" => wp_kses_data( __("Hide featured image on the single post's pages", 'callie-britt') ),
					"override" => array(
						'mode' => 'page,post',
						'section' => esc_html__('Content', 'callie-britt')
					),
					"std" => 0,
					"type" => "checkbox"
					),
				'hide_sidebar_on_single' => array(
					"title" => esc_html__('Hide sidebar on the single post', 'callie-britt'),
					"desc" => wp_kses_data( __("Hide sidebar on the single post's pages", 'callie-britt') ),
					"std" => 0,
					"type" => "checkbox"
					),
				'show_post_meta' => array(
					"title" => esc_html__('Show post meta', 'callie-britt'),
					"desc" => wp_kses_data( __("Display block with post's meta: date, categories, counters, etc.", 'callie-britt') ),
					"std" => 1,
					"type" => "checkbox"
					),
				'meta_parts_post' => array(
					"title" => esc_html__('Post meta', 'callie-britt'),
					"desc" => wp_kses_data( __("Meta parts for single posts. Post counters and Share Links are available only if plugin ThemeREX Addons is active", 'callie-britt') )
								. '<br>'
								. wp_kses_data( __("<b>Tip:</b> Drag items to change their order.", 'callie-britt') ),
					"dependency" => array(
						'show_post_meta' => array(1)
					),
					"dir" => 'vertical',
					"sortable" => true,
					"std" => 'categories=1|date=1|counters=1|author=0|share=0|edit=1',
					"options" => array(
						'categories' => esc_html__('Categories', 'callie-britt'),
						'date'		 => esc_html__('Post date', 'callie-britt'),
						'author'	 => esc_html__('Post author', 'callie-britt'),
						'counters'	 => esc_html__('Post counters', 'callie-britt'),
						'share'		 => esc_html__('Share links', 'callie-britt'),
						'edit'		 => esc_html__('Edit link', 'callie-britt')
					),
					"type" => CALLIE_BRITT_THEME_FREE ? "hidden" : "checklist"
				),
				'counters_post' => array(
					"title" => esc_html__('Post counters', 'callie-britt'),
					"desc" => wp_kses_data( __("Show only selected counters. Attention! Likes and Views are available only if plugin ThemeREX Addons is active", 'callie-britt') ),
					"dependency" => array(
						'show_post_meta' => array(1)
					),
					"dir" => 'vertical',
					"sortable" => true,
					"std" => 'views=0|likes=0|comments=1',
					"options" => array(
						'views' => esc_html__('Views', 'callie-britt'),
						'likes' => esc_html__('Likes', 'callie-britt'),
						'comments' => esc_html__('Comments', 'callie-britt')
					),
					"type" => CALLIE_BRITT_THEME_FREE || !callie_britt_exists_trx_addons() ? "hidden" : "checklist"
				),
				'show_tags' => array(
					"title" => esc_html__('Show posts tags', 'callie-britt'),
					"desc" => wp_kses_data( __("Display posts tags on the single post", 'callie-britt') ),
					"std" => 1,
					"type" => !callie_britt_exists_trx_addons() ? "hidden" : "checkbox"
					),
				'show_share_links' => array(
					"title" => esc_html__('Show share links', 'callie-britt'),
					"desc" => wp_kses_data( __("Display share links on the single post", 'callie-britt') ),
					"std" => 1,
					"type" => !callie_britt_exists_trx_addons() ? "hidden" : "checkbox"
					),
				'show_author_info' => array(
					"title" => esc_html__('Show author info', 'callie-britt'),
					"desc" => wp_kses_data( __("Display block with information about post's author", 'callie-britt') ),
					"std" => 1,
					"type" => "checkbox"
					),
				'blog_single_related_info' => array(
					"title" => esc_html__('Related posts', 'callie-britt'),
					"desc" => '',
					"type" => "info",
					),
				'show_related_posts' => array(
					"title" => esc_html__('Show related posts', 'callie-britt'),
					"desc" => wp_kses_data( __("Show section 'Related posts' on the single post's pages", 'callie-britt') ),
					"override" => array(
						'mode' => 'page,post',
						'section' => esc_html__('Content', 'callie-britt')
					),
					"std" => 1,
					"type" => "checkbox"
					),
				'related_posts' => array(
					"title" => esc_html__('Related posts', 'callie-britt'),
					"desc" => wp_kses_data( __('How many related posts should be displayed in the single post? If 0 - no related posts are shown.', 'callie-britt') ),
					"dependency" => array(
						'show_related_posts' => array(1)
					),
					"std" => 2,
					"options" => callie_britt_get_list_range(1,9),
					"type" => CALLIE_BRITT_THEME_FREE ? "hidden" : "select"
					),
				'related_columns' => array(
					"title" => esc_html__('Related columns', 'callie-britt'),
					"desc" => wp_kses_data( __('How many columns should be used to output related posts in the single page (from 2 to 4)?', 'callie-britt') ),
					"dependency" => array(
						'show_related_posts' => array(1)
					),
					"std" => 2,
					"options" => callie_britt_get_list_range(1,4),
					"type" => CALLIE_BRITT_THEME_FREE ? "hidden" : "switch"
					),
				'related_style' => array(
					"title" => esc_html__('Related posts style', 'callie-britt'),
					"desc" => wp_kses_data( __('Select style of the related posts output', 'callie-britt') ),
					"dependency" => array(
						'show_related_posts' => array(1)
					),
					"std" => 2,
					"options" => callie_britt_get_list_styles(1,2),
					"type" => CALLIE_BRITT_THEME_FREE ? "hidden" : "switch"
					),
			'blog_end' => array(
				"type" => "panel_end",
				),
			
		
		
			// 'Colors'
			'panel_colors' => array(
				"title" => esc_html__('Colors', 'callie-britt'),
				"desc" => '',
				"priority" => 300,
				"type" => "section"
				),

			'color_schemes_info' => array(
				"title" => esc_html__('Color schemes', 'callie-britt'),
				"desc" => wp_kses_data( __('Color schemes for various parts of the site. "Inherit" means that this block is used the Site color scheme (the first parameter)', 'callie-britt') ),
				"hidden" => $hide_schemes,
				"type" => "info",
				),
			'color_scheme' => array(
				"title" => esc_html__('Site Color Scheme', 'callie-britt'),
				"desc" => '',
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Colors', 'callie-britt')
				),
				"std" => 'default',
				"options" => array(),
				"refresh" => false,
				"type" => $hide_schemes ? 'hidden' : "switch"
				),
			'header_scheme' => array(
				"title" => esc_html__('Header Color Scheme', 'callie-britt'),
				"desc" => '',
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Colors', 'callie-britt')
				),
				"std" => 'inherit',
				"options" => array(),
				"refresh" => false,
				"type" => $hide_schemes ? 'hidden' : "switch"
				),
			'sidebar_scheme' => array(
				"title" => esc_html__('Sidebar Color Scheme', 'callie-britt'),
				"desc" => '',
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Colors', 'callie-britt')
				),
				"std" => 'inherit',
				"options" => array(),
				"refresh" => false,
				"type" => $hide_schemes ? 'hidden' : "switch"
				),
			'footer_scheme' => array(
				"title" => esc_html__('Footer Color Scheme', 'callie-britt'),
				"desc" => '',
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Colors', 'callie-britt')
				),
				"std" => 'dark',
				"options" => array(),
				"refresh" => false,
				"type" => $hide_schemes ? 'hidden' : "switch"
				),

			'color_scheme_editor_info' => array(
				"title" => esc_html__('Color scheme editor', 'callie-britt'),
				"desc" => wp_kses_data(__('Select color scheme to modify. Attention! Only those sections in the site will be changed which this scheme was assigned to', 'callie-britt') ),
				"type" => "info",
				),
			'scheme_storage' => array(
				"title" => esc_html__('Color scheme editor', 'callie-britt'),
				"desc" => '',
				"std" => '$callie_britt_get_scheme_storage',
				"refresh" => false,
				"colorpicker" => "tiny",
				"type" => "scheme_editor"
				),


			// 'Hidden'
			'media_title' => array(
				"title" => esc_html__('Media title', 'callie-britt'),
				"desc" => wp_kses_data( __('Used as title for the audio and video item in this post', 'callie-britt') ),
				"override" => array(
					'mode' => 'post',
					'section' => esc_html__('Content', 'callie-britt')
				),
				"hidden" => true,
				"std" => '',
				"type" => CALLIE_BRITT_THEME_FREE ? "hidden" : "text"
				),
			'media_author' => array(
				"title" => esc_html__('Media author', 'callie-britt'),
				"desc" => wp_kses_data( __('Used as author name for the audio and video item in this post', 'callie-britt') ),
				"override" => array(
					'mode' => 'post',
					'section' => esc_html__('Content', 'callie-britt')
				),
				"hidden" => true,
				"std" => '',
				"type" => CALLIE_BRITT_THEME_FREE ? "hidden" : "text"
				),


			// Internal options.
			// Attention! Don't change any options in the section below!
			// Use huge priority to call render this elements after all options!
			'reset_options' => array(
				"title" => '',
				"desc" => '',
				"std" => '0',
				"priority" => 10000,
				"type" => "hidden",
				),

			'last_option' => array(		// Need to manually call action to include Tiny MCE scripts
				"title" => '',
				"desc" => '',
				"std" => 1,
				"type" => "hidden",
				),

		));


		// Prepare panel 'Fonts'
		// -------------------------------------------------------------
		$fonts = array(
		
			// 'Fonts'
			'fonts' => array(
				"title" => esc_html__('Typography', 'callie-britt'),
				"desc" => '',
				"priority" => 200,
				"type" => "panel"
				),

			// Fonts - Load_fonts
			'load_fonts' => array(
				"title" => esc_html__('Load fonts', 'callie-britt'),
				"desc" => wp_kses_data( __('Specify fonts to load when theme start. You can use them in the base theme elements: headers, text, menu, links, input fields, etc.', 'callie-britt') )
						. '<br>'
						. wp_kses_data( __('Attention! Press "Refresh" button to reload preview area after the all fonts are changed', 'callie-britt') ),
				"type" => "section"
				),
			'load_fonts_subset' => array(
				"title" => esc_html__('Google fonts subsets', 'callie-britt'),
				"desc" => wp_kses_data( __('Specify comma separated list of the subsets which will be load from Google fonts', 'callie-britt') )
						. '<br>'
						. wp_kses_data( __('Available subsets are: latin,latin-ext,cyrillic,cyrillic-ext,greek,greek-ext,vietnamese', 'callie-britt') ),
				"class" => "callie_britt_column-1_3 callie_britt_new_row",
				"refresh" => false,
				"std" => '$callie_britt_get_load_fonts_subset',
				"type" => "text"
				)
		);

		for ($i=1; $i<=callie_britt_get_theme_setting('max_load_fonts'); $i++) {
			if (callie_britt_get_value_gp('page') != 'theme_options') {
				$fonts["load_fonts-{$i}-info"] = array(
					// Translators: Add font's number - 'Font 1', 'Font 2', etc
					"title" => esc_html(sprintf(__('Font %s', 'callie-britt'), $i)),
					"desc" => '',
					"type" => "info",
					);
			}
			$fonts["load_fonts-{$i}-name"] = array(
				"title" => esc_html__('Font name', 'callie-britt'),
				"desc" => '',
				"class" => "callie_britt_column-1_3 callie_britt_new_row",
				"refresh" => false,
				"std" => '$callie_britt_get_load_fonts_option',
				"type" => "text"
				);
			$fonts["load_fonts-{$i}-family"] = array(
				"title" => esc_html__('Font family', 'callie-britt'),
				"desc" => $i==1 
							? wp_kses_data( __('Select font family to use it if font above is not available', 'callie-britt') )
							: '',
				"class" => "callie_britt_column-1_3",
				"refresh" => false,
				"std" => '$callie_britt_get_load_fonts_option',
				"options" => array(
					'inherit' => esc_html__("Inherit", 'callie-britt'),
					'serif' => esc_html__('serif', 'callie-britt'),
					'sans-serif' => esc_html__('sans-serif', 'callie-britt'),
					'monospace' => esc_html__('monospace', 'callie-britt'),
					'cursive' => esc_html__('cursive', 'callie-britt'),
					'fantasy' => esc_html__('fantasy', 'callie-britt')
				),
				"type" => "select"
				);
			$fonts["load_fonts-{$i}-styles"] = array(
				"title" => esc_html__('Font styles', 'callie-britt'),
				"desc" => $i==1 
							? wp_kses_data( __('Font styles used only for the Google fonts. This is a comma separated list of the font weight and styles. For example: 400,400italic,700', 'callie-britt') )
								. '<br>'
								. wp_kses_data( __('Attention! Each weight and style increase download size! Specify only used weights and styles.', 'callie-britt') )
							: '',
				"class" => "callie_britt_column-1_3",
				"refresh" => false,
				"std" => '$callie_britt_get_load_fonts_option',
				"type" => "text"
				);
		}
		$fonts['load_fonts_end'] = array(
			"type" => "section_end"
			);

		// Fonts - H1..6, P, Info, Menu, etc.
		$theme_fonts = callie_britt_get_theme_fonts();
		foreach ($theme_fonts as $tag=>$v) {
			$fonts["{$tag}_section"] = array(
				"title" => !empty($v['title']) 
								? $v['title'] 
								// Translators: Add tag's name to make title 'H1 settings', 'P settings', etc.
								: esc_html(sprintf(__('%s settings', 'callie-britt'), $tag)),
				"desc" => !empty($v['description']) 
								? $v['description'] 
								// Translators: Add tag's name to make description
								: wp_kses_post( sprintf(__('Font settings of the "%s" tag.', 'callie-britt'), $tag) ),
				"type" => "section",
				);
	
			foreach ($v as $css_prop=>$css_value) {
				if (in_array($css_prop, array('title', 'description'))) continue;
				$options = '';
				$type = 'text';
				$load_order = 1;
				$title = ucfirst(str_replace('-', ' ', $css_prop));
				if ($css_prop == 'font-family') {
					$type = 'select';
					$options = array();
					$load_order = 2;		// Load this option's value after all options are loaded (use option 'load_fonts' to build fonts list)
				} else if ($css_prop == 'font-weight') {
					$type = 'select';
					$options = array(
						'inherit' => esc_html__("Inherit", 'callie-britt'),
						'100' => esc_html__('100 (Light)', 'callie-britt'), 
						'200' => esc_html__('200 (Light)', 'callie-britt'), 
						'300' => esc_html__('300 (Thin)',  'callie-britt'),
						'400' => esc_html__('400 (Normal)', 'callie-britt'),
						'500' => esc_html__('500 (Semibold)', 'callie-britt'),
						'600' => esc_html__('600 (Semibold)', 'callie-britt'),
						'700' => esc_html__('700 (Bold)', 'callie-britt'),
						'800' => esc_html__('800 (Black)', 'callie-britt'),
						'900' => esc_html__('900 (Black)', 'callie-britt')
					);
				} else if ($css_prop == 'font-style') {
					$type = 'select';
					$options = array(
						'inherit' => esc_html__("Inherit", 'callie-britt'),
						'normal' => esc_html__('Normal', 'callie-britt'), 
						'italic' => esc_html__('Italic', 'callie-britt')
					);
				} else if ($css_prop == 'text-decoration') {
					$type = 'select';
					$options = array(
						'inherit' => esc_html__("Inherit", 'callie-britt'),
						'none' => esc_html__('None', 'callie-britt'), 
						'underline' => esc_html__('Underline', 'callie-britt'),
						'overline' => esc_html__('Overline', 'callie-britt'),
						'line-through' => esc_html__('Line-through', 'callie-britt')
					);
				} else if ($css_prop == 'text-transform') {
					$type = 'select';
					$options = array(
						'inherit' => esc_html__("Inherit", 'callie-britt'),
						'none' => esc_html__('None', 'callie-britt'), 
						'uppercase' => esc_html__('Uppercase', 'callie-britt'),
						'lowercase' => esc_html__('Lowercase', 'callie-britt'),
						'capitalize' => esc_html__('Capitalize', 'callie-britt')
					);
				}
				$fonts["{$tag}_{$css_prop}"] = array(
					"title" => $title,
					"desc" => '',
					"class" => "callie_britt_column-1_5",
					"refresh" => false,
					"load_order" => $load_order,
					"std" => '$callie_britt_get_theme_fonts_option',
					"options" => $options,
					"type" => $type
				);
			}
			
			$fonts["{$tag}_section_end"] = array(
				"type" => "section_end"
				);
		}

		$fonts['fonts_end'] = array(
			"type" => "panel_end"
			);

		// Add fonts parameters to Theme Options
		callie_britt_storage_set_array_before('options', 'panel_colors', $fonts);


		// Add Header Video if WP version < 4.7
		// -----------------------------------------------------
		if (!function_exists('get_header_video_url')) {
			callie_britt_storage_set_array_after('options', 'header_image_override', 'header_video', array(
				"title" => esc_html__('Header video', 'callie-britt'),
				"desc" => wp_kses_data( __("Select video to use it as background for the header", 'callie-britt') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'callie-britt')
				),
				"std" => '',
				"type" => "video"
				)
			);
		}


		// Add option 'logo' if WP version < 4.5
		// or 'custom_logo' if current page is 'Theme Options'
		// ------------------------------------------------------
		if (!function_exists('the_custom_logo') || (isset($_REQUEST['page']) && $_REQUEST['page']=='theme_options')) {
			callie_britt_storage_set_array_before('options', 'logo_retina', function_exists('the_custom_logo') ? 'custom_logo' : 'logo', array(
				"title" => esc_html__('Logo', 'callie-britt'),
				"desc" => wp_kses_data( __('Select or upload the site logo', 'callie-britt') ),
				"class" => "callie_britt_column-1_2 callie_britt_new_row",
				"priority" => 60,
				"std" => '',
				"type" => "image"
				)
			);
		}

	}
}


// Returns a list of options that can be overridden for CPT
if (!function_exists('callie_britt_options_get_list_cpt_options')) {
	function callie_britt_options_get_list_cpt_options($cpt, $title='') {
		if (empty($title)) $title = ucfirst($cpt);
		return array(
					"header_info_{$cpt}" => array(
						"title" => esc_html__('Header', 'callie-britt'),
						"desc" => '',
						"type" => "info",
						),
					"header_type_{$cpt}" => array(
						"title" => esc_html__('Header style', 'callie-britt'),
						"desc" => wp_kses_data( __('Choose whether to use the default header or header Layouts (available only if the ThemeREX Addons is activated)', 'callie-britt') ),
						"std" => 'inherit',
						"options" => callie_britt_get_list_header_footer_types(true),
						"type" => CALLIE_BRITT_THEME_FREE ? "hidden" : "switch"
						),
					"header_style_{$cpt}" => array(
						"title" => esc_html__('Select custom layout', 'callie-britt'),
						// Translators: Add CPT name to the description
						"desc" => wp_kses_data( sprintf(__('Select custom layout to display the site header on the %s pages', 'callie-britt'), $title) ),
						"dependency" => array(
							"header_type_{$cpt}" => array('custom')
						),
						"std" => 'inherit',
						"options" => array(),
						"type" => CALLIE_BRITT_THEME_FREE ? "hidden" : "select"
						),
					"header_position_{$cpt}" => array(
						"title" => esc_html__('Header position', 'callie-britt'),
						// Translators: Add CPT name to the description
						"desc" => wp_kses_data( sprintf(__('Select position to display the site header on the %s pages', 'callie-britt'), $title) ),
						"std" => 'inherit',
						"options" => array(),
						"type" => CALLIE_BRITT_THEME_FREE ? "hidden" : "switch"
						),
						
					"sidebar_info_{$cpt}" => array(
						"title" => esc_html__('Sidebar', 'callie-britt'),
						"desc" => '',
						"type" => "info",
						),
					"sidebar_position_{$cpt}" => array(
						"title" => esc_html__('Sidebar position', 'callie-britt'),
						// Translators: Add CPT name to the description
						"desc" => wp_kses_data( sprintf(__('Select position to show sidebar on the %s pages', 'callie-britt'), $title) ),
						"std" => 'left',
						"options" => array(),
						"type" => "switch"
						),
					"sidebar_widgets_{$cpt}" => array(
						"title" => esc_html__('Sidebar widgets', 'callie-britt'),
						// Translators: Add CPT name to the description
						"desc" => wp_kses_data( sprintf(__('Select sidebar to show on the %s pages', 'callie-britt'), $title) ),
						"dependency" => array(
							"sidebar_position_{$cpt}" => array('left', 'right')
						),
						"std" => 'hide',
						"options" => array(),
						"type" => "select"
						),
					"hide_sidebar_on_single_{$cpt}" => array(
						"title" => esc_html__('Hide sidebar on the single pages', 'callie-britt'),
						"desc" => wp_kses_data( __("Hide sidebar on the single page", 'callie-britt') ),
						"std" => 'inherit',
						"options" => array(
							'inherit' => esc_html__('Inherit', 'callie-britt'),
							1 => esc_html__('Hide', 'callie-britt'),
							0 => esc_html__('Show', 'callie-britt'),
						),
						"type" => "switch"
						),
						
					"footer_info_{$cpt}" => array(
						"title" => esc_html__('Footer', 'callie-britt'),
						"desc" => '',
						"type" => "info",
						),
					"footer_type_{$cpt}" => array(
						"title" => esc_html__('Footer style', 'callie-britt'),
						"desc" => wp_kses_data( __('Choose whether to use the default footer or footer Layouts (available only if the ThemeREX Addons is activated)', 'callie-britt') ),
						"std" => 'inherit',
						"options" => callie_britt_get_list_header_footer_types(true),
						"type" => CALLIE_BRITT_THEME_FREE ? "hidden" : "switch"
						),
					"footer_style_{$cpt}" => array(
						"title" => esc_html__('Select custom layout', 'callie-britt'),
						"desc" => wp_kses_data( __('Select custom layout to display the site footer', 'callie-britt') ),
						"std" => 'inherit',
						"dependency" => array(
							"footer_type_{$cpt}" => array('custom')
						),
						"options" => array(),
						"type" => CALLIE_BRITT_THEME_FREE ? "hidden" : "select"
						),
					"footer_widgets_{$cpt}" => array(
						"title" => esc_html__('Footer widgets', 'callie-britt'),
						"desc" => wp_kses_data( __('Select set of widgets to show in the footer', 'callie-britt') ),
						"dependency" => array(
							"footer_type_{$cpt}" => array('default')
						),
						"std" => 'footer_widgets',
						"options" => array(),
						"type" => "select"
						),
					"footer_columns_{$cpt}" => array(
						"title" => esc_html__('Footer columns', 'callie-britt'),
						"desc" => wp_kses_data( __('Select number columns to show widgets in the footer. If 0 - autodetect by the widgets count', 'callie-britt') ),
						"dependency" => array(
							"footer_type_{$cpt}" => array('default'),
							"footer_widgets_{$cpt}" => array('^hide')
						),
						"std" => 0,
						"options" => callie_britt_get_list_range(0,6),
						"type" => "select"
						),
					"footer_wide_{$cpt}" => array(
						"title" => esc_html__('Footer fullwidth', 'callie-britt'),
						"desc" => wp_kses_data( __('Do you want to stretch the footer to the entire window width?', 'callie-britt') ),
						"dependency" => array(
							"footer_type_{$cpt}" => array('default')
						),
						"std" => 0,
						"type" => "checkbox"
						),
					);
	}
}

// Action to show button 'send' and message box with result of the action
if ( !function_exists( 'trx_addons_sc_form_field_send' ) ) {
	add_action('trx_addons_action_field_send', 'trx_addons_sc_form_field_send', 10, 1);
	function trx_addons_sc_form_field_send($args=array()) {
		static $cnt = 0;
		$cnt++;
		$privacy = trx_addons_get_privacy_text();
		if (!empty($privacy)) {
			?><div class="sc_form_field sc_form_field_checkbox"><?php
				?><input type="checkbox" id="i_agree_privacy_policy_sc_form_<?php echo esc_attr($cnt); ?>" name="i_agree_privacy_policy" class="sc_form_privacy_checkbox" value="1">
				<label for="i_agree_privacy_policy_sc_form_<?php echo esc_attr($cnt); ?>"><?php trx_addons_show_layout($privacy); ?></label>
			</div><?php
		}
		?><div class="sc_form_field sc_form_field_button sc_form_field_submit"><?php
			?><button class="<?php echo esc_attr(apply_filters('trx_addons_filter_sc_item_link_classes', '', 'sc_form', $args)); ?>"<?php
				if (!empty($privacy)) echo ' disabled="disabled"'
			?>><?php
				if (!empty($args['button_caption']))
					echo esc_html($args['button_caption']);
				else
					esc_html_e('Send Message', 'callie-britt');
			?></button>
		</div>
		<div class="trx_addons_message_box sc_form_result"></div>
		<?php
	}
}


// Return lists with choises when its need in the admin mode
if (!function_exists('callie_britt_options_get_list_choises')) {
	add_filter('callie_britt_filter_options_get_list_choises', 'callie_britt_options_get_list_choises', 10, 2);
	function callie_britt_options_get_list_choises($list, $id) {
		if (is_array($list) && count($list)==0) {
			if (strpos($id, 'header_style')===0)
				$list = callie_britt_get_list_header_styles(strpos($id, 'header_style_')===0);
			else if (strpos($id, 'header_position')===0)
				$list = callie_britt_get_list_header_positions(strpos($id, 'header_position_')===0);
			else if (strpos($id, 'header_widgets')===0)
				$list = callie_britt_get_list_sidebars(strpos($id, 'header_widgets_')===0, true);
			else if (strpos($id, '_scheme') > 0)
				$list = callie_britt_get_list_schemes($id!='color_scheme');
			else if (strpos($id, 'sidebar_widgets')===0)
				$list = callie_britt_get_list_sidebars(strpos($id, 'sidebar_widgets_')===0, true);
			else if (strpos($id, 'sidebar_position')===0)
				$list = callie_britt_get_list_sidebars_positions(strpos($id, 'sidebar_position_')===0);
			else if (strpos($id, 'widgets_above_page')===0)
				$list = callie_britt_get_list_sidebars(strpos($id, 'widgets_above_page_')===0, true);
			else if (strpos($id, 'widgets_above_content')===0)
				$list = callie_britt_get_list_sidebars(strpos($id, 'widgets_above_content_')===0, true);
			else if (strpos($id, 'widgets_below_page')===0)
				$list = callie_britt_get_list_sidebars(strpos($id, 'widgets_below_page_')===0, true);
			else if (strpos($id, 'widgets_below_content')===0)
				$list = callie_britt_get_list_sidebars(strpos($id, 'widgets_below_content_')===0, true);
			else if (strpos($id, 'footer_style')===0)
				$list = callie_britt_get_list_footer_styles(strpos($id, 'footer_style_')===0);
			else if (strpos($id, 'footer_widgets')===0)
				$list = callie_britt_get_list_sidebars(strpos($id, 'footer_widgets_')===0, true);
			else if (strpos($id, 'blog_style')===0)
				$list = callie_britt_get_list_blog_styles(strpos($id, 'blog_style_')===0);
			else if (strpos($id, 'post_type')===0)
				$list = callie_britt_get_list_posts_types();
			else if (strpos($id, 'parent_cat')===0)
				$list = callie_britt_array_merge(array(0 => esc_html__('- Select category -', 'callie-britt')), callie_britt_get_list_categories());
			else if (strpos($id, 'blog_animation')===0)
				$list = callie_britt_get_list_animations_in();
			else if ($id == 'color_scheme_editor')
				$list = callie_britt_get_list_schemes();
			else if (strpos($id, '_font-family') > 0)
				$list = callie_britt_get_list_load_fonts(true);
		}
		return $list;
	}
}
?>