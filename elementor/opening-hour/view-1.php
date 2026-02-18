<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Greenova_Core;
if ( ! defined( 'ABSPATH' ) ) exit;

$tabs   = $data['opening_hour_list'];
$count1 = 1;
$count2 = 1;
$today  = date( 'YmdHis' );
if ( ! empty ( $tabs ) ) {
	foreach ( $tabs as $key => $tab ) {
		$tabs[ $key ]['uid'] = rand( 0, $today );
	}
}
?>

<div class="rt-open-hour rt-open-hour-wrapper">
    <div class="overlay-effect"></div>
    <div class="ot-data-area">
		<?php if ( ! empty( $tabs ) ) { ?>
            <h3><?php echo esc_html( $data['title'] ); ?></h3>
            <ul>
				<?php foreach ( $tabs as $key => $tab ) { ?>
                    <li><?php
						if ( ! empty( $tab["weekdays"] ) ) {
							echo esc_html( $tab["weekdays"] );
						} else {
							echo esc_html( 'Insert Weekday', 'greenova-core' );
						}
						?> <span>  <?php
							if ( ! empty( $tab["openhour"] ) ) {
								echo esc_html( $tab["openhour"] );
							} else {
								echo esc_html( 'Insert Time', 'greenova-core' );
							}
							?> </span></li>
					<?php $count2 ++;
				} ?>
            </ul>
		<?php } else { ?>
			<?php esc_html_e( 'Please insert some data', 'greenova-core' ); ?>
		<?php } ?>
    </div>
</div>


