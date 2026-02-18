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

class Info_Box extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ) {
		$this->rt_name = esc_html__( 'Info Box', 'greenova-core' );
		$this->rt_base = 'rt-info-box';
		parent::__construct( $data, $args );
	}

	protected function register_controls() {
		$this->start_controls_section(
			'rt_info_box',
			[
				'label' => esc_html__( 'Info Box Settings', 'greenova-core' ),
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
					'style5' => __( 'Style 5', 'greenova-core' ), //vc-8
					'style6' => __( 'Style 6', 'greenova-core' ), //vc-10
					'style7' => __( 'Style 7', 'greenova-core' ), //vc-11
				],

			]
		);

		$this->add_control(
			'icon_type',
			[
				'label'     => __( 'Icon Type', 'greenova-core' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'icon',
				'options'   => [
					'icon'  => __( 'Icon', 'greenova-core' ),
					'image' => __( 'Image', 'greenova-core' ),
				],
				'condition' => [
					'layout!' => 'style6',
				],
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
			'sub_title',
			[
				'label'       => esc_html__( 'Sub Title', 'greenova-core' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => 'I am Info Text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit',
				'label_block' => true,
				'condition'   => [
					'layout' => [ 'style1', 'style2', 'style4', 'style7' ],
				],
			]
		);

		$this->add_control(
			'subtitle6',
			[
				'label'       => esc_html__( 'Sub Title', 'greenova-core' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => 'Gardening Services',
				'label_block' => true,
				'condition'   => [
					'layout' => [ 'style6' ],
				],
			]
		);

		$this->add_control(
			'bg_image6',
			[
				'label'     => __( 'Background Image', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::MEDIA,
				'default'   => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'layout' => [ 'style6' ],
				],
			]
		);

		$this->add_control(
			'content6',
			[
				'label'       => __( 'Content', 'greenova-core' ),
				'type'        => \Elementor\Controls_Manager::WYSIWYG,
				'default'     => '<ul class="feature-list"> <li>Lawn Maintenance</li> <li>Spring &amp; Fall Clean Up</li> <li>Fertilization</li> <li>Irrigation</li> <li>Ice Management</li> </ul>',
				'placeholder' => __( 'Type your description here', 'greenova-core' ),
				'condition'   => [
					'layout' => [ 'style6' ],
				],
			]
		);

		$this->add_control(
			'info_icon',
			[
				'label'            => __( 'Choose Icon', 'greenova-core' ),
				'type'             => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'default'          => [
					'value'   => 'fas fa-star',
					'library' => 'fa-solid',
				],
				'condition'        => [
					'icon_type' => [ 'icon' ],
					'layout!'   => 'style6',
				],
			]
		);

		$this->add_control(
			'show_readmore_btn',
			[
				'label'        => __( 'Read More Button', 'greenova-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'On', 'greenova-core' ),
				'label_off'    => __( 'Off', 'greenova-core' ),
				'return_value' => 'is-readmore',
				'condition'    => [
					'layout!' => 'style6',
				],
			]
		);

		$this->add_control(
			'read_more_btn_text',
			[
				'label'       => esc_html__( 'Button Text', 'greenova-core' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => 'Read More',
				'label_block' => true,
				'condition'   => [
					'show_readmore_btn' => [ 'is-readmore' ],
					'layout!'           => 'style6',
				],
			]
		);

		$this->add_control(
			'link',
			[
				'label'         => __( 'Link', 'greenova-core' ),
				'type'          => \Elementor\Controls_Manager::URL,
				'placeholder'   => __( 'https://your-link.com', 'greenova-core' ),
				'show_external' => true,
				'default'       => [
					'url'         => '',
					'is_external' => true,
					'nofollow'    => true,
				],
				'condition'     => [
					'layout!' => 'style6',
				],
			]
		);


		$this->add_control(
			'image_icon',
			[
				'label'     => __( 'Choose Image', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::MEDIA,
				'default'   => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'icon_type' => [ 'image' ],
					'layout!'   => 'style6',
				],
			]
		);

		$this->add_control(
			'image_width',
			[
				'label'      => __( 'Image Width', 'greenova-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 50,
						'max'  => 200,
						'step' => 1,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 65,
				],
				'selectors'  => [
					'{{WRAPPER}} .icon-holder img' => 'width: {{SIZE}}{{UNIT}};height:auto',
				],
				'condition'  => [
					'icon_type' => [ 'image' ],
				],
			]
		);

		$this->add_responsive_control(
			'icon_position',
			[
				'label'     => __( 'Icon Position', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::CHOOSE,
				'options'   => [
					'icon-left'                                                      => [
						'title' => __( 'Left', 'greenova-core' ),
						'icon'  => 'eicon-h-align-left',
					],
					'float: none; display: block; padding: 0;'                       => [
						'title' => __( 'Top', 'greenova-core' ),
						'icon'  => 'eicon-v-align-top',
					],
					'float: right !important; padding-right: 0; padding-left: 30px;' => [
						'title' => __( 'Right', 'greenova-core' ),
						'icon'  => 'eicon-h-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rt-info-box .icon-holder' => '{{VALUE}}',
				],
				'condition' => [
					'layout' => [ 'style1' ],
				],
				'toggle'    => true,
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
					'{{WRAPPER}} .rt-info-box .content-align *' => 'text-align: {{VALUE}} !important',
					'{{WRAPPER}} .rt-info-box .icon-holder'     => 'text-align: {{VALUE}} !important',
				],
				'condition' => [
					'layout' => [ 'style1' ],
				],
				'toggle'    => true,
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
					'{{WRAPPER}} .rt-info-box .info-title'   => 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-info-box .info-title a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'title_hover_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Hover Color', 'greenova-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-info-box:hover .info-title'   => 'color: {{VALUE}} !important',
					'{{WRAPPER}} .rt-info-box:hover .info-title a' => 'color: {{VALUE}} !important',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'label'    => esc_html__( 'Typography', 'greenova-core' ),
				'selector' => '{{WRAPPER}} .rt-info-box .info-title',
			]
		);

		$this->add_responsive_control(
			'title_spacing',
			[
				'label'              => __( 'Title Spacing', 'greenova-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'allowed_dimensions' => 'vertical',
				'selectors'          => [
					'{{WRAPPER}} .rt-info-box .info-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->end_controls_section();

		// Sub Title 
		//==============================================================
		$this->start_controls_section(
			'sub_title_settings',
			[
				'label'     => esc_html__( 'Sub Title Settings', 'greenova-core' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'layout' => [ 'style1', 'style2', 'style4', 'style7' ],
				],
			]
		);

		$this->add_control(
			'sub_title_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'greenova-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-info-box .content-holder p' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'sub_title_hover_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Hover Color', 'greenova-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-info-box:hover .content-holder p' => 'color: {{VALUE}}',
				],
			]
		);


		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'sub_title_typography',
				'label'    => esc_html__( 'Typography', 'greenova-core' ),
				'selector' => '{{WRAPPER}} .rt-info-box .content-holder p',
			]
		);

		$this->add_responsive_control(
			'sub_title_spacing',
			[
				'label'              => __( 'Sub Title Spacing', 'greenova-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'allowed_dimensions' => 'vertical',
				'selectors'          => [
					'{{WRAPPER}} .rt-info-box .content-holder p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->end_controls_section();

		// Sub Title - 6 Settings 
		//==============================================================
		$this->start_controls_section(
			'sub_title_6_settings',
			[
				'label'     => esc_html__( 'Sub Title / Content Settings', 'greenova-core' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'layout' => [ 'style6' ],
				],
			]
		);

		$this->add_control(
			'sub_title_6_heading',
			[
				'label'     => __( 'Subtitle Settings', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'sub_title_6_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'greenova-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-info-box .rt-sub-title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'sub_title_6_typography',
				'label'    => esc_html__( 'Typography', 'greenova-core' ),
				'selector' => '{{WRAPPER}} .rt-info-box .rt-sub-title',
			]
		);

		$this->add_control(
			'content_6_heading',
			[
				'label'     => __( 'Content Settings', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'content_6_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'greenova-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-info-box .content-list ul li' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'content_6_icon_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'List Icon Color', 'greenova-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-info-box .content-list ul li::before' => 'color: {{VALUE}} !important',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'content_6_typography',
				'label'    => esc_html__( 'Typography', 'greenova-core' ),
				'selector' => '{{WRAPPER}} .rt-info-box .content-list ul li',
			]
		);

		$this->end_controls_section();

		// Icon Image Settings
		//==============================================================
		$this->start_controls_section(
			'icon_image_settings',
			[
				'label'     => esc_html__( 'Icon Image Settings', 'greenova-core' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'icon_type' => [ 'image' ],
					'layout'   => 'style1',
				],
			]
		);

		$this->add_responsive_control(
			'icon_img_width',
			[
				'label'      => esc_html__( 'Width', 'greenova-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [ 'min' => 0, 'max' => 500 ],
					'%'  => [ 'min' => 0, 'max' => 100 ],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-info-box .icon-holder' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_img_height',
			[
				'label'      => esc_html__( 'Height', 'greenova-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [ 'min' => 0, 'max' => 500 ],
					'%'  => [ 'min' => 0, 'max' => 100 ],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-info-box .icon-holder' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_img_line_height',
			[
				'label'      => esc_html__( 'Line Height', 'greenova-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [ 'min' => 0, 'max' => 500 ],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-info-box .icon-holder' => 'line-height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_img_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'greenova-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .rt-info-box .icon-holder' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_img_padding',
			[
				'label'      => esc_html__( 'Padding', 'greenova-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .rt-info-box .icon-holder' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_img_margin',
			[
				'label'      => esc_html__( 'Margin', 'greenova-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .rt-info-box .icon-holder' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'icon_img_bg',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Background', 'greenova-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-info-box .icon-holder'    => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'icon_image_align',
			[
				'label'     => esc_html__( 'Text Align', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::CHOOSE,
				'options'   => [
					'left'   => [
						'title' => esc_html__( 'Left', 'greenova-core' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'greenova-core' ),
						'icon'  => 'eicon-text-align-center',
					],
					'right'  => [
						'title' => esc_html__( 'Right', 'greenova-core' ),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rt-info-box .icon-holder' => 'text-align: {{VALUE}};',
				],
				'default'   => 'center',
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
					'icon_type' => [ 'icon' ],
					'layout!'   => 'style6',
				],
			]
		);


		//Start Icon Style Tab
		$this->start_controls_tabs(
			'icon_style_tabs'
		);

		//Normal Style
		$this->start_controls_tab(
			'icon_style_normal_tab',
			[
				'label' => __( 'Normal', 'greenova-core' ),
			]
		);
		$this->add_control(
			'icon_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'greenova-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-info-box.icon-el-style-1 .icon-holder i'      => 'color: {{VALUE}}',
					'{{WRAPPER}} .icon-el-style-2.rt-info-box .service-box span i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-info-text-8 .service-box span i'              => 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-info-text-11 .icon-holder span i'             => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'icon_bg',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Background', 'greenova-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-info-box.icon-el-style-1 .icon-holder i'    => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .rt-info-box.icon-el-style-2 .icon-holder span' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .rt-info-text-8 .service-box span i'            => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .rt-info-text-11 .icon-holder span i'           => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'icon-border',
				'label'    => __( 'Icon Border', 'greenova-core' ),
				'selector' => '{{WRAPPER}} .rt-info-box.icon-el-style-1 .icon-holder i, {{WRAPPER}} .rt-info-box.icon-el-style-2 .icon-holder span, {{WRAPPER}} .rt-info-text-8 .service-box span i, {{WRAPPER}} .rt-info-text-11 .icon-holder span i',
			]
		);

		$this->end_controls_tab();

		//Hover Style
		$this->start_controls_tab(
			'icon_style_hover_tab',
			[
				'label' => __( 'Hover', 'greenova-core' ),
			]
		);

		$this->add_control(
			'icon_hover_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color Hover', 'greenova-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-info-box.icon-el-style-1:hover .icon-holder i'      => 'color: {{VALUE}}',
					'{{WRAPPER}} .icon-el-style-2.rt-info-box .service-box:hover span i' => 'color: {{VALUE}} !important',
					'{{WRAPPER}} .rt-info-text-8 .service-box:hover span i'              => 'color: {{VALUE}} !important',
					'{{WRAPPER}} .rt-info-text-11 .icon-holder span i'                   => 'color: {{VALUE}} !important',
				],
			]
		);

		$this->add_control(
			'icon_bg_hover',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Background on Hover', 'greenova-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-info-box.icon-el-style-1:hover .icon-holder i'    => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .rt-info-box.icon-el-style-2:hover .icon-holder span' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .rt-info-text-8 .service-box:hover span i'            => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .rt-info-text-11:hover .icon-holder span i'           => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'icon-border-hover',
				'label'    => __( 'Icon Border on Hover', 'greenova-core' ),
				'selector' => '{{WRAPPER}} .rt-info-box.icon-el-style-1:hover .icon-holder i, {{WRAPPER}} .rt-info-box.icon-el-style-2:hover .icon-holder span, {{WRAPPER}} .rt-info-text-8 .service-box:hover span i, {{WRAPPER}} .rt-info-text-11 .icon-holder span i',
			]
		);


		$this->end_controls_tab();

		$this->end_controls_tabs();
		//End Icon Style Tab

		$this->add_responsive_control(
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
					'{{WRAPPER}} .rt-info-box.icon-el-style-1 .icon-holder i'    => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .rt-info-box.icon-el-style-2 .icon-holder span' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .rt-info-text-8 .service-box span i'            => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .rt-info-text-11 .icon-holder span i'           => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_line_height',
			[
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Icon Line Height', 'greenova-core' ),
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 80,
						'max'  => 200,
						'step' => 5,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-info-box.icon-el-style-1 .icon-holder i'    => 'line-height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .rt-info-box.icon-el-style-2 .icon-holder span' => 'line-height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .rt-info-text-8 .service-box span i'            => 'line-height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .rt-info-text-11 .icon-holder span i'           => 'line-height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Icon Font Size', 'greenova-core' ),
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 20,
						'max'  => 150,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-info-box .icon-holder i'          => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .rt-info-text-8 .service-box span i'  => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .rt-info-text-11 .icon-holder span i' => 'font-size: {{SIZE}}{{UNIT}};',
				],

			]
		);

		$this->add_responsive_control(
			'icon_spacing',
			[
				'label'      => __( 'Spacing', 'greenova-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .rt-info-box .icon-holder' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'icon_border_radius',
			[
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Border Radius', 'greenova-core' ),
				'size_units' => [ '%' ],
				'range'      => [
					'%' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-info-box.icon-el-style-1 .icon-holder i'    => 'border-radius: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .rt-info-box.icon-el-style-2 .icon-holder span' => 'border-radius: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .rt-info-text-8 .service-box span i'            => 'border-radius: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .rt-info-text-11 .icon-holder span i'           => 'border-radius: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->end_controls_section();


		// Image Settings
		//==============================================================
		/*
		$this->start_controls_section(
			'image_settings',
			[
				'label' => esc_html__( 'Image Settings', 'greenova-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [
					'icon_type' => ['image']
				]
			]
		);

		$this->end_controls_section();
		*/


		// Read More Settings
		//==============================================================
		$this->start_controls_section(
			'read_more_settings',
			[
				'label'     => esc_html__( 'Read More Button Settings', 'greenova-core' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_readmore_btn' => [ 'is-readmore' ],
					'layout!'           => [ 'style6', 'style7' ],
				],
			]
		);

		//Start read_more Style Tab
		$this->start_controls_tabs(
			'read_more_style_tabs'
		);

		//Normal Style
		$this->start_controls_tab(
			'read_more_style_normal_tab',
			[
				'label' => __( 'Normal', 'greenova-core' ),
			]
		);
		$this->add_control(
			'read_more_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'greenova-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-info-box .button-el' => 'color: {{VALUE}} !important',
				],
			]
		);

		$this->add_control(
			'read_more_bg',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Background', 'greenova-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-info-box .button-el' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		//Hover Style
		$this->start_controls_tab(
			'read_more_style_hover_tab',
			[
				'label' => __( 'Hover', 'greenova-core' ),
			]
		);

		$this->add_control(
			'read_more_hover_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color Hover', 'greenova-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-info-box .button-el:hover' => 'color: {{VALUE}} !important',
				],
			]
		);

		$this->add_control(
			'read_more_bg_hover',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Background on Hover', 'greenova-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-info-box .button-el:hover' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'read_more_border_hover',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Border on Hover', 'greenova-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-info-box .button-el:hover' => 'border-color: {{VALUE}}',
				],
			]
		);


		$this->end_controls_tab();

		$this->end_controls_tabs();
		//End read_more Style Tab

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'      => 'read-more-border',
				'label'     => __( 'Border', 'greenova-core' ),
				'selector'  => '{{WRAPPER}} .button-el',
				'separator' => 'before',
			]
		);

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
					'{{WRAPPER}} .rt-info-box .button-el' => 'border-radius: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'readmore_btn_typography',
				'label'    => esc_html__( 'Typography', 'greenova-core' ),
				'selector' => '{{WRAPPER}} .rt-info-box .button-el',
			]
		);

		$this->add_responsive_control(
			'readmore_padding_spacing',
			[
				'label'      => __( 'Read More Padding', 'greenova-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .rt-info-box .button-el' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->end_controls_section();

		// Read More Settings for layout 7
		//==============================================================
		$this->start_controls_section(
			'read_more_settings7',
			[
				'label'     => esc_html__( 'Read More Button Settings', 'greenova-core' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_readmore_btn' => [ 'is-readmore' ],
					'layout'            => [ 'style7' ],
				],
			]
		);

		//Start read_more Style Tab
		$this->start_controls_tabs(
			'read_more_style_tabs7'
		);

		//Normal Style
		$this->start_controls_tab(
			'read_more_style_normal_tab7',
			[
				'label' => __( 'Normal', 'greenova-core' ),
			]
		);
		$this->add_control(
			'read_more_color7',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'greenova-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-info-box .button-el' => 'color: {{VALUE}} !important',
				],
			]
		);

		$this->end_controls_tab();

		//Hover Style
		$this->start_controls_tab(
			'read_more_style_hover_tab7',
			[
				'label' => __( 'Hover', 'greenova-core' ),
			]
		);

		$this->add_control(
			'read_more_hover_color7',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color Hover', 'greenova-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-info-box .button-el:hover' => 'color: {{VALUE}} !important',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();
		//End read_more Style Tab

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

		$this->start_controls_tabs(
			'box_style_tabs'
		);

		$this->start_controls_tab(
			'box_style_normal_tab',
			[
				'label' => __( 'Normal', 'greenova-core' ),
			]
		);

		$this->add_control(
			'box_bg',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Background Color', 'greenova-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-info-text-4'               => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .rt-info-text-6 .service-box'  => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .rt-info-text-7 .service-box'  => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .rt-info-text-8 .service-box'  => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .rt-info-text-11 .service-box' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'box_overlay_bg',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Overlay Color', 'greenova-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-info-text-6 .service-box::after'  => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'layout' => ['style3']
				]
			]
		);

		$this->add_control(
			'box_pattern_bg',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Box Pattern Color', 'greenova-core' ),
				'default'   => '#1fa12e',
				'selectors' => [
					'{{WRAPPER}} .rt-info-text-11 .service-box .svg-pattern' => 'fill: {{VALUE}}',
				],
				'condition' => [
					'layout' => [ 'style7' ],
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'      => 'box_shadow',
				'label'     => __( 'Box Shadow', 'greenova-core' ),
				'selector'  => '{{WRAPPER}} .rt-info-box',
				'condition' => [
					'layout' => [ 'style1', 'style2', 'style3', 'style4' ],
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'box_style_hover_tab',
			[
				'label' => __( 'Hover', 'greenova-core' ),
			]
		);

		$this->add_control(
			'box_bg_hover',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Background Hover', 'greenova-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-info-text-4:hover'               => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .rt-info-text-6 .service-box:hover'  => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .rt-info-text-7 .service-box:hover'  => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .rt-info-text-8 .service-box:hover'  => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .rt-info-text-11 .service-box:hover' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'box_overlay_bg_hover',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Overlay on Color', 'greenova-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-info-text-6 .service-box:hover::after'  => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'layout' => ['style3']
				]
			]
		);

		$this->add_control(
			'box_pattern_bg_hover',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Box Pattern Hover Color', 'greenova-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-info-text-11 .service-box:hover .svg-pattern' => 'fill: {{VALUE}}',
				],
				'condition' => [
					'layout' => [ 'style7' ],
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'      => 'box_shadow_hover',
				'label'     => __( 'Box Shadow Hover', 'greenova-core' ),
				'selector'  => '{{WRAPPER}} .rt-info-box:hover',
				'condition' => [
					'layout' => [ 'style1', 'style2', 'style3', 'style4' ],
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'box_padding',
			[
				'label'      => __( 'Padding', 'greenova-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				//'allowed_dimensions' => 'vertical',
				'separator'  => 'before',
				'selectors'  => [
					'{{WRAPPER}} .rt-info-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
				'condition'  => [
					'layout!' => 'style7',
				],
			]
		);

		$this->add_responsive_control(
			'box_padding7',
			[
				'label'      => __( 'Padding', 'greenova-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				//'allowed_dimensions' => 'vertical',
				'separator'  => 'before',
				'selectors'  => [
					'{{WRAPPER}} .rt-info-text-11 .service-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
				'condition'  => [
					'layout' => 'style7',
				],
			]
		);

		$this->add_responsive_control(
			'box_height',
			[
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Box Height', 'greenova-core' ),
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 200,
						'max'  => 1000,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-info-box' => 'min-height: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'layout' => [ 'style1', 'style3', 'style4' ],
				],
			]
		);

		$this->add_responsive_control(
			'box_radius',
			[
				'label'      => __( 'Border Radius', 'greenova-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				//'allowed_dimensions' => 'vertical',
				'separator'  => 'before',
				'condition'  => [
					'layout' => [ 'style1' ],
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-info-text-4' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
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
		} elseif ( 'style3' == $data['layout'] ) {
			$template = 'view-3';
		} elseif ( 'style4' == $data['layout'] ) {
			$template = 'view-4';
		} elseif ( 'style5' == $data['layout'] ) {
			$template = 'view-5';
		} elseif ( 'style6' == $data['layout'] ) {
			$template = 'view-6';
		} elseif ( 'style7' == $data['layout'] ) {
			$template = 'view-7';
		}

		$this->rt_template( $template, $data );
	}

}