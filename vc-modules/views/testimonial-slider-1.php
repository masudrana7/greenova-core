<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */
// phpcs:disable WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound, WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound
if ( ! defined( 'ABSPATH' ) ) exit;
$thumb_size = 'greenova-size3';
$count=1;
$primary_color_op = GREENOVA_Theme::$options['primary_color'];
$title_css   = $title_color ? "color:{$title_color};" : "color:{$primary_color_op};";
$args = array(
	'post_type'      => 'green_testimonial',
	'posts_per_page' => $slider_item_number,
	'orderby'		 => $orderby,
	'order'			 => $order,
);
if ( !empty( $cat ) ) {
	$args['tax_query'] = array(
		array(
			'taxonomy' => 'greenova_testimonial_category',
			'field' => 'term_id',
			'terms' => $cat,
		)
	);
}
$query = new WP_Query( $args );
$slider_nav_class = ( $slider_nav == 'true' ) ? ' slider-nav-enabled' : '';
$slider_dot_class = ( $slider_dots == 'true' ) ? ' slider-dot-enabled' : '';
?>
<div class="rt-testimonial-slider-1 owl-wrap rt-owl-nav-5 <?php echo esc_attr( $slider_nav_class );?><?php echo esc_attr( $slider_dot_class );?>">
	<div class="row">
		<div class="box-width owl-theme owl-carousel rt-owl-carousel" data-carousel-options="<?php echo esc_attr( $owl_data );?>">
		<?php if ( $query->have_posts() ) { ?>
			<?php while ( $query->have_posts() ) : $query->the_post();?>
			<?php
				$id = get_the_ID();
				$content = get_the_content();
				$content = apply_filters( 'the_content', $content );
				$content = wp_trim_words( $content, $limit, '' );
				$rc_testimonial_designation = get_post_meta( $id, 'greenova_tes_designation', true );
			?>
				<div class="single-item col-xs-12">
					<div class="single-item-wrapper">
						<div class="tlp-tm-content-wrapper">
							<div class="item-content" style="color:<?php echo esc_attr( $text_color ); ?>"><?php echo esc_html( $content ); ?></div>
							<div class="media testimonial-image">
								<div class="pull-left item-image">
									<?php if ( has_post_thumbnail() ){ the_post_thumbnail( $thumb_size ,  array( 'class' => 'img-circle' )  ); } ?>
								</div>
								<div class="media-body testimonial-content">
									<h3 class="item-title" style="<?php echo esc_attr( $title_css ); ?>"><?php the_title(); ?></h3>
									<span class="item-designation" style="color:<?php echo esc_attr ( $designation_color ); ?>"><?php echo esc_html( $rc_testimonial_designation ); ?></span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php endwhile;?>
			<?php wp_reset_query();?>
			<?php } else { ?>
				<div class="rtin-single-testimonial">
					<?php esc_html_e( 'No Testimonial Found' , 'greenova-core' ); ?>
				</div>
			<?php } ?>
		</div>	
	</div>
</div>