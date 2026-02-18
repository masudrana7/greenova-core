<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Greenova_Core;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class RT_Image_Carousel extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ) {
		$this->rt_name = esc_html__( 'RT Image Carousel', 'greenova-core' );
		$this->rt_base = 'image-carousel';
		parent::__construct( $data, $args );
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_image_carousel',
			[
				'label' => __( 'RT Image Carousel', 'greenova-core' ),
			]
		);

		$this->add_control(
			'carousel',
			[
				'label'      => __( 'Add Images', 'greenova-core' ),
				'type'       => Controls_Manager::GALLERY,
				'default'    => [],
				'show_label' => false,
				'dynamic'    => [
					'active' => true,
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Image_Size::get_type(),
			[
				'name'      => 'thumbnail', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
				'separator' => 'none',
			]
		);

		$slides_to_show = range( 1, 10 );
		$slides_to_show = array_combine( $slides_to_show, $slides_to_show );

		$this->add_responsive_control(
			'slides_to_show',
			[
				'label'              => __( 'Slides to Show', 'greenova-core' ),
				'type'               => Controls_Manager::SELECT,
				'options'            => [
					                        '' => __( 'Default', 'greenova-core' ),
				                        ] + $slides_to_show,
				'frontend_available' => true,
			]
		);

		$this->add_responsive_control(
			'slides_to_scroll',
			[
				'label'              => __( 'Slides to Scroll', 'greenova-core' ),
				'type'               => Controls_Manager::SELECT,
				'description'        => __( 'Set how many slides are scrolled per swipe.', 'greenova-core' ),
				'options'            => [
					                        '' => __( 'Default', 'greenova-core' ),
				                        ] + $slides_to_show,
				'condition'          => [
					'slides_to_show!' => '1',
				],
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'image_stretch',
			[
				'label'   => __( 'Image Stretch', 'greenova-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'no',
				'options' => [
					'no'  => __( 'No', 'greenova-core' ),
					'yes' => __( 'Yes', 'greenova-core' ),
				],
			]
		);

		$this->add_control(
			'navigation',
			[
				'label'              => __( 'Navigation', 'greenova-core' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => 'both',
				'options'            => [
					'both'   => __( 'Arrows and Dots', 'greenova-core' ),
					'arrows' => __( 'Arrows', 'greenova-core' ),
					'dots'   => __( 'Dots', 'greenova-core' ),
					'none'   => __( 'None', 'greenova-core' ),
				],
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'link_to',
			[
				'label'   => __( 'Link', 'greenova-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'none',
				'options' => [
					'none'   => __( 'None', 'greenova-core' ),
					'file'   => __( 'Media File', 'greenova-core' ),
					'custom' => __( 'Custom URL', 'greenova-core' ),
				],
			]
		);

		$this->add_control(
			'link',
			[
				'label'       => __( 'Link', 'greenova-core' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'greenova-core' ),
				'condition'   => [
					'link_to' => 'custom',
				],
				'show_label'  => false,
			]
		);

		$this->add_control(
			'open_lightbox',
			[
				'label'     => __( 'Lightbox', 'greenova-core' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'default',
				'options'   => [
					'default' => __( 'Default', 'greenova-core' ),
					'yes'     => __( 'Yes', 'greenova-core' ),
					'no'      => __( 'No', 'greenova-core' ),
				],
				'condition' => [
					'link_to' => 'file',
				],
			]
		);

		$this->add_control(
			'caption_type',
			[
				'label'   => __( 'Caption', 'greenova-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					''            => __( 'None', 'greenova-core' ),
					'title'       => __( 'Title', 'greenova-core' ),
					'caption'     => __( 'Caption', 'greenova-core' ),
					'description' => __( 'Description', 'greenova-core' ),
				],
			]
		);

		$this->add_control(
			'view',
			[
				'label'   => __( 'View', 'greenova-core' ),
				'type'    => Controls_Manager::HIDDEN,
				'default' => 'traditional',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_additional_options',
			[
				'label' => __( 'Additional Options', 'greenova-core' ),
			]
		);

		$this->add_control(
			'autoplay',
			[
				'label'              => __( 'Autoplay', 'greenova-core' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => 'yes',
				'options'            => [
					'yes' => __( 'Yes', 'greenova-core' ),
					'no'  => __( 'No', 'greenova-core' ),
				],
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'pause_on_hover',
			[
				'label'              => __( 'Pause on Hover', 'greenova-core' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => 'yes',
				'options'            => [
					'yes' => __( 'Yes', 'greenova-core' ),
					'no'  => __( 'No', 'greenova-core' ),
				],
				'condition'          => [
					'autoplay' => 'yes',
				],
				'render_type'        => 'none',
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'pause_on_interaction',
			[
				'label'              => __( 'Pause on Interaction', 'greenova-core' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => 'yes',
				'options'            => [
					'yes' => __( 'Yes', 'greenova-core' ),
					'no'  => __( 'No', 'greenova-core' ),
				],
				'condition'          => [
					'autoplay' => 'yes',
				],
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'autoplay_speed',
			[
				'label'              => __( 'Autoplay Speed', 'greenova-core' ),
				'type'               => Controls_Manager::NUMBER,
				'default'            => 5000,
				'condition'          => [
					'autoplay' => 'yes',
				],
				'render_type'        => 'none',
				'frontend_available' => true,
			]
		);

		// Loop requires a re-render so no 'render_type = none'
		$this->add_control(
			'infinite',
			[
				'label'              => __( 'Infinite Loop', 'greenova-core' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => 'yes',
				'options'            => [
					'yes' => __( 'Yes', 'greenova-core' ),
					'no'  => __( 'No', 'greenova-core' ),
				],
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'effect',
			[
				'label'              => __( 'Effect', 'greenova-core' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => 'slide',
				'options'            => [
					'slide' => __( 'Slide', 'greenova-core' ),
					'fade'  => __( 'Fade', 'greenova-core' ),
				],
				'condition'          => [
					'slides_to_show' => '1',
				],
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'speed',
			[
				'label'              => __( 'Animation Speed', 'greenova-core' ),
				'type'               => Controls_Manager::NUMBER,
				'default'            => 500,
				'render_type'        => 'none',
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'direction',
			[
				'label'   => __( 'Direction', 'greenova-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'ltr',
				'options' => [
					'ltr' => __( 'Left', 'greenova-core' ),
					'rtl' => __( 'Right', 'greenova-core' ),
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_navigation',
			[
				'label'     => __( 'Navigation', 'greenova-core' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'navigation' => [ 'arrows', 'dots', 'both' ],
				],
			]
		);

		$this->add_control(
			'heading_style_arrows',
			[
				'label'     => __( 'Arrows', 'greenova-core' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'navigation' => [ 'arrows', 'both' ],
				],
			]
		);

		$this->add_control(
			'arrows_position',
			[
				'label'        => __( 'Position', 'greenova-core' ),
				'type'         => Controls_Manager::SELECT,
				'default'      => 'inside',
				'options'      => [
					'inside'  => __( 'Inside', 'greenova-core' ),
					'outside' => __( 'Outside', 'greenova-core' ),
				],
				'prefix_class' => 'elementor-arrows-position-',
				'condition'    => [
					'navigation' => [ 'arrows', 'both' ],
				],
			]
		);

		$this->add_control(
			'arrows_size',
			[
				'label'     => __( 'Size', 'greenova-core' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 20,
						'max' => 60,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-swiper-button.elementor-swiper-button-prev, {{WRAPPER}} .elementor-swiper-button.elementor-swiper-button-next' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'navigation' => [ 'arrows', 'both' ],
				],
			]
		);

		$this->add_control(
			'arrows_color',
			[
				'label'     => __( 'Color', 'greenova-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-swiper-button.elementor-swiper-button-prev, {{WRAPPER}} .elementor-swiper-button.elementor-swiper-button-next' => 'color: {{VALUE}};',
				],
				'condition' => [
					'navigation' => [ 'arrows', 'both' ],
				],
			]
		);

		$this->add_control(
			'heading_style_dots',
			[
				'label'     => __( 'Dots', 'greenova-core' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'navigation' => [ 'dots', 'both' ],
				],
			]
		);

		$this->add_control(
			'dots_position',
			[
				'label'        => __( 'Position', 'greenova-core' ),
				'type'         => Controls_Manager::SELECT,
				'default'      => 'outside',
				'options'      => [
					'outside' => __( 'Outside', 'greenova-core' ),
					'inside'  => __( 'Inside', 'greenova-core' ),
				],
				'prefix_class' => 'elementor-pagination-position-',
				'condition'    => [
					'navigation' => [ 'dots', 'both' ],
				],
			]
		);

		$this->add_control(
			'dots_size',
			[
				'label'     => __( 'Size', 'greenova-core' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 5,
						'max' => 10,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .swiper-pagination-bullet' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'navigation' => [ 'dots', 'both' ],
				],
			]
		);

		$this->add_control(
			'dots_color',
			[
				'label'     => __( 'Color', 'greenova-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .swiper-pagination-bullet' => 'background: {{VALUE}};',
				],
				'condition' => [
					'navigation' => [ 'dots', 'both' ],
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_image',
			[
				'label' => __( 'Image', 'greenova-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'image_align',
			[
				'label'     => __( 'Alignment', 'greenova-core' ),
				'type'      => \Elementor\Controls_Manager::CHOOSE,
				'options'   => [
					'left'   => [
						'title' => __( 'Left', 'greenova-core' ),
						'icon'  => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Right', 'greenova-core' ),
						'icon'  => 'fa fa-align-center',
					],
					'right'  => [
						'title' => __( 'Right', 'greenova-core' ),
						'icon'  => 'fa fa-align-right',
					],
				],
				'default'   => 'center',
				'toggle'    => true,
				'selectors' => [
					'{{WRAPPER}} .swiper-slide' => 'text-align: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'gallery_vertical_align',
			[
				'label'     => __( 'Vertical Align', 'greenova-core' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'flex-start' => [
						'title' => __( 'Start', 'greenova-core' ),
						'icon'  => 'eicon-v-align-top',
					],
					'center'     => [
						'title' => __( 'Center', 'greenova-core' ),
						'icon'  => 'eicon-v-align-middle',
					],
					'flex-end'   => [
						'title' => __( 'End', 'greenova-core' ),
						'icon'  => 'eicon-v-align-bottom',
					],
				],
				'condition' => [
					'slides_to_show!' => '1',
				],
				'selectors' => [
					'{{WRAPPER}} .swiper-wrapper' => 'display: flex; align-items: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'image_spacing',
			[
				'label'     => __( 'Spacing', 'greenova-core' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => [
					''       => __( 'Default', 'greenova-core' ),
					'custom' => __( 'Custom', 'greenova-core' ),
				],
				'default'   => '',
				'condition' => [
					'slides_to_show!' => '1',
				],
			]
		);

		$this->add_control(
			'image_spacing_custom',
			[
				'label'              => __( 'Image Spacing', 'greenova-core' ),
				'type'               => Controls_Manager::SLIDER,
				'range'              => [
					'px' => [
						'max' => 100,
					],
				],
				'default'            => [
					'size' => 20,
				],
				'show_label'         => false,
				'condition'          => [
					'image_spacing'   => 'custom',
					'slides_to_show!' => '1',
				],
				'frontend_available' => true,
				'render_type'        => 'none',
				'separator'          => 'after',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'image_border',
				'selector' => '{{WRAPPER}} .elementor-image-carousel-wrapper .elementor-image-carousel .swiper-slide-image',
			]
		);

		$this->add_control(
			'image_border_radius',
			[
				'label'      => __( 'Border Radius', 'greenova-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .elementor-image-carousel-wrapper .elementor-image-carousel .swiper-slide-image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_caption',
			[
				'label'     => __( 'Caption', 'greenova-core' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'caption_type!' => '',
				],
			]
		);

		$this->add_control(
			'caption_align',
			[
				'label'     => __( 'Alignment', 'greenova-core' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'left'    => [
						'title' => __( 'Left', 'greenova-core' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center'  => [
						'title' => __( 'Center', 'greenova-core' ),
						'icon'  => 'eicon-text-align-center',
					],
					'right'   => [
						'title' => __( 'Right', 'greenova-core' ),
						'icon'  => 'eicon-text-align-right',
					],
					'justify' => [
						'title' => __( 'Justified', 'greenova-core' ),
						'icon'  => 'eicon-text-align-justify',
					],
				],
				'default'   => 'center',
				'selectors' => [
					'{{WRAPPER}} .elementor-image-carousel-caption' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'caption_text_color',
			[
				'label'     => __( 'Text Color', 'greenova-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-image-carousel-caption' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'caption_typography',
				'global'   => [
					'default' => Global_Colors::COLOR_ACCENT,
				],
				'selector' => '{{WRAPPER}} .elementor-image-carousel-caption',
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		if ( empty( $settings['carousel'] ) ) {
			return;
		}

		$slides = [];

		foreach ( $settings['carousel'] as $index => $attachment ) {
			//$image_url = \Elementor\Group_Control_Image_Size::get_attachment_image_src( $attachment['id'], 'thumbnail', $settings );

			$image_size = wp_get_attachment_image( $attachment['id'], $settings['thumbnail_size'], false, [
				'class' => esc_attr( 'swiper-slide-image' ),
				'alt'   => esc_attr( \Elementor\Control_Media::get_image_alt( $attachment ) ),
			] );
			//var_dump($image_size);

			//$image_html = '<img class="swiper-slide-image" src="' . esc_attr( $image_url ) . '" alt="' . esc_attr( \Elementor\Control_Media::get_image_alt( $attachment ) ) . '" />';


			$link_tag = '';

			$link = $this->get_link_url( $attachment, $settings );

			if ( $link ) {
				$link_key = 'link_' . $index;

				$this->add_lightbox_data_attributes( $link_key, $attachment['id'], $settings['open_lightbox'], $this->get_id() );

				if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
					$this->add_render_attribute( $link_key, [
						'class' => 'elementor-clickable',
					] );
				}

				$this->add_link_attributes( $link_key, $link );

				$link_tag = '<a ' . $this->get_render_attribute_string( $link_key ) . '>';
			}

			$image_caption = $this->get_image_caption( $attachment );

			$slide_html = '<div class="swiper-slide">' . $link_tag . '<figure class="swiper-slide-inner">' . $image_size;

			if ( ! empty( $image_caption ) ) {
				$slide_html .= '<figcaption class="elementor-image-carousel-caption">' . $image_caption . '</figcaption>';
			}

			$slide_html .= '</figure>';

			if ( $link ) {
				$slide_html .= '</a>';
			}

			$slide_html .= '</div>';

			$slides[] = $slide_html;
		}

		if ( empty( $slides ) ) {
			return;
		}

		$this->add_render_attribute( [
			'carousel'         => [
				'class' => 'elementor-image-carousel swiper-wrapper',
			],
			'carousel-wrapper' => [
				'class' => 'elementor-image-carousel-wrapper swiper-container',
				'dir'   => $settings['direction'],
			],
		] );

		$show_dots   = ( in_array( $settings['navigation'], [ 'dots', 'both' ] ) );
		$show_arrows = ( in_array( $settings['navigation'], [ 'arrows', 'both' ] ) );

		if ( 'yes' === $settings['image_stretch'] ) {
			$this->add_render_attribute( 'carousel', 'class', 'swiper-image-stretch' );
		}

		$slides_count = count( $settings['carousel'] );

		?>
        <div <?php echo $this->get_render_attribute_string( 'carousel-wrapper' ); ?>>
            <div <?php echo $this->get_render_attribute_string( 'carousel' ); ?>>
				<?php echo implode( '', $slides ); ?>
            </div>
			<?php if ( 1 < $slides_count ) : ?>
				<?php if ( $show_dots ) : ?>
                    <div class="swiper-pagination"></div>
				<?php endif; ?>
				<?php if ( $show_arrows ) : ?>
                    <div class="elementor-swiper-button elementor-swiper-button-prev">
                        <i class="eicon-chevron-left" aria-hidden="true"></i>
                        <span class="elementor-screen-only"><?php _e( 'Previous', 'greenova-core' ); ?></span>
                    </div>
                    <div class="elementor-swiper-button elementor-swiper-button-next">
                        <i class="eicon-chevron-right" aria-hidden="true"></i>
                        <span class="elementor-screen-only"><?php _e( 'Next', 'greenova-core' ); ?></span>
                    </div>
				<?php endif; ?>
			<?php endif; ?>
        </div>
		<?php
	}

	/**
	 * Retrieve image carousel link URL.
	 *
	 * @param  array   $attachment
	 * @param  object  $instance
	 *
	 * @return array|string|false An array/string containing the attachment URL, or false if no link.
	 * @since  1.0.0
	 * @access private
	 *
	 */
	private function get_link_url( $attachment, $instance ) {
		if ( 'none' === $instance['link_to'] ) {
			return false;
		}

		if ( 'custom' === $instance['link_to'] ) {
			if ( empty( $instance['link']['url'] ) ) {
				return false;
			}

			return $instance['link'];
		}

		return [
			'url' => wp_get_attachment_url( $attachment['id'] ),
		];
	}

	/**
	 * Retrieve image carousel caption.
	 *
	 * @param  array  $attachment
	 *
	 * @return string The caption of the image.
	 * @since  1.2.0
	 * @access private
	 *
	 */
	private function get_image_caption( $attachment ) {
		$caption_type = $this->get_settings_for_display( 'caption_type' );

		if ( empty( $caption_type ) ) {
			return '';
		}

		$attachment_post = get_post( $attachment['id'] );

		if ( 'caption' === $caption_type ) {
			return $attachment_post->post_excerpt;
		}

		if ( 'title' === $caption_type ) {
			return $attachment_post->post_title;
		}

		return $attachment_post->post_content;
	}

}