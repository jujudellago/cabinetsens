<?php

namespace QodeLMS\CPT\Question;

use QodeLMS\Lib\PostTypeInterface;

/**
 * Class QuestionRegister
 * @package QodeLMS\CPT\Question
 */
class QuestionRegister implements PostTypeInterface {
	/**
	 * @var string
	 */
	private $base;
	private $taxBase;
	
	public function __construct() {
		$this->base    = 'question';
		$this->taxBase = 'question-category';
		
		add_filter( 'archive_template', array( $this, 'registerArchiveTemplate' ) );
		add_filter( 'single_template', array( $this, 'registerSingleTemplate' ) );
	}
	
	/**
	 * @return string
	 */
	public function getBase() {
		return $this->base;
	}
	
	/**
	 * Registers custom post type with WordPress
	 */
	public function register() {
		$this->registerPostType();
	}
	
	/**
	 * Registers question archive template if one does'nt exists in theme.
	 * Hooked to archive_template filter
	 *
	 * @param $archive string current template
	 *
	 * @return string string changed template
	 */
	public function registerArchiveTemplate( $archive ) {
		global $post;
		
		if ( ! empty( $post ) && $post->post_type == $this->base ) {
			if ( ! file_exists( get_template_directory() . '/archive-' . $this->base . '.php' ) ) {
				return QODE_LMS_CPT_PATH . '/question/templates/archive-' . $this->base . '.php';
			}
		}
		
		return $archive;
	}
	
	/**
	 * Registers question single template if one does'nt exists in theme.
	 * Hooked to single_template filter
	 *
	 * @param $single string current template
	 *
	 * @return string string changed template
	 */
	public function registerSingleTemplate( $single ) {
		global $post;
		
		if ( ! empty( $post ) && $post->post_type == $this->base ) {
			if ( ! file_exists( get_template_directory() . '/single-question-item.php' ) ) {
				return QODE_LMS_CPT_PATH . '/question/templates/single-' . $this->base . '.php';
			}
		}
		
		return $single;
	}
	
	/**
	 * Registers custom post type with WordPress
	 */
	private function registerPostType() {
		$slug = $this->base;
		
		register_post_type( $this->base,
			array(
				'labels'       => array(
					'name'          => esc_html__( 'Qode Questions', 'qode-lms' ),
					'singular_name' => esc_html__( 'Qode Question', 'qode-lms' ),
					'add_item'      => esc_html__( 'New Question', 'qode-lms' ),
					'add_new_item'  => esc_html__( 'Add New Question', 'qode-lms' ),
					'edit_item'     => esc_html__( 'Edit Question', 'qode-lms' )
				),
				'public'       => false,
				'has_archive'  => true,
				'rewrite'      => array( 'slug' => $slug ),
				'show_in_menu' => 'qode_lms_menu',
				'show_ui'      => true,
				'supports'     => array(
					'author',
					'title',
					'editor',
					'thumbnail',
					'excerpt',
					'page-attributes',
					'comments'
				)
			)
		);
	}
}