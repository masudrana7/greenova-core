<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

if ( !class_exists( 'GREENOVA_Theme_VC_RT_Image' ) ) {

	class GREENOVA_Theme_VC_RT_Image extends GREENOVA_Theme_VC_Modules {

		public function __construct(){
			$this->name = __( "GREENOVA: RT Dual Image", 'greenova-core' );
			$this->base = 'greenova-vc-rt-dual-image';
			parent::__construct();
		}

		public function fields(){
			$fields = array(			
				array(
					"type"		  => "attach_image",
					"holder" 	  => "div",
					"class" 	  => "",
					"heading" 	  => __( "Back Image", 'greenova-core' ),
					"param_name"  => "backimage",
				),				
				array(
					"type"		  => "attach_image",
					"holder" 	  => "div",
					"class" 	  => "",
					"heading" 	  => __( "Overlay Image", 'greenova-core' ),
					"param_name"  => "overlayimage",
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
				'backimage'	    => '',
				'overlayimage'	=> '',
				'css'         	=> '',
				), $atts ) );

			$template = 'rt-image';

			return $this->template( $template, get_defined_vars() );
		}
	}
}

new GREENOVA_Theme_VC_RT_Image;