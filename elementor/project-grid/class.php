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

class Project_Grid extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ) {
		$this->rt_name = esc_html__( 'Project Grid', 'greenova-core' );
		$this->rt_base = 'rt-project-grid';

		parent::__construct( $data, $args );
	}

	protected function register_controls() {
		// widget title
		$this->start_controls_section(
			'rt_project_grid',
			[
				'label' => esc_html__( 'Project Grid', 'greenova-core' ),
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
					'style4' => __( 'Style 4 (Isotop)', 'greenova-core' ),
					'style5' => __( 'Style 5', 'greenova-core' ),
					'style6' => __( 'Style 6', 'greenova-core' ),
					'style7' => __( 'Style 7', 'greenova-core' ),
				],

			]
		);

		$this->add_control(
			'gridcolumn-popover-toggle',
			[
				'label'        => __( 'Grid Column', 'greenova-core' ),
				'type'         => \Elementor\Controls_Manager::POPOVER_TOGGLE,
				'label_off'    => __( 'Default', 'greenova-core' ),
				'label_on'     => __( 'Custom', 'greenova-core' ),
				'return_value' => 'yes',
				'condition'    => [
					'layout!' => 'style6',
				],
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
				'default'     => '12',
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
				'options'     => $this->rt_get_categories( 'greenova_project_category' ),
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

		$this->add_control(
			'show_link',
			[
				'label'        => __( 'Show Link', 'greenova-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'greenova-core' ),
				'label_off'    => __( 'Hide', 'greenova-core' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'show_pagination',
			[
				'label'        => __( 'Show Pagination', 'greenova-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'greenova-core' ),
				'label_off'    => __( 'Hide', 'greenova-core' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'show_view_all_btn',
			[
				'label'        => __( 'Show View All Button', 'greenova-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'greenova-core' ),
				'label_off'    => __( 'Hide', 'greenova-core' ),
				'return_value' => 'yes',
				'default'      => false,
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
			'project_thumbnail_size',
			[
				'label'   => esc_html__( 'Img Size', 'greenova-core' ),
				'type'    => Controls_Manager::SELECT,
				'options' => $this->rt_get_all_image_sizes(),
			]
		);

		$this->add_control(
			'thumb_overlay_color',
			[
				'label'     => __( 'Thumb Overlay Color', 'greenova-core' ),
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
				'name'      => 'background',
				'label'     => __( 'Thumb overlay color', 'greenova-core' ),
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .tlp-portfolio .layout1 .tlp-portfolio-item .tlp-portfolio-thum .tlp-overlay, {{WRAPPER}} .project5-box .project5-box-inner .project5-img-holder:after',
				'condition' => [
					'layout' => [ 'style3', 'style4' ],
				],
			]
		);

		$this->add_control(
			'thumbnail_margin',
			[
				'label'      => __( 'Thumbnail Margin', 'greenova-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .rt-owl-carousel-wrapper .thumb-box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .rt-project-gallery-11 .thumb-box'   => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'plus_btn_color',
			[
				'label'     => __( 'Button Color', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-project-slider-one .rtin-projects-box .our-projects-content-holder span' => 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-project-slider-two .our-projects-box2 .our-projects-box2-social i'       => 'color: {{VALUE}}',
				],
				'condition' => [
					'layout' => [ 'style3' ],
				],
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
				'selector' => '{{WRAPPER}} .rt-project-grid-wrapper .project-inner-wrapper .project-title',
			]
		);

		$this->add_control(
			'title_spacing',
			[
				'label'              => __( 'Title Spacing', 'greenova-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'selectors'          => [
					'{{WRAPPER}} .rt-owl-carousel-wrapper .project-box-inner .content-wrapper h3' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'allowed_dimensions' => 'vertical',
				'condition'          => [
					'layout' => [ 'style1', 'style2' ],
				],
			]
		);

		$this->add_control(
			'title_spacing7',
			[
				'label'              => __( 'Title Spacing', 'greenova-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'selectors'          => [
					'{{WRAPPER}} .rt-project-grid-wrapper .project-inner-wrapper .project-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'allowed_dimensions' => 'vertical',
				'condition'          => [
					'layout' => [ 'style7' ],
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
				'label'     => __( 'Title Color', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-project-grid-wrapper .project-inner-wrapper .project-title'                           => 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-project-grid-wrapper .project-inner-wrapper .project-title a'                         => 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-project-grid-wrapper .project5-box .project5-box-inner .rtin-proj5-box-info h3:after' => 'background-color: {{VALUE}}',
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
				'label'     => __( 'Title Hover Color', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-project-grid-wrapper .project-inner-wrapper .project-title:hover'                           => 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-project-grid-wrapper .project-inner-wrapper .project-title a:hover'                         => 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-project-grid-wrapper .project5-box .project5-box-inner .rtin-proj5-box-info h3:hover:after' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();


		//Title Style # 2

		$this->add_control(
			'title_two_heading',
			[
				'label'     => __( 'Title-2 Style:', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'after',
				'classes'   => 'main-heading',
				'condition' => [
					'layout' => [ 'style2', 'style5' ],
				],
			]
		);


		$this->add_control(
			'title_two_visibility',
			[
				'label'     => __( 'Title-2 Visibility', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::CHOOSE,
				'options'   => [
					'visible' => [
						'title' => __( 'Visible', 'greenova-core' ),
						'icon'  => 'fa fa-eye',
					],
					'hidden'  => [
						'title' => __( 'Hidden', 'greenova-core' ),
						'icon'  => 'fa fa-eye-slash',
					],
				],
				'toggle'    => false,
				'default'   => 'visible',
				'condition' => [
					'layout' => [ 'style2', 'style5' ],
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'      => 'title_two_typography',
				'selector'  => '{{WRAPPER}} .rt-project-grid-wrapper .project-inner-wrapper .project-title-two',
				'condition' => [
					'layout'               => [ 'style2', 'style5' ],
					'title_two_visibility' => 'visible',
				],
			]
		);

		$this->add_control(
			'title_two_hover_color',
			[
				'label'     => __( 'Title-2 Color', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-project-grid-wrapper .project-inner-wrapper .project-title-two'   => 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-project-grid-wrapper .project-inner-wrapper .project-title-two a' => 'color: {{VALUE}}',
				],
				'condition' => [
					'layout'               => [ 'style2', 'style5' ],
					'title_two_visibility' => 'visible',
				],
			]
		);

		$this->add_control(
			'title_two_bg_color',
			[
				'label'     => __( 'Title-2 Background Color', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-project-grid-wrapper .project-inner-wrapper .project-title-two' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'layout'               => [ 'style2', 'style5' ],
					'title_two_visibility' => 'visible',
				],
			]
		);

		$this->add_control(
			'title_two_position',
			[
				'label'     => __( 'Title-2 Alignment', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::CHOOSE,
				'options'   => [
					'title-two-left'   => [
						'title' => __( 'Left', 'greenova-core' ),
						'icon'  => 'fa fa-align-left',
					],
					'title-two-center' => [
						'title' => __( 'Center', 'greenova-core' ),
						'icon'  => 'fa fa-align-center',
					],
					'title-two-right'  => [
						'title' => __( 'Right', 'greenova-core' ),
						'icon'  => 'fa fa-align-right',
					],
				],
				'default'   => 'left',
				'toggle'    => false,
				'condition' => [
					'layout'               => [ 'style2', 'style5' ],
					'title_two_visibility' => 'visible',
				],
			]
		);

		$this->end_controls_section();

		//Excerpt Style
		//=============================================================================

		$this->start_controls_section(
			'content_style',
			[
				'label' => __( 'Excerpt Style', 'greenova-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'content_visibility',
			[
				'label'   => __( 'Excerpt Visibility', 'greenova-core' ),
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
				'label'     => __( 'Excerpt Limit', 'greenova-core' ),
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
				'selector'  => '{{WRAPPER}} .rt-project-grid-wrapper .project-inner-wrapper .project-excerpt',
				'condition' => [
					'content_visibility' => 'visible',
				],
			]
		);

		$this->add_control(
			'content_color',
			[
				'label'     => __( 'Excerpt Color', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-project-grid-wrapper .project-inner-wrapper .project-excerpt' => 'color: {{VALUE}}',
				],
				'condition' => [
					'content_visibility' => 'visible',
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
					'{{WRAPPER}} .rt-project-grid-wrapper .project-inner-wrapper .project-excerpt' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'allowed_dimensions' => 'vertical',
				'condition'          => [
					'content_visibility' => 'visible',
				],
			]
		);

		$this->end_controls_section();

		//Read More Style
		//=============================================================================

		$this->start_controls_section(
			'readmore_style',
			[
				'label'     => __( 'Read More Style', 'greenova-core' ),
				'tab'       => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'layout!' => [ 'style3', 'style4' ],
				],
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

		$this->add_control(
			'readmore_text',
			[
				'label'       => __( 'Button Text', 'greenova-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => __( 'Read More', 'greenova-core' ),
				'placeholder' => __( 'Type your title here', 'greenova-core' ),
				'condition'   => [
					'readmore_visibility' => [ 'visible' ],
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'      => 'readmore_typography',
				'selector'  => '{{WRAPPER}} .rt-project-grid-wrapper .read-more-btn',
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
					'{{WRAPPER}} .rt-project-grid-wrapper .read-more-btn'       => 'color: {{VALUE}} !important',
					'{{WRAPPER}} .rt-project-grid-wrapper .read-more-btn a'     => 'color: {{VALUE}} !important',
					'{{WRAPPER}} .rt-project-gallery-11 .project-button:before' => 'color: {{VALUE}} !important',
				],
			]
		);

		$this->add_control(
			'readmore_bg',
			[
				'label'     => __( 'Background Color', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-project-grid-wrapper .read-more-btn' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'layout!' => 'style7',
				],
			]
		);

		$this->add_control(
			'readmore_border',
			[
				'label'     => __( 'Border Color', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-project-grid-wrapper .read-more-btn' => 'border-color: {{VALUE}}',
				],
				'condition' => [
					'layout!' => 'style7',
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
					'{{WRAPPER}} .rt-project-grid-wrapper .read-more-btn:hover'          => 'color: {{VALUE}} !important',
					'{{WRAPPER}} .rt-project-grid-wrapper .read-more-btn:hover a'        => 'color: {{VALUE}} !important',
					'{{WRAPPER}} .rt-project-grid-wrapper .project-button:hover::before' => 'color: {{VALUE}} !important',
				],
			]
		);

		$this->add_control(
			'readmore_bg_hover',
			[
				'label'     => __( 'Background Color hover', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-project-grid-wrapper .read-more-btn:hover' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'layout!' => 'style7',
				],
			]
		);

		$this->add_control(
			'readmore_border_hover',
			[
				'label'     => __( 'Border Color Hover', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-project-grid-wrapper .read-more-btn:hover' => 'border-color: {{VALUE}}',
				],
				'condition' => [
					'layout!' => 'style7',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		// Pagination Settings
		//=============================================
		$this->start_controls_section(
			'pagination_style',
			[
				'label'     => __( 'Pagination Style', 'greenova-core' ),
				'tab'       => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_pagination' => 'yes',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'pagination_typography',
				'selector' => '{{WRAPPER}} .pagination-area ul li a',
			]
		);

		$this->add_control(
			'pagination_border_radius',
			[
				'label'      => __( 'Border Radius', 'greenova-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .pagination-area ul li a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);


		$this->start_controls_tabs(
			'pagination_style_tabs'
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
				'label'     => __( 'Font Color', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pagination-area ul li a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'pagination_bg',
			[
				'label'     => __( 'Background Color', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pagination-area ul li a' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'pagination_style_hover_tab',
			[
				'label' => __( 'Hover', 'greenova-core' ),
			]
		);

		$this->add_control(
			'pagination_color_hover',
			[
				'label'     => __( 'Font Color hover/active', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pagination-area ul li a:hover'  => 'color: {{VALUE}}',
					'{{WRAPPER}} .pagination-area ul li.active a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'pagination_bg_hover',
			[
				'label'     => __( 'Background Color hover/active', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pagination-area ul li a:hover'  => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .pagination-area ul li.active a' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		// View All Button Settings
		//=============================================
		$this->start_controls_section(
			'view_all_btn_style',
			[
				'label'     => __( 'View All Button Style', 'greenova-core' ),
				'tab'       => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_view_all_btn' => 'yes',
				],
			]
		);

		$this->add_control(
			'view_all_btn_text',
			[
				'label'       => __( 'Button Text', 'greenova-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => __( 'View All', 'greenova-core' ),
				'placeholder' => __( 'Type your title here', 'greenova-core' ),
			]
		);

		$this->add_control(
			'view_all_btn_url',
			[
				'label'         => __( 'Button Link', 'greenova-core' ),
				'type'          => \Elementor\Controls_Manager::URL,
				'placeholder'   => __( 'https://your-link.com', 'greenova-core' ),
				'show_external' => true,
				'default'       => [
					'url'         => '#',
					'is_external' => true,
					'nofollow'    => true,
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'view_all_btn_typography',
				'selector' => '{{WRAPPER}} .rt-grid-fill-btn .grid-fill-btn',
			]
		);

		$this->add_control(
			'view_all_btn_border_radius',
			[
				'label'      => __( 'Border Radius', 'greenova-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .rt-grid-fill-btn .grid-fill-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);


		$this->start_controls_tabs(
			'view_all_btn_style_tabs'
		);

		$this->start_controls_tab(
			'view_all_btn_style_normal_tab',
			[
				'label' => __( 'Normal', 'greenova-core' ),
			]
		);

		$this->add_control(
			'view_all_btn_color',
			[
				'label'     => __( 'Font Color', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-grid-fill-btn .grid-fill-btn'         => 'color: {{VALUE}} !important',
					'{{WRAPPER}} .rt-grid-fill-btn .grid-fill-btn::before' => 'color: {{VALUE}} !important',
				],
			]
		);

		$this->add_control(
			'view_all_btn_bg',
			[
				'label'     => __( 'Background Color', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-grid-fill-btn .grid-fill-btn' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'view_all_btn_border',
			[
				'label'     => __( 'Border Color', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-grid-fill-btn .grid-fill-btn' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'view_all_btn_style_hover_tab',
			[
				'label' => __( 'Hover', 'greenova-core' ),
			]
		);

		$this->add_control(
			'view_all_btn_color_hover',
			[
				'label'     => __( 'Font Color hover', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-grid-fill-btn .grid-fill-btn:hover'         => 'color: {{VALUE}} !important',
					'{{WRAPPER}} .rt-grid-fill-btn .grid-fill-btn:hover::before' => 'color: {{VALUE}} !important',
				],
			]
		);

		$this->add_control(
			'view_all_btn_bg_hover',
			[
				'label'     => __( 'Background Color hover', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-grid-fill-btn .grid-fill-btn:hover' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'view_all_btn_border_hover',
			[
				'label'     => __( 'Border Color hover', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-grid-fill-btn .grid-fill-btn:hover' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();


		// Filter Button
		//=============================================
		$this->start_controls_section(
			'filter_settings',
			[
				'label' => __( 'Filter Style', 'greenova-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'layout' => 'style4'
				]
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'filter_btn_typography',
				'selector' => '{{WRAPPER}} .rt-portfolio-tab.isotop-classes-tab a',
			]
		);

		$this->add_responsive_control(
			'filter_btn_padding',
			[
				'label'      => __( 'Button Padding', 'greenova-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .rt-portfolio-tab.isotop-classes-tab a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs(
			'filter_btn_style_tabs'
		);

		$this->start_controls_tab(
			'filter_btn_style_normal_tab',
			[
				'label' => __( 'Normal', 'greenova-core' ),
			]
		);

		$this->add_control(
			'filter_btn_color',
			[
				'label'     => __( 'Font Color', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-portfolio-tab.isotop-classes-tab a'         => 'color: {{VALUE}} !important',
				],
			]
		);

		$this->add_control(
			'filter_btn_bg',
			[
				'label'     => __( 'Background Color', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-portfolio-tab.isotop-classes-tab a' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'filter_btn_style_hover_tab',
			[
				'label' => __( 'Hover', 'greenova-core' ),
			]
		);

		$this->add_control(
			'filter_btn_color_hover',
			[
				'label'     => __( 'Font Color hover', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-portfolio-tab.isotop-classes-tab a:hover'         => 'color: {{VALUE}} !important',
					'{{WRAPPER}} .rt-portfolio-tab.isotop-classes-tab a.current'         => 'color: {{VALUE}} !important',
				],
			]
		);

		$this->add_control(
			'filter_btn_bg_hover',
			[
				'label'     => __( 'Background Color hover', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-portfolio-tab.isotop-classes-tab a:hover' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .rt-portfolio-tab.isotop-classes-tab a.current' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();


		// Box Settings
		//=============================================
		$this->start_controls_section(
			'box_style',
			[
				'label' => __( 'Box Style', 'greenova-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'content_box_style',
			[
				'label'     => __( 'Content Box Background', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'after',
				'classes'   => 'main-heading',
				'condition' => [
					'layout!' => [ 'style3', 'style4' ],
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name'      => 'content_box_bg',
				'label'     => __( 'Background', 'greenova-core' ),
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .project9-box .rt-portfolio-item .rt-content, {{WRAPPER}} .project10-box-inner .rtin-proj10-box-info, {{WRAPPER}}  .project9-box .rt-portfolio-item .rt-content, {{WRAPPER}} .project10-box-inner .rtin-proj10-box-info, {{WRAPPER}} .rtin-proj6-box-info-2:before, {{WRAPPER}} .rt-project-gallery-4 .project4-content',
				'condition' => [
					'layout!' => [ 'style3', 'style4' ],
				],
			]
		);

		$this->add_control(
			'box_border_title',
			[
				'label' => __( 'Box Border', 'greenova-core' ),
				'type'  => \Elementor\Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'border_radius',
			[
				'label'      => __( 'Border Radius', 'greenova-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .project9-box .rt-portfolio-item'                                                                => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .project10-box-inner .project10-img-holder'                                                      => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .project10-box-inner .rtin-proj10-box-info'                                                      => 'border-radius: {{TOP}}{{UNIT}} 0 0 {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .tlp-portfolio .layout1 .tlp-portfolio-thum'                                                     => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .project5-box .project5-box-inner'                                                               => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .project6-box .project6-box-inner .project6-img-holder img'                                      => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .rtin-proj6-box-info-2:before'                                                                   => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .rtin-proj6-box-info-1:before'                                                                   => 'border-radius: 5px 5px {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .rt-project-gallery-4 .project4-content, {{WRAPPER}} .rt-project-gallery-4 .project4-img-holder' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'item_wrapper_padding',
			[
				'label'      => __( 'Wrapper Padding', 'greenova-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .project9-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'layout' => [ 'style1' ],
				],
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
		} elseif ( 'style7' == $data['layout'] ) {
			$template = 'view-7';
		}


		$this->rt_template( $template, $data );
	}

}