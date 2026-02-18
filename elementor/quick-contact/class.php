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

class Quick_Contact extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ) {
		$this->rt_name = esc_html__( 'Quick Contact', 'greenova-core' );
		$this->rt_base = 'rt-quick-contact';
		parent::__construct( $data, $args );
	}

	protected function register_controls() {
		$this->start_controls_section(
			'rt_quick_contact',
			[
				'label' => esc_html__( 'Quick Contact Settings', 'greenova-core' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'title',
			[
				'label'       => esc_html__( 'Title', 'greenova-core' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'OFFICE ADDRESS', 'greenova-core' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'description',
			[
				'label'       => __( 'Description', 'greenova-core' ),
				'type'        => \Elementor\Controls_Manager::WYSIWYG,
				'default'     => __( "Rimply dummy text of the printing and typesetting industry.Ipsum has been the industry's standard dummy text ever since thwhen an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leaplectronicRimply dummy text of the printing.",
					'greenova-core' ),
				'placeholder' => __( 'Type your description here', 'greenova-core' ),
			]
		);

		$this->add_control(
			'address',
			[
				'label'       => esc_html__( 'Address', 'greenova-core' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 2,
				'default'     => __( '1PO Box Collins Street West, Australia', 'greenova-core' ),
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
			'email',
			[
				'label'       => esc_html__( 'Email', 'greenova-core' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'example@example.com', 'greenova-core' ),
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
			'text_align',
			[
				'label'   => __( 'Alignment', 'greenova-core' ),
				'type'    => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'align-left'  => [
						'title' => __( 'Left', 'greenova-core' ),
						'icon'  => 'fa fa-align-left',
					],
					'align-right' => [
						'title' => __( 'Right', 'greenova-core' ),
						'icon'  => 'fa fa-align-right',
					],
				],
				'toggle'  => true,
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
				'label'    => __( 'Description Typography', 'greenova-core' ),
				'selector' => '{{WRAPPER}} .rt-contact-info h2',
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => __( 'Title Color', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-contact-info h2' => 'color: {{VALUE}}',
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
				'label'    => __( 'Description Typography', 'greenova-core' ),
				'selector' => '{{WRAPPER}} .rt-contact-info .contact-desc',
			]
		);

		$this->add_control(
			'description_color',
			[
				'label'     => __( 'Description Color', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-contact-info .contact-desc' => 'color: {{VALUE}}',
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
				'label'    => __( 'Info Typography', 'greenova-core' ),
				'selector' => '{{WRAPPER}} .rt-contact-info ul li',
			]
		);

		$this->add_control(
			'info_color',
			[
				'label'     => __( 'Info Color', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-contact-info ul li'   => 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-contact-info ul li a' => 'color: {{VALUE}}',
				],
			]
		);

		//Info Icon Settings
		$this->add_control(
			'info_icon_settings',
			[
				'label' => __( 'Info Icon Settings', 'greenova-core' ),
				'type'  => \Elementor\Controls_Manager::HEADING,
			]
		);

		//Start info_icon Style Tab
		$this->start_controls_tabs(
			'info_icon_style_tabs'
		);

		//Normal Style
		$this->start_controls_tab(
			'info_icon_style_normal_tab',
			[
				'label' => __( 'Normal', 'greenova-core' ),
			]
		);

		$this->add_control(
			'info_icon_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Icon Color', 'greenova-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-contact-info ul li i' => 'color: {{VALUE}} !important',
				],
			]
		);

		$this->add_control(
			'info_icon_bg',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Background Color', 'greenova-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-contact-info ul li i' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		//Hover Style
		$this->start_controls_tab(
			'info_icon_style_hover_tab',
			[
				'label' => __( 'Hover', 'greenova-core' ),
			]
		);

		$this->add_control(
			'info_icon_hover_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color Color on Hover', 'greenova-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-contact-info ul li i:hover' => 'color: {{VALUE}} !important',
				],
			]
		);

		$this->add_control(
			'info_icon_bg_hover',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Background on Hover', 'greenova-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-contact-info ul li i:hover' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();
		//End info_icon Style Tab

		$this->end_controls_section();
	}

	protected function render() {
		$data     = $this->get_settings();
		$template = 'view-1';

		$this->rt_template( $template, $data );
	}

}