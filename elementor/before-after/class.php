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

class Before_After extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ) {
		$this->rt_name = esc_html__( 'Before After', 'greenova-core' );
		$this->rt_base = 'rt-before-after';
		parent::__construct( $data, $args );
	}

	protected function register_controls() {
		$this->start_controls_section(
			'rt_before_after',
			[
				'label' => esc_html__( 'Before After Settings', 'greenova-core' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'before_image',
			[
				'label'     => __( 'Before Image', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'after',
				'classes'   => 'main-heading',
			]
		);

		$this->add_control(
			'before_text',
			[
				'label'       => __( 'Before Text', 'greenova-core' ),
				'placeholder' => __( 'Enter Before Text', 'greenova-core' ),
				'default'     => 'Before',
			]
		);

		$this->add_control(
			'image1',
			[
				'label'   => __( 'Choose Before Image', 'greenova-core' ),
				'type'    => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Image_Size::get_type(),
			[
				'name'    => 'thumbnail1',
				'include' => [],
				'default' => 'full',
			]
		);

		$this->add_control(
			'after_image',
			[
				'label'     => __( 'After Image', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'after',
				'classes'   => 'main-heading',
			]
		);

		$this->add_control(
			'after_text',
			[
				'label'       => __( 'After Text', 'greenova-core' ),
				'placeholder' => __( 'Enter After Text', 'greenova-core' ),
				'default'     => 'After',
			]
		);


		$this->add_control(
			'image2',
			[
				'label'   => __( 'Choose After Image', 'greenova-core' ),
				'type'    => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Image_Size::get_type(),
			[
				'name'    => 'thumbnail2',
				// phpcs:ignore WordPressVIPMinimum.Performance.WPQueryParams.PostNotIn_exclude
				'exclude' => [ 'custom' ],
				'include' => [],
				'default' => 'full',
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

		$this->start_controls_tabs(
			'style_tabs'
		);

		$this->start_controls_tab(
			'style_normal_tab',
			[
				'label' => __( 'Normal', 'greenova-core' ),
			]
		);

		$this->add_control(
			'text_color',
			[
				'label'     => __( 'Title Color', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-before-after-wrapper .rtin-ba-text .label-text' => 'color: {{VALUE}}',
				],
				'separator' => 'after',
			]
		);


		$this->add_control(
			'button_color',
			[
				'label'     => __( 'Button Color', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-before-after-wrapper .rtin-ba-text .center-button' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'button_bg',
			[
				'label'     => __( 'Button Background Color', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-before-after-wrapper .rtin-ba-text .center-button' => 'background-color: {{VALUE}}',
				],
				'separator' => 'after',
			]
		);

		$this->add_control(
			'overlay1',
			[
				'label' => __( 'Overlay Color', 'greenova-core' ),
				'type'  => \Elementor\Controls_Manager::HEADING,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name'     => 'overlay_color',
				'label'    => __( 'Overlay Color', 'greenova-core' ),
				'types'    => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .rt-before-after-wrapper .rtin-ba-text .overlay',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'style_hover_tab',
			[
				'label' => __( 'Hover', 'greenova-core' ),
			]
		);

		$this->add_control(
			'text_color_hover',
			[
				'label'     => __( 'Title Color on Hover', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-before-after-wrapper .rtin-ba-text:hover .label-text' => 'color: {{VALUE}}',
				],
				'separator' => 'after',
			]
		);

		$this->add_control(
			'button_color_hover',
			[
				'label'     => __( 'Button Color on Hover', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-before-after-wrapper:hover .rtin-ba-text .center-button' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'button_bg_hover',
			[
				'label'     => __( 'Button Background on Hover', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-before-after-wrapper:hover .rtin-ba-text .center-button' => 'background-color: {{VALUE}}',
				],
				'separator' => 'after',
			]
		);

		$this->add_control(
			'overlay2',
			[
				'label' => __( 'Overlay Color on Hover', 'greenova-core' ),
				'type'  => \Elementor\Controls_Manager::HEADING,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name'     => 'overlay_color_hover',
				'label'    => __( 'Overlay Color on Hover', 'greenova-core' ),
				'types'    => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .rt-before-after-wrapper .rtin-ba-text:hover .overlay',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	protected function render() {
		$data     = $this->get_settings();
		$template = 'view-1';

		$this->rt_template( $template, $data );
	}

}