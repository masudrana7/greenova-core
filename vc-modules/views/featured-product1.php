<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */
// phpcs:disable WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound, WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound
if ( ! defined( 'ABSPATH' ) ) exit;

$thumb_size = 'greenova-size9';
if ( get_query_var('paged') ) {
	$paged = get_query_var('paged');
}
elseif ( get_query_var('page') ) {
	$paged = get_query_var('page');
}
else {
	$paged = 1;
}

$meta_query  = WC()->query->get_meta_query();
$tax_query   = WC()->query->get_tax_query();
$tax_query[] = array(
	'taxonomy' => 'product_visibility',
	'field'    => 'name',
	'terms'    => 'featured',
	'operator' => 'IN',
);

$args = array(
	'post_type'           => 'product',
	'post_status'         => 'publish',
	'ignore_sticky_posts' => 1,
	'posts_per_page'      => $grid_item_number,
	'orderby'	  		  => $orderby,
	'order'		  		  => $order,
	'meta_query'          => $meta_query,
	'tax_query'           => $tax_query,
);

$query = new WP_Query( $args );

$posts = get_posts( $args );

$gallery = array();
$cats    = array();

foreach ( $posts as $post ) {
    $terms = get_the_terms( $post, 'product_cat' );
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
<div class="rt-featured-product-isotope rt-product-slider-1 rt-product-slider woocommerce row" id="inner-isotope">
	<div class="container">
		<div class="row">
			<?php if ($showtitle == 'true') { ?>
				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
					<div class="featured-product-title">
						<h2><?php echo esc_html ($sectiontitle); ?></h2>
					</div>
				</div>
				<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<?php } else { ?>
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<?php } ?>			
					<div class="rt-portfolio-tab isotop-classes-tab myisotop111">
						 
						<a href="#" data-filter="*" class="current"><?php esc_html_e( 'All' , 'greenova-core' ); ?></a>
						<?php foreach ( $cats as $key => $value): ?>
							<a href="#" data-filter=".<?php echo esc_attr( $key );?>"><?php echo esc_html( $value );?></a>
						<?php endforeach; ?>
						
					</div>
				</div>
		</div><!-- end of row -->
			
		<div class="row featuredContainerrr">
			<?php if ( $query->have_posts() ) { ?>
				<?php while ( $query->have_posts() ) : $query->the_post();?>
					<?php
						$id = get_the_ID();
						$thumbnail = false;
						if ( has_post_thumbnail() ){
							$thumbnail = get_the_post_thumbnail( null, $thumb_size, array( 'class' => 'img-responsive' ) );
						}
						else {
							if ( !empty( GREENOVA_Theme::$options['no_preview_image']['url'] ) ) {
								$thumbnail = '<img class="img-responsive attachment-greenova-size5 size-greenova-size5 wp-post-image" src="'.GREENOVA_IMG_URL.'no-image-278x376.jpg" alt="'.get_the_title().'">';
							}
						}
						
						global $woocommerce, $product;
						$currency = get_woocommerce_currency_symbol();
						$price = get_post_meta( get_the_ID(), '_regular_price', true);
						$sale = get_post_meta( get_the_ID(), '_sale_price', true);
						$average = $product->get_average_rating();
						$link   = esc_url( $product->add_to_cart_url() );
						$label  = apply_filters('add_to_cart_text', __('Add to cart', 'greenova-core'));
						
						$sale_price_date = get_post_meta( get_the_ID(), '_sale_price_dates_to', true );
						$terms = get_the_terms( get_the_ID(), 'product_cat' );
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
					
					<div class="rtin-single-sale-prod <?php if ( !empty( $term_list ) ) { echo esc_html( $term_list ); } ?> <?php echo esc_attr($col_class); ?>">
					
						<div class="rtin-item-image">
							<a href="<?php the_permalink(); ?>">
								<?php echo wp_kses_post( $thumbnail ); ?>
							</a>
							<div class="prod-meta-holder">
								<?php if( !empty( $sale ) ) {  ?>
									<span class="prod-sale"><?php esc_html_e( 'Sale' , 'greenova-core' ); ?></span>
								<?php }?>
								<?php rt_is_new( get_the_ID() ); ?>
							</div>
						</div>
						
						<div class="rtin-item-info">
							<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						</div>
						<?php if ( $showrating == 'true' ) { ?>
						<div class="star-rating">
							<span style="width:<?php echo esc_attr( ( ( $average / 5 ) * 100 ) ); ?>%"><strong itemprop="ratingValue" class="rating"><?php echo esc_html( $average ); ?></strong> <?php echo esc_html( __( 'out of 5', 'greenova-core' )); ?></span>
						</div>
						<?php } ?>
						<?php if ( $showprice == 'true' ) { ?>
						<div class="price"><?php echo wp_kses_post( $product->get_price_html() ); ?></div>
						<?php } ?>
						<div class="single-part">
							<div class="button">
							<form action="<?php echo esc_url( $product->add_to_cart_url() ); ?>" class="cart" method="post" enctype='multipart/form-data'>
								<button style="color:<?php echo esc_attr( $button_color ); ?>" type="submit" data-quantity="1" data-product_id="<?php echo esc_attr( $product->get_id() ); ?>"
									class="button alt ajax_add_to_cart add_to_cart_button product_type_simple"><i aria-hidden="true" class="flaticon-green-shopping-cart"></i><?php echo esc_html ( $label ); ?></button>
							</form>
							</div>
							<?php
							if ( class_exists( 'YITH_WCWL_Shortcode' ) && GREENOVA_Theme::$options['wc_wishlist_icon'] ) {
							$args = array(
								'browse_wishlist_text' => '<i class="fa fa-check"></i>',
								'already_in_wishslist_text' => '',
								'product_added_text' => '',
								'icon' => 'fa-heart-o',
								'label' => '',
								'link_classes' => 'add_to_wishlist single_add_to_wishlist alt wishlist-icon',
							);
							?>
							<div class="wishlist"><?php echo wp_kses_post( YITH_WCWL_Shortcode::add_to_wishlist( $args ) );?></div>
							<?php } ?>
							<?php
								if ( class_exists( 'YITH_Woocompare_Frontend' ) ) {
											
									$args = array(
										'button_text' => '<i class="fa fa-check"></i>',
									);
								$w_list = new YITH_Woocompare_Frontend();
								echo wp_kses_post( $w_list->compare_button_sc( '' , '<i class="fa fa-check"></i>' ) );
							?>
							<?php } ?>
						</div>
						
					</div>
					
				<?php endwhile;?>
			<?php } else { ?>
				<div class="rtin-single-post">
					<?php esc_html_e( 'No Product Found' , 'greenova-core' ); ?>
				</div>
			<?php } ?>
			<?php wp_reset_query(); ?>			
		</div>
			
		</div><!-- end of container -->
	</div>
</div>