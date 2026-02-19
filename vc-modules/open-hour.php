<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */
if ( ! defined( 'ABSPATH' ) ) exit;

if ( !class_exists( 'GREENOVA_Theme_VC_Open_Hour' ) ) {

	class GREENOVA_Theme_VC_Open_Hour extends GREENOVA_Theme_VC_Modules {

		public function __construct(){
			$this->name = __( "greenova: Opening Hour", 'greenova-core' );
			$this->base = 'greenova-vc-opening-hour';
			$this->translate = array(
				'title' => __( "Working Hours", 'greenova-core' ),
			);
			parent::__construct();
		}

		public function fields(){
			$fields = array(
				
				// params group
				array(
					'type' => 'param_group',
					'value' => '',
					'param_name' => 'tabs',
					// Note params is mapped inside param-group:
					'params' => array(
						array(
							'type' => 'textfield',
							'heading' => 'Weekdays',
							'param_name' => 'weekdays',							
							"value" => "Saturday",
							'description' => __( 'Weekdays like "Saturday , Sunday"', 'greenova-core' ),
						),
						array(
							'type' => 'textfield',
							'heading' => 'Opening Hour',
							'param_name' => 'openhour',							
							"value" => "10.00AM - 8.00PM",
							'description' => __( 'Opening Hour like "10.00AM - 8.00PM"', 'greenova-core' ),
						),
					)
				),				
				array(
					'type' => 'textfield',
					'heading' => 'Title',
					'param_name' => 'title',
					"value" => $this->translate['title'],
				),
				array(
					"type" => "colorpicker",
					"class" => "",
					"heading" => __( "Title color", "greenova-core" ),
					"param_name" => "title_color",
					"value" => '#ffffff',
				),
				array(
					'type' => 'css_editor',
					'heading' => __( 'Css', 'greenova-core' ),
					'param_name' => 'css',
					'group' => __( 'Design options', 'greenova-core' )
				),
			);
			return $fields;
		}

		public function shortcode( $atts, $content = '' ){
			extract( shortcode_atts( array(
				'tabs'    	   => '',
				'weekdays'     => 'Saturday',
				'title_color'  => '#ffffff',
				'openhour'     => '10.00AM - 8.00PM',
				'title'        => $this->translate['title'],				
				'css'          => '',
				), $atts ) );
			

			$template = 'open-hour';

			return $this->template( $template, get_defined_vars() );
		}
	}
}

new GREENOVA_Theme_VC_Open_Hour;