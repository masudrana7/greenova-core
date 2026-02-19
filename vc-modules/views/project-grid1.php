<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */
// phpcs:disable WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
if ( ! defined( 'ABSPATH' ) ) exit;

$thumb_size = 'greenova-size7';
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
<div class="tlp-portfolio">
	<div class="our-projects2-area project-gallery1-area tlp-portfolio-isotope isotope9 even-grid" id="inner-isotope">
		<div class="row">
		<?php if ($showtitle == 'true') { ?>
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
				<div class="our-projects2-title">
					<h2 class="title"><?php echo esc_html ($sectiontitle); ?></h2>
					<p class="sub-title"><?php echo esc_html ($sectionsubtitle); ?></p>
				</div>
			</div>
			<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<?php } else { ?>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<?php } ?>
				<div class="rt-portfolio-tab isotop-classes-tab myisotop1" style="text-align:<?php echo esc_attr($align_filter_btn); ?>;">
					 
					<a href="#" data-filter="*" class="current"><?php esc_html_e( 'All' , 'greenova-core' ); ?></a>
					<?php foreach ( $cats as $key => $value): ?>
						<a href="#" data-filter=".<?php echo esc_attr( $key );?>"><?php echo esc_html( $value );?></a>
					<?php endforeach; ?>
					
				</div>
			</div>
		</div>
			<div class="row featuredContainer">		
			<?php if ( $query->have_posts() ) { ?>
				<?php while ( $query->have_posts() ) : $query->the_post(); 
					$content = get_the_content();
					$content = apply_filters( 'the_content', $content );
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
							$thumbnail = '<img class="attachment-greenova-size5 size-greenova-size5 wp-post-image" src="'.GREENOVA_IMG_URL.'noimage_362X234.jpg" alt="'.get_the_title().'">';
						}
					}
					$terms = get_the_terms( get_the_ID(), 'greenova_project_category' );
				?>
				<?php
					if ( $terms && ! is_wp_error( $terms ) ) : 
						$term_links = array(); 
						foreach ( $terms as $term ) {
							$term_links[] = $term->slug;
						}
						$term_list = join( " ", $term_links );
					endif;
				?>			 
				<div class="tlp-portfolio-item <?php echo esc_attr( $col_class );?> project1-box <?php if ( !empty($term_list) ) { echo esc_html( $term_list ); } ?>">
					<figure>
						<?php if ( $showlink == 'true' ) { ?>
						<a href="<?php the_permalink(); ?>"><?php echo wp_kses_post( $thumbnail ); ?></a>
						<?php } else { ?>
						<?php echo wp_kses_post( $thumbnail ); ?>
						<?php } ?>
						<div class="tlp-overlay">
							<div class="item-info">
								<?php if ( $showlink == 'true' ) { ?>
								<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
								<?php } else { ?>
								<h3><?php the_title(); ?></h3>
								<?php } ?>
								<div class="line"></div>
								<p><?php echo wp_kses_post( $content ); ?></p>
								<p class="link-icon">
									<a class="tlp-single-item-popup" href="<?php the_permalink(); ?>"><i class="fa fa-info"></i></a>
								</p>
							</div>
						</div>
					</figure>
				</div>
				
				<?php endwhile;?>
				<?php if ( $show_pagination == 'true' ) { ?>
				<div class="mt20 col-sm-12 col-xs-12 pagination-wrapper"><?php GREENOVA_Theme_Helper::pagination();?></div>
				<?php } ?>
				<?php wp_reset_query();?>
				<?php } else { ?>
					<div class="<?php echo esc_attr( $col_class ); ?>">
						<?php esc_html_e( 'No Project Found' , 'greenova-core' ); ?>
					</div>
				<?php } ?>			
			</div>
		</div>
	</div>
</div>