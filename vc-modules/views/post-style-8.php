<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */
// phpcs:disable WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound, WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound
if ( ! defined( 'ABSPATH' ) ) exit;
$thumb_size = 'greenova-size14';
$args = array(
	'posts_per_page' => $slider_item_number,
	'ignore_sticky_posts' => 1,
	'cat'       => $cat,
	'orderby'		 => $orderby,
	'order'			 => $order,
	);
	
$query = new WP_Query( $args );
$slider_dots_class = ( $slider_dots == 'true' ) ? ' slider-dot-enabled' : ' slider-nav-enabled';
?>
<div class="rt-post-vc-section-8 owl-wrap rt-owl-nav-1 <?php echo esc_attr( $slider_dots_class );?>">
	<?php if ( $showtitle == 'true' ){ ?>
	<div class="section-title-content">		
		<div class="section-title">
			<h2 class="section-title-holder" style="color:<?php echo esc_attr( $section_title_color ); ?>;"><?php echo wp_kses_post( $title );?></h2>
		</div>		
		<div class="owl-custom-nav owl-nav">
			<div class="owl-prev"><i class="fa fa-angle-left"></i></div><div class="owl-next"><i class="fa fa-angle-right"></i></div>
		</div>
		<div class="owl-custom-nav-bar"></div>
		<div class="clear"></div>
	</div>
	<?php } ?>
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
					$thumbnail = get_the_post_thumbnail( null, $thumb_size, array( 'class' => 'img-responsive' ) );
				}
				else {
					if ( !empty( GREENOVA_Theme::$options['no_preview_image']['url'] ) ) {
						$thumbnail = '<img class="img-responsive attachment-greenova-size5 size-greenova-size5 wp-post-image" src="'.GREENOVA_IMG_URL.'noimage_870X429.jpg" alt="'.get_the_title().'">';
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
					<span class="date"><i class="fa fa-calendar" aria-hidden="true"></i><?php echo get_the_date(); ?></span>
					<?php if ( $showcomment == 'true' ){ ?>
					<span class="comments"><i class="far fa-comments" aria-hidden="true"></i><?php esc_html_e( 'Comments' , 'greenova-core' ); ?>: <?php echo esc_html ( $message ); ?></span>
					<?php } ?>
					<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
					<p><?php echo wp_kses_post( $content ); ?></p>
					<span class="by-author"><i class="fa fa-user-circle" aria-hidden="true"></i><?php esc_html_e( 'By', 'greenova-core' ); echo ' '; the_author_posts_link();?></span>
					</div>
			</div>			
		<?php endwhile;?>
	<?php } else { ?>
		<div class="rtin-single-post">
			<?php esc_html_e( 'No Post Found' , 'greenova-core' ); ?>
		</div>
	<?php } ?>
	<?php wp_reset_postdata();?>
	</div>
</div>