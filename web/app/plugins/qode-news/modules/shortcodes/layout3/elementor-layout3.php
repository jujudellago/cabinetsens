<?php

use qodeNews\CPT\Shortcodes\Layout3 as LayoutFactory;

class QodeNewsLayout3 extends \Elementor\Widget_Base{
    public function get_name() {
        return 'bridge_layout3';
    }

    public function get_title() {
        return esc_html__( 'Layout 3', 'qode-news' );
    }

    public function get_icon() {
        return 'bridge-elementor-custom-icon bridge-elementor-layout3';
    }

    public function get_categories() {
        return [ 'qode-news' ];
    }

    private function getPostCategories(){
        $categories_array = array();
        $categories = get_categories();

        if( is_array( $categories ) && count( $categories ) > 0 ){
            foreach ( $categories as $category ){
                $categories_array[$category->slug] = $category->name;
            }
        }

        return $categories_array;
    }

    private function getPostAuthors(){
        $authors_array = array();
        $authors = get_users();

        if( is_array( $authors ) && count( $authors ) > 0 ){
            foreach ( $authors as $author ){
                $authors_array[$author->data->ID] = $author->data->user_nicename;
            }
        }

        return $authors_array;
    }

    private function getPostTags(){
        $tags_array = array();

        $tags = get_tags();

        if( is_array( $tags ) && count( $tags ) > 0 ){
            foreach ( $tags as $tag ){
                $tags_array[$tag->slug] = $tag->name;
            }
        }

        return $tags_array;
    }

    private function getAllPosts(){
        $posts_array = array();
        $args = array(
            'numberposts' => -1
        );
        $posts = get_posts($args);

        if( is_array( $posts ) && count( $posts ) > 0 ){
            foreach ( $posts as $post ){
                $posts_array[$post->ID] = $post->post_title;
            }
        }

        return $posts_array;
    }

    private function getPostReactions(){
        $reactions_array = array();

        $all_reactions = get_terms(array(
            'taxonomy' => 'news-reaction',
            'hide_empty' => false
        ));

        if( is_array( $all_reactions ) && count( $all_reactions ) > 0 ){
            foreach ( $all_reactions as $reaction ){
                $reactions_array[$reaction->slug] = $reaction->name;
            }
        }

        return $reactions_array;
    }

