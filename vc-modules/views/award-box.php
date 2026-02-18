<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

$wrapper_css = $icon_css = $content_css = $icon_padding = $icon_gap = '';

$class = vc_shortcode_custom_css_class( $css );

if ( $content_size != '' ) {
    $content_size = (int) $content_size;
    $content_css .= "font-size: {$content_size}px;";
}
if ( $width != '' ) {
    $width        = (int) $width;
    $wrapper_css .= 'max-width: '. $width . 'px;';
}
if ( $color != '' ) {
	$icon_css  .= "color: {$color};";
}
if ( $icon_pad != '' ) {
	$icon_gap  = " padding-bottom: {$icon_pad}px;";
}
if ( $size != '' ) {
	$icon_css  .= " font-size: {$size}px;";
}
?>
<div class="rt-award-box <?php echo esc_attr( $class );?>" style="<?php echo esc_attr( $wrapper_css );?>">
	<div class="single-wining-section">
		<div class="image" style="<?php echo esc_attr( $icon_gap ); ?>">
			<?php if ( $icontype == 'image' ): ?>
				<?php echo wp_get_attachment_image( $image, array( $size, $size ), true ); ?>
			<?php else: ?>
				<i class="<?php echo esc_attr( $icon );?>" aria-hidden="true" style="<?php echo esc_attr( $icon_css ); ?>"></i>
			<?php endif; ?>
		</div>
		<div class="divider-line"></div>
		<div style="<?php echo esc_attr( $content_css );?>"><?php echo wp_kses_post( $content ); ?></div>
	</div>
</div>