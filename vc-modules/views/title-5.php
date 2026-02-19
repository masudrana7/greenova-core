<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */
if ( ! defined( 'ABSPATH' ) ) exit;

$custom_class = vc_shortcode_custom_css_class( $css );

if( $title_align == "left" ){
	$align_class = 'rtin-section-title-left';
} else if( $title_align == "center" ){
	$align_class = 'rtin-section-title-center';
} else {
	$align_class = 'rtin-section-title-right';
}

?>
<div class="<?php echo esc_attr( $custom_class );?>">
	<div class="rt-vc-title-5 <?php echo esc_attr( $align_class );?>">
		<?php if ( !empty( $content )) {?>
			<p class="rt-section-sub-title-vc" style="color:<?php echo esc_attr( $subtitle_color ); ?>; width:<?php echo esc_attr( $section_width ); ?>%;"><?php echo wp_kses_post( $content );?></p>
		<?php } ?>
		<?php if(!empty($title_5)){ ?>
			<h2 class="rt-section-title-vc <?php echo esc_attr( $title_font_size_tab );?> <?php echo esc_attr( $title_font_size_mob );?>" style="font-size:<?php echo esc_attr( $title_font_size );?>px; color:<?php echo esc_attr( $title_color ); ?>;"><?php echo esc_html( rawurldecode( base64_decode( wp_strip_all_tags( $title_5 ) ) ) );?></h2>
		<?php } ?>
	</div>
</div>