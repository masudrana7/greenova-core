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

<div class="rt-image rt-dual-image-wrapper">
    <div class="rtin-back-image">
		<?php echo wp_kses_post( \Elementor\Group_Control_Image_Size::get_attachment_image_html( $data, 'thumbnail1', 'image1' ) ); ?>
        <div class="rtin-overlay-image">
			<?php echo wp_kses_post( \Elementor\Group_Control_Image_Size::get_attachment_image_html( $data, 'thumbnail2', 'image2' ) ); ?>
        </div>
    </div>
</div>