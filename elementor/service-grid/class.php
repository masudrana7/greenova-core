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

class Service_Grid extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ) {
		$this->rt_name = esc_html__( 'Service Grid', 'greenova-core' );
		$this->rt_base = 'rt-service-grid';

		parent::__construct( $data, $args );
	}

	protected function register_controls() {
		// widget title
		$this->start_controls_section(
			'rt_service_grid',
			[
				'label' => esc_html__( 'Service Grid', 'greenova-core' ),
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
			'gridcolumn-popover-toggle',
			[
				'label'        => __( 'Grid Column', 'greenova-core' ),
				'type'         => \Elementor\Controls_Manager::POPOVER_TOGGLE,
				'label_off'    => __( 'Default', 'greenova-core' ),
				'label_on'     => __( 'Custom', 'greenova-core' ),
				'return_value' => 'yes',
			]
		);

		$this->start_popover();

		$this->add_control(
			'gird_column_desktop',
			[
				'label'   => esc_html__( 'Grid Column for Desktop', 'greenova-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '4',
				'options' => [
					'3'  => __( '4 Columns', 'greenova-core' ),
					'4'  => __( '3 Columns', 'greenova-core' ),
					'6'  => __( '2 Columns', 'greenova-core' ),
					'12' => __( '1 Columns', 'greenova-core' ),
				],

			]
		);

		$this->add_control(
			'gird_column_tab',
			[
				'label'   => esc_html__( 'Grid Column for Tab', 'greenova-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '6',
				'options' => [
					'3'  => __( '4 Columns', 'greenova-core' ),
					'4'  => __( '3 Columns', 'greenova-core' ),
					'6'  => __( '2 Columns', 'greenova-core' ),
					'12' => __( '1 Columns', 'greenova-core' ),
				],

			]
		);

		$this->add_control(
			'gird_column_mobile',
			[
				'label'   => esc_html__( 'Grid Column for Mobile', 'greenova-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '12',
				'options' => [
					'3'  => __( '4 Columns', 'greenova-core' ),
					'4'  => __( '3 Columns', 'greenova-core' ),
					'6'  => __( '2 Columns', 'greenova-core' ),
					'12' => __( '1 Columns', 'greenova-core' ),
				],

			]
		);

		$this->end_popover();

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
					'by_id'       => __( 'By Post ID', 'greenova-core' ),
				],
				'default'     => [ 'most_recent' ],
				'description' => __( 'Select posts source that you like to show.', 'greenova-core' ),
			]
		);

		$this->add_control(
			'taxonomies',
			[
				'label'       => __( 'Choose Categories', 'greenova-core' ),
				'type'        => \Elementor\Controls_Manager::SELECT2,
				'multiple'    => true,
				'options'     => $this->rt_get_categories( 'greenova_service_category' ),
				'label_block' => true,
				'condition'   => [
					'post_source' => 'by_category',
				],
				'description' => __( 'Select post category\'s.', 'greenova-core' ),
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

		$this->add_control(
			'show_link',
			[
				'label'        => __( 'Show Link', 'greenova-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'greenova-core' ),
				'label_off'    => __( 'Hide', 'greenova-core' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'show_pagination',
			[
				'label'        => __( 'Show Pagination', 'greenova-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'greenova-core' ),
				'label_off'    => __( 'Hide', 'greenova-core' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'show_view_all_btn',
			[
				'label'        => __( 'Show View All Button', 'greenova-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'greenova-core' ),
				'label_off'    => __( 'Hide', 'greenova-core' ),
				'return_value' => 'yes',
				'default'      => false,
			]
		);

		$this->end_controls_section();

		// Thumbnail style
		$this->start_controls_section(
			'thumbnail_style',
			[
				'label' => __( 'Thumbnail Style', 'greenova-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'service_thumbnail_size',
			[
				'label'   => esc_html__( 'Img Size', 'greenova-core' ),
				'type'    => Controls_Manager::SELECT,
				'options' => $this->rt_get_all_image_sizes(),
			]
		);

		$this->add_control(
			'thumb_overlay_color',
			[
				'label'     => __( 'Thumb Overlay Color', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'after',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name'     => 'background',
				'label'    => __( 'Thumb overlay color', 'greenova-core' ),
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .rt-service-grid-1 .service-box .service-img-holder:before, {{WRAPPER}} .rt-service-grid-2 .service-box .service-img-holder:after, {{WRAPPER}} .rt-service-grid-3 .rtin-single-post .rtin-item-image:after, {{WRAPPER}} .rt-service-grid-4 .rtin-single-post .rtin-item-image:after, {{WRAPPER}} .rt-service-grid-5 .service-content-holder',
			]
		);

		$this->end_controls_section();

		// Icon Settings
		//=====================================================================

		$this->start_controls_section(
			'icon_style',
			[
				'label' => __( 'Icon Style', 'greenova-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'layout' => [ 'style6' ],
				],
			]
		);

		$this->add_control(
			'icon_bg_color',
			[
				'label'     => __( 'Icon Bg Color', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rtin-item-image .service-image'   => 'background: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'icon_border_radius',
			[
				'label'      => __( 'Border Radius', 'greenova-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .rtin-item-image .service-image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'selector' => '{{WRAPPER}} .rt-service-wrapper .service-box .title-1',
			]
		);

		$this->add_control(
			'title_spacing',
			[
				'label'              => __( 'Title Spacing', 'greenova-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'selectors'          => [
					'{{WRAPPER}} .rt-service-wrapper .service-box .title-1' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .rt-service-wrapper .service-box .title-1'   => 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-service-wrapper .service-box .title-1 a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'title_two_color',
			[
				'label'     => __( 'Title-2 Color', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-service-wrapper .service-box .title-1.title-2'   => 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-service-wrapper .service-box .title-1.title-2 a' => 'color: {{VALUE}}',
				],
				'condition' => [
					'layout' => [ 'style2' ],
				],
			]
		);

		$this->add_control(
			'title_border_color',
			[
				'label'     => __( 'Title Border Color', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-service-wrapper .service-box .title-1::after' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'layout' => [ 'style1', 'style2' ],
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
				'label'     => __( 'Title Color (on hover)', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-service-wrapper .service-box .title-1:hover'   => 'color: {{VALUE}} !important',
					'{{WRAPPER}} .rt-service-wrapper .service-box .title-1 a:hover' => 'color: {{VALUE}} !important',
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
				'label'     => __( 'Title Color (on box hover)', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-service-wrapper .service-box:hover .title-1'   => 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-service-wrapper .service-box:hover .title-1 a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();


		$this->end_controls_section();

		//Excerpt Style
		//=============================================================================

		$this->start_controls_section(
			'content_style',
			[
				'label' => __( 'Excerpt Style', 'greenova-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'excerpt_visibility',
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
					'excerpt_visibility' => 'visible',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'      => 'content_typography',
				'selector'  => '{{WRAPPER}} .rt-service-wrapper .service-box .service-excerpt',
				'condition' => [
					'excerpt_visibility' => 'visible',
				],
			]
		);

		$this->add_control(
			'content_color',
			[
				'label'     => __( 'Excerpt Color', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-service-wrapper .service-box .service-excerpt' => 'color: {{VALUE}}',
				],
				'condition' => [
					'excerpt_visibility' => 'visible',
				],
			]
		);

		$this->add_control(
			'content_margin',
			[
				'label'              => __( 'Margin Top / Bottom', 'greenova-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px', 'em' ],
				'selectors'          => [
					'{{WRAPPER}} .rt-service-wrapper .service-box .service-excerpt' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'allowed_dimensions' => 'vertical',
				'condition'          => [
					'excerpt_visibility' => 'visible',
				],
			]
		);

		$this->end_controls_section();

		//Read More Style
		//=============================================================================

		$this->start_controls_section(
			'readmore_style',
			[
				'label'     => __( 'Read More Style', 'greenova-core' ),
				'tab'       => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'layout' => [ 'style1', 'style3', 'style4',  'style6' ],
				],
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
				'selector'  => '{{WRAPPER}} .rt-service-wrapper .service-link-btn',
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
					'{{WRAPPER}} .rt-service-wrapper .service-link-btn' => 'color: {{VALUE}} !important',
				],
			]
		);

		$this->add_control(
			'readmore_bg',
			[
				'label'     => __( 'Background Color', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-service-wrapper .service-link-btn' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'readmore_border',
			[
				'label'     => __( 'Border Color', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-service-wrapper .service-link-btn' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'readmore_icon_color',
			[
				'label'     => __( 'Icon Color', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-service-wrapper .service-link-btn path' => 'fill: {{VALUE}}',
				],
				'condition' => [
					'layout' => [ 'style6' ],
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
					'{{WRAPPER}} .rt-service-wrapper .service-link-btn:hover' => 'color: {{VALUE}} !important',
				],
			]
		);

		$this->add_control(
			'readmore_bg_hover',
			[
				'label'     => __( 'Background Color hover', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-service-wrapper .service-link-btn:hover' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'readmore_border_hover',
			[
				'label'     => __( 'Border Color Hover', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-service-wrapper .service-link-btn:hover' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'readmore_icon_hover_color',
			[
				'label'     => __( 'Icon Color', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-service-wrapper .service-link-btn:hover path' => 'fill: {{VALUE}}',
				],
				'condition' => [
					'layout' => [ 'style6' ],
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'read_more_radius',
			[
				'label'      => __( 'Button Radius', 'greenova-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .rt-service-wrapper .service-link-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'  => [
					'readmore_visibility' => [ 'visible' ],
				],
			]
		);

		$this->end_controls_section();

		// Pagination Settings
		//=============================================
		$this->start_controls_section(
			'pagination_style',
			[
				'label'     => __( 'Pagination Style', 'greenova-core' ),
				'tab'       => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_pagination' => 'yes',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'pagination_typography',
				'selector' => '{{WRAPPER}} .pagination-area ul li a',
			]
		);

		$this->add_control(
			'pagination_border_radius',
			[
				'label'      => __( 'Border Radius', 'greenova-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .pagination-area ul li a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);


		$this->start_controls_tabs(
			'pagination_style_tabs'
		);

		$this->start_controls_tab(
			'pagination_style_normal_tab',
			[
				'label' => __( 'Normal', 'greenova-core' ),
			]
		);

		$this->add_control(
			'pagination_color',
			[
				'label'     => __( 'Font Color', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pagination-area ul li a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'pagination_bg',
			[
				'label'     => __( 'Background Color', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pagination-area ul li a' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'pagination_style_hover_tab',
			[
				'label' => __( 'Hover', 'greenova-core' ),
			]
		);

		$this->add_control(
			'pagination_color_hover',
			[
				'label'     => __( 'Font Color hover/active', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pagination-area ul li a:hover'  => 'color: {{VALUE}}',
					'{{WRAPPER}} .pagination-area ul li.active a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'pagination_bg_hover',
			[
				'label'     => __( 'Background Color hover/active', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pagination-area ul li a:hover'  => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .pagination-area ul li.active a' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		// View All Button Settings
		//=============================================
		$this->start_controls_section(
			'view_all_btn_style',
			[
				'label'     => __( 'View All Button Style', 'greenova-core' ),
				'tab'       => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_view_all_btn' => 'yes',
				],
			]
		);

		$this->add_control(
			'view_all_btn_text',
			[
				'label'       => __( 'Button Text', 'greenova-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => __( 'View All', 'greenova-core' ),
				'placeholder' => __( 'Type your title here', 'greenova-core' ),
			]
		);

		$this->add_control(
			'view_all_btn_url',
			[
				'label'         => __( 'Button Link', 'greenova-core' ),
				'type'          => \Elementor\Controls_Manager::URL,
				'placeholder'   => __( 'https://your-link.com', 'greenova-core' ),
				'show_external' => true,
				'default'       => [
					'url'         => '#',
					'is_external' => true,
					'nofollow'    => true,
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'view_all_btn_typography',
				'selector' => '{{WRAPPER}} .rt-grid-fill-btn a',
			]
		);

		$this->add_control(
			'view_all_btn_border_radius',
			[
				'label'      => __( 'Border Radius', 'greenova-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .rt-grid-fill-btn a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);


		$this->start_controls_tabs(
			'view_all_btn_style_tabs'
		);

		$this->start_controls_tab(
			'view_all_btn_style_normal_tab',
			[
				'label' => __( 'Normal', 'greenova-core' ),
			]
		);

		$this->add_control(
			'view_all_btn_color',
			[
				'label'     => __( 'Font Color', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-grid-fill-btn a' => 'color: {{VALUE}} !important',
				],
			]
		);

		$this->add_control(
			'view_all_btn_bg',
			[
				'label'     => __( 'Background Color', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-grid-fill-btn a' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'view_all_btn_border',
			[
				'label'     => __( 'Border Color', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-grid-fill-btn a' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'view_all_btn_style_hover_tab',
			[
				'label' => __( 'Hover', 'greenova-core' ),
			]
		);

		$this->add_control(
			'view_all_btn_color_hover',
			[
				'label'     => __( 'Font Color hover', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-grid-fill-btn a:hover' => 'color: {{VALUE}} !important',
				],
			]
		);

		$this->add_control(
			'view_all_btn_bg_hover',
			[
				'label'     => __( 'Background Color hover', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-grid-fill-btn a:hover' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'view_all_btn_border_hover',
			[
				'label'     => __( 'Border Color hover', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-grid-fill-btn a:hover' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();


		// Box Settings
		//=============================================
		$this->start_controls_section(
			'box_style',
			[
				'label' => __( 'Box Style', 'greenova-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'box_text_align',
			[
				'label'   => __( 'Alignment', 'greenova-core' ),
				'type'    => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left-align'   => [
						'title' => __( 'Left', 'greenova-core' ),
						'icon'  => 'fa fa-align-left',
					],
					'center-align' => [
						'title' => __( 'Center', 'greenova-core' ),
						'icon'  => 'fa fa-align-center',
					],
					'right-align'  => [
						'title' => __( 'Right', 'greenova-core' ),
						'icon'  => 'fa fa-align-right',
					],
				],
				'default' => 'center',
				'toggle'  => true,
			]
		);

		$this->add_control(
			'box_border_padding',
			[
				'label'      => __( 'Padding', 'greenova-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .rt-service-wrapper .box-radius' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'box_border_margin',
			[
				'label'      => __( 'Margin', 'greenova-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .service-box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'box_border_radius',
			[
				'label'      => __( 'Border Radius', 'greenova-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .rt-service-wrapper .box-radius' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$data = $this->get_settings();

		$template = 'view-1';

		if ( 'style2' == $data['layout'] ) {
			$template = 'view-2';
		} elseif ( 'style3' == $data['layout'] ) {
			$template = 'view-3';
		} elseif ( 'style4' == $data['layout'] ) {
			$template = 'view-4';
		} elseif ( 'style5' == $data['layout'] ) {
			$template = 'view-5';
		}elseif ( 'style6' == $data['layout'] ) {
			$template = 'view-6';
		}

		$this->rt_template( $template, $data );
	}

}