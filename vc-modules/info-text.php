<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

if ( !class_exists( 'GREENOVA_Theme_VC_Info_Text' ) ) {

	class GREENOVA_Theme_VC_Info_Text extends GREENOVA_Theme_VC_Modules {

		public function __construct(){
			$this->name = __( "greenova: Info Text", 'greenova-core' );
			$this->base = 'greenova-vc-infotext';
			$this->translate = array(
				'title' => __( "I am title", 'greenova-core' ),
				'sub_title' => __( "I am sub title", 'greenova-core' ),
				'button_text' => __( "Read More", 'greenova-core' ),
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
					"param_name" => "layout",
					'value' => array(
						__( 'Layout 1', 'greenova-core' ) => 'layout1',
						__( 'Layout 2', 'greenova-core' ) => 'layout2',
						__( 'Layout 3', 'greenova-core' ) => 'layout3',
						__( 'Layout 4', 'greenova-core' ) => 'layout4',
						__( 'Layout 5', 'greenova-core' ) => 'layout5',
						__( 'Layout 6', 'greenova-core' ) => 'layout6',
						__( 'Layout 7', 'greenova-core' ) => 'layout7',
						__( 'Layout 8', 'greenova-core' ) => 'layout8',
						__( 'Layout 9', 'greenova-core' ) => 'layout9',
						__( 'Layout 10', 'greenova-core' ) => 'layout10',
						__( 'Layout 11', 'greenova-core' ) => 'layout11',
						),
					),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Icon Type", 'greenova-core' ),
					"param_name" => "icontype",
					'value' => array(
						__( 'FontAwesome', 'greenova-core' )  => 'fontawesome',
						__( 'FlatIcon', 'greenova-core' )      => 'flaticon',
						__( 'Custom Image', 'greenova-core' ) => 'image',
						),
					'dependency' => array(
						'element' => 'layout',
						'value'   => array( 'layout1','layout2','layout3','layout4','layout5','layout6','layout7', 'layout8', 'layout9', 'layout11' ),
						),
					),
				array(
					'type' => 'iconpicker',
					'heading' => __( 'FontAwesome Icon', 'greenova-core' ),
					'param_name' => 'icon_fa',
					"value" => 'fa fa-pagelines',
					'settings' => array(
						'emptyIcon' => false,
						'iconsPerPage' => 160,
						),
					'dependency' => array(
						'element' => 'icontype',
						'value'   => array( 'fontawesome' ),
						),
					),
				array(
					'type' => 'iconpicker',
					'heading' => __( 'Flaticon', 'greenova-core' ),
					'param_name' => 'icon_flat',
					"value" => 'flaticon-green-interface',
					'settings' => array(
						'emptyIcon' => false,
						'type' => 'flaticon',
						'iconsPerPage' => 300,
						),
					'dependency' => array(
						'element' => 'icontype',
						'value'   => array( 'flaticon' ),
						),
					),
				array(
					"type" => "attach_image",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Upload icon image", 'greenova-core' ),
					"param_name" => "image",
					'dependency' => array(
						'element' => 'icontype',
						'value'   => array( 'image' ),
						),
					),
				array(
					"type" => "colorpicker",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Icon color", 'greenova-core' ),
					"param_name" => "color",
					"value" => "",
					'dependency' => array(
						'element' => 'layout',
						'value'   => array( 'layout1', 'layout2', 'layout3', 'layout4', 'layout5', 'layout6', 'layout7', 'layout8', 'layout9', 'layout11' ),
						),
					),
				array(
					"type" => "colorpicker",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Icon hover color", 'greenova-core' ),
					"param_name" => "icon_hov_color",
					"value" => "#222222",
					'dependency' => array(
						'element' => 'layout',
						'value'   => array( 'layout8' ),
						),
					),
				array(
					"type" => "colorpicker",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Mouseover color", 'greenova-core' ),
					"param_name" => "hovercolor",
					"value" => "",
					'dependency' => array(
						'element' => 'layout',
						'value'   => array( 'layout1', 'layout3' ),
						),
					),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Icon Alignment", 'greenova-core' ),
					"param_name" => "icon_alignment",
					'value' => array(
						__( 'Left', 'greenova-core' )  => 'left',
						__( 'Right', 'greenova-core' ) => 'right',
						),
					'dependency' => array(
						'element' => 'layout',
						'value'   => array( 'layout4' ),
						),
					),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Show Icon Border", 'greenova-core' ),
					"param_name" => "show_icon_border",
					'value' => array(
						__( 'Show', 'greenova-core' )  => 'true',
						__( 'Hide', 'greenova-core' ) => 'false',
						),
					'dependency' => array(
						'element' => 'layout',
						'value'   => array( 'layout1' ),
						),
					),
				array(
					"type" => "colorpicker",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Icon Background color", 'greenova-core' ),
					"param_name" => "icon_bg_color",
					"value" => "",
					'dependency' => array(
						'element' => 'layout',
						'value'   => array( 'layout1' ),
						),
					),
				array(
					"type" => "colorpicker",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Icon Border color", 'greenova-core' ),
					"param_name" => "icon_brcolor",
					"value" => "",
					'dependency' => array(
						'element' => 'layout',
						'value'   => array( 'layout2' ),
						),
					),
				array(
					"type" => "colorpicker",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Info Box Background color", 'greenova-core' ),
					"param_name" => "bgcolor",
					"value" => "",
					'dependency' => array(
						'element' => 'layout',
						'value'   => array( 'layout4', 'layout6', 'layout7', 'layout9', 'layout11' ),
						),
					),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Icon size", 'greenova-core' ),
					"param_name" => "size",
					'description' => __( 'Icon size in px eg. 30', 'greenova-core' ),
					'dependency' => array(
						'element' => 'layout',
						'value'   => array( 'layout1', 'layout3', 'layout4', 'layout6', 'layout7', 'layout8', 'layout11' ),
						),
					),
				array(
					"type"		  => "attach_image",
					"holder" 	  => "div",
					"class" 	  => "",
					"heading" 	  => __( "Background Image", 'greenova-core' ),
					"param_name"  => "back_image",
					'dependency' => array(
						'element' => 'layout',
						'value'   => array( 'layout10' ),
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
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Sub Title", 'greenova-core' ),
					"param_name" => "sub_title",
					"value" => '',
					'dependency' => array(
						'element' => 'layout',
						'value'   => array( 'layout10' ),
						),
					),
				array(
					"type" => "colorpicker",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Title color", 'greenova-core' ),
					"param_name" => "title_color",
					"value" => "#222222",
					'dependency' => array(
						'element' => 'layout',
						'value'   => array( 'layout1', 'layout2', 'layout3', 'layout4', 'layout6', 'layout7', 'layout8', 'layout9', 'layout10', 'layout11' ),
						),
					),
				array(
					"type" => "colorpicker",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Sub Title color", 'greenova-core' ),
					"param_name" => "sub_title_color",
					"value" => "#222222",
					'dependency' => array(
						'element' => 'layout',
						'value'   => array( 'layout10' ),
						),
					),
				array(
					"type" => "colorpicker",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Title Hover Color", 'greenova-core' ),
					"param_name" => "title_hover_color",
					"value" => "#222222",
					'dependency' => array(
						'element' => 'layout',
						'value'   => array( 'layout1', 'layout3', 'layout4', 'layout8' ),
						),
					),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Title URL", 'greenova-core' ),
					"param_name" => "url",
					'description' => __( "keep this field empty if you don't want the title linkable", 'greenova-core' ),
					),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Title Font Size", 'greenova-core' ),
					"param_name" => "title_size",
					'description' => __( 'Title font size in px. eg 20. If not defined, default h3 font size will be used', 'greenova-core' ),		
					"value" => "20",
					'dependency' => array(
						'element' => 'layout',
						'value'   => array( 'layout1', 'layout2', 'layout3' ),
						),
					),
				array(
					"type" => "textarea_html",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Content", 'greenova-core' ),
					"param_name" => "content",
					"value" => __( 'Content Sample', 'greenova-core' ),
					'dependency' => array(
						'element' => 'layout',
						'value'   => array( 'layout1', 'layout2', 'layout3', 'layout4', 'layout5', 'layout7', 'layout9', 'layout11' ),
						),
					),
				array(
					'type' => 'param_group',
					'value' => '',
					'param_name' => 'feature_lists',
					'params' => array(
						array(
							'type' => 'textfield',
							'heading' => 'Feature List',
							'param_name' => 'feature_list',
							"value" => $this->translate['title'],
						),
					),
					'dependency' => array(
						'element' => 'layout',
						'value'   => array( 'layout10' ),
						),
				),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Content Font Size", 'greenova-core' ),
					"param_name" => "content_size",
					'description' => __( 'Content font size in px eg. 15. If not defined, default body font size will be used', 'greenova-core' ),
					'dependency' => array(
						'element' => 'layout',
						'value'   => array( 'layout1', 'layout2', 'layout3' ),
						),
					),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Content Width", 'greenova-core' ),
					"param_name" => "width",
					'description' => __( "Content maximum width in px eg 360. Keep this field empty if you want full width", 'greenova-core' ),
					'dependency' => array(
						'element' => 'layout',
						'value'   => array( 'layout1', 'layout3' ),
						),
					),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Spacing Before Title", 'greenova-core' ),
					"param_name" => "spacing_top",
					"description" => __( "Spacing between icon and title in px eg. 25", 'greenova-core' ),
					'dependency' => array(
						'element' => 'layout',
						'value'   => array( 'layout1', 'layout3' ),
						),
					),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Spacing After Title", 'greenova-core' ),
					"param_name" => "spacing_bottom",
					"description" => __( "Spacing between title and content in px eg. 12", 'greenova-core' ),
					'dependency' => array(
						'element' => 'layout',
						'value'   => array( 'layout1', 'layout3' ),
						),
					),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Display Button", 'greenova-core' ),
					"param_name" => "display_button",
					"value" => array( 
						__( "Enabled", 'greenova-core' )  => 'true',
						__( "Disabled", 'greenova-core' ) => 'false',
					),
					'dependency'  => array(
						'element' => 'layout',
						'value'   => array( 'layout2', 'layout3', 'layout5', 'layout6', 'layout7', 'layout8', 'layout9', 'layout11' ),
					),					
				),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Button Style", 'greenova-core' ),
					"param_name" => "button_style",
					'value' => array(
						__( 'Light', 'greenova-core' ) => 'light',
						__( 'Dark', 'greenova-core' )  => 'dark',
						),
					'dependency' => array(
						'element' => 'layout',
						'value'   => array( 'layout6', 'layout8', 'layout9' ),
					),
				),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Button Text", 'greenova-core' ),
					"param_name" => "button_text",
					"value" => $this->translate['button_text'],
					'dependency' => array(
						'element' => 'display_button',
						'value'   => array( 'true' ),
					),
				),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Button URL", 'greenova-core' ),
					"param_name" => "button_url",
					'dependency' => array(
						'element' => 'display_button',
						'value'   => array( 'true' ),
					),
				),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Custom Class", 'greenova-core' ),
					"param_name" => "custom_class",
					'description' => __( 'Enter Class Name eg. column321', 'greenova-core' ),
					'dependency' => array(
						'element' => 'layout',
						'value'   => array( 'layout1' ),
						),
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
				'layout'         	=> 'layout1',
				'icontype'       	=> 'fontawesome',
				'icon_flat'    		=> 'flaticon-green-interface',
				'icon_fa'        	=> 'fa fa-pagelines',
				'color'          	=> '',
				'icon_hov_color'    => '#222222',
				'hovercolor'     	=> '',
				'icon_bg_color'    	=> '',
				'icon_alignment'   	=> 'left',
				'icon_brcolor'    	=> '',
				'bgcolor'          	=> '',
				'image'          	=> '',
				'back_image'        => '',
				'size'           	=> '',
				'icon_padding'   	=> '',
				'title'          	=> $this->translate['title'],
				'sub_title'         => $this->translate['sub_title'],
				'title_color'    	=> '#222222',
				'sub_title_color'   => '#222222',
				'title_hover_color' => '',
				'url'            	=> '',
				'title_size'     	=> '20',
				'content_size'   	=> '',
				'width'          	=> '',
				'spacing_top'    	=> '',
				'spacing_bottom' 	=> '',
				'display_button' 	=> 'true',
				'show_icon_border' 	=> 'true',
				'button_style' 		=> 'light',
				'button_text' 		=> $this->translate['button_text'],
				'button_url' 		=> '',
				'feature_lists' 	=> '',
				'feature_list'	 	=> '',
				'custom_class' 		=> '',
				'css'            	=> '',
				), $atts ) );
			
			// validation
			$icon  = ( $icontype == 'flaticon' ) ? $icon_flat : $icon_fa;

			if ( $icontype == 'flaticon' ) {
				vc_icon_element_fonts_enqueue( $icon );
			}
			
			switch ( $layout ) {
				case 'layout11':
					$template = 'info-text-11';
				break;
				case 'layout10':
					$template = 'info-text-10';
				break;
				case 'layout9':
					$template = 'info-text-9';
				break;
				case 'layout8':
					$template = 'info-text-8';
				break;
				case 'layout7':
					$template = 'info-text-7';
				break;
				case 'layout6':
					$template = 'info-text-6';
				break;
				case 'layout5':
					$template = 'info-text-5';
				break;
				case 'layout4':
					$template = 'info-text-4';
				break;
				case 'layout3':
					$template = 'info-text-3';
				break;
				case 'layout2':
					$template = 'info-text-2';
				break;
				default:
					$template = 'info-text-1';
				break;
			}

			return $this->template( $template, get_defined_vars() );
		}
	}
}

new GREENOVA_Theme_VC_Info_Text;