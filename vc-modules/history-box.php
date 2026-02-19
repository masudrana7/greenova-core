<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */
if ( ! defined( 'ABSPATH' ) ) exit;

if ( !class_exists( 'GREENOVA_Theme_VC_History_Box' ) ) {
		
	class GREENOVA_Theme_VC_History_Box extends GREENOVA_Theme_VC_Modules {

		public function __construct(){
			$this->name = __( "Greenova: History Box", 'greenova-core' );
			$this->base = 'greenova-vc-history-box';
			$this->translate = array(
				'title'   		=> __( 'Our <span class="greenova-primary-color">Successful</span> History', 'greenova-core' ),
				'historytext' 	=> __( 'Gimply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s type and scrambled it to make.', 'greenova-core' ),
				'pointtitle' 	=> __( 'We are Expert', 'greenova-core' ),
				'pointtext' 	=> __( 'Fmply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s stand when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five.stand when an unknown printer took a galley.', 'greenova-core' ),
			);
			parent::__construct();
		}

		public function fields(){
			$fields = array(
				array(
					"type"        => "textfield",
					"holder" 	  => "div",
					"class" 	  => "",
					"heading" 	  => __( "Title", 'greenova-core' ),
					"param_name"  => "title",
					"value" 	  => $this->translate['title'],
					"rows" 		  => "1",
				),
				array(
					"type" 		  => "textfield",
					"holder" 	  => "div",
					"class" 	  => "",
					"heading" 	  => __( "History Text", 'greenova-core' ),
					"param_name"  => "historytext",
					"value" 	  => $this->translate['historytext'],
				),
				// params group
				array(
					'type' => 'param_group',
					'value' => '',
					'param_name' => 'history_points',
					// Note params is mapped inside param-group:
					'params' => array(
						array(
							'type' 		  => 'textfield',
							'heading' 	  => __( "Point Title", 'greenova-core' ),
							'param_name'  => 'pointtitle',
							"value" 	  => $this->translate['pointtitle'],
						),
						array(
							"type" 		  => "textfield",
							"holder" 	  => "div",
							"class" 	  => "",
							"heading" 	  => __( "Point Text", 'greenova-core' ),
							"param_name"  => "pointtext",
							"value" 	  => $this->translate['pointtext'],
						),
					)
				),
				array(
					'type' => 'css_editor',
					'heading' => __( 'Css', 'greenova-core' ),
					'param_name' => 'css',
					'group' => __( 'Design options', 'greenova-core' )
				),
			);
			return $fields;
		}

		public function shortcode( $atts, $content = '' ){
			extract( shortcode_atts( array(			
				'history_points'    => '',
				'title'      		=> $this->translate['title'],
				'historytext' 		=> $this->translate['historytext'],
				'pointtitle'        => $this->translate['pointtitle'],
				'pointtext' 		=> $this->translate['pointtext'],
				'css'           	=> '',
				), $atts ) );
				
				$template = 'history-box';
				
				return $this->template( $template, get_defined_vars() );
		}
	}
}

new GREENOVA_Theme_VC_History_Box;