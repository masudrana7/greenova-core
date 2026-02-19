<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Greenova_Core;
// phpcs:disable WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound, WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound
if ( ! defined( 'ABSPATH' ) ) exit;
$thumb_size = ( $data['service_thumbnail_size'] ? $data['service_thumbnail_size'] : 'greenova-size2' );

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
	// phpcs:ignore WordPressVIPMinimum.Performance.WPQueryParams.PostNotIn_post__not_in
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
$shadow              = 'shadow';
?>
<div class="row auto-clear rt-service-grid-4 rt-service-wrapper <?php echo esc_attr( $shadow . ' ' . $data['box_text_align'] ); ?>">
	<?php if ( $query->have_posts() ) { ?>
		<?php while ( $query->have_posts() ) : $query->the_post(); ?>
			<?php
			$id        = get_the_ID();
			$content   = get_the_content();
			$content   = apply_filters( 'the_content', $content );
			$content   = wp_trim_words( $content, $count, ' ' );
			$thumbnail = false;
			if ( has_post_thumbnail() ) {
				$thumbnail = get_the_post_thumbnail( null, $thumb_size );
			} else {
				if ( ! empty( \GREENOVA_Theme::$options['no_preview_image']['url'] ) ) {
					$thumbnail = '<img class="attachment-greenova-size5 size-greenova-size5 wp-post-image" src="' . GREENOVA_IMG_URL . 'noimage_460X270.jpg" alt="'
					             . get_the_title() . '">';
				}
			}

			$comments_count = wp_count_comments( $id );
			$message        = $comments_count->approved;
			?>
            <div class="service-box <?php echo esc_attr( $col_class ); ?>">
                <div class="rtin-single-post box-radius">
                    <div class="rtin-item-image">
                        <a href="<?php the_permalink(); ?>">
							<?php echo wp_kses_post( $thumbnail ); ?>
                        </a>
						<?php if ( $showlink && $data['readmore_visibility'] == 'visible' ) :
							$btn_text = $data['readmore_text'] ? $data['readmore_text'] : 'Details';
							?>
                            <a class="plus-icon service-link-btn" href="<?php the_permalink(); ?>"><?php echo esc_html( $btn_text ); ?></a>
						<?php endif; ?>
                    </div>
                    <div class="rtin-item-info">
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

						<?php if ( $showlink && $data['readmore_visibility'] == 'visible' ) {
							$btn_text = $data['readmore_text'] ? $data['readmore_text'] : 'Read More';
							?>
                            <a class="btn-square-transparent service-link-btn" href="<?php the_permalink(); ?>"><?php echo esc_html( $btn_text ); ?><i class="fa fa-chevron-right"
                                                                                                                                                       aria-hidden="true"></i></a>
						<?php } ?>
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
        <div class="rtin-single-news">
			<?php esc_html_e( 'No Post Found', 'greenova-core' ); ?>
        </div>
	<?php } ?>
	<?php wp_reset_postdata(); ?>
</div>