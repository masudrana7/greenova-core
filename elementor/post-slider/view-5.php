<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Greenova_Core;
// phpcs:disable WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound, WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound
if ( ! defined( 'ABSPATH' ) ) exit;
$thumb_size = $data['project_thumbnail_size'] ? $data['project_thumbnail_size'] : 'greenova-size8';
$args       = [
	'post_type'           => 'post',
	'ignore_sticky_posts' => 1,
	'posts_per_page'      => $data['post_limit'],
	'post_status'         => 'publish',
];
if ( $data['orderby'] ) {
	$args['orderby'] = $data['orderby'];
}
if ( $data['order'] ) {
	$args['order'] = $data['order'];
}

if ( $data['post_source'] == 'by_category' && $data['categories'] ) :
	$args = wp_parse_args(
		[
			'cat' => $data['categories'],
		]
		, $args );
endif;

if ( $data['post_source'] == 'by_tags' && $data['tags'] ) :
	$args = wp_parse_args(
		[
			'tag_slug__in' => $data['tags'],
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

$query            = new \WP_Query( $args );
$slider_nav_class = $data['carousel_nav'] ? ' slider-nav-enabled' : '';
$slider_dot_class = $data['carousel_dots'] ? ' slider-dot-enabled' : '';
$count            = $data['content_limit'];
$owl_data         = json_encode( $data['owl_data'] );
?>
<div class="rt-post-vc-section-6 rt-owl-carousel-wrapper owl-wrap rt-owl-nav-1 rt-latest-article-section <?php echo esc_attr( $slider_dot_class . ' '
                                                                                                                              . $slider_nav_class ); ?><?php echo esc_attr( $slider_nav_class ); ?>">
	<?php if ( $data['show_section_title'] ) { ?>
        <div class="section-title-content post-section-title-wrapper">
            <div class="section-title">
                <h2 class="section-title-holder"><?php echo wp_kses_post( $data['section_title_text'] ); ?></h2>
                <p><?php echo wp_kses_post( $data['section_subtitle_text'] ); ?></p>
            </div>
            <div class="clear"></div>
        </div>
	<?php } ?>
    <div class="owl-theme owl-carousel rt-owl-carousel" data-carousel-options="<?php echo esc_attr( $owl_data ); ?>">
		<?php if ( $query->have_posts() ) { ?>
			<?php while ( $query->have_posts() ) : $query->the_post(); ?>
				<?php
				$id        = get_the_ID();
				$content   = get_the_content();
				$content   = apply_filters( 'the_content', $content );
				$content   = wp_trim_words( $content, $count, '' );
				$thumbnail = false;
				if ( has_post_thumbnail() ) {
					$thumbnail = get_the_post_thumbnail( null, $thumb_size );
				} else {
					if ( ! empty( \GREENOVA_Theme::$options['no_preview_image']['url'] ) ) {
						$thumbnail = '<img class="attachment-greenova-size5 size-greenova-size5 wp-post-image" src="' . GREENOVA_IMG_URL . 'noimage.jpg" alt="' . get_the_title()
						             . '">';
					}
				}

				$comments_count = wp_count_comments( $id );
				$message        = $comments_count->approved;
				?>
                <div class="rtin-single-post post-wrap-bg">
                    <div class="rtin-item-image">
                        <a href="<?php the_permalink(); ?>">
							<?php echo wp_kses_post( $thumbnail ); ?>
                        </a>
                    </div>
                    <div class="rtin-item-info post-inner-paddnig">
                        <h3 class='entry-title'><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

						<?php if ( 'visible' == $data['content_visibility'] ) : ?>
                            <p class="rt-post-excerpt"><?php echo wp_kses_post( $content ); ?></p>
						<?php endif; ?>

						<?php if ( $data['date_visibility'] ) : ?>
                            <div class="rtin-post-date post-meta"><?php echo get_the_date(); ?></div>
						<?php endif; ?>

						<?php if ( 'visible' == $data['readmore_visibility'] ) : ?>
                            <div class="readmore-wrapper">
                                <a class="rt-read-more-btton" href="<?php the_permalink(); ?>"><?php echo esc_html( $data['readmore_text'] ); ?><i
                                            class="fa fa-angle-right"></i></a>
                            </div>
						<?php endif; ?>
                    </div>
                </div>
			<?php endwhile; ?>
		<?php } else { ?>
            <div class="rtin-single-news">
				<?php esc_html_e( 'No Post Found', 'greenova-core' ); ?>
            </div>
		<?php } ?>
		<?php wp_reset_query(); ?>
    </div>
</div>