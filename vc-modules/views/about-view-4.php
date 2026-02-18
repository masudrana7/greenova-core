<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

$custom_class = vc_shortcode_custom_css_class( $css );
$col_class = '';
if ( !empty ( $image ) ) {
	$col_class = 'col-lg-7 col-md-7 col-sm-7 col-xs-12';	
} else {
	$col_class = 'col-lg-12 col-md-12 col-sm-12 col-xs-12 no-pad-top';
}
?>
<div class="<?php echo esc_attr( $custom_class );?>">
	<div class="rt-about-one">
		<div class="row">
			<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
				<div class="rtin-about-content">
				<h1 style="color:<?php echo esc_attr( $title_color ); ?>"><?php echo wp_kses_post( $title ); ?></h1>
				<div class="rtin-about-text"><?php echo wp_kses_post( $content );?></div>
				<div class="read-more-button">
					<a href="<?php echo esc_url( $buttonurl );?>" class="ghost-color-btn"><?php echo esc_html( $buttontext );?></a>
				</div>
				</div>
			</div>
			<?php if ( !empty ( $image ) ) { ?>
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
				<div class="rtin-about-image">
					<a href="<?php echo esc_url( $buttonurl );?>"><?php echo wp_get_attachment_image( $image, 'full' ); ?></a>
				</div>
			</div>
			<?php } ?>
		</div>
	</div>
</div>