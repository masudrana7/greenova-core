<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */
// phpcs:disable WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
if ( ! defined( 'ABSPATH' ) ) exit;

$heading = $wrapper_css = $icon_css = $title_css = $content_css = $icon_holder_style = '';

$class = vc_shortcode_custom_css_class( $css );
$class .= " {$layout}";

if ( empty($title_color) ) {
	$title_color_fon = '#ffffff;';
} else {
	$title_color_fon =  $title_color;
}
$heading   .= !empty( $url ) ? '<a style="color:' . $title_color_fon . ' ;" href="' . $url . '">' : '';
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
if ( empty( $hovercolor ) ) {
	$hovercolor = '#ffffff';
}
if ( empty( $title_hover_color ) ) {
	$title_hover_color = GREENOVA_Theme::$options['primary_color'];
}
if ( empty( $color ) ) {
	$color = '#ffffff';
}
if ( empty( $icon_bg_color ) ) {
	$icon_bg_color = GREENOVA_Theme::$options['primary_color'];
}
if ( empty( $icon_brcolor ) ) {
	$icon_br = 'border-color: #ffffff;';
} else {
	$icon_br = 'border-color:' . $icon_brcolor ;
}
if ( empty( $bgcolor ) ) {
	$new_bg = GREENOVA_Theme::$options['primary_color'];	
} else {
	$new_bg = $bgcolor;	
}
if ( !empty( $button_style )) {
	if ( $button_style == 'light') {
		$btn_style = 'btn-light';
	} else {
		$btn_style = 'btn-dark';
	}
}


?>
<div class="rt-info-text-6">
	<div class="service-box" style="background:<?php echo esc_attr( $new_bg ); ?>">
		<?php if ( $icontype == 'image' ){ ?>
			<span style="display: block;">
				<?php echo wp_get_attachment_image( $image, array($size, $size), '', array( 'class' => 'img-responsive' ) ); ?>
			</span>
		<?php } else { ?>
			<span><i style="color:<?php echo esc_attr($color); ?>;<?php echo esc_attr($icon_css); ?>" class="<?php echo esc_attr( $icon ); ?>" aria-hidden="true"></i></span>
		<?php } ?>
		<h3 style="color:<?php echo esc_attr( $title_color_fon ); ?>"><?php echo wp_kses_post( $heading ); ?></h3>
		<?php if ( !empty( $button_url ) ) { ?>
		<a class="btn-quote2 <?php echo esc_attr( $btn_style ); ?> " href="<?php echo esc_url( $button_url ); ?>"><?php echo wp_kses_post( $button_text ); ?></a>
		<?php } ?>
	</div>
</div>





























