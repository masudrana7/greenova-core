<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Greenova_Core;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use \WP_Query;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Team_Grid extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ) {
		$this->rt_name = esc_html__( 'Team Grid', 'greenova-core' );
		$this->rt_base = 'rt-team-grid';

		parent::__construct( $data, $args );
	}

	protected function register_controls() {
		// widget title
		$this->start_controls_section(
			'rt_team_grid',
			[
				'label' => esc_html__( 'Team Grid', 'greenova-core' ),
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
					'style5' => __( 'Style 5', 'greenova-core' ),
					'style6' => __( 'Style 6', 'greenova-core' ),
				],

			]
		);

		// $this->add_responsive_control(
		// 	'grid_column',
		// 	[
		// 		'label'   => esc_html__( 'Column', 'greenova-core' ),
		// 		'type'    => Controls_Manager::SELECT,
		// 		'default' => '3',
		// 		'options' => [
		// 			'3' => __( '4 Columns', 'greenova-core' ),
		// 			'4' => __( '3 Columns', 'greenova-core' ),
		// 			'6' => __( '2 Columns', 'greenova-core' ),
		// 			'12' => __( '1 Columns', 'greenova-core' ),
		// 		],
		// 	]
		// );

		$this->add_control(
			'gridcolumn-popover-toggle',
			[
				'label'        => __( 'Grid Column', 'greenova-core' ),
				'type'         => \Elementor\Controls_Manager::POPOVER_TOGGLE,
				'label_off'    => __( 'Default', 'greenova-core' ),
				'label_on'     => __( 'Custom', 'greenova-core' ),
				'return_value' => 'yes',
			]
		);

		$this->start_popover();

		$this->add_control(
			'gird_column_desktop',
			[
				'label'   => esc_html__( 'Grid Column for Desktop', 'greenova-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '4',
				'options' => [
					'3'  => __( '4 Columns', 'greenova-core' ),
					'4'  => __( '3 Columns', 'greenova-core' ),
					'6'  => __( '2 Columns', 'greenova-core' ),
					'12' => __( '1 Columns', 'greenova-core' ),
				],

			]
		);

		$this->add_control(
			'gird_column_tab',
			[
				'label'   => esc_html__( 'Grid Column for Tab', 'greenova-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '6',
				'options' => [
					'3'  => __( '4 Columns', 'greenova-core' ),
					'4'  => __( '3 Columns', 'greenova-core' ),
					'6'  => __( '2 Columns', 'greenova-core' ),
					'12' => __( '1 Columns', 'greenova-core' ),
				],

			]
		);

		$this->add_control(
			'gird_column_mobile',
			[
				'label'   => esc_html__( 'Grid Column for Mobile', 'greenova-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '12',
				'options' => [
					'3'  => __( '4 Columns', 'greenova-core' ),
					'4'  => __( '3 Columns', 'greenova-core' ),
					'6'  => __( '2 Columns', 'greenova-core' ),
					'12' => __( '1 Columns', 'greenova-core' ),
				],

			]
		);

		$this->end_popover();

		$this->add_control(
			'post_limit',
			[
				'label'       => __( 'Post Limit', 'greenova-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __( 'Enter Post Limit', 'greenova-core' ),
				'description' => __( 'Enter number of post to show.', 'greenova-core' ),
				'default'     => '8',
			]
		);

		$this->add_control(
			'post_source',
			[
				'label'       => __( 'Post Source', 'greenova-core' ),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'options'     => [
					'most_recent' => __( 'From all recent post', 'greenova-core' ),
					'by_category' => __( 'By Category', 'greenova-core' ),
					'by_id'       => __( 'By Post ID', 'greenova-core' ),
				],
				'default'     => [ 'most_recent' ],
				'description' => __( 'Select posts source that you like to show.', 'greenova-core' ),
			]
		);

		$this->add_control(
			'taxonomies',
			[
				'label'       => __( 'Choose Categories', 'greenova-core' ),
				'type'        => \Elementor\Controls_Manager::SELECT2,
				'multiple'    => true,
				'options'     => $this->rt_get_categories( 'greenova_testimonial_category' ),
				'label_block' => true,
				'condition'   => [
					'post_source' => 'by_category',
				],
				'description' => __( 'Select post category\'s.', 'greenova-core' ),
			]
		);

		$this->add_control(
			'post_id',
			[
				'label'       => __( 'Enter post IDs', 'greenova-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'description' => __( 'Enter the post IDs separated by comma', 'greenova-core' ),
				'label_block' => 'true',
				'condition'   => [
					'post_source' => 'by_id',
				],
			]
		);

		$this->add_control(
			'offset',
			[
				'label'       => __( 'Post offset', 'greenova-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __( 'Enter Post offset', 'greenova-core' ),
				'description' => __( 'Number of post to displace or pass over. The offset parameter is ignored when post limit => -1 (show all posts) is used.', 'greenova-core' ),
			]
		);

		$this->add_control(
			'exclude',
			[
				'label'       => __( 'Exclude posts', 'greenova-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'label_block' => 'true',
				'description' => __( 'Enter the post IDs separated by comma for exclude', 'greenova-core' ),
			]
		);

		$this->add_control(
			'orderby',
			[
				'label'   => __( 'Order by', 'greenova-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'date'           => __( 'Date', 'greenova-core' ),
					'ID'             => __( 'Order by post ID', 'greenova-core' ),
					'author'         => __( 'Author', 'greenova-core' ),
					'title'          => __( 'Title', 'greenova-core' ),
					'modified'       => __( 'Last modified date', 'greenova-core' ),
					'parent'         => __( 'Post parent ID', 'greenova-core' ),
					'comment_count'  => __( 'Number of comments', 'greenova-core' ),
					'menu_order'     => __( 'Menu order', 'greenova-core' ),
					'meta_value'     => __( 'Meta value', 'greenova-core' ),
					'meta_value_num' => __( 'Meta value number', 'greenova-core' ),
					'rand'           => __( 'Random order', 'greenova-core' ),
				],
			]
		);

		$this->add_control(
			'order',
			[
				'label'   => __( 'Sort order', 'greenova-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'ASC'  => __( 'ASC', 'greenova-core' ),
					'DESC' => __( 'DESC', 'greenova-core' ),
				],
			]
		);

		$this->end_controls_section();

		// Thumbnail style
		$this->start_controls_section(
			'thumbnail_style',
			[
				'label' => __( 'Thumbnail Style', 'greenova-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);


		$this->add_control(
			'thumbnail_size',
			[
				'label'   => esc_html__( 'Img Size', 'greenova-core' ),
				'type'    => Controls_Manager::SELECT,
				'options' => $this->rt_get_all_image_sizes(),
			]
		);

		$this->add_responsive_control(
			'thumbnail_spacing',
			[
				'label'      => __( 'Bottom Spacing', 'greenova-core' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .rtin-single-team .team-img-wrapper' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
			]
		);

		$this->add_responsive_control(
			'thumbnail_border_radius',
			[
				'label'      => __( 'Border Radius', 'greenova-core' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ '%', 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .rtin-single-team .team-img-wrapper img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
					'{{WRAPPER}} .rtin-single-team .team-img-wrapper'     => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_control(
			'thumb_overlay_colov',
			[
				'label'     => __( 'Thumb Overlay Color', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'layout' => [ 'style2', 'style3', 'style5' ],
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name'      => 'thumb_overlay',
				'label'     => __( 'Thumb overlay color', 'greenova-core' ),
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .rt-team-slider-ten .rtin-single-team .rtin-team-picture:after, {{WRAPPER}} .rt-team-slider-eleven .rtin-single-team .rtin-team-picture .overlay',
				'condition' => [
					'layout' => [ 'style2', 'style3', 'style5' ],
				],
			]
		);


		$this->start_controls_tabs(
			'thumbnail_style_tabs'
		);

		$this->start_controls_tab(
			'thumbnail_style_normal_tab',
			[
				'label' => __( 'Normal', 'greenova-core' ),
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'img_border',
				'label'    => __( 'Border', 'greenova-core' ),
				'selector' => '{{WRAPPER}} .rtin-single-team .team-img-wrapper img',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'thumbnail_style_hover_tab',
			[
				'label' => __( 'Hover', 'greenova-core' ),
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'img_border_hover',
				'label'    => __( 'Border', 'greenova-core' ),
				'selector' => '{{WRAPPER}} .rtin-single-team:hover .team-img-wrapper img',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'thumbnail_bottom_arrow_color',
			[
				'label'     => __( 'Bottom Arrow Color', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .rt-team-slider-ten .rtin-single-team .rtin-team-picture:before' => 'border-bottom-color: {{VALUE}}',
				],
				'condition' => [
					'layout' => [ 'style2' ],
				],
			]
		);

		$this->add_control(
			'details_btn',
			[
				'label'     => __( 'Details Button Settings', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'layout' => [ 'style3' ],
				],
			]
		);

		$this->start_controls_tabs(
			'details_btn_style_tabs', [
				'condition' => [
					'layout' => [ 'style3' ],
				],
			]
		);

		$this->start_controls_tab(
			'details_btn_style_normal_tab',
			[
				'label' => __( 'Normal', 'greenova-core' ),
			]
		);

		$this->add_control(
			'details_btn_color',
			[
				'label'     => __( 'Button Color', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-team-slider-eleven .rtin-single-team .rtin-team-picture .detail-button a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'details_btn_bg',
			[
				'label'     => __( 'Button Background', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-team-slider-eleven .rtin-single-team .rtin-team-picture .detail-button a' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'details_btn_border',
			[
				'label'     => __( 'Button Border', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-team-slider-eleven .rtin-single-team .rtin-team-picture .detail-button a' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'details_btn_style_hover_tab',
			[
				'label' => __( 'Hover', 'greenova-core' ),
			]
		);

		$this->add_control(
			'details_btn_color_hover',
			[
				'label'     => __( 'Button Color Hover', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-team-slider-eleven .rtin-single-team .rtin-team-picture .detail-button a:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'details_btn_bg_hover',
			[
				'label'     => __( 'Button Background Hover', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-team-slider-eleven .rtin-single-team .rtin-team-picture .detail-button a:hover' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'details_btn_border_hover',
			[
				'label'     => __( 'Button Border Hover', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-team-slider-eleven .rtin-single-team .rtin-team-picture .detail-button a:hover' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();


		// Title Settings
		//=====================================================================
		$this->start_controls_section(
			'title_style',
			[
				'label' => __( 'Title / Name Style', 'greenova-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);


		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'selector' => '{{WRAPPER}} .rtin-single-team .team-content-wrapper h3 a',
			]
		);

		$this->add_responsive_control(
			'title_spacing',
			[
				'label'      => __( 'Bottom Spacing', 'greenova-core' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .rtin-single-team .team-content-wrapper h3' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
			]
		);


		$this->start_controls_tabs(
			'title_style_tabs'
		);

		$this->start_controls_tab(
			'title_normal_tab',
			[
				'label' => __( 'Normal', 'greenova-core' ),
			]
		);


		$this->add_control(
			'title_color',
			[
				'label'     => __( 'Title / Name Color', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rtin-single-team .team-content-wrapper h3 a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'title_hover_tab',
			[
				'label' => __( 'Hover', 'greenova-core' ),
			]
		);

		$this->add_control(
			'title_hover_color',
			[
				'label'     => __( 'Title / Name Hover Color', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rtin-single-team .team-content-wrapper h3 a:hover' => 'color: {{VALUE}} !important',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'title_box_hover_tab',
			[
				'label' => __( 'Box Hover', 'greenova-core' ),
			]
		);

		$this->add_control(
			'title_box_hover_color',
			[
				'label'     => __( 'Title / Name on Box Hover', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rtin-single-team:hover .team-content-wrapper h3 a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();


		$this->end_controls_section();

		// Designation Settings
		// ================================================================
		$this->start_controls_section(
			'designation_style',
			[
				'label' => __( 'Designation Style', 'greenova-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'designation_visibility',
			[
				'label'   => __( 'Content Visibility', 'greenova-core' ),
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
				'name'      => 'designation_typography',
				'selector'  => '{{WRAPPER}} .rtin-single-team .team-content-wrapper .designation',
				'condition' => [
					'designation_visibility' => 'visible',
				],
			]
		);

		$this->add_responsive_control(
			'designation_spacing',
			[
				'label'      => __( 'Bottom Spacing', 'greenova-core' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .rtin-single-team .team-content-wrapper .designation' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'designation_visibility' => 'visible',
				],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
			]
		);


		$this->start_controls_tabs(
			'designation_style_tabs', [
				'condition' => [
					'designation_visibility' => 'visible',
				],
			]
		);

		$this->start_controls_tab(
			'designation_normal_tab',
			[
				'label' => __( 'Normal', 'greenova-core' ),
			]
		);


		$this->add_control(
			'designation_color',
			[
				'label'     => __( 'Designation Color', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rtin-single-team .team-content-wrapper .designation' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'designation_box_hover_tab',
			[
				'label' => __( 'Box Hover', 'greenova-core' ),
			]
		);

		$this->add_control(
			'designation_box_hover_color',
			[
				'label'     => __( 'Designation on Box Hover', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rtin-single-team:hover .team-content-wrapper .designation' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();


		$this->end_controls_section();

		// Content Settings
		//=====================================================================

		$this->start_controls_section(
			'content_style',
			[
				'label' => __( 'Content Style', 'greenova-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'content_visibility',
			[
				'label'   => __( 'Content Visibility', 'greenova-core' ),
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


		$this->add_control(
			'content_limit',
			[
				'label'     => __( 'Content Limit', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'default'   => '15',
				'condition' => [
					'content_visibility' => 'visible',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'      => 'content_typography',
				'selector'  => '{{WRAPPER}} .rtin-single-team .team-content-wrapper .team-content',
				'condition' => [
					'content_visibility' => 'visible',
				],
			]
		);

		$this->add_responsive_control(
			'content_spacing',
			[
				'label'      => __( 'Bottom Spacing', 'greenova-core' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .rtin-single-team .team-content-wrapper .team-content' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'content_visibility' => 'visible',
				],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
			]
		);


		$this->start_controls_tabs(
			'content_style_tabs', [
				'condition' => [
					'content_visibility' => 'visible',
				],
			]
		);

		$this->start_controls_tab(
			'content_normal_tab',
			[
				'label' => __( 'Normal', 'greenova-core' ),
			]
		);


		$this->add_control(
			'content_color',
			[
				'label'     => __( 'Content Color', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rtin-single-team .team-content-wrapper .team-content' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'content_box_hover_tab',
			[
				'label' => __( 'Box Hover', 'greenova-core' ),
			]
		);

		$this->add_control(
			'content_box_hover_color',
			[
				'label'     => __( 'Color on Box Hover', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rtin-single-team:hover .team-content-wrapper .team-content' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		// Social Settings
		//=====================================================================

		$this->start_controls_section(
			'social_style',
			[
				'label' => __( 'Social Icon Style', 'greenova-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'social_icon_visibility',
			[
				'label'   => __( 'Social Icon Visibility', 'greenova-core' ),
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

		$this->start_controls_tabs(
			'social_icon_style_tabs', [
				'condition' => [
					'social_icon_visibility' => 'visible',
				],
			]
		);

		$this->start_controls_tab(
			'social_icon_style_normal_tab',
			[
				'label' => __( 'Normal', 'greenova-core' ),
			]
		);

		$this->add_control(
			'social_icon_color',
			[
				'label'     => __( 'Icon Color', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rtin-single-team .team-social-icon-wrapper a' => 'color: {{VALUE}}',
				],
				'condition' => [
					'social_icon_visibility' => 'visible',
				],
			]
		);

		$this->add_control(
			'social_icon_bg',
			[
				'label'     => __( 'Icon Background', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rtin-single-team .team-social-icon-wrapper a' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .rt-team-grid-6 .rtin-single-team .rtin-team-social' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'social_icon_visibility' => 'visible',
				],
			]
		);

		$this->add_control(
			'social_icon_border',
			[
				'label'     => __( 'Icon Border', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rtin-single-team .team-social-icon-wrapper a' => 'border-color: {{VALUE}}',
				],
				'condition' => [
					'social_icon_visibility' => 'visible',
					'layout'                 => [ 'style1', 'style2', 'style3', 'style5' ],
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'social_icon_style_hover_tab',
			[
				'label' => __( 'Hover', 'greenova-core' ),
			]
		);

		$this->add_control(
			'social_icon_color_hover',
			[
				'label'     => __( 'Icon Color Hover', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rtin-single-team .team-social-icon-wrapper a:hover' => 'color: {{VALUE}}',
				],
				'condition' => [
					'social_icon_visibility' => 'visible',
				],
			]
		);

		$this->add_control(
			'social_icon_bg_hover',
			[
				'label'     => __( 'Icon Background Hover', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rtin-single-team .team-social-icon-wrapper a:hover' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'social_icon_visibility' => 'visible',
				],
			]
		);

		$this->add_control(
			'social_icon_border_hover',
			[
				'label'     => __( 'Icon Border Hover', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rtin-single-team .team-social-icon-wrapper a:hover' => 'border-color: {{VALUE}}',
				],
				'condition' => [
					'social_icon_visibility' => 'visible',
					'layout'                 => [ 'style1', 'style2', 'style3', 'style5' ],
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'social_icon_radius',
			[
				'label'      => __( 'Icon Border Radius', 'greenova-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rtin-single-team .team-social-icon-wrapper a' => 'border-radius: {{SIZE}}{{UNIT}}',
				],
				'condition'  => [
					'social_icon_visibility' => 'visible',
				],
			]
		);

		$this->add_control(
			'social_icon_size',
			[
				'label'      => __( 'Icon Size', 'greenova-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 15,
						'max'  => 60,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rtin-single-team .team-social-icon-wrapper a'      => 'font-size: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .rt-team-slider-eleven .rtin-team-social ul li a i' => 'font-size: {{SIZE}}{{UNIT}} !important',
				],
				'condition'  => [
					'social_icon_visibility' => 'visible',
				],
			]
		);

		$this->add_control(
			'social_icon_width_height',
			[
				'label'      => __( 'Icon Width & Height', 'greenova-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 40,
						'max'  => 100,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rtin-single-team .team-social-icon-wrapper a' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}}',
				],
				'condition'  => [
					'social_icon_visibility' => 'visible',
				],
			]
		);

		$this->add_control(
			'social_icon_margin',
			[
				'label'      => __( 'Margin', 'greenova-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .rtin-single-team .team-social-icon-wrapper a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'  => [
					'social_icon_visibility' => 'visible',
				],
			]
		);

		$this->end_controls_section();


		// Pagination Settings
		//=====================================================================

		$this->start_controls_section(
			'pagination_style',
			[
				'label' => __( 'Pagination Style', 'greenova-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'pagination_visibility',
			[
				'label'   => __( 'Pagination Visibility', 'greenova-core' ),
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

		$this->start_controls_tabs(
			'pagination_style_tabs', [
				'condition' => [
					'pagination_visibility' => 'visible',
				],
			]
		);

		$this->start_controls_tab(
			'pagination_style_normal_tab',
			[
				'label' => __( 'Normal', 'greenova-core' ),
			]
		);

		$this->add_control(
			'pagination_color',
			[
				'label'     => __( 'Color', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pagination-wrapper .pagination-area a' => 'color: {{VALUE}}',
				],
				'condition' => [
					'pagination_visibility' => 'visible',
				],
			]
		);

		$this->add_control(
			'pagination_bg',
			[
				'label'     => __( 'Background', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pagination-wrapper .pagination-area a' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'pagination_visibility' => 'visible',
				],
			]
		);

		$this->add_control(
			'pagination_box_bg',
			[
				'label'     => __( 'Background', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pagination-wrapper .pagination-area' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'pagination_visibility' => 'visible',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'pagination_style_hover_tab',
			[
				'label' => __( 'Hover / Active', 'greenova-core' ),
			]
		);

		$this->add_control(
			'pagination_color_hover',
			[
				'label'     => __( 'Color Hover', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pagination-wrapper .pagination-area a:hover'   => 'color: {{VALUE}}',
					'{{WRAPPER}} .pagination-wrapper .pagination-area .active a' => 'color: {{VALUE}}',
				],
				'condition' => [
					'pagination_visibility' => 'visible',
				],
			]
		);

		$this->add_control(
			'pagination_bg_hover',
			[
				'label'     => __( 'Background Hover', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pagination-wrapper .pagination-area a:hover'   => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .pagination-wrapper .pagination-area .active a' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'pagination_visibility' => 'visible',
				],
			]
		);

		$this->add_control(
			'pagination_box_bg_hover',
			[
				'label'     => __( 'Background Hover', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pagination-wrapper .pagination-area:hover' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'pagination_visibility' => 'visible',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'pagination_radius',
			[
				'label'      => __( 'Border Radius', 'greenova-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .pagination-wrapper .pagination-area a' => 'border-radius: {{SIZE}}{{UNIT}}',
				],
				'condition'  => [
					'pagination_visibility' => 'visible',
				],
			]
		);

		$this->add_control(
			'pagination_size',
			[
				'label'      => __( 'Font Size', 'greenova-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 15,
						'max'  => 60,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .pagination-wrapper .pagination-area a' => 'font-size: {{SIZE}}{{UNIT}}',
				],
				'condition'  => [
					'pagination_visibility' => 'visible',
				],
			]
		);

		$this->add_control(
			'pagination_padding',
			[
				'label'      => __( 'Padding', 'greenova-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .pagination-wrapper .pagination-area a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'  => [
					'pagination_visibility' => 'visible',
				],
			]
		);

		$this->add_control(
			'pagination_margin',
			[
				'label'      => __( 'Margin', 'greenova-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .pagination-wrapper .pagination-area a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'  => [
					'pagination_visibility' => 'visible',
				],
			]
		);

		$this->add_control(
			'pagination_text_align',
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
					'{{WRAPPER}} .pagination-wrapper .pagination-area ul' => 'text-align: {{VALUE}};',
				],
				'default'   => 'center',
				'toggle'    => true,
			]
		);


		$this->end_controls_section();


		// Box Settings
		//==================================================================
		$this->start_controls_section(
			'box_style',
			[
				'label' => __( 'Box Style', 'greenova-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
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

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name'     => 'box_background',
				'label'    => __( 'Box Background', 'greenova-core' ),
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .rtin-single-team',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'box_style_hover_tab',
			[
				'label' => __( 'Hover', 'greenova-core' ),
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name'     => 'box_background_hover',
				'label'    => __( 'Box Background Hover', 'greenova-core' ),
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .rtin-single-team:hover',
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control(
			'box_padding',
			[
				'label'      => __( 'Box Padding', 'greenova-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .rtin-single-team' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'box_border_radius',
			[
				'label'      => __( 'Box Border Radius', 'greenova-core' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .rtin-single-team' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'box_border',
				'label'    => __( 'Box Border', 'greenova-core' ),
				'selector' => '{{WRAPPER}} .rtin-single-team',
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$data = $this->get_settings();

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
		}

		$this->rt_template( $template, $data );
	}

}