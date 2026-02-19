<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Greenova_Core;
// phpcs:disable WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
if ( ! defined( 'ABSPATH' ) ) exit;
$paly_icon = 'fa fa-play-circle';
if ( $data['btn_icon'] ) {
	$paly_icon = $data['btn_icon'];
}
?>
<div class="rt-vc-video rt-video-wrapper">
    <div class="rtin-item">
		<?php if ( $data['title'] ): ?>
            <h2 class="rtin-title title"><?php echo esc_html( $data['title'] ); ?></h2>
		<?php endif; ?>
        <div class="rtin-content"><?php echo wp_kses_post( $data['content'] ); ?></div>
        <a class="rtin-btn rt-video-popup" href="<?php echo esc_url( $data['video_url'] ); ?>">
            <i class="<?php echo esc_attr( $paly_icon ); ?>"></i>
        </a>
    </div>
</div>