<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Greenova_Core;
if ( ! defined( 'ABSPATH' ) ) exit;
?>
<div class="rt-vc-counter-4 rt-counter-wrapper">
    <div class="awards-box">
        <div class="media">
            <a href="#" class="pull-left icon-wrapper">
				<?php \Elementor\Icons_Manager::render_icon( $data['counter_icon'], [ 'aria-hidden' => 'true' ] ); ?>
            </a>
            <div class="media-body">
                <h3 class="title-bar35small rt-counter about-counter"
                    data-num="<?php echo esc_attr( $data['counter_number'] ); ?>"
                    data-rtSpeed="<?php echo esc_attr( $data['counter_speed']['size'] ); ?>"
                    data-rtSteps="<?php echo esc_attr( $data['counter_step']['size'] ); ?>"
                >
					<?php echo esc_html( $data['counter_number'] ); ?>
                </h3>
                <p class="rtin-title"><?php echo esc_html( $data['title'] ); ?></p>
            </div>
        </div>
    </div>
</div>