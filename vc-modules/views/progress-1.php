<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */
$custom_class = vc_shortcode_custom_css_class( $css );
$progressbars = vc_param_group_parse_atts($progress_bars);
$count1 = 1;
?>
<div class="<?php echo esc_attr( $custom_class );?>">
<?php if ( !empty( $progressbars ) ){ ?>
<div class="skill-area">
	<?php foreach ( $progressbars as $progressbar ) { ?>
		<?php
		if ( empty( $progressbar['title'] ) || empty( $progressbar['bar_number'] ) ) {
			continue;
		}
		?>
	<?php $progressbar_value = (int) $progressbar['bar_number'];?>
	<div class="progress">
		<div class="lead"><?php echo esc_html( $progressbar['title'] );?></div>
		<div data-wow-delay="1.2s" data-wow-duration="1.5s" style="width: <?php echo esc_attr( $progressbar_value );?>%; visibility: visible; animation-duration: 1.5s; animation-delay: 1.2s; animation-name: fadeInLeft;" data-progress="<?php echo esc_attr( $progressbar_value );?>%" class="progress-bar wow fadeInLeft animated"> 
		<span><?php echo esc_attr( $progressbar_value );?>%</span>
		</div>
	</div>
	<?php } ?>
</div>
<?php } else { ?>
	<?php esc_html_e ( 'Please insert some data' , 'greenova-core' ); ?>
<?php } ?>
</div>