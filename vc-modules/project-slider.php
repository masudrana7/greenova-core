<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

if ( !class_exists( 'GREENOVA_Theme_VC_Project_Slider' ) ) {

	class GREENOVA_Theme_VC_Project_Slider extends GREENOVA_Theme_VC_Modules {

		public function __construct(){
			$this->name = __( "Greenova: Project Slider", 'greenova-core' );
			$this->base = 'greenova-vc-project';
			$this->translate = array(
				'title'    => __( "OUR PROJECTS", 'greenova-core' ),
				'subtitle' => __( "Worked We Have Done", 'greenova-core' ),
				'cols'   => array(
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
			$terms = get_terms( array( 'taxonomy' => 'greenova_project_category' ) );
			$category_dropdown = array( 'All Categories' => '0' );
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
						__( 'Layout 1', 'greenova-core' ) => 'layout1',
						__( 'Layout 2', 'greenova-core' ) => 'layout2',
						__( 'Layout 3', 'greenova-core' ) => 'layout3',
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
					'dependency'  => array(
						'element' => 'layout',
						'value'   => array( 'layout1' ),
						),
					),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Section Title", 'greenova-core' ),
					"param_name" => "title",
					"value" => $this->translate['title'],
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
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Show Link on Element", 'greenova-core' ),
					"param_name" => "showlink",
					"value" => array(
						__( "Enabled", "greenova-core" )  => 'true',
						__( "Disabled", "greenova-core" ) => 'false',
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
					"type" 		  => "textfield",
					"holder"      => "div",
					"class"       => "",
					"heading"     => __( "Word count", 'greenova-core' ),
					"param_name"  => "content_limit",
					"value" 	  => '18',
					'dependency'  => array(
						'element' => 'layout',
						'value'   => array( 'layout1', 'layout2' ),
						),
					'description' => __( 'Maximum number of words', 'greenova-core' ),
					),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Total number of items", 'greenova-core' ),
					"param_name" => "slider_item_number",
					"value" => 5,
					'description' => __( 'Write -1 to show all', 'greenova-core' ),
					),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Number of columns ( Desktops > 1199px )", 'greenova-core' ),
					"param_name" => "col_lg",
					"value" => $this->translate['cols'],
					"std" => "3",
					'dependency'  => array(
						'element' => 'layout',
						'value'   => array( 'layout1' , 'layout3' ),
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
					'dependency'  => array(
						'element' => 'layout',
						'value'   => array( 'layout1' , 'layout3' ),
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
					),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Number of columns ( Phones < 768px )", 'greenova-core' ),
					"param_name" => "col_xs",
					"value" => $this->translate['cols'],
					"std" => "6",
					'dependency'  => array(
						'element' => 'layout',
						'value'   => array( 'layout1' , 'layout3' ),
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
					'dependency'  => array(
						'element' => 'layout',
						'value'   => array( 'layout1' , 'layout3' ),
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
					'dependency'  => array(
						'element' => 'layout',
						'value'   => array( 'layout3', 'layout5' ),
						),
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
					'dependency'  => array(
						'element' => 'layout',
						'value'   => array( 'layout1' , 'layout3', 'layout5' ),
						),
					),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Autoplay", 'greenova-core' ),
					"param_name" => "slider_autoplay",
					"value" => array( 
						__( 'Enabled', 'greenova-core' )  => 'true',
						__( 'Disabled', 'greenova-core' ) => 'false',
						),
					"description" => __( "Enable or disable autoplay. Default: Enable", 'greenova-core' ),
					"group" => __( "Slider Options", 'greenova-core' ),
					'dependency'  => array(
						'element' => 'layout',
						'value'   => array( 'layout2' , 'layout3' , 'layout4' , 'layout5' ),
						),
					),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Stop on Hover", 'greenova-core' ),
					"param_name" => "slider_stop_on_hover",
					"value" => array( 
						__( 'Enabled', 'greenova-core' )  => 'true',
						__( 'Disabled', 'greenova-core' ) => 'false',
						),
					'dependency' => array(
						'element' => 'slider_autoplay',
						'value'   => array( 'true' ),
						),
					"description" => __( "Stop autoplay on mouse hover. Default: Enable", 'greenova-core' ),
					"group" => __( "Slider Options", 'greenova-core' ),
					'dependency'  => array(
						'element' => 'layout',
						'value'   => array( 'layout2' , 'layout3' , 'layout4' , 'layout5' ),
						),
					),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Autoplay Interval", 'greenova-core' ),
					"param_name" => "slider_interval",
					"value" => array( 
						__( '5 Seconds', 'greenova-core' ) => '5000',
						__( '4 Seconds', 'greenova-core' ) => '4000',
						__( '3 Seconds', 'greenova-core' ) => '3000',
						__( '2 Seconds', 'greenova-core' ) => '4000',
						__( '1 Second', 'greenova-core' )  => '1000',
						),
					'dependency' => array(
						'element' => 'slider_autoplay',
						'value'   => array( 'true' ),
						),
					"description" => __( "Set any value for example 5 seconds to play it in every 5 seconds. Default: 5 Seconds", 'greenova-core' ),
					"group" => __( "Slider Options", 'greenova-core' ),
					'dependency'  => array(
						'element' => 'layout',
						'value'   => array( 'layout2' , 'layout3' , 'layout4' , 'layout5' ),
						),
					),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Autoplay Slide Speed", 'greenova-core' ),
					"param_name" => "slider_autoplay_speed",
					"value" => 200,
					'dependency' => array(
						'element' => 'slider_autoplay',
						'value'   => array( 'true' ),
						),
					"description" => __( "Slide speed in milliseconds. Default: 200", 'greenova-core' ),
					"group" => __( "Slider Options", 'greenova-core' ),
					'dependency'  => array(
						'element' => 'layout',
						'value'   => array( 'layout2' , 'layout3' , 'layout4' , 'layout5'  ),
						),
					),	
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Loop", 'greenova-core' ),
					"param_name" => "slider_loop",
					"value" => array( 
						__( 'Enabled', 'greenova-core' )  => 'true',
						__( 'Disabled', 'greenova-core' ) => 'false',
						),
					"description" => __( "Loop to first item. Default: Enable", 'greenova-core' ),
					"group" => __( "Slider Options", 'greenova-core' ),
					'dependency'  => array(
						'element' => 'layout',
						'value'   => array( 'layout2' , 'layout3' , 'layout4' , 'layout5' ),
						),
					)
			);

			return $fields;
		}

		public function shortcode( $atts, $content = '' ){
			extract( shortcode_atts( array(
				'layout'                => 'layout1',
				'title'     			=> $this->translate['title'],
				'subtitle'     			=> $this->translate['subtitle'],
				'showtitle'             => 'true',
				'showlink'              => 'true',
				'section_title_color'   => '#222222',
				'content_limit'         => '18',
				'slider_item_number'    => '5',
				'cat'                   => '',
				'order'					=> 'DESC',
				'orderby'				=> '',
				'col_lg'                => '3',
				'col_md'                => '4',
				'col_sm'                => '4',
				'col_xs'                => '6',
				'col_mobile'            => '12',
				// slider
				'slider_nav'            => 'true',
				'slider_dots'           => 'true',
				'slider_autoplay'       => 'true',
				'slider_stop_on_hover'  => 'true',
				'slider_interval'       => '5000',
				'slider_autoplay_speed' => '200',
				'slider_loop'           => 'true',
				), $atts ) );
			
			// validation
			$content_limit         = intval( $content_limit );
			$slider_item_number    = intval( $slider_item_number );
			$cat                   = empty( $cat ) ? '' : $cat;

			$owl_data = array( 
				'nav'                => ( $slider_nav === 'true' ) ? true : false,
				'navText'            => array( "<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>" ),
				'dots'               => ( $slider_dots === 'true' ) ? true : false,
				'autoplay'           => ( $slider_autoplay === 'true' ) ? true : false,
				'autoplayTimeout'    => $slider_interval,
				'autoplaySpeed'      => $slider_autoplay_speed,
				'autoplayHoverPause' => ( $slider_stop_on_hover === 'true' ) ? true : false,
				'loop'               => ( $slider_loop === 'true' ) ? true : false,
				'margin'             => 20,
				'responsive'         => array(
					'0'    => array( 'items' => 12 / $col_mobile ),
					'480'  => array( 'items' => 12 / $col_xs ),
					'768'  => array( 'items' => 12 / $col_sm ),
					'992'  => array( 'items' => 12 / $col_md ),
					'1200' => array( 'items' => 12 / $col_lg ),
					)
				);
						
			switch ( $layout ) {
				case 'layout2':
				$template = 'project-slider-2';
				break;
				case 'layout3':
				$template = 'project-slider-3';
				break;
				default:
					$template = 'project-slider-1';
				break;
			}
				$owl_data = json_encode( $owl_data );
				$this->load_scripts();
			
			
			return $this->template( $template, get_defined_vars() );
		}
	}
}

new GREENOVA_Theme_VC_Project_Slider;