<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Greenova_Core;
// phpcs:disable WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound, WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound
if ( ! defined( 'ABSPATH' ) ) exit;
?>
<div class="rt-after-before rt-before-after-wrapper">
    <div class="rtin-ba-text">
		<?php if ( $data['before_text'] ) : ?>
            <span class="rtin-ba-before label-text"><?php echo esc_html( $data['before_text'] ); ?></span>
		<?php endif; ?>
		<?php echo wp_kses_post( \Elementor\Group_Control_Image_Size::get_attachment_image_html( $data, 'thumbnail1', 'image1' ) ); ?>
        <i class="fas fa-sliders-h center-button" aria-hidden="true"></i>
        <div class="overlay"></div>
    </div>
    <div class="rtin-ba-text">
		<?php if ( $data['after_text'] ) : ?>
            <span class="rtin-ba-after label-text"><?php echo esc_html( $data['after_text'] ); ?></span>
		<?php endif; ?>
		<?php echo wp_kses_post( \Elementor\Group_Control_Image_Size::get_attachment_image_html( $data, 'thumbnail2', 'image2' ) ); ?>
        <div class="overlay"></div>
    </div>
</div>
