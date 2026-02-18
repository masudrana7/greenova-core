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

class Pricing_Box extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ) {
		$this->rt_name = esc_html__( 'Pricing Box', 'greenova-core' );
		$this->rt_base = 'rt-pricing-box';
		parent::__construct( $data, $args );
	}

	protected function register_controls() {
		$this->start_controls_section(
			'rt_pricing_box',
			[
				'label' => esc_html__( 'Pricing Box Settings', 'greenova-core' ),
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
				'label'   => esc_html__( 'Title', 'greenova-core' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'STANDARD',
			]
		);

		$this->add_control(
			'price',
			[
				'label'       => esc_html__( 'Price', 'greenova-core' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '$56',
				'description' => esc_html__( 'Including currency sign eg. $59', 'greenova-core' ),
			]
		);

		$this->add_control(
			'unit_name',
			[
				'label'       => esc_html__( 'Unit Name', 'greenova-core' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => 'mo',
				'description' => esc_html__( 'eg. month or year. Keep empty if you don\'t want to show unit
				', 'greenova-core' ),
			]
		);

		$this->add_control(
			'feature',
			[
				'label'       => __( 'Feature', 'greenova-core' ),
				'type'        => \Elementor\Controls_Manager::WYSIWYG,
				'default'     => __( '<ul> <li>Investment Plan</li> <li>Education Loan</li> <li>Tax Planning</li> <li>BLANK</li> </ul>', 'greenova-core' ),
				'placeholder' => __( 'One line per feature. Put BLANK keyword if you want blank line.', 'greenova-core' ),
			]
		);

		$this->add_control(
			'button_text',
			[
				'label'   => esc_html__( 'Button Text', 'greenova-core' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Details',
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
				'label_block'   => false,
			]
		);

		$this->add_control(
			'active_pricing',
			[
				'label'        => __( 'Active Item', 'greenova-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'greenova-core' ),
				'label_off'    => __( 'No', 'greenova-core' ),
				'return_value' => 'active-class',
				'default'      => false,
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
			'primary_color1',
			[
				'type'      => Controls_Manager::COLOR,
				'default'   => \GREENOVA_Theme::$options['primary_color'],
				'label'     => esc_html__( 'Primary Color', 'greenova-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-pricing-box-wrapper:hover .price-header'                               => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .rt-pricing-box-wrapper.active-class .price-header'                        => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .rt-pricing-box-wrapper:hover .rtin-price-button .btn-price-button'        => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .rt-pricing-box-wrapper.active-class .rtin-price-button .btn-price-button' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .rt-pricing-box-wrapper .rtin-price-button .btn-price-button'              => 'color: {{VALUE}}',
				],
				'condition' => [
					'layout' => [ 'style1' ],
				],
			]
		);

		$this->add_control(
			'primary_color2',
			[
				'type'      => Controls_Manager::COLOR,
				'default'   => \GREENOVA_Theme::$options['primary_color'],
				'label'     => esc_html__( 'Primary Color', 'greenova-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-price-table-box1.rt-pricing-box-wrapper:hover'                => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .entry-content .rt-price-table-box1 .price-holder'                => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .entry-content .rt-price-table-box1 .pricetable-btn'              => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .entry-content .rt-price-table-box1:hover .pricetable-btn'        => 'color: {{VALUE}}',
					'{{WRAPPER}} .entry-content .rt-price-table-box1:hover .price-holder'          => 'color: {{VALUE}}',
					'{{WRAPPER}} .entry-content .rt-price-table-box1.active-class'                 => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .entry-content .rt-price-table-box1.active-class .price-holder'   => 'color: {{VALUE}}',
					'{{WRAPPER}} .entry-content .rt-price-table-box1.active-class .pricetable-btn' => 'color: {{VALUE}}',
				],
				'condition' => [
					'layout' => [ 'style2' ],
				],
			]
		);

		$this->add_control(
			'price_header_bg',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Price Header Background', 'greenova-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-pricing-box-wrapper .price-header' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'layout' => [ 'style1' ],
				],
			]
		);

		$this->add_control(
			'box_bg',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Main Box Background', 'greenova-core' ),
				'default'   => '#f8f8f8',
				'selectors' => [
					'{{WRAPPER}} .rt-pricing-box-wrapper' => 'background-color: {{VALUE}}',
				],
				'separator' => 'after',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'feature_typography',
				'label'    => __( 'Feature Typography', 'greenova-core' ),
				'selector' => '{{WRAPPER}} .rt-pricing-box-wrapper .feature-box',
			]
		);

		$this->add_control(
			'font_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Font Color', 'greenova-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-pricing-box-wrapper' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'list_border_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'List Border Color', 'greenova-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-price-table-box ul li' => 'border-top-color: {{VALUE}}',
				],
				'condition' => [
					'layout' => [ 'style1' ],
				],
			]
		);

		$this->add_control(
			'button_radius',
			[
				'label'      => __( 'Button Radius', 'greenova-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .rt-pricing-box-wrapper .rtin-price-button .btn-price-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

		$this->add_control(
			'box_radius',
			[
				'label'      => __( 'Box Radius', 'greenova-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .rt-pricing-box-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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