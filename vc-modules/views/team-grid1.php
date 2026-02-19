<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */
// phpcs:disable WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
if ( ! defined( 'ABSPATH' ) ) exit;

$thumb_size = 'greenova-size5';
if ( get_query_var('paged') ) {
	$paged = get_query_var('paged');
}
elseif ( get_query_var('page') ) {
	$paged = get_query_var('page');
}
else {
	$paged = 1;
}

$args = array(
	'post_type'      => 'greenova_team',
	'posts_per_page' => $grid_item_number,
	'paged'          => $paged,
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
$col_class = "col-lg-$col_lg col-md-$col_md col-sm-$col_sm col-xs-$col_xs";

// Pagination fix
global $wp_query;
$wp_query   = NULL;
$wp_query   = $query;
?>
<div>
	<div class="row auto-clear rt-team-slider-three rt-team-grid-1">
	<?php if ( have_posts() ) { ?>
		<?php while ( have_posts() ) : the_post(); ?>
		<?php		
			$id = get_the_ID();
			$content = get_the_content();
			$content = apply_filters( 'the_content', $content );
			$content = wp_trim_words( $content, 10, '' );
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
		<div class="<?php echo esc_attr( $col_class );?>">
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
		</div>
		<?php endwhile;?>
		<?php if ( $show_pagination == 'true' ) { ?>
		<div class="mt20 col-sm-12 col-xs-12 pagination-wrapper"><?php GREENOVA_Theme_Helper::pagination();?></div>
		<?php } ?>
		<?php } else { ?>
			<div class="rtin-single-team">
				<?php esc_html_e( 'No Team Found' , 'greenova-core' ); ?>
			</div>
		<?php } ?>
	</div>
	<?php wp_reset_query();?>
</div>