<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

$custom_class = vc_shortcode_custom_css_class( $css );
$tabs = vc_param_group_parse_atts($tabs);
$count1 = 1;
$count2 = 1;
$today = date('YmdHis');
if( !empty ( $tabs ) ) {
	foreach($tabs as $key => $tab){
		$tabs[$key]['uid'] = rand(0, $today);	
	}
}
?>
<div class="<?php echo esc_attr( $custom_class );?>">
	<div class="rt-open-hour">
		<div class="overlay-effect"></div>
		<div class="ot-data-area">
			<?php if ( $tabs ) { ?>
			<h3 style="color:<?php echo esc_attr( $title_color ); ?>"><?php
					if ( !empty( $title ) ) {
						echo esc_html( $title );
					} else {
						echo esc_html( 'Insert Title' , 'greenova-core' );
					}
				?></h3>
			<ul>
			<?php foreach ($tabs as $key => $tab) { ?>
			<li><?php
					if ( !empty( $tab["weekdays"] ) ) {
						echo esc_html( $tab["weekdays"] );
					} else {
						echo esc_html( 'Insert Weekday' , 'greenova-core' );
					}
				?> <span>  <?php
					if ( !empty( $tab["openhour"] ) ) {
						echo esc_html( $tab["openhour"] );
					} else {
						echo esc_html( 'Insert Time' , 'greenova-core' );
					}
				?> </span></li>
			<?php $count2++; } ?>	
			</ul>
			<?php  } else { ?>
				<?php esc_html_e ( 'Please insert some data' , 'greenova-core' ); ?>
			<?php } ?>
		</div>
	</div>
</div>