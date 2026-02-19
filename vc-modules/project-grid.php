<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */
if ( ! defined( 'ABSPATH' ) ) exit;

if ( !class_exists( 'GREENOVA_Theme_VC_Project_Grid' ) ) {

	class GREENOVA_Theme_VC_Project_Grid extends GREENOVA_Theme_VC_Modules {

		public function __construct(){
			$this->name = __( "Greenova: Project Grid", 'greenova-core' );
			$this->base = 'greenova-vc-project-grid';
			$this->translate = array(
				'cols'   => array( 
					__( '1 col', 'greenova-core' ) => '12',
					__( '2 col', 'greenova-core' ) => '6',
					__( '3 col', 'greenova-core' ) => '4',
					__( '4 col', 'greenova-core' ) => '3',
					__( '6 col', 'greenova-core' ) => '2',
				),
				'sectiontitle'  	=> __( 'Our Projects', 'greenova-core' ),
				'sectionsubtitle' 	=> __( 'Worked We Have Done', 'greenova-core' ),
				'buttontext'		=> __( 'View All', 'greenova-core' ),
			);
			parent::__construct();
		}
		
		public function load_scripts(){
			wp_enqueue_style( 'magnific-popup' );
			wp_enqueue_script( 'magnific-popup' );
		}		
		
		public function fields(){
			$terms = get_terms( array('taxonomy' => 'greenova_project_category') );
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
						__( "Style 4", 'greenova-core' )  => 'grid5',
						__( "Style 5", 'greenova-core' )  => 'grid6',
						__( "Style 6", 'greenova-core' )  => 'grid7',
						__( "Style 7", 'greenova-core' )  => 'grid8',
						__( "Style 8", 'greenova-core' )  => 'grid9',
						__( "Style 9", 'greenova-core' )  => 'grid10',
						__( "Style 10", 'greenova-core' )  => 'grid4',
						__( "Style 11", 'greenova-core' )  => 'grid11',
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
						'value'   => array( 'grid1' ),
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
	
				/*button align*/				
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Align Button", 'greenova-core' ),
					"param_name" => "align_filter_btn",
					'value' => array(
						__( "Right", 'greenova-core' )  => 'right',
						__( "Left", 'greenova-core' )  => 'left',
						__( "Center", 'greenova-core' )  => 'center',
						),
					),
				
				array(
					"type" 		  => "textfield",
					"holder" 	  => "div",
					"class" 	  => "",
					"heading" 	  => __( "Section Sub Title", 'greenova-core' ),
					"param_name"  => "sectionsubtitle",
					"value" 	  => $this->translate['sectionsubtitle'],
					'dependency' => array(
						'element' => 'showtitle',
						'value'   => array( 'true' ),
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
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Pagination Display", 'greenova-core' ),
					"param_name" => "show_pagination",
					"value" => array(
						__( "Enabled", 'greenova-core' )  => 'true',
						__( "Disabled", 'greenova-core' ) => 'false',
						),
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
						'element' => 'show_pagination',
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
				'layout'		   => 'grid1',
				'grid_item_number' => '6',
				'showtitle' 	   => 'true',
				'sectiontitle' 	   => $this->translate['sectiontitle'],
				'sectionsubtitle'  => $this->translate['sectionsubtitle'],
				'showlink'		   => 'true',
				'align_filter_btn' => 'right',
				'cat'      		   => '',
				'count'            => 15,
				'order'			   => 'DESC',
				'orderby'		   => '',
				'show_pagination'  => 'true',
				'show_button'  	   => 'false',
				'content_limit'    => '12',
				'buttonurl'  	   => '',
				'buttontext' 	   => $this->translate['buttontext'],
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

				case 'grid11':
				$template = 'project-grid11';
				break;
				case 'grid6':
				$template = 'project-grid6';
				break;
				case 'grid7':
				$template = 'project-grid7';
				break;
				case 'grid8':
				$template = 'project-grid8';
				break;
				case 'grid9':
				$template = 'project-grid9';
				break;
				case 'grid10':
				$template = 'project-grid10';
				break;
				case 'grid5':
				$template = 'project-grid5';
				$this->load_scripts();
				break;
				case 'grid4':
				$template = 'project-grid4';
				break;
				case 'grid3':
				$template = 'project-grid3';
				$this->load_scripts();
				break;
				case 'grid2':
				$template = 'project-grid2';
				$this->load_scripts();
				break;
				default:
				$template = 'project-grid1';
				$this->load_scripts();
				break;
			}

			return $this->template( $template, get_defined_vars() );


		}
	}
}

new GREENOVA_Theme_VC_Project_Grid;