<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */
// phpcs:disable WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound, WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound
if ( ! defined( 'ABSPATH' ) ) exit;
$thumb_size = 'greenova-size5';
$custom_class = vc_shortcode_custom_css_class( $css );
$args = array(
	'post_type'      => 'greenova_team',
	'posts_per_page' => $slider_item_number,
	'orderby'		 => $orderby,
	'order'			 => $order,
);
if ( !empty( $cat ) ) {
	// phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_tax_query
	$args['tax_query'] = array(
		array(
			'taxonomy' => 'green_team_cat',
			'field' => 'term_id',
			'terms' => $cat,
		)
	);
}
$query = new WP_Query( $args );
$slider_nav_class = ( $slider_nav == 'true' ) ? ' slider-nav-enabled' : '';
$slider_dot_class = ( $slider_dots == 'true' ) ? ' slider-dot-enabled' : '';
?>
<div class="rt-team-slider-eleven owl-wrap rt-owl-nav-2 owl-wrap<?php echo esc_attr( $slider_dot_class );?><?php echo esc_attr( $slider_nav_class );?> <?php echo esc_attr( $custom_class );?>">
	<div class="owl-theme owl-carousel rt-owl-carousel" data-carousel-options="<?php echo esc_attr( $owl_data );?>">
	<?php if ( $query->have_posts() ) { ?>
		<?php while ( $query->have_posts() ) : $query->the_post(); ?>
			<?php
				$id = get_the_ID();
				$content = get_the_content();
				$content = apply_filters( 'the_content', $content );				
				$content = wp_trim_words( $content, $content_limit );
				$team_designation = get_post_meta( $id, 'greenova_team_designation', true );
				$team_socials = get_post_meta( $id, 'greenova_team_socials', true );
				$thumbnail = false;
				if ( has_post_thumbnail() ){
					$thumbnail = get_the_post_thumbnail( null, $thumb_size , array( 'class' => 'img-responsive' ) );
				}
				else {
					if ( !empty( GREENOVA_Theme::$options['no_preview_image']['id'] ) ) {
						$thumbnail = wp_get_attachment_image( GREENOVA_Theme::$options['no_preview_image']['id'], $thumb_size );
					}
					elseif ( !empty( GREENOVA_Theme::$options['no_preview_image']['url'] ) ) {
						$thumbnail = '<img class="attachment-greenova-size5 size-greenova-size5 wp-post-image" src="'.GREENOVA_IMG_URL.'noimage_370X370.jpg" alt="'.get_the_title().'">';
					}
				}
			?>
			<div class="rtin-single-team" style="background:<?php echo esc_attr( $team_box_bg_color ); ?>">
				<div class="rtin-team-picture">
					<a href="<?php the_permalink(); ?>"><?php echo wp_kses_post( $thumbnail ); ?></a>
					<div class="overlay">
						<div class="detail-button"><a href="<?php the_permalink(); ?>"><?php esc_html_e( 'Detail' , 'greenova-core' ); ?></a></div>	
					</div>
				</div>
				<div class="rtin-team-content">
					<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
					<?php if ( $designation_display == 'true' ){ ?>
					<p><?php echo esc_html( $team_designation ); ?></p>
					<?php } ?>
				</div>
				<?php if ( $showcontent == 'true' ) { ?>
				<div class="rtin-sort-bio"><?php echo wp_kses_post($content); ?></div>
				<?php } ?>
				<div class="rtin-team-social">
					<ul>
					<?php foreach ( $team_socials as $team_social_key => $team_social_value ) { ?>
						<?php if ( !empty( $team_social_value ) ) { ?>
							<li><a target="_blank" href="<?php echo esc_attr( $team_social_value );?>"><i class="fab <?php echo esc_attr( GREENOVA_Theme::$team_social_fields[$team_social_key]['icon'] );?>"></i></a></li>
						<?php } ?>
					<?php } ?>
					</ul>
				</div>
			</div>
			<?php endwhile;?>
		<?php
		// phpcs:ignore WordPress.WP.DiscouragedFunctions.wp_reset_query_wp_reset_query
		wp_reset_query();
		?>
		<?php } else { ?>
			<div class="rtin-single-team">
				<?php esc_html_e( 'No Team Found' , 'greenova-core' ); ?>
			</div>
		<?php } ?>
	</div>
</div>