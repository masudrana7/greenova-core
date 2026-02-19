<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */
if ( ! defined( 'ABSPATH' ) ) exit;

if ( !class_exists( 'GREENOVA_Theme_VC_Progress_Bar' ) ) {

	class GREENOVA_Theme_VC_Progress_Bar extends GREENOVA_Theme_VC_Modules {

		public function __construct(){
			$this->name = __( "Greenova: Progress Bar", 'greenova-core' );
			$this->base = 'greenova-vc-progress-bar';
			$this->translate = array(
				'title' => __( "2016 Solved Case", 'greenova-core' ),
			);
			parent::__construct();
		}

		public function fields(){
			$fields = array(
				array(
					"type"		  => "dropdown",
					"holder"	  => "div",
					"class" 	  => "",
					"heading" 	  => __( "Style", 'greenova-core' ),
					"param_name"  => "style",
					'value' 	  => array( 
						'Style 1' => 'style1',
						'Style 2' => 'style2'
						),
					),
				// params group
				array(
					'type' => 'param_group',
					'value' => '',
					'param_name' => 'progress_bars',
					// Note params is mapped inside param-group:
					'params' => array(
						array(
							'type' => 'textfield',
							'heading' => 'Bar Title',
							'param_name' => 'title',
							"value" => $this->translate['title'],
						),
						array(
							'type' => 'textfield',
							'heading' => 'Number',
							'param_name' => 'bar_number',
							"value" => 80,
						),
						array(
							"type" => "colorpicker",
							"class" => "",
							"heading" => __( "Title Color", "greenova-core" ),
							"param_name" => "title_color",
							"value" => '#222222',
						),
						array(
							"type" => "colorpicker",
							"class" => "",
							"heading" => __( "Bar Color", "greenova-core" ),
							"param_name" => "bar_color",
							"value" => '',
						),
					)
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
				'style'			=> 'style1',
				'progress_bars' => '',
				'title'         => $this->translate['title'],
				'bar_number'    => 80,
				'title_color'   => '#222222',
				'bar_color'     => '',
				'css'           => '',
				), $atts ) );
			
			wp_enqueue_script( 'wow-js' );
			
			switch ( $style ) {
				case 'style2':
					$template = 'progress-2';
				break;	
				default:
					$template = 'progress-1';
				break;
			}
			
			return $this->template( $template, get_defined_vars() );
		}
	}
}

new GREENOVA_Theme_VC_Progress_Bar;