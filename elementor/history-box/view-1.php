<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Greenova_Core;
?>

<div class="rt-history-box rt-history-box-wrapper">
    <h2 class="title-bar50 main-title"><?php echo wp_kses_post( $data['title'] ); ?></h2>
    <div class="history-text"><?php echo esc_html( $data['history_text'] ); ?></div>
	<?php if ( $data['list'] ) { ?>
        <ul class="rtin-history-list">
			<?php foreach ( $data['list'] as $key => $tab ) { ?>
                <li>
                    <h3 class="point-title"><?php echo esc_html( $tab["point_title"] ); ?></h3>
                    <p class="point-text"><?php echo esc_html( $tab["point_text"] ); ?></p>
                </li>
			<?php } ?>
        </ul>
	<?php } ?>
</div>