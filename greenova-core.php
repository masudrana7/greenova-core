<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/*
Plugin Name: Greenova Core
Plugin URI: http://radiustheme.com
Description: Greenova Core Plugin for Greenova Theme
Version: 2.2.7
Author: RadiusTheme
Author URI: http://radiustheme.com
*/

define( 'GREENOVA_CORE_UPDATE_1', true );
define( 'GREENOVA_CORE', ( WP_DEBUG ) ? time() : '2.2.0' );
define( 'GREENOVA_CORE_BASE_URL', plugin_dir_url( __FILE__ ) );
define( 'GREENOVA_CORE_BASE_DIR',      plugin_dir_path( __FILE__ ) );
define( 'GREENOVA_CORE_THEME_PREFIX',  'greenova' );
define( 'GREENOVA_CORE_DEMO_CONTENT', plugin_dir_path( __FILE__ ) . '/demo-content/' );
define( 'GREENOVA_CORE_DEMO_BASE_URL', plugin_dir_url( __FILE__ ) . 'demo-content/' );

require_once GREENOVA_CORE_DEMO_CONTENT . 'demo-content.php';

// Text Domain
add_action( 'init', 'greenova_core_load_textdomain' );
if ( !function_exists( 'greenova_core_load_textdomain' ) ) {
	function greenova_core_load_textdomain() {
		load_plugin_textdomain( 'greenova-core' , false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
	}
}
add_action( 'after_setup_theme', 'layerslider_init' );

function layerslider_init() {
	if( function_exists( 'layerslider_set_as_theme' ) ) {
		layerslider_set_as_theme();
	}
	if( function_exists( 'layerslider_hide_promotions' ) ) {
		layerslider_hide_promotions();
	}
	add_action( 'admin_init', 'layerslider_disable_plugin_notice' ); // Remove LayerSlider purchase notice from plugins page
	fix_layerslider_tgm_compability(); // Fix issue of Layerslider update via TGM
}

function layerslider_disable_plugin_notice() {
	if ( defined( 'LS_PLUGIN_BASE' ) ) {
		remove_action( 'after_plugin_row_' . LS_PLUGIN_BASE, 'layerslider_plugins_purchase_notice', 10, 3 );
	}
}

function fix_layerslider_tgm_compability(){
	if ( !is_admin() || get_option( 'layerslider-authorized-site' ) ) return;

	global $LS_AutoUpdate;
	if ( isset( $LS_AutoUpdate ) && defined( 'LS_ROOT_FILE' ) ) {
		remove_filter( 'pre_set_site_transient_update_plugins', array( $LS_AutoUpdate, 'set_update_transient' ) );
		remove_filter( 'plugins_api', array( $LS_AutoUpdate, 'set_updates_api_results'), 10, 3 );
		remove_filter( 'upgrader_pre_download', array( $LS_AutoUpdate, 'pre_download_filter' ), 10, 4 );
		remove_filter( 'in_plugin_update_message-'.plugin_basename( LS_ROOT_FILE ), array( $LS_AutoUpdate, 'update_message' ) );
		remove_filter( 'wp_ajax_layerslider_authorize_site', array( $LS_AutoUpdate, 'handleActivation' ) );
		remove_filter( 'wp_ajax_layerslider_deauthorize_site', array( $LS_AutoUpdate, 'handleDeactivation' ) );
	}
}

// Widgets
require_once 'widgets/widget-settings.php';
require_once 'widgets/rt-widget-fields.php';
require_once 'widgets/cta-widget.php';
require_once 'widgets/address-widget.php';
require_once 'widgets/social-widget.php';
require_once 'widgets/rt-recent-post-widget.php';
require_once 'widgets/download-widget.php';
require_once 'optimization/__init__.php';

// Post types
add_action( 'after_setup_theme', 'greenova_core_post_types', 15 );
if ( !function_exists( 'greenova_core_post_types' ) ) {
	function greenova_core_post_types(){
		if ( !defined( 'GREENOVA_VERSION' ) || ! defined( 'RT_FRAMEWORK_VERSION' ) ) {
			return;
		}
		require_once 'post-types.php';
		require_once 'post-meta.php';
	}
}

// Visual composer
add_action( 'after_setup_theme', 'greenova_core_vc_modules', 20 );
if ( !function_exists( 'greenova_core_vc_modules' ) ) {
	function greenova_core_vc_modules(){
		if ( !defined( 'GREENOVA_VERSION' ) || ! defined( 'WPB_VC_VERSION' ) || ! defined( 'RT_FRAMEWORK_VERSION' ) ) {
			return;
		}
		require_once 'vc-flaticon/vc-flaticon.php';
		$modules = array( 'inc/abstruct', 'cta', 'title', 'testimonial' , 'team-slider' , 'team-grid' , 'project-grid', 'project-slider', 'service-grid', 'about' , 'open-hour' , 'post' , 'post-grid', 'info-text' , 'award-box', 'contact-box' , 'contact-info', 'progress-bar', 'text-with-button' , 'text-with-video', 'pricing-box', 'before-after' , 'history-box' , 'rt-counter' , 'rt-image', 'video' );
		foreach ( $modules as $module ) {
			require_once 'vc-modules/' . $module. '.php';
		}
	}
}

// Elementor
add_action( 'after_setup_theme', 'greenova_core_elemntor_modules', 10 );
if ( !function_exists( 'greenova_core_elemntor_modules' ) ) {
	function greenova_core_elemntor_modules(){
		if ( did_action( 'elementor/loaded' ) ) {
            require_once GREENOVA_CORE_BASE_DIR . 'elementor/init.php'; // Elementor
        }
	}
}

// Demo Importer settings
require_once 'demo-importer.php';
