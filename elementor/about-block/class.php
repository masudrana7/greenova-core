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

class About_block extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ) {
		$this->rt_name = esc_html__( 'About Block', 'greenova-core' );
		$this->rt_base = 'rt-about-block';
		parent::__construct( $data, $args );
	}

	protected function register_controls() {
		$this->start_controls_section(
			'rt_about_block',
			[
				'label' => esc_html__( 'About Block Settings', 'greenova-core' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'column',
			[
				'label'   => esc_html__( 'Choose Column', 'greenova-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'col7',
				'options' => [
					'col6' => __( 'Col 6 / Col 6', 'greenova-core' ),
					'col7' => __( 'Col 7 / Col 5', 'greenova-core' ),
					'col8' => __( 'Col 8 / Col 4', 'greenova-core' ),
				],
			]
		);

		$this->add_control(
			'image',
			[
				'label'   => __( 'Choose Image', 'greenova-core' ),
				'type'    => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Image_Size::get_type(),
			[
				'name'    => 'thumbnail', // // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
				'exclude' => [ 'custom' ],
				'include' => [],
				'default' => 'large',
			]
		);

		$this->add_control(
			'title1',
			[
				'label'       => esc_html__( 'Title-1', 'greenova-core' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'About', 'greenova-core' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'title2',
			[
				'label'       => esc_html__( 'Title-2', 'greenova-core' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Miako Legal', 'greenova-core' ),
				'label_block' => true,
			]
		);


		$this->add_control(
			'content',
			[
				'label'       => __( 'Content', 'greenova-core' ),
				'type'        => \Elementor\Controls_Manager::WYSIWYG,
				'default'     => __( 'There are many variations of passages of Lorem Ipsum availabbut the humourrandomisedwords.There are many variations of passages of Lorem Ipsum availablebut the majority.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla varius consequat magna, id molestie ipsum volutpat quis. Suspendisse consectetur fringilla suctus.',
					'greenova-core' ),
				'placeholder' => __( 'One line per feature. Put BLANK keyword if you want blank line.', 'greenova-core' ),
			]
		);

		$this->add_control(
			'button_text',
			[
				'label'   => esc_html__( 'Button Text', 'greenova-core' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Read More',
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
			'image_position',
			[
				'label'   => __( 'Image Position', 'greenova-core' ),
				'type'    => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left'  => [
						'title' => __( 'Left', 'greenova-core' ),
						'icon'  => 'eicon-h-align-left',
					],
					'right' => [
						'title' => __( 'Right', 'greenova-core' ),
						'icon'  => 'eicon-h-align-right',
					],
				],
				'default' => 'right',
				'toggle'  => true,
			]
		);

		$this->add_control(
			'vertical_align',
			[
				'label'   => __( 'Vertical Alignment', 'greenova-core' ),
				'type'    => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'normal'           => [
						'title' => __( 'Top', 'greenova-core' ),
						'icon'  => 'eicon-v-align-top',
					],
					'row-align-center' => [
						'title' => __( 'Center', 'greenova-core' ),
						'icon'  => 'eicon-v-align-middle',
					],
					'row-align-end'    => [
						'title' => __( 'Bottom', 'greenova-core' ),
						'icon'  => 'eicon-v-align-bottom',
					],
				],
				'default' => 'center',
				'toggle'  => true,
			]
		);

		$this->end_controls_section();

		// Title Settings
		//=====================================================================

		$this->start_controls_section(
			'title_style',
			[
				'label' => __( 'Title Style', 'greenova-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);


		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'selector' => '{{WRAPPER}} .about-content-wrapper h1',
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => __( 'Title-1 Color', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .about-content-wrapper h1' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'title_2_color',
			[
				'label'     => __( 'Title-2 Color', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .about-content-wrapper h1 span.greenova-primary-color' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();

		//Excerpt Style
		//=============================================================================

		$this->start_controls_section(
			'content_style',
			[
				'label' => __( 'Content Style', 'greenova-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'content_typography',
				'selector' => '{{WRAPPER}} .about-content-inner',
			]
		);

		$this->add_control(
			'content_color',
			[
				'label'     => __( 'Content Color', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .about-content-inner' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'content_margin',
			[
				'label'              => __( 'Margin Top / Bottom', 'greenova-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px', 'em' ],
				'selectors'          => [
					'{{WRAPPER}} .about-content-inner' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'allowed_dimensions' => 'vertical',
			]
		);

		$this->end_controls_section();

		//Read More Style
		//=============================================================================

		$this->start_controls_section(
			'readmore_style',
			[
				'label' => __( 'Read More Style', 'greenova-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'readmore_visibility',
			[
				'label'   => __( 'Read More Visibility', 'greenova-core' ),
				'type'    => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'visible' => [
						'title' => __( 'Visible', 'greenova-core' ),
						'icon'  => 'fa fa-eye',
					],
					'hidden'  => [
						'title' => __( 'Hidden', 'greenova-core' ),
						'icon'  => 'fa fa-eye-slash',
					],
				],
				'toggle'  => false,
				'default' => 'visible',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'      => 'readmore_typography',
				'selector'  => '{{WRAPPER}} .about-read-more-btn',
				'condition' => [
					'readmore_visibility' => [ 'visible' ],
				],
			]
		);

		//Button style Tabs
		$this->start_controls_tabs(
			'readmore_style_tabs', [
				'condition' => [
					'readmore_visibility' => [ 'visible' ],
				],
			]
		);

		$this->start_controls_tab(
			'readmore_style_normal_tab',
			[
				'label' => __( 'Normal', 'greenova-core' ),
			]
		);

		$this->add_control(
			'readmore_color',
			[
				'label'     => __( 'Font Color', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .about-read-more-btn'       => 'color: {{VALUE}} !important',
					'{{WRAPPER}} .about-read-more-btn:after' => 'color: {{VALUE}} !important',
				],
			]
		);

		$this->add_control(
			'readmore_bg',
			[
				'label'     => __( 'Background Color', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .about-read-more-btn' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'readmore_border',
			[
				'label'     => __( 'Border Color', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .about-read-more-btn' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'readmore_style_hover_tab',
			[
				'label' => __( 'Hover', 'greenova-core' ),
			]
		);

		$this->add_control(
			'readmore_color_hover',
			[
				'label'     => __( 'Font Color hover', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .about-read-more-btn:hover'        => 'color: {{VALUE}} !important',
					'{{WRAPPER}} .about-read-more-btn:hover::after' => 'color: {{VALUE}} !important',
				],
			]
		);

		$this->add_control(
			'readmore_bg_hover',
			[
				'label'     => __( 'Background Color hover', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .about-read-more-btn:hover' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'readmore_border_hover',
			[
				'label'     => __( 'Border Color Hover', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .about-read-more-btn:hover' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'read_more_radius',
			[
				'label'      => __( 'Button Radius', 'greenova-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .about-read-more-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'  => [
					'readmore_visibility' => [ 'visible' ],
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
			'content_padding',
			[
				'label'      => __( 'Content Box Padding', 'greenova-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .about-content-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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