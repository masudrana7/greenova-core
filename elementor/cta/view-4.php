<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Greenova_Core;
// phpcs:disable WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound, WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound
if ( ! defined( 'ABSPATH' ) ) exit;

$phone_upper_text = $data['phone_upper_text'];
$phone_number     = $data['phone_number'];
$background_url   = GREENOVA_CORE_BASE_URL . '/vc-modules/assets/footertopbar-img.jpg';
?>

<div class="rt-cta-4 footer-topbar rc-cta-wrapper title-white">
    <div class="row">
        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
            <div class="emergrncy-img-holder"></div>
        </div>
        <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12 rtin-cta-right">
            <div class="emergrncy-content-holder">
                <div class="emergrncy-content-holder-inner">
                    <h3 class="cta-title"><?php echo esc_html( $data['title'] ); ?></h3>
					<?php if ( ! empty ( $phone_number ) ) : ?>
                        <span><i class="fas fa-phone-alt" aria-hidden="true"></i><?php echo esc_html( $phone_number ) ?></span>
					<?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>