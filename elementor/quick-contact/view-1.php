<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Greenova_Core;
// phpcs:disable WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound, WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound
if ( ! defined( 'ABSPATH' ) ) exit;
?>

<div class="rt-contact-info <?php echo esc_attr( $data['text_align'] ) ?>">
	<?php if ( $data['title'] ) { ?>
        <h2><?php echo esc_html( $data['title'] ); ?></h2>
	<?php } ?>

	<?php if ( $data['description'] ) { ?>
        <div class="contact-desc">
			<?php echo wp_kses_post( $data['description'] ); ?>
        </div>
	<?php } ?>

    <ul>
		<?php
		if ( $data['address'] ) {
			?>
            <li><i class="fas fa-map-marker-alt" aria-hidden="true"></i> <?php echo esc_html( $data['address'] ); ?></li><?php
		}
		if ( $data['phone'] ) {
			?>
            <li><i class="fas fa-phone-alt" aria-hidden="true"></i> <a href="tel:<?php echo esc_attr( $data['phone'] ); ?>"><?php echo esc_html( $data['phone'] ); ?></a></li><?php
		}
		if ( $data['email'] ) {
			?>
            <li><i class="far fa-envelope" aria-hidden="true"></i> <a href="mailto:<?php echo esc_attr( $data['email'] ); ?>"><?php echo esc_html( $data['email'] ); ?></a>
            </li><?php
		}
		if ( $data['email'] ) {
			?>
            <li><i class="fa fa-fax" aria-hidden="true"></i> <?php echo esc_html( $data['fax'] ); ?></li><?php
		}
		?>
    </ul>
</div>
