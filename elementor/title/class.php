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

class Title extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ) {
		$this->rt_name = esc_html__( 'Section Title', 'greenova-core' );
		$this->rt_base = 'rt-title';
		parent::__construct( $data, $args );
	}

	protected function register_controls() {
		$this->start_controls_section(
			'sec_title',
			[
				'label' => esc_html__( 'Section Title', 'greenova-core' ),
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
					'style2' => __( 'Style 2(Title with Bar)', 'greenova-core' ),
					'style3' => __( 'Style 3(Title with Icon)', 'greenova-core' ),
					'style4' => __( 'Style 4( Subtitle with Bar )', 'greenova-core' ),
				],
			]
		);

		$this->add_control(
			'top_title',
			[
				'label'       => esc_html__( 'Title Top', 'greenova-core' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => 'Why People Choose Us',
				'label_block' => true,
				'condition'   => [
					'layout' => [ 'style1', 'style2', 'style4' ],
				],
			]
		);

		$this->add_control(
			'title',
			[
				'label'       => esc_html__( 'Main Title', 'greenova-core' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => 'Welcome To Greenova',
				'label_block' => true,
				'condition'   => [
					'layout' => [ 'style1', 'style2', 'style4' ],
				],
			]
		);


		$this->add_control(
			'titlethree',
			[
				'label'       => esc_html__( 'Color Title', 'greenova-core' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => '<span>W</span>hat<span> W</span>e<span> O</span>ffer',
				'label_block' => true,
				'condition'   => [
					'layout' => [ 'style3' ],
				],
			]
		);

		$this->add_control(
			'titlethree2',
			[
				'label'       => esc_html__( 'Title 2', 'greenova-core' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => 'Landscaping Company',
				'label_block' => true,
				'condition'   => [
					'layout' => [ 'style3' ],
				],
			]
		);

		$this->add_control(
			'titlethree_icon',
			[
				'label'     => __( 'Icon', 'greenova-core' ),
				'type'      => Controls_Manager::ICONS,
				'default'   => [
					'value'   => 'fa fa-bell',
					'library' => 'solid',
				],
				'condition' => [
					'layout' => [ 'style3' ],
				],
			]
		);

		$this->add_control(
			'subtitle',
			[
				'label'   => __( 'Subtitle', 'greenova-core' ),
				'type'    => \Elementor\Controls_Manager::WYSIWYG,
				'default' => __( 'Lorem Ipsum has been standard daand scrambled. Rimply dummy text of the printing and typesetting industry', 'greenova-core' ),
			]
		);

		$this->add_responsive_control(
			'alignment',
			[
				'label'     => __( 'Alignment', 'greenova-core' ),
				'type'      => Controls_Manager::CHOOSE,
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
				'default'   => 'center',
				'condition' => [
					'layout' => [ 'style1', 'style2' ],
				],
				'separator' => 'before',
			]
		);

		$this->end_controls_section();

		// Top Title Settings
		//==============================================================
		$this->start_controls_section(
			'top_title_two_settings',
			[
				'label'     => esc_html__( 'Top Title Settings', 'greenova-core' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'layout' => [ 'style1', 'style2', 'style4' ],
				],
			]
		);

		$this->add_control(
			'top_title_two_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'greenova-core' ),
				'selectors' => [
					'{{WRAPPER}} .section-heading .top-title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'top_title_two_typo',
				'label'    => esc_html__( 'Typography', 'greenova-core' ),
				'selector' => '{{WRAPPER}} .section-heading .top-title',
			]
		);

		$this->end_controls_section();

		// Heading Bar Style
		//==============================================================
		$this->start_controls_section(
			'title_bar_settings',
			[
				'label' => esc_html__( 'Heading Bar Style', 'greenova-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'heading_border',
			[
				'label'     => __( 'Heading Bar Style', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'layout' => ['style2', 'style4'],
				],
			]
		);

		$this->add_control(
			'title_border_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Bar Color', 'greenova-core' ),
				'selectors' => [
					'{{WRAPPER}} .section-heading .top-title:before' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .section-heading .heading-title::after' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'layout' => ['style2', 'style4'],
				],
			]
		);

		$this->add_control(
			'border_width',
			[
				'label'      => __( 'Bar Width', 'greenova-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 1000,
						'step' => 5,
					],
					'%'  => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .section-heading .top-title:before' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .section-heading .heading-title::after' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'layout' => ['style2', 'style4'],
				],
			]
		);

		$this->add_control(
			'border_position',
			[
				'label'      => __( 'Bar Position', 'greenova-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => - 50,
						'max'  => 50,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .section-heading .heading-title::after' => 'bottom: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'layout' => 'style2',
				],
			]
		);

		$this->end_controls_section();

		// Main Title Settings
		//==============================================================
		$this->start_controls_section(
			'title_settings',
			[
				'label' => esc_html__( 'Main Title Settings', 'greenova-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'greenova-core' ),
				'selectors' => [
					'{{WRAPPER}} .section-heading .heading-title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'title_color_two',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color 2', 'greenova-core' ),
				'selectors' => [
					'{{WRAPPER}} .section-heading .heading-title span' => 'color: {{VALUE}}',
				],
				'condition' => [
					'layout' => 'style3',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typo',
				'label'    => esc_html__( 'Typography', 'greenova-core' ),
				'selector' => '{{WRAPPER}} .section-heading .heading-title',
			]
		);

		$this->add_responsive_control(
			'heading_margin',
			[
				'label'      => __( 'Margin', 'greenova-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .heading-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'heading_padding',
			[
				'label'      => __( 'Padding', 'greenova-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .heading-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->end_controls_section();

		// Title 2 Settings
		//==============================================================
		$this->start_controls_section(
			'title_two_settings',
			[
				'label'     => esc_html__( 'Title 2 Settings', 'greenova-core' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'layout' => 'style3',
				],
			]
		);

		$this->add_control(
			'title_two_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'greenova-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-vc-title-3 .title2' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_two_typo',
				'label'    => esc_html__( 'Typography', 'greenova-core' ),
				'selector' => '{{WRAPPER}} .rt-vc-title-3 .title2',
			]
		);

		$this->end_controls_section();


		// Icon Settings
		//==============================================================
		$this->start_controls_section(
			'icon_settings',
			[
				'label'     => esc_html__( 'Icon Settings', 'greenova-core' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'layout' => 'style3',
				],
			]
		);

		$this->add_control(
			'icon_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'greenova-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-vc-title-3 .title-bottom-icon i' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'icon_size',
			[
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Font Size', 'greenova-core' ),
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 16,
						'max'  => 50,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-vc-title-3 .title-bottom-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
				],

			]
		);

		$this->end_controls_section();

		// Sub Title Settings
		//==============================================================

		$this->start_controls_section(
			'subtitle_settings',
			[
				'label' => esc_html__( 'Description Settings', 'greenova-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'subtitle_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'greenova-core' ),
				'selectors' => [
					'{{WRAPPER}} .section-heading .heading-subtitle' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'subtitle_typo',
				'label'    => esc_html__( 'Typography', 'greenova-core' ),
				'selector' => '{{WRAPPER}} .section-heading .heading-subtitle',
			]
		);

		$this->add_responsive_control(
			'subheading_margin',
			[
				'label'             => __( 'Margin', 'greenova-core' ),
				'type'              => Controls_Manager::DIMENSIONS,
				'size_units'        => [ 'px' ],
				'allowed_dimension' => 'vertical',
				'default'           => [
					'isLinked' => false,
				],
				'selectors'         => [
					'{{WRAPPER}} .heading-subtitle' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'subheading_padding',
			[
				'label'      => __( 'Padding', 'greenova-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .heading-subtitle' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->end_controls_section();

		// Box Settings
		//==============================================================

		$this->start_controls_section(
			'box_settings',
			[
				'label' => esc_html__( 'Title Box Settings', 'greenova-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'box_width',
			[
				'label'      => __( 'Box Width', 'greenova-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [
						'min'  => 400,
						'max'  => 1000,
						'step' => 5,
					],
					'%'  => [
						'min' => 50,
						'max' => 100,
					],
				],
				'default'    => [
					'unit' => '%',
					'size' => 100,
				],
				'selectors'  => [
					'{{WRAPPER}} .section-heading' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$data     = $this->get_settings();
		$template = 'view-1';
		if ( 'style3' == $data['layout'] ) {
			$template = 'view-3';
		}

		$this->rt_template( $template, $data );
	}

}