<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Greenova_Core;
// phpcs:disable WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound, WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound
if ( ! defined( 'ABSPATH' ) ) exit;

$thumb_size = 'greenova-size3';
$args = [
	'post_type'      => 'green_testimonial',
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
					'taxonomy' => 'greenova_testimonial_category',
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

$owl_data = json_encode( $data['owl_data'] );
$count    = 1;
?>
<div class="rt-owl-carousel-wrapper rt-testimonial-slider-9 owl-wrap rt-owl-nav-4 <?php echo esc_attr( $slider_nav_class ); ?><?php echo esc_attr( $slider_dot_class ); ?>">
    <div class="owl-theme owl-carousel rt-owl-carousel" data-carousel-options="<?php echo esc_attr( $owl_data ); ?>">

        <div class="main-slider-holder">
			<?php if ( $query->have_posts() ) { ?>
			<?php while ( $query->have_posts() ) :
			$query->the_post(); ?>
			<?php
			$id                         = get_the_ID();
			$content                    = get_the_content();
			$content                    = apply_filters( 'the_content', $content );
			$content                    = wp_trim_words( $content, $data['content_limit'], '' );
			$rc_testimonial_designation = get_post_meta( $id, 'greenova_tes_designation', true );
			?>
            <div class="client-box">
                <div class="media">
					<?php if ( 'visible' == $data['thumbnail_visibility'] ) : ?>
                        <div class="pull-left item-image img-wrapper">
							<?php if ( has_post_thumbnail() ) {
								the_post_thumbnail( $thumb_size, [ 'class' => 'img-circle' ] );
							} ?>
                        </div>
					<?php endif; ?>

                    <div class="media-body content-wrapper">
                        <p><?php echo esc_html( $content ); ?></p>
                        <h3 class="item-title"><?php the_title(); ?></h3>
						<?php if ( ! empty ( $rc_testimonial_designation ) ) { ?>
                            <span class="rt-designation item-designation"><?php echo esc_html( $rc_testimonial_designation ); ?></span>
						<?php } ?>
                    </div>
                </div>
            </div>
			<?php
			if ( ( $count % 2 ) == 0 ){ ?>
        </div>
		<?php if ( $query->current_post + 1 < $query->post_count ) { ?>
        <div class="main-slider-holder">
			<?php }
			}
			$count ++;
			?>
			<?php endwhile; ?>
			<?php wp_reset_postdata(); ?>
			<?php } else { ?>
                <div class="rtin-single-testimonial">
					<?php esc_html_e( 'No Testimonial Found', 'greenova-core' ); ?>
                </div>
			<?php } ?>
        </div>
    </div>

<?php
