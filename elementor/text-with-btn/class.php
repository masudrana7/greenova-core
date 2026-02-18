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

class Text_With_btn extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ) {
		$this->rt_name = esc_html__( 'Text with Button', 'greenova-core' );
		$this->rt_base = 'rt-text-with-btn';
		parent::__construct( $data, $args );
	}

	protected function register_controls() {
		$this->start_controls_section(
			'rt_text_with_btn',
			[
				'label' => esc_html__( 'Text with Button Settings', 'greenova-core' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'title',
			[
				'label'       => esc_html__( 'Title', 'greenova-core' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => __( 'Award<span> Winning</span> Gardener<span> Landscape</span> Company', 'greenova-core' ),
				'rows'        => 2,
				'label_block' => true,
			]
		);

		$this->add_control(
			'title_tag',
			[
				'label'   => __( 'Choose Title Tag', 'greenova-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'h2',
				'options' => [
					'h1' => __( 'H1', 'greenova-core' ),
					'h2' => __( 'H2', 'greenova-core' ),
					'h4' => __( 'H3', 'greenova-core' ),
				],
			]
		);

		$this->add_control(
			'description',
			[
				'label'       => __( 'Description', 'greenova-core' ),
				'type'        => \Elementor\Controls_Manager::WYSIWYG,
				'default'     => __( "Mimply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five cent into electronining essentially unchanged.",
					'greenova-core' ),
				'placeholder' => __( 'Type your description here', 'greenova-core' ),
			]
		);

		$this->add_control(
			'btn_text',
			[
				'label'   => esc_html__( 'Button Text', 'greenova-core' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Contact Us', 'greenova-core' ),
			]
		);

		$this->add_control(
			'btn_link',
			[
				'label'         => __( 'Button Link', 'greenova-core' ),
				'type'          => \Elementor\Controls_Manager::URL,
				'placeholder'   => __( 'https://your-link.com', 'greenova-core' ),
				'show_external' => true,
				'default'       => [
					'url'         => '',
					'is_external' => true,
					'nofollow'    => true,
				],
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
						'title' => __( 'Right', 'greenova-core' ),
						'icon'  => 'fa fa-align-center',
					],
					'right'  => [
						'title' => __( 'Right', 'greenova-core' ),
						'icon'  => 'fa fa-align-right',
					],
				],
				'default'   => 'center',
				'toggle'    => true,
				'selectors' => [
					'{{WRAPPER}} .rt-text-with-btn-wrapper' => 'text-align: {{VALUE}}',
				],

			]
		);

		//Title Setting
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
				'name'     => 'title_typography',
				'selector' => '{{WRAPPER}} .rt-text-with-btn-wrapper .title',
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => __( 'Title Color - 1', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-text-with-btn-wrapper .title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'title_color_2',
			[
				'label'     => __( 'Title Color - 2', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-text-with-btn-wrapper .title span' => 'color: {{VALUE}}',
				],
			]
		);

		//Description Setting
		$this->add_control(
			'description_settings',
			[
				'label'     => __( 'Description Settings', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'after',
				'classes'   => 'main-heading',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'description_typography',
				'selector' => '{{WRAPPER}} .rt-text-with-btn-wrapper .description',
			]
		);

		$this->add_control(
			'description_color',
			[
				'label'     => __( 'Description Color', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-text-with-btn-wrapper .description' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'desc_spacing',
			[
				'label'              => __( 'Description Spacing', 'greenova-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px', 'em' ],
				'allowed_dimensions' => 'vertical',
				'default'            => [
					'isLinked' => false,
				],
				'selectors'          => [
					'{{WRAPPER}} .rt-text-with-btn-wrapper .description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Contact Us Settings
		//==============================================================
		$this->start_controls_section(
			'contact_us_settings',
			[
				'label' => esc_html__( 'Contact Us Button Settings', 'greenova-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'btn_style',
			[
				'label'   => __( 'Button Style', 'greenova-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'dark-button',
				'options' => [
					'light-button'     => __( 'Light Button', 'greenova-core' ),
					'dark-button'      => __( 'Primary Button', 'greenova-core' ),
					'light-box'        => __( 'Link Button', 'greenova-core' ),
					'white-button'     => __( 'Simple Button', 'greenova-core' ),
					'rt-custom-button' => __( 'Custom Button', 'greenova-core' ),
				],
			]
		);

		$this->add_control(
			'show_icon',
			[
				'label'        => __( 'Show Icon', 'greenova-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'greenova-core' ),
				'label_off'    => __( 'Hide', 'greenova-core' ),
				'return_value' => 'with-icon',
				'default'      => 'with-icon',
				'condition'    => [
					'btn_style' => [ 'rt-custom-button' ],
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'      => 'read-more-border',
				'label'     => __( 'Border', 'greenova-core' ),
				'selector'  => '{{WRAPPER}} .rt-text-with-btn-wrapper .rt-custom-button',
				'separator' => 'before',
				'condition' => [
					'btn_style' => [ 'rt-custom-button' ],
				],
			]
		);

		//Start contact_us Style Tab
		$this->start_controls_tabs(
			'contact_us_style_tabs', [
				'condition' => [
					'btn_style' => [ 'rt-custom-button' ],
				],
			]
		);

		//Normal Style
		$this->start_controls_tab(
			'contact_us_style_normal_tab',
			[
				'label' => __( 'Normal', 'greenova-core' ),
			]
		);
		$this->add_control(
			'contact_us_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'greenova-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-text-with-btn-wrapper .rt-custom-button'                   => 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-text-with-btn-wrapper .rt-custom-button.with-icon::before' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'contact_us_bg',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Background', 'greenova-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-text-with-btn-wrapper .rt-custom-button' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .rt-text-with-btn-wrapper .rt-custom-button' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		//Hover Style
		$this->start_controls_tab(
			'contact_us_style_hover_tab',
			[
				'label' => __( 'Hover', 'greenova-core' ),
			]
		);

		$this->add_control(
			'contact_us_hover_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color Hover', 'greenova-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-text-with-btn-wrapper .rt-custom-button:hover'             => 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-text-with-btn-wrapper .rt-custom-button.with-icon::before' => 'color: {{VALUE}} !important',
				],
			]
		);

		$this->add_control(
			'contact_us_bg_hover',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Background on Hover', 'greenova-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-text-with-btn-wrapper .rt-custom-button:hover' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .rt-text-with-btn-wrapper .rt-custom-button:hover' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'contact_us_border_hover',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Border on Hover', 'greenova-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-text-with-btn-wrapper .rt-custom-button:hover' => 'border-color: {{VALUE}}',
					'{{WRAPPER}} .rt-text-with-btn-wrapper .rt-custom-button:hover' => 'border-color: {{VALUE}}',
				],
			]
		);


		$this->end_controls_tab();

		$this->end_controls_tabs();
		//End contact_us Style Tab


		$this->add_control(
			'readmore_border_radius',
			[
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Border Radius', 'greenova-core' ),
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 30,
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-text-with-btn-wrapper .rt-custom-button' => 'border-radius: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .rt-text-with-btn-wrapper .rt-custom-button' => 'border-radius: {{SIZE}}{{UNIT}}',
				],
				'condition'  => [
					'btn_style' => [ 'rt-custom-button' ],
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'btn_typography',
				'label'     => esc_html__( 'Button Typography', 'greenova-core' ),
				'selector'  => '{{WRAPPER}} .rt-text-with-btn-wrapper .rt-custom-button',
				'selector'  => '{{WRAPPER}} .rt-text-with-btn-wrapper .rt-custom-button',
				'condition' => [
					'btn_style' => [ 'rt-custom-button' ],
				],
			]
		);

		$this->add_responsive_control(
			'button_spacing',
			[
				'label'      => __( 'Contact Us Padding', 'greenova-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .rt-text-with-btn-wrapper .rt-custom-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
					'{{WRAPPER}} .rt-text-with-btn-wrapper .rt-custom-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
				'condition'  => [
					'btn_style' => [ 'rt-custom-button' ],
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