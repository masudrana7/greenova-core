<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */
// phpcs:disable WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound, WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound
if ( ! defined( 'ABSPATH' ) ) exit;

$thumb_size = 'greenova-size14';
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
	'post_type'      => 'greenova_service',
	'posts_per_page' => $grid_item_number,
	'paged'          => $paged,
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
$col_class = "col-lg-$col_lg col-md-$col_md col-sm-$col_sm col-xs-$col_xs";

// Pagination fix
global $wp_query;
$wp_query   = NULL;
$wp_query   = $query;
?>
<div>
	<div class="row auto-clear rt-service-grid-5">
	<?php if ( have_posts() ) { ?>
		<?php while ( have_posts() ) : the_post(); ?>
		<?php
			$id = get_the_id();			
			$content = get_the_content();
			//$content = apply_filters( 'the_content', $content );
			$content = wp_trim_words( $content, $count, '' );
			$thumbnail = false;
			if ( has_post_thumbnail() ){
				$thumbnail = get_the_post_thumbnail( null, $thumb_size , array( 'class' => 'img-responsive' ) );
			}
			else {
				if ( !empty( GREENOVA_Theme::$options['no_preview_image']['id'] ) ) {
					$thumbnail = wp_get_attachment_image( GREENOVA_Theme::$options['no_preview_image']['id'], $thumb_size );
				}
				elseif ( !empty( GREENOVA_Theme::$options['no_preview_image']['url'] ) ) {
					$thumbnail = '<img class="attachment-greenova-size5 size-greenova-size5 wp-post-image" src="'.GREENOVA_IMG_URL.'noimage_410X265.jpg" alt="'.get_the_title().'">';
				}
			}
		?>
		<div class="service-box <?php echo esc_attr($col_class); ?>">
			<div class="service-img-holder">
				<?php if ( $showlink == 'true' ) { ?>
				<a href="<?php the_permalink(); ?>"><?php echo wp_kses_post( $thumbnail ); ?></a>
				<?php } else { ?>
				<?php echo wp_kses_post( $thumbnail ); ?>
				<?php } ?>
				<div class="service-content-holder">
					<?php if ( $showlink == 'true' ) { ?>
					<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
					<?php } else { ?>
					<h3><?php the_title(); ?></h3>
					<?php } ?>				
					<p><?php echo esc_html( wp_strip_all_tags(strip_shortcodes($content)) );?></p>
					<a class="service-more" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read More' , 'greenova-core' ); ?><i class="fa fa-angle-right" aria-hidden="true"></i></a>
				</div>
			</div>
		</div>
		<?php endwhile;?>
		<?php if ( $pagina_display == 'true' ) { ?>
			<div class="mt20 col-sm-12 col-xs-12 pagination-wrapper"><?php GREENOVA_Theme_Helper::pagination();?></div>
		<?php } ?>
		<?php if ( $button_display == 'true' ) { ?>
			<div class="rt-grid-fill-btn">
				<a href="<?php echo esc_url( $buttonurl );?>" class="btn-square-transparent"><?php echo esc_html( $buttontext );?></a>
			</div>
		<?php } ?>
		<?php } else { ?>
			<div class="rtin-single-team">
				<?php esc_html_e( 'No Service Found' , 'greenova-core' ); ?>
			</div>
		<?php } ?>
	</div>
	<?php wp_reset_query();?>
</div>