<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Greenova_Core;
// phpcs:disable WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound, WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound
if ( ! defined( 'ABSPATH' ) ) exit;
$target   = $data['link']['is_external'] ? ' target="_blank"' : '';
$nofollow = $data['link']['nofollow'] ? ' rel="nofollow"' : '';
?>
<div class="rt-info-text-4 rt-info-box icon-el-style-2">
    <div class="service-box">
        <div class="icon-holder">
			<?php
			echo $data['link']['url'] ? '<a href="' . esc_url( $data['link']['url'] ) . '"' . esc_attr( $target . $nofollow ) . '>' : null;
			if ( 'image' == $data['icon_type'] ) {
				echo wp_get_attachment_image( $data['image_icon']['id'], 'full' );
			} else {
				echo "<span>";
				\Elementor\Icons_Manager::render_icon( $data['info_icon'], [ 'aria-hidden' => 'true' ] );
				echo "</span>";
			}
			echo $data['link']['url'] ? '</a>' : null;
			?>
        </div>
        <div class="content-holder content-align">
			<?php if ( $data['title'] ) : ?>
                <h3 class="info-title">
					<?php
					echo $data['link']['url'] ? '<a href="' . esc_url( $data['link']['url'] ) . '"' . esc_attr( $target . $nofollow ) . '>' : null;
					echo wp_kses_post( $data['title'] );
					echo $data['link']['url'] ? '</a>' : null;
					?>
                </h3>
			<?php endif; ?>

            <p><?php echo wp_kses_post( $data['sub_title'] ); ?></p>

			<?php if ( $data['show_readmore_btn'] ) : ?>
                <div class="read-more-btn">
                    <a class="btn-quote2 button-el" href="<?php echo esc_url( $data['link']['url'] ) ?>" <?php echo esc_attr( $target . ' ' . $nofollow ) ?>>
						<?php echo esc_html( $data['read_more_btn_text'] ); ?>
                    </a>
                </div>
			<?php endif; ?>
        </div>

    </div>
</div>
