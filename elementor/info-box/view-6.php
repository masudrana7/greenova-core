<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Greenova_Core;
// phpcs:disable WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound, WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound
if ( ! defined( 'ABSPATH' ) ) exit;
?>

<div class="rt-info-text-10 rt-info-box">
    <div class="service-box">
		<?php echo wp_get_attachment_image( $data['bg_image6']['id'], 'greenova-size15', [ 'class' => 'img-responsive' ] ); ?>
        <div class="content-list content-align">
            <h3 class="info-title"><?php echo wp_kses_post( $data['title'] ); ?></h3>
			<?php if ( $data['subtitle6'] ) { ?>
                <div class="rt-sub-title"><?php echo wp_kses_post( $data['subtitle6'] ); ?></div>
			<?php } ?>
			<?php echo wp_kses_post( $data['content6'] ); ?>
        </div>
    </div>
</div>

