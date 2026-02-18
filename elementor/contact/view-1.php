<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Greenova_Core;

$greenova_socials = \GREENOVA_Theme_Helper::socials();
?>
<div class="rt-vc-contact-1 rt-contact-wrapper">
    <ul class="rtin-item">
		<?php if ( $data['address'] ): ?>
            <li>
                <i class="fas fa-map-marker-alt info-icon" aria-hidden="true"></i>
                <h3 class='address-label'><?php esc_html_e( 'Address', 'greenova-core' ); ?></h3>
                <p class='address-info'><?php echo wp_kses_post( $data['address'] ); ?></p>
            </li>
		<?php endif; ?>
		<?php if ( $data['email'] ): ?>
            <li>
                <i class="far fa-envelope info-icon" aria-hidden="true"></i>
                <h3 class='address-label'><?php esc_html_e( 'E-mail', 'greenova-core' ); ?></h3>
                <p class='address-info'><?php echo esc_html( $data['email'] ); ?></p>
            </li>
		<?php endif; ?>
		<?php if ( $data['phone'] ): ?>
            <li>
                <i class="fas fa-phone-alt info-icon" aria-hidden="true"></i>
                <h3 class='address-label'><?php esc_html_e( 'Phone', 'greenova-core' ); ?></h3>
                <p class='address-info'><?php echo esc_html( $data['phone'] ); ?></p>
            </li>
		<?php endif; ?>
		<?php if ( $data['fax'] ): ?>
            <li>
                <i class="fa fa-fax info-icon" aria-hidden="true"></i>
                <h3 class='address-label'><?php esc_html_e( 'Fax', 'greenova-core' ); ?></h3>
                <p class='address-info'><?php echo esc_html( $data['fax'] ); ?></p>
            </li>
		<?php endif; ?>
		<?php if ( $data['social_links_visibility'] && ! empty( $greenova_socials ) ): ?>
            <li>
                <h3 class='address-label'><?php esc_html_e( 'Find Us On', 'greenova-core' ); ?></h3>
                <ul class="contact-social">
					<?php foreach ( $greenova_socials as $greenova_social ): ?>
                        <li><a target="_blank" href="<?php echo esc_url( $greenova_social['url'] ); ?>"><i class="fab <?php echo esc_attr( $greenova_social['icon'] ); ?>"></i></a>
                        </li>
					<?php endforeach; ?>
                </ul>
            </li>
		<?php endif; ?>
    </ul>
</div>

