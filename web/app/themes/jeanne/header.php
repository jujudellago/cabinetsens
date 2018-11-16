<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the content div.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @since 1.0.0
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<?php wp_head(); ?>
</head>
		
<body <?php body_class(); ?> >

	<div id="root-container">
		<header id="header-container" class="clearfix">
			
			<?php
				
				$additional_classes = '';
				
				$custom_logo_id = get_theme_mod( 'custom_logo' );
				if ( ! empty( $custom_logo_id ) ) {
					$additional_classes .= ' has-logo-image ';
				}
				
				$tagline = get_bloginfo( 'description' );
				$display_tagline = get_theme_mod( 'jeanne_ctmzr_header_styles_show_tagline', true );
				
				if ( ! empty( $tagline ) && $display_tagline ) {
					$additional_classes .= ' with-tagline ';
				} else {
					$additional_classes .= ' no-tagline ';
				}
				
		
				// Print out the tagline if there is any
				if ( ! empty( $tagline ) && $display_tagline ) {
					echo '<span class="tagline">' . esc_html( $tagline ) . '</span>';
				}
				
			?>
			
			<?php if ( get_theme_mod( 'jeanne_ctmzr_settings_general_show_search_button', true ) ) : ?>
				<div class="search-button-wrapper">
					<a href="javascript:;" class="search-button"><?php echo esc_html__( 'Search', 'jeanne' ); ?></a>
				</div>
			<?php endif; ?>
			
			<div class="inner-header-container clearfix">
				
				<div class="logo-tagline-wrapper <?php echo esc_attr( $additional_classes ); ?>">
					<div class="logo-wrapper">
							
						<?php if ( jeanne_is_site_title_h1_allowed() ) : ?>
							<h1 class="site-title-heading">
						<?php endif; ?>
						
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
							<?php
								
								// Print out site logo or title
								if ( ! empty( $custom_logo_id ) ) {
									
									$image = wp_get_attachment_image_src( $custom_logo_id, 'full' );
									$logo_url = $image[0];
									echo '<img src="' . esc_url( $logo_url ) . '" alt="' . esc_attr( get_bloginfo( 'name' ) ) . '" class="logo-image" />';
									
								} else {
									
									$site_title = get_bloginfo( 'name' );
									echo '<span class="site-title">' . $site_title . '</span>';
								}
								
							?>
							</a>
							<!--<span class="site-sub-title">
								sens, essence, naissance
							</span>-->
							
						<?php if ( jeanne_is_site_title_h1_allowed() ) : ?>
							</h1>
						<?php endif; ?>
						
					</div>
					<!-- .logo-wrapper -->
					
				</div>

				<!-- .logo-tagline-wrapper -->
				
				<nav class="site-menu">
					
					<?php
						
						// Main Menu
						wp_nav_menu( array(
							'container'		 => 'ul',
							'theme_location' => 'main_menu',
							'menu_class'     => 'menu-list menu-style',
						 ) );
						
					?>
					
				</nav>
				
				<?php
					
					// Social Networks
					jeanne_display_social_networks( get_theme_mod( 'jeanne_ctmzr_site_identity_social_network_display', 'text' ) );
					
				?>
				
			</div>
			<!-- .inner-header-container -->
			
		</header>
		
		<div id="main-container">
			<main id="content-container">