<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */
if ( ! defined( 'ABSPATH' ) ) exit;

$custom_class = vc_shortcode_custom_css_class( $css );
?>
<div class="<?php echo esc_attr( $custom_class );?>">
	<div class="rt-image">
		<div class="rtin-back-image"><?php echo wp_get_attachment_image( $backimage, 'full', array( 'class' => 'img-responsive' ) ); ?>
			<div class="rtin-overlay-image"><?php echo wp_get_attachment_image( $overlayimage, 'full', array( 'class' => 'img-responsive' ) ); ?></div>
		</div>
	</div>
</div>