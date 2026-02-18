<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Greenova_Core;
$target   = $data['button_url']['is_external'] ? ' target="_blank"' : '';
$nofollow = $data['button_url']['nofollow'] ? ' rel="nofollow"' : '';

$left_col  = "col-md-8 col-sm-7";
$right_col = "col-md-4 col-sm-5";
if ( 'col6' == $data['column'] ) {
	$left_col  = "col-md-6 col-sm-6";
	$right_col = "col-md-6 col-sm-6";
} elseif ( 'col7' == $data['column'] ) {
	$left_col  = "col-md-7 col-sm-7";
	$right_col = "col-md-5 col-sm-5";
}
$order_class = '';
if ( 'left' == $data['image_position'] ) {
	$order_class = "order-2";
}
?>

<div class="rt-about-one rt-about-block-wrapper">
    <div class="row <?php echo esc_attr( $data['vertical_align'] ); ?>">

        <div class="<?php echo esc_attr( $left_col . ' ' . $order_class ); ?>">
            <div class="rtin-about-content about-content-wrapper">
				<?php printf( '<h1>%s <span class="greenova-primary-color">%s</span></h1>',
					esc_html( $data['title1'] ),
					esc_html( $data['title2'] )
				);
				?>
                <div class="rtin-about-text about-content-inner">
					<?php echo wp_kses_post( $data['content'] ); ?>
                </div>
				<?php if ( $data['button_text'] && 'visible' == $data['readmore_visibility'] ) { ?>
                    <div class="read-more-button ">
                        <a class="ghost-color-btn about-read-more-btn" href="<?php echo esc_url( $data['button_url']['url'] ); ?>" <?php echo wp_kses_post($target) . wp_kses_post($nofollow); ?> ><?php echo esc_html( $data['button_text'] ); ?></a>
                    </div>
				<?php } ?>
            </div>
        </div>

        <div class="<?php echo esc_attr( $right_col ); ?> image-wrapper">
            <div class="rtin-about-image">
                <a href="<?php echo esc_url( $data['button_url']['url'] ); ?>" <?php echo $target . $nofollow; ?>>
					<?php echo \Elementor\Group_Control_Image_Size::get_attachment_image_html( $data, 'thumbnail', 'image' ); ?>
                </a>
            </div>
        </div>

    </div>
</div>

