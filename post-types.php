<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

if ( !class_exists( 'RT_Posts' ) ) {
	return;
}
$post_types = array(
	'greenova_team'   	 => array(
		'title'        => esc_html(  'Team Member' ),
		'plural_title' => esc_html(  'Team Members' ),
		'menu_icon'    => 'dashicons-businessman',
		'labels_override'     => array(
			'menu_name'  => esc_html(  'Team' ),
			),
        'rewrite' => isset(GREENOVA_Theme::$options['team_slug']) ? GREENOVA_Theme::$options['team_slug'] : 'default_slug',
		),


    'greenova_service'    => array(
		'title'        => esc_html(  'Service' ),
		'plural_title' => esc_html(  'Service' ),
		'menu_icon'    => 'dashicons-book-alt',
        'rewrite' => isset(GREENOVA_Theme::$options['service_slug']) ? GREENOVA_Theme::$options['service_slug'] : 'default_slug',
    ),
	'greenova_project'    => array(
		'title'        => esc_html(  'Project' ),
		'plural_title' => esc_html(  'Project' ),
		'menu_icon'    => 'dashicons-images-alt2',
        'rewrite' => isset(GREENOVA_Theme::$options['project_slug']) ? GREENOVA_Theme::$options['project_slug'] : 'default_slug',
		),
	'green_testimonial'  => array(
		'title'        => esc_html(  'Testimonial' ),
		'plural_title' => esc_html(  'Testimonials' ),
		'menu_icon'    => 'dashicons-awards',
		'rewrite'      => false,
		),
	);

$taxonomies = array(
	'greenova_service_category' => array(
		'title'        => esc_html(  'Service Category' ),
		'plural_title' => esc_html(  'Service Categories' ),
		'post_types'   => 'greenova_service',
		'rewrite'      => array( 'slug' => !empty( GREENOVA_Theme::$options['service_cat_slug'] ) ? GREENOVA_Theme::$options['service_cat_slug'] : '' ),
		),
	'greenova_project_category' => array(
		'title'        => esc_html(  'Project Category' ),
		'plural_title' => esc_html(  'Project Categories' ),
		'post_types'   => 'greenova_project',
		'rewrite'      => array( 'slug' => !empty( GREENOVA_Theme::$options['project_cat_slug'] ) ? GREENOVA_Theme::$options['project_cat_slug'] : '' ),
		),
	'green_team_cat' => array(
		'title'        => esc_html(  'Team Category' ),
		'plural_title' => esc_html(  'Team Categories' ),
		'post_types'   => 'greenova_team',
		'rewrite'      => array( 'slug' => !empty(GREENOVA_Theme::$options['team_cat_slug'] ) ? GREENOVA_Theme::$options['team_cat_slug'] : '' ),
		),
	'greenova_testimonial_category' => array(
		'title'        => esc_html(  'Testimonial Category' ),
		'plural_title' => esc_html(  'Testimonial Categories' ),
		'post_types'   => 'green_testimonial',
		),
	);

$Posts = RT_Posts::getInstance();
$Posts->add_post_types( $post_types );
$Posts->add_taxonomies( $taxonomies );