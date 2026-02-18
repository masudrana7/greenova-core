<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Greenova_Core;
?>

<div class="rt-vc-counter rt-counter-wrapper">
    <div class="rtin-counter-content counter-alignment">
        <div class="rtin-counter1-box">
            <div class="rt-counter"
                 data-num="<?php echo esc_attr( $data['counter_number'] ); ?>"
                 data-rtSpeed="<?php echo esc_attr( $data['counter_speed']['size'] ); ?>"
                 data-rtSteps="<?php echo esc_attr( $data['counter_step']['size'] ); ?>"
            >
				<?php echo esc_html( $data['counter_number'] ); ?>
            </div>
			<?php if ( $data['title'] ) { ?>
                <div class="rtin-title"><?php echo esc_html( $data['title'] ); ?></div>
			<?php } ?>
        </div>
    </div>
</div>