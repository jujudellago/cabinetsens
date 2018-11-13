/*global jQuery:false */

jQuery( document ).ready(function( $ ) {
	"use strict";
	
	
	/* #General
	 ================================================== */
	
	var waitForFinalEvent = (function () {
	  var timers = {};
	  return function (callback, ms, uniqueId) {
		if (!uniqueId) {
		  uniqueId = "Don't call this twice without a uniqueId";
		}
		if (timers[uniqueId]) {
		  clearTimeout (timers[uniqueId]);
		}
		timers[uniqueId] = setTimeout(callback, ms);
	  };
	})();
	
	
	
	if ( $( '.inner-footer-container' ).length === 0 ) {
		$( '.footer-container' ).addClass( 'no-footer-widgets' );
	}
	
	
	
	// Set the size of the images in the search results
	setSearchImageSize();
	
	function setSearchImageSize() {
		
		$( '.search-result-list article .post-image' ).each( function() {
			
			$( this ).css( 'height', '' ).css({
				background: 'url(' + $( this ).attr( 'data-img-src' ) + ') center no-repeat',
				height: $( this ).closest( '.post-item' ).outerHeight(),
			});

		});
		
	}
	
	
	
	// To always adjust the height of the site menu to be equal to its container so the border displays correctly
	adjustMenuHeight();
	
	function adjustMenuHeight() {
		
		if ( checkModernizr() ) {
			
			$( '.site-menu' ).css( 'height', '' );
			
			if ( Modernizr.mq('(min-width: 768px)') ) {
					
				$( '.site-menu' ).css({
					height: $( '.inner-header-container' ).height(),
				});
				
			}
			
		}
		
	}
	
	
	
	// Adjust element locations on small viewports
	adjustElementLocations();
	
	function adjustElementLocations() {
		
		if ( checkModernizr() ) {
			
			if ( Modernizr.mq('(max-width: 767px)') ) {
				
				$( '.copyright' ).after( $( '.social-network-wrapper' ).css( 'opacity', 1 ) );
				
			} else {
				
				$( '.inner-header-container' ).append( $( '.social-network-wrapper' ).css( 'opacity', 1 ) );
				
			}
			
		}
		
	}
	
	
	
	// Only run this code when it's on the preview mode in the customizer.
	// We need to use this because the 'auto' transport won't update the menu location in the preview screen.
	if ( $( 'script[src*="customize-preview"]' ).length > 0 ) {
		
		window.setInterval(function(){
			
			adjustMenuHeight();
			adjustItemMarginAndWidth();
			
		}, 3000);
		
	}
	
	
	
	/* #Portfolio
	 ================================================== */
	
	var countItems = $( '.portfolio-item, .image-wrapper' ).length;

	$( '.inner-portfolio-list, .portfolio-format-content' ).imagesLoaded()
	.always( function( instance ) {
		
		initFlexImages();
		
	})
	.progress( function( instance, image ) {
		
		if ( image.isLoaded ) {
			
			$( image.img ).closest( '.portfolio-item, .image-wrapper' ).addClass( 'loaded' );
			
			var countLoadedImages = $( '.portfolio-item.loaded, .image-wrapper.loaded' ).length;
			var width = 100 * ( countLoadedImages / countItems );
			
			$( '.progress-bar' ).css({
				'width' : width + '%',
			});
			
		}
		
	});
	
	
	
	function initFlexImages() {
		
		var page = 'single';
		if ( $( '.inner-portfolio-list' ).length > 0 ) {
			page = 'list';
		}
		
		var rowHeightValue = parseInt( ThemeOptions.featured_works_grid_row_height, 10 ),
			itemSelector = '.portfolio-item',
			$container = $( '.inner-portfolio-list' ),
			$sectionContainer = $( '.portfolio-item-list' );
			
		if ( $( '.all-works-template' ).length > 0 ) {
			rowHeightValue = parseInt( ThemeOptions.all_works_grid_row_height, 10 );
		}
		
		if ( 'single' === page ) {
			
			rowHeightValue = parseInt( ThemeOptions.portfolio_single_grid_row_height, 10 );
			itemSelector = '.portfolio-format-item';
			$container = $( '.portfolio-format-block' );
			$sectionContainer = $( '.portfolio-format-content' );
			
		}
		
		
		// Adjust row height a bit on lower resolutions
		if ( checkModernizr() ) {
				
			if ( Modernizr.mq( '(max-width: 1250px) and (min-width: 768px)' ) ) {
				rowHeightValue = rowHeightValue * 0.8;
			}
			
			if ( Modernizr.mq( '(max-width: 1000px) and (min-width: 768px)' ) ) {
				rowHeightValue = rowHeightValue * 0.7;
			}
			
		}
		
		
		// Create the flexible grid
		$( '.justified-images' ).flexImages({
			container: itemSelector,
			rowHeight: rowHeightValue,
		});
		
		
		
		if ( Modernizr.mq( '(min-width: 601px)' ) ) {
			
			waitForFinalEvent(function() {
				
				// Adjust the width of the last item in a row to make sure that it fits in the grid row
				adjustItemMarginAndWidth();
			
			}, 300, 'adjust_grid_items' );
			
		}
		
		// Display the items one after another
		displayPortfolioItems();
		
	}
	
	function adjustItemMarginAndWidth() {
		
		var page = 'single';
		if ( $( '.inner-portfolio-list' ).length > 0 ) {
			page = 'list';
		}
			
		var selectorString = '.portfolio-item';
		if ( 'single' === page ) {
			selectorString = '.portfolio-format-item';
		}
		
		// Loop through each flexible grid
		$( '.justified-images' ).each( function() {
				
			var $container = $( this ),
				containerWidth = $container.width();
			
			// Get a total row number in this grid
			var totalRowCount = 1;
			$container.find( selectorString ).each( function() {
				
				if ( $( this ).data( 'row' ) != totalRowCount ) {
					totalRowCount += 1;
				}
				
			});
			
			// Loop through each item, calculate the total width of the items in a row and adjust the width if needed
			for ( var i = 1; i <= totalRowCount; i++ ) {
				
				var totalItemWidth = 0,
					highestMarginBottom = 0;
					
				$container.find( '.item-row-' + i ).each( function() {
					
					// Adjust the bottom margin
					var $title = $( this ).find( '.portfolio-title' );
					
					if ( 'single' === page ) {
						$title = $( this ).find( '.caption-element' );
					}
					
					var titleHeight = $title.outerHeight( true ),
						currentMarginBottom = titleHeight + Math.abs( getIntValueFromCSSAttribute( $( this ).css( 'margin-bottom' ) ) - titleHeight );
					
					if ( 'single' === page ) {
						
						if ( $title.hasClass( 'video-caption' ) ) {
							titleHeight = 0;
						}
						
						currentMarginBottom = getIntValueFromCSSAttribute( $( this ).css( 'margin-bottom' ) ) + titleHeight;
						
					}
					
						
					if ( currentMarginBottom >= highestMarginBottom ) {
						
						highestMarginBottom = currentMarginBottom;
						
						$( '.item-row-' + i ).css( 'margin-bottom', '' ).css({
							marginBottom: highestMarginBottom,
						});
						
					}
					
					
					
					
					// Adjust the width of the last item
					totalItemWidth += $( this ).outerWidth( true );
					
					if ( $( this ).hasClass( 'last-in-row' ) ) {
						
						if ( totalItemWidth > containerWidth ) {
							$( this ).css( 'width', $( this ).width() - Math.ceil( totalItemWidth - containerWidth ) );
						}
							
					}
					
				});
				
			}
			
		});
	
	}
	
	function displayPortfolioItems() {
		
		$( '.portfolio-loading, .portfolio-loading-wrapper' ).animate({
			opacity: 0,
		}, function() {
			
			// For smoother showing items
			waitForFinalEvent(function() {
				
				$( '.portfolio-loading, .portfolio-loading-wrapper' ).css( 'display', 'none' );
				
				$( '.portfolio-item, .portfolio-format-item' ).css({
					opacity: 1,
					visibility: 'visible',
				}).addClass( 'visible' );
				
				$( '.curtain' ).animate({
					top: '100%',
				}, 1000, 'easeOutQuint', function() {
					$( '.curtain' ).css( 'display', 'none' );
				});
				
			}, 200, 'delay_item_display');
			
		});
		
	}
	
	
	
	/* #Pages & Posts
	 ================================================== */
	// Show opacity animation for images after loading
	$( '.post-image' ).imagesLoaded( function() {
		
		adjustPostMetaLocation();
		
		$( '.post-image' ).each( function( index ) {
			
			var $postImage = $( this );
			
			$postImage.find( 'img' ).css( 'visibility', 'visible' ).delay( 90 * index ).animate({
				opacity : 1,
			}, 300, function() {
				$( this ).addClass( 'visible' );
			});
			
		});
		
	});
	
	function adjustPostMetaLocation() {
		
		$( '.blog-list .post-item' ).each( function() {
			
			var $postItem = $( this ),
				$postMeta = $postItem.find( '.post-meta-wrapper' );
			
			$postMeta.css( 'margin-top', '' ).css({
				marginTop: $postItem.height() - $postMeta.height() - ( 0.039 * $postItem.width() ),
				opacity: 1,
			});
			
		});
		
	}
		
	
	// If the post navigation is empty, hide them
	if ( $( '.next-prev-post-navigation' ).is( ':empty' ) ) {
		$( '.next-prev-post-navigation' ).css( 'display', 'none' );
	} else {
		$( '.next-prev-post-navigation a' ).addClass( 'content-style hover-style' );
	}
	
	
	
	// Adjust the display of any elements that have the '.alignfull' class
	adjustAlignfullElements();
	
	function adjustAlignfullElements() {
		
		if ( Modernizr.mq('(max-width: 1360px)') ) {
			
			var contentContainerWidth = $( '.post-content-container' ).width() - ( 0.0316 * $( '.post-content-container' ).width() * 2 ), //-25px*2
				contentWidth = $( '.post-content' ).width(),
				marginValue = ( ( contentContainerWidth - contentWidth ) / 2 ) / contentWidth * -100;
			
			$( '.alignfull' ).css({
				marginLeft: marginValue + '%',
				marginRight: marginValue + '%',
				maxWidth: contentContainerWidth,
				opacity: 1,
			});
			
		} else {
			
			$( '.alignfull' ).css({
				marginLeft: '',
				marginRight: '',
				maxWidth: '',
				opacity: 1,
			});
			
		}
		
	}
	
	
	
	/* #Site Menu
	 ================================================== */
	// Init the menu and submenu
	if ( jQuery().superfish ) {
			
		$( '.menu-list' ).superfish({
			popUpSelector: '.sub-menu, .children',
			animation: {
				opacity: 'show',
			},
			speed: 300,
			speedOut: 400,
			delay: 500	// milliseconds delay on mouseout
		});
		
	}
	
	
	// Adjust the position of first-level submenu (only for vertical menu)
	$( '.menu-list > li > .sub-menu, .menu-list > li > .children' ).each( function() {
		$( this ).css({
			left: $( this ).parent().children( 'a' ).width() + 15,
		});
	});
			
	
	
	/* #Mobile Menu
	 ================================================== */
	if ( jQuery().slicknav ) {
			
		$( '.menu-list' ).slicknav({
			allowParentLinks: true,
		});
		
		// Put the mobile menu into the main menu container
		$( '.site-menu' ).prepend( $( '.slicknav_menu' ) );
		
	}
		
	
	
	/* #Search 
	 ================================================== */

	// Change the default placeholder text of the modal search input
	$( '#search-panel-wrapper .search-field' ).attr( 'placeholder', ThemeOptions.modal_search_input_text );
	
	var isSearchOpened = false;
	
	$( '.search-button, .search-icon-button' ).on( 'click', function() {
		
		$( '#search-panel-wrapper' ).css( 'display', 'block' ).stop().animate({
			opacity: 1,
		}, 300, function() {
			
			$( '#search-panel-wrapper .search-field' ).focus();
			isSearchOpened = true;
			
		});
		
	});
	
	$( '#search-close-button' ).on( 'click', function() {
		closeSearchPanel();
	});
	
	$( document ).on( 'keyup', function( e ) {
		
		// Escape key
		if ( 27 === e.keyCode ) {
			closeSearchPanel();
		}
		
	});
	
	function closeSearchPanel() {
		
		if ( isSearchOpened ) {
			
			$( '#search-panel-wrapper' ).stop().animate({
				opacity: 0,
			}, 300, function() {
				
				$( this ).css( 'display', 'none' );
				isSearchOpened = false;
				
			});
	
		}
		
	}
	
	
	
	/* #Fancybox
	 ================================================== */
	 
	var enableLightbox = ThemeOptions.enable_lightbox_wp_gallery;
	
	if ( '0' === enableLightbox || '' === enableLightbox ) {
		enableLightbox = false;
	} else {
		enableLightbox = true;
	}
	
	// Add FancyBox feature to WP gallery and WP images
	if ( enableLightbox ) {
		
		// For the classic gallery
		registerFancyBoxToWPGallery( $( '.gallery' ), '.gallery-item' );
		// For the Gutenberg's Gallery block
		registerFancyBoxToWPGallery( $( '.wp-block-gallery' ), '.blocks-gallery-item' );
		registerFancyBoxToWPImage();
		
	}
	 
	function registerFancyBoxToWPGallery( $gallery, itemSelector ) {
		
		var $wpGallery = $gallery;

		$wpGallery.each( function() {
			
			var mainId = randomizeNumberFromRange( 10000, 90000 );
			var items = $( this ).find( itemSelector ).find( 'a' );

			items.each( function() {

				var href = $( this ).attr( 'href' );
				
				if ( typeof href !== typeof undefined && href !== false ) {
						
					// Check the target file extension, if it is one of the image extension then add Fancybox class
					if ( href.toLowerCase().indexOf( '.jpg' ) >= 0 || href.toLowerCase().indexOf( '.jpeg' ) >= 0 || href.toLowerCase().indexOf( '.png' ) >= 0 || href.toLowerCase().indexOf( '.gif' ) >= 0) {

						$( this ).addClass( 'image-lightbox' );
						$( this ).attr( 'data-fancybox', mainId );

					}
					
				}

			});

		});
		
	}
	
	function registerFancyBoxToWPImage() {
		
		// Run through WP images on the page
		$( 'img[class*="wp-image-"]' ).each( function() {
			
			// If the image has an anchor tag
			var $parentAnchor = $( this ).closest( 'a' );
			
			if ( $parentAnchor.length > 0 ) {
				
				var href = $parentAnchor.attr( 'href' );
				
				if ( typeof href !== typeof undefined && href !== false ) {
						
					// Check the target file extension, if it is one of the image extension then add Fancybox class
					if (href.toLowerCase().indexOf( '.jpg' ) >= 0 || href.toLowerCase().indexOf( '.jpeg' ) >= 0 || href.toLowerCase().indexOf( '.png' ) >= 0 || href.toLowerCase().indexOf( '.gif' ) >= 0) {

						$parentAnchor.addClass( 'image-lightbox no-slideshow' );

					}
					
				}
				
			}
			
		});
		
	}
	
	
	
	callFancyBoxScript();
	
	function callFancyBoxScript() {
		
		if ( jQuery().fancybox ) {
				
			$( '.image-lightbox' ).fancybox({
				
				buttons: [
					'zoom',
					'slideShow',
					'fullScreen',
					'thumbs',
					'close',
				],
				
				caption : function( instance, item ) {
					return getImageCaptionText( $( this ) );
				},
				
				afterLoad: function( instance, current ) {
					
					var pixelRatio = window.devicePixelRatio || 1;

					if ( pixelRatio > 1.5 ) {
						current.width  = current.width  / pixelRatio;
						current.height = current.height / pixelRatio;
					}
					
				},
				
				lang: 'en',
				
				i18n: {
					en: {
						CLOSE: ThemeOptions.lightbox_close_text,
						NEXT: ThemeOptions.lightbox_next_text,
						PREV: ThemeOptions.lightbox_prev_text,
						ERROR: ThemeOptions.lightbox_error_text,
						PLAY_START: ThemeOptions.lightbox_start_slide_text,
						PLAY_STOP: ThemeOptions.lightbox_pause_slide_text,
						FULL_SCREEN: ThemeOptions.lightbox_fullscreen_text,
						THUMBS: ThemeOptions.lightbox_thumbnails_text,
						DOWNLOAD: ThemeOptions.lightbox_download_text,
						SHARE: ThemeOptions.lightbox_share_text,
						ZOOM: ThemeOptions.lightbox_zoom_text,
					},
				},
				
			});
			
		}
		
	}
	
	function getImageCaptionText( $element ) {
		
		// For WP gallery
		if ( $element.closest( '.gallery-item' ).length > 0 ) {
			return $element.closest( '.gallery-item' ).find( '.wp-caption-text' ).html();
		
		// For Gutenberg's Gallery
		} else if ( $element.closest( '.blocks-gallery-item' ).length > 0 ) {
			return $element .closest( '.blocks-gallery-item' ).find( 'figcaption' ).html();
			
		// For theme image
		} else if ( $element.closest( '.image-wrapper' ).length > 0 ) {
			return $element.closest( '.image-wrapper' ).find( '.image-caption' ).html();
			
		// For any other cases... it can be normal WP media file (image)
		} else {
			return $element.closest( '.wp-caption' ).find( '.wp-caption-text' ).html();
		}
		
	}
	
	
	
	/* #Misc
	 ================================================== */
	
	// Hide the underline of the link that wraps around img
	var $wpImages = $( 'img[class*="wp-image-"], img[class*="attachment-"], .widget-item img' );
	if ( $wpImages.closest( 'a' ).length > 0 ) {
		$wpImages.closest( 'a' ).addClass( 'no-border' );
	}
	
	function randomizeNumberFromRange( min, max ) {
		return Math.floor( Math.random() * ( max - min + 1 ) + min );
	}
	
	function checkModernizr() {
	
		if ( 'undefined' !== typeof Modernizr ) {
			return true;
		} else {
			return false;
		}
		
	}
	
	function getIntValueFromCSSAttribute( $attr ) {
		return parseInt( $attr.replace( 'px', '' ), 10 );
	}
	
		
	
	/* #Responsive Related
	 ================================================== */
	var windowWidth = $( window ).width();
	var timeoutId = 0;
	
	// Run this function right after the resizing is finished
	function doneResizing() {
	
		waitForFinalEvent(function() {
			
			initFlexImages();
			
		}, 300, 'adjust_flex_grids');
		
	}
	
	$( window ).on( 'resize', function() {
		
		// Check if window width has really changed and it's not just iOS triggering a resize event on scroll
		if ( $( window).width() != windowWidth ) {
			
			// Update the window width for next time
			windowWidth = $( window ).width();
			
			adjustElementLocations();
			adjustMenuHeight();
			setSearchImageSize();
			adjustAlignfullElements();
			adjustPostMetaLocation();
			
			clearTimeout( timeoutId );
			timeoutId = setTimeout( doneResizing, 300 );
			
		}
	});
		
});