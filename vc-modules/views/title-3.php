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
	<div class="rt-vc-title-3 <?php echo esc_attr( $align_class );?>">
		<?php if(!empty($titlethree)){ ?>
		<h2 class="section-title-3"><?php echo wp_kses_post( $titlethree );?></h2>
		<?php } ?>
		<?php if(!empty($titlethree2)){ ?>
		<h3 class="section-title-3"><?php echo esc_html( $titlethree2 );?></h3>
		<?php } ?>
		<div class="title-bottom-icon">
			<i aria-hidden="true" class="<?php echo esc_html( $icon_fa );?>"></i>
		</div>
		<?php if(!empty($subtitle)) {?>
		<p style="width:<?php echo esc_attr( $section_width ); ?>%; color:<?php echo esc_attr( $subtitle_color );?>;"><?php echo wp_kses_post( $subtitle );?></p>
		<?php } ?>
	</div>
</div>