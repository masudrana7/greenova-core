<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */
if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'GREENOVA_Theme_VC_Title' ) ) {
	class GREENOVA_Theme_VC_Title extends GREENOVA_Theme_VC_Modules {

		public function __construct() {
			$this->name      = __( "GREENOVA: Section Title", 'greenova-core' );
			$this->base      = 'greenova-vc-title';
			$this->translate = [
				'title'       => __( "Welcome To Greenova", 'greenova-core' ),
				'title_5'     => __( "About <span>Us</span>", 'greenova-core' ),
				'titlethree'  => __( "<span>W</span>hat<span> W</span>e<span> O</span>ffer", 'greenova-core' ),
				'titlethree2' => __( "Landscaping Company", 'greenova-core' ),
			];
			parent::__construct();
		}

		public function fields() {
			$fields = [
				[
					"type"       => "dropdown",
					"holder"     => "div",
					"class"      => "",
					"heading"    => __( "Style", 'greenova-core' ),
					"param_name" => "layout",
					"value"      => [
						__( 'Style 1', 'greenova-core' )              => 'style1',
						__( 'Style 2(Title with Bar)', 'greenova-core' )  => 'style2',
						__( 'Style 3(Title with Icon)', 'greenova-core' ) => 'style3',
						__( 'Style 4(Title with Line)', 'greenova-core' ) => 'style4',
						__( 'Style 5(Title with HTML)', 'greenova-core' ) => 'style5',
					],
				],
				[
					"type"       => "textfield",
					"holder"     => "div",
					"class"      => "",
					"heading"    => __( "Title", 'greenova-core' ),
					"param_name" => "title",
					"value"      => $this->translate['title'],
					'dependency' => [
						'element' => 'layout',
						'value'   => [ 'style1', 'style2', 'style4' ],
					],
				],
				[
					"type"       => "dropdown",
					"holder"     => "div",
					"class"      => "",
					"heading"    => __( "Display Bar Under Title",
						'greenova-core' ),
					"param_name" => "has_bar",
					"value"      => [
						__( 'Show', 'greenova-core' ) => 'true',
						__( 'Hide', 'greenova-core' ) => 'false',
					],
					'dependency' => [
						'element' => 'layout',
						'value'   => [ 'style2' ],
					],
				],
				[
					"type"       => "dropdown",
					"holder"     => "div",
					"class"      => "",
					"heading"    => __( "Display Bar Color", 'greenova-core' ),
					"param_name" => "bar_color",
					"value"      => [
						__( 'Dark', 'greenova-core' )  => 'true',
						__( 'Light', 'greenova-core' ) => 'false',
					],
					'dependency' => [
						'element' => 'layout',
						'value'   => [ 'style2' ],
					],
				],
				[
					"type"       => "textarea_raw_html",
					"holder"     => "div",
					"class"      => "",
					"heading"    => __( "Title", 'greenova-core' ),
					"param_name" => "title_5",
					"value"      => '',
					"rows"       => "1",
					'dependency' => [
						'element' => 'layout',
						'value'   => [ 'style5' ],
					],
				],
				[
					"type"       => "textfield",
					"holder"     => "div",
					"class"      => "",
					"heading"    => __( "Color Title", 'greenova-core' ),
					"param_name" => "titlethree",
					"value"      => $this->translate['titlethree'],
					'dependency' => [
						'element' => 'layout',
						'value'   => [ 'style3' ],
					],
				],
				[
					"type"       => "textfield",
					"holder"     => "div",
					"class"      => "",
					"heading"    => __( "Title 2", 'greenova-core' ),
					"param_name" => "titlethree2",
					"value"      => $this->translate['titlethree2'],
					'dependency' => [
						'element' => 'layout',
						'value'   => [ 'style3' ],
					],
				],
				[
					'type'       => 'iconpicker',
					'heading'    => __( 'FontAwesome Icon', 'greenova-core' ),
					'param_name' => 'icon_fa',
					"value"      => 'fa fa-tree',
					'settings'   => [
						'emptyIcon'    => false,
						'iconsPerPage' => 160,
					],
					'dependency' => [
						'element' => 'layout',
						'value'   => [ 'style3' ],
					],
				],
				[
					"type"       => "textfield",
					"holder"     => "div",
					"class"      => "",
					"heading"    => __( "Title Font Size( Desktop )",
						'greenova-core' ),
					"param_name" => "title_font_size",
					"value"      => '36',
					'dependency' => [
						'element' => 'layout',
						'value'   => [
							'style1',
							'style2',
							'style4',
							'style5',
						],
					],
				],
				[
					"type"       => "dropdown",
					"holder"     => "div",
					"class"      => "",
					"heading"    => __( "Title Font Size( Tab )",
						'greenova-core' ),
					"param_name" => "title_font_size_tab",
					"value"      => [
						__( 'Font Size 32', 'greenova-core' ) => 'title32',
						__( 'Font Size 30', 'greenova-core' ) => 'title30',
						__( 'Font Size 28', 'greenova-core' ) => 'title28',
						__( 'Font Size 24', 'greenova-core' ) => 'title24',
						__( 'Font Size 20', 'greenova-core' ) => 'title20',
						__( 'Font Size 18', 'greenova-core' ) => 'title18',
						__( 'Font Size 16', 'greenova-core' ) => 'title16',
						__( 'Font Size 14', 'greenova-core' ) => 'title14',
					],
					'dependency' => [
						'element' => 'layout',
						'value'   => [ 'style1', 'style2' ],
					],
				],
				[
					"type"       => "dropdown",
					"holder"     => "div",
					"class"      => "",
					"heading"    => __( "Title Font Size( Mobile )",
						'greenova-core' ),
					"param_name" => "title_font_size_mob",
					"value"      => [
						__( 'Font Size 28', 'greenova-core' ) => 'mitle28',
						__( 'Font Size 32', 'greenova-core' ) => 'mitle32',
						__( 'Font Size 30', 'greenova-core' ) => 'mitle30',
						__( 'Font Size 24', 'greenova-core' ) => 'mitle24',
						__( 'Font Size 20', 'greenova-core' ) => 'mitle20',
						__( 'Font Size 18', 'greenova-core' ) => 'mitle18',
						__( 'Font Size 16', 'greenova-core' ) => 'mitle16',
						__( 'Font Size 14', 'greenova-core' ) => 'mitle14',
					],
					'dependency' => [
						'element' => 'layout',
						'value'   => [ 'style1', 'style2' ],
					],
				],
				[
					"type"       => "textarea",
					"holder"     => "div",
					"class"      => "",
					"heading"    => __( "Subtitle", 'greenova-core' ),
					"param_name" => "subtitle",
					"value"      => "",
					'dependency' => [
						'element' => 'layout',
						'value'   => [ 'style1', 'style3', 'style4' ],
					],
				],
				[
					"type"       => "textfield",
					"holder"     => "div",
					"class"      => "",
					"heading"    => __( "Sub Title Font Size",
						'greenova-core' ),
					"param_name" => "subtitle_font_size",
					"value"      => '18',
					'dependency' => [
						'element' => 'layout',
						'value'   => [ 'style1' ],
					],
				],
				[
					"type"       => "textarea_html",
					"holder"     => "div",
					"class"      => "",
					"heading"    => __( "Sub Title Text", 'greenova-core' ),
					"param_name" => "content",
					"value"      => __( '', 'greenova-core' ),
					"rows"       => "1",
					'dependency' => [
						'element' => 'layout',
						'value'   => [ 'style2', 'style5' ],
					],
				],
				[
					"type"       => "colorpicker",
					"class"      => "",
					"heading"    => __( "Title color", "greenova-core" ),
					"param_name" => "title_color",
					"value"      => '#222222',
					'dependency' => [
						'element' => 'layout',
						'value'   => [ 'style1', 'style2', 'style5' ],
					],
				],
				[
					"type"       => "colorpicker",
					"class"      => "",
					"heading"    => __( "Subtitle color", "greenova-core" ),
					"param_name" => "subtitle_color",
					"value"      => '#444444',
					'dependency' => [
						'element' => 'layout',
						'value'   => [
							'style1',
							'style3',
							'style4',
							'style5',
						],
					],
				],
				[
					"type"       => "dropdown",
					"holder"     => "div",
					"class"      => "",
					"heading"    => __( "Alignment", 'greenova-core' ),
					"param_name" => "title_align",
					'value'      => [
						__( "Center", 'greenova-core' ) => 'center',
						__( "Left", 'greenova-core' )   => 'left',
						__( "Right", 'greenova-core' )  => 'right',
					],
					'dependency' => [
						'element' => 'layout',
						'value'   => [ 'style1', 'style2', 'style5' ],
					],
				],
				[
					"type"       => "dropdown",
					"holder"     => "div",
					"class"      => "",
					"heading"    => __( "Section Width", 'greenova-core' ),
					"param_name" => "section_width",
					'value'      => [
						__( "100%", 'greenova-core' ) => '100',
						__( "90%", 'greenova-core' )  => '90',
						__( "80%", 'greenova-core' )  => '80',
						__( "70%", 'greenova-core' )  => '70',
						__( "65%", 'greenova-core' )  => '65',
						__( "60%", 'greenova-core' )  => '60',
						__( "50%", 'greenova-core' )  => '50',
						__( "40%", 'greenova-core' )  => '40',
						__( "30%", 'greenova-core' )  => '30',
						__( "20%", 'greenova-core' )  => '20',
						__( "10%", 'greenova-core' )  => '10',
					],
					'dependency' => [
						'element' => 'layout',
						'value'   => [
							'style1',
							'style2',
							'style3',
							'style5',
						],
					],
				],
				[
					'type'       => 'css_editor',
					'heading'    => __( 'Css', 'greenova-core' ),
					'param_name' => 'css',
					'group'      => __( 'Design options', 'greenova-core' ),
				],
			];

			return $fields;
		}

		public function shortcode( $atts, $content = '' ) {
			extract( shortcode_atts( [
				'layout'              => 'style1',
				'title'               => $this->translate['title'],
				'has_bar'             => 'true',
				'title_5'             => $this->translate['title_5'],
				'titlethree'          => $this->translate['titlethree'],
				'titlethree2'         => $this->translate['titlethree2'],
				'icon_fa'             => 'fa fa-tree',
				'subtitle'            => "",
				'title_color'         => '#222222',
				'bar_color'           => 'true',
				'title_font_size'     => '36',
				'title_font_size_tab' => 'title32',
				'title_font_size_mob' => 'mitle28',
				'title_align'         => 'center',
				'subtitle_color'      => '#444444',
				'subtitle_font_size'  => '18',
				'section_width'       => '100',
				'css'                 => '',
			], $atts ) );

			$title_font_size = intval( $title_font_size );
			$section_width   = intval( $section_width );

			switch ( $layout ) {
				case 'style5':
					$template = 'title-5';
					break;
				case 'style4':
					$title_align = 'left';
					$template    = 'title-4';
					break;
				case 'style3':
					$template = 'title-3';
					break;
				case 'style2':
					$template = 'title-bar';
					break;
				default:
					$template = 'title-1';
					break;
			}

			return $this->template( $template, get_defined_vars() );
		}

	}
}

new GREENOVA_Theme_VC_Title;