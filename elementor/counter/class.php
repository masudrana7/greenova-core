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

class Counter extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ) {
		$this->rt_name = esc_html__( 'Greenova Counter', 'greenova-core' );
		$this->rt_base = 'rt-counter';
		parent::__construct( $data, $args );
	}

	protected function register_controls() {
		$this->start_controls_section(
			'rt_counter',
			[
				'label' => esc_html__( 'Counter Settings', 'greenova-core' ),
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

		$this->add_control(
			'counter_number',
			[
				'label'       => esc_html__( 'Counter Number', 'greenova-core' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '5780',
				'label_block' => true,
			]
		);

		$this->add_control(
			'title',
			[
				'label'       => esc_html__( 'Title', 'greenova-core' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => 'Welcome To Greenova',
				'label_block' => true,
			]
		);


		$this->add_control(
			'counter_icon',
			[
				'label'     => __( 'Icon', 'greenova-core' ),
				'type'      => Controls_Manager::ICONS,
				'default'   => [
					'value'   => 'fa fa-bell',
					'library' => 'solid',
				],
				'condition' => [
					'layout' => [ 'style2', 'style3' ],
				],
			]
		);

		$this->add_control(
			'counter_speed',
			[
				'label'      => __( 'Counter Speed', 'greenova-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => '%',
				'range'      => [
					'%' => [
						'min'  => 1000,
						'max'  => 10000,
						'step' => 1000,
					],
				],
				'default'    => [
					'unit' => '%',
					'size' => 3000,
				],
			]
		);

		$this->add_control(
			'counter_step',
			[
				'label'      => __( 'Counter Step', 'greenova-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => '%',
				'range'      => [
					'%' => [
						'min'  => 1,
						'max'  => 100,
						'step' => 1,
					],
				],
				'default'    => [
					'unit' => '%',
					'size' => 10,
				],
			]
		);

		$this->add_responsive_control(
			'text_align',
			[
				'label'     => __( 'Alignment', 'greenova-core' ),
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
				'selectors' => [
					'{{WRAPPER}} .counter-alignment' => 'text-align: {{VALUE}}',
				],
				'default'   => 'left',
				'toggle'    => true,
				'condition' => [
					'layout' => [ 'style1', 'style2' ],
				],
			]
		);

		$this->end_controls_section();

		// Number Settings
		//==============================================================
		$this->start_controls_section(
			'number_settings',
			[
				'label' => esc_html__( 'Number Settings', 'greenova-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'number_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'greenova-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-counter' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'number_border_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Border Color', 'greenova-core' ),
				'selectors' => [
					'{{WRAPPER}} .title-bar35small::after' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'layout' => [ 'style3' ],
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'number_typography',
				'label'    => esc_html__( 'Typography', 'greenova-core' ),
				'selector' => '{{WRAPPER}} .rt-counter',
			]
		);

		$this->add_responsive_control(
			'number_margin',
			[
				'label'              => __( 'Number Margin', 'greenova-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'allowed_dimensions' => 'vertical',
				'selectors'          => [
					'{{WRAPPER}} .rt-counter' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->end_controls_section();

		// Title Settings
		//==============================================================
		$this->start_controls_section(
			'title_settings',
			[
				'label' => esc_html__( 'Title Settings', 'greenova-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'greenova-core' ),
				'selectors' => [
					'{{WRAPPER}} .rtin-title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typo',
				'label'    => esc_html__( 'Typography', 'greenova-core' ),
				'selector' => '{{WRAPPER}} .rtin-title',
			]
		);

		$this->end_controls_section();

		// Icon Settings
		//==============================================================
		$this->start_controls_section(
			'icon_settings',
			[
				'label' => esc_html__( 'Icon Settings', 'greenova-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'icon_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'greenova-core' ),
				'selectors' => [
					'{{WRAPPER}} .icon-wrapper i' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'icon_bg',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color Background', 'greenova-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-vc-counter-4 .awards-box a i' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'layout' => [ 'style3' ],
				],
			]
		);

		$this->add_control(
			'icon_border_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color Background', 'greenova-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-vc-counter-4 .awards-box a' => 'border-color: {{VALUE}}',
				],
				'condition' => [
					'layout' => [ 'style3' ],
				],
			]
		);

		$this->add_control(
			'icon_size',
			[
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Icon Font Size', 'greenova-core' ),
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 20,
						'max'  => 100,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .icon-wrapper i' => 'font-size: {{SIZE}}{{UNIT}};',
				],

			]
		);

		$this->add_control(
			'icon_width_height',
			[
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Icon Width & Height', 'greenova-core' ),
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 80,
						'max'  => 200,
						'step' => 5,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-vc-counter-4 .awards-box a i' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'layout' => [ 'style3' ],
				],
			]
		);

		$this->end_controls_section();
	}

	public function load_scripts() {
		wp_enqueue_script( 'rt-waypoints' );
		wp_enqueue_script( 'counterup' );
	}

	protected function render() {
		// $this->load_scripts();
		$data     = $this->get_settings();
		$template = 'view-1';

		if ( 'style2' == $data['layout'] ) {
			$template = 'view-2';
		} elseif ( 'style3' == $data['layout'] ) {
			$template = 'view-3';
		}

		$this->rt_template( $template, $data );
	}

}