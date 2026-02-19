<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */
if ( ! defined( 'ABSPATH' ) ) exit;

$class = vc_shortcode_custom_css_class( $css );
$greenova_socials = GREENOVA_Theme_Helper::socials();
?>
<div class="rt-vc-contact-2 <?php echo esc_attr( $class );?>">
	<div class="header-info">
		<?php if( !empty( $title ) ): ?>
			<h2><?php echo wp_kses_post( $title ); ?></h2>
		<?php endif; ?>
		<?php if( !empty( $sub_title ) ): ?>
			<p><?php echo wp_kses_post( $sub_title ); ?></p>
		<?php endif; ?>
	</div>
	<ul class="rtin-item">
		<?php if( !empty( $address ) ): ?>
			<li><i class="fas fa-map-marker-alt" aria-hidden="true"></i><?php echo wp_kses_post( $address ); ?></li>
		<?php endif; ?>
		<?php if( !empty( $phone ) ): ?>		
			<li><i class="fas fa-phone-alt" aria-hidden="true"></i><?php echo esc_html( $phone ); ?></li>
		<?php endif; ?>
		<?php if( !empty( $email ) ): ?>
			<li><i class="far fa-envelope" aria-hidden="true"></i><?php echo esc_html( $email ); ?></li>
		<?php endif; ?>
		<?php if( !empty( $fax ) ): ?>
			<li><i class="fa fa-fax" aria-hidden="true"></i><?php echo esc_html( $fax ); ?></li>
		<?php endif; ?>
		<?php if( $socials=='true' && !empty( $greenova_socials ) ): ?>
			<li>
				<h3><?php esc_html_e( 'Find Us On', 'greenova-core' ); ?></h3>
				<ul class="contact-social">
					<?php foreach ( $greenova_socials as $greenova_social ): ?>
						<li><a target="_blank" href="<?php echo esc_url( $greenova_social['url'] );?>"><i class="fab <?php echo esc_attr( $greenova_social['icon'] );?>"></i></a></li>
					<?php endforeach; ?>
				</ul>
			</li>		
		<?php endif; ?> 
	</ul>
</div>