<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */
if ( ! defined( 'ABSPATH' ) ) exit;
$title_css = $section_css = '';
$custom_class = vc_shortcode_custom_css_class( $css );

if ( $button_style == 'style1' ) { 
	$btn_style = 'light-button';
} else if ( $button_style == 'style2' ) {
	$btn_style = 'dark-button';
} else if ( $button_style == 'style3' ) {
	$btn_style = 'dark-box';
} else if ( $button_style == 'style4' ) {
	$btn_style = 'light-box';
} else if ( $button_style == 'style5' ) {
	$btn_style = 'white-button';
}
if ( !empty( $title_color ) ) {
	$title_css  .= "color: {$title_color};";
}
if ( !empty( $title_font_size ) ) {
	$title_css  .= " font-size: {$title_font_size}px;";
}
if ( !empty( $title_font_weight ) ) {
	if ( $title_font_weight == 'light' ) {
		$title_css  .= " font-weight:500";
	} else {
		$title_css  .= " font-weight:{$title_font_weight}";
	}
}
if ( !empty( $section_align ) ) {
	$section_css  .= "text-align: {$section_align};";
}

$primary_color_op = GREENOVA_Theme::$options['primary_color'];
$content_css = $content_color ? "color:{$content_color};" : "color:{$primary_color_op};";
?>
<div class="<?php echo esc_attr( $custom_class );?> <?php echo esc_attr( $tab_layout );?>" style="<?php echo esc_attr( $section_css );?>">
	<div class="rt-text-with-btn">
		<div class="data-area">
		<?php if ( !empty( $content_text ) ) { ?>
			<<?php echo esc_html( $title_tag ); ?> style="<?php echo esc_attr( $title_css ); ?>"><?php echo rawurldecode( base64_decode( wp_strip_all_tags( $content_text ) ) );?></<?php echo esc_html( $title_tag ); ?>>
		<?php } ?>
		<?php if ( !empty ( $content ) ) { ?>
			<p style="<?php echo esc_attr( $content_css ); ?>"><?php echo wp_kses_post( $content );?></p>
		<?php } ?>
		<?php if ( !empty ( $button_text ) ) { ?>
			<a class="<?php echo esc_attr ( $btn_style ); ?>" href="<?php echo esc_attr( $button_url ); ?>"><span><?php echo esc_html( $button_text ); ?></span></a>
		<?php } ?>
		</div>
	</div>
</div>