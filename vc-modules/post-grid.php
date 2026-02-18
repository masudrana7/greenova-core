<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

if ( !class_exists( 'GREENOVA_Theme_VC_Post_Grid' ) ) {
		
	class GREENOVA_Theme_VC_Post_Grid extends GREENOVA_Theme_VC_Modules {

		public function __construct(){
			$this->name = __( "greenova: Post Grid", 'greenova-core' );
			$this->base = 'greenova-vc-post-grid';
			$this->translate = array(
				'title'    => __( "Our Latest News", 'greenova-core' ),
				'subtitle' => __( "Expert Tips & Tricks", 'greenova-core' ),
				'buttontext'		=> __( 'View All', 'greenova-core' ),
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
					"param_name" => "grid_style",
					"value" => array( 
						__( 'Style 1', 'greenova-core' ) => 'style1',
						__( 'Style 2', 'greenova-core' ) => 'style2',
						__( 'Style 3', 'greenova-core' ) => 'style3',
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
					"heading" => __( "Show Comment Count", 'greenova-core' ),
					"param_name" => "showcomment",
					"value" => array( 
						__( "Disabled", "greenova-core" ) => 'false',
						__( "Enabled", "greenova-core" )  => 'true',
						), 
				),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Word count", 'greenova-core' ),
					"param_name" => "count",
					"value" => 15,
					'description' => __( 'Maximum number of words', 'greenova-core' ),
					),				
				array(				
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Total number of items", 'greenova-core' ),
					"param_name" => "grid_item_number",
					"value" => 6,
					'description' => __( 'Write -1 to show all', 'greenova-core' ),
					),
				
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Button Display", 'greenova-core' ),
					"param_name" => "show_button",
					"value" => array(
						__( "Disabled", 'greenova-core' ) => 'false',
						__( "Enabled", 'greenova-core' )  => 'true',
						),
						'dependency' => array(
							'element' => 'grid_style',
							'value'   => array( 'style2', 'style3' ),
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
						'element' => 'show_button',
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
						'element' => 'show_button',
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
			);

			return $fields;
		}

		public function shortcode( $atts, $content = '' ){
			extract( shortcode_atts( array(
				'grid_style'          => 'style1',
				'cat'                   => '',
				'order'					=> 'DESC',
				'orderby'				=> '',
				'showcomment'           => 'false',
				'grid_item_number'      => '6',
				'count'                 => 15,
				'show_button'  	        => 'false',
				'buttonurl'  	        => '#',
				'buttontext' 	        => $this->translate['buttontext'],
				'col_lg'                => '4',
				'col_md'                => '4',
				'col_sm'                => '4',
				'col_xs'                => '6',
				'col_mobile'            => '12',
				), $atts ) );

			$grid_style          = esc_attr( $grid_style );
			$grid_item_number    = intval( $grid_item_number );
			$cat                   = empty( $cat ) ? '' : $cat;

			
						
			switch ( $grid_style ) {
				case 'style3':
					$template = 'post-grid-3';
				break;
				case 'style2':
					$template = 'post-grid-2';
				break;
				default:
					$template = 'post-grid-1';
				break;
			}			
			return $this->template( $template, get_defined_vars() );
			
		}
	}
}
	
new GREENOVA_Theme_VC_Post_Grid;