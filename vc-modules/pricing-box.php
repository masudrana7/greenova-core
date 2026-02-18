<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

if ( !class_exists( 'GREENOVA_Theme_VC_Pricing_Box' ) ) {

	class GREENOVA_Theme_VC_Pricing_Box extends GREENOVA_Theme_VC_Modules {

		public function __construct(){
			$this->name = __( "Greenova: Pricing Box", 'greenova-core' );
			$this->base = 'greenova-vc-pricing';
			$this->translate = array(
				'title'   => __( "STANDARD", 'greenova-core' ),
				'btntext' => __( "Details", 'greenova-core' ),
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
						__( "Style 1", 'greenova-core' )  => 'grid1',
						__( "Style 2", 'greenova-core' )  => 'grid2',
						),
					),
				array(
					"type" => "colorpicker",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Background Color", 'greenova-core' ),
					"param_name" => "bgcolor",
					'value' => "#f8f8f8",
					),
				array(
					"type" => "colorpicker",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Background Hover Color", 'greenova-core' ),
					"param_name" => "bghover",
					'dependency' => array(
						'element' => 'layout',
						'value' => array( 'grid2' ),
					),
					'value' => "",
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
					"heading" => __( "Price", 'greenova-core' ),
					"param_name" => "price",
					"value" => '$56',
					"description" => __( "Including currency sign eg. $59", 'greenova-core' ),
					),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Unit Name", 'greenova-core' ),
					"param_name" => "unit",
					"value" => 'mo',
					"description" => __( "eg. month or year. Keep empty if you don't want to show unit", 'greenova-core' ),
					),
				array(
					"type" => "textarea",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Features", 'greenova-core' ),
					"param_name" => "features",
					"value" => "",
					"description" => __( "One line per feature. Put BLANK keyword if you want blank line. eg.<br/>Investment Plan</br>Education Loan</br>Tax Planning</br>BLANK", 'greenova-core' ),
					),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Button Text", 'greenova-core' ),
					"param_name" => "btntext",
					"value" => $this->translate['btntext'],
					),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Button URL", 'greenova-core' ),
					"param_name" => "btnurl",
					"value" => "",
					),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Maximum width", 'greenova-core' ),
					"param_name" => "maxwidth",
					"value" => "",
					"description" => __( "Maximum width in px. Keep empty if you want full width. eg. 300", 'greenova-core' ),
					),
				array(
					'type' => 'css_editor',
					'heading' => __( 'Css', 'greenova-core' ),
					'param_name' => 'css',
					'group' => __( 'Design options', 'greenova-core' ),
					'edit_field_class' => 'vc-no-bg vc-no-border',
					),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Display Active", 'greenova-core' ),
					"param_name" => "display_active",
					'value' => array(
						__( "Common Price Table", 'greenova-core' )  => 'common-class',
						__( "Active Price Table", 'greenova-core' )  => 'active-class',
						),
					),
				);
			return $fields;
		}

		private function validate( $str ){
			$str = trim( $str );
			// replace BLANK keyword
			if ( strtolower( $str ) == 'blank'  ) {
				return '&nbsp;';
			}
			return $str;
		}

		public function shortcode( $atts, $content = '' ){
			extract( shortcode_atts( array(	
				'layout'    		=> 'grid1',
				'bgcolor'  			=> '#f8f8f8',
				'bghover'  			=> '',
				'title'    			=> $this->translate['title'],
				'price'    			=> '$56',
				'unit'     			=> 'mo',
				'features' 			=> '',
				'btntext'  			=> $this->translate['btntext'],
				'btnurl'   		 	=> '',
				'maxwidth' 	     	=> '',
				'display_active' 	=> 'common-class',
				'css'      			=> '',
				
				), $atts ) );

			$maxwidth = (int) $maxwidth;

			$features = strip_tags( $features ); // remove tags
			$features = preg_split( "/\R/", $features ); // string to array
			$features = array_map( array( $this, 'validate' ), $features ); // validate
						
			switch ( $layout ) {
				case 'grid2':
				$template = 'pricing-box1';
				break;
				default:
				$template = 'pricing-box';
				break;
			}

			return $this->template( $template, get_defined_vars() );
		}
	}
}

new GREENOVA_Theme_VC_Pricing_Box;