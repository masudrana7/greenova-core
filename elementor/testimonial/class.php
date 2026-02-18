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

class Testimonial_Carousel extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ) {
		$this->rt_name = esc_html__( 'Testimonial Carousel', 'greenova-core' );
		$this->rt_base = 'rt-testimonial-carousel';
		parent::__construct( $data, $args );
	}

	protected function register_controls() {
		// widget title
		$this->start_controls_section(
			'rt_testimonial',
			[
				'label' => esc_html__( 'Testimonial Carousel', 'greenova-core' ),
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
				'default'     => '4',
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
				'options'     => $this->rt_get_categories( 'greenova_testimonial_category' ),
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

		// Thumbnail style
		$this->start_controls_section(
			'thumbnail_style',
			[
				'label' => __( 'Thumbnail Style', 'greenova-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'thumbnail_visibility',
			[
				'label'   => __( 'Thumbnail Visibility', 'greenova-core' ),
				'type'    => Controls_Manager::CHOOSE,
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


		$this->add_responsive_control(
			'thumbnail_spacing',
			[
				'label'      => __( 'Bottom Spacing', 'greenova-core' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .rt-owl-carousel-wrapper .img-wrapper' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'thumbnail_visibility' => 'visible',
					'layout'               => [ 'style1', 'style4', 'style5' ],
				],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
			]
		);

		$this->add_responsive_control(
			'thumbnail_border_radius',
			[
				'label'      => __( 'Border Radius', 'greenova-core' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ '%', 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .rt-owl-carousel-wrapper .img-wrapper img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
				'condition'  => [
					'thumbnail_visibility' => 'visible',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'      => 'img_border',
				'label'     => __( 'Border', 'greenova-core' ),
				'selector'  => '{{WRAPPER}} .rt-owl-carousel-wrapper .img-wrapper img',
				'condition' => [
					'thumbnail_visibility' => 'visible',
					'layout'               => [ 'style1', 'style4', 'style5' ],
				],
			]
		);

		$this->end_controls_section();


		// Title Settings
		//=====================================================================
		$this->start_controls_section(
			'title_style',
			[
				'label' => __( 'Title / Name Style', 'greenova-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => __( 'Title / Name Color', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-owl-carousel-wrapper h3' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'selector' => '{{WRAPPER}} .rt-owl-carousel-wrapper h3',
			]
		);

		$this->add_responsive_control(
			'title_spacing',
			[
				'label'      => __( 'Bottom Spacing', 'greenova-core' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .rt-owl-carousel-wrapper h3' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
			]
		);


		$this->end_controls_section();

		// Designation Settings
		// ================================================================
		$this->start_controls_section(
			'designation_style',
			[
				'label' => __( 'Designation Style', 'greenova-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'designation_visibility',
			[
				'label'   => __( 'Designation Visibility', 'greenova-core' ),
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
			'designation_color',
			[
				'label'     => __( 'Color', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-owl-carousel-wrapper .item-designation' => 'color: {{VALUE}}',
				],
				'condition' => [
					'designation_visibility' => 'visible',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'      => 'designation_typography',
				'selector'  => '{{WRAPPER}} .rt-owl-carousel-wrapper .item-designation',
				'condition' => [
					'designation_visibility' => 'visible',
				],
			]
		);

		$this->end_controls_section();

		// Content Settings
		//=====================================================================

		$this->start_controls_section(
			'content_style',
			[
				'label' => __( 'Content Style', 'greenova-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);


		$this->add_control(
			'content_limit',
			[
				'label'   => __( 'Content Limit', 'greenova-core' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => '50',
			]
		);

		$this->add_responsive_control(
			'content_spacing',
			[
				'label'      => __( 'Bottom Spacing', 'greenova-core' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 200,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-owl-carousel-wrapper .content-wrapper' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'layout' => [ 'style1', 'style4' ],
				],
			]
		);

		$this->add_control(
			'content_color',
			[
				'label'     => __( 'Content Color', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-owl-carousel-wrapper .content-wrapper' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'content_bg_color',
			[
				'label'     => __( 'Content Background', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-owl-carousel-wrapper .content-wrapper'        => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .rt-owl-carousel-wrapper .content-wrapper::after' => 'border-top-color: {{VALUE}}',
				],
				'condition' => [
					'layout' => [ 'style3' ],
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'content_typography',
				'label'    => esc_html__( 'Typography', 'greenova-core' ),
				'selector' => '{{WRAPPER}} .rt-owl-carousel-wrapper .content-wrapper',
			]
		);

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
			'testi_content_bg_color',
			[
				'label'     => esc_html__( 'Content Background Color', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rtin-single-testimonial' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'layout' => [ 'style6' ],
				],
			]
		);
		$this->add_responsive_control(
			'testi_content_padding',
			[
				'label'      => esc_html__( 'Content Padding', 'greenova-core' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .rtin-single-testimonial' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'layout' => [ 'style6' ],
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'testi_content_border',
				'label'    => esc_html__( 'Content Border', 'greenova-core' ),
				'selector' => '{{WRAPPER}} .rtin-single-testimonial',
				'condition' => [
					'layout' => [ 'style6' ],
				],
			]
		);
		$this->add_responsive_control(
			'testi_content_border_radius',
			[
				'label'      => esc_html__( 'Content Border Radius', 'greenova-core' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .rtin-single-testimonial' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'layout' => [ 'style6' ],
				],
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
					'{{WRAPPER}} .rt-owl-carousel-wrapper .owl-theme .owl-nav > div' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'nav_bg_color',
			[
				'label'     => __( 'Background Color', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-owl-carousel-wrapper .owl-theme .owl-nav > div' => 'background-color: {{VALUE}} !important',
				],
				'condition' => [
					'layout' => [ 'style1', 'style3', 'style4' ],
				],
			]
		);

		$this->add_control(
			'nav_border_color',
			[
				'label'     => __( 'Border Color', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-owl-carousel-wrapper .owl-theme .owl-nav > div' => 'border-color: {{VALUE}}',
				],
				'condition' => [
					'layout' => [ 'style1', 'style3', 'style4' ],
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
					'{{WRAPPER}} .rt-owl-carousel-wrapper .owl-theme .owl-nav > div:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'nav_bg_hover',
			[
				'label'     => __( 'Hover Background', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-owl-carousel-wrapper .owl-theme .owl-nav > div:hover' => 'background-color: {{VALUE}} !important',
				],
				'condition' => [
					'layout' => [ 'style1', 'style3', 'style4' ],
				],
			]
		);

		$this->add_control(
			'nav_border_hover',
			[
				'label'     => __( 'Border Color Hover', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-owl-carousel-wrapper .owl-theme .owl-nav > div:hover' => 'border-color: {{VALUE}}',
				],
				'condition' => [
					'layout' => [ 'style1', 'style3', 'style4' ],
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
			'carousel_gap',
			[
				'label'       => __( 'Carousel Gap', 'greenova-core' ),
				'type'        => Controls_Manager::SLIDER,
				'size_units'  => [ 'px' ],
				'range'       => [
					'px' => [
						'min'  => 0,
						'max'  => 50,
						'step' => 1,
					],
				],
				'default'     => [
					'unit' => 'px',
					'size' => 0,
				],
				'description' => __( 'Carousel gap will work if you choose multiple column', 'greenova-core' ),
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
			'carousel_column_desktop',
			[
				'label'   => __( 'Number of columns for Desktop', 'greenova-core' ),
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

		$this->add_control(
			'carousel_column_tab',
			[
				'label'   => __( 'Number of columns for Tab', 'greenova-core' ),
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
	}

	protected function render() {
		$data = $this->get_settings();

		$data['owl_data'] = [
			'nav'                => $data['carousel_nav'] ? true : false,
			'navText'            => [ "<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>" ],
			'dots'               => $data['carousel_dots'] ? true : false,
			'autoplay'           => $data['carousel_autoplay'] ? true : false,
			'autoplayTimeout'    => $data['carousel_interval']['size'],
			'autoplaySpeed'      => $data['carousel_autoplay_speed']['size'],
			'autoplayHoverPause' => $data['slider_stop_on_hover'] ? true : false,
			'loop'               => $data['carousel_loop'] ? true : false,
			'margin'             => intval( $data['carousel_gap']['size'] ),
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
		}elseif ( 'style6' == $data['layout'] ) {
			$template = 'view-6';
		}

		$this->rt_template( $template, $data );

	}

}