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

class History_Box extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ) {
		$this->rt_name = esc_html__( 'History Box', 'greenova-core' );
		$this->rt_base = 'rt-history-box';
		parent::__construct( $data, $args );
	}

	protected function register_controls() {
		$this->start_controls_section(
			'rt_history_box_settings',
			[
				'label' => esc_html__( 'History Box Settings', 'greenova-core' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);


		$this->add_control(
			'title', [
				'label'   => __( 'Title', 'greenova-core' ),
				'type'    => \Elementor\Controls_Manager::TEXTAREA,
				'rows'    => 2,
				'default' => __( 'Our <span>Successful</span> History', 'greenova-core' ),
			]
		);

		$this->add_control(
			'history_text', [
				'label'   => __( 'History Text', 'greenova-core' ),
				'type'    => \Elementor\Controls_Manager::TEXTAREA,
				'rows'    => 4,
				'default' => __( "Gimply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's type and scrambled it to make.",
					'greenova-core' ),
			]
		);


		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'point_title', [
				'label'       => __( 'Point Title', 'greenova-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => __( 'We are Expert', 'greenova-core' ),
			]
		);

		$repeater->add_control(
			'point_text', [
				'label'   => __( 'Point Text', 'greenova-core' ),
				'type'    => \Elementor\Controls_Manager::TEXTAREA,
				'rows'    => 4,
				'default' => __( "Fmply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's stand when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five.stand when an unknown printer took a galley.",
					'greenova-core' ),
			]
		);

		$this->add_control(
			'history_list_title',
			[
				'label'     => __( 'History List', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
				'classes'   => 'main-heading',
			]
		);

		$this->add_control(
			'list',
			[
				'label'       => __( 'Add List', 'greenova-core' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => [
					[
						'point_title' => __( 'We are Expert', 'greenova-core' ),
						'point_text'  => __( "Fmply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's stand when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five.stand when an unknown printer took a galley.",
							'greenova-core' ),
					],
					[
						'point_title' => __( 'We are Awesome', 'greenova-core' ),
						'point_text'  => __( "Fmply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's stand when an unknown printer took a galley of type and scrambled it to make a type specimen book.",
							'greenova-core' ),
					],
					[
						'point_title' => __( 'We are Best', 'greenova-core' ),
						'point_text'  => __( "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled",
							'greenova-core' ),
					],
				],
				'title_field' => '{{{ point_title }}}',
			]
		);


		$this->end_controls_section();

		// Section Title Settings
		//==============================================================
		$this->start_controls_section(
			'title_settings',
			[
				'label' => esc_html__( 'Section Title Settings', 'greenova-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'label'    => __( 'Title Typography', 'greenova-core' ),
				'name'     => 'title_typography',
				'selector' => '{{WRAPPER}} .rt-history-box-wrapper .main-title',
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => __( 'Title Color', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-history-box-wrapper .main-title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'title_color2',
			[
				'label'     => __( 'Title Color 2', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-history-box-wrapper .main-title span' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'title_margin',
			[
				'label'      => __( 'Margin Bottom', 'greenova-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-history-box-wrapper .main-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'title_border_settings',
			[
				'label'     => __( 'Title Border Settings', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'title_border_color',
			[
				'label'     => __( 'Title Border Color', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-history-box-wrapper .main-title::after' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'border_dimension',
			[
				'label'     => __( 'Border Dimension', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::IMAGE_DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .rt-history-box-wrapper .main-title::after' => 'width: {{WIDTH}}; height: {{HEIGHT}}',
				],
				'default'   => [
					'width'  => '50px',
					'height' => '3px',
				],
			]
		);

		$this->add_control(
			'history_text_settings',
			[
				'label'     => __( 'History Text Settings', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
				'classes'   => 'main-heading',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'label'    => __( 'History Text Typography', 'greenova-core' ),
				'name'     => 'history_text_typography',
				'selector' => '{{WRAPPER}} .rt-history-box-wrapper .history-text',
			]
		);

		$this->add_control(
			'history_text_color',
			[
				'label'     => __( 'History Text Color', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-history-box-wrapper .history-text' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();


		// History List Settings
		//==============================================================
		$this->start_controls_section(
			'history_list_settings',
			[
				'label' => esc_html__( 'History List Settings', 'greenova-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'point_title_settings',
			[
				'label'     => __( 'Point Title Settings', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
				'classes'   => 'main-heading',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'label'    => __( 'Point Title Typography', 'greenova-core' ),
				'name'     => 'point_title_typography',
				'selector' => '{{WRAPPER}} .rt-history-box-wrapper .point-title',
			]
		);

		$this->add_control(
			'point_title_color',
			[
				'label'     => __( 'Point Title Color', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-history-box-wrapper .point-title' => 'color: {{VALUE}}',
				],
			]
		);


		$this->add_control(
			'point_title_margin',
			[
				'label'              => __( 'Margin Top/Bottom', 'greenova-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px', 'em' ],
				'allowed_dimensions' => 'vertical',
				'default'            => [
					'isLinked' => false,
				],
				'selectors'          => [
					'{{WRAPPER}} .rt-history-box-wrapper .point-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		//Point Text
		$this->add_control(
			'point_text_settings',
			[
				'label'     => __( 'Point Text Settings', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
				'classes'   => 'main-heading',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'label'    => __( 'Point Text Typography', 'greenova-core' ),
				'name'     => 'point_text_typography',
				'selector' => '{{WRAPPER}} .rt-history-box-wrapper .point-text',
			]
		);

		$this->add_control(
			'point_text_color',
			[
				'label'     => __( 'Point Text Color', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-history-box-wrapper .point-text' => 'color: {{VALUE}}',
				],
			]
		);

		//Point Text
		$this->add_control(
			'point_icon_settings',
			[
				'label'     => __( 'Point Icon Settings', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
				'classes'   => 'main-heading',
			]
		);

		$this->add_control(
			'point_icon_color',
			[
				'label'     => __( 'Point Icon Color', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-history-box-wrapper .rtin-history-list li:before' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'point_icon_bg',
			[
				'label'     => __( 'Point Icon Background', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-history-box-wrapper .rtin-history-list li:before' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'point_border',
			[
				'label'     => __( 'Point Border Color', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-history-box-wrapper .rtin-history-list li' => 'border-left-color: {{VALUE}}',
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