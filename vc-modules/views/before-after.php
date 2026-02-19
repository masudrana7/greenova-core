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
	<div class="rt-after-before">
		<div class="rtin-ba-text"><span class="rtin-ba-before"><?php esc_html_e( 'Before' , 'greenova-core' ); ?></span><?php echo wp_get_attachment_image( $beforeimage, 'full', array( 'class' => 'img-responsive' ) ); ?><i class="fas fa-sliders-h" aria-hidden="true"></i></div>
		<div class="rtin-ba-text"><span class="rtin-ba-after"><?php esc_html_e( 'After' , 'greenova-core' ); ?></span><?php echo wp_get_attachment_image( $afterimage, 'full', array( 'class' => 'img-responsive' ) ); ?></div>
	</div>
</div>