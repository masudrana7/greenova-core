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

class Dual_Image extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ) {
		$this->rt_name = esc_html__( 'Dual Images', 'greenova-core' );
		$this->rt_base = 'rt-dual-images';
		parent::__construct( $data, $args );
	}

	protected function register_controls() {
		$this->start_controls_section(
			'rt_dual_image',
			[
				'label' => esc_html__( 'Dual Images Settings', 'greenova-core' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'back_image_title',
			[
				'label'     => __( 'Back Image', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'after',
				'classes'   => 'main-heading',
			]
		);

		$this->add_control(
			'image1',
			[
				'label'   => __( 'Choose Back Image', 'greenova-core' ),
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
			'overlay_image_title',
			[
				'label'     => __( 'Overlay Image', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'after',
				'classes'   => 'main-heading',
			]
		);


		$this->add_control(
			'image2',
			[
				'label'   => __( 'Choose Overlay Image', 'greenova-core' ),
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

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'image_border',
				'label'    => __( 'Image Border', 'greenova-core' ),
				'selector' => '{{WRAPPER}} .rt-image .rtin-back-image img',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'box_shadow',
				'label'    => __( 'Box Shadow', 'greenova-core' ),
				'selector' => '{{WRAPPER}} .rt-image .rtin-back-image img',
			]
		);


		$this->end_controls_section();

		// Images Settings
		//==============================================================
		$this->start_controls_section(
			'images_settings',
			[
				'label' => esc_html__( 'Images Settings', 'greenova-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);


		$this->add_control(
			'back_image_settings',
			[
				'label'   => __( '1. Back Image Settings', 'greenova-core' ),
				'type'    => \Elementor\Controls_Manager::HEADING,
				'classes' => 'main-heading',
			]
		);

		$this->add_responsive_control(
			'back_image_width',
			[
				'label'      => __( 'Max Width', 'greenova-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 200,
						'max'  => 1000,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-image .rtin-back-image > img' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'back_image_border_radius',
			[
				'label'      => __( 'Border Radius', 'greenova-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .rt-image .rtin-back-image > img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);


		//Overlay Image Settings
		$this->add_control(
			'overlay_image_settings',
			[
				'label'     => __( '2. Overlay Image Settings', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
				'classes'   => 'main-heading',
			]
		);

		$this->add_responsive_control(
			'overlay_image_width',
			[
				'label'      => __( 'Max Width', 'greenova-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 100,
						'max'  => 800,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-image .rtin-overlay-image img' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'overlay_image_x_position',
			[
				'label'      => __( 'Image Postion (X) from Left', 'greenova-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ '%' ],
				'range'      => [
					'%' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-image .rtin-overlay-image img' => 'left: {{SIZE}}%;',
				],
			]
		);

		$this->add_responsive_control(
			'overlay_image_y_position',
			[
				'label'      => __( 'Image Postion (Y) from Top', 'greenova-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ '%' ],
				'range'      => [
					'%' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-image .rtin-overlay-image img' => 'top: {{SIZE}}%;',
				],
			]
		);

		$this->add_control(
			'overlay_image_border_radius',
			[
				'label'      => __( 'Border Radius', 'greenova-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .rt-image .rtin-overlay-image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$data     = $this->get_settings();
		$template = 'view-1';

		$this->rt_template( $template, $data );
	}

}