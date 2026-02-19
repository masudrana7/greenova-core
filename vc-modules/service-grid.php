<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */
if ( ! defined( 'ABSPATH' ) ) exit;

if ( !class_exists( 'GREENOVA_Theme_VC_Service_Grid' ) ) {

	class GREENOVA_Theme_VC_Service_Grid extends GREENOVA_Theme_VC_Modules {

		public function __construct(){
			$this->name = __( "Greenova: Service Grid", 'greenova-core' );
			$this->base = 'greenova-vc-service-grid';
			$this->translate = array(
				'cols'   => array( 
					__( '1 col', 'greenova-core' ) => '12',
					__( '2 col', 'greenova-core' ) => '6',
					__( '3 col', 'greenova-core' ) => '4',
					__( '4 col', 'greenova-core' ) => '3',
					__( '6 col', 'greenova-core' ) => '2',
				),				
				'buttontext' 	=> __( 'Read More', 'greenova-core' ),
			);
			parent::__construct();
		}

		public function fields(){
			$terms = get_terms( array('taxonomy' => 'greenova_service_category') );
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
						__( "Style 1", 'greenova-core' )  => 'grid1',
						__( "Style 2", 'greenova-core' )  => 'grid2',
						__( "Style 3", 'greenova-core' )  => 'grid3',
						__( "Style 4", 'greenova-core' )  => 'grid4',
						__( "Style 5", 'greenova-core' )  => 'grid5',
						),
					),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Items Per Page", 'greenova-core' ),
					"param_name" => "grid_item_number",
					"value" => '6',
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
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Word count", 'greenova-core' ),
					"param_name" => "count",
					"value" => 15,
					'description' => __( 'Maximum number of words', 'greenova-core' ),
					),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Show Shadow", 'greenova-core' ),
					"param_name" => "showshadow",
					'value' => array(
						__( "Enabled", 'greenova-core' )  => 'true',
						__( "Disabled", 'greenova-core' )  => 'false',
						),
					'dependency' => array(
						'element' => 'layout',
						'value'   => array( 'grid4' ),
						),
					),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Show Link", 'greenova-core' ),
					"param_name" => "showlink",
					'value' => array(
						__( "Enabled", 'greenova-core' )  => 'true',
						__( "Disabled", 'greenova-core' )  => 'false',
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
					"type"		  => "dropdown",
					"holder"	  => "div",
					"class" 	  => "",
					"heading" 	  => __( "Display Pagination", 'greenova-core' ),
					"param_name"  => "pagina_display",
					'value' 	  => array(
						'Yes'  => 'true',
						'No'   => 'false'
						),
				),
				array(
					"type"		  => "dropdown",
					"holder"	  => "div",
					"class" 	  => "",
					"heading" 	  => __( "Display Button", 'greenova-core' ),
					"param_name"  => "button_display",
					'value' 	  => array(
						'No'   => 'false',
						'Yes'  => 'true'
						),
					'dependency' => array(
						'element' => 'pagina_display',
						'value'   => array( 'false' ),
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
					"std" => "6",
					),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Number of columns ( Phones < 768px )", 'greenova-core' ),
					"param_name" => "col_xs",
					"value" => $this->translate['cols'],
					"std" => "12",
					),
				);

			return $fields;
		}

		public function shortcode( $atts, $content = '' ){
			extract( shortcode_atts( array(
				'layout'           => 'grid1',
				'grid_item_number' => '6',
				'cat'      		   => '',
				'count'            => 15,
				'showlink'         => 'true',
				'showshadow'       => 'true',
				'order'			   => 'DESC',
				'orderby'		   => '',
				'pagina_display'   => 'true',
				'button_display'   => 'false',
				'buttontext' 	   => $this->translate['buttontext'],
				'buttonurl' 	   => '',
				'col_lg'           => '4',
				'col_md'           => '4',
				'col_sm'           => '6',
				'col_xs'           => '12',
				), $atts ) );

			// validation
			$grid_item_number      = intval( $grid_item_number );
			$col_lg                = esc_attr( $col_lg );
			$col_md                = esc_attr( $col_md );
			$col_sm                = esc_attr( $col_sm );
			$col_xs                = esc_attr( $col_xs );

			switch ( $layout ) {
				case 'grid5':
				$template = 'service-grid5';
				break;
				case 'grid4':
				$template = 'service-grid-4';
				break;
				case 'grid3':
				$template = 'service-grid3';
				break;
				case 'grid2':
				$template = 'service-grid2';
				break;
				default:
				$template = 'service-grid1';
				break;
			}

			return $this->template( $template, get_defined_vars() );
		}
	}
}

new GREENOVA_Theme_VC_Service_Grid;