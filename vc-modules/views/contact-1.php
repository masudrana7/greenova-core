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
<div class="rt-vc-contact-1 <?php echo esc_attr( $class );?>">
	<ul class="rtin-item">
		<?php if( !empty( $address ) ): ?>
			<li>
				<i class="fas fa-map-marker-alt" aria-hidden="true"></i>
				<h3><?php esc_html_e( 'Address', 'greenova-core' ); ?></h3>
				<p><?php echo wp_kses_post( $address ); ?></p> 
			</li>		
		<?php endif; ?>
		<?php if( !empty( $email ) ): ?>
			<li>
				<i class="far fa-envelope" aria-hidden="true"></i>
				<h3><?php esc_html_e( 'E-mail', 'greenova-core' ); ?></h3>
				<p><?php echo esc_html( $email ); ?></p>
			</li>		
		<?php endif; ?>
		<?php if( !empty( $phone ) ): ?>		
			<li>
				<i class="fas fa-phone-alt" aria-hidden="true"></i>
				<h3><?php esc_html_e( 'Phone', 'greenova-core' ); ?></h3>
				<p><?php echo esc_html( $phone ); ?></p>   
			</li>
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