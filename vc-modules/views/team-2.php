<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */
// phpcs:disable WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
if ( ! defined( 'ABSPATH' ) ) exit;

$thumb_size = 'greenova-size6';
$args = array(
	'post_type'      => 'greenova_team',
	'posts_per_page' => $slider_item_number,
	'orderby'		 => $orderby,
	'order'			 => $order,
);
if ( !empty( $cat ) ) {
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
?>
<div class="rt-team-slider-two owl-wrap rt-owl-nav-1 owl-wrap<?php echo esc_attr( $slider_nav_class );?>">
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
						$thumbnail = '<img class="attachment-greenova-size5 size-greenova-size5 wp-post-image" src="'.GREENOVA_IMG_URL.'noimage_350X450.jpg" alt="'.get_the_title().'">';
					}
				}
			?>
			<div class="rtin-single-team">
				<a href="<?php the_permalink(); ?>"><div class="rtin-item-image"><?php echo wp_kses_post( $thumbnail ); ?></div></a>
				<div class="rtin-item-content">
					<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
					<?php if ( $designation_display == 'true' ){ ?>
						<span class="position"><?php echo esc_html( $team_designation ); ?></span>
					<?php } ?>
					<p><?php echo esc_html($content); ?></p>
					<?php if ( !empty( $team_socials ) ){ ?>
					<ul class="social-icons">
					<?php foreach ( $team_socials as $team_social_key => $team_social_value ) { ?>
						<?php if ( !empty( $team_social_value ) ) { ?>
						<li><a target="_blank" href="<?php echo esc_attr( $team_social_value );?>"><i class="fab <?php echo esc_attr( GREENOVA_Theme::$team_social_fields[$team_social_key]['icon'] );?>"></i></a></li>
						<?php } ?>
					<?php } ?>
					</ul>
					<?php } ?>
				</div>
			</div>			
		<?php endwhile;?>
	<?php wp_reset_query();?>
	<?php } else { ?>
		<div class="rtin-single-team">
			<?php esc_html_e( 'No Team Found' , 'greenova-core' ); ?>
		</div>
	<?php } ?>
	</div>
</div>