<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Greenova_Core;
// phpcs:disable WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound, WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound
if ( ! defined( 'ABSPATH' ) ) exit;
$paly_icon = 'fa fa-play';
if ( $data['btn_icon'] ) {
	$paly_icon = $data['btn_icon'];
}
?>

<div class="rt-vc-video rt-video-wrapper">
	<?php if ( $data['title'] ): ?>
        <h2 class="rt-vc-title-left title"><?php echo esc_html( $data['title'] ); ?></h2>
	<?php endif; ?>
    <div class="rtin-item">
        <a class="rtin-btn rt-video-popup" href="<?php echo esc_url( $data['video_url'] ); ?>">
            <i class="<?php echo esc_attr( $paly_icon ); ?>" aria-hidden="true"></i>
        </a>
    </div>
</div>