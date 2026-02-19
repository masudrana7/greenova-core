<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Greenova_Core;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use \WP_Query;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Post_Slider extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ) {
		$this->rt_name = esc_html__( 'Post Carousel', 'greenova-core' );
		$this->rt_base = 'rt-post-carousel';

		parent::__construct( $data, $args );
	}

	protected function register_controls() {
		// widget title
		$this->start_controls_section(
			'rt_post_carousel',
			[
				'label' => esc_html__( 'Post Carousel', 'greenova-core' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'layout',
			[
				'label'   => esc_html__( 'Style', 'greenova-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'style1',
				'options' => [
					'style1' => __( 'Style 1', 'greenova-core' ),
					'style2' => __( 'Style 2', 'greenova-core' ),
					'style3' => __( 'Style 3', 'greenova-core' ),
					'style4' => __( 'Style 4', 'greenova-core' ),
					'style5' => __( 'Style 5', 'greenova-core' ),
					'style6' => __( 'Style 6', 'greenova-core' ),
				],

			]
		);


		$this->add_control(
			'post_limit',
			[
				'label'       => __( 'Post Limit', 'greenova-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __( 'Enter Post Limit', 'greenova-core' ),
				'description' => __( 'Enter number of post to show.', 'greenova-core' ),
				'default'     => '12',
			]
		);

		$this->add_control(
			'post_source',
			[
				'label'       => __( 'Post Source', 'greenova-core' ),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'options'     => [
					'most_recent' => __( 'From all recent post', 'greenova-core' ),
					'by_category' => __( 'By Category', 'greenova-core' ),
					'by_tags'     => __( 'By Tags', 'greenova-core' ),
					'by_id'       => __( 'By Post ID', 'greenova-core' ),
				],
				'default'     => [ 'most_recent' ],
				'description' => __( 'Select posts source that you like to show.', 'greenova-core' ),
			]
		);

		$this->add_control(
			'categories',
			[
				'label'       => __( 'Choose Categories', 'greenova-core' ),
				'type'        => \Elementor\Controls_Manager::SELECT2,
				'multiple'    => true,
				'options'     => $this->rt_category_list(),
				'label_block' => true,
				'condition'   => [
					'post_source' => 'by_category',
				],
				'description' => __( 'Select post category\'s.', 'greenova-core' ),
			]
		);

		$this->add_control(
			'tags',
			[
				'label'       => __( 'Choose Tags', 'greenova-core' ),
				'type'        => \Elementor\Controls_Manager::SELECT2,
				'multiple'    => true,
				'options'     => $this->rt_tag_list(),
				'label_block' => true,
				'condition'   => [
					'post_source' => 'by_tags',
				],
				'description' => __( 'Select post tag\'s.', 'greenova-core' ),
			]
		);

		$this->add_control(
			'post_id',
			[
				'label'       => __( 'Enter post IDs', 'greenova-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'description' => __( 'Enter the post IDs separated by comma', 'greenova-core' ),
				'label_block' => 'true',
				'condition'   => [
					'post_source' => 'by_id',
				],
			]
		);

		$this->add_control(
			'offset',
			[
				'label'       => __( 'Post offset', 'greenova-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __( 'Enter Post offset', 'greenova-core' ),
				'description' => __( 'Number of post to displace or pass over. The offset parameter is ignored when post limit => -1 (show all posts) is used.', 'greenova-core' ),
			]
		);

		$this->add_control(
			'exclude',
			[
				'label'       => __( 'Exclude posts', 'greenova-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'label_block' => 'true',
				'description' => __( 'Enter the post IDs separated by comma for exclude', 'greenova-core' ),
			]
		);

		$this->add_control(
			'orderby',
			[
				'label'   => __( 'Order by', 'greenova-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'date'           => __( 'Date', 'greenova-core' ),
					'ID'             => __( 'Order by post ID', 'greenova-core' ),
					'author'         => __( 'Author', 'greenova-core' ),
					'title'          => __( 'Title', 'greenova-core' ),
					'modified'       => __( 'Last modified date', 'greenova-core' ),
					'parent'         => __( 'Post parent ID', 'greenova-core' ),
					'comment_count'  => __( 'Number of comments', 'greenova-core' ),
					'menu_order'     => __( 'Menu order', 'greenova-core' ),
					// phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_value
					'meta_value'     => __( 'Meta value', 'greenova-core' ),
					'meta_value_num' => __( 'Meta value number', 'greenova-core' ),
					'rand'           => __( 'Random order', 'greenova-core' ),
				],
			]
		);

		$this->add_control(
			'order',
			[
				'label'   => __( 'Sort order', 'greenova-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'ASC'  => __( 'ASC', 'greenova-core' ),
					'DESC' => __( 'DESC', 'greenova-core' ),
				],
			]
		);

		$this->end_controls_section();

		// Section Title style
		//========================================================
		$this->start_controls_section(
			'section_title_style',
			[
				'label' => __( 'Section Title Style', 'greenova-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'show_section_title',
			[
				'label'        => __( 'Section Title Visibility', 'greenova-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'greenova-core' ),
				'label_off'    => __( 'Hide', 'greenova-core' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'section_title_text',
			[
				'label'       => __( 'Section Title', 'greenova-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => __( 'Our Latest News', 'greenova-core' ),
				'placeholder' => __( 'Type section title here', 'greenova-core' ),
				'label_block' => true,
				'condition'   => [
					'show_section_title' => 'yes',
				],
			]
		);

		$this->add_control(
			'section_subtitle_text',
			[
				'label'       => __( 'Section Subtitle', 'greenova-core' ),
				'type'        => \Elementor\Controls_Manager::TEXTAREA,
				'placeholder' => __( 'Type section sub-title here', 'greenova-core' ),
				'label_block' => true,
				'condition'   => [
					'show_section_title' => 'yes',
				],
			]
		);


		$this->start_controls_tabs(
			'section_title_tabs', [
				'condition' => [
					'show_section_title' => 'yes',
				],
			]
		);

		$this->start_controls_tab(
			'section_title_tab',
			[
				'label' => __( 'Title Settings', 'greenova-core' ),
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'section_title_typography',
				'label'    => __( 'Typography', 'greenova-core' ),
				'selector' => '{{WRAPPER}} .post-section-title-wrapper h2',
			]
		);

		$this->add_control(
			'section_title_color',
			[
				'label'     => __( 'Title Color', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .post-section-title-wrapper h2' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'section_border_color',
			[
				'label'     => __( 'Title border bottom color', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .post-section-title-wrapper .section-title h2:after' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'section_subtitle_tab',
			[
				'label' => __( 'Sub Title Settings', 'greenova-core' ),
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'section_subtitle_typography',
				'label'    => __( 'Typography', 'greenova-core' ),
				'selector' => '{{WRAPPER}} .post-section-title-wrapper p',
			]
		);

		$this->add_control(
			'section_subtitle_color',
			[
				'label'     => __( 'Sub Title Color', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .post-section-title-wrapper p' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();


		// Thumbnail style
		//========================================================
		$this->start_controls_section(
			'thumbnail_style',
			[
				'label' => __( 'Thumbnail Style', 'greenova-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'project_thumbnail_size',
			[
				'label'   => esc_html__( 'Image Size', 'greenova-core' ),
				'type'    => Controls_Manager::SELECT,
				'options' => $this->rt_get_all_image_sizes(),
			]
		);

		$this->add_control(
			'thumb_border_bottom_color',
			[
				'label'     => __( 'Border Bottom Color', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .blog-box .blog-img-holder:after' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'layout' => [ 'style4' ],
				],
			]
		);


		$this->end_controls_section();


		// Title Settings
		//=====================================================================
		$this->start_controls_section(
			'title_style',
			[
				'label' => __( 'Title Style', 'greenova-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);


		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'selector' => '{{WRAPPER}} .rt-owl-carousel-wrapper .owl-item .entry-title',
			]
		);

		$this->add_control(
			'title_spacing',
			[
				'label'              => __( 'Title Spacing', 'greenova-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'selectors'          => [
					'{{WRAPPER}} .rt-owl-carousel-wrapper .owl-item .entry-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'allowed_dimensions' => 'vertical',
			]
		);


		$this->start_controls_tabs(
			'title_style_tabs'
		);

		$this->start_controls_tab(
			'title_normal_tab',
			[
				'label' => __( 'Normal', 'greenova-core' ),
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => __( 'Title Color', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-owl-carousel-wrapper .owl-item .entry-title a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'title_hover_tab',
			[
				'label' => __( 'Hover', 'greenova-core' ),
			]
		);

		$this->add_control(
			'title_hover_color',
			[
				'label'     => __( 'Title Hover Color', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-owl-carousel-wrapper .owl-item .entry-title a:hover' => 'color: {{VALUE}} !important',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'title_box_hover_tab',
			[
				'label' => __( 'Box Hover', 'greenova-core' ),
			]
		);

		$this->add_control(
			'title_box_hover_color',
			[
				'label'     => __( 'Title Color on Box Hover', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-owl-carousel-wrapper .owl-item:hover .entry-title a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();


		// Content Settings
		//=====================================================================

		$this->start_controls_section(
			'content_style',
			[
				'label' => __( 'Excerpt Style', 'greenova-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'content_visibility',
			[
				'label'   => __( 'Excerpt Visibility', 'greenova-core' ),
				'type'    => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'visible' => [
						'title' => __( 'Visible', 'greenova-core' ),
						'icon'  => 'fa fa-eye',
					],
					'hidden'  => [
						'title' => __( 'Hidden', 'greenova-core' ),
						'icon'  => 'fa fa-eye-slash',
					],
				],
				'toggle'  => false,
				'default' => 'visible',
			]
		);


		$this->add_control(
			'content_limit',
			[
				'label'     => __( 'Excerpt Limit', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'default'   => '15',
				'condition' => [
					'content_visibility' => 'visible',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'      => 'content_typography',
				'selector'  => '{{WRAPPER}} .rt-owl-carousel-wrapper .rt-post-excerpt',
				'condition' => [
					'content_visibility' => 'visible',
				],
			]
		);

		$this->add_control(
			'content_spacing',
			[
				'label'              => __( 'Excerpt Spacing', 'greenova-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'selectors'          => [
					'{{WRAPPER}} .rt-owl-carousel-wrapper .rt-post-excerpt' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'allowed_dimensions' => 'vertical',
			]
		);

		$this->start_controls_tabs(
			'content_style_tabs', [
				'condition' => [
					'content_visibility' => 'visible',
				],
			]
		);

		$this->start_controls_tab(
			'content_normal_tab',
			[
				'label' => __( 'Normal', 'greenova-core' ),
			]
		);


		$this->add_control(
			'content_color',
			[
				'label'     => __( 'Content Color', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-owl-carousel-wrapper .rt-post-excerpt' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'content_box_hover_tab',
			[
				'label' => __( 'Box Hover', 'greenova-core' ),
			]
		);

		$this->add_control(
			'content_box_hover_color',
			[
				'label'     => __( 'Color on Box Hover', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-owl-carousel-wrapper .owl-item:hover .rt-post-excerpt' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		// Meta Information Settings
		//=====================================================================

		$this->start_controls_section(
			'meta_info_style',
			[
				'label' => __( 'Meta Info Style', 'greenova-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'meta_info_colo',
			[
				'label'     => __( 'Meta Color', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-owl-carousel-wrapper .owl-item .post-meta'   => 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-owl-carousel-wrapper .owl-item .post-meta a' => 'color: {{VALUE}}',
				],
				'condition' => [
					'layout' => [ 'style1', 'style2', 'style3', 'style4', 'style5' ],
				],
			]
		);

		$this->add_control(
			'meta_icon_colo',
			[
				'label'     => __( 'Meta Icon Color', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-owl-carousel-wrapper .owl-item .post-meta i' => 'color: {{VALUE}}',
				],
				'condition' => [
					'layout' => [ 'style1', 'style2', 'style3', 'style4' ],
				],
			]
		);

		$this->add_control(
			'date_in_thumb_heading',
			[
				'label'     => __( 'Date (In Thumb) Settings:', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'after',
				'classes'   => 'main-heading',
				'condition' => [
					'layout' => [ 'style1', 'style2', 'style4', 'style6' ],
				],
			]
		);

		$this->add_control(
			'date_color',
			[
				'label'     => __( 'Date Color', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-owl-carousel-wrapper .owl-item .date-wrapper'      => 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-owl-carousel-wrapper .owl-item .date-wrapper span' => 'color: {{VALUE}}',
				],
				'condition' => [
					'layout' => [ 'style1', 'style2', 'style4', 'style6' ],
				],
			]
		);


		$this->add_control(
			'date_bg_color',
			[
				'label'     => __( 'Date Background', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-owl-carousel-wrapper .owl-item .date-wrapper' => 'background-color: {{VALUE}} !important',
				],
				'condition' => [
					'layout' => [ 'style1', 'style2', 'style4', 'style6' ],
				],
			]
		);

		$this->add_control(
			'meta_visibility',
			[
				'label'     => __( 'Meta Visibility', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'after',
				'classes'   => 'main-heading',
			]
		);

		$this->add_control(
			'date_visibility',
			[
				'label'        => __( 'Date Visibility', 'greenova-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'greenova-core' ),
				'label_off'    => __( 'Hide', 'greenova-core' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'author_visibility',
			[
				'label'        => __( 'Author Visibility', 'greenova-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'greenova-core' ),
				'label_off'    => __( 'Hide', 'greenova-core' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => [
					'layout' => [ 'style2', 'style3', 'style4' ],
				],
			]
		);

		$this->add_control(
			'comment_visibility',
			[
				'label'        => __( 'Comments Visibility', 'greenova-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'greenova-core' ),
				'label_off'    => __( 'Hide', 'greenova-core' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => [
					'layout' => [ 'style1', 'style2', 'style3', 'style4' ],
				],
			]
		);

		$this->end_controls_section();


		//Read More Style
		//=============================================================================

		$this->start_controls_section(
			'readmore_style',
			[
				'label' => __( 'Read More Style', 'greenova-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'readmore_visibility',
			[
				'label'   => __( 'Read More Visibility', 'greenova-core' ),
				'type'    => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'visible' => [
						'title' => __( 'Visible', 'greenova-core' ),
						'icon'  => 'fa fa-eye',
					],
					'hidden'  => [
						'title' => __( 'Hidden', 'greenova-core' ),
						'icon'  => 'fa fa-eye-slash',
					],
				],
				'toggle'  => false,
				'default' => 'visible',
			]
		);

		$this->add_control(
			'readmore_text',
			[
				'label'       => __( 'Button Text', 'greenova-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => __( 'Read More', 'greenova-core' ),
				'placeholder' => __( 'Type your title here', 'greenova-core' ),
				'condition'   => [
					'readmore_visibility' => [ 'visible' ],
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'      => 'readmore_typography',
				'selector'  => '{{WRAPPER}} .readmore-wrapper .rt-read-more-btton',
				'condition' => [
					'readmore_visibility' => [ 'visible' ],
				],
			]
		);

		//Button style Tabs
		$this->start_controls_tabs(
			'readmore_style_tabs', [
				'condition' => [
					'readmore_visibility' => [ 'visible' ],
				],
			]
		);

		$this->start_controls_tab(
			'readmore_style_normal_tab',
			[
				'label' => __( 'Normal', 'greenova-core' ),
			]
		);

		$this->add_control(
			'readmore_color',
			[
				'label'     => __( 'Font Color', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .readmore-wrapper .rt-read-more-btton'   => 'color: {{VALUE}} !important',
					'{{WRAPPER}} .readmore-wrapper .rt-read-more-btton i' => 'color: {{VALUE}} !important',
				],
			]
		);

		$this->add_control(
			'readmore_bg',
			[
				'label'     => __( 'Background Color', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .readmore-wrapper .rt-read-more-btton' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'readmore_border',
			[
				'label'     => __( 'Border Color', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .readmore-wrapper .rt-read-more-btton' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'readmore_style_hover_tab',
			[
				'label' => __( 'Hover', 'greenova-core' ),
			]
		);

		$this->add_control(
			'readmore_color_hover',
			[
				'label'     => __( 'Font Color hover', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .readmore-wrapper .rt-read-more-btton:hover'   => 'color: {{VALUE}} !important',
					'{{WRAPPER}} .readmore-wrapper .rt-read-more-btton:hover i' => 'color: {{VALUE}} !important',
				],
			]
		);

		$this->add_control(
			'readmore_bg_hover',
			[
				'label'     => __( 'Background Color hover', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .readmore-wrapper .rt-read-more-btton:hover' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'readmore_border_hover',
			[
				'label'     => __( 'Border Color Hover', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .readmore-wrapper .rt-read-more-btton:hover' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		// Carousel Settings
		//===============================================================

		$this->start_controls_section(
			'carousel_style',
			[
				'label' => __( 'Carousel Style', 'greenova-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'carousel_nav',
			[
				'label'        => __( 'Carousel Nav', 'greenova-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'greenova-core' ),
				'label_off'    => __( 'Hide', 'greenova-core' ),
				'return_value' => 'show',
				'default'      => 'show',
			]
		);

		$this->add_control(
			'carousel-popover-toggle',
			[
				'label'        => __( 'Nav Style', 'greenova-core' ),
				'type'         => \Elementor\Controls_Manager::POPOVER_TOGGLE,
				'label_off'    => __( 'Default', 'greenova-core' ),
				'label_on'     => __( 'Custom', 'greenova-core' ),
				'return_value' => 'yes',
				'condition'    => [
					'carousel_nav' => 'show',
				],
			]
		);


		$this->start_popover();

		$this->add_control(
			'nav_icon_postion',
			[
				'label'      => __( 'Nav Position Left/Right', 'greenova-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 52,
						'max'  => 100,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .owl-carousel .owl-nav .owl-prev' => 'left: -{{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .owl-carousel .owl-nav .owl-next' => 'right: -{{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->start_controls_tabs(
			'nav_style_tabs'
		);

		$this->start_controls_tab(
			'nav_style_normal_tab',
			[
				'label' => __( 'Normal', 'greenova-core' ),
			]
		);

		$this->add_control(
			'nav_color',
			[
				'label'     => __( 'Color', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-owl-carousel-wrapper .owl-nav > div' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'nav_bg_color',
			[
				'label'     => __( 'Background Color', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-owl-carousel-wrapper .owl-nav > div' => 'background-color: {{VALUE}} !important',
				],
			]
		);

		$this->add_control(
			'nav_border_color',
			[
				'label'     => __( 'Border Color', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-owl-carousel-wrapper .owl-nav > div' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'nav_style_hover_tab',
			[
				'label' => __( 'Hover', 'greenova-core' ),
			]
		);

		$this->add_control(
			'nav_hover_color',
			[
				'label'     => __( 'Hover Color', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-owl-carousel-wrapper .owl-nav > div:hover' => 'color: {{VALUE}} !important',
				],
			]
		);

		$this->add_control(
			'nav_bg_hover',
			[
				'label'     => __( 'Hover Background', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-owl-carousel-wrapper .owl-nav > div:hover' => 'background-color: {{VALUE}} !important',
				],
			]
		);

		$this->add_control(
			'nav_border_hover',
			[
				'label'     => __( 'Border Color Hover', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-owl-carousel-wrapper .owl-nav > div:hover' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_popover();

		$this->add_control(
			'carousel_dots',
			[
				'label'        => __( 'Carousel Dots', 'greenova-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'greenova-core' ),
				'label_off'    => __( 'Hide', 'greenova-core' ),
				'return_value' => 'show',
				'default'      => 'show',
			]
		);

		$this->add_control(
			'carousel-dot-popover-toggle',
			[
				'label'        => __( 'Dots Style', 'greenova-core' ),
				'type'         => \Elementor\Controls_Manager::POPOVER_TOGGLE,
				'label_off'    => __( 'Default', 'greenova-core' ),
				'label_on'     => __( 'Custom', 'greenova-core' ),
				'return_value' => 'yes',
				'condition'    => [
					'carousel_dots' => 'show',
				],
			]
		);
		$this->start_popover();

		$this->add_control(
			'dots_color',
			[
				'label'     => __( 'Color', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-owl-carousel-wrapper.slider-dot-enabled .owl-carousel .owl-dot span' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'dots_hover_color',
			[
				'label'     => __( 'Hover/Active Color', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-owl-carousel-wrapper.slider-dot-enabled .owl-carousel .owl-dot span:hover'  => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .rt-owl-carousel-wrapper.slider-dot-enabled .owl-carousel .owl-dot.active span' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'dots_radius',
			[
				'label'      => __( 'Border Radius', 'greenova-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-owl-carousel-wrapper.slider-dot-enabled .owl-carousel .owl-dot span' => 'border-radius: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'dots_dimension',
			[
				'label'     => __( 'Dots Dimension', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::IMAGE_DIMENSIONS,
				'default'   => [
					'width'  => '',
					'height' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .rt-owl-carousel-wrapper.slider-dot-enabled .owl-carousel .owl-dot span' => 'width: {{width}}; height: {{height}}',
				],
			]
		);

		$this->end_popover();

		$this->add_control(
			'carousel_autoplay',
			[
				'label'        => __( 'Carousel Autoplay', 'greenova-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'greenova-core' ),
				'label_off'    => __( 'No', 'greenova-core' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'slider_stop_on_hover',
			[
				'label'        => __( 'Stop on hover', 'greenova-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'greenova-core' ),
				'label_off'    => __( 'No', 'greenova-core' ),
				'return_value' => true,
				'default'      => true,
				'condition'    => [
					'carousel_autoplay' => 'yes',
				],
			]
		);

		$this->add_control(
			'carousel_interval',
			[
				'label'      => __( 'Autoplay Interval', 'greenova-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 1000,
						'max'  => 10000,
						'step' => 1000,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 3000,
				],
				'condition'  => [
					'carousel_autoplay' => 'yes',
				],
			]
		);

		$this->add_control(
			'carousel_autoplay_speed',
			[
				'label'      => __( 'Autoplay Slide Speed', 'greenova-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 100,
						'max'  => 1000,
						'step' => 100,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 200,
				],
				'condition'  => [
					'carousel_autoplay' => 'yes',
				],
			]
		);

		$this->add_control(
			'carousel_loop',
			[
				'label'        => __( 'Carousel Loop', 'greenova-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'True', 'greenova-core' ),
				'label_off'    => __( 'False', 'greenova-core' ),
				'return_value' => true,
				'default'      => true,
			]
		);

		$this->add_control(
			'item_gap',
			[
				'label'      => __( 'Item Gap', 'greenova-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 10,
						'max'  => 100,
						'step' => 1,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 15,
				],
			]
		);

		$this->add_control(
			'carousel_column_desktop',
			[
				'label'   => __( 'Number of columns for Desktop', 'greenova-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => '3',
				'options' => [
					'1' => __( '1 Column', 'greenova-core' ),
					'2' => __( '2 Columns', 'greenova-core' ),
					'3' => __( '3 Columns', 'greenova-core' ),
					'4' => __( '4 Columns', 'greenova-core' ),
				],
			]
		);

		$this->add_control(
			'carousel_column_tab',
			[
				'label'   => __( 'Number of columns for Tab', 'greenova-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => '2',
				'options' => [
					'1' => __( '1 Column', 'greenova-core' ),
					'2' => __( '2 Columns', 'greenova-core' ),
					'3' => __( '3 Columns', 'greenova-core' ),
					'4' => __( '4 Columns', 'greenova-core' ),
				],
			]
		);

		$this->add_control(
			'carousel_column_mobile',
			[
				'label'   => __( 'Number of columns for Mobile', 'greenova-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => '1',
				'options' => [
					'1' => __( '1 Column', 'greenova-core' ),
					'2' => __( '2 Columns', 'greenova-core' ),
					'3' => __( '3 Columns', 'greenova-core' ),
					'4' => __( '4 Columns', 'greenova-core' ),
				],
			]
		);


		$this->end_controls_section();

		// Box Settings
		$this->start_controls_section(
			'box_style',
			[
				'label' => __( 'Box Style', 'greenova-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'box_padding',
			[
				'label'      => __( 'Box Padding', 'greenova-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .rt-owl-carousel-wrapper .post-inner-paddnig' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs(
			'box_style_tabs'
		);

		$this->start_controls_tab(
			'box_style_normal_tab',
			[
				'label' => __( 'Normal', 'greenova-core' ),
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name'     => 'box_background',
				'label'    => __( 'Box Background', 'greenova-core' ),
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .rt-owl-carousel-wrapper .post-wrap-bg',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'box_style_hover_tab',
			[
				'label' => __( 'Hover', 'greenova-core' ),
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name'     => 'box_background_hover',
				'label'    => __( 'Box Background Hover', 'greenova-core' ),
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .rt-owl-carousel-wrapper .post-wrap-bg:hover',
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	protected function render() {
		$data             = $this->get_settings();
		$data['owl_data'] = [
			'nav'                => $data['carousel_nav'] ? true : false,
			'navText'            => [ "<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>" ],
			'dots'               => $data['carousel_dots'] ? true : false,
			'autoplay'           => $data['carousel_autoplay'] ? true : false,
			'autoplayTimeout'    => $data['carousel_interval']['size'],
			'autoplaySpeed'      => $data['carousel_autoplay_speed']['size'],
			'autoplayHoverPause' => $data['slider_stop_on_hover'] ? true : false,
			'loop'               => $data['carousel_loop'] ? true : false,
			'margin'             => isset( $data['item_gap']['size'] ) ? intval( $data['item_gap']['size'] ) : 20,
			'responsive'         => [
				'0'    => [ 'items' => $data['carousel_column_mobile'] ],
				'768'  => [ 'items' => $data['carousel_column_tab'] ],
				'992'  => [ 'items' => $data['carousel_column_tab'] ],
				'1200' => [ 'items' => $data['carousel_column_desktop'] ],
			],
		];

		$template = 'view-1';

		if ( 'style2' == $data['layout'] ) {
			$template = 'view-2';
		} elseif ( 'style3' == $data['layout'] ) {
			$template = 'view-3';
		} elseif ( 'style4' == $data['layout'] ) {
			$template = 'view-4';
		} elseif ( 'style5' == $data['layout'] ) {
			$template = 'view-5';
		} elseif ( 'style6' == $data['layout'] ) {
			$template = 'view-6';
		}

		$this->rt_template( $template, $data );
	}

}