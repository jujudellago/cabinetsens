<?php

if ( ! function_exists( 'qode_news_get_template_part' ) ) {
	/**
	 * Loads module template part.
	 *
	 * @param string $template name of the template to load
	 * @param string $slug
	 * @param array $params array of parameters to pass to template
	 *
	 * @return html
	 */
	function qode_news_get_template_part( $template, $module, $slug = '', $params = array() ) {
		
		$available_characters = '/[^A-Za-z0-9\_\-\/\:\\\\]/';
		
		if ( is_scalar( $template ) ) {
			$template = preg_replace( $available_characters, '', $template );
		} else {
			$template = '';
		}
		
		if ( is_scalar( $module ) ) {
			$module = preg_replace( $available_characters, '', $module );
		} else {
			$module = '';
		}
		
		if ( is_scalar( $slug ) ) {
			$slug = preg_replace( $available_characters, '', $slug );
		} else {
			$slug = '';
		}
		
		//HTML Content from template
		$html          = '';
		$template_path = QODE_NEWS_MODULES_PATH . '/' . $module;
		
		$temp = $template_path . '/' . $template;
		
		if ( is_array( $params ) && count( $params ) ) {
			extract( $params );
		}
		
		$template = '';
		
		if ( ! empty( $temp ) ) {
			if ( ! empty( $slug ) ) {
				$template = "{$temp}-{$slug}.php";
				
				if ( ! file_exists( $template ) ) {
					$template = $temp . '.php';
				}
			} else {
				$template = $temp . '.php';
			}
		}
		
		if ( $template ) {
			ob_start();
			include( $template );
			$html = ob_get_clean();
		}
		
		return $html;
	}
}

if(!function_exists('qode_news_get_shortcode_module_template_part')) {
	/**
	 * Loads module template part.
	 *
	 * @param string $template name of the template to load
	 * @param string $shortcode name of the shortcode folder
	 * @param string $slug
	 * @param array $params array of parameters to pass to template
	 *
	 * @return html
	 */
	function qode_news_get_shortcode_module_template_part( $template, $shortcode, $slug = '', $params = array() ) {
		
		$available_characters = '/[^A-Za-z0-9\_\-\/\:\\\\]/';
		
		if ( is_scalar( $template ) ) {
			$template = preg_replace( $available_characters, '', $template );
		} else {
			$template = '';
		}
		
		if ( is_scalar( $shortcode ) ) {
			$shortcode = preg_replace( $available_characters, '', $shortcode );
		} else {
			$shortcode = '';
		}
		
		if ( is_scalar( $slug ) ) {
			$slug = preg_replace( $available_characters, '', $slug );
		} else {
			$slug = '';
		}
		
		//HTML Content from template
		$html          = '';
		$template_path = QODE_NEWS_SHORTCODES_PATH . '/' . $shortcode;
		
		$temp = $template_path . '/' . $template;
		
		if ( is_array( $params ) && count( $params ) ) {
			extract( $params );
		}
		
		$template = '';
		
		if ( ! empty( $temp ) ) {
			if ( ! empty( $slug ) ) {
				$template = "{$temp}-{$slug}.php";
				
				if ( ! file_exists( $template ) ) {
					$template = $temp . '.php';
				}
			} else {
				$template = $temp . '.php';
			}
		}
		
		if ( $template ) {
			ob_start();
			include( $template );
			$html = ob_get_clean();
		}
		
		return $html;
	}
}

if(!function_exists('qode_news_get_shortcode_inner_template_part')) {
	/**
	 * Loads module template part.
	 *
	 * @param string $template name of the template to load
	 * @param string $slug
	 * @param array $params array of parameters to pass to template
	 *
	 * @return html
	 */
	function qode_news_get_shortcode_inner_template_part( $template, $slug = '', $params = array() ) {
		
		$available_characters = '/[^A-Za-z0-9\_\-\/\:\\\\]/';
		
		if ( is_scalar( $template ) ) {
			$template = preg_replace( $available_characters, '', $template );
		} else {
			$template = '';
		}
		
		if ( is_scalar( $slug ) ) {
			$slug = preg_replace( $available_characters, '', $slug );
		} else {
			$slug = '';
		}
		
		//HTML Content from template
		$html          = '';
		$template_path = QODE_NEWS_SHORTCODES_PATH . '/templates/parts';
		
		$temp = $template_path . '/' . $template;
		
		if ( is_array( $params ) && count( $params ) ) {
			extract( $params );
		}
		
		$template = '';
		
		if ( ! empty( $temp ) ) {
			if ( ! empty( $slug ) ) {
				$template = "{$temp}-{$slug}.php";
				
				if ( ! file_exists( $template ) ) {
					$template = $temp . '.php';
				}
			} else {
				$template = $temp . '.php';
			}
		}
		
		if ( $template ) {
			ob_start();
			include( $template );
			$html = ob_get_clean();
		}
		
		return $html;
	}
}

if (!function_exists('qode_news_get_filtered_params')) {
    /**
     * Function that returns associative array without prefix.
     * This function is used for block shortcodes (prefix_param -> param)
     *
     * @param $params array which need to be filtered
     * @param $prefix string part of key that need to be removed
     *
     * @return array
     */

    function qode_news_get_filtered_params($params, $prefix) {
        $params_filtered = array();

        foreach ($params as $key => $value) {
            $new_key = substr($key, strlen($prefix) + 1);
            $params_filtered[$new_key] = $value;
        }

        return $params_filtered;
    }
}

