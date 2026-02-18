<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

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
<div class="rt-vc-counter-3 <?php echo esc_attr( $class );?>" <?php if( !empty( $counter_maxwidth ) ) { ?>style="max-width:<?php echo esc_attr( $counter_maxwidth ); ?>px;" <?php } ?>>
	<div class="about-counter-list">
		<div class="media">
			<a href="#" class="pull-left">				
				<i class="<?php echo esc_attr( $icon );?>" aria-hidden="true" style="<?php echo esc_attr( $icon_css ); ?>"></i>
			</a>
			<div class="media-body">
				<h2 class="rt-counter about-counter" style="<?php echo esc_attr( $counter_css ); ?>" data-num="<?php echo esc_html( $counter_number ); ?>" data-rtSpeed="<?php echo esc_html( $counter_speed );?>" data-rtSteps="<?php echo esc_html( $counter_steps ); ?>"><?php echo esc_html( $counter_number ); ?></h2>
				<span style="<?php echo esc_attr( $title_css ); ?>"><?php echo esc_html( $title ); ?></span>
			</div>
		</div>
	</div>
</div>