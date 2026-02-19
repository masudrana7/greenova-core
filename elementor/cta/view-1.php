<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Greenova_Core;
// phpcs:disable WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound, WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound
if ( ! defined( 'ABSPATH' ) ) exit;
$subtitle  = '';
$btn_class = 'greenova-button-5';

$class    = empty( $subtitle ) ? ' rt-no-sub' : ' rt-has-sub';
$target   = $data['button_url']['is_external'] ? ' target="_blank"' : '';
$nofollow = $data['button_url']['nofollow'] ? ' rel="nofollow"' : '';

if ( 'style1' == $data['layout'] ) {
	$class .= ' rt-cta-1';
} elseif ( 'style2' == $data['layout'] ) {
	$class .= ' rt-cta-3';
}
?>

<div class="rc-cta-wrapper title-black <?php echo esc_attr( $class ); ?>">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                <h3 class="cta-title rtin-cta-title"><?php echo esc_html( $data['title'] ); ?></h3>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                <div class="rtin-cta-contact-button">
					<?php
					if ( $data['button_text'] ) :
						printf( '<a class="%s" href="%s" %s><span>%s</span></a>',
							esc_attr( $btn_class ),
							esc_url( $data['button_url']['url'] ),
							esc_attr( $target . $nofollow ),
							esc_html( $data['button_text'] )
						);
					endif;
					?>
                </div>
            </div>
        </div>
    </div>
</div>