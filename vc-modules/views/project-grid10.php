<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */


$thumb_size = 'greenova-size17';
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

if ( !empty( $cat ) ) {
	$args['tax_query'] = array(
		array(
			'taxonomy' => 'greenova_project_category',
			'field'    => 'term_id',
			'terms'    => $cat,
		),
	);
}

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
<div class="our-projects2-area rt-project-gallery-10">
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
					$thumbnail = '<img class="attachment-greenova-size5 size-greenova-size5 wp-post-image" src="'.GREENOVA_IMG_URL.'noimage_900X600.jpg" alt="'.get_the_title().'">';
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
		
		<div class="<?php echo esc_attr( $col_class );?> project10-box <?php if ( !empty( $term_list ) ){ echo esc_html( $term_list ); } ?>">
			<div class="project10-box-inner">
				<div class="project10-img-holder">
				<?php if ( $showlink == 'true' ) { ?>
					<?php echo wp_kses_post( $thumbnail ); ?>
				<?php } else { ?>
					<?php echo wp_kses_post( $thumbnail ); ?>
				<?php } ?>
				<?php if ( $showlink == 'true' ) { ?>
				<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
				<?php } else { ?>
				<h3><?php the_title(); ?></h3>
				<?php } ?>
				</div>
				<div class="rtin-proj10-box-info">
					<div class="content-wrap">
					<?php if ( $showlink == 'true' ) { ?>
					<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
					<?php } else { ?>
					<h3><?php the_title(); ?></h3>
					<?php } ?>
					<p><?php echo wp_kses_post( $content ); ?></p>
					<a class="grid10-btn" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read More' , 'greenova-core' ); ?></a>
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