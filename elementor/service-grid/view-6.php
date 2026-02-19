<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Greenova_Core;
// phpcs:disable WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
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
<div class="row auto-clear rt-service-grid-6 rt-service-wrapper <?php echo esc_attr( $shadow . ' ' . $data['box_text_align'] ); ?>">
	<?php if ( $query->have_posts() ) { ?>
		<?php while ( $query->have_posts() ) : $query->the_post(); ?>
			<?php
			$id        = get_the_ID();
			$content   = get_the_content();
			$content   = apply_filters( 'the_content', $content );
			$content   = wp_trim_words( $content, $count, ' ' );
            $service_id   = get_post_meta( $id, 'greenova_service_info_image', true );
            $service_url = wp_get_attachment_url( $service_id );

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
	                    <?php if( $service_url ) : ?>
                            <div class="service-image">
                                <img src="<?php echo esc_attr($service_url);?>" alt="service icon" />
                            </div>
	                    <?php endif; ?>
                        <a href="<?php the_permalink(); ?>"><?php echo wp_kses_post( $thumbnail ); ?></a>
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
                            <a class="btn-square-transparent service-link-btn" href="<?php the_permalink(); ?>"><?php echo esc_html( $btn_text ); ?>
                                <svg width="16" height="13" viewBox="0 0 16 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9.48999 12.6975C9.26999 12.6975 9.05 12.6175 8.89 12.4475C8.56 12.1175 8.56 11.5775 8.89 11.2475L12.94 7.1975H0.849991C0.379991 7.1975 0 6.8175 0 6.3475C0 5.8775 0.379991 5.4975 0.849991 5.4975H12.94L8.89 1.4475C8.56 1.1175 8.56 0.5775 8.89 0.2475C9.22 -0.0825 9.76 -0.0825 10.09 0.2475L15.59 5.7475C15.67 5.8275 15.73 5.9175 15.77 6.0175C15.81 6.1075 15.83 6.2175 15.83 6.3175V6.3575C15.83 6.4675 15.81 6.5675 15.77 6.6675C15.73 6.7675 15.67 6.8575 15.59 6.9375L10.09 12.4375C9.92 12.6075 9.70999 12.6875 9.48999 12.6875V12.6975Z" fill="white"/>
                                </svg>
                            </a>
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
	<?php wp_reset_query(); ?>
</div>