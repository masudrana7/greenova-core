<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */
if ( ! defined( 'ABSPATH' ) ) exit;

$btn_class = 'greenova-button-5';
$class  = vc_shortcode_custom_css_class( $css );
$class .= empty( $subtitle ) ? ' rt-no-sub': ' rt-has-sub';
$title_css   = $title_color ? "color:{$title_color};" : '';
?>
<div class="rt-cta-1 <?php echo esc_attr( $class );?>">
	<div class="container">
		<div class="row">
			<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
				<h3 style="<?php echo esc_attr( $title_css ); ?>"><?php echo esc_html( $title );?></h3>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
				<div class="rtin-cta-contact-button">
					<?php if ( !empty ( $buttontext ) ) { ?>
					<a class="<?php echo esc_attr( $btn_class );?>" href="<?php echo esc_html( $btnurl );?>"><?php echo esc_html( $buttontext );?></a>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>