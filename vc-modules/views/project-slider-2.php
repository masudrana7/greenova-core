<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */
// phpcs:disable WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound, WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound
if ( ! defined( 'ABSPATH' ) ) exit;

$thumb_size = 'greenova-size2';
$args = array(
	'post_type'      => 'greenova_project',
	'posts_per_page' => $slider_item_number,
	'orderby'		 => $orderby,
	'order'			 => $order,
);
if ( !empty( $cat ) ) {
	$args['tax_query'] = array(
		array(
			'taxonomy' => 'greenova_service_category',
			'field' => 'term_id',
			'terms' => $cat,
		)
	);
}
$query = new WP_Query( $args );
$slider_dot_class = ( $slider_dots == 'true' ) ? ' slider-dot-enabled' : '';
$slider_nav_class = ( $slider_dots == 'false' ) ? '' : ' slider-nav-enabled';
?>
<div class="rt-project-slider-two owl-wrap rt-owl-nav-3 <?php echo esc_attr( $slider_dot_class );?><?php echo esc_attr( $slider_nav_class );?>">
	<div class="owl-theme owl-carousel rt-owl-carousel" data-carousel-options="<?php echo esc_attr( $owl_data );?>">
	<?php if ( $query->have_posts() )  { ?>
		<?php while ( $query->have_posts() ) : $query->the_post();?>
		<?php		
			$id = get_the_ID();
			$content = get_the_content();
			$content = apply_filters( 'the_content', $content );
			$content = wp_trim_words( $content, $content_limit, '' );
			
			$thumbnail = false;
			if ( has_post_thumbnail() ){
				$thumbnail = get_the_post_thumbnail( null, $thumb_size );
			}
			else {
				if ( !empty( GREENOVA_Theme::$options['no_preview_image']['id'] ) ) {
					$thumbnail = wp_get_attachment_image( GREENOVA_Theme::$options['no_preview_image']['id'], $thumb_size );
				}
				elseif ( !empty( GREENOVA_Theme::$options['no_preview_image']['url'] ) ) {
					$thumbnail = '<img class="attachment-greenova-size5 size-greenova-size5 wp-post-image" src="'.GREENOVA_IMG_URL.'noimage_370x522.jpg" alt="'.get_the_title().'">';
				}
			}
		?>		
		<div class="our-projects-box2">
			<ul class="our-projects-box2-social">
			<?php if ( $showlink == 'true') { ?>
				<li><a href="<?php the_permalink(); ?>"><i class="fa fa-plus" aria-hidden="true"></i></a></li>
			<?php } else { ?>
				<li><i class="fa fa-plus" aria-hidden="true"></i></li>
			<?php } ?>
			</ul>
			<div class="project-img-holder">
			<?php if ( $showlink == 'true') { ?>
				<a href="<?php the_permalink(); ?>"><?php echo wp_kses_post( $thumbnail ); ?></a>
			<?php } else { ?>
				<?php echo wp_kses_post( $thumbnail ); ?>
			<?php } ?>
			</div>
			<div class="project-content-holder">
			<?php if ( $showlink == 'true') { ?>
				<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
			<?php } else { ?>
				<h3><?php the_title(); ?></h3>
			<?php } ?>
				<p><?php echo wp_kses_post( $content ); ?></p>
			</div>
		</div>
		<?php endwhile;?>
		<?php wp_reset_query();?>
		<?php } else { ?>
			<div class="rtin-single-team">
				<?php esc_html_e( 'No Project Found' , 'greenova-core' ); ?>
			</div>
		<?php } ?>
	</div>
</div>