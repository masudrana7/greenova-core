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

class CTA extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ) {
		$this->rt_name = esc_html__( 'Call to Action', 'greenova-core' );
		$this->rt_base = 'rt-cta';
		parent::__construct( $data, $args );
	}

	protected function register_controls() {
		$this->start_controls_section(
			'rt_cta',
			[
				'label' => esc_html__( 'Call to Action Settings', 'greenova-core' ),
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
				],

			]
		);

		$this->add_control(
			'title',
			[
				'label'       => esc_html__( 'Title', 'greenova-core' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => 'Need Help For Gardening? Please Contact Us',
				'label_block' => true,
			]
		);

		$this->add_control(
			'subtitle',
			[
				'label'       => esc_html__( 'Subtitle', 'greenova-core' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => 'Buy the Greenova wordpress theme and grow with us',
				'label_block' => true,
				'condition'   => [
					'layout' => [ 'style3' ],
				],
			]
		);

		$this->add_control(
			'phone_upper_text',
			[
				'label'       => esc_html__( 'Phone Upper Text', 'greenova-core' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => 'Toll Free Call Us',
				'label_block' => true,
				'condition'   => [
					'layout' => [ 'style3' ],
				],
			]
		);

		$this->add_control(
			'phone_number',
			[
				'label'       => esc_html__( 'Phone Number', 'greenova-core' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '+88 555 66630',
				'label_block' => true,
				'condition'   => [
					'layout' => [ 'style3', 'style4' ],
				],
			]
		);

		$this->add_control(
			'button_text',
			[
				'label'       => esc_html__( 'Button Text', 'greenova-core' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => 'Contact Us',
				'label_block' => true,
				'condition'   => [
					'layout' => [ 'style1', 'style2' ],
				],
			]
		);

		$this->add_control(
			'button_url',
			[
				'label'         => __( 'Button URL', 'greenova-core' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => __( 'https://your-link.com', 'greenova-core' ),
				'show_external' => true,
				'default'       => [
					'url'         => '',
					'is_external' => true,
					'nofollow'    => true,
				],
				'condition'     => [
					'layout' => [ 'style1', 'style2' ],
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
					'{{WRAPPER}} .rt-cta-2 .rtin-cta-left' => 'text-align: {{VALUE}}',
				],
				'default'   => 'right',
				'toggle'    => true,
				'condition' => [
					'layout' => [ 'style3' ],
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
				'default'   => '#212121',
				'selectors' => [
					'{{WRAPPER}} .title-black .cta-title' => 'color: {{VALUE}}',
				],
				'condition' => [
					'layout' => [ 'style1', 'style2' ],
				],
			]
		);

		$this->add_control(
			'title_color2',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'greenova-core' ),
				'default'   => '#FFFFFF',
				'selectors' => [
					'{{WRAPPER}} .title-white .cta-title' => 'color: {{VALUE}}',
				],
				'condition' => [
					'layout' => [ 'style3', 'style4' ],
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'label'    => esc_html__( 'Typography', 'greenova-core' ),
				'selector' => '{{WRAPPER}} .cta-title',
			]
		);

		$this->add_control(
			'title_margin',
			[
				'label'      => __( 'Title Margin', 'greenova-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .cta-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Sub Title Settings
		//==============================================================
		$this->start_controls_section(
			'subtitle_settings',
			[
				'label'     => esc_html__( 'Subtitle Settings', 'greenova-core' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'layout' => [ 'style3' ],
				],
			]
		);

		$this->add_control(
			'subtitle_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'greenova-core' ),
				'default'   => '#FFFFFF',
				'selectors' => [
					'{{WRAPPER}} .rtin-cta-subtitle' => 'color: {{VALUE}}',
				],
			]
		);


		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'subtitle_typography',
				'label'    => esc_html__( 'Typography', 'greenova-core' ),
				'selector' => '{{WRAPPER}} .rtin-cta-subtitle',
			]
		);

		$this->end_controls_section();

		// Phone Settings for style3
		//==============================================================
		$this->start_controls_section(
			'phone_settings',
			[
				'label'     => esc_html__( 'Phone Settings', 'greenova-core' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'layout' => [ 'style3' ],
				],
			]
		);

		$this->add_control(
			'phone_uppertext_heading',
			[
				'label'     => __( 'Phone Upper Text →', 'greenova-core' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'phone_uppertext_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Phone Upper Text Color', 'greenova-core' ),
				'default'   => '#FFFFFF',
				'selectors' => [
					'{{WRAPPER}} .rtin-cta-phone-text' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'uppertext_typography',
				'label'    => esc_html__( 'Phone Upper Text Typography', 'greenova-core' ),
				'selector' => '{{WRAPPER}} .rtin-cta-phone-text',
			]
		);

		$this->add_control(
			'phone_number_heading',
			[
				'label'     => __( 'Phone Number →', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'phone_number_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Phone Number Color', 'greenova-core' ),
				'default'   => '#FFFFFF',
				'selectors' => [
					'{{WRAPPER}} .rc-cta-wrapper .rtin-cta-phone-number'                                      => 'color: {{VALUE}}',
					'{{WRAPPER}} .rc-cta-wrapper .rtin-cta-right .rtin-phone-holder .rtin-cta-phone-number i' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'phone_number_typography',
				'label'    => esc_html__( 'Phone Number Typography', 'greenova-core' ),
				'selector' => '{{WRAPPER}} .rtin-cta-phone-number span',
			]
		);

		$this->end_controls_section();

		// Phone Settings for style4
		//==============================================================
		$this->start_controls_section(
			'phone_settings4',
			[
				'label'     => esc_html__( 'Phone Settings', 'greenova-core' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'layout' => [ 'style4' ],
				],
			]
		);

		$this->add_control(
			'phone_number_color4',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Phone Number Color', 'greenova-core' ),
				'default'   => '#212121',
				'selectors' => [
					'{{WRAPPER}} .rt-cta-4 .emergrncy-content-holder-inner span' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'phone_icon_color4',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Icon Color', 'greenova-core' ),
				'default'   => '#1fa12e',
				'selectors' => [
					'{{WRAPPER}} .rt-cta-4 .emergrncy-content-holder-inner span i' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'phone_icon_bg4',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Phone Background', 'greenova-core' ),
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .rt-cta-4 .emergrncy-content-holder-inner span' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'phone_number_typography4',
				'label'    => esc_html__( 'Phone Number Typography', 'greenova-core' ),
				'selector' => '{{WRAPPER}} .rtin-cta-phone-number span',
			]
		);

		$this->end_controls_section();

		// Button Settings
		//==============================================================
		$this->start_controls_section(
			'button_settings',
			[
				'label'     => esc_html__( 'Button Settings', 'greenova-core' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'layout' => [ 'style1', 'style2' ],
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'button_typo',
				'label'    => esc_html__( 'Typography', 'greenova-core' ),
				'selector' => '{{WRAPPER}} .rtin-cta-contact-button a',
			]
		);

		$this->add_control(
			'btn_border_radius',
			[
				'label'      => __( 'Border Radius', 'greenova-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .rtin-cta-contact-button a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		//Start Button Controls Tabs
		$this->start_controls_tabs(
			'button_style_tabs'
		);

		$this->start_controls_tab(
			'btton_style_normal_tab',
			[
				'label' => __( 'Normal', 'greenova-core' ),
			]
		);

		$this->add_control(
			'button_text_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Text Color', 'greenova-core' ),
				'default'   => '#212121',
				'selectors' => [
					'{{WRAPPER}} .rtin-cta-contact-button a'                  => 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-cta-3 .rtin-cta-contact-button a:before' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'button_border_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Border Color', 'greenova-core' ),
				'default'   => '#212121',
				'selectors' => [
					'{{WRAPPER}} .rtin-cta-contact-button a' => 'border-color: {{VALUE}}',
				],
			]
		);


		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name'     => 'btn_background',
				'label'    => __( 'Background', 'greenova-core' ),
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .rtin-cta-contact-button a',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'button_style_hover_tab',
			[
				'label' => __( 'Hover', 'greenova-core' ),
			]
		);

		$this->add_control(
			'button_text_hover_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Text Color on Hover', 'greenova-core' ),
				'default'   => '#212121',
				'selectors' => [
					'{{WRAPPER}} .rtin-cta-contact-button a:hover'                  => 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-cta-3 .rtin-cta-contact-button:hover a:before' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'button_border_hover_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Border Color on Hover', 'greenova-core' ),
				'default'   => '#212121',
				'selectors' => [
					'{{WRAPPER}} .rtin-cta-contact-button a:hover' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name'     => 'btn_hover_background',
				'label'    => __( 'Background on Hover', 'greenova-core' ),
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .rtin-cta-contact-button a:hover',
			]
		);
		$this->end_controls_tab();

		$this->end_controls_tabs();
		//End Button Controls Tabs

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

		$this->add_control(
			'box_padding',
			[
				'label'      => __( 'Box Padding', 'greenova-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .rc-cta-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'  => [
					'layout' => [ 'style1', 'style2' ],
				],
			]
		);

		$this->add_control(
			'box_left_bg_heading',
			[
				'label'     => __( 'Box Left Background Options:', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'condition' => [
					'layout' => [ 'style3', 'style4' ],
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name'      => 'style3_bg_left',
				'label'     => __( 'Box Left Background Color', 'greenova-core' ),
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .rt-cta-2 .rtin-cta-left, {{WRAPPER}} .rt-cta-4 .emergrncy-img-holder',
				'condition' => [
					'layout' => [ 'style3', 'style4' ],
				],
			]
		);

		$this->add_control(
			'box_right_bg_heading',
			[
				'label'     => __( 'Box Right Background Options:', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'layout' => [ 'style3', 'style4' ],
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name'       => 'style3_bg_right',
				'label'      => __( 'Box Right Background Color', 'greenova-core' ),
				'show_label' => true,
				'types'      => [ 'classic', 'gradient' ],
				'selector'   => '{{WRAPPER}} .rt-cta-2 .rtin-cta-right, {{WRAPPER}} .rt-cta-2 .rtin-cta-right:before',
				'condition'  => [
					'layout' => [ 'style3' ],
				],
			]
		);

		$this->add_control(
			'style4_bg_right',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Box Right Background Color', 'greenova-core' ),
				'selectors' => [
					'{{WRAPPER}} .footer-topbar .emergrncy-content-holder'        => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .footer-topbar .emergrncy-content-holder:before' => 'border-right-color: {{VALUE}};border-left-color: {{VALUE}}',
				],
				'condition' => [
					'layout' => [ 'style4' ],
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
		} elseif ( 'style4' == $data['layout'] ) {
			$template = 'view-4';
		}

		$this->rt_template( $template, $data );
	}

}