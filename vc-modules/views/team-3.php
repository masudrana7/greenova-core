<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */
// phpcs:disable WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
if ( ! defined( 'ABSPATH' ) ) exit;

$thumb_size = 'greenova-size5';
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
<div class="rt-team-slider-three owl-wrap rt-owl-nav-1 owl-wrap<?php echo esc_attr( $slider_nav_class );?>">
	<div class="owl-theme owl-carousel rt-owl-carousel" data-carousel-options="<?php echo esc_attr( $owl_data );?>">
	<?php if ( $query->have_posts() ) { ?>
		<?php while ( $query->have_posts() ) : $query->the_post(); ?>
		<?php
			$id = get_the_ID();
			$content = get_the_content();
			$content = apply_filters( 'the_content', $content );
			$content = wp_trim_words( $content, $content_limit );
			$team_designation = get_post_meta( $id, 'greenova_team_designation', true );
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
		<div class="rtin-team-box" data-bgcolor="<?php echo esc_attr( $box_bgcolor ); ?>" data-bghover="<?php echo esc_attr( $box_bghovercolor ); ?>">
			<div class="rtin-single-team" style="background-color:<?php echo esc_attr( $box_bgcolor ); ?>">
				<div class="rtin-item-image"><a href="<?php the_permalink(); ?>"><?php echo wp_kses_post( $thumbnail ); ?></a></div>
				<div class="rtin-item-content">
					<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
					<?php if ( $designation_display == 'true' ){ ?>
						<span class="position"><?php echo esc_html( $team_designation ); ?></span>
					<?php } ?>
					<p><?php echo esc_html( $content ); ?></p>
				</div>
			</div>
		</div>
		<?php endwhile;?>
		<?php wp_reset_query();?>
		<?php } else { ?>
			<div class="rtin-team-box">
				<?php esc_html_e( 'No Team Found' , 'greenova-core' ); ?>
			</div>
		<?php } ?>
	</div>
</div>