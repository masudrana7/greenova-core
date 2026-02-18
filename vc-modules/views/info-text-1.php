<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

$heading = $wrapper_css = $icon_css = $title_css = $content_css = $show_icon_bord = $icon_holder_style = '';

$class = vc_shortcode_custom_css_class( $css );
$class .= " {$layout} {$custom_class}";

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
if ( $show_icon_border == 'true' ) {
	$show_icon_bord = 'show_icon_bord';
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
/*if ( $bgcolor != '' ) {
     $class       .= ' has-bg';
     $wrapper_css .= 'background-color: '. $bgcolor . ';';
}*/

?>
<div class="<?php echo esc_attr ( $show_icon_bord ); ?> <?php echo esc_attr( $class );?> <?php if ( $icontype == 'flaticon' ) { ?>flaticon <?php } ?> rt-info-text-1" data-color="<?php echo esc_attr( $color );?>" data-hover="<?php echo esc_attr( $hovercolor );?>" data-title-color="<?php echo esc_attr( $title_color );?>" data-title-hover="<?php echo esc_attr( $title_hover_color );?>" data-bghovercolor="<?php echo esc_attr( $icon_bg_color );?>">
	<div class="media" style="<?php echo esc_attr( $wrapper_css );?>" >
		<div class="pull-left">
				
			<?php if ( $icontype == 'image' ) { ?>
				<?php echo wp_get_attachment_image( $image, array( $size, $size ), true ); ?>
			<?php } else { ?>

			<?php if ( !empty( $url ) ) { ?><a href="<?php echo esc_url( $url ); ?>"><?php } ?><i style="border-color:<?php echo esc_attr($color); ?>; color:<?php echo esc_attr($color); ?>;
			<?php echo esc_attr($icon_css); ?>" class="<?php echo esc_attr( $icon ); ?>" aria-hidden="true"></i><?php if ( !empty( $url ) ) { ?></a><?php } ?>            
			<?php } ?>
		
		</div>
		<div class="media-body">
		<?php if ( !empty( $heading ) ) { ?>
			<h3 style="<?php echo esc_attr( $title_css ); ?>"><?php echo wp_kses_post( $heading ); ?></h3>
		<?php } ?>
			<p style="<?php echo esc_attr( $content_css );?>"><?php echo wp_kses_post( $content ); ?></p>
		</div>
		
	</div>
</div>