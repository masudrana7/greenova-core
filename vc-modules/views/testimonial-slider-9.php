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
$section_title   = $section_title_color ? "color:{$section_title_color};" : "";
$args = array(
	'post_type'      => 'green_testimonial',
	'posts_per_page' => $slider_item_number,
	'orderby'		 => $orderby,
	'order'			 => $order,
);
if ( !empty( $cat ) ) {
	// phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_tax_query
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
<div class="rt-testimonial-slider-9 owl-wrap rt-owl-nav-4 <?php echo esc_attr( $slider_nav_class ); ?><?php echo esc_attr( $slider_dot_class ); ?>">
	<?php if ( $showtitle == 'true' ) { ?>
        <div class="testimonial-section-title">
            <h2 class="ts-section-title" style="<?php echo esc_attr( $section_title ); ?>"><?php echo esc_html( $sectiontitle ); ?></h2>
        </div>
        <div class="clear"></div>
	<?php } ?>
    <div class="owl-theme owl-carousel rt-owl-carousel" data-carousel-options="<?php echo esc_attr( $owl_data ); ?>">
        <div class="main-slider-holder">
			<?php if ( $query->have_posts() ) { ?>
			<?php while ( $query->have_posts() ) :
			$query->the_post(); ?>
			<?php
			$id                         = get_the_ID();
			$content                    = get_the_content();
			$content                    = apply_filters( 'the_content', $content );
			$content                    = wp_trim_words( $content, $limit, '' );
			$rc_testimonial_designation = get_post_meta( $id, 'greenova_tes_designation', true );
			?>
            <div class="client-box">
                <div class="media">
                    <div class="pull-left item-image">
						<?php if ( has_post_thumbnail() ) {
							the_post_thumbnail( $thumb_size, [ 'class' => 'img-circle' ] );
						} ?>
                    </div>
                    <div class="media-body">
                        <p style="color:<?php echo esc_attr( $text_color ); ?>"><?php echo esc_html( $content ); ?></p>
                        <h3 style="<?php echo esc_attr( $title_css ); ?>"><?php the_title(); ?></h3>
						<?php if ( ! empty ( $rc_testimonial_designation ) ) { ?>
                            <span class="rt-designation" style="color:<?php echo esc_attr( $designation_color ); ?>"><?php echo esc_html( $rc_testimonial_designation ); ?></span>
						<?php } ?>
                    </div>
                </div>
            </div>
			<?php
			if ( ( $count % 2 ) == 0 ){ ?>
        </div>
		<?php if ( $query->current_post + 1 < $query->post_count ) { ?>
        <div class="main-slider-holder">
			<?php }
			}
			$count ++; ?>
			<?php endwhile; ?>
			<?php
			// phpcs:ignore WordPress.WP.DiscouragedFunctions.wp_reset_query_wp_reset_query
			wp_reset_query();
			?>
			<?php } else { ?>
                <div class="rtin-single-testimonial">
					<?php esc_html_e( 'No Testimonial Found', 'greenova-core' ); ?>
                </div>
			<?php } ?>
        </div>
    </div>
