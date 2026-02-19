<?php

/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Greenova_Core;
// phpcs:disable WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound, WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound
if ( ! defined( 'ABSPATH' ) ) exit;

$thumb_size = ( $data['project_thumbnail_size'] ? $data['project_thumbnail_size'] : 'greenova-size17' );

if ( get_query_var( 'paged' ) ) {
	$paged = get_query_var( 'paged' );
} elseif ( get_query_var( 'page' ) ) {
	$paged = get_query_var( 'page' );
} else {
	$paged = 1;
}
$args = [
	'post_type'      => 'greenova_project',
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

if ( $data['post_source'] == 'by_category' && $data['taxonomies'] ):
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
		],
		$args
	);
endif;

if ( $data['post_source'] == 'by_id' && $data['post_id'] ):
	$post_ids         = explode( ',', $data['post_id'] );
	$args['post__in'] = $post_ids;
endif;

if ( $data['exclude'] ):
	$excluded_ids         = explode( ',', $data['exclude'] );
	// phpcs:ignore WordPressVIPMinimum.Performance.WPQueryParams.PostNotIn_post__not_in
	$args['post__not_in'] = $excluded_ids;
endif;

if ( $data['offset'] ) {
	$args['offset'] = $data['offset'];
}

$query         = new \WP_Query( $args );
$content_limit = $data['content_limit'];
$showlink      = $data['show_link'];

$col_class = "col-lg-12 col-md-12 col-sm-12 col-xs-12";
// Pagination fix
global $wp_query;
$wp_query = null;
$wp_query = $query;
$target   = $data['view_all_btn_url']['is_external'] ? ' target="_blank"' : '';
$nofollow = $data['view_all_btn_url']['nofollow'] ? ' rel="nofollow"' : '';
?>
<div class="rt-project-gallery-4 rt-project-grid-wrapper row">
	<?php if ( $query->have_posts() ) { ?>
		<?php
		$i = 1;
		while ( $query->have_posts() ) : $query->the_post();
			$content   = get_the_content();
			$content   = apply_filters( 'the_content', $content );
			$content   = wp_trim_words( $content, $content_limit, '' );
			$thumbnail = false;
			if ( has_post_thumbnail() ) {
				$thumbnail = get_the_post_thumbnail( null, $thumb_size, [ 'class' => 'img-responsive' ] );
			} else {
				if ( ! empty( \GREENOVA_Theme::$options['no_preview_image']['id'] ) ) {
					$thumbnail = wp_get_attachment_image( \GREENOVA_Theme::$options['no_preview_image']['id'], $thumb_size );
				} elseif ( ! empty( \GREENOVA_Theme::$options['no_preview_image']['url'] ) ) {
					$thumbnail = '<img class="attachment-greenova-size5 size-greenova-size5 wp-post-image" src="' . GREENOVA_IMG_URL . 'noimage_900X700.jpg" alt="'
					             . get_the_title() . '">';
				}
			}
			?>
            <div class="project4-box project-inner-wrapper <?php echo esc_attr( $col_class ); ?>">
				<?php if ( $i % 2 == 0 ): ?>
                    <div class="col-md-6 no-padding">
                        <div class="project4-img-holder">
							<?php echo wp_kses_post( $thumbnail ); ?>
                        </div>
                    </div>
				<?php endif; ?>
                <div class="col-md-6 no-padding">
                    <div class="project4-content-holder">
                        <div class="project4-content">
                            <div class="text-wrapper">
								<?php if ( $showlink ) { ?>
                                    <h3 class="project-title"><a href="<?php the_permalink(); ?>" class="gallery-details"><?php the_title(); ?></a></h3>
								<?php } else { ?>
                                    <h3 class="project-title"><?php the_title(); ?></h3>
								<?php } ?>

								<?php if ( 'visible' == $data['content_visibility'] ) : ?>
                                    <p class='project-excerpt'><?php echo wp_kses_post( $content ); ?></p>
								<?php endif; ?>

								<?php if ( 'visible' == $data['readmore_visibility'] ) : ?>
                                    <div class="project-button read-more-btn"><span><a href="<?php the_permalink(); ?>"><?php echo esc_html( $data['readmore_text'] ); ?></a></span>
                                    </div>
								<?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
				<?php if ( $i % 2 != 0 ): ?>
                    <div class="col-md-6 no-padding">
                        <div class="project4-img-holder">
							<?php echo wp_kses_post( $thumbnail ); ?>
                        </div>
                    </div>
				<?php endif; ?>
            </div>
			<?php
			$i ++;
		endwhile; ?>

		<?php if ( $data['show_pagination'] ) { ?>
            <div class="mt20 col-sm-12 col-xs-12 pagination-wrapper"><?php \GREENOVA_Theme_Helper::pagination(); ?></div>
		<?php } ?>

		<?php if ( $data['show_view_all_btn'] && $data['view_all_btn_text'] ) { ?>
            <div class="rt-grid-fill-btn">
                <a href="<?php echo esc_url( $data['view_all_btn_url']['url'] ); ?>" class="grid-fill-btn" <?php echo esc_attr( $target . $nofollow ); ?>>
                    <span><?php echo esc_html( $data['view_all_btn_text'] ); ?></span>
                </a>
            </div>
		<?php } ?>


		// phpcs:ignore WordPress.WP.DiscouragedFunctions.wp_reset_query_wp_reset_query
		<?php wp_reset_query(); ?>
	<?php } else { ?>
        <div class="<?php echo esc_attr( $col_class ); ?>">
			<?php esc_html_e( 'No Project Found', 'greenova-core' ); ?>
        </div>
	<?php } ?>
</div>