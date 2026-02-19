<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */
if ( ! defined( 'ABSPATH' ) ) exit;

if ( !class_exists( 'GREENOVA_Theme_VC_Testimonial' ) ) {

	class GREENOVA_Theme_VC_Testimonial extends GREENOVA_Theme_VC_Modules {

		public function __construct(){
			$this->name = __( "Greenova: Testimonial", 'greenova-core' );
			$this->base = 'greenova-vc-testimonial';
			$this->translate = array(
				'cols' => array( 
					__( '1 col', 'greenova-core' ) => '12',
					__( '2 col', 'greenova-core' ) => '6',
					__( '3 col', 'greenova-core' ) => '4',
					__( '4 col', 'greenova-core' ) => '3',
					__( '6 col', 'greenova-core' ) => '2',
				),
				'sectiontitle'  => __( 'What Our Custmer Say', 'greenova-core' ),
			);
			parent::__construct();
		}
		
		public function load_scripts(){	
			wp_enqueue_style( 'owl-carousel' );
			wp_enqueue_style( 'owl-theme-default' );
			wp_enqueue_script( 'owl-carousel' );	
		}

		public function fields(){
			
			$terms = get_terms( array('taxonomy' => 'greenova_testimonial_category') );
			$category_dropdown = array( __( 'All Categories', 'greenova-core' ) => '0' );
			foreach ( $terms as $category ) {
				$category_dropdown[$category->name] = $category->term_id;
			}

			$fields = array(
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Layout", 'greenova-core' ),
					"param_name" => "layout",
					'value' => array( 
						__( 'Layout 1', 'greenova-core' ) => 'layout7',
						__( 'Layout 2', 'greenova-core' ) => 'layout1',
						__( 'Layout 3', 'greenova-core' ) => 'layout3',
						__( 'Layout 4', 'greenova-core' ) => 'layout6',
						__( 'Layout 5', 'greenova-core' ) => 'layout8',
						__( 'Layout 6', 'greenova-core' ) => 'layout9',
						__( 'Layout 7', 'greenova-core' ) => 'layout10',
						),
					),
				array(
					"type" => "colorpicker",
					"class" => "",
					"heading" => __( "Title color", "greenova-core" ),
					"param_name" => "title_color",
					"value" => '',
				),
				array(
					"type" => "colorpicker",
					"class" => "",
					"heading" => __( "Designation color", "greenova-core" ),
					"param_name" => "designation_color",
					"value" => '#444444',
				),
				array(
					"type" => "colorpicker",
					"class" => "",
					"heading" => __( "Text color", "greenova-core" ),
					"param_name" => "text_color",
					"value" => '#444444',
				),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Content Limit", 'greenova-core' ),
					"param_name" => "limit",
					"value" => 15,
					'description' => __( 'Write number to show all content.', 'greenova-core' ),
					),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Total number of items", 'greenova-core' ),
					"param_name" => "slider_item_number",
					"value" => "4",
					'description' => __( 'Write -1 to show all', 'greenova-core' ),
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
					"heading" => __( "Show Title", 'greenova-core' ),
					"param_name" => "showtitle",
					'value' => array(
						__( "Enabled", 'greenova-core' )  => 'true',
						__( "Disabled", 'greenova-core' )  => 'false',
						),
					'dependency' => array(
						'element' => 'layout',
						'value' => array( 'layout6', 'layout7' , 'layout8' , 'layout9', 'layout10' ),
						),
					),
				array(
					"type" 		  => "textfield",
					"holder" 	  => "div",
					"class" 	  => "",
					"heading" 	  => __( "Section Title", 'greenova-core' ),
					"param_name"  => "sectiontitle",
					"value" 	  => $this->translate['sectiontitle'],
					'dependency' => array(
						'element' => 'showtitle',
						'value'   => array( 'true' ),
						),
				),				
				array(
					"type" => "colorpicker",
					"class" => "",
					"heading" => __( "Section Title color", "greenova-core" ),
					"param_name" => "section_title_color",
					"value" => '444444',
					'dependency' => array(
						'element' => 'showtitle',
						'value'   => array( 'true' ),
						),
				),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Number of columns ( Desktops > 1199px )", 'greenova-core' ),
					"param_name" => "col_lg",
					"value" => $this->translate['cols'],
					"std" => "4",
					'dependency' => array(
						'element' => 'layout',
						'value'   => array( 'layout1' , 'layout7' , 'layout8', 'layout10' ),
						),
					),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Number of columns ( Desktops > 991px )", 'greenova-core' ),
					"param_name" => "col_md",
					"value" => $this->translate['cols'],
					"std" => "4",
					'dependency' => array(
						'element' => 'layout',
						'value'   => array( 'layout1' , 'layout7' , 'layout8', 'layout10' ),
						),
					),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Number of columns ( Tablets > 767px )", 'greenova-core' ),
					"param_name" => "col_sm",
					"value" => $this->translate['cols'],
					"std" => "4",
					'dependency' => array(
						'element' => 'layout',
						'value'   => array( 'layout1' , 'layout7' , 'layout8', 'layout10' ),
						),
					),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Number of columns ( Phones < 768px )", 'greenova-core' ),
					"param_name" => "col_xs",
					"value" => $this->translate['cols'],
					"std" => "6",
					'dependency' => array(
						'element' => 'layout',
						'value'   => array( 'layout1' , 'layout7' , 'layout8', 'layout10' ),
						),
					),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Number of columns ( Small Phones < 480px )", 'greenova-core' ),
					"param_name" => "col_mobile",
					"value" => $this->translate['cols'],
					"std" => "12",
					'dependency' => array(
						'element' => 'layout',
						'value'   => array( 'layout1' , 'layout7' , 'layout8', 'layout10' ),
						),
					),
				// Slider options							
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Navigation Arrow", 'greenova-core' ),
					"param_name" => "slider_nav",
					"value" => array(
						__( "Enable", "greenova-core" )  => 'true', 
						__( "Disable", "greenova-core" ) => 'false',
						),					
					"group" => __( "Slider Options", 'greenova-core' ),
					),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Navigation Dots", 'greenova-core' ),
					"param_name" => "slider_dots",
					"value" => array(
						__( 'Enabled', 'greenova-core' )  => 'true',
						__( 'Disabled', 'greenova-core' ) => 'false',
						),					
					"group" => __( "Slider Options", 'greenova-core' ),
					),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Autoplay", 'greenova-core' ),
					"param_name" => "slider_autoplay",
					"value" => array( 
						__( "Enabled", "greenova-core" )  => 'true',
						__( "Disabled", "greenova-core" ) => 'false',
					),
					"description" => __( "Enabled or disabled autoplay. Default: Enabled", 'greenova-core' ),
					"group" => __( "Slider Options", 'greenova-core' ),
				),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Stop on Hover", 'greenova-core' ),
					"param_name" => "slider_stop_on_hover",
					"value" => array( 
						__( "Enabled", "greenova-core" )  => 'true',
						__( "Disabled", "greenova-core" ) => 'false',
					),
					'dependency' => array(
						'element' => 'slider_autoplay',
						'value'   => array( 'true' ),
					),
					"description" => __( "Stop autoplay on mouse hover. Default: Enabled", 'greenova-core' ),
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
						__( "Enabled", "greenova-core" )  => 'true',
						__( "Disabled", "greenova-core" ) => 'false',
					),
					"description"=> __( "Loop to first item. Default: Enabled", 'greenova-core' ),
					"group" 	 => __( "Slider Options", 'greenova-core' ),
				),
			);

			return $fields;
		}

		public function shortcode( $atts, $content = '' ){
			extract( shortcode_atts( array(
				'layout'                => 'layout7',
				'title_color'		    => '',
				'designation_color'     => '#444444',				
				'text_color'  	        => '#444444',
				'slider_item_number'    => '4',
				'cat'    				=> '',
				'order'					=> 'DESC',
				'orderby'				=> '',
				'limit'    				=> '15',
				'showtitle' 	  		=> 'true',
				'sectiontitle' 	   		=> $this->translate['sectiontitle'],
				'section_title_color' 	=> '#444444',
				'col_lg'                => '4',
				'col_md'                => '4',
				'col_sm'                => '4',
				'col_xs'                => '6',
				'col_mobile'            => '12',
				'slider_nav'           	=> 'true',
				'slider_dots'           => 'true',
				'slider_autoplay'       => 'true',
				'slider_stop_on_hover'  => 'true',
				'slider_interval'       => '5000',
				'slider_autoplay_speed' => '200',
				'slider_loop'           => 'true',
				), $atts ) );

			$slider_item_number = intval( $slider_item_number );

			$owl_data = array( 
				'nav'                => ( $slider_nav === 'true' ) ? true : false,
				'navText'            => array( "<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>" ),
				'dots'               => ( $slider_dots === 'true' ) ? true : false,
				'autoplay'           => ( $slider_autoplay === 'true' ) ? true : false,
				'autoplayTimeout'    => $slider_interval,
				'autoplaySpeed'      => $slider_autoplay_speed,
				'autoplayHoverPause' => ( $slider_stop_on_hover === 'true' ) ? true : false,
				'loop'               => ( $slider_loop === 'true' ) ? true : false,
				'margin'             => 0,
				'responsive'         => array(
					'0'    => array( 'items' => 12 / $col_mobile ),
					'480'  => array( 'items' => 12 / $col_xs ),
					'768'  => array( 'items' => 12 / $col_sm ),
					'992'  => array( 'items' => 12 / $col_md ),
					'1200' => array( 'items' => 12 / $col_lg ),
				)
			);		
						
			switch ( $layout ) {
				case 'layout10':
					$owl_data['margin'] = 30;
					$template = 'testimonial-slider-10';
				break;
				case 'layout9':
					$owl_data['nav'] = false;
					$owl_data['dots'] = true;
					$owl_data['responsive'] = array(
					'0'    => array( 'items' => 1 )					
					);

					$template = 'testimonial-slider-9';
				break;
				case 'layout8':
					$template = 'testimonial-slider-8';
				break;
				case 'layout6':
					$owl_data['nav'] = false;
					$owl_data['responsive'] = array( '0' => array( 'items' => 1 ) );
					$template = 'testimonial-slider-6';
				break;
				case 'layout3':
					$owl_data['responsive'] = array( '0' => array( 'items' => 1 ) );
					$template = 'testimonial-slider-3';
				break;
				case 'layout1':
					$template = 'testimonial-slider-1';
				break;
				default:
					$template = 'testimonial-slider-7';
				break;
			}
			
			$owl_data = json_encode( $owl_data );
			$this->load_scripts();			

			return $this->template( $template, get_defined_vars() );
		}
	}
}

new GREENOVA_Theme_VC_Testimonial;