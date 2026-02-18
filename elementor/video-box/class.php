<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Greenova_Core;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Video_Box extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ) {
		$this->rt_name = esc_html__( 'Video Box', 'greenova-core' );
		$this->rt_base = 'rt-video-box';
		parent::__construct( $data, $args );
	}

	protected function register_controls() {
		$this->start_controls_section(
			'rt_video_box',
			[
				'label' => esc_html__( 'Video Box Settings', 'greenova-core' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'layout',
			[
				'label'   => esc_html__( 'Layout', 'greenova-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'style1',
				'options' => [
					'style1' => __( 'Full Screen', 'greenova-core' ),
					'style2' => __( 'Half Screen', 'greenova-core' ),
					'style3' => __( 'Style 3(Only Icon)', 'greenova-core' ),
				],

			]
		);


		$this->add_control(
			'title',
			[
				'label'       => esc_html__( 'Title', 'greenova-core' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'About', 'greenova-core' ),
				'label_block' => true,
				'condition' => [
					'layout!' => [ 'style3' ],
				],
			]
		);

		$this->add_control(
			'content',
			[
				'label'     => __( 'Content', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::WYSIWYG,
				'condition' => [
					'layout' => [ 'style1' ],
				],
				'default'   => __( 'Lorem ipsum text of the printing and typesetting industryorem <br>ever since industry standard dum an unknowramble.', 'greenova-core' ),
			]
		);

		$this->add_control(
			'video_url',
			[
				'label'       => esc_html__( 'Video URL', 'greenova-core' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => 'http://www.youtube.com/watch?v=1iIZeIy7TqM',
			]
		);


		$this->end_controls_section();

		// General Settings
		//==============================================================
		$this->start_controls_section(
			'general_settings',
			[
				'label' => esc_html__( 'General Settings', 'greenova-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name'     => 'background',
				'label'    => __( 'Video Background', 'greenova-core' ),
				'types'    => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .rt-video-wrapper .rtin-item',
			]
		);

		$this->add_control(
			'desc_spacing',
			[
				'label'              => __( 'Description Spacing', 'greenova-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px', 'em' ],
				'default'            => [
					'isLinked' => false,
				],
				'selectors'          => [
					'{{WRAPPER}} .rt-vc-video .rtin-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'layout' => [ 'style3' ],
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
				'condition' => [
					'layout!' => [ 'style3' ],
				],
			]
		);


		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'selector' => '{{WRAPPER}} .rt-video-wrapper .title',
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => __( 'Title Color', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-video-wrapper .title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();

		//Content Style
		//=============================================================================

		$this->start_controls_section(
			'content_style',
			[
				'label'     => __( 'Content Style', 'greenova-core' ),
				'tab'       => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'layout' => 'style1',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'content_typography',
				'selector' => '{{WRAPPER}} .rt-video-wrapper .rtin-content',
			]
		);

		$this->add_control(
			'content_color',
			[
				'label'     => __( 'Content Color', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-video-wrapper .rtin-content' => 'color: {{VALUE}}',
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
					'{{WRAPPER}} .rt-video-wrapper .rtin-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'allowed_dimensions' => 'vertical',
				'default'            => [ 'isLinked' => false ],
			]
		);

		$this->end_controls_section();

		//Video Button Style
		//=============================================================================

		$this->start_controls_section(
			'video_button',
			[
				'label' => __( 'Video Button Style', 'greenova-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'btn_icon',
			[
				'label'   => __( 'Choose Video Icons', 'greenova-core' ),
				'type'    => \Elementor\Controls_Manager::ICON,
				'include' => [
					'fas fa-play',
					'fas fa-play-circle',
					'far fa-play-circle',
					'fab fa-youtube',
					'fas fa-forward',
					'fas fa-caret-square-right'
				],
			]
		);

		$this->add_control(
			'btn_size',
			[
				'label'      => __( 'Button Size', 'greenova-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 20,
						'max'  => 100,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-vc-video .rt-video-popup' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'icon_width',
			[
				'label' => __( 'Icon Width', 'greenova-core' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 300,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rt-vc-video' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'layout' => [ 'style3' ],
				],
			]
		);

		$this->add_control(
			'icon_height',
			[
				'label' => __( 'Icon Height', 'greenova-core' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 300,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rt-vc-video' => 'height: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'layout' => [ 'style3' ],
				],
			]
		);

		$this->add_control(
			'icon_line_height',
			[
				'label' => __( 'Icon Line Height', 'greenova-core' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 300,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rt-vc-video' => 'line-height: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'layout' => [ 'style3' ],
				],
			]
		);

		$this->add_control(
			'icon_border_radius',
			[
				'label' => __( 'Border Radius', 'greenova-core' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .rt-vc-video' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'layout' => [ 'style3' ],
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'icon_box_shadow',
				'label' => __( 'Icon Box Shadow', 'greenova-core' ),
				'selector' => '{{WRAPPER}} .rt-vc-video',
				'condition' => [
					'layout' => [ 'style3' ],
				],
			]
		);

		//Button style Tabs
		$this->start_controls_tabs(
			'video_btn_style_tabs'
		);

		$this->start_controls_tab(
			'video_btn_style_normal_tab',
			[
				'label' => __( 'Normal', 'greenova-core' ),
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label'     => __( 'Icon Color', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-video-wrapper .rt-video-popup' => 'color: {{VALUE}}',
				],
			]
		);


		$this->end_controls_tab();

		$this->start_controls_tab(
			'video_btn_style_hover_tab',
			[
				'label' => __( 'Hover', 'greenova-core' ),
			]
		);

		$this->add_control(
			'icon_hover_color',
			[
				'label'     => __( 'Icon Color', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-video-wrapper .rt-video-popup:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	public function load_scripts() {
		wp_enqueue_style( 'magnific-popup' );
		wp_enqueue_script( 'magnific-popup' );
	}

	protected function render() {
		$data = $this->get_settings();
		$this->load_scripts();
		$template = 'view-1';
		if ( 'style3' == $data['layout'] ) {
			$template = 'view-3';
		}
		if ( 'style2' == $data['layout'] ) {
			$template = 'view-2';
		}
		$this->rt_template( $template, $data );
	}

}