<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */
if ( ! defined( 'ABSPATH' ) ) exit;

$thumb_size = 'greenova-size10';
$count=1;
$orderby = 'meta_value_num';
$meta_query  = WC()->query->get_meta_query();
$meta_query[] = array(
    'key'   => 'total_sales',
);
$args = array(
	'post_type'           => 'product',
	'post_status'         => 'publish',
	'ignore_sticky_posts' => 1,
	'posts_per_page'      => $slider_item_number,
	'orderby'	  		  => $orderby,
	'order'		  		  => $order,
	'meta_query'          => $meta_query,
);

$query = new WP_Query( $args );

$slider_dots_class = ( $slider_dots == 'true' ) ? ' slider-dot-enabled' : '';
?>
<div class="rt-product-slider-2 rt-product-slider woocommerce owl-wrap rt-owl-nav-3 <?php echo esc_attr( $slider_dots_class );?>">	
	<?php if ( $showtitle == 'true' ) { ?>
	<div class="section-title-content">		
		<div class="section-title">
			<h2 class="section-title-holder" style="color:<?php echo esc_attr( $section_title_color ); ?>;"><?php echo wp_kses_post( $title );?></h2>
		</div>		
		<div class="owl-custom-nav owl-nav">
			<div class="owl-prev"><i class="fa fa-angle-left"></i></div><div class="owl-next"><i class="fa fa-angle-right"></i></div>
		</div>
		<div class="owl-custom-nav-bar"></div>
		<div class="clear"></div>
	</div>
	<?php } ?>
	<div class="owl-theme owl-carousel rt-owl-carousel" data-carousel-options="<?php echo esc_attr( $owl_data );?>">
	<ul class="popular-slider2-wrapper auto-clear">
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
				
				$greenova_event_end_date = get_post_meta( get_the_ID(), '_sale_price_dates_to', true );
			?>

			<li class="col-lg-4 col-md-6 col-sm-6 col-xs-12 popular-product-single tab-fix">
				<div class="media">
					<a class="product-img pull-left" href="<?php the_permalink(); ?>">
						<?php echo wp_kses_post( $thumbnail ); ?>
					</a>
					<div class="media-body">
						<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						<?php if ( $showrating == 'true' ) { ?>
						<div class="star-rating">
							<span style="width:<?php echo esc_attr( ( ( $average / 5 ) * 100 ) ); ?>%"><strong itemprop="ratingValue" class="rating"><?php echo esc_html( $average ); ?></strong> <?php echo esc_html( __( 'out of 5', 'greenova-core' )); ?></span>
						</div>
						<?php } ?>
						<?php if ( $showprice == 'true' ) { ?>
							<span class="price"><?php echo $product->get_price_html(); ?></span>
						<?php } ?>
						<div class="rt-product-buttons">
							<!--add to cart-->
							<div class="button">
								<form action="<?php echo esc_url( $product->add_to_cart_url() ); ?>" class="cart" method="post" enctype='multipart/form-data'>
									<button style="color:<?php echo esc_attr( $button_color ); ?>" type="submit" data-quantity="1" data-product_id="<?php echo $product->get_id(); ?>"
										class="button alt ajax_add_to_cart add_to_cart_button product_type_simple"><i aria-hidden="true" class="flaticon-green-shopping-cart"></i>
										<?php //echo esc_html ( $label ); ?>
									</button>
								</form>
							</div>
							<!--compare-->
							<!--wishlist-->
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
							<div class="wishlist"><?php echo YITH_WCWL_Shortcode::add_to_wishlist( $args );?></div>
							<?php } ?>
							
						</div>
					</div>
				</div>
			</li>
			
			<?php 
			if (($count % 6) == 0){ ?>
				</ul> 
				<?php if ( $query->current_post + 1 < $query->post_count ) { ?>
				<ul class="popular-slider2-wrapper auto-clear">
			<?php }
				}
			 $count++; ?>
		<?php endwhile;?>
	<?php } else { ?>
		<div class="rtin-single-post">
			<?php esc_html_e( 'No Product Found' , 'greenova-core' ); ?>
		</div>
	<?php } ?>
	<?php wp_reset_query();?>
	</div>
</div>