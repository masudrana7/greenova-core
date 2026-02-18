<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

if ( !class_exists( 'GREENOVA_Theme_VC_Video' ) ) {

	class GREENOVA_Theme_VC_Video extends GREENOVA_Theme_VC_Modules {

		public function __construct(){
			$this->name = __( "Greenova: Video", 'greenova-core' );
			$this->base = 'greenova-vc-video';
			$this->translate = array(
				'title' => __( "Video Tour", 'greenova-core' ),
			);
			parent::__construct();
		}

		public function load_scripts(){
			wp_enqueue_style( 'magnific-popup' );
			wp_enqueue_script( 'magnific-popup' );
		}

		public function fields(){
			$fields = array(
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Background Type", 'greenova-core' ),
					"param_name" => "background",
					'value' => array( 
						__( 'Light Background', 'greenova-core' ) => 'light',
						__( 'Dark Background', 'greenova-core' )  => 'dark',
					),
				),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Layout", 'greenova-core' ),
					"param_name" => "layout",
					'value' => array( 
						__( 'Full-Screen', 'greenova-core' ) => 'full',
						__( 'Half-Screen', 'greenova-core' ) => 'half',
					),
				),
				array(
					"type" 		  => "textfield",
					"holder" 	  => "div",
					"class" 	  => "",
					"heading" 	  => __( "Title", 'greenova-core' ),
					"param_name"  => "title",
					"value" 	  => $this->translate['title'],
				),
				array(
					"type" => "textarea_html",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Content", 'greenova-core' ),
					"param_name" => "content",
					"value" => 'Lorem ipsum text of the printing and typesetting industryorem<br/>ever since industry standard dum an unknowramble',
					'dependency' => array(
						'element' => 'layout',
						'value'   => array( 'full' ),
					),
				),
				array(
					"type" 		  => "textfield",
					"holder" 	  => "div",
					"class" 	  => "",
					"heading" 	  => __( "Video Link", 'greenova-core' ),
					"param_name"  => "url",
					"value" 	  => '',
					"description" => __( "Enter any video link from external sources eg. http://www.youtube.com/watch?v=1iIZeIy7TqM", 'greenova-core' ),
				),
				array(
					'type'       => 'css_editor',
					'heading'    => __( 'Css', 'greenova-core' ),
					'param_name' => 'css',
					'group'      => __( 'Design options', 'greenova-core' ),
				),
			);

			return $fields;
		}

		public function shortcode( $atts, $content = '' ){
			extract( shortcode_atts( array(
				'background' => 'light',
				'layout'     => 'full',
				'title'      => $this->translate['title'],
				'url'        => '',
				'css'        => '',
				), $atts ) );

			$class = vc_shortcode_custom_css_class( $css );

			$this->load_scripts();
			if ( $layout == 'full' ) {
				$template = 'video-full';
			}
			else {
				$template = 'video-half';
			}

			return $this->template( $template, get_defined_vars() );
		}
	}
}

new GREENOVA_Theme_VC_Video;