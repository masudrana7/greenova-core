<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Greenova_Core;
// phpcs:disable WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound, WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound
if ( ! defined( 'ABSPATH' ) ) exit;
$thumb_size = ( $data['thumbnail_size'] ? $data['thumbnail_size'] : 'greenova-size4' );
if ( get_query_var( 'paged' ) ) {
	$paged = get_query_var( 'paged' );
} elseif ( get_query_var( 'page' ) ) {
	$paged = get_query_var( 'page' );
} else {
	$paged = 1;
}
$args = [
	'post_type'      => 'greenova_team',
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
$query = new \WP_Query( $args );
// Pagination fix
global $wp_query;
$wp_query = null;
$wp_query = $query;

// Grid Column
$gird_column_desktop = ( $data['gird_column_desktop'] ? $data['gird_column_desktop'] : '4' );
$gird_column_tab     = ( $data['gird_column_tab'] ? $data['gird_column_tab'] : '6' );
$gird_column_mobile  = ( $data['gird_column_mobile'] ? $data['gird_column_mobile'] : '12' );
$col_class = "col-md-{$gird_column_desktop} col-sm-{$gird_column_tab} col-xs-{$gird_column_mobile}";
?>
<div class="rt-owl-carousel-wrapper rt-team-slider-ten owl-wrap">
    <div class="row">
		<?php if ( have_posts() ) { ?>
			<?php while ( have_posts() ) : the_post(); ?>
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
						$thumbnail = '<img class="attachment-greenova-size5 size-greenova-size5 wp-post-image" src="' . GREENOVA_IMG_URL . 'noimage_290X270.jpg" alt="'
						             . get_the_title() . '">';
					}
				}
				?>
                <div class="<?php echo esc_attr( $col_class ); ?> team-grid-item">
                    <div class="rtin-single-team">
                        <div class="rtin-team-picture team-img-wrapper">
                            <a href="<?php the_permalink(); ?>"><?php echo wp_kses_post( $thumbnail ); ?></a>

							<?php if ( 'visible' == $data['social_icon_visibility'] ) : ?>
                                <div class="tm-social team-social-icon-wrapper">
									<?php if ( ! empty( $team_socials ) ) { ?>
                                        <ul class="social-icons">
											<?php foreach ( $team_socials as $team_social_key => $team_social_value ) { ?>
												<?php if ( ! empty( $team_social_value ) ) { ?>
                                                    <li><a target="_blank" href="<?php echo esc_attr( $team_social_value ); ?>"><i
                                                                    class="fab <?php echo esc_attr( \GREENOVA_Theme::$team_social_fields[ $team_social_key ]['icon'] ); ?>"></i></a>
                                                    </li>
												<?php } ?>
											<?php } ?>
                                        </ul>
									<?php } ?>
                                </div>
							<?php endif; ?>

                        </div>
                        <div class="rtin-team-content team-content-wrapper">
                            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							<?php if ( 'visible' == $data['designation_visibility'] ) { ?>
                                <p class="designation"><?php echo esc_html( $team_designation ); ?></p>
							<?php } ?>
							<?php if ( 'visible' == $data['content_visibility'] ) : ?>
                                <p class="team-content"><?php echo esc_html( $content ); ?></p>
							<?php endif; ?>
                        </div>
                    </div>
                </div>
			<?php endwhile; ?>
			<?php if ( 'visible' == $data['pagination_visibility'] ) : ?>
                <div class="mt20 col-sm-12 col-xs-12 pagination-wrapper"><?php \GREENOVA_Theme_Helper::pagination(); ?></div>
			<?php endif; ?>
			<?php wp_reset_postdata(); ?>
		<?php } else { ?>
            <div class="rtin-single-team">
				<?php esc_html_e( 'No Team Found', 'greenova-core' ); ?>
            </div>
		<?php } ?>
    </div>
</div>