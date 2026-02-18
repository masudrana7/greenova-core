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

class Progress_Bar extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ) {
		$this->rt_name = esc_html__( 'Progress Bar', 'greenova-core' );
		$this->rt_base = 'rt-progress-bar';
		parent::__construct( $data, $args );
	}

	protected function register_controls() {
		$this->start_controls_section(
			'rt_progress_bar_settings',
			[
				'label' => esc_html__( 'Progress Bar Settings', 'greenova-core' ),
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
				],

			]
		);


		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'title', [
				'label'   => __( 'Title', 'greenova-core' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => __( '2018 Solved Case', 'greenova-core' ),
			]
		);

		$repeater->add_control(
			'number', [
				'label'   => __( 'Number', 'greenova-core' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => __( '70', 'greenova-core' ),
			]
		);

		$repeater->add_control(
			'title_color',
			[
				'label' => __( 'Title Color', 'greenova-core' ),
				'type'  => \Elementor\Controls_Manager::COLOR,
			]
		);

		$repeater->add_control(
			'bar_color',
			[
				'label' => __( 'Bar Color', 'greenova-core' ),
				'type'  => \Elementor\Controls_Manager::COLOR,
			]
		);

		$this->add_control(
			'list',
			[
				'label'       => __( 'Progress List', 'greenova-core' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => [
					[
						'title'  => __( '2018 Solved Case', 'greenova-core' ),
						'number' => __( '60', 'greenova-core' ),
					],
					[
						'title'  => __( '2019 Solved Case', 'greenova-core' ),
						'number' => __( '70', 'greenova-core' ),
					],
					[
						'title'  => __( '2000 Solved Case', 'greenova-core' ),
						'number' => __( '80', 'greenova-core' ),
					],
					[
						'title'  => __( '2021 Solved Case', 'greenova-core' ),
						'number' => __( '90', 'greenova-core' ),
					],
				],
				'title_field' => '{{{ title }}}',
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
				'classes'   => 'main-heading',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'label'    => __( 'Title Typography', 'greenova-core' ),
				'name'     => 'title_typography',
				'selector' => '{{WRAPPER}} .rt-progress-bar .progress .lead',
			]
		);

		$this->add_control(
			'title_common_color ',
			[
				'label'     => __( 'Title Color', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .progress .lead' => 'color: {{VALUE}}; border-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'title_padding',
			[
				'label'      => __( 'Title Padding', 'greenova-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .rt-progress-bar .progress .lead' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'  => [
					'layout' => [ 'style1' ],
				],
			]
		);

		$this->add_control(
			'title_position',
			[
				'label'      => __( 'Title Position', 'greenova-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => - 50,
						'max'  => 100,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-progress-bar .progress .lead' => 'top: {{SIZE}}{{UNIT}};',
				],
			]
		);


		$this->add_control(
			'bar_settings',
			[
				'label'     => __( 'Bar Settings', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'after',
				'classes'   => 'main-heading',
			]
		);

		$this->add_control(
			'bar_foreground ',
			[
				'label'     => __( 'Bar Foreground Color', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .progress .progress-bar' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'bar_bg',
			[
				'label'     => __( 'Bar Background Color', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-progress-bar .progress' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'bar_height',
			[
				'label'      => __( 'Bar Height', 'greenova-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 10,
						'max'  => 50,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-progress-bar .progress' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'margin_bottom',
			[
				'label'      => __( 'Margin Bottom', 'greenova-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 40,
						'max'  => 100,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-progress-bar .progress' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'        => 'item_border',
				'label'       => __( 'Tooltips Border', 'greenova-core' ),
				'selector'    => '{{WRAPPER}} .rt-progress-bar .progress',
				'condition'   => [
					'layout' => [ 'style3' ],
				],
			]
		);

		$this->add_responsive_control(
			'item_border_radius',
			[
				'label'      => __( 'Border Radius', 'greenova-core' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .progress .progress-bar' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .rt-progress-bar .progress' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'  => [
					'layout' => [ 'style3' ],
				],
			]
		);

		$this->add_control(
			'tooltips_settings',
			[
				'label'     => __( 'Tooltips Settings', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'after',
				'classes'   => 'main-heading',
			]
		);

		$this->add_control(
			'tooltips_color',
			[
				'label'     => __( 'Tooltips Color', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-progress-bar .progress-bar > span'        => 'background: {{VALUE}}',
					'{{WRAPPER}} .rt-progress-bar .progress-bar > span:before' => 'border-top-color: {{VALUE}}',
				],
				'condition'  => [
					'layout' => [ 'style3' ],
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$data     = $this->get_settings();
		$template = 'view-1';
		if ( 'style2' == $data['layout']  || 'style3' == $data['layout']) {
			$template = 'view-2';
		}

		$this->rt_template( $template, $data );
	}

}