<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Greenova_Core;
// phpcs:disable WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound, WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound
if ( ! defined( 'ABSPATH' ) ) exit;
$thumb_size = ( $data['project_thumbnail_size'] ? $data['project_thumbnail_size'] : 'greenova-size13' );

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

$query         = new \WP_Query( $args );
$content_limit = $data['content_limit'];
$showlink      = $data['show_link'];

$gird_column_desktop = ( $data['gird_column_desktop'] ? $data['gird_column_desktop'] : '4' );
$gird_column_tab     = ( $data['gird_column_tab'] ? $data['gird_column_tab'] : '6' );
$gird_column_mobile  = ( $data['gird_column_mobile'] ? $data['gird_column_mobile'] : '12' );

$col_class = "col-md-{$gird_column_desktop} col-sm-{$gird_column_tab} col-xs-{$gird_column_mobile}";
// Pagination fix
global $wp_query;
$wp_query = null;
$wp_query = $query;
$target   = $data['view_all_btn_url']['is_external'] ? ' target="_blank"' : '';
$nofollow = $data['view_all_btn_url']['nofollow'] ? ' rel="nofollow"' : '';
?>
<div class="our-projects7-area tlp-portfolio rt-project-grid-wrapper">
    <div class="row featuredContainer2 auto-clear entry-content">
		<?php if ( $query->have_posts() ) { ?>
			<?php while ( $query->have_posts() ) : $query->the_post();
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
						$thumbnail = '<img class="attachment-greenova-size5 size-greenova-size5 wp-post-image" src="' . GREENOVA_IMG_URL . 'noimage_500X308.jpg" alt="'
						             . get_the_title() . '">';
					}
				}
				?>

                <div class="tlp-layout layout1 project7-box mb30 <?php echo esc_attr( $col_class ); ?>">
                    <div class="tlp-portfolio-item project-inner-wrapper">
                        <div class="tlp-portfolio-thum tlp-item project-image-wrapper">
							<?php if ( $showlink ) { ?>
                                <a href="<?php the_permalink(); ?>"><?php echo wp_kses_post( $thumbnail ); ?></a>
							<?php } else { ?>
								<?php echo wp_kses_post( $thumbnail ); ?>
							<?php } ?>
                            <div class="tlp-overlay">
                                <p class="link-icon" style="margin-top: 98px;">
                                    <a href="<?php the_permalink(); ?>">
                                        <img class="attachment-greenova-size5 size-greenova-size5 wp-post-image" src="<?php echo esc_url( GREENOVA_IMG_URL ); ?>plus_icon.png">
                                    </a>
                                </p>
                            </div>
                        </div>
                        <div class="tlp-content project-content-wrapper">
                            <div class="tlp-content-holder">
								<?php if ( $showlink ) { ?>
                                    <h3 class="project-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
								<?php } else { ?>
                                    <h3 class="project-title"><?php the_title(); ?></h3>
								<?php } ?>
                            </div>
							<?php if ( 'visible' == $data['content_visibility'] ) : ?>
                                <p class='project-excerpt'><?php echo wp_kses_post( $content ); ?></p>
							<?php endif; ?>
                        </div>
                    </div>
                </div>

			<?php endwhile; ?>
			<?php if ( $data['show_pagination'] ) { ?>
                <div class="mt20 col-sm-12 col-xs-12 pagination-wrapper"><?php \GREENOVA_Theme_Helper::pagination(); ?></div>
			<?php } ?>

			<?php if ( $data['show_view_all_btn'] && $data['view_all_btn_text'] ) { ?>
                <div class="rt-grid-fill-btn col-sm-12 col-xs-12">
                    <a href="<?php echo esc_url( $data['view_all_btn_url']['url'] ); ?>" class="grid-fill-btn" <?php echo esc_attr( $target . $nofollow ); ?>>
                        <span><?php echo esc_html( $data['view_all_btn_text'] ); ?></span>
                    </a>
                </div>
			<?php } ?>

			<?php
		// phpcs:ignore WordPress.WP.DiscouragedFunctions.wp_reset_query_wp_reset_query
		wp_reset_query();
		?>
		<?php } else { ?>
            <div class="<?php echo esc_attr( $col_class ); ?>">
				<?php esc_html_e( 'No Project Found', 'greenova-core' ); ?>
            </div>
		<?php } ?>
    </div>