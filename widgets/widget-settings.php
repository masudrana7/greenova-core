<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

add_action( 'widgets_init', 'greenova_widgets_init' );
function greenova_widgets_init() {

	// Register Custom Widgets
	register_widget( 'GREENOVA_Theme_Address_Widget' );
	register_widget( 'GREENOVA_Theme_Social_Widget' );
	register_widget( 'GREENOVA_Theme_Recent_Posts_With_Image_Widget' );
	register_widget( 'GREENOVA_Theme_CTA_Widget' );
	register_widget( 'GREENOVA_Theme_Download_Link' );
}