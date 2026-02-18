<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

if ( !class_exists( 'GREENOVA_Theme_VC_Contact' ) ) {

	class GREENOVA_Theme_VC_Contact extends GREENOVA_Theme_VC_Modules {

		public function __construct(){
			$this->name = __( "Greenova: Contact", 'greenova-core' );
			$this->base = 'greenova-vc-contact';
			parent::__construct();
		}

		public function fields(){
			$fields = array(
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Style", 'greenova-core' ),
					"param_name" => "style",
					'value' => array(
						__( "Style 1", 'greenova-core' ) => 'style1',
						__( "Style 2", 'greenova-core' ) => 'style2',
					),
				),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Title", 'greenova-core' ),
					"param_name" => "title",
					"value" => "Get in Touch With Us",
					'dependency' => array(
						'element' => 'style',
						'value'   => array( 'style2' ),
						),
				),
				array(
					"type" => "textarea",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Sub Title", 'greenova-core' ),
					"param_name" => "sub_title",
					"value" => "Nulla magnam exercitationem cupiditate ab maxime.",
					'dependency' => array(
						'element' => 'style',
						'value'   => array( 'style2' ),
						),
				),
				array(
					"type" => "textarea",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Address", 'greenova-core' ),
					"param_name" => "address",
					"value" => "PO Box 1212, California, US",
				),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Email", 'greenova-core' ),
					"param_name" => "email",
					"value" => "example@example.com",
				),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Phone", 'greenova-core' ),
					"param_name" => "phone",
					"value" => "+61 1111 3333",
				),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Fax", 'greenova-core' ),
					"param_name" => "fax",
					"value" => "+ (123) 6969 8008",
					'dependency' => array(
						'element' => 'style',
						'value'   => array( 'style2' ),
						),
				),
				array(
					"type"        => "dropdown",
					"holder"      => "div",
					"class" 	  => "",
					"heading"     => __( "Social Links Display", 'greenova-core' ),
					"param_name"  => "socials",				
					'description' => __( 'Social Links which are already set in Theme Options', 'greenova-core' ),
					'value' => array(
						__( "Enabled", 'greenova-core' )  => 'true',
						__( "Disabled", 'greenova-core' ) => 'false',
					),
				),
				array(
					'type' 		 => 'css_editor',
					'heading' 	 => __( 'Css', 'greenova-core' ),
					'param_name' => 'css',
					'group' 	 => __( 'Design options', 'greenova-core' )
				),
			);
			return $fields;
		}

		public function shortcode( $atts, $content = '' ){
			extract( shortcode_atts( array(
				'style'   		=> 'style1',
				'address' 		=> 'PO Box 1212, California, US',
				'email'   		=> 'example@example.com',
				'phone'         => '+61 1111 3333',
				'fax'           => '+ (123) 6969 8008',
				'socials'       => 'true',
				'title'         => 'Get in Touch With Us',
				'sub_title'     => 'Nulla magnam exercitationem cupiditate ab maxime.',
				'css'              => '',
				), $atts ) );

			switch ( $style ) {
				case 'style2':
				$template = 'contact-2';
				break;
				default:
				$template = 'contact-1';
				break;
			}

			return $this->template( $template, get_defined_vars() );
		}
	}
}

new GREENOVA_Theme_VC_Contact;