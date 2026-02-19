<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */
// phpcs:disable WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound, WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound
if ( ! defined( 'ABSPATH' ) ) exit;
$thumb_size = 'greenova-size8';
$args = array(
	'posts_per_page' => $slider_item_number,	
	'ignore_sticky_posts' => 1,
	'cat'                 => $cat,
	'orderby'		      => $orderby,
	'order'			      => $order,
	);
$query = new WP_Query( $args );
$slider_nav_class = ( $slider_nav == 'true' ) ? ' slider-nav-enabled' : '';
$slider_dot_class = ( $slider_dots == 'true' ) ? ' slider-dot-enabled' : '';
?>
<div class="rt-post-vc-section-6 owl-wrap rt-owl-nav-1 <?php echo esc_attr( $slider_dot_class );?><?php echo esc_attr( $slider_nav_class );?>">
	<div class="owl-theme owl-carousel rt-owl-carousel" data-carousel-options="<?php echo esc_attr( $owl_data );?>">
	<?php if ( $query->have_posts() ) { ?>
		<?php while ( $query->have_posts() ) : $query->the_post();?>
			<?php
				$id = get_the_ID();
				$content = get_the_content();
				$content = apply_filters( 'the_content', $content );
				$content = wp_trim_words( $content, $count, '' );
				$thumbnail = false;
				if ( has_post_thumbnail() ){
					$thumbnail = get_the_post_thumbnail( null, $thumb_size );
				}
				else {
					if ( !empty( GREENOVA_Theme::$options['no_preview_image']['url'] ) ) {
						$thumbnail = '<img class="attachment-greenova-size5 size-greenova-size5 wp-post-image" src="'.GREENOVA_IMG_URL.'noimage.jpg" alt="'.get_the_title().'">';
					}
				}

				$comments_count = wp_count_comments( $id );
				$message =  $comments_count->approved ;				
			?>					
			<div class="rtin-single-post">
				<div class="rtin-item-image">
					<a href="<?php the_permalink(); ?>">
						<?php echo wp_kses_post( $thumbnail ); ?>
					</a>
				</div>
				<div class="rtin-item-info">
					<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
					<div class="rtin-post-date"><?php echo get_the_date(); ?></div>
				</div>
			</div>			
		<?php endwhile;?>
	<?php } else { ?>
		<div class="rtin-single-news">
			<?php esc_html_e( 'No Post Found' , 'greenova-core' ); ?>
		</div>
	<?php } ?>
	<?php wp_reset_postdata();?>
	</div>
</div>