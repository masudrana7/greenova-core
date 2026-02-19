<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Greenova_Core;
// phpcs:disable WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound, WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound
if ( ! defined( 'ABSPATH' ) ) exit;
$thumb_size = ( $data['thumbnail_size'] ? $data['thumbnail_size'] : 'greenova-size5' );
$args       = [
	'post_type'      => 'greenova_team',
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
<div class="rt-owl-carousel-wrapper rt-team-slider-twelve owl-wrap rt-owl-nav-2 owl-wrap<?php echo esc_attr( $slider_dot_class ); ?><?php echo esc_attr( $slider_nav_class ); ?>">
    <div class="owl-theme owl-carousel rt-owl-carousel" data-carousel-options="<?php echo esc_attr( $owl_data ); ?>">
		<?php if ( $query->have_posts() ) { ?>
			<?php while ( $query->have_posts() ) : $query->the_post(); ?>
				<?php
				$id               = get_the_ID();
				$content          = get_the_content();
				$content          = apply_filters( 'the_content', $content );
				$content          = wp_trim_words( $content, $data['content_limit'] );
				$team_designation = get_post_meta( $id, 'greenova_team_designation', true );
				$team_socials     = get_post_meta( $id, 'greenova_team_socials', true );
				$thumbnail        = false;
				if ( has_post_thumbnail() ) {
					$thumbnail = get_the_post_thumbnail( null, $thumb_size, [ 'class' => 'img-responsive' ] );
				} else {
					if ( ! empty( \GREENOVA_Theme::$options['no_preview_image']['id'] ) ) {
						$thumbnail = wp_get_attachment_image( \GREENOVA_Theme::$options['no_preview_image']['id'], $thumb_size );
					} elseif ( ! empty( \GREENOVA_Theme::$options['no_preview_image']['url'] ) ) {
						$thumbnail = '<img class="attachment-greenova-size5 size-greenova-size5 wp-post-image" src="' . GREENOVA_IMG_URL . 'noimage_370X370.jpg" alt="'
						             . get_the_title() . '">';
					}
				}
				?>
                <div class="rtin-single-team">
                    <div class="rtin-team-picture team-img-wrapper">
                        <a href="<?php the_permalink(); ?>"><?php echo wp_kses_post( $thumbnail ); ?></a>
                    </div>
                    <div class="rtin-team-content team-content-wrapper">
                        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						<?php if ( 'visible' == $data['designation_visibility'] ) { ?>
                            <p class="designation"><?php echo esc_html( $team_designation ); ?></p>
						<?php } ?>

						<?php if ( 'visible' == $data['content_visibility'] ) : ?>
                            <div class="rtin-sort-bio team-content"><?php echo wp_kses_post( $content ); ?></div>
						<?php endif; ?>
                    </div>

					<?php if ( 'visible' == $data['social_icon_visibility'] ) : ?>
                        <div class="rtin-team-social team-social-icon-wrapper">
                            <ul>
								<?php foreach ( $team_socials as $team_social_key => $team_social_value ) { ?>
									<?php if ( ! empty( $team_social_value ) ) { ?>
                                        <li><a target="_blank" href="<?php echo esc_attr( $team_social_value ); ?>"><i
                                                        class="fab <?php echo esc_attr( \GREENOVA_Theme::$team_social_fields[ $team_social_key ]['icon'] ); ?>"></i></a></li>
									<?php } ?>
								<?php } ?>
                            </ul>
                        </div>
					<?php endif; ?>
                </div>
			<?php endwhile; ?>
			<?php wp_reset_postdata(); ?>
		<?php } else { ?>
            <div class="rtin-single-team">
				<?php esc_html_e( 'No Team Found', 'greenova-core' ); ?>
            </div>
		<?php } ?>
    </div>
</div>