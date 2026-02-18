<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

if ( !class_exists( 'GREENOVA_Theme_VC_Counter' ) ) {

	class GREENOVA_Theme_VC_Counter extends GREENOVA_Theme_VC_Modules {

		public function __construct(){
			$this->name = __( "Greenova: Counter", 'greenova-core' );
			$this->base = 'greenova-vc-counter';
			$this->translate = array(
				'title'   => __( "Happy Client", 'greenova-core' ),
			);
			parent::__construct();
		}

		public function load_scripts(){
			wp_enqueue_script( 'rt-waypoints' );
			wp_enqueue_script( 'counterup' );
		}

		public function fields(){
			$fields = array(
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Style", 'greenova-core' ),
					"param_name" => "layout",
					"value" => array( 
						__( 'Style 1', 'greenova-core' ) => 'style1',
						__( 'Style 2', 'greenova-core' ) => 'style2',
						__( 'Style 3', 'greenova-core' ) => 'style3',
						__( 'Style 4', 'greenova-core' ) => 'style4',
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
						),
					'dependency' => array(
						'element' => 'layout',
						'value'   => array( 'style3', 'style4' ),
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
					"type" => "colorpicker",
					"class" => "",
					"heading" => __( "Counter color", "greenova-core" ),
					"param_name" => "counter_color",
					"value" => '',
					),
				array(
					"type" => "colorpicker",
					"class" => "",
					"heading" => __( "Title color", "greenova-core" ),
					"param_name" => "title_color",
					"value" => '#1fa12e',
					),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Counter Font Size", 'greenova-core' ),
					"param_name" => "icon_size",
					'description' => __( 'Icon size in px eg. 20', 'greenova-core' ),
					'value' => '50',
					),
				array(
					"type" => "colorpicker",
					"class" => "",
					"heading" => __( "Icon Color", "greenova-core" ),
					"param_name" => "icon_color",
					"value" => '#1fa12e',
					'dependency' => array(
						'element' => 'layout',
						'value'   => array( 'style3', 'style4' ),
						),
					),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Icon Font Size", 'greenova-core' ),
					"param_name" => "icon_fontsize",
					'description' => __( 'Icon size in px eg. 20', 'greenova-core' ),
					'value' => '50',
					'dependency' => array(
						'element' => 'layout',
						'value'   => array( 'style3', 'style4' ),
						),
					),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Alignment", 'greenova-core' ),
					"param_name" => "title_align",
					'value' => array(
						__( "Center", 'greenova-core' ) => 'center',
						__( "Left", 'greenova-core' )   => 'left',
						__( "Right", 'greenova-core' )  => 'right',
						),
					'dependency' => array(
						'element' => 'layout',
						'value'   => array( 'style1' , 'style2' ),
						),
					),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Counter Number", 'greenova-core' ),
					"param_name" => "counter_number",
					"value" => '5780',
					'description' => __( 'Number to count eg. 5780', 'greenova-core' ),
					),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Maximun Width", 'greenova-core' ),
					"param_name" => "counter_maxwidth",
					"value" => '',
					'description' => __( 'If you want to set a maximum number. eg. 5780', 'greenova-core' ),
					),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Counter Speed", 'greenova-core' ),
					"param_name" => "counter_speed",
					"value" => '3000',
					'description' => __( 'The total duration of the count animation in milisecond eg. 5000', 'greenova-core' ),
				),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Counter Steps", 'greenova-core' ),
					"param_name" => "counter_steps",
					"value" => '10',
					'description' => __( 'Counter steps eg. 10', 'greenova-core' ),
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
					"heading" => __( "Counter Text Size", 'greenova-core' ),
					"param_name" => "title_size",
					'description' => __( 'Counter Text size in px eg. 20', 'greenova-core' ),
					'value' => '16',
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
				'layout'               => 'style1',
				'icontype'       	   => 'fontawesome',
				'icon_fa'        	   => 'fa fa-bar-chart',
				'icon_flat'    		   => 'flaticon-green-interface',
				'counter_color'	       => '',
				'title_color'	       => '#1fa12e',
				'icon_size'            => '50',
				'icon_color'           => '#1fa12e',
				'icon_fontsize'        => '60',
				'title_align'          => 'center',
				'counter_number'       => '5780',
				'counter_maxwidth'     => '',
				'counter_speed'        => '3000',
				'counter_steps'        => '10',
				'title'			       => $this->translate['title'],
				'title_size'           => '16',
				'css'                  => '',
				), $atts ) );

			// validation
			$counter_speed   = intval( $counter_speed );
			$counter_steps   = intval( $counter_steps );

			$number          = intval( $counter_number );
			$text            = explode( $number, $counter_number );
			$counter_number  = $number;
			
			$icon  = ( $icontype == 'flaticon' ) ? $icon_flat : $icon_fa;

			if ( $icontype == 'flaticon' ) {
				vc_icon_element_fonts_enqueue( $icon );
			}
		
			$this->load_scripts();

			switch ( $layout ) {
				case 'style4':
					$template = 'counter-4';
				break;
				case 'style3':
					$template = 'counter-3';
				break;
				case 'style2':
					$template = 'counter-2';
				break;
				default:
					$template = 'counter-1';
				break;
			}

			return $this->template( $template, get_defined_vars() );
		}
	}
}

new GREENOVA_Theme_VC_Counter;