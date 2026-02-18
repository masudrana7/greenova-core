<?php

/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Greenova_Core;

$thumb_size = ( $data['project_thumbnail_size'] ? $data['project_thumbnail_size'] : 'greenova-size2' );

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
<div class="rt-project-gallery-6 rt-project-grid-wrapper <?php echo esc_attr( $data['title_two_position'] ); ?>">
    <div class="row auto-clear entry-content">
		<?php if ( $query->have_posts() ) { ?>
			<?php while ( $query->have_posts() ): $query->the_post();
				$content   = \GREENOVA_Theme_Helper::filter_content( get_the_content() );
				$content   = wp_trim_words( $content, $content_limit, '' );
				$thumbnail = false;
				if ( has_post_thumbnail() ) {
					$thumbnail = get_the_post_thumbnail( null, $thumb_size, [ 'class' => 'img-responsive' ] );
				} else {
					if ( ! empty( \GREENOVA_Theme::$options['no_preview_image']['id'] ) ) {
						$thumbnail = wp_get_attachment_image( \GREENOVA_Theme::$options['no_preview_image']['id'], $thumb_size );
					} elseif ( ! empty( \GREENOVA_Theme::$options['no_preview_image']['url'] ) ) {
						$thumbnail = '<img class="attachment-greenova-size5 size-greenova-size5 wp-post-image" src="' . GREENOVA_IMG_URL . 'noimage_460x270.jpg" alt="'
						             . get_the_title() . '">';
					}
				}
				?>

                <div class="<?php echo esc_attr( $col_class ); ?> project6-box">
                    <div class="project6-box-inner entry-content project-inner-wrapper">
                        <div class="project6-img-holder">
							<?php if ( $showlink ) { ?>
                                <a href="<?php the_permalink(); ?>"><?php echo wp_kses_post( $thumbnail ); ?></a>
							<?php } else { ?>
								<?php echo wp_kses_post( $thumbnail ); ?>
							<?php } ?>
							<?php if ( 'visible' == $data['title_two_visibility'] ) : ?>
                                <div class="rtin-proj6-box-info-1">
									<?php if ( $showlink ) { ?>
                                        <h3 class="project-title-two"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
									<?php } else { ?>
                                        <h3 class="project-title-two"><?php the_title(); ?></h3>
									<?php } ?>
                                </div>
							<?php endif; ?>
                            <div class="rtin-proj6-box-info-2 project-content-wrapper">
								<?php if ( $showlink ) { ?>
                                    <h3 class="project-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
								<?php } else { ?>
                                    <h3 class="project-title"><?php the_title(); ?></h3>
								<?php } ?>

								<?php if ( 'visible' == $data['content_visibility'] ) : ?>
                                    <p class='project-excerpt proj6-content'><?php echo wp_kses_post( $content ); ?></p>
								<?php endif; ?>

								<?php if ( 'visible' == $data['readmore_visibility'] ) : ?>
                                    <div class="rt-grid-fill-btn">
                                        <a href="<?php the_permalink(); ?>" class="grid-fill-btn read-more-btn"><?php echo esc_html( $data['readmore_text'] ); ?></a>
                                    </div>
								<?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>

			<?php endwhile; ?>
			<?php if ( $data['show_pagination'] ) { ?>
                <div class="mt20 col-sm-12 col-xs-12 pagination-wrapper"><?php \GREENOVA_Theme_Helper::pagination(); ?></div>
			<?php } ?>

			<?php if ( $data['show_view_all_btn'] && $data['view_all_btn_text'] ) { ?>
                <div class="rt-grid-fill-btn">
                    <a href="<?php echo esc_url( $data['view_all_btn_url']['url'] ); ?>" class="grid-fill-btn" <?php echo( $target . $nofollow ); ?>>
                        <span><?php echo esc_html( $data['view_all_btn_text'] ); ?></span>
                    </a>
                </div>
			<?php } ?>

			<?php wp_reset_query(); ?>
		<?php } else { ?>
            <div class="<?php echo esc_attr( $col_class ); ?>">
				<?php esc_html_e( 'No Project Found', 'greenova-core' ); ?>
            </div>
		<?php } ?>
    </div>
</div>