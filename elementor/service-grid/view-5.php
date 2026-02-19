<?php

/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Greenova_Core;
// phpcs:disable WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
if ( ! defined( 'ABSPATH' ) ) exit;

$thumb_size = ( $data['service_thumbnail_size'] ? $data['service_thumbnail_size'] : 'greenova-size14' );

if ( get_query_var( 'paged' ) ) {
	$paged = get_query_var( 'paged' );
} elseif ( get_query_var( 'page' ) ) {
	$paged = get_query_var( 'page' );
} else {
	$paged = 1;
}

$args = [
	'post_type'      => 'greenova_service',
	'posts_per_page' => $data['post_limit'],
	'post_status'    => 'publish',
	'paged'          => $paged,
];

if ( $data['orderby'] ) {
	$args['orderby'] = $data['orderby'];
}
if ( $data['order'] ) {
	$args['order'] = $data['order'];
}

if ( $data['post_source'] == 'by_category' && $data['taxonomies'] ) :
	$args = wp_parse_args(
		[
			'tax_query' => [
				[
					'taxonomy' => 'greenova_service_category',
					'field'    => 'slug',
					'terms'    => $data['taxonomies'],
					'operator' => 'IN',
				],
			],
		]
		, $args );
endif;

if ( $data['post_source'] == 'by_id' && $data['post_id'] ) :
	$post_ids         = explode( ',', $data['post_id'] );
	$args['post__in'] = $post_ids;
endif;

if ( $data['exclude'] ) :
	$excluded_ids         = explode( ',', $data['exclude'] );
	$args['post__not_in'] = $excluded_ids;
endif;

if ( $data['offset'] ) {
	$args['offset'] = $data['offset'];
}

$query = new \WP_Query( $args );
// Pagination fix
global $wp_query;
$wp_query = null;
$wp_query = $query;

$count    = $data['content_limit'];
$showlink = $data['show_link'];

//Column Size
$gird_column_desktop = ( $data['gird_column_desktop'] ? $data['gird_column_desktop'] : '4' );
$gird_column_tab     = ( $data['gird_column_tab'] ? $data['gird_column_tab'] : '6' );
$gird_column_mobile  = ( $data['gird_column_mobile'] ? $data['gird_column_mobile'] : '12' );
$col_class           = "col-md-{$gird_column_desktop} col-sm-{$gird_column_tab} col-xs-{$gird_column_mobile}";
?>
<div class="rt-service-wrapper <?php echo esc_attr( $data['box_text_align'] ) ?>">
    <div class="row auto-clear rt-service-grid-5">
		<?php if ( have_posts() ) { ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php
				$id      = get_the_id();
				$content = get_the_content();
				//$content = apply_filters( 'the_content', $content );
				$content   = wp_trim_words( $content, $count, '' );
				$thumbnail = false;
				if ( has_post_thumbnail() ) {
					$thumbnail = get_the_post_thumbnail( null, $thumb_size, [ 'class' => 'img-responsive' ] );
				} else {
					if ( ! empty( \GREENOVA_Theme::$options['no_preview_image']['id'] ) ) {
						$thumbnail = wp_get_attachment_image( \GREENOVA_Theme::$options['no_preview_image']['id'], $thumb_size );
					} elseif ( ! empty( \GREENOVA_Theme::$options['no_preview_image']['url'] ) ) {
						$thumbnail = '<img class="attachment-greenova-size5 size-greenova-size5 wp-post-image" src="' . GREENOVA_IMG_URL . 'noimage_410X265.jpg" alt="'
						             . get_the_title() . '">';
					}
				}
				?>
                <div class="service-box <?php echo esc_attr( $col_class ); ?>">
                    <div class="service-img-holder box-radius">
						<?php if ( $showlink ) { ?>
                            <a href="<?php the_permalink(); ?>"><?php echo wp_kses_post( $thumbnail ); ?></a>
						<?php } else { ?>
							<?php echo wp_kses_post( $thumbnail ); ?>
						<?php } ?>
                        <div class="service-content-holder">
							<?php if ( $showlink ) { ?>
                                <h3 class="title-1"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							<?php } else { ?>
                                <h3 class="title-1"><?php the_title(); ?></h3>
							<?php } ?>
							<?php if ( 'visible' == $data['excerpt_visibility'] ) : ?>
                                <p class="service-excerpt">
									<?php echo esc_html( wp_strip_all_tags( strip_shortcodes( $content ) ) ); ?>
                                </p>
							<?php endif; ?>
							<?php if ( $showlink ) : ?>
                                <a class="service-more" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read More', 'greenova-core' ); ?><i class="fa fa-angle-right"
                                                                                                                                                aria-hidden="true"></i></a>
							<?php endif; ?>
                        </div>
                    </div>
                </div>
			<?php endwhile; ?>
			<?php if ( $data['show_pagination'] ) { ?>
                <div class="mt20 col-sm-12 col-xs-12 pagination-wrapper"><?php \GREENOVA_Theme_Helper::pagination(); ?></div>
			<?php } ?>
			<?php if ( $data['show_view_all_btn'] ) {
				// Button Link
				$target   = $data['view_all_btn_url']['is_external'] ? ' target="_blank"' : '';
				$nofollow = $data['view_all_btn_url']['nofollow'] ? ' rel="nofollow"' : '';
				?>
                <div class="rt-grid-fill-btn">
                    <a href="<?php echo esc_url( $data['view_all_btn_url']['url'] ); ?>" class="btn-square-transparent" <?php echo esc_attr( $target
					                                                                                                                . $nofollow ) ?>><?php echo esc_html( $data['view_all_btn_text'] ); ?></a>
                </div>
			<?php } ?>
		<?php } else { ?>
            <div class="rtin-single-team">
				<?php esc_html_e( 'No Service Found', 'greenova-core' ); ?>
            </div>
		<?php } ?>
    </div>
	<?php wp_reset_query(); ?>
</div>