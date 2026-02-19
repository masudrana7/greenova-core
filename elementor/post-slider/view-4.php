<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Greenova_Core;
if ( ! defined( 'ABSPATH' ) ) exit;
$thumb_size = $data['project_thumbnail_size'] ? $data['project_thumbnail_size'] : 'greenova-size2';
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


$query = new \WP_Query( $args );

$slider_nav_class = $data['carousel_nav'] ? ' slider-nav-enabled' : '';
$slider_dot_class = $data['carousel_dots'] ? ' slider-dot-enabled' : '';
$greenova_time_html      = sprintf( '%s <span>%s</span>,<span> %s</span>', get_the_time( 'M' ), get_the_time( 'd' ), get_the_time( 'Y' ) );
$greenova_time_html      = apply_filters( 'greenova_single_time', $greenova_time_html );
$greenova_comments_number = number_format_i18n( get_comments_number() );
$greenova_comments_html   = $greenova_comments_number < 2 ? esc_html__( 'Comment', 'greenova-core' ) : esc_html__( 'Comments', 'greenova-core' );
$greenova_comments_html   = '(' . $greenova_comments_number . ') ' . $greenova_comments_html;

$thumbnail = false;
$count     = $data['content_limit'];
$owl_data  = json_encode( $data['owl_data'] );
$has_sec_title = $data['show_section_title'] ? " has-section-title" : NULL;
?>
<div class="rt-post-vc-section-5 rt-owl-nav-middle rt-owl-carousel-wrapper owl-wrap rt-owl-nav-3 rt-latest-article-section <?php echo esc_attr( $slider_dot_class . $slider_nav_class . $has_sec_title ); ?>">
	<?php if ( $data['show_section_title'] ) { ?>
        <div class="section-heading post-section-title-wrapper">
            <div class="section-title">
                <h2 class="title"><?php echo wp_kses_post( $data['section_title_text'] ); ?></h2>
                <p class="sub-title"><?php echo wp_kses_post( $data['section_subtitle_text'] ); ?></p>
            </div>
            <div class="owl-custom-nav owl-nav">
                <div class="owl-prev"><i class="fa fa-angle-left"></i></div>
                <div class="owl-next"><i class="fa fa-angle-right"></i></div>
            </div>
            <div class="owl-custom-nav-bar"></div>
            <div class="clear"></div>
        </div>
	<?php } ?>
    <div class="owl-theme owl-carousel rt-owl-carousel" data-carousel-options="<?php echo esc_attr( $owl_data ); ?>">
		<?php if ( $query->have_posts() ) { ?>
			<?php while ( $query->have_posts() ) : $query->the_post(); ?>
				<?php
				$id      = get_the_ID();
				$content = get_the_content();
				$content = apply_filters( 'the_content', $content );
				$content = wp_trim_words( $content, $count, '' );

				$thumbnail = false;
				if ( has_post_thumbnail() ) {
					$thumbnail = get_the_post_thumbnail( null, $thumb_size );
				} else {
					if ( ! empty( \GREENOVA_Theme::$options['no_preview_image']['id'] ) ) {
						$thumbnail = wp_get_attachment_image( \GREENOVA_Theme::$options['no_preview_image']['id'], $thumb_size );
					} elseif ( ! empty( \GREENOVA_Theme::$options['no_preview_image']['url'] ) ) {
						$thumbnail = '<img class="attachment-greenova-size5 size-greenova-size5 wp-post-image" src="' . GREENOVA_IMG_URL . 'noimage_370x522.jpg" alt="'
						             . get_the_title() . '">';
					}
				}
				?>
                <div class="blog-box post-wrap-bg">
                    <div class="blog-img-holder">
						<?php if ( $data['date_visibility'] ) : ?>
                            <div class="blog-content-holder date-wrapper"><span><?php echo wp_kses_post( $greenova_time_html ); ?></span></div>
						<?php endif; ?>
                        <a href="<?php the_permalink(); ?>">
							<?php echo wp_kses_post( $thumbnail ); ?>
                        </a>
                    </div>
                    <div class="blog-bottom-content-holder post-inner-paddnig">
                        <h3 class='entry-title'><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        <ul>
							<?php if ( $data['author_visibility'] ) : ?>
                                <li class="green-author post-meta"><i class="fa fa-user" aria-hidden="true"></i><?php esc_html_e( '<span> By </span>', 'greenova-core' )
								                                                                                      . the_author_posts_link(); ?></li>
							<?php endif; ?>
							<?php if ( $data['comment_visibility'] ) : ?>
                                <li class="post-meta"><i class="far fa-comment" aria-hidden="true"></i><a
                                            href="<?php echo esc_url( get_comments_link( get_the_ID() ) ); ?>"> <?php echo esc_html( $greenova_comments_html ); ?></a></li>
							<?php endif; ?>
                        </ul>

						<?php if ( 'visible' == $data['content_visibility'] ) : ?>
                            <p class="rt-post-excerpt"><?php echo wp_kses_post( $content ); ?></p>
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
			<?php wp_reset_query(); ?>
		<?php } else { ?>
            <div class="rtin-single-team">
				<?php esc_html_e( 'No Project Found', 'greenova-core' ); ?>
            </div>
		<?php } ?>
    </div>
</div>