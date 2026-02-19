<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Greenova_Core;
// phpcs:disable WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
if ( ! defined( 'ABSPATH' ) ) exit;
$unit       = $data['unit_name'];
$price_html = $data['price'];
$price_html .= ! empty( $unit ) ? " <br><div class='price-unit'>/ $unit</div>" : '';
?>
<div class="entry-content">
    <div class="rt-price-table-box1 rt-pricing-box-wrapper <?php echo esc_attr( $data['active_pricing'] ); ?>">
        <span><?php echo esc_html( $data['title'] ); ?></span>
        <div class="price-holder"><?php echo wp_kses_post( $price_html ); ?></div>
        <div class="price-table-service">
            <div class="price-feature feature-box">
				<?php echo esc_html( $data['feature'] ); ?>
            </div>
        </div>

		<?php if ( $data['button_text'] ) {
			$target   = $data['button_url']['is_external'] ? ' target="_blank"' : '';
			$nofollow = $data['button_url']['nofollow'] ? ' rel="nofollow"' : '';
			?>
            <a class="pricetable-btn" href="<?php echo esc_url( $data['button_url']['url'] ); ?>" <?php echo esc_attr( $target . $nofollow ); ?>>
				<?php echo esc_html( $data['button_text'] ); ?>
            </a>
		<?php } ?>
    </div>
</div>
