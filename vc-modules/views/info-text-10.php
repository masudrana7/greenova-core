<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

$heading = $wrapper_css = $icon_css = $title_css = $content_css = $icon_holder_style = '';

$class = vc_shortcode_custom_css_class( $css );
$class .= " {$layout}";

$all_feature_lists = vc_param_group_parse_atts($feature_lists);



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

?>
<div class="rt-info-text-10">
	<div class="service-box"><?php echo wp_get_attachment_image( $back_image, 'greenova-size15', array( 'class' => 'img-responsive' ) ); ?>
		<div class="content-list">
			<h3 style="color:<?php echo esc_attr( $title_color_fon ); ?>"><?php echo wp_kses_post( $heading ); ?></h3>
			<?php if ( !empty( $sub_title ) ) { ?>
			<div class="rt-sub-title" style="color:<?php echo esc_attr( $sub_title_color ); ?>"><?php echo wp_kses_post( $sub_title ); ?></div>
			<?php } ?>
			<?php if ( !empty( $all_feature_lists ) ) { ?>
			<ul class="feature-list">			
			<?php foreach ( $all_feature_lists as $featurelist ) { ?>
			 <li><?php echo esc_html ( $featurelist['feature_list'] ); ?></li>
			<?php  } ?>
			</ul>
			<?php } ?>
		</div>
	</div>
</div>





























