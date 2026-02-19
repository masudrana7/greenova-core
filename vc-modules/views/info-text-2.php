<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */
if ( ! defined( 'ABSPATH' ) ) exit;

$heading = $wrapper_css = $icon_css = $title_css = $content_css = $icon_holder_style = '';

$class = vc_shortcode_custom_css_class( $css );
$class .= " {$layout}";

$heading   .= !empty( $url ) ? '<a style="color:' . $title_color . ' ;" href="' . $url . '">' : '';
$heading   .= $title;
$heading   .= !empty( $url ) ? '</a>' : '';

$btn_url    = !empty( $button_url ) ? $button_url : '';
$btn_text   = !empty( $button_text ) ? $button_text : '';

if ( $size != '' ) {
    $size       = (int) $size;
    $icon_css  .= "font-size: {$size}px;";
}
if ( $icon_padding != '' ) {
	$icon_padding = (int) $icon_padding;
	$icon_css    .= "padding: {$icon_padding}px;";
}
if ( $spacing_top != '' ) {
    $icon_holder_style .= "margin-bottom: {$spacing_top}px;";
}
if ( $spacing_bottom != '' ) {
    $title_css .= "margin-bottom: {$spacing_bottom}px;";
}
if ( $title_size != '' ) {
    $title_size   = (int) $title_size;
    $title_css   .= "font-size: {$title_size}px;";
}
if ( $content_size != '' ) {
    $content_size = (int) $content_size;
    $content_css .= "font-size: {$content_size}px;";
}

if ( empty($hovercolor) ) {
	$hovercolor = '#ffffff';
}
if ( empty($title_hover_color) ) {
	$title_hover_color = GREENOVA_Theme::$options['primary_color'];
}
if ( empty($color) ) {
	$color = GREENOVA_Theme::$options['primary_color'];
}
if ( empty($icon_bg_color) ) {
	$icon_bg_color = GREENOVA_Theme::$options['primary_color'];
}
if ( empty($icon_brcolor) ) {
	$icon_br = 'border-color:' . GREENOVA_Theme::$options['primary_color'] ;
} else {
	$icon_br = 'border-color:' . $icon_brcolor ;
}
if ( empty($bgcolor)) {
	$primary_rgb = GREENOVA_Theme_Helper::hex2rgb( GREENOVA_Theme::$options['primary_color'] );	
	$wrapper_css = 'background-color: rgba(' . $primary_rgb .' , 0.8)';
} else {
	$new_rgb = GREENOVA_Theme_Helper::hex2rgb( $bgcolor );	
	$wrapper_css = 'background-color: rgba(' . $new_rgb .' , 0.8)';
}
?>
<div class="rt-info-text-2">
	<div class="media">
		<div class="pull-left">
			<?php if ( $icontype == 'image' ) { ?>
				<?php echo wp_get_attachment_image( $image, array( $size, $size ), true ); ?>
			<?php } else { ?>
			<span style="<?php echo esc_attr ( $icon_br ); ?>"><i style="color:<?php echo esc_attr($color); ?>;<?php echo esc_attr($icon_css); ?>" class="<?php echo esc_attr( $icon_fa ); ?>" aria-hidden="true"></i></span>
			<?php } ?>
		</div>
		<div class="media-body">
			<h3 style="<?php echo esc_attr( $title_css ); ?>"><?php echo wp_kses_post( $heading ); ?></h3>
			<p><?php echo wp_kses_post( $content ); ?></p>
			<?php if ( !empty( $button_url ) ) { ?>
				<a class="btn-read-more-h-b" href="<?php echo esc_url( $button_url ); ?>"><?php echo wp_kses_post( $button_text ); ?></a>
			<?php } ?>
		</div>
	</div>
</div>