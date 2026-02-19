<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Greenova_Core;
// phpcs:disable WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
if ( ! defined( 'ABSPATH' ) ) exit;
$thumb_size = 'thumbnail';

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
	$args['post__not_in'] = $excluded_ids;
endif;


if ( $data['offset'] ) {
	$args['offset'] = $data['offset'];
}

if ( ! empty( $cat ) ) {
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
$slider_col       = "grid-col-" . $data['carousel_column_desktop'];
$owl_data         = json_encode( $data['owl_data'] );
?>
<div class="rt-owl-carousel-wrapper rt-testimonial-slider-2 owl-wrap rt-owl-nav-4 style1 <?php echo esc_attr( $slider_nav_class ); ?><?php echo esc_attr( $slider_dot_class ); ?>">
    <div class="owl-theme owl-carousel rt-owl-carousel <?php echo esc_html( $slider_col ) ?>" data-carousel-options="<?php echo esc_attr( $owl_data ); ?>">
		<?php if ( $query->have_posts() ) { ?>
			<?php while ( $query->have_posts() ) : $query->the_post(); ?>
				<?php
				$id                         = get_the_ID();
				$content                    = get_the_content();
				$content                    = apply_filters( 'the_content', $content );
				$content                    = wp_trim_words( $content, $data['content_limit'], '' );
				$rc_testimonial_designation = get_post_meta( $id, 'greenova_tes_designation', true );
				?>
                <div class="rtin-single-testimonial">
                    <div class="rtin-testi-img">
						<?php if ( 'visible' == $data['thumbnail_visibility'] ) : ?>
                            <div class="img-holder img-wrapper">
								<?php
								if ( has_post_thumbnail() ) {
									the_post_thumbnail( $thumb_size, [ 'class' => 'img-circle' ] );
								}
								?>
                            </div>
						<?php endif; ?>
                        <div class="rtin-testi-content content-wrapper"><?php echo esc_html( $content ); ?></div>
                        <h3><?php the_title(); ?></h3>
						<?php if ( ! empty ( $rc_testimonial_designation ) && 'visible' == $data['designation_visibility'] ) { ?>
                            <span class="item-designation"><?php echo esc_html( $rc_testimonial_designation ); ?></span>
						<?php } ?>
                    </div>
                </div>
			<?php endwhile; ?>
			<?php wp_reset_query(); ?>
		<?php } else { ?>
            <div class="rtin-single-testimonial">
				<?php esc_html_e( 'No Testimonial Found', 'greenova-core' ); ?>
            </div>
		<?php } ?>
    </div>
</div>