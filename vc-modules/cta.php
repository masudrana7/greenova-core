<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

if ( !class_exists( 'GREENOVA_Theme_VC_Call_To_Action' ) ) {

	class GREENOVA_Theme_VC_Call_To_Action extends GREENOVA_Theme_VC_Modules {

		public function __construct(){
			$this->name = __( "GREENOVA: Call to Action", 'greenova-core' );
			$this->base = 'greenova-vc-call-to-action';
			$this->translate = array(
				'title' => __( "Need Help For Gardening? Please Contact Us", 'greenova-core' ),
				'subtitle' => __( "Buy the Greenova wordpress theme and grow with us", 'greenova-core' ),
				'buttontext' => __( "Contact Us", 'greenova-core' ),
				'phoneuppertext' => __( "Toll Free Call Us", 'greenova-core' ),
			);
			parent::__construct();
		}

		public function fields(){
			$fields = array(
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Style", 'greenova-core' ),
					"param_name" => "layout",
					"value" => array( 
						__( 'Style 1', 'greenova-core' ) => 'style1',
						__( 'Style 2', 'greenova-core' ) => 'style2',
						__( 'Style 3', 'greenova-core' ) => 'style3',
						__( 'Style 4', 'greenova-core' ) => 'style4',
						),
					),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Title", 'greenova-core' ),
					"param_name" => "title",
					"value" => $this->translate['title'],
				),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Title Tag", 'greenova-core' ),
					"param_name" => "title_tag",
					"value" => array( 
						__( 'H2', 'greenova-core' ) => 'h2',
						__( 'H1', 'greenova-core' ) => 'h1',
						__( 'H3', 'greenova-core' ) => 'h3',
						__( 'H4', 'greenova-core' ) => 'h4',
						),
					'dependency' => array(
						'element' => 'layout',
						'value'   => array( 'style3' ),
						)
					),
				array(
					"type" => "colorpicker",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Title color", 'greenova-core' ),
					"param_name" => "title_color",
					"value" => "",
					),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Title Font Size", 'greenova-core' ),
					"param_name" => "title_font_size",
					"value" => "28",
					'dependency' => array(
						'element' => 'layout',
						'value'   => array( 'style3', 'style4' ),
						)
					),				
				array(
					"type"		  => "attach_image",
					"holder" 	  => "div",
					"class" 	  => "",
					"heading" 	  => __( "Image", 'greenova-core' ),
					"param_name"  => "image",
					'dependency' => array(
						'element' => 'layout',
						'value'   => array( 'style4' ),
						)
				),	
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Subtitle", 'greenova-core' ),
					"param_name" => "subtitle",
					"value" => $this->translate['subtitle'],
					'dependency' => array(
						'element' => 'layout',
						'value'   => array( 'style2' ),
					),
				),
				array(
					"type" => "colorpicker",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Subtitle color", 'greenova-core' ),
					"param_name" => "subtitle_color",
					"value" => "",
					'dependency' => array(
						'element' => 'layout',
						'value'   => array( 'style2' ),
						),
					),					
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Phone Upper Text", 'greenova-core' ),
					"param_name" => "phoneuppertext",
					"value" => $this->translate['phoneuppertext'],
					'dependency' => array(
						'element' => 'layout',
						'value'   => array( 'style2' ),
					),
				),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Phone Number", 'greenova-core' ),
					"param_name" => "phone_number",
					"value" => '+88 555 66630',
					'dependency' => array(
						'element' => 'layout',
						'value'   => array( 'style2', 'style4' ),
					),
				),
				array(
					"type" => "colorpicker",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Phone Color", 'greenova-core' ),
					"param_name" => "phone_color",
					"value" => '#161616',
					'dependency' => array(
						'element' => 'layout',
						'value'   => array( 'style4' ),
					),
				),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Button Text", 'greenova-core' ),
					"param_name" => "buttontext",
					"value" => $this->translate['buttontext'],
					'dependency' => array(
						'element' => 'layout',
						'value'   => array( 'style1' , 'style3' ),
					),
				),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Button URL", 'greenova-core' ),
					"param_name" => "btnurl",
					"value" => '#',
					'dependency' => array(
						'element' => 'layout',
						'value'   => array( 'style1', 'style3' ),
					),
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
				'layout'        	=> 'style1',
				'title'      		=> $this->translate['title'],
				'title_color'      	=> '',
				'phone_color'       => '#161616',
				'title_tag'      	=> 'h2',
				'image'		      	=> '',
				'title_font_size'   => '28',
				'buttontext' 		=> $this->translate['buttontext'],
				'subtitle'   		=> $this->translate['subtitle'],
				'phoneuppertext'   	=> $this->translate['phoneuppertext'],
				'subtitle_color'   	=> '',
				'btnurl'     		=> '#',
				'phone_number'  	=> '+88 555 66630',
				'css'        		=> '',
				), $atts ) );
				
				$title_font_size = intval($title_font_size);
				
			switch ( $layout ) {
				case 'style4':
					$template = 'cta-4';
				break;
				case 'style3':
					$template = 'cta-3';
				break;	
				case 'style2':
					$template = 'cta-2';
				break;	
				default:
					$template = 'cta-1';
				break;
			}
			
			return $this->template( $template, get_defined_vars() );
		}
	}
}

new GREENOVA_Theme_VC_Call_To_Action;