<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */
// phpcs:disable WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
if ( ! defined( 'ABSPATH' ) ) exit;

$class		 = vc_shortcode_custom_css_class( $css );
$primary_color_op = GREENOVA_Theme::$options['primary_color'];
$counter_css = $counter_color ? "color:{$counter_color};" : "color:{$primary_color_op};";
$counter_css .= "font-size: {$icon_size}px;";
$title_css   = $title_color ? "color:{$title_color};" : "color:{$primary_color_op};";
$title_css   .= "font-size: {$title_size}px;";
$alignment	 = "text-align:{$title_align}";
?>
<div class="rt-vc-counter-2 <?php echo esc_attr( $class );?>" <?php if( !empty( $counter_maxwidth ) ) { ?>style="max-width:<?php echo esc_attr( $counter_maxwidth ); ?>px;" <?php } ?>>
	<div class="rtin-counter-content">
		<div class="rtin-counter2-box " style="<?php echo esc_attr( $alignment ); ?>">
			<div class="rt-counter" style="<?php echo esc_attr( $counter_css ); ?>" data-num="<?php echo esc_html( $counter_number ); ?>" data-rtSpeed="<?php echo esc_html( $counter_speed );?>" data-rtSteps="<?php echo esc_html( $counter_steps ); ?>"><?php echo esc_html( $counter_number ); ?></div>
		</div>
		<div class="rtin-counter2-box" style="<?php echo esc_attr( $alignment ); ?>">
			<?php if ( !empty ( $title ) ) { ?>
			<div class="rtin-title" style="<?php echo esc_attr( $title_css ); ?>"><?php echo esc_html( $title ); ?></div>
			<?php } ?>
		</div>
	</div>
</div>