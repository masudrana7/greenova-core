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
	<div class="rt-vc-title-4 why-choose-us-area <?php echo esc_attr( $align_class );?>">
		<?php if(!empty($subtitle)) { ?>
			<p class="rt-section-sub-title-vc" style="width:<?php echo esc_attr( $section_width ); ?>%; color:<?php echo esc_attr( $subtitle_color );?>;"><?php echo wp_kses_post( $subtitle );?></p>
		<?php } ?>
		<?php if(!empty($title)){ ?>
			<h2 class="solid-title <?php echo esc_attr( $title_font_size_tab );?> <?php echo esc_attr( $title_font_size_mob );?>" style="font-size:<?php echo esc_attr( $title_font_size );?>px; color:<?php echo esc_attr( $title_color ); ?>;"><?php echo esc_html( $title );?></h2>
		<?php } ?> 
		
	</div>
</div>