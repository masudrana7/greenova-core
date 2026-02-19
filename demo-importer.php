<?php
// phpcs:disable WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
if ( ! defined( 'ABSPATH' ) ) exit;
add_action( 'plugins_loaded', 'greenova_core_load_demo_importer', 15 );
function greenova_core_load_demo_importer(){
	add_filter( 'plugin_action_links_rt-demo-importer/rt-demo-importer.php', 'greenova_core_importer_add_action_links' );
	add_filter( 'fw:ext:backups-demo:demos', 'greenova_core_importer_backups_demos' );
	add_action( 'fw:ext:backups:tasks:success:id:demo-content-install', 'greenova_core_importer_after_demo_install' );
	add_filter( 'rt_demo_installer_warning', 'greenova_importer_warning' );
}

function greenova_core_importer_add_action_links( $links ) {
	$mylinks = array(
		'<a href="' . esc_url( admin_url( 'tools.php?page=fw-backups-demo-content' ) ) . '">'.esc_html(  'Install Demo Contents' ).'</a>',
	);
	return array_merge( $links, $mylinks );
}

function greenova_importer_warning( $links ) {
	$html  = '<div style="margin-top:20px;color:#f00;font-size:20px;line-height:1.3;font-weight:600;margin-bottom:40px;border-color: #f00;border-style: dashed;border-width: 1px 0;padding:10px 0;"><i class="dashicons dashicons-warning" style="margin-top: 5px; margin-right: 7px;"></i>';
	$html .= esc_html(  'Warning: All your old data will be lost if you install One Click demo data from here, so it is suitable only for a new website.');
	$html .= '</div>';
    $html .= '<div style="margin-top:20px;color:#f00;font-size:20px;line-height:1.3;font-weight:600;margin-bottom:40px;border-color: #f00;border-style: dashed;border-width: 1px 0;padding:10px 0;"><i class="dashicons dashicons-warning" style="margin-top: 5px; margin-right: 7px;"></i>';
    $html .= esc_html(  'Import your desired demo contents between WPBakery and Elementor page builder. Please, install and activate all plugins before import demo.');
    $html .= '</div>';
	return $html;
}

