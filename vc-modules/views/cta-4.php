<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */
// phpcs:disable WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound, WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound
if ( ! defined( 'ABSPATH' ) ) exit;

$btn_class = 'greenova-button-5';
$class  = vc_shortcode_custom_css_class( $css );
$class .= empty( $subtitle ) ? ' rt-no-sub': ' rt-has-sub';

$title_css = $title_color ? "color:{$title_color};" : '';
$phone_css = $phone_color ? "color:{$phone_color};" : '';
$title_font_size = $title_font_size ? "font-size:{$title_font_size}" : '28';

?>
<div class="rt-cta-4 footer-topbar">
	<div class="row">
		<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
			<div class="emergrncy-img-holder" style="background-image: url(<?php if ( !empty ( $image )) { echo esc_url( wp_get_attachment_url( $image ) ); } else { ?><?php echo esc_url( plugins_url( '/assets/footertopbar-img.jpg', dirname(__FILE__) ) ); ?><?php } ?>);"></div>
		</div>
		<div class="col-lg-7 col-md-7 col-sm-7 col-xs-12" style="background:<?php echo esc_attr( GREENOVA_Theme::$options['primary_color'] ); ?>" >
			<div class="emergrncy-content-holder">
				<div class="emergrncy-content-holder-inner">
					<h3 style="<?php echo esc_attr( $title_css ); ?><?php echo esc_attr( $title_font_size ); ?>px"><?php echo esc_html( $title );?></h3>
					<?php if ( !empty ( $phone_number ) ) { ?> <span style="<?php echo esc_attr( $phone_css ); ?>"><i class="fas fa-phone-alt" aria-hidden="true"></i><?php echo esc_html( $phone_number ) ?></span> <?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>