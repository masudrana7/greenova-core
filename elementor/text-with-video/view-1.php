<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Greenova_Core;
if ( ! defined( 'ABSPATH' ) ) exit;

$alignment = $align_class = '';
if ( $box_align = $data['text_align'] ) {
	$alignment   = "text-align:{$box_align}";
	$align_class = "align-{$box_align}";
}

global $wp_embed;
$left_col  = "col-md-7 col-sm-7";
$right_col = "col-md-5 col-sm-5";
if ( 'col6' == $data['column'] ) {
	$left_col  = "col-md-6 col-sm-6";
	$right_col = "col-md-6 col-sm-6";
} elseif ( 'col8' == $data['column'] ) {
	$left_col  = "col-md-8 col-sm-8";
	$right_col = "col-md-4 col-sm-4";
}
$order_class = '';
if ( 'left' == $data['video_position'] ) {
	$order_class = "order-2";
}
?>

<div class="rt-text-with-video rt-text-with-video-wrapper">
    <div class="row <?php echo esc_attr( $data['vertical_align'] ); ?>">
        <div class="<?php echo esc_attr( $left_col . ' ' . $order_class . ' ' . $align_class ); ?>" style="<?php echo esc_attr( $alignment ); ?>">
            <div class="rtin-text-content">

				<?php if ( $data['small_title'] ) { ?>
                    <span class="small-title"><?php echo esc_html( $data['small_title'] ); ?></span>
				<?php } ?>

				<?php if ( $data['main_title'] ) { ?>
                    <h2 class="main-title"><?php echo esc_html( $data['main_title'] ); ?></h2>
				<?php } ?>

				<?php if ( $data['description'] ) : ?>
                    <div class="description">
						<?php echo wp_kses_post( $data['description'] ); ?>
                    </div>
				<?php endif; ?>

            </div>

			<?php if ( $data['btn_text'] ) {
				$target    = $data['btn_link']['is_external'] ? ' target="_blank"' : '';
				$nofollow  = $data['btn_link']['nofollow'] ? ' rel="nofollow"' : '';
				$show_cion = '';
				if ( $data['btn_style'] == 'rt-custom-button' ) {
					$show_cion = $data['show_icon'];
				}
				?>
                <div class="entry-content">
                    <a class="<?php echo esc_attr( $data['btn_style'] . ' ' . $show_cion ); ?>" href="<?php echo esc_attr( $data['btn_link']['url'] ); ?>" <?php echo esc_attr( $target
					                                                                                                                                                   . $nofollow ); ?>>
                        <span><?php echo esc_html( $data['btn_text'] ); ?></span>
                    </a>
                </div>
			<?php } ?>
        </div>

		<?php if ( $data['video_link'] ) : ?>
            <div class="<?php echo esc_attr( $right_col ); ?> video-wrapper">
                <div class="rtin-video-content">
					<?php echo wp_kses_post( $wp_embed->run_shortcode( '[embed]' . $data['video_link'] . '[/embed]' ) ); ?>
                </div>
            </div>
		<?php endif; ?>
    </div>
</div>












