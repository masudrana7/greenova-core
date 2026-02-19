<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */
// phpcs:disable WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
if ( ! defined( 'ABSPATH' ) ) exit;

$thumb_size = 'greenova-size7';
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
<div class="rt-project-slider-one owl-wrap rt-owl-nav-3 <?php echo esc_attr( $slider_dot_class );?><?php echo esc_attr( $slider_nav_class );?>">
	<?php if ( $showtitle == 'true' ){ ?>
		<div class="section-heading">
			<div class="section-title-content">		
				<h2 class="title" style="color:<?php echo esc_attr( $section_title_color ); ?>;"><?php echo wp_kses_post( $title );?></h2>
				<p class="sub-title"><?php echo wp_kses_post( $subtitle );?></p>
			</div>
			<div class="owl-custom-nav owl-nav">
				<div class="owl-prev"><i class="fa fa-angle-left"></i></div><div class="owl-next"><i class="fa fa-angle-right"></i></div>
			</div>
			<div class="owl-custom-nav-bar"></div>
			<div class="clear"></div>
		</div>	
	<?php } ?>
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
		<div class="rtin-projects-box">
			<div class="our-projects-img-holder">
				<?php if ( $showlink == 'true') { ?>
				<a href="<?php the_permalink(); ?>"><?php echo wp_kses_post( $thumbnail ); ?></a>
				<?php } else { ?>
				<?php echo wp_kses_post( $thumbnail ); ?>
				<?php } ?>
			</div>
			<div class="our-projects-content-holder">
				<?php if ( $showlink == 'true') { ?>
				<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
				<?php } else { ?>
				<h3><?php the_title(); ?></h3>				
				<?php } ?>
				<?php if ( $content_limit != 0 ) { ?>
				<p><?php echo wp_kses_post( $content ); ?></p>
				<?php } ?>
				<?php if ( $showlink == 'true') { ?>
				<span><a href="<?php the_permalink(); ?>"><i class="fa fa-plus" aria-hidden="true"></i></a></span>
				<?php } else { ?>
				<span><i class="fa fa-plus" aria-hidden="true"></i></span>
				<?php } ?>
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