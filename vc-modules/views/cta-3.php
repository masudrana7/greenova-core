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
$title_font_size = $title_font_size ? "font-size:{$title_font_size}" : '28';

?>
<div class="rt-cta-3 <?php echo esc_attr( $class );?>">
	<div class="row">
		<div class="col-lg-10 col-md-9 col-sm-9 col-xs-12">
			<<?php echo esc_html( $title_tag ); ?> class="rtin-cta-title" style="<?php echo esc_attr( $title_css ); ?><?php echo esc_attr( $title_font_size ); ?>px"><?php echo esc_html( $title );?></<?php echo esc_html( $title_tag ); ?>>
		</div>
		<div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
			<div class="rtin-cta-contact-button">
				<?php if ( !empty ( $buttontext ) ) { ?>
				<a class="<?php echo esc_attr( $btn_class );?>" href="<?php echo esc_html( $btnurl );?>"><span><?php echo esc_html( $buttontext );?></span></a>
				<?php } ?>
			</div>
		</div>
	</div>
</div>