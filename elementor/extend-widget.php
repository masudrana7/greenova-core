<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Greenova_Core;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

class RT_Extende_Element_Widget {

    public function __construct() {
        add_action( 'elementor/element/before_section_end', [ $this, 'greenova_elementor_widget_extend' ], 10, 3 );
        add_action( 'elementor/widget/before_render_content', [ $this, 'greenova_elementor_extend_widget_render' ] );
        //add_action( 'elementor/widget/print_template', array($this, 'greenova_elementor_custom_content_template_test' ), 10, 2);
        //add_action( 'elementor/widget/render_content', array($this,'greenova_elementor_custom_content_template'), 10, 2);
    }

    public function greenova_elementor_widget_extend( $section, $section_id, $args ) {
        /**
         * Extend Image Carousel
         */

        if ( 'image-carousel' === $section->get_name() && $section_id == 'section_style_navigation' ) {
            $section->add_control(
                'nav_style',
                [
                    'label'   => esc_html__( 'Nab Button Style', 'greenova-core' ),
                    'type'    => \Elementor\Controls_Manager::SELECT,
                    'default' => 'default-style',
                    'options' => [
                        'default-style' => __( 'Default', 'greenova-core' ),
                        'square-style'  => __( 'Square', 'greenova-core' ),
                    ],

                ]
            );
        }
    }


    /**
     * render custom control output
     *
     */
    public function greenova_elementor_extend_widget_render( $widget ) {
        /**
         * Adding a new attribute to our button
         *
         * @param  \Elementor\Widget_Base  $button
         */
        if ( 'image-carousel' === $widget->get_name() ) {
            // Get the settings
            $settings = $widget->get_settings();
            // Adding our type as a class to the button
            if ( $settings['nav_style'] ) {
                $widget->add_render_attribute( 'carousel-wrapper',
                    [
                        'class' => $settings['nav_style'],
                    ], true );
            }
        }
    }


    /**
     * content template
     *
     */


    function greenova_elementor_custom_content_template( $content, $widget ) {
        if ( 'image-carousel' === $widget->get_name() ) {
            $settings = $widget->get_settings();


            return $content;
        }
    }


    public function greenova_elementor_custom_content_template_test( $template, $widget ) {
        /**
         * Adding a new attribute to our button
         *
         * @param  \Elementor\Widget_Base  $button
         */
        if ( 'heading' === $widget->get_name() ) {
            ob_start(); ?>


            <?php

            $template = ob_get_clean();
        }

        return $template;
    }


}

new RT_Extende_Element_Widget();