<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Greenova_Core;

use Elementor\Plugin;
use radiustheme\Greenova\Helper;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

require_once GREENOVA_CORE_BASE_DIR . '/elementor/controls/traits-icons.php';
require_once __DIR__ . '/extend-widget.php';

class Custom_Widget_Init {

	public function __construct() {
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'init' ] );
		add_action( 'elementor/elements/categories_registered', [ $this, 'widget_categoty' ] );
		add_action( 'elementor/editor/after_enqueue_styles', [ $this, 'editor_style' ] );
		add_action( 'elementor/icons_manager/additional_tabs', [ $this, 'flaticon_tab' ] );
		add_action( "elementor/frontend/after_enqueue_scripts", [ $this, 'rt_load_scripts' ] );
	}

	//load frontend script
	public function rt_load_scripts() {
		wp_enqueue_style( 'owl-carousel' );
		wp_enqueue_style( 'owl-theme-default' );
		wp_enqueue_script( 'owl-carousel' );
		wp_enqueue_script( 'rt-waypoints' );
		wp_enqueue_script( 'counterup' );
		// wp_enqueue_script( 'swiper' );
		wp_enqueue_script( 'elementor-script', GREENOVA_CORE_BASE_URL . 'elementor/assets/scripts.js', [ 'jquery' ], GREENOVA_CORE, true );
	}

	public function editor_style() {
		$img = plugins_url( 'icon.png', __FILE__ );
		wp_enqueue_style( 'flaticon' );
		wp_add_inline_style( 'elementor-editor', '.elementor-element .icon .rdtheme-el-custom{content: url(' . $img . ');width: 28px;}' );
		wp_add_inline_style( 'elementor-editor', '.elementor-panel .select2-container {min-width: 100px !important; min-height: 30px !important;}' );
		wp_add_inline_style( 'elementor-editor', '.elementor-control-nav_style_tabs .elementor-control-content {color: #222222 !important;}' );
		wp_add_inline_style( 'elementor-editor', '.elementor-control.elementor-control-type-heading.main-heading .elementor-control-title {color: #93013d !important;}' );
	}

	public function init() {
		require_once __DIR__ . '/base.php';
		// Widgets -- dirname => classname /@dev
		$widgets = [
			'rt-slider'       => 'RT_Slider',
			'title'           => 'Title',
			'cta'             => 'CTA',
			'counter'         => 'Counter',
			'info-box'        => 'Info_Box',
			'testimonial'     => 'Testimonial_Carousel',
			'team-slider'     => 'Team_Carousel',
			'team-grid'       => 'Team_Grid',
			'project-slider'  => 'Project_Slider',
			'project-grid'    => 'Project_Grid',
			'post-slider'     => 'Post_Slider',
			'post-grid'       => 'Post_Grid',
			'service-grid'    => 'Service_Grid',
			'pricing-box'     => 'Pricing_Box',
			'about-block'     => 'About_block',
			'opening-hour'    => 'Opening_Hour',
			'contact'         => 'Contact_Block',
			'quick-contact'   => 'Quick_Contact',
			'progress-bar'    => 'Progress_Bar',
			'text-with-btn'   => 'Text_With_btn',
			'text-with-video' => 'Text_With_Video',
			'before-after'    => 'Before_After',
			'history-box'     => 'History_Box',
			'dual-image'      => 'Dual_Image',
			'video-box'       => 'Video_Box',
			'image-carousel'  => 'RT_Image_Carousel',
		];

		foreach ( $widgets as $dirname => $class ) {
			$template_name = '/elementor-custom/' . $dirname . '/class.php';
			if ( file_exists( get_stylesheet_directory() . $template_name ) ) {
				$file = get_stylesheet_directory() . $template_name;
			} elseif ( file_exists( TEMPLATEPATH . $template_name ) ) {
				$file = TEMPLATEPATH . $template_name;
			} else {
				$file = __DIR__ . '/' . $dirname . '/class.php';
			}

			require_once $file;

			$classname = __NAMESPACE__ . '\\' . $class;
			Plugin::instance()->widgets_manager->register_widget_type( new $classname );
		}
	}

	/**
	 * Adding custom icon to icon control in Elementor
	 */
	public function flaticon_tab( $tabs = [] ) {
		// Append new icons
		$flat_icons = ElementorIconTrait::flaticon_icons();

		$tabs['greenova-flaticon-icons'] = [
			'name'          => 'greenova-flaticon-icons',
			'label'         => esc_html__( 'Flat Icons', 'greenova-core' ),
			'labelIcon'     => 'fab fa-elementor',
			'prefix'        => '',
			'displayPrefix' => '',
			'url'           => \GREENOVA_Theme_Helper::get_css( 'flaticon' ),
			'icons'         => $flat_icons,
			'ver'           => '1.0',
		];

		return $tabs;
	}

	public function widget_categoty( $class ) {
		$id         = GREENOVA_CORE_THEME_PREFIX . '-widgets'; // Category /@dev
		$properties = [
			'title' => __( 'RadiusTheme Elements', 'greenova-core' ),
		];

		Plugin::$instance->elements_manager->add_category( $id, $properties );
	}

}

new Custom_Widget_Init();