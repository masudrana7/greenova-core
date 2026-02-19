<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Greenova_Core;
// phpcs:disable WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
if ( ! defined( 'ABSPATH' ) ) exit;

$show_cion = '';
if ( $data['btn_style'] == 'rt-custom-button' ) {
	$show_cion = $data['show_icon'];
}
?>

<div class="rt-text-with-btn rt-text-with-btn-wrapper">
    <div class="data-area">

		<?php if ( $data['title'] ) { ?>
        <<?php echo esc_html( $data['title_tag'] ); ?> class='title'>
		<?php echo wp_kses_post( $data['title'] ); ?>
    </<?php echo esc_html( $data['title_tag'] ); ?>>
	<?php } ?>

	<?php if ( $data['description'] ) { ?>
        <div class='description'>
			<?php echo wp_kses_post( $data['description'] ); ?>
        </div>
	<?php } ?>

	<?php if ( $data['btn_text'] ) {
		$target   = $data['btn_link']['is_external'] ? ' target="_blank"' : '';
		$nofollow = $data['btn_link']['nofollow'] ? ' rel="nofollow"' : '';
		?>
        <div class="entry-content">
            <a class="<?php echo esc_attr( $data['btn_style'] . ' ' . $show_cion ); ?>"
               href="<?php echo esc_attr( $data['btn_link']['url'] ); ?>" <?php echo esc_attr( $target . $nofollow ); ?>>
                <span><?php echo esc_html( $data['btn_text'] ); ?></span>
            </a>
        </div>
	<?php } ?>

</div>
</div>
