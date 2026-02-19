<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */
if ( ! defined( 'ABSPATH' ) ) exit;

if ( !class_exists( 'GREENOVA_Theme_VC_Post' ) ) {
		
	class GREENOVA_Theme_VC_Post extends GREENOVA_Theme_VC_Modules {

		public function __construct(){
			$this->name = __( "greenova: Post Slider", 'greenova-core' );
			$this->base = 'greenova-vc-post';
			$this->translate = array(
				'title'    => __( "Our Latest News", 'greenova-core' ),
				'subtitle' => __( "Expert Tips & Tricks", 'greenova-core' ),
				'cols' => array( 
					__( '1 col', 'greenova-core' ) => '12',
					__( '2 col', 'greenova-core' ) => '6',
					__( '3 col', 'greenova-core' ) => '4',
					__( '4 col', 'greenova-core' ) => '3',
					__( '6 col', 'greenova-core' ) => '2',
				),
			);
			parent::__construct();
		}
		
		public function load_scripts(){	
			wp_enqueue_style( 'owl-carousel' );
			wp_enqueue_style( 'owl-theme-default' );
			wp_enqueue_script( 'owl-carousel' );	
		}

		public function fields(){
			$categories = get_categories();
			$category_dropdown = array( 'All Categories' => '0' );

			foreach ( $categories as $category ) {
				$category_dropdown[$category->name] = $category->term_id;
			}
			
			$fields = array(
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Style", 'greenova-core' ),
					"param_name" => "slider_style",
					"value" => array( 
						__( 'Style 1', 'greenova-core' ) => 'style1',
						__( 'Style 2', 'greenova-core' ) => 'style2',
						__( 'Style 3', 'greenova-core' ) => 'style5',
						__( 'Style 4', 'greenova-core' ) => 'style6',
						__( 'Style 5', 'greenova-core' ) => 'style7',
						__( 'Style 6', 'greenova-core' ) => 'style8',
						),
					),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Categories", 'greenova-core' ),
					"param_name" => "cat",
					'value' => $category_dropdown,
					),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Order By", 'greenova-core' ),
					"param_name" => "orderby",
					'value' => array(
						__( "None", 'greenova-core' )  => '',
						__( "Name", 'greenova-core' )  => 'title',
						__( "ID", 'greenova-core' )    => 'ID',
						__( "Date", 'greenova-core' )  => 'date',
						__( "Menu Order", 'greenova-core' )  => 'menu_order',
						),
					),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Post Display Order", 'greenova-core' ),
					"param_name" => "order",
					'value' => array(
						__( "Descending", 'greenova-core' )  => 'DESC',
						__( "Ascending", 'greenova-core' )  => 'ASC',
						),
					),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Section Title Display", 'greenova-core' ),
					"param_name" => "showtitle",
					"value" => array( 
						__( "Enabled", "greenova-core" )  => 'true',
						__( "Disabled", "greenova-core" ) => 'false',
						),					
					'dependency' => array(
						'element' => 'slider_style',
						'value'   => array( 'style1', 'style2', 'style5', 'style8'  ),
						),
					),
				array(
					"type"		  => "textfield",
					"holder" 	  => "div",
					"class" 	  => "",
					"heading" 	  => __( "Section Title", 'greenova-core' ),
					"param_name"  => "title",
					"value"       => $this->translate['title'],
					'dependency' => array(
						'element' => 'showtitle',
						'value'   => array( 'true' ),
						),
					),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Section SubTitle", 'greenova-core' ),
					"param_name" => "subtitle",
					"value" => $this->translate['subtitle'],
					'dependency' => array(
						'element' => 'showtitle',
						'value'   => array( 'true' ),
						),
					),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Show Comment Count", 'greenova-core' ),
					"param_name" => "showcomment",
					"value" => array( 
						__( "Enabled", "greenova-core" )  => 'true',
						__( "Disabled", "greenova-core" ) => 'false',
						),					
					'dependency' => array(
						'element' => 'slider_style',
						'value'   => array( 'style1', 'style2', 'style5', 'style8' ),
						),
					),
				array(
					"type" => "colorpicker",
					"class" => "",
					"heading" => __( "Section Title Color", "greenova-core" ),
					"param_name" => "section_title_color",
					"value" => '#222222',
					'dependency' => array(
						'element' => 'showtitle',
						'value'   => array( 'true' ),
						),
				),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Word count", 'greenova-core' ),
					"param_name" => "count",
					"value" => 15,
					'dependency'  => array(
						'element' => 'slider_style',
						'value'   => array( 'style2' ),
						),
					'description' => __( 'Maximum number of words', 'greenova-core' ),
					),				
				array(				
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Total number of items", 'greenova-core' ),
					"param_name" => "slider_item_number",
					"value" => 6,
					'description' => __( 'Write -1 to show all', 'greenova-core' ),
					),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Number of columns ( Desktops > 1199px )", 'greenova-core' ),
					"param_name" => "col_lg",
					"value" => $this->translate['cols'],
					"std" => "4",
					),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Number of columns ( Desktops > 991px )", 'greenova-core' ),
					"param_name" => "col_md",
					"value" => $this->translate['cols'],
					"std" => "4",
					),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Number of columns ( Tablets > 767px )", 'greenova-core' ),
					"param_name" => "col_sm",
					"value" => $this->translate['cols'],
					"std" => "4",
					),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Number of columns ( Phones < 768px )", 'greenova-core' ),
					"param_name" => "col_xs",
					"value" => $this->translate['cols'],
					"std" => "6",
					),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Number of columns ( Small Phones < 480px )", 'greenova-core' ),
					"param_name" => "col_mobile",
					"value" => $this->translate['cols'],
					"std" => "12",
					),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Navigation Dots", 'greenova-core' ),
					"param_name" => "slider_dots",
					"value" => array(
						__( 'Disabled', 'greenova-core' ) => 'false',
						__( 'Enabled', 'greenova-core' )  => 'true',
						),
					"description" => __( "Enable or disable navigation dots. Default: Disable", 'greenova-core' ),
					"group" => __( "Slider Options", 'greenova-core' ),
					'dependency'  => array(
						'element' => 'slider_style',
						'value'   => array( 'style1', 'style8' ),
						),
					),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Autoplay", 'greenova-core' ),
					"param_name" => "slider_autoplay",
					"value" => array( 
						__( "Enable", "greenova-core" )  => 'true',
						__( "Disable", "greenova-core" ) => 'false',
						),
					"description" => __( "Enable or disable autoplay. Default: Enable", 'greenova-core' ),
					"group" => __( "Slider Options", 'greenova-core' ),
					),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Stop on Hover", 'greenova-core' ),
					"param_name" => "slider_stop_on_hover",
					"value" => array( 
						__( "Enable", "greenova-core" )  => 'true',
						__( "Disable", "greenova-core" ) => 'false',
						),
					'dependency' => array(
						'element' => 'slider_autoplay',
						'value'   => array( 'true' ),
						),
					"description" => __( "Stop autoplay on mouse hover. Default: Enable", 'greenova-core' ),
					"group" => __( "Slider Options", 'greenova-core' ),
					),
				array(
					"type" 		  => "dropdown",
					"holder" 	  => "div",
					"class" 	  => "",
					"heading" 	  => __( "Autoplay Interval", 'greenova-core' ),
					"param_name"  => "slider_interval",
					"value" 	  => array( 
						__( "5 Seconds", "greenova-core" )  => '5000',
						__( "4 Seconds", "greenova-core" )  => '4000',
						__( "3 Seconds", "greenova-core" )  => '3000',
						__( "2 Seconds", "greenova-core" )  => '4000',
						__( "1 Seconds", "greenova-core" )  => '1000',
						),
					'dependency'  => array(
						'element' => 'slider_autoplay',
						'value'   => array( 'true' ),
						),
					"description" => __( "Set any value for example 5 seconds to play it in every 5 seconds. Default: 5 Seconds", 'greenova-core' ),
					"group" 	  => __( "Slider Options", 'greenova-core' ),
					),
				array(
					"type"		  => "textfield",
					"holder" 	  => "div",
					"class" 	  => "",
					"heading" 	  => __( "Autoplay Slide Speed", 'greenova-core' ),
					"param_name"  => "slider_autoplay_speed",
					"value" 	  => 200,
					'dependency'  => array(
						'element' => 'slider_autoplay',
						'value'   => array( 'true' ),
						),
					"description" => __( "Slide speed in milliseconds. Default: 200", 'greenova-core' ),
					"group" 	  => __( "Slider Options", 'greenova-core' ),
					),	
				array(
					"type" 		 => "dropdown",
					"holder" 	 => "div",
					"class" 	 => "",
					"heading" 	 => __( "Loop", 'greenova-core' ),
					"param_name" => "slider_loop",
					"value" 	 => array( 
						__( "Enable", "greenova-core" )  => 'true',
						__( "Disable", "greenova-core" ) => 'false',
						),
					"description"=> __( "Loop to first item. Default: Enable", 'greenova-core' ),
					"group" 	 => __( "Slider Options", 'greenova-core' ),
					),
			);

			return $fields;
		}

		public function shortcode( $atts, $content = '' ){
			extract( shortcode_atts( array(
				'slider_style'          => 'style1',
				'cat'                   => '',
				'order'					=> 'DESC',
				'orderby'				=> '',
				'title'     			=> $this->translate['title'],
				'subtitle'     			=> $this->translate['subtitle'],
				'showtitle'             => 'true',
				'showcomment'           => 'true',
				'section_title_color'   => '#222222',
				'slider_item_number'    => '6',
				'count'                 => 15,
				'col_lg'                => '4',
				'col_md'                => '4',
				'col_sm'                => '4',
				'col_xs'                => '6',
				'col_mobile'            => '12',
				'slider_nav'            => 'true',
				'slider_dots'           => 'false',
				'slider_autoplay'       => 'true',
				'slider_stop_on_hover'  => 'true',
				'slider_interval'       => '5000',
				'slider_autoplay_speed' => '200',
				'slider_loop'           => 'true',
				), $atts ) );

			$slider_style          = esc_attr( $slider_style );
			$slider_item_number    = intval( $slider_item_number );
			$cat                   = empty( $cat ) ? '' : $cat;

			$owl_data = array( 
				'nav'                => ( $slider_nav === 'true' ) ? true : false,
				'navText'            => array( "<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>" ),
				'dots'               => ( $slider_dots === 'false' ) ? false : true,
				'autoplay'           => ( $slider_autoplay === 'true' ) ? true : false,
				'autoplayTimeout'    => $slider_interval,
				'autoplaySpeed'      => $slider_autoplay_speed,
				'autoplayHoverPause' => ( $slider_stop_on_hover === 'true' ) ? true : false,
				'loop'               => ( $slider_loop === 'true' ) ? true : false,
				'margin'             => 10,
				'responsive'         => array(
					'0'    => array( 'items' => 12 / $col_mobile ),
					'480'  => array( 'items' => 12 / $col_xs ),
					'768'  => array( 'items' => 12 / $col_sm ),
					'992'  => array( 'items' => 12 / $col_md ),
					'1200' => array( 'items' => 12 / $col_lg ),
					)
				);
						
			switch ( $slider_style ) {
				case 'style8':
					$template = 'post-style-8';
				break;
				case 'style7':
					$template = 'post-style-7';
				break;
				case 'style6':
					$template = 'post-style-6';
				break;
				case 'style5':
					$owl_data['margin'] = 30;
					$template = 'post-style-5';
				break;
				case 'style2':
					$owl_data['dots'] = true;
					$template = 'post-style-2';
				break;
				default:
					$template = 'post-style-1';
				break;
			}
			
			$owl_data = json_encode( $owl_data );
			$this->load_scripts();

			return $this->template( $template, get_defined_vars() );
			
		}
	}
}
	
new GREENOVA_Theme_VC_Post;