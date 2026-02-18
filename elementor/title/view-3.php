<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Greenova_Core;
?>
<div class="rt-vc-title-3 section-heading">
	<?php if ( $data['titlethree'] ) : ?>
        <h2 class="section-title-3 heading-title"><?php echo wp_kses_post( $data['titlethree'] ); ?></h2>
	<?php endif; ?>

	<?php if ( $data['titlethree2'] ) : ?>
        <h3 class="section-title-3 title2"><?php echo esc_html( $data['titlethree2'] ); ?></h3>
	<?php endif; ?>

	<?php if ( $data['titlethree_icon'] ) : ?>
        <div class="title-bottom-icon">
			<?php \Elementor\Icons_Manager::render_icon( $data['titlethree_icon'], [ 'aria-hidden' => 'true' ] ); ?>
        </div>
	<?php endif; ?>

	<?php if ( $data['subtitle'] ): ?>
        <div class="rt-section-sub-title-vc heading-subtitle"><?php echo wp_kses_post( $data['subtitle'] ); ?></div>
	<?php endif; ?>
</div>

