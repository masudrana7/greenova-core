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
if ( empty( $bgcolor ) ) {
	$new_bg = GREENOVA_Theme::$options['primary_color'];	
} else {
	$new_bg = $bgcolor;	
}
?>
<?php if ($icon_alignment == 'right') { ?>
<div class="service3-box-left rt-info-text-4" style="background:<?php echo esc_attr( $new_bg ); ?>">
	<div class="service3-content-holder">
		<?php if (!empty($url)) { ?>
			<h3><a href="<?php echo esc_url ( $url ); ?>"><?php echo wp_kses_post( $heading ); ?></a></h3>
		<?php } else { ?>
			<h3><?php echo wp_kses_post( $heading ); ?></h3>
		<?php } ?>
		<p style="<?php echo esc_attr( $content_css );?>"><?php echo wp_kses_post( $content ); ?></p>
	</div>
	<div class="service3-icon-holder">
	<?php if (!empty($url)) { ?>
		<a href="<?php echo esc_url ( $url ); ?>"><i style="color:<?php echo esc_attr($color); ?>;<?php echo esc_attr($icon_css); ?>" class="<?php echo esc_attr( $icon ); ?>" aria-hidden="true"></i></a>
	<?php } else { ?>
		<i style="color:<?php echo esc_attr($color); ?>;<?php echo esc_attr($icon_css); ?>" class="<?php echo esc_attr( $icon ); ?>" aria-hidden="true"></i>
	<?php } ?>
	</div>
</div>
<?php } else { ?>
<div class="service3-box-right rt-info-text-4" style="background:<?php echo esc_attr( $new_bg ); ?>">
	<div class="service3-icon-holder">
	<?php if ( $icontype == 'image' ) { ?>
		<?php echo wp_get_attachment_image( $image, array( $size, $size ), true ); ?>
	<?php } else { ?>
		<?php if (!empty($url)) { ?>
			<a href="<?php echo esc_url ( $url ); ?>"><i style="color:<?php echo esc_attr($color); ?>;<?php echo esc_attr($icon_css); ?>" class="<?php echo esc_attr( $icon ); ?>" aria-hidden="true"></i></a>
		<?php } else { ?>
			<i style="color:<?php echo esc_attr($color); ?>;<?php echo esc_attr($icon_css); ?>" class="<?php echo esc_attr( $icon ); ?>" aria-hidden="true"></i>
		<?php } ?>
	<?php } ?>
	</div>
	<div class="service3-content-holder">
		<?php if (!empty($url)) { ?>
			<h3><?php echo wp_kses_post( $heading ); ?></h3>
		<?php } else { ?>
			<h3><?php echo wp_kses_post( $heading ); ?></h3>
		<?php } ?>
		<p style="<?php echo esc_attr( $content_css );?>"><?php echo wp_kses_post( $content ); ?></p>
	</div>
</div>
<?php } ?>