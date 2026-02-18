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

class Contact_Block extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ) {
		$this->rt_name = esc_html__( 'Contact', 'greenova-core' );
		$this->rt_base = 'rt-contact';
		parent::__construct( $data, $args );
	}

	protected function register_controls() {
		$this->start_controls_section(
			'rt_contact_settings',
			[
				'label' => esc_html__( 'Contact Settings', 'greenova-core' ),
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
				],

			]
		);


		$this->add_control(
			'title',
			[
				'label'       => esc_html__( 'Title', 'greenova-core' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Get in Touch With Us', 'greenova-core' ),
				'label_block' => true,
				'condition'   => [
					'layout' => [ 'style2' ],
				],
			]
		);

		$this->add_control(
			'subtitle',
			[
				'label'       => esc_html__( 'Sub Title', 'greenova-core' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => __( 'Nulla magnam exercitationem cupiditate ab maxime.', 'greenova-core' ),
				'label_block' => true,
				'rows'        => 2,
				'condition'   => [
					'layout' => [ 'style2' ],
				],
			]
		);

		$this->add_control(
			'address',
			[
				'label'       => esc_html__( 'Address', 'greenova-core' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 2,
				'default'     => __( 'PO Box 1212, California, US', 'greenova-core' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'email',
			[
				'label'       => esc_html__( 'Email', 'greenova-core' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'example@example.com', 'greenova-core' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'phone',
			[
				'label'       => esc_html__( 'Phone', 'greenova-core' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( '+61 1111 3333', 'greenova-core' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'fax',
			[
				'label'       => esc_html__( 'Fax', 'greenova-core' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( '+ (123) 6969 8008', 'greenova-core' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'social_links_visibility',
			[
				'label'        => __( 'Social Links Visibility', 'greenova-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'greenova-core' ),
				'label_off'    => __( 'Hide', 'greenova-core' ),
				'return_value' => 'yes',
				'default'      => 'yes',
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

		//Label Setting
		$this->add_control(
			'label_settings',
			[
				'label'     => __( 'Label Settings', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'after',
				'classes'   => 'main-heading',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'label_typography',
				'selector' => '{{WRAPPER}} .rt-contact-wrapper .address-label',
			]
		);

		$this->add_control(
			'label_color',
			[
				'label'     => __( 'Label Color', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-contact-wrapper .address-label' => 'color: {{VALUE}}',
				],
			]
		);

		//Info Setting
		$this->add_control(
			'info_settings',
			[
				'label'     => __( 'Info Settings', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'after',
				'classes'   => 'main-heading',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'info_typography',
				'selector' => '{{WRAPPER}} .rt-contact-wrapper .address-info',
			]
		);

		$this->add_control(
			'info_color',
			[
				'label'     => __( 'Info Color', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-contact-wrapper .address-info' => 'color: {{VALUE}}',
				],
			]
		);

		//Info Icon
		$this->add_control(
			'info_icon_settings',
			[
				'label'     => __( 'Info Icon Settings', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'after',
				'classes'   => 'main-heading',
			]
		);

		$this->add_control(
			'info_icon_color',
			[
				'label'     => __( 'Info Icon Color', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-contact-wrapper .info-icon' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'info_icon_size',
			[
				'label'      => __( 'Info Icon Size', 'greenova-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 18,
						'max'  => 50,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-contact-wrapper .info-icon' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		//Info Box Icon
		$this->add_control(
			'info_box_settings',
			[
				'label'     => __( 'Info Box Settings', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'after',
				'classes'   => 'main-heading',
				'condition' => [
					'layout' => [ 'style1' ],
				],
			]
		);

		$this->add_control(
			'info_box_padding',
			[
				'label'      => __( 'Box Padding', 'greenova-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .rt-vc-contact-1 ul.rtin-item > li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'  => [
					'layout' => [ 'style1' ],
				],
			]
		);

		$this->add_control(
			'box_border_color',
			[
				'label'     => __( 'Info Box Border Color', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-vc-contact-1 ul.rtin-item > li' => 'border-bottom-color: {{VALUE}}',
					'{{WRAPPER}} .rt-vc-contact-1 ul.rtin-item'      => 'border-color: {{VALUE}}',
				],
				'condition' => [
					'layout' => [ 'style1' ],
				],
			]
		);

		$this->end_controls_section();


		// Title/Subtitle Settings
		//==============================================================
		$this->start_controls_section(
			'title_subtitle',
			[
				'label'     => esc_html__( 'Title/Subtitle Settings', 'greenova-core' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'layout' => [ 'style2' ],
				],
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
				'name'     => 'title_typography',
				'selector' => '{{WRAPPER}} .rt-contact-wrapper .header-info h2',
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => __( 'Title Color', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '#212121',
				'selectors' => [
					'{{WRAPPER}} .rt-contact-wrapper .header-info h2' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'subtitle_settings',
			[
				'label'     => __( 'Sub Title Settings', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'after',
				'classes'   => 'main-heading',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'subtitle_typography',
				'selector' => '{{WRAPPER}} .rt-contact-wrapper .header-info p',
			]
		);

		$this->add_control(
			'subtitle_color',
			[
				'label'     => __( 'Title Color', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '#565656',
				'selectors' => [
					'{{WRAPPER}} .rt-contact-wrapper .header-info p' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();

		// Social Icon Settings
		//==============================================================
		$this->start_controls_section(
			'social_icon_settings',
			[
				'label'     => esc_html__( 'Social Icon Settings', 'greenova-core' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'social_links_visibility' => 'yes',
				],
			]
		);

		//Start social_icon Style Tab
		$this->start_controls_tabs(
			'social_icon_style_tabs'
		);

		//Normal Style
		$this->start_controls_tab(
			'social_icon_style_normal_tab',
			[
				'label' => __( 'Normal', 'greenova-core' ),
			]
		);
		$this->add_control(
			'social_icon_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'greenova-core' ),
				'selectors' => [
					'{{WRAPPER}} .contact-social li a' => 'color: {{VALUE}} !important',
				],
			]
		);

		$this->add_control(
			'social_icon_bg',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Background', 'greenova-core' ),
				'selectors' => [
					'{{WRAPPER}} .contact-social li a' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'social_icon_border',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Border Color', 'greenova-core' ),
				'selectors' => [
					'{{WRAPPER}} .contact-social li a' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		//Hover Style
		$this->start_controls_tab(
			'social_icon_style_hover_tab',
			[
				'label' => __( 'Hover', 'greenova-core' ),
			]
		);

		$this->add_control(
			'social_icon_hover_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color Hover', 'greenova-core' ),
				'selectors' => [
					'{{WRAPPER}} .contact-social li a:hover' => 'color: {{VALUE}} !important',
				],
			]
		);

		$this->add_control(
			'social_icon_bg_hover',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Background on Hover', 'greenova-core' ),
				'selectors' => [
					'{{WRAPPER}} .contact-social li a:hover' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'social_icon_border_hover',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Border on Hover', 'greenova-core' ),
				'selectors' => [
					'{{WRAPPER}} .contact-social li a:hover' => 'border-color: {{VALUE}}',
				],
			]
		);


		$this->end_controls_tab();

		$this->end_controls_tabs();
		//End social_icon Style Tab


		$this->add_control(
			'social_icon_border_radius',
			[
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Icon Border Radius', 'greenova-core' ),
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .contact-social li a' => 'border-radius: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'social_icon_spacing',
			[
				'label'      => __( 'Social Icon Margin', 'greenova-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .contact-social li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->end_controls_section();


		// Box Settings
		//==============================================================
		$this->start_controls_section(
			'box_settings',
			[
				'label'     => esc_html__( 'Box Settings', 'greenova-core' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'layout' => [ 'style1' ],
				],
			]
		);

		$this->add_responsive_control(
			'box_border_radius',
			[
				'label'      => __( 'Border Radius', 'greenova-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .rt-vc-contact-1 ul.rtin-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'box_background',
			[
				'label'     => __( 'Box Background', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-vc-contact-1 ul.rtin-item' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$data     = $this->get_settings();
		$template = 'view-1';
		if ( 'style2' == $data['layout'] ) {
			$template = 'view-2';
		}

		$this->rt_template( $template, $data );
	}

}