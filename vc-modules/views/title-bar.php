<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

$custom_class = vc_shortcode_custom_css_class( $css );
remove_filter( 'the_content', 'wpautop' );
if( $title_align == "left" ){
	$align_class = 'rtin-section-title-left';
} else if( $title_align == "center" ){
	$align_class = 'rtin-section-title-center';
} else {
	$align_class = 'rtin-section-title-right';
}
if ( $has_bar == 'true' ) {
	$has_bar_class = '';
} else {
	$has_bar_class = 'no-bar';
}
if ( $bar_color == 'true' ) {
	$bar_color_class = 'rtin-dark';
} else {
	$bar_color_class = 'rtin-light';
}
?>
<div class="<?php echo esc_attr( $custom_class );?>">
	<div class="rt-vc-title-1 <?php echo esc_attr( $align_class );?> <?php echo esc_attr( $has_bar_class ); ?> <?php echo esc_attr( $bar_color_class ); ?>">
		<?php if ( !empty($title ) ) { ?>
			<h2 class="rt-section-title-vc <?php echo esc_attr( $title_font_size_tab );?> <?php echo esc_attr( $title_font_size_mob );?>" style="font-size:<?php echo esc_attr( $title_font_size );?>px; color:<?php echo esc_attr( $title_color ); ?>;"><?php echo esc_html( $title );?></h2>
		<?php } if(!empty($content)) {?>
			<p class="rt-section-sub-title-vc" style="width:<?php echo esc_attr( $section_width ); ?>%;"><?php echo wp_kses_post( $content );?></p>
		<?php } ?>
	</div>
</div>