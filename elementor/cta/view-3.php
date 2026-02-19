<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Greenova_Core;
// phpcs:disable WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound, WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound
if ( ! defined( 'ABSPATH' ) ) exit;
$subtitle         = $data['subtitle'];
$phone_upper_text = $data['phone_upper_text'];
$phone_number     = $data['phone_number'];
$class = empty( $subtitle ) ? ' rt-no-sub' : ' rt-has-sub';
?>
<div class="rt-cta-2 rc-cta-wrapper title-white <?php echo esc_attr( $class ); ?>">
    <div class="col-lg-7 col-md-7 col-sm-8 col-xs-12 rtin-cta-left">
        <div class="rtin-cta-text-holder">
            <h3 class="cta-title"><?php echo esc_html( $data['title'] ); ?></h3>
            <div class="rtin-cta-subtitle"><?php echo esc_html( $subtitle ); ?></div>
        </div>
    </div>
    <div class="col-lg-5 col-md-5 col-sm-4 col-xs-12 rtin-cta-right">
        <div class="rtin-phone-holder">
            <div class="rtin-cta-phone-text"><?php echo esc_html( $phone_upper_text ); ?>:</div>
            <div class="rtin-cta-phone-number">
                <i class="fas fa-phone-alt" aria-hidden="true"></i>
                <span><?php echo esc_html( $phone_number ); ?></span>
            </div>
        </div>
    </div>
</div>