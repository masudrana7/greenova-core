<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */
// phpcs:disable WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
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
	'post_type'      => 'greenova_project',
	'posts_per_page' => $grid_item_number,
	'paged'          => $paged,
	'orderby'		 => $orderby,
	'order'			 => $order,
);

$query = new WP_Query( $args );

$posts = get_posts( $args );

$gallery = array();
$cats    = array();

foreach ( $posts as $post ) {
    $terms = get_the_terms( $post, 'greenova_project_category' );
    $terms_html = '';
	
	if ( $terms ) {
		foreach ( $terms as $term ) {
			$terms_html .= ' ' . $term->slug;
			if ( !isset( $cats[$term->slug] ) ) {
				$cats[$term->slug] = $term->name;
			}
		}
	}
	$gallery[] = array(
		'cats'  => $terms_html,
	);
}
$col_class = "col-lg-$col_lg col-md-$col_md col-sm-$col_sm col-xs-$col_xs";

// Pagination fix
global $wp_query;
$wp_query   = NULL;
$wp_query   = $query;
?>
<div class="our-projects2-area rt-project-gallery-5" id="inner-isotope">
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="rt-portfolio-tab isotop-classes-tab myisotop2" style="text-align:<?php echo esc_attr($align_filter_btn); ?>;">
				<a href="#" data-filter="*" class="current"><?php esc_html_e( 'All' , 'greenova-core' ); ?></a>
				<?php foreach ( $cats as $key => $value): ?>
					<a href="#" data-filter=".<?php echo esc_attr( $key );?>"><?php echo esc_html( $value );?></a>
				<?php endforeach; ?>
				
			</div>
		</div>
	</div>
	<div class="row featuredContainer2">
	<?php if ( $query->have_posts() ) { ?>
		<?php while ( $query->have_posts() ) : $query->the_post();
			$content = GREENOVA_Theme_Helper::filter_content(get_the_content());
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
			$terms = get_the_terms( get_the_ID(), 'greenova_project_category' );
		?>
		<?php
		$term_list = "";
		$term_list_in = "";
			if ( $terms && ! is_wp_error( $terms ) ) : 
				$term_links = array(); 
				foreach ( $terms as $term ) {
					$term_links[] = $term->slug;
				}
				$term_list = join( " ", $term_links );
				$term_list_in = join( ", ", $term_links );
			endif;
		?>
		
		<div class="<?php echo esc_attr( $col_class );?> project5-box <?php if ( !empty( $term_list ) ){ echo esc_html( $term_list ); } ?>">
			<div class="project5-box-inner">
				<div class="project5-img-holder">
				<?php if ( $showlink == 'true' ) { ?>
					<a href="<?php the_permalink(); ?>"><?php echo wp_kses_post( $thumbnail ); ?></a>
				<?php } else { ?>
					<?php echo wp_kses_post( $thumbnail ); ?>
				<?php } ?>
					<div class="rtin-proj5-box-info">
						<?php if ( $showlink == 'true' ) { ?>
						<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						<?php } else { ?>
						<h3><?php the_title(); ?></h3>
						<?php } ?>
						<p class="proj5-content"><?php echo wp_kses_post( $content ); ?></p>
					</div>
				</div>
			</div>
		</div>
		
		<?php endwhile;?>
		<?php if ( $show_pagination == 'true' ) { ?>
		<div class="mt20 col-sm-12 col-xs-12 pagination-wrapper"><?php GREENOVA_Theme_Helper::pagination();?></div>
		<?php } ?>			
		<?php if ( $show_button == 'true' ) { ?>
			<div class="rt-grid-fill-btn col-sm-12 col-xs-12">
				<a href="<?php echo esc_url( $buttonurl );?>" class="grid-fill-btn"><span><?php echo esc_html( $buttontext );?></span></a>
			</div>
		<?php } ?>
		<?php wp_reset_query();?>
		<?php } else { ?>
			<div class="<?php echo esc_attr( $col_class ); ?>">
				<?php esc_html_e( 'No Project Found' , 'greenova-core' ); ?>
			</div>
		<?php } ?>
	</div>
</div>