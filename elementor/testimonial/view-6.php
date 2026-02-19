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
$args       = [
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
?>
<div class="rt-owl-carousel-wrapper rt-testimonial-style-6 owl-wrap rt-owl-nav-4 <?php echo esc_attr( $slider_nav_class ); ?><?php echo esc_attr( $slider_dot_class ); ?>">
    <div class="owl-theme owl-carousel rt-owl-carousel" data-carousel-options="<?php echo esc_attr( $owl_data ); ?>">
		<?php if ( $query->have_posts() ) { ?>
			<?php while ( $query->have_posts() ) : $query->the_post(); ?>
				<?php
				$id                         = get_the_ID();
				$content                    = get_the_content();
				$content                    = apply_filters( 'the_content', $content );
				$content                    = wp_trim_words( $content, $data['content_limit'], '' );
				$rc_testimonial_designation = get_post_meta( $id, 'greenova_tes_designation', true );
				$user_rating = get_post_meta( $id, 'greenova_tes_rating', true );
				$total_rating = 5;
				?>
                <div class="rtin-single-testimonial">
                    <?php
                        if ( $user_rating >= 0 && $user_rating <= $total_rating ) { ?>
                            <div class="rt-rating">
                                <?php for ( $i = 1; $i <= $total_rating; $i ++ ) {
                                    if ( $i <= $user_rating ) {
                                        echo '<i class="fas fa-star"></i>';
                                    } else {
                                        echo '<i class="far fa-star"></i>';
                                    }
                                } ?>
                            </div>
                        <?php } ?>
                    <div class="rtin-testi-content content-wrapper">
						<?php echo esc_html( $content ); ?>
                    </div>
                    <div class="rtin-testi-img">
	                    <?php if ( 'visible' == $data['thumbnail_visibility'] ) : ?>
                            <div class="item-image img-wrapper">
			                    <?php if ( has_post_thumbnail() ) {
				                    the_post_thumbnail( $thumb_size, [ 'class' => 'img-circle' ] );
			                    } ?>
                            </div>
	                    <?php endif; ?>
                        <div class="rt-content">
                            <div class="rt-qoute-icon">
                                <svg width="67" height="54" viewBox="0 0 67 54" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M61.3606 46.3846C56.699 51.4383 49.6451 54 40.3983 54L37.0757 54L37.0757 44.6336L39.7471 44.0986C44.299 43.1883 47.4655 41.3974 49.16 38.7692C50.0444 37.3535 50.5459 35.7322 50.6153 34.0644L40.3983 34.0644C39.5171 34.0644 38.672 33.7143 38.0489 33.0912C37.4258 32.4681 37.0757 31.623 37.0757 30.7418L37.0757 7.48358C37.0757 3.81875 40.0561 0.83838 43.7209 0.838381L63.6565 0.838382C64.5377 0.838383 65.3828 1.18844 66.0059 1.81155C66.6291 2.43465 66.9791 3.27977 66.9791 4.16098L66.9791 20.774L66.9691 30.4727C66.999 30.8415 67.6303 39.5799 61.3606 46.3846ZM7.17229 0.838377L27.1079 0.838379C27.9891 0.838379 28.8342 1.18844 29.4573 1.81154C30.0804 2.43465 30.4305 3.27977 30.4305 4.16098L30.4305 20.774L30.4205 30.4727C30.4504 30.8415 31.0817 39.5799 24.812 46.3846C20.1504 51.4383 13.0965 54 3.84969 54L0.527084 54L0.527085 44.6336L3.19846 44.0986C7.75042 43.1883 10.9169 41.3974 12.6114 38.7692C13.4958 37.3535 13.9973 35.7322 14.0667 34.0644L3.84969 34.0644C2.96848 34.0644 2.12336 33.7143 1.50025 33.0912C0.877146 32.4681 0.527086 31.623 0.527086 30.7418L0.527088 7.48358C0.527089 3.81875 3.50746 0.838377 7.17229 0.838377Z" fill="#F1F1F1"/>
                                </svg>
                            </div>
                            <h3 class="item-title"><?php the_title(); ?></h3>
	                        <?php if ( ! empty ( $rc_testimonial_designation ) && 'visible' == $data['designation_visibility'] ) { ?>
                                <span class="item-designation"><?php echo esc_html( $rc_testimonial_designation ); ?></span>
	                        <?php } ?>
                        </div>
                    </div>
                </div>
			<?php endwhile; ?>
			// phpcs:ignore WordPress.WP.DiscouragedFunctions.wp_reset_query_wp_reset_query
			<?php wp_reset_query(); ?>
		<?php } else { ?>
            <div class="rtin-single-testimonial">
				<?php esc_html_e( 'No Testimonial Found', 'greenova-core' ); ?>
            </div>
		<?php } ?>
    </div>
</div>