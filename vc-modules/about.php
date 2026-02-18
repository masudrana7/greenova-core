<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

if ( !class_exists( 'GREENOVA_Theme_VC_About' ) ) {
		
	class GREENOVA_Theme_VC_About extends GREENOVA_Theme_VC_Modules {

		public function __construct(){
			$this->name = __( "greenova: About", 'greenova-core' );
			$this->base = 'greenova-vc-about';
			$this->translate = array(
				'title'   		=> __( 'About <span class="greenova-primary-color">Miako Legal</span>', 'greenova-core' ),
				'buttontext' 	=> __( 'Read More', 'greenova-core' ),
			);
			parent::__construct();
		}

		public function fields(){
			$fields = array(
				array(
					"type"		  => "dropdown",
					"holder"	  => "div",
					"class" 	  => "",
					"heading" 	  => __( "Layout", 'greenova-core' ),
					"param_name"  => "layout",
					'value' 	  => array( 
						'Layout 1' => 'style1',
						'Layout 2' => 'style2'
						),
					),
				array(
					"type"		  => "dropdown",
					"holder"	  => "div",
					"class" 	  => "",
					"heading" 	  => __( "Image Alignment", 'greenova-core' ),
					"param_name"  => "image_alignment",
					'value' 	  => array( 
						'Left'  => 'left',
						'Right' => 'right'		
						),
					),
				array(
					"type"		  => "attach_image",
					"holder" 	  => "div",
					"class" 	  => "",
					"heading" 	  => __( "Image", 'greenova-core' ),
					"param_name"  => "image",
				),
				array(
					"type"        => "textfield",
					"holder" 	  => "div",
					"class" 	  => "",
					"heading" 	  => __( "Title", 'greenova-core' ),
					"param_name"  => "title",
					"value" 	  => $this->translate['title'],
					"rows" 		  => "1",
				),				
				array(
					"type" 		  => "colorpicker",
					"class" 	  => "",
					"heading" 	  => __( "Title color", "greenova-core" ),
					"param_name"  => "title_color",
					"value" 	  => '#000000',
				),
				array(
					"type" 		  => "textfield",
					"holder" 	  => "div",
					"class" 	  => "",
					"heading" 	  => __( "Title Font Size", 'greenova-core' ),
					"param_name"  => "title_font_size",
					"value" 	  => '48',
				),
				array(
					"type" 		 => "textarea_html",
					"holder" 	 => "div",
					"class" 	 => "",
					"heading" 	 => __( "Content", 'greenova-core' ),
					"param_name" => "content",
					"value" 	 =>  __( 'There are many variations of passages of Lorem Ipsum availabbut the humourrandomisedwords.There are many variations of passages of Lorem Ipsum availablebut the majority.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla varius consequat magna, id molestie ipsum volutpat quis. Suspendisse consectetur fringilla suctus.' ),
					"rows"		 => "1",
				),
				array(
					"type"		  => "dropdown",
					"holder"	  => "div",
					"class" 	  => "",
					"heading" 	  => __( "Display Button", 'greenova-core' ),
					"param_name"  => "button_display",
					'value' 	  => array(
						'Yes'  => 'true',
						'No'   => 'false'
						),
				),
				array(
					"type" 		  => "textfield",
					"holder" 	  => "div",
					"class" 	  => "",
					"heading" 	  => __( "Button Text", 'greenova-core' ),
					"param_name"  => "buttontext",
					"value" 	  => $this->translate['buttontext'],
					'dependency' => array(
						'element' => 'button_display',
						'value'   => array( 'true' ),
						),
				),
				array(
					"type" 		 => "textfield",
					"holder" 	 => "div",
					"class" 	 => "",
					"heading" 	 => __( "Button URL", 'greenova-core' ),
					"param_name" => "buttonurl",
					"value" 	  => '#',
					'dependency' => array(
						'element' => 'button_display',
						'value'   => array( 'true' ),
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
				'layout' 			=> 'style1',				
				'image_alignment'	=> 'left',
				'image'      		=> '',
				'title'      		=> $this->translate['title'],
				'title_color' 		=> "#000000",
				'title_font_size' 	=> '48',
				'button_display'    => 'true',
				'buttontext' 		=> $this->translate['buttontext'],
				'buttonurl'  		=> '',
				'css'           	=> '',
				), $atts ) );			
				
				$title_font_size = intval($title_font_size);
				
			switch ( $layout ) {
				case 'style2':
					$template = 'about-view-2';
				break;	
				default:
					$template = 'about-view-1';
				break;
			}

			return $this->template( $template, get_defined_vars() );
			
		}
	}
}

new GREENOVA_Theme_VC_About;