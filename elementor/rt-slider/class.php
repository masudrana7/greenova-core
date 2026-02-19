<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Greenova_Core;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class RT_Slider extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ) {
		$this->rt_name = esc_html__( 'RT Slider', 'greenova-core' );
		$this->rt_base = 'rt-main-slider';
		parent::__construct( $data, $args );
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_rt_slider',
			[
				'label' => __( 'RT Slider', 'greenova-core' ),
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'slider_image',
			[
				'label'   => __( 'Slider Image', 'greenova-core' ),
				'type'    => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$repeater->add_control(
			'slider_title', [
				'label'       => __( 'Title', 'greenova-core' ),
				'type'        => \Elementor\Controls_Manager::TEXTAREA,
				'default'     => __( 'First Impressions Matter', 'greenova-core' ),
				'label_block' => true,
				'rows'        => 2,
			]
		);

		$repeater->add_control(
			'slider_subtitle', [
				'label'       => __( 'Subtitle', 'greenova-core' ),
				'type'        => \Elementor\Controls_Manager::TEXTAREA,
				'default'     => __( 'Trust The Grounds Guys professionals to take care of your <br> commercial or residential grounds', 'greenova-core' ),
				'label_block' => true,
				'rows'        => 4,
			]
		);

		$repeater->add_control(
			'slider_link',
			[
				'label'       => __( 'Slider Link', 'greenova-core' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'greenova-core' ),
				'show_label'  => false,
			]
		);

		$repeater->add_control(
			'slider_animation',
			[
				'label'     => __( 'Additional Settings', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$repeater->add_control(
			'slider_bg_animation',
			[
				'label'   => __( 'Background Animation', 'greenova-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'zoom-in',
				'options' => [
					'zoom-in'  => __( 'Zoom In', 'greenova-core' ),
					'zoom-out' => __( 'Zoom Out', 'greenova-core' ),
				],
			]
		);

		// Title Animation 

		$repeater->add_control(
			'slider_title_popover_toggle',
			[
				'label'        => __( 'Title Animation', 'greenova-core' ),
				'type'         => \Elementor\Controls_Manager::POPOVER_TOGGLE,
				'label_off'    => __( 'Default', 'greenova-core' ),
				'label_on'     => __( 'Custom', 'greenova-core' ),
				'return_value' => 'yes',
			]
		);
		$repeater->start_popover();

		$repeater->add_control(
			'title_x_paralax',
			[
				'label'      => __( 'Title Paralax X Axix', 'greenova-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => - 300,
						'max'  => 300,
						'step' => 5,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 0,
				],
			]
		);

		$repeater->add_control(
			'title_y_paralax',
			[
				'label'      => __( 'Title Paralax Y Axix', 'greenova-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => - 300,
						'max'  => 300,
						'step' => 5,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => - 200,
				],
			]
		);

		$repeater->add_control(
			'title_paralax_scale',
			[
				'label'      => __( 'Title Paralax Scale', 'greenova-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 1,
						'max'  => 5,
						'step' => .1,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 1,
				],
			]
		);

		$repeater->add_control(
			'title_paralax_opacity',
			[
				'label'      => __( 'Title Paralax Opcaity', 'greenova-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 1,
						'step' => .1,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 0,
				],
			]
		);

		$repeater->add_control(
			'title_paralax_duration',
			[
				'label'      => __( 'Title Paralax Duration', 'greenova-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 100,
						'max'  => 5000,
						'step' => 100,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 800,
				],
			]
		);

		$repeater->add_control(
			'title_paralax_delay',
			[
				'label'      => __( 'Title Paralax Delay', 'greenova-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 100,
						'max'  => 2000,
						'step' => 100,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 300,
				],
			]
		);

		$repeater->end_popover();


		//SubTitle Animation 

		$repeater->add_control(
			'slider_subtitle_popover_toggle',
			[
				'label'        => __( 'Subtitle Animation', 'greenova-core' ),
				'type'         => \Elementor\Controls_Manager::POPOVER_TOGGLE,
				'label_off'    => __( 'Default', 'greenova-core' ),
				'label_on'     => __( 'Custom', 'greenova-core' ),
				'return_value' => 'yes',
			]
		);
		$repeater->start_popover();

		$repeater->add_control(
			'subtitle_x_paralax',
			[
				'label'      => __( 'Sub Title Paralax X Axix', 'greenova-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => - 300,
						'max'  => 300,
						'step' => 5,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => - 200,
				],
			]
		);

		$repeater->add_control(
			'subtitle_y_paralax',
			[
				'label'      => __( 'Title Paralax Y Axix', 'greenova-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => - 300,
						'max'  => 300,
						'step' => 5,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 0,
				],
			]
		);

		$repeater->add_control(
			'subtitle_paralax_scale',
			[
				'label'      => __( 'Title Paralax Scale', 'greenova-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 1,
						'max'  => 5,
						'step' => .1,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 1,
				],
			]
		);

		$repeater->add_control(
			'subtitle_paralax_opacity',
			[
				'label'      => __( 'Title Paralax Opcaity', 'greenova-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 1,
						'step' => .1,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 0,
				],
			]
		);

		$repeater->add_control(
			'subtitle_paralax_duration',
			[
				'label'      => __( 'Title Paralax Duration', 'greenova-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 100,
						'max'  => 5000,
						'step' => 100,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 800,
				],
			]
		);

		$repeater->add_control(
			'subtitle_paralax_delay',
			[
				'label'      => __( 'Sub Title Paralax Delay', 'greenova-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 100,
						'max'  => 5000,
						'step' => 100,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 500,
				],
			]
		);

		$repeater->end_popover();


		// Button Animation
		$repeater->add_control(
			'slider_button_popover_toggle',
			[
				'label'        => __( 'Button Animation', 'greenova-core' ),
				'type'         => \Elementor\Controls_Manager::POPOVER_TOGGLE,
				'label_off'    => __( 'Default', 'greenova-core' ),
				'label_on'     => __( 'Custom', 'greenova-core' ),
				'return_value' => 'yes',
			]
		);
		$repeater->start_popover();

		$repeater->add_control(
			'btn_x_paralax',
			[
				'label'      => __( 'Title Paralax X Axix', 'greenova-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => - 300,
						'max'  => 300,
						'step' => 5,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 0,
				],
			]
		);

		$repeater->add_control(
			'btn_y_paralax',
			[
				'label'      => __( 'Title Paralax Y Axix', 'greenova-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => - 300,
						'max'  => 300,
						'step' => 5,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 200,
				],
			]
		);

		$repeater->add_control(
			'btn_paralax_scale',
			[
				'label'      => __( 'Title Paralax Scale', 'greenova-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 1,
						'max'  => 5,
						'step' => .1,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 1,
				],
			]
		);

		$repeater->add_control(
			'btn_paralax_opacity',
			[
				'label'      => __( 'Title Paralax Opcaity', 'greenova-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 1,
						'step' => .1,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 0,
				],
			]
		);

		$repeater->add_control(
			'btn_paralax_duration',
			[
				'label'      => __( 'Title Paralax Duration', 'greenova-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 100,
						'max'  => 5000,
						'step' => 100,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 800,
				],
			]
		);

		$repeater->add_control(
			'btn_paralax_delay',
			[
				'label'      => __( 'Button Paralax Delay', 'greenova-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 100,
						'max'  => 5000,
						'step' => 100,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 700,
				],
			]
		);

		$repeater->end_popover();

		$repeater->add_control(
			'hr2',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);

		$repeater->add_control(
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
				'default'   => 'center',
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .slider-inner-wrapper' => 'text-align: {{VALUE}};',
				],
			]
		);

		$repeater->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name'     => 'overlay_bg',
				'label'    => __( 'Overlay', 'greenova-core' ),
				'types'    => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} {{CURRENT_ITEM}} .slider-inner-wrapper .bg::before',
			]
		);


		$this->add_control(
			'sliders',
			[
				'label'       => __( 'Slider Items', 'greenova-core' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => [
					[
						'slider_title'    => __( 'First Impressions Matter', 'greenova-core' ),
						'slider_subtitle' => __( 'Trust The Grounds Guys professionals to take care of your <br> commercial or residential grounds', 'greenova-core' ),
					],
					[
						'slider_title'    => __( 'First Impressions Matter', 'greenova-core' ),
						'slider_subtitle' => __( 'Trust The Grounds Guys professionals to take care of your <br> commercial or residential grounds', 'greenova-core' ),
					],
				],
				'title_field' => '{{{ slider_title }}}',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Image_Size::get_type(),
			[
				'name'      => 'thumbnail',
				'default'   => 'full',
				'separator' => 'before',
				// phpcs:ignore WordPressVIPMinimum.Performance.WPQueryParams.PostNotIn_exclude
				'exclude'   => [
					'custom',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_additional_options',
			[
				'label' => __( 'Additional Options', 'greenova-core' ),
			]
		);

		$this->add_control(
			'navigation',
			[
				'label'   => __( 'Navigation', 'greenova-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'arrows',
				'options' => [
					'both'   => __( 'Arrows and Dots', 'greenova-core' ),
					'arrows' => __( 'Arrows', 'greenova-core' ),
					'dots'   => __( 'Dots', 'greenova-core' ),
					'none'   => __( 'None', 'greenova-core' ),
				],
			]
		);

		$this->add_responsive_control(
			'slider_height',
			[
				'label'      => __( 'Slider Height', 'greenova-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'vh' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 1000,
						'step' => 5,
					],
					'vh' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 600,
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-swiper-slider .swiper-slide' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'slider_padding',
			[
				'label'      => __( 'Slider Padding', 'greenova-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .rt-slider-wrapper .slider-inner-wrapper .container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);


		$this->add_control(
			'effect',
			[
				'label'   => __( 'Effect', 'greenova-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'slide',
				'options' => [
					'slide' => __( 'Slide', 'greenova-core' ),
					'fade'  => __( 'Fade', 'greenova-core' ),
				],
			]
		);

		$this->add_control(
			'direction',
			[
				'label'     => __( 'Direction', 'greenova-core' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'horizontal',
				'options'   => [
					'horizontal' => __( 'Horizontal', 'greenova-core' ),
					'vertical'   => __( 'Vertical', 'greenova-core' ),
				],
				'condition' => [
					'effect' => 'slide',
				],
			]
		);

		$this->add_control(
			'autoplay',
			[
				'label'   => __( 'Autoplay', 'greenova-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'yes',
				'options' => [
					'yes' => __( 'Yes', 'greenova-core' ),
					'no'  => __( 'No', 'greenova-core' ),
				],

			]
		);

		$this->add_control(
			'pause_on_hover',
			[
				'label'       => __( 'Pause on Hover', 'greenova-core' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => 'yes',
				'options'     => [
					'yes' => __( 'Yes', 'greenova-core' ),
					'no'  => __( 'No', 'greenova-core' ),
				],
				'condition'   => [
					'autoplay' => 'yes',
				],
				'render_type' => 'none',
			]
		);

		$this->add_control(
			'pause_on_interaction',
			[
				'label'     => __( 'Pause on Interaction', 'greenova-core' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'yes',
				'options'   => [
					'yes' => __( 'Yes', 'greenova-core' ),
					'no'  => __( 'No', 'greenova-core' ),
				],
				'condition' => [
					'autoplay' => 'yes',
				],
			]
		);

		$this->add_control(
			'autoplay_speed',
			[
				'label'       => __( 'Autoplay Speed', 'greenova-core' ),
				'type'        => Controls_Manager::NUMBER,
				'default'     => 5000,
				'condition'   => [
					'autoplay' => 'yes',
				],
				'render_type' => 'none',
			]
		);

		// Loop requires a re-render so no 'render_type = none'
		$this->add_control(
			'infinite',
			[
				'label'   => __( 'Infinite Loop', 'greenova-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'yes',
				'options' => [
					'yes' => __( 'Yes', 'greenova-core' ),
					'no'  => __( 'No', 'greenova-core' ),
				],
			]
		);


		$this->add_control(
			'speed',
			[
				'label'       => __( 'Animation Speed', 'greenova-core' ),
				'type'        => Controls_Manager::NUMBER,
				'default'     => 500,
				'render_type' => 'none',
			]
		);


		$this->end_controls_section();

		// Title Settings 
		//============================================

		$this->start_controls_section(
			'section_style_title',
			[
				'label' => __( 'Title Settings', 'greenova-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'label'    => __( 'Typography', 'greenova-core' ),
				'selector' => '{{WRAPPER}} .rt-slider-wrapper .slider-title-wrap h2',
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => __( 'Title Color', 'greenova-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-slider-wrapper .slider-title-wrap h2' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'title_margin_bottom',
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
				'default'    => [
					'unit' => 'px',
					'size' => 15,
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-slider-wrapper .slider-title-wrap' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();


		// Subtitle Settings
		//============================================
		$this->start_controls_section(
			'section_style_subtitle',
			[
				'label' => __( 'Sub Title Settings', 'greenova-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'subtitle_typography',
				'label'    => __( 'Typography', 'greenova-core' ),
				'selector' => '{{WRAPPER}} .rt-slider-wrapper .slider-subtitle-wrap h4',
			]
		);

		$this->add_control(
			'subtitle_color',
			[
				'label'     => __( 'Sub Title Color', 'greenova-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-slider-wrapper .slider-subtitle-wrap h4' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'subtitle_margin_bottom',
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
				'default'    => [
					'unit' => 'px',
					'size' => 15,
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-slider-wrapper .slider-subtitle-wrap' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();


		// Read More Settings
		//==============================================================
		$this->start_controls_section(
			'slider_button_settings',
			[
				'label' => esc_html__( 'Button Settings', 'greenova-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'button_text',
			[
				'label'   => __( 'Button Text', 'greenova-core' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Read more', 'greenova-core' ),
			]
		);

		//Start button Style Tab
		$this->start_controls_tabs(
			'btn_style_tabs'
		);

		//Normal Style
		$this->start_controls_tab(
			'btn_style_normal_tab',
			[
				'label' => __( 'Normal', 'greenova-core' ),
			]
		);

		$this->add_control(
			'btn_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'greenova-core' ),
				'selectors' => [
					'{{WRAPPER}} .slider-dark-button' => 'color: {{VALUE}} !important',
				],
			]
		);

		$this->add_control(
			'btn_bg',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Background', 'greenova-core' ),
				'selectors' => [
					'{{WRAPPER}} .slider-dark-button' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'btn_border',
				'label'    => __( 'Border', 'greenova-core' ),
				'selector' => '{{WRAPPER}} .slider-dark-button',
			]
		);

		$this->end_controls_tab();

		//Hover Style
		$this->start_controls_tab(
			'btn_style_hover_tab',
			[
				'label' => __( 'Hover', 'greenova-core' ),
			]
		);

		$this->add_control(
			'btn_hover_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color Hover', 'greenova-core' ),
				'selectors' => [
					'{{WRAPPER}} .slider-dark-button:hover, {{WRAPPER}} .slider-dark-button:before' => 'color: {{VALUE}} !important',
				],
			]
		);

		$this->add_control(
			'btn_bg_hover',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Background on Hover', 'greenova-core' ),
				'selectors' => [
					'{{WRAPPER}} .slider-dark-button:hover' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'btn_border_hover',
				'label'    => __( 'Border', 'greenova-core' ),
				'selector' => '{{WRAPPER}} .slider-dark-button:hover',
			]
		);


		$this->end_controls_tab();

		$this->end_controls_tabs();
		//End btn Style Tab

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
				'separator'  => 'before',
				'selectors'  => [
					'{{WRAPPER}} .slider-dark-button' => 'border-radius: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'readmore_btn_typography',
				'label'    => esc_html__( 'Typography', 'greenova-core' ),
				'selector' => '{{WRAPPER}} .slider-dark-button',
			]
		);

		$this->add_responsive_control(
			'readmore_padding_spacing',
			[
				'label'      => __( 'Read More Padding', 'greenova-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .slider-dark-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->end_controls_section();

		// Carousel Settings
		// ========================================

		$this->start_controls_section(
			'section_style_navigation',
			[
				'label'     => __( 'Carousel Settings', 'greenova-core' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'navigation' => [ 'arrows', 'dots', 'both' ],
				],
			]
		);

		$this->add_control(
			'heading_style_arrows',
			[
				'label'     => __( 'Arrows', 'greenova-core' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'navigation' => [ 'arrows', 'both' ],
				],
			]
		);

		$this->add_control(
			'arrow_visibility',
			[
				'label'     => __( 'Arrow Visibility', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default'   => 'solid',
				'options'   => [
					''                 => __( 'Always Visible', 'greenova-core' ),
					'visible-on-hover' => __( 'Visible on hover', 'greenova-core' ),
				],
				'condition' => [
					'navigation' => [ 'arrows', 'both' ],
				],
			]
		);

		$this->add_responsive_control(
			'arrow_position',
			[
				'label'          => __( 'Arrow Position', 'greenova-core' ),
				'type'           => Controls_Manager::SLIDER,
				'size_units'     => [ 'px' ],
				'range'          => [
					'px' => [
						'min'  => 10,
						'max'  => 300,
						'step' => 5,
					],
				],
				'default'        => [
					'unit' => 'px',
					'size' => 100,
				],
				'tablet_default' => [
					'unit' => 'px',
					'size' => 50,
				],
				'mobile_default' => [
					'unit' => 'px',
					'size' => 10,
				],
				'selectors'      => [
					'{{WRAPPER}} .elementor-swiper-button-prev' => 'left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .elementor-swiper-button-next' => 'right: {{SIZE}}{{UNIT}};',
				],
				'condition'      => [
					'navigation' => [ 'arrows', 'both' ],
				],
			]
		);

		$this->add_responsive_control(
			'arrows_size',
			[
				'label'     => __( 'Font Size', 'greenova-core' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 15,
						'max' => 60,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rt-slider-wrapper .elementor-swiper-button' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'navigation' => [ 'arrows', 'both' ],
				],
			]
		);

		$this->add_responsive_control(
			'arrows_width_height',
			[
				'label'     => __( 'Width / Height', 'greenova-core' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 30,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rt-slider-wrapper .elementor-swiper-button' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'navigation' => [ 'arrows', 'both' ],
				],
			]
		);

		$this->add_responsive_control(
			'arrows_radius',
			[
				'label'     => __( 'Border Radius', 'greenova-core' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rt-slider-wrapper .elementor-swiper-button' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'navigation' => [ 'arrows', 'both' ],
				],
			]
		);


		$this->start_controls_tabs(
			'arrow_style_tabs'
		);

		$this->start_controls_tab(
			'arrow_style_normal_tab',
			[
				'label' => __( 'Normal', 'greenova-core' ),
			]
		);

		$this->add_control(
			'arrows_color',
			[
				'label'     => __( 'Color', 'greenova-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-slider-wrapper .elementor-swiper-button' => 'color: {{VALUE}};',
				],
				'condition' => [
					'navigation' => [ 'arrows', 'both' ],
				],
			]
		);

		$this->add_control(
			'arrows_bg_color',
			[
				'label'     => __( 'Background Color', 'greenova-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-slider-wrapper .elementor-swiper-button' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'navigation' => [ 'arrows', 'both' ],
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'      => 'border',
				'label'     => __( 'Arrow Border', 'greenova-core' ),
				'selector'  => '{{WRAPPER}} .rt-slider-wrapper .elementor-swiper-button',
				'condition' => [
					'navigation' => [ 'arrows', 'both' ],
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'arrow_style_hover_tab',
			[
				'label' => __( 'Hover', 'greenova-core' ),
			]
		);

		$this->add_control(
			'arrows_color_hover',
			[
				'label'     => __( 'Color', 'greenova-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-slider-wrapper .elementor-swiper-button:hover' => 'color: {{VALUE}};',
				],
				'condition' => [
					'navigation' => [ 'arrows', 'both' ],
				],
			]
		);

		$this->add_control(
			'arrows_bg_color_hover',
			[
				'label'     => __( 'Background Color', 'greenova-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-slider-wrapper .elementor-swiper-button:hover' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'navigation' => [ 'arrows', 'both' ],
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'      => 'border_hover',
				'label'     => __( 'Arrow Border', 'greenova-core' ),
				'selector'  => '{{WRAPPER}} .rt-slider-wrapper .elementor-swiper-button:hover',
				'condition' => [
					'navigation' => [ 'arrows', 'both' ],
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'heading_style_dots',
			[
				'label'     => __( 'Dots', 'greenova-core' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'navigation' => [ 'dots', 'both' ],
				],
			]
		);

		$this->add_control(
			'dots_position',
			[
				'label'        => __( 'Position', 'greenova-core' ),
				'type'         => Controls_Manager::SELECT,
				'default'      => 'outside',
				'options'      => [
					'outside' => __( 'Outside', 'greenova-core' ),
					'inside'  => __( 'Inside', 'greenova-core' ),
				],
				'prefix_class' => 'elementor-pagination-position-',
				'condition'    => [
					'navigation' => [ 'dots', 'both' ],
				],
			]
		);

		$this->add_control(
			'dots_size',
			[
				'label'     => __( 'Size', 'greenova-core' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 5,
						'max' => 25,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .swiper-pagination-bullet' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'navigation' => [ 'dots', 'both' ],
				],
			]
		);

		$this->add_control(
			'dots_color',
			[
				'label'     => __( 'Color', 'greenova-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .swiper-pagination-bullet' => 'background: {{VALUE}};',
				],
				'condition' => [
					'navigation' => [ 'dots', 'both' ],
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$data                = $this->get_settings();
		$data['swiper_data'] = [
			'effect' => 'slide',
			'fadeEffect' => ['crossFade' => true],
			'direction' => $data['direction'],
			'loop' => $data['infinite'] == 'yes' ? true : false,
			'speed' => $data['speed'],
			'slidesPerView' => 1,
			'spaceBetween' => 0,
			'slideToClickedSlide' => true,
			'allowTouchMove' => true,
			'parallax' => true,
			'loopedSlides' => 50,
			'navigation' => [
				'nextEl' => '.elementor-swiper-button-prev',
				'prevEl' => '.elementor-swiper-button-next',
			],
			'pagination' => [
				'el' => '.swiper-pagination',
				'clickable' => true,
				'type' => 'bullets',
			],
		];

		if ( 'yes' == $data['autoplay'] ) {
			$data['swiper_data']['autoplay'] = [
				'delay'             => $data['autoplay_speed'],
				'pauseOnMouseEnter' => $data['pause_on_hover'] == 'yes' ? true : false,
			];
		}

		$template = 'view-1';
		$this->rt_template( $template, $data );
	}

}