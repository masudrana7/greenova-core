<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Greenova_Core;
// phpcs:disable WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
if ( ! defined( 'ABSPATH' ) ) exit;
$target   = $data['link']['is_external'] ? ' target="_blank"' : '';
$nofollow = $data['link']['nofollow'] ? ' rel="nofollow"' : '';

?>
<!-- esc_attr( $data['icon_position'] . ' ' .  -->
<?php //echo esc_attr( $data['show_border'] ); ?>
<div class="service3-box-right rt-info-text-4 rt-info-box icon-el-style-1">
    <div class="service3-icon-holder icon-holder">
		<?php
		echo $data['link']['url'] ? '<a href="' . esc_url( $data['link']['url'] ) . '"' . esc_attr( $target . $nofollow ) . '>' : null;
		if ( 'image' == $data['icon_type'] ) {
			echo wp_get_attachment_image( $data['image_icon']['id'], 'full' );
		} else {
			\Elementor\Icons_Manager::render_icon( $data['info_icon'], [ 'aria-hidden' => 'true' ] );
		}
		echo $data['link']['url'] ? '</a>' : null;
		?>
    </div>

    <div class="service3-content-holder content-holder content-align">
		<?php if ( $data['title'] ) : ?>
            <h3 class="info-title">
				<?php
				echo $data['link']['url'] ? '<a href="' . esc_url( $data['link']['url'] ) . '"' . esc_attr( $target . $nofollow ) . '>' : null;
				echo wp_kses_post( $data['title'] );
				echo $data['link']['url'] ? '</a>' : null;
				?>
            </h3>
		<?php endif; ?>

		<?php if ( $data['sub_title'] ) : ?>
            <p><?php echo wp_kses_post( $data['sub_title'] ); ?></p>
		<?php endif; ?>

		<?php if ( $data['show_readmore_btn'] ) : ?>
            <div class="read-more-btn">
                <a class="btn-square-transparent button-el" href="<?php echo esc_url( $data['link']['url'] ) ?>" <?php echo esc_attr( $target . ' ' . $nofollow ) ?>>
					<?php echo esc_html( $data['read_more_btn_text'] ); ?>
                </a>
            </div>
		<?php endif; ?>
    </div>
</div>