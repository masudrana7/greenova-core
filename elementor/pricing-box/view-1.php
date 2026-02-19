<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Greenova_Core;
if ( ! defined( 'ABSPATH' ) ) exit;

$unit       = $data['unit_name'];
$price_html = $data['price'];
$price_html .= ! empty( $unit ) ? "<span> /{$unit}</span>" : '';
?>

<div class="rt-price-table-box rt-pricing-box-wrapper <?php echo esc_attr( $data['active_pricing'] ); ?>">
    <div class="price-header">
        <span><?php echo esc_html( $data['title'] ); ?></span>
        <h3><?php echo wp_kses_post( $price_html ); ?></h3>
    </div>
    <div class="feature-box">
		<?php echo esc_html( $data['feature'] ); ?>
    </div>

	<?php if ( $data['button_text'] ) {
		$target   = $data['button_url']['is_external'] ? ' target="_blank"' : '';
		$nofollow = $data['button_url']['nofollow'] ? ' rel="nofollow"' : '';
		?>
        <div class="rtin-price-button">
            <a class="btn-price-button" href="<?php echo esc_url( $data['button_url']['url'] ); ?>" <?php echo esc_attr( $target . $nofollow ); ?>>
				<?php echo esc_html( $data['button_text'] ); ?>
            </a>
        </div>
	<?php } ?>
</div>