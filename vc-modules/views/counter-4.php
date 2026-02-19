<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */
if ( ! defined( 'ABSPATH' ) ) exit;

$class		 = vc_shortcode_custom_css_class( $css );
$primary_color_op = GREENOVA_Theme::$options['primary_color'];
$counter_css = $counter_color ? "color:{$counter_color};" : "color:{$primary_color_op};";
$counter_css .= "font-size: {$icon_size}px;";
$title_css   = $title_color ? "color:{$title_color};" : "color:{$primary_color_op};";
$title_css   .= "font-size: {$title_size}px;";
$alignment	 = "text-align:{$title_align}";

$icon_css   = $icon_color ? "color:{$icon_color};" : "color:{$primary_color_op};";
$icon_css   .= "font-size: {$icon_fontsize}px;";
?>
<div class="rt-vc-counter-4 <?php echo esc_attr( $class );?>" <?php if( !empty( $counter_maxwidth ) ) { ?>style="max-width:<?php echo esc_attr( $counter_maxwidth ); ?>px;" <?php } ?>>
	<div class="awards-box">
		<div class="media">
			<a href="#" class="pull-left">
				<i class="<?php echo esc_attr( $icon_fa );?>" aria-hidden="true" style="<?php echo esc_attr( $icon_css ); ?>"></i>
			</a>
			<div class="media-body">
				<h3 class="title-bar35small rt-counter about-counter" style="<?php echo esc_attr( $counter_css ); ?>" data-num="<?php echo esc_html( $counter_number ); ?>" data-rtSpeed="<?php echo esc_html( $counter_speed );?>" data-rtSteps="<?php echo esc_html( $counter_steps ); ?>"><?php echo esc_html( $counter_number ); ?></h3>
				<p style="<?php echo esc_attr( $title_css ); ?>"><?php echo esc_html( $title ); ?></p>
			</div>
		</div>
	</div>
</div>