if ( ! function_exists( 'qode_news_excerpt' ) ) {
	/**
	 * Function that cuts post excerpt to the number of word based on previosly set global
	 * variable $word_count, which is defined in mkd_set_blog_word_count function.
	 *
	 * @param $length - default excerpt length
	 *
	 * @return string - formatted excerpt
	 *
	 * It current post has read more tag set it will return content of the post, else it will return post excerpt
	 *
	 */
	function qode_news_excerpt( $length ) {
		global $post;

		//does current post has read more tag set?
		if ( bridge_qode_post_has_read_more() ) {
			global $more;

			//override global $more variable so this can be used in blog templates
			$more = 0;

			return get_the_content( true );
		}

		$number_of_chars = bridge_qode_get_meta_field_intersect( 'number_of_chars', bridge_qode_get_page_id() );
		$word_count      = $length !== '' ? $length : $number_of_chars;

		//is word count set to something different that 0?
		if ( $word_count > 0 ) {

			//if post excerpt field is filled take that as post excerpt, else that content of the post
			$post_excerpt = $post->post_excerpt !== '' ? $post->post_excerpt : strip_tags( strip_shortcodes( $post->post_content ) );

			//remove leading dots if those exists
			$clean_excerpt = strlen( $post_excerpt ) && strpos( $post_excerpt, '...' ) ? strstr( $post_excerpt, '...', true ) : $post_excerpt;

			//if clean excerpt has text left
			if ( $clean_excerpt !== '' ) {
				//explode current excerpt to words
				$excerpt_word_array = explode( ' ', $clean_excerpt );

				//cut down that array based on the number of the words option
				$excerpt_word_array = array_slice( $excerpt_word_array, 0, $word_count );

				//and finally implode words together
				$excerpt = implode( ' ', $excerpt_word_array );

				//is excerpt different than empty string?
				if ( $excerpt !== '' ) {
					return rtrim( wp_kses_post( $excerpt ) );
				}
			}

			return '';
		} else {
			return '';
		}
	}

	if ( ! function_exists('qode_news_shortcode_atts' ) ) {
		/**
		 * Based on shortcode_atts default method
		 * Combine user attributes with default attributes and fill in defaults when needed, but also returns user attributes if they are not in defaults
		 *
		 * @param array  $pairs     Entire list of supported attributes and their defaults.
		 * @param array  $atts      User defined attributes in shortcode tag.
		 * @return array Combined and filtered attribute list.
		 *
		 */
		function qode_news_shortcode_atts($pairs, $atts){
			$atts = (array)$atts;
			$out = array();
			foreach ($pairs as $name => $default) {
				if (array_key_exists($name, $atts)) {
					$out[$name] = $atts[$name];
					unset($atts[$name]);
				}else {
					$out[$name] = $default;
				}
			}

			$merge = array_merge($out,$atts);

			return $merge;
		}
	}
}

if ( ! function_exists( 'qode_news_update_post_count_views' ) ) {
    function qode_news_update_post_count_views() {
        $post_ID = get_the_ID();

        if ( is_singular( 'post' ) ) {
            if ( isset( $_COOKIE[ 'qode-post-views_' . $post_ID ] ) ) {
                return;
            } else {
                $count = get_post_meta( $post_ID, 'qode_count_post_views_meta', true );
                if ( $count === '' ) {
                    update_post_meta( $post_ID, 'qode_count_post_views_meta', 1 );
                    setcookie( 'qode-post-views_' . $post_ID, $post_ID, time() * 20, '/' );
                } else {
                    $count ++;
                    update_post_meta( $post_ID, 'qode_count_post_views_meta', $count );
                    setcookie( 'qode-post-views_' . $post_ID, $post_ID, time() * 20, '/' );
                }
            }
        }
    }

    add_action( 'wp', 'qode_news_update_post_count_views' );
}

if ( ! function_exists( 'qode_news_get_post_count_views' ) ) {
    function qode_news_get_post_count_views( $post_ID = '' ) {
        if ( $post_ID == '' ) {
            $post_ID = get_the_ID();
        }

        $count = get_post_meta( $post_ID, 'qode_count_post_views_meta', true );

        if ( $count === '' ) {
            update_post_meta( $post_ID, 'qode_count_post_views_meta', '0' );

            return 0;
        }

        return $count;
    }
}

if ( ! function_exists( 'qode_news_get_allowed_title_tags' ) ) {
	/**
	 * HTML tags allowed in title-tag position.
	 *
	 * @return string[]
	 */
	function qode_news_get_allowed_title_tags() {
		return array( 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'p', 'span', 'div' );
	}
}

if ( ! function_exists( 'qode_news_sanitize_title_tag' ) ) {
	/**
	 * Constrains a title tag name to an allow-list. esc_attr() is not safe in tag-name position.
	 *
	 * @param mixed  $title_tag
	 * @param string $default
	 *
	 * @return string
	 */
	function qode_news_sanitize_title_tag( $title_tag, $default = 'h4' ) {
		$title_tag = is_string( $title_tag ) ? strtolower( trim( $title_tag ) ) : '';

		return in_array( $title_tag, qode_news_get_allowed_title_tags(), true ) ? $title_tag : $default;
	}
}