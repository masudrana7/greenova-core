<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Greenova_Core;
// phpcs:disable WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
if ( ! defined( 'ABSPATH' ) ) exit;
$alignment = $data['alignment'];
if ( 'center' == $alignment ) {
	$alignment_style = 'text-align:center';
} elseif ( 'right' == $alignment ) {
	$alignment_style = ! is_rtl() ? 'text-align:right' : 'text-align:left';
} else {
	$alignment_style = ! is_rtl() ?  'text-align:left' : 'text-align:right';
}

$title_class = 'rt-vc-title-2';
if ( 'style2' == $data['layout'] ) {
	$title_class = 'rt-vc-title-1';
}
?>

<div class="section-heading style-1 <?php echo esc_attr( $alignment . ' ' . $title_class . ' ' . $data['layout'] ); ?> " style="<?php echo esc_attr( $alignment_style ) ?>">
	<?php if ( $data['top_title'] ) : ?>
        <p class="top-title"><?php echo esc_html( $data['top_title'] ) ?></p>
	<?php endif; ?>

	<?php if ( $data['title'] ): ?>
        <h2 class="rt-section-title-vc heading-title"><?php echo esc_html( $data['title'] ); ?></h2>
	<?php endif; ?>

	<?php if ( $data['subtitle'] ): ?>
        <div class="rt-section-sub-title-vc heading-subtitle"><?php echo wp_kses_post( $data['subtitle'] ); ?></div>
	<?php endif; ?>
</div>