function greenova_core_importer_backups_demos( $demos ) {
	$demos_array = array(
		'demo1' => array(
			'title' => esc_html(  'Home 1 - WPBakery' ),
			'screenshot' => plugins_url( 'screenshots/screenshot1.jpg', __FILE__ ),
			'preview_link' => 'https://radiustheme.com/demo/wordpress/greenova/',
		),
		'demo2' => array(
			'title' => esc_html(  'Home 2 - WPBakery' ),
			'screenshot' => plugins_url( 'screenshots/screenshot2.jpg', __FILE__ ),
			'preview_link' => 'https://radiustheme.com/demo/wordpress/greenova/home-2/',
		),
		'demo3' => array(
			'title' => esc_html(  'Home 3 - WPBakery' ),
			'screenshot' => plugins_url( 'screenshots/screenshot3.jpg', __FILE__ ),
			'preview_link' => 'https://radiustheme.com/demo/wordpress/greenova/home-3/',
		),
		'demo4' => array(
			'title' => esc_html(  'Home 4 - WPBakery' ),
			'screenshot' => plugins_url( 'screenshots/screenshot4.jpg', __FILE__ ),
			'preview_link' => 'https://radiustheme.com/demo/wordpress/greenova/home-4/',
		),
		'demo5' => array(
			'title' => esc_html(  'Home 5 - WPBakery' ),
			'screenshot' => plugins_url( 'screenshots/screenshot5.jpg', __FILE__ ),
			'preview_link' => 'https://radiustheme.com/demo/wordpress/greenova/home-5/',
		),
		'demo6' => array(
			'title' => esc_html(  'Home 6 - WPBakery' ),
			'screenshot' => plugins_url( 'screenshots/screenshot6.jpg', __FILE__ ),
			'preview_link' => 'https://radiustheme.com/demo/wordpress/greenova/home-6/',
		),
		'demo7' => array(
			'title' => esc_html(  'Home 7 - WPBakery' ),
			'screenshot' => plugins_url( 'screenshots/screenshot7.jpg', __FILE__ ),
			'preview_link' => 'https://radiustheme.com/demo/wordpress/greenova/home-7/',
		),
		'demo8' => array(
			'title' => esc_html(  'Home 1 Onepage - WPBakery' ),
			'screenshot' => plugins_url( 'screenshots/screenshot1.jpg', __FILE__ ),
			'preview_link' => 'https://radiustheme.com/demo/wordpress/greenova/home-1-one-page/',
		),
		'demo9' => array(
			'title' => esc_html(  'Home 2 Onepage - WPBakery' ),
			'screenshot' => plugins_url( 'screenshots/screenshot2.jpg', __FILE__ ),
			'preview_link' => 'https://radiustheme.com/demo/wordpress/greenova/home-2-one-page/',
		),
		'demo10' => array(
			'title' => esc_html(  'Home 3 Onepage - WPBakery' ),
			'screenshot' => plugins_url( 'screenshots/screenshot3.jpg', __FILE__ ),
			'preview_link' => 'https://radiustheme.com/demo/wordpress/greenova/home-3-one-page',
		),
		'demo11' => array(
			'title' => esc_html(  'Home 4 Onepage - WPBakery' ),
			'screenshot' => plugins_url( 'screenshots/screenshot4.jpg', __FILE__ ),
			'preview_link' => 'https://radiustheme.com/demo/wordpress/greenova/home-4-one-page/',
		),
		'demo12' => array(
			'title' => esc_html(  'Home 5 Onepage - WPBakery' ),
			'screenshot' => plugins_url( 'screenshots/screenshot5.jpg', __FILE__ ),
			'preview_link' => 'https://radiustheme.com/demo/wordpress/greenova/home-5-one-page/',
		),
		'demo13' => array(
			'title' => esc_html(  'Home 6 Onepage - WPBakery' ),
			'screenshot' => plugins_url( 'screenshots/screenshot6.jpg', __FILE__ ),
			'preview_link' => 'https://radiustheme.com/demo/wordpress/greenova/home-6-one-page/',
		),
		'demo14' => array(
			'title' => esc_html(  'Home 7 Onepage - WPBakery' ),
			'screenshot' => plugins_url( 'screenshots/screenshot7.jpg', __FILE__ ),
			'preview_link' => 'https://radiustheme.com/demo/wordpress/greenova/home-7-one-page/',
		),
		
		//Elementor Demo
		'elementor1' => array(
			'title' => esc_html(  'Home 1 - Elementor' ),
			'screenshot' => plugins_url( 'screenshots/screenshot1.jpg', __FILE__ ),
			'preview_link' => 'https://radiustheme.com/demo/wordpress/themes/greenova-el/',
		),
		'elementor2' => array(
			'title' => esc_html(  'Home 2 - Elementor' ),
			'screenshot' => plugins_url( 'screenshots/screenshot2.jpg', __FILE__ ),
			'preview_link' => 'https://radiustheme.com/demo/wordpress/themes/greenova-el/home-2/',
		),
		'elementor3' => array(
			'title' => esc_html(  'Home 3 - Elementor' ),
			'screenshot' => plugins_url( 'screenshots/screenshot3.jpg', __FILE__ ),
			'preview_link' => 'https://radiustheme.com/demo/wordpress/themes/greenova-el/home-3/',
		),
		'elementor4' => array(
			'title' => esc_html(  'Home 4 - Elementor' ),
			'screenshot' => plugins_url( 'screenshots/screenshot4.jpg', __FILE__ ),
			'preview_link' => 'https://radiustheme.com/demo/wordpress/themes/greenova-el/home-4/',
		),
		'elementor5' => array(
			'title' => esc_html(  'Home 5 - Elementor' ),
			'screenshot' => plugins_url( 'screenshots/screenshot5.jpg', __FILE__ ),
			'preview_link' => 'https://radiustheme.com/demo/wordpress/themes/greenova-el/home-5/',
		),
		'elementor6' => array(
			'title' => esc_html(  'Home 6 - Elementor' ),
			'screenshot' => plugins_url( 'screenshots/screenshot6.jpg', __FILE__ ),
			'preview_link' => 'https://radiustheme.com/demo/wordpress/themes/greenova-el/home-6/',
		),
		'elementor7' => array(
			'title' => esc_html(  'Home 7 - Elementor' ),
			'screenshot' => plugins_url( 'screenshots/screenshot7el.jpg', __FILE__ ),
			'preview_link' => 'https://radiustheme.com/demo/wordpress/themes/greenova-el/home-7/',
		),
		'elementor8' => array(
			'title' => esc_html(  'Home 1 Onepage - Elementor' ),
			'screenshot' => plugins_url( 'screenshots/screenshot1.jpg', __FILE__ ),
			'preview_link' => 'https://radiustheme.com/demo/wordpress/themes/greenova-el/home-1-one-page/',
		),
		'elementor9' => array(
			'title' => esc_html(  'Home 2 Onepage - Elementor' ),
			'screenshot' => plugins_url( 'screenshots/screenshot2.jpg', __FILE__ ),
			'preview_link' => 'https://radiustheme.com/demo/wordpress/themes/greenova-el/home-2-one-page/',
		),
		'elementor10' => array(
			'title' => esc_html(  'Home 3 Onepage - Elementor' ),
			'screenshot' => plugins_url( 'screenshots/screenshot3.jpg', __FILE__ ),
			'preview_link' => 'https://radiustheme.com/demo/wordpress/themes/greenova-el/home-3-one-page',
		),
		'elementor11' => array(
			'title' => esc_html(  'Home 4 Onepage - Elementor' ),
			'screenshot' => plugins_url( 'screenshots/screenshot4.jpg', __FILE__ ),
			'preview_link' => 'https://radiustheme.com/demo/wordpress/themes/greenova-el/home-4-one-page/',
		),
		'elementor12' => array(
			'title' => esc_html(  'Home 5 Onepage - Elementor' ),
			'screenshot' => plugins_url( 'screenshots/screenshot5.jpg', __FILE__ ),
			'preview_link' => 'https://radiustheme.com/demo/wordpress/themes/greenova-el/home-5-one-page/',
		),
		'elementor13' => array(
			'title' => esc_html(  'Home 6 Onepage - Elementor' ),
			'screenshot' => plugins_url( 'screenshots/screenshot6.jpg', __FILE__ ),
			'preview_link' => 'https://radiustheme.com/demo/wordpress/themes/greenova-el/home-6-one-page/',
		),
		'elementor14' => array(
			'title' => esc_html(  'Home 7 Onepage - Elementor' ),
			'screenshot' => plugins_url( 'screenshots/screenshot7el.jpg', __FILE__ ),
			'preview_link' => 'https://radiustheme.com/demo/wordpress/themes/greenova-el/home-7-one-page/',
		),
	);

	$download_url = 'http://demo.radiustheme.com/wordpress/demo-content/greenova/';

	foreach ($demos_array as $id => $data) {
		$demo = new FW_Ext_Backups_Demo($id, 'piecemeal', array(
			'url' => $download_url,
			'file_id' => $id,
		));
		$demo->set_title($data['title']);
		$demo->set_screenshot($data['screenshot']);
		$demo->set_preview_link($data['preview_link']);

		$demos[ $demo->get_id() ] = $demo;

		unset($demo);
	}

	return $demos;
}

