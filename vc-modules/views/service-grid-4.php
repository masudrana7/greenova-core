<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */
// phpcs:disable WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound, WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound
if ( ! defined( 'ABSPATH' ) ) exit;
 
$thumb_size = 'greenova-size2';
$shadow = "";
if ( get_query_var('paged') ) {
	$paged = get_query_var('paged');
}
elseif ( get_query_var('page') ) {
	$paged = get_query_var('page');
}
else {
	$paged = 1;
}
if ( $showshadow == 'true' ) {
	$shadow = 'shadow';
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
<div class="row auto-clear rt-service-grid-4 <?php echo esc_attr( $shadow ); ?>">
	<?php if ( $query->have_posts() ) { ?>
		<?php while ( $query->have_posts() ) : $query->the_post();?>
			<?php
				$id = get_the_ID();
				$content = get_the_content();
				$content = apply_filters( 'the_content', $content );
				$content = wp_trim_words( $content, $count, ' ' );
				$thumbnail = false;
				if ( has_post_thumbnail() ){
					$thumbnail = get_the_post_thumbnail( null, $thumb_size );
				}
				else {
					if ( !empty( GREENOVA_Theme::$options['no_preview_image']['url'] ) ) {
						$thumbnail = '<img class="attachment-greenova-size5 size-greenova-size5 wp-post-image" src="'.GREENOVA_IMG_URL.'noimage_460X270.jpg" alt="'.get_the_title().'">';
					}
				}

				$comments_count = wp_count_comments( $id );
				$message =  $comments_count->approved ;				
			?>
			<div class="<?php echo esc_attr($col_class); ?>">			
				<div class="rtin-single-post">
					<div class="rtin-item-image">
						<a href="<?php the_permalink(); ?>">
							<?php echo wp_kses_post( $thumbnail ); ?>
						</a>
						<a class="plus-icon" href="<?php the_permalink();?>"><?php esc_html_e( 'Details' , 'greenova-core' ); ?></a>
						
					</div>
					<div class="rtin-item-info">
						<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						<p><?php echo esc_html( wp_strip_all_tags(strip_shortcodes($content)) );?></p>
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
		<div class="rtin-single-news">
			<?php esc_html_e( 'No Post Found' , 'greenova-core' ); ?>
		</div>
	<?php } ?>
	<?php wp_reset_query();?>
</div>