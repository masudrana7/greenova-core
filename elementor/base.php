<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Greenova_Core;

use \ReflectionClass;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

abstract class Custom_Widget_Base extends Widget_Base {

	public $rt_name;
	public $rt_base;
	public $rt_category;
	public $rt_icon;
	public $rt_translate;
	public $rt_dir;
	public function __construct( $data = [], $args = null ) {
		$this->rt_category = GREENOVA_CORE_THEME_PREFIX . '-widgets'; // Category /@dev
		$this->rt_icon     = 'rdtheme-el-custom';
		$this->rt_dir      = dirname( ( new ReflectionClass( $this ) )->getFileName() );
		parent::__construct( $data, $args );
	}

	public function get_name() {
		return $this->rt_base;
	}

	public function get_title() {
		return $this->rt_name;
	}

	public function get_icon() {
		return $this->rt_icon;
	}

	public function get_categories() {
		return [ $this->rt_category ];
	}

	public function rt_template( $template, $data ) {
		$template_name = DIRECTORY_SEPARATOR . 'elementor-custom' . DIRECTORY_SEPARATOR . basename( $this->rt_dir ) . DIRECTORY_SEPARATOR . $template . '.php';
		if ( file_exists( get_stylesheet_directory() . $template_name ) ) {
			$file = get_stylesheet_directory() . $template_name;
		} elseif ( file_exists( TEMPLATEPATH . $template_name ) ) {
			$file = TEMPLATEPATH . $template_name;
		} else {
			$file = $this->rt_dir . DIRECTORY_SEPARATOR . $template . '.php';
		}

		ob_start();
		include $file;
		echo ob_get_clean();
	}

	//Get Custom post category:
	protected function rt_get_categories( $cat ) {
		$terms   = get_terms( [
			'taxonomy'   => $cat,
			'hide_empty' => true,
		] );
		$options = [ '0' => __( 'All Categories', 'greenova-core' ) ];
		if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
			foreach ( $terms as $term ) {
				$options[ $term->slug ] = $term->name;
			}

			return $options;
		}
	}

	//post category list
	function rt_category_list() {
		$categories = get_categories( [ 'hide_empty' => false ] );
		$lists      = [];
		foreach ( $categories as $category ) {
			$lists[ $category->cat_ID ] = $category->name;
		}

		return $lists;
	}

	// post tags lists
	function rt_tag_list() {
		$tags     = get_tags( [ 'hide_empty' => false ] );
		$tag_list = [];
		foreach ( $tags as $tag ) {
			$tag_list[ $tag->slug ] = $tag->name;
		}

		return $tag_list;
	}

	//Get all thumbnail size
	function rt_get_all_image_sizes() {
		global $_wp_additional_image_sizes;
		$image_sizes = [ '0' => 'Default Image Size' ];
		foreach ( $_wp_additional_image_sizes as $index => $item ) {
			$image_sizes[ $index ] = __( ucwords( $index . ' - ' . $item['width'] . 'x' . $item['height'] ), 'greenova-core' );
		}
		$image_sizes['full'] = __( "Full Size", 'greenova-core' );

		return $image_sizes;
	}

}