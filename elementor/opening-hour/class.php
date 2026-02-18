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

class Opening_Hour extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ) {
		$this->rt_name = esc_html__( 'Opening Hour', 'greenova-core' );
		$this->rt_base = 'rt-opening-hour';
		parent::__construct( $data, $args );
	}

	protected function register_controls() {
		$this->start_controls_section(
			'rt_opening_hour',
			[
				'label' => esc_html__( 'Opening Hour Settings', 'greenova-core' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'title',
			[
				'label'       => esc_html__( 'Title', 'greenova-core' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'About', 'greenova-core' ),
				'label_block' => true,
			]
		);


		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'weekdays', [
				'label'       => __( 'Weekdays', 'greenova-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => __( 'Saturday', 'greenova-core' ),
				'description' => __( 'Weekdays like "Saturday , Sunday"', 'greenova-core' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'openhour', [
				'label'       => __( 'Opening Hour', 'greenova-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => __( '10.00AM - 8.00PM', 'greenova-core' ),
				'description' => __( 'Opening Hour like "10.00AM - 8.00PM"', 'greenova-core' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'opening_hour_list',
			[
				'label'       => __( 'Opening Hour List', 'greenova-core' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => [
					[
						'weekdays'     => __( 'Sunday', 'greenova-core' ),
						'opening_hour' => __( '10.00AM - 8.00PM', 'greenova-core' ),
					],
					[
						'weekdays'     => __( 'Monday', 'greenova-core' ),
						'opening_hour' => __( '10.00AM - 8.00PM', 'greenova-core' ),
					],
					[
						'weekdays'     => __( 'Tuesday', 'greenova-core' ),
						'opening_hour' => __( '10.00AM - 8.00PM', 'greenova-core' ),
					],
					[
						'weekdays'     => __( 'Wednesday', 'greenova-core' ),
						'opening_hour' => __( '10.00AM - 8.00PM', 'greenova-core' ),
					],
					[
						'weekdays'     => __( 'Thursday', 'greenova-core' ),
						'opening_hour' => __( '10.00AM - 8.00PM', 'greenova-core' ),
					],
					[
						'weekdays'     => __( 'Friday', 'greenova-core' ),
						'opening_hour' => __( '10.00AM - 8.00PM', 'greenova-core' ),
					],
				],
				'title_field' => '{{{ weekdays }}}',
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

		$this->add_control(
			'title_settings',
			[
				'label'     => __( 'Title Settings', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'after',
				'classes'   => 'main-title',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'selector' => '{{WRAPPER}} .rt-open-hour-wrapper h3',
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => __( 'Title Color', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-open-hour-wrapper h3' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'title_align',
			[
				'label'     => __( 'Title Alignment', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::CHOOSE,
				'options'   => [
					'left'   => [
						'title' => __( 'Left', 'greenova-core' ),
						'icon'  => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'greenova-core' ),
						'icon'  => 'fa fa-align-center',
					],
					'right'  => [
						'title' => __( 'Right', 'greenova-core' ),
						'icon'  => 'fa fa-align-right',
					],
				],
				'default'   => 'left',
				'toggle'    => true,
				'selectors' => [
					'{{WRAPPER}} .rt-open-hour-wrapper h3' => 'text-align: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'title_margin_bottom',
			[
				'label'      => __( 'Margin Bottom', 'greenova-core' ),
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
					'{{WRAPPER}} .rt-open-hour-wrapper h3' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'content_settings',
			[
				'label'     => __( 'Content Settings', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'after',
				'classes'   => 'main-title',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'content_typography',
				'selector' => '{{WRAPPER}} .rt-open-hour-wrapper ul li',
			]
		);

		$this->add_control(
			'content_color',
			[
				'label'     => __( 'Content Color', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-open-hour-wrapper ul li' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'time_color',
			[
				'label'     => __( 'Time Color', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-open-hour-wrapper ul li span' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'border_color',
			[
				'label'     => __( 'Border Color', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-open-hour-wrapper ul li' => 'border-bottom-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'list_spacing',
			[
				'label'              => __( 'List Spacing', 'greenova-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'allowed_dimensions' => 'vertical',
				'selectors'          => [
					'{{WRAPPER}} .rt-open-hour-wrapper ul li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);


		$this->end_controls_section();

		// Box Settings
		//==============================================================
		$this->start_controls_section(
			'box_settings',
			[
				'label' => esc_html__( 'Box Settings', 'greenova-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'box_padding',
			[
				'label'      => __( 'Content Box Padding', 'greenova-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .rt-open-hour-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'box_background',
			[
				'label'     => __( 'Box Background', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-open-hour-wrapper' => 'background-color: {{VALUE}}',
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