    protected function register_controls() {

        $this->start_controls_section(
            'general',
            [
                'label' => esc_html__( 'General', 'qode-news' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'extra_class_name',
            [
                'label' => esc_html__('Extra Class Name','qode-news'),
                'type' => \Elementor\Controls_Manager::TEXT
            ]
        );

        $this->add_control(
            'posts_per_page',
            [
                'label' => esc_html__('Number of Posts','qode-news'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '6'
            ]
        );

        $this->add_control(
            'column_number',
            [
                'label' => esc_html__('Number of Columns','qode-news'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '1' => esc_html__('One','qode-news'),
                    '2' => esc_html__('Two','qode-news'),
                    '3' => esc_html__('Three','qode-news'),
                    '4' => esc_html__('Four','qode-news'),
                ],
                'default' => '3'
            ]
        );

        $this->add_control(
            'space_between_items',
            [
                'label' => esc_html__('Space Between Items','qode-news'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'normal' => esc_html__('Medium','qode-news'),
                    'small' => esc_html__('Small','qode-news'),
                    'tiny' => esc_html__('Tiny','qode-news'),
                    'no' => esc_html__('None','qode-news'),
                ],
                'default' => 'normal'
            ]
        );

        $this->add_control(
            'category_name',
            [
                'label' => esc_html__('Category','qode-news'),
                'description' => esc_html__('Enter the categories of the posts you want to display (leave empty for showing all categories)','qode-news'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => $this->getPostCategories(),
                'default' => ''
            ]
        );

        $this->add_control(
            'author_id',
            [
                'label' => esc_html__('Author','qode-news'),
                'description' => esc_html__('Enter the authors of the posts you want to display (leave empty for showing all authors)','qode-news'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => $this->getPostAuthors(),
                'default' => ''
            ]
        );

        $this->add_control(
            'tag',
            [
                'label' => esc_html__('Tag','qode-news'),
                'description' => esc_html__('Enter the tags of the posts you want to display (leave empty for showing all tags)','qode-news'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => $this->getPostTags(),
                'default' => ''
            ]
        );

        $this->add_control(
            'post_in',
            [
                'label' => esc_html__('Include Posts','qode-news'),
                'description' => esc_html__('Enter the IDs or Titles of the posts you want to display','qode-news'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => $this->getAllPosts(),
                'default' => ''
            ]
        );

        $this->add_control(
            'post_not_in',
            [
                'label' => esc_html__('Exclude Posts','qode-news'),
                'description' => esc_html__('Enter the IDs or Titles of the posts you want to exclude','qode-news'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => $this->getAllPosts(),
                'default' => ''
            ]
        );

        $this->add_control(
            'sort',
            [
                'label' => esc_html__('Sort','qode-news'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '' => '',
                    'latest' => esc_html__('Latest','qode-news'),
                    'random' => esc_html__('Random','qode-news'),
                    'random_today' => esc_html__('Random Posts Today','qode-news'),
                    'random_seven_days' => esc_html__('Random in Last 7 Days','qode-news'),
                    'comments' => esc_html__('Most Commented','qode-news'),
                    'title' => esc_html__('Title','qode-news'),
                    'popular' => esc_html__('Popular','qode-news'),
                    'featured_first' => esc_html__('Featured Posts First','qode-news'),
                    'trending_first' => esc_html__('Trending Posts First','qode-news'),
                    'hot_first' => esc_html__('Hot Posts First','qode-news'),
                    'reactions' => esc_html__('By Reaction','qode-news'),
                ],
                'default' => ''
            ]
        );

        $this->add_control(
            'reaction',
            [
                'label' => esc_html__('Reaction','qode-news'),
                'description' => esc_html__('Choose the reaction which you would like to use for sorting your posts. The posts that have the greatest number of your chosen reaction will be displayed first.','qode-news'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'options' => $this->getPostReactions(),
                'default' => '',
                'condition' => [
                    'sort' => 'reactions'
                ]
            ]
        );

        $this->add_control(
            'order',
            [
                'label' => esc_html__('Order', 'qode-news'),
                'description' => esc_html__('Choose the reaction which you would like to use for sorting your posts. The posts that have the greatest number of your chosen reaction will be displayed first.','qode-news'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => bridge_qode_get_query_order_array(),
                'default' => '',
                'condition' => [
                    'sort' => 'title'
                ]
            ]
        );

        $this->add_control(
            'offset',
            [
                'label' => esc_html__('Offset', 'qode-news'),
                'type' => \Elementor\Controls_Manager::TEXT
            ]
        );

        $this->add_control(
            'show_filter',
            [
                'label' => esc_html__('Show Filter','qode-news'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => bridge_qode_get_yes_no_select_array(),
                'default' => ''
            ]
        );

        $this->add_control(
            'filter_by',
            [
                'label' => esc_html__('Filter By','qode-news'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'category' => esc_html__('Category','qode-news'),
                    'tag' => esc_html__('Tag','qode-news'),
                ],
                'default' => 'category',
                'condition' => [
                    'show_filter' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'layout_title',
            [
                'label' => esc_html__('Layout Title','qode-news'),
                'type' => \Elementor\Controls_Manager::TEXT
            ]
        );

        $this->add_control(
            'layout_title_tag',
            [
                'label' => esc_html__('Layout Title Tag','qode-news'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => bridge_qode_get_title_tag( true ),
                'default' => 'h3'
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'post_item',
            [
                'label' => esc_html__( 'Post Item', 'qode-news' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'title_tag',
            [
                'label' => esc_html__( 'Title Tag', 'qode-news' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => bridge_qode_get_title_tag( true ),
                'default' => 'h4'
            ]
        );

        $this->add_control(
            'image_size',
            [
                'label' => esc_html__( 'Image Size', 'qode-news' ),
                'description' => esc_html__( 'Choose image size', 'qode-news' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'thumbnail' => esc_html__('Thumbnail','qode-news'),
                    'medium' => esc_html__('Medium','qode-news'),
                    'large' => esc_html__('Large','qode-news'),
                    'portfolio-landscape' => esc_html__('Landscape','qode-news'),
                    'portfolio-portrait' => esc_html__('Portrait','qode-news'),
                    'portfolio-square' => esc_html__('Square','qode-news'),
                    'full' => esc_html__('Full','qode-news'),
                    'custom' => esc_html__('Custom','qode-news'),
                ],
                'default' => 'portfolio-landscape'
            ]
        );

        $this->add_control(
            'custom_image_width',
            [
                'label' => esc_html__( 'Custom Image Width', 'qode-news' ),
                'description' => esc_html__( 'Enter image width in px', 'qode-news' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'condition' => [
                    'image_size' => 'custom'
                ]
            ]
        );

        $this->add_control(
            'custom_image_height',
            [
                'label' => esc_html__( 'Custom Image Height', 'qode-news' ),
                'description' => esc_html__( 'Enter image height in px', 'qode-news' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'condition' => [
                    'image_size' => 'custom'
                ]
            ]
        );

        $this->add_control(
            'display_categories',
            [
                'label' => esc_html__('Display Categories','qode-news'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => bridge_qode_get_yes_no_select_array(),
                'default' => 'yes'
            ]
        );

        $this->add_control(
            'display_excerpt',
            [
                'label' => esc_html__('Display Excerpt','qode-news'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => bridge_qode_get_yes_no_select_array(),
                'default' => 'no'
            ]
        );

        $this->add_control(
            'excerpt_length',
            [
                'label' => esc_html__('Max. Excerpt Length','qode-news'),
                'description' => esc_html__('Enter max of words that can be shown for excerpt','qode-news'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'condition' => [
                    'display_excerpt' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'display_date',
            [
                'label' => esc_html__('Display Date','qode-news'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => bridge_qode_get_yes_no_select_array(),
                'default' => 'yes'
            ]
        );

        $this->add_control(
            'date_format',
            [
                'label' => esc_html__('Publication Date Format','qode-news'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '' => esc_html__('Default','qode-news'),
                    'difference' => esc_html__('Time from Publication','qode-news'),
                    'published' => esc_html__('Date of Publication','qode-news'),
                ],
                'default' => '',
                'condition' => [
                    'display_date' => array('', 'yes')
                ]
            ]
        );

        $this->add_control(
            'display_author',
            [
                'label' => esc_html__('Display Author','qode-news'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => bridge_qode_get_yes_no_select_array(),
                'default' => 'no'
            ]
        );

        $this->add_control(
            'display_share',
            [
                'label' => esc_html__('Display Share','qode-news'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => bridge_qode_get_yes_no_select_array(),
                'default' => 'no'
            ]
        );

        $this->add_control(
            'display_hot_trending_icons',
            [
                'label' => esc_html__('Display Hot/Trending Icons','qode-news'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => bridge_qode_get_yes_no_select_array(),
                'default' => 'no'
            ]
        );

        $this->add_control(
            'display_button',
            [
                'label' => esc_html__("Display 'Read More' Button",'qode-news'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => bridge_qode_get_yes_no_select_array(),
                'default' => 'no'
            ]
        );

        $this->add_control(
            'display_review',
            [
                'label' => esc_html__("Display Review",'qode-news'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => bridge_qode_get_yes_no_select_array(),
                'default' => 'no'
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'pagination',
            [
                'label' => esc_html__( 'Pagination', 'qode-news' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'display_pagination',
            [
                'label' => esc_html__('Display Pagination','qode-news'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => bridge_qode_get_yes_no_select_array(),
                'default' => 'no'
            ]
        );

        $this->add_control(
            'pagination_type',
            [
                'label' => esc_html__('Pagination Type','qode-news'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'standard' => esc_html__('Standard','qode-news'),
                    'load-more' => esc_html__('Load More','qode-news'),
                    'infinite-scroll' => esc_html__('Infinite Scroll','qode-news'),
                ],
                'default' => 'standard',
                'condition' => [
                    'display_pagination' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'pagination_numbers_amount',
            [
                'label' => esc_html__('Amount of navigation numbers','qode-news'),
                'description' => esc_html__('Enter a number that will limit pagination numbers amount','qode-news'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'condition' => [
                    'pagination_type' => array('','standard')
                ]
            ]
        );

        $this->end_controls_section();
    }

    protected function render(){
        $params = $this->get_settings_for_display();
        $params['only_videos'] = 'no';
        if( ! empty( $params['category_name'] ) && is_array( $params['category_name'] ) ) {
            $params['category_name'] = implode(', ', $params['category_name']);
        }
        if( ! empty( $params['author_id'] ) && is_array( $params['author_id'] ) ){
            $params['author_id'] = implode(', ', $params['author_id']);
        }
        if( ! empty( $params['post_in'] ) && is_array( $params['post_in'] ) ){
            $params['post_in'] = implode(', ', $params['post_in']);
        }
        if( ! empty( $params['post_not_in'] ) && is_array( $params['post_not_in'] ) ){
            $params['post_not_in'] = implode(', ', $params['post_not_in']);
        }

        $layout1Instance = new LayoutFactory\Layout3();
        echo $layout1Instance->renderHolders( $params );
    }

}

\Elementor\Plugin::instance()->widgets_manager->register( new QodeNewsLayout3() );