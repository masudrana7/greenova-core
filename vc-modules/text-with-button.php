<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

if ( !class_exists( 'GREENOVA_Theme_VC_Text_With_Button' ) ) {
		
	class GREENOVA_Theme_VC_Text_With_Button extends GREENOVA_Theme_VC_Modules {

		public function __construct(){
			$this->name = __( "Greenova: Text with Button", 'greenova-core' );
			$this->base = 'greenova-vc-text-with-button';
			$this->translate = array(				
				'content_text'  => __( 'Award<span> Winning</span> Gardener<span> Landscape</span> Company', 'greenova-core' ),
				'button_text'   => __( 'Contact Us', 'greenova-core' ),
			);
			parent::__construct();
		}

		public function fields(){
			$fields = array(
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Layout", 'greenova-core' ),
					"param_name" => "tab_layout",
					"value" => array( 
						__('Common Layout 1', 'greenova-core') => 'common1',
						__('Common Layout 2', 'greenova-core') => 'common2',
						__('Common Layout 3', 'greenova-core') => 'common3',
						__('Shop Page Special Layout', 'greenova-core')   => 'shop',
						),
					),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Alignment", 'greenova-core' ),
					"param_name" => "section_align",
					"value" => array( 
						__('Center', 'greenova-core') => 'center',
						__('Left', 'greenova-core')   => 'left',
						__('Right', 'greenova-core')  => 'right',
						),
					),				
				array(
					"type"        => "textarea_raw_html",
					"holder" 	  => "div",
					"class" 	  => "",
					"heading" 	  => __( "Short Description", 'greenova-core' ),
					"param_name"  => "content_text",
					"value" 	  => base64_encode($this->translate['content_text']),
					"rows" 		  => "1",
				),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Title Tag", 'greenova-core' ),
					"param_name" => "title_tag",
					"value" => array( 
						__('H3', 'greenova-core') => 'h3',
						__('H2', 'greenova-core') => 'h2',
						),
					),
				array(
					"type" 		  => "colorpicker",
					"class" 	  => "",
					"heading" 	  => __( "Title color", "greenova-core" ),
					"param_name"  => "title_color",
					"value" 	  => '#222222',
					),
				array(
					"type"        => "textfield",
					"holder" 	  => "div",
					"class" 	  => "",
					"heading" 	  => __( "Title Font Size", 'greenova-core' ),
					"param_name"  => "title_font_size",
					"value" 	  => '36',
				),
				array(
					"type" 		  => "dropdown",
					"holder" 	  => "div",
					"class" 	  => "",
					"heading" 	  => __( "Title Font Weight", 'greenova-core' ),
					"param_name"  => "title_font_weight",
					"value" => array( 
						__('Light', 'greenova-core') => 'light',
						__('Bold', 'greenova-core')  => 'bold',
						),
				),
				array(
					"type" 		  => "textarea_html",
					"holder" 	  => "div",
					"class" 	  => "",
					"heading" 	  => __( "Content", 'greenova-core' ),
					"param_name"  => "content",
					"value" 	  =>  __( "Mimply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five cent into electronining essentially unchanged." , 'greenova-core' ),
					"rows"		  => "1",
					),					
				array(
					"type" 		  => "colorpicker",
					"class" 	  => "",
					"heading" 	  => __( "Content color", "greenova-core" ),
					"param_name"  => "content_color",
					"value" 	  => '#222222',
					),
				array(
					"type" 		  => "dropdown",
					"holder" 	  => "div",
					"class" 	  => "",
					"heading" 	  => __( "Button Style", 'greenova-core' ),
					"param_name"  => "button_style",
					"value" 	  => array( 
						__('Light (Circle) Background', 'greenova-core') => 'style1',
						__('Dark (Circle) Background', 'greenova-core')  => 'style2',
						__('Light (Box) Background', 'greenova-core')  => 'style3',
						__('Dark (Box) Background', 'greenova-core')  => 'style4',
						__('White Background', 'greenova-core')  => 'style5',
						),
					),
				array(
					"type"        => "textfield",
					"holder" 	  => "div",
					"class" 	  => "",
					"heading" 	  => __( "Button Text", 'greenova-core' ),
					"param_name"  => "button_text",
					"value" 	  => $this->translate['button_text'],
				),
				array(
					"type"        => "textfield",
					"holder" 	  => "div",
					"class" 	  => "",
					"heading" 	  => __( "Button URL", 'greenova-core' ),
					"param_name"  => "button_url",
					"value" 	  => '#',
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
				'content_text'		=> base64_encode( $this->translate['content_text'] ),
				'title_color' 		=> '#222222',
				'title_tag' 		=> 'h3',
				'title_font_size' 	=> '36',
				'title_font_weight' => 'light',
				'content_color' 	=> '#222222',
				'button_text' 	    => $this->translate['button_text'],
				'button_url' 	    => '#',
				'button_style' 	    => 'style1',
				'section_align' 	=> 'center',
				'tab_layout' 		=> 'common',
				'css'             	=> '',
				), $atts ) );			
			//validation
			$title_font_size      = intval( $title_font_size );
			
			$template = 'text-with-button';

			return $this->template( $template, get_defined_vars() );
			
		}
	}
}

new GREENOVA_Theme_VC_Text_With_Button;