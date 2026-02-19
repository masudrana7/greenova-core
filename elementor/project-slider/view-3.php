<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Greenova_Core;
// phpcs:disable WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound, WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound
if ( ! defined( 'ABSPATH' ) ) exit;
$thumb_size = $data['thumbnail_size'] ? $data['thumbnail_size'] : 'greenova-size16';
$args       = [
	'post_type'      => 'greenova_project',
	'posts_per_page' => $data['post_limit'],
	'post_status'    => 'publish',
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
			// phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_tax_query
			'tax_query' => [
				[
					'taxonomy' => 'greenova_project_category',
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

if ( ! empty( $cat ) ) {
	// phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_tax_query
	$args['tax_query'] = [
		[
			'taxonomy' => 'greenova_testimonial_category',
			'field'    => 'term_id',
			'terms'    => $cat,
		],
	];
}

$query            = new \WP_Query( $args );
$slider_nav_class = $data['carousel_nav'] ? ' slider-nav-enabled' : '';
$slider_dot_class = $data['carousel_dots'] ? ' slider-dot-enabled' : '';

$owl_data      = json_encode( $data['owl_data'] );
$content_limit = $data['content_limit'];
$showlink      = $data['show_link'];
?>
<div class="rt-owl-carousel-wrapper rt-project-slider-three owl-wrap rt-owl-nav-1 <?php echo esc_attr( $slider_dot_class ); ?><?php echo esc_attr( $slider_nav_class ); ?>">
    <div class="owl-theme owl-carousel rt-owl-carousel" data-carousel-options="<?php echo esc_attr( $owl_data ); ?>">
		<?php if ( $query->have_posts() ) { ?>
			<?php while ( $query->have_posts() ) : $query->the_post(); ?>
				<?php
				$id      = get_the_ID();
				$content = get_the_content();
				$content = apply_filters( 'the_content', $content );
				$content = wp_trim_words( $content, $content_limit, '' );

				$thumbnail = false;
				if ( has_post_thumbnail() ) {
					$thumbnail = get_the_post_thumbnail( null, $thumb_size );
				} else {
					if ( ! empty( \GREENOVA_Theme::$options['no_preview_image']['id'] ) ) {
						$thumbnail = wp_get_attachment_image( \GREENOVA_Theme::$options['no_preview_image']['id'], $thumb_size );
					} elseif ( ! empty( \GREENOVA_Theme::$options['no_preview_image']['url'] ) ) {
						$thumbnail = '<img class="attachment-greenova-size5 size-greenova-size5 wp-post-image" src="' . GREENOVA_IMG_URL . 'noimage_370x522.jpg" alt="'
						             . get_the_title() . '">';
					}
				}
				?>
                <div class="our-projects-box3 project-box-inner">
                    <div class="project-img-holder thumb-box">
						<?php if ( $showlink ) { ?>
                            <a href="<?php the_permalink(); ?>"><?php echo wp_kses_post( $thumbnail ); ?></a>
						<?php } else { ?>
							<?php echo wp_kses_post( $thumbnail ); ?>
						<?php } ?>
                    </div>
                    <div class="project-content-holder content-wrapper">
						<?php if ( $showlink ) { ?>
                            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						<?php } else { ?>
                            <h3><?php the_title(); ?></h3>
						<?php } ?>
                    </div>
                </div>
			<?php endwhile; ?>
			// phpcs:ignore WordPress.WP.DiscouragedFunctions.wp_reset_query_wp_reset_query
			<?php wp_reset_query(); ?>
		<?php } else { ?>
            <div class="rtin-single-team">
				<?php esc_html_e( 'No Project Found', 'greenova-core' ); ?>
            </div>
		<?php } ?>
    </div>
</div>