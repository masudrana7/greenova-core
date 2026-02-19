<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Greenova_Core;
// phpcs:disable WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound, WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound
if ( ! defined( 'ABSPATH' ) ) exit;
$thumb_size = $data['project_thumbnail_size'] ? $data['project_thumbnail_size'] : 'greenova-size5';
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
$query               = new \WP_Query( $args );
$count               = $data['content_limit'];
$gird_column_desktop = ( $data['gird_column_desktop'] ? $data['gird_column_desktop'] : '6' );
$gird_column_tab     = ( $data['gird_column_tab'] ? $data['gird_column_tab'] : '6' );
$gird_column_mobile  = ( $data['gird_column_mobile'] ? $data['gird_column_mobile'] : '12' );

$col_class = "col-md-{$gird_column_desktop} col-sm-{$gird_column_tab} col-xs-{$gird_column_mobile}";
?>
<div class="rt-post-vc-grid-3 rt-article-grid-wrapper">
    <div class="row">
		<?php if ( $query->have_posts() ) { ?>
			<?php while ( $query->have_posts() ) : $query->the_post(); ?>
				<?php
				$id        = get_the_ID();
				$content   = get_the_content();
				$content   = apply_filters( 'the_content', $content );
				$content   = wp_trim_words( $content, $count, '' );
				$thumbnail = false;
				if ( has_post_thumbnail() ) {
					$thumbnail = get_the_post_thumbnail( null, $thumb_size, [ 'class' => 'img-responsive' ] );
				} else {
					if ( ! empty( \GREENOVA_Theme::$options['no_preview_image']['url'] ) ) {
						$thumbnail = '<img class="img-responsive attachment-greenova-size5 size-greenova-size5 wp-post-image" src="' . GREENOVA_IMG_URL
						             . 'noimage_370X370.jpg" alt="' . get_the_title() . '">';
					}
				}

				$comments_count           = wp_count_comments( $id );
				$message                  = $comments_count->approved;
				$greenova_comments_number = number_format_i18n( get_comments_number() );
				$greenova_comments_html   = $greenova_comments_number < 2 ? esc_html__( 'Comment', 'greenova-core' ) : esc_html__( 'Comments', 'greenova-core' );
				$greenova_comments_html   = $greenova_comments_number . ' ' . $greenova_comments_html;

				$greenova_date = sprintf( '<span class="day">%s</span><span class="month">%s</span>', get_the_time( 'd' ), get_the_time( 'M' ) );

				?>
                <div class="<?php echo esc_attr( $col_class ); ?>">
                    <div class="media rtin-single-post">
                        <div class="media-left rtin-item-image">
                            <a href="<?php the_permalink(); ?>">
								<?php echo wp_kses_post( $thumbnail ); ?>
                            </a>
							<?php if ( $data['date_visibility'] ) : ?>
                                <span class="date"><?php echo wp_kses_post( $greenova_date ); ?></span>
							<?php endif; ?>
                        </div>
                        <div class="media-body rtin-item-info">
                            <h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							<?php if ( $data['author_visibility'] ) : ?>
                                <span class="user post-meta"><i class="fa fa-user" aria-hidden="true"></i><?php esc_html_e( 'by ',
										'greenova-core' ); ?><?php the_author_posts_link(); ?>
							</span>
							<?php endif; ?>
							<?php if ( $data['comment_visibility'] ) { ?>
                                <span class="comments post-meta"><i class="far fa-comments" aria-hidden="true"></i>
							<a href="<?php echo esc_url( get_comments_link( get_the_ID() ) ); ?>"><?php echo esc_html( $greenova_comments_html ); ?></a>
						</span>
							<?php } ?>
                            <p class="post-excerpt"><?php echo wp_kses_post( $content ); ?></p>
                        </div>
                    </div>
                </div>
			<?php endwhile; ?>
			<?php if ( 'visible' == $data['view_all_visibility'] ) {
				$target   = $data['view_all_btn_link']['is_external'] ? ' target="_blank"' : '';
				$nofollow = $data['view_all_btn_link']['nofollow'] ? ' rel="nofollow"' : '';
				?>
                <div class="rt-grid-fill-btn col-sm-12 col-xs-12 entry-content">
                    <a href="<?php echo esc_url( $data['view_all_btn_link']['url'] ); ?>" class="grid-fill-btn" <?php echo esc_attr( $target . $nofollow ); ?>>
                        <span><?php echo esc_html( $data['view_all_text'] ); ?></span>
                    </a>
                </div>
			<?php } ?>
		<?php } else { ?>
            <div class="rtin-single-post">
				<?php esc_html_e( 'No Post Found', 'greenova-core' ); ?>
            </div>
		<?php } ?>
		<?php wp_reset_query(); ?>
    </div>
</div>