// Run after demo install
function greenova_core_importer_after_demo_install( $collection ){
	// Update front page id
	$demos = array(
		'demo1' => 2881,
		'demo2' => 3019,
		'demo3' => 1161,
		'demo4' => 3633,
		'demo5' => 3719,
		'demo6' => 3815,
		'demo7' => 3977,
		'demo8' => 3660,
		'demo9' => 3671,
		'demo10' => 3678,
		'demo11' => 3690,
		'demo12' => 3914,
		'demo13' => 3930,
		'demo14' => 4276,
		//Elmentor Demo
		'elementor1' => 4955,
		'elementor2' => 5141,
		'elementor3' => 5271,
		'elementor4' => 5398,
		'elementor5' => 5536,
		'elementor6' => 3815,
		'elementor7' => 3977,
		'elementor8' => 3660,
		'elementor9' => 3671,
		'elementor10' => 3678,
		'elementor11' => 3690,
		'elementor12' => 3914,
		'elementor13' => 3930,
		'elementor14' => 4276,
	);

	$data = $collection->to_array();

	foreach( $data['tasks'] as $task ) {
		if( $task['id'] == 'demo:demo-download' ){
			$demo_id = $task['args']['demo_id'];
			$page_id = $demos[$demo_id];
			update_option( 'page_on_front', $page_id );
			flush_rewrite_rules();
			break;
		}
	}

	// Update contact form 7 email
	$cf7ids = array( 326, 23, 115, 1132, 246, 1344 );
	foreach ( $cf7ids as $cf7id ) {
		$mail = get_post_meta( $cf7id, '_mail', true );
		if(empty($mail)){
            $mail = array();
        }
		$mail['recipient'] = get_option( 'admin_email' );
		if ( class_exists( 'WPCF7_ContactFormTemplate' ) ) {
			$pattern = "/<[^@\s]*@[^@\s]*\.[^@\s]*>/"; // <email@email.com>
			$replacement = '<'. WPCF7_ContactFormTemplate::from_email().'>';
			$mail['sender'] = preg_replace($pattern, $replacement, $mail['sender']);
		}
		update_post_meta( $cf7id, '_mail', $mail );		
	}
	// Update post author id
    global $wpdb;
    $id = get_current_user_id();
    // phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery, WordPress.DB.DirectDatabaseQuery.NoCaching
    $query = "UPDATE $wpdb->posts SET post_author = $id";
    $wpdb->query($query); // phpcs:disable WordPress.DB.PreparedSQL.NotPrepared
}