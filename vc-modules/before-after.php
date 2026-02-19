<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */
if ( ! defined( 'ABSPATH' ) ) exit;

if ( !class_exists( 'GREENOVA_Theme_VC_Before_After' ) ) {

	class GREENOVA_Theme_VC_Before_After extends GREENOVA_Theme_VC_Modules {

		public function __construct(){
			$this->name = __( "GREENOVA: Before After", 'greenova-core' );
			$this->base = 'greenova-vc-before-after';
			parent::__construct();
		}

		public function fields(){
			$fields = array(			
				array(
					"type"		  => "attach_image",
					"holder" 	  => "div",
					"class" 	  => "",
					"heading" 	  => __( "Before Image", 'greenova-core' ),
					"param_name"  => "beforeimage",
				),				
				array(
					"type"		  => "attach_image",
					"holder" 	  => "div",
					"class" 	  => "",
					"heading" 	  => __( "After Image", 'greenova-core' ),
					"param_name"  => "afterimage",
				),
				array(
					'type' => 'css_editor',
					'heading' => __( 'Css', 'greenova-core' ),
					'param_name' => 'css',
					'group' => __( 'Design options', 'greenova-core' ),
					),
				);
			return $fields;
		}
		
		public function shortcode( $atts, $content = '' ){
			extract( shortcode_atts( array(
				'beforeimage'	       => '',
				'afterimage'	       => '',
				'css'                  => '',
				), $atts ) );

			$template = 'before-after';

			return $this->template( $template, get_defined_vars() );
		}
	}
}

new GREENOVA_Theme_VC_Before_After;