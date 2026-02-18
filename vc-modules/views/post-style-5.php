<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

$thumb_size = 'greenova-size8';
$args = array(
	'posts_per_page' 	  => $slider_item_number,	
	'ignore_sticky_posts' => 1,
	'cat'       		  => $cat,
	'orderby'		 	  => $orderby,
	'order'			 	  => $order,
	);
$query = new WP_Query( $args );
$slider_nav_class = ( $slider_nav == 'true' ) ? ' slider-nav-enabled' : '';
$slider_dot_class = ( $slider_dots == 'true' ) ? ' slider-dot-enabled' : '';
 
$greenova_has_entry_meta  = ( ( !has_post_thumbnail() && GREENOVA_Theme::$options['blog_date'] ) || GREENOVA_Theme::$options['blog_author_name'] || GREENOVA_Theme::$options['blog_comment_num'] || GREENOVA_Theme::$options['blog_cats'] ) ? true : false;
$greenova_time_html       = sprintf( '%s <span>%s</span>,<span> %s</span>',get_the_time( 'M' ), get_the_time( 'd' ), get_the_time( 'Y' ) );
$greenova_time_html       = apply_filters( 'greenova_single_time', $greenova_time_html );
$greenova_time_html_2     = apply_filters( 'greenova_single_time_no_thumb', get_the_time( get_option( 'date_format' ) ) );

$greenova_comments_number = number_format_i18n( get_comments_number() );
$greenova_comments_html = $greenova_comments_number < 2 ? esc_html__( 'Comment' , 'greenova-core' ) : esc_html__( 'Comments' , 'greenova-core' );
$greenova_comments_html = '('. $greenova_comments_number . ') ' . $greenova_comments_html;

$thumbnail = false;

?>
<div class="rt-post-vc-section-5 owl-wrap rt-owl-nav-3 <?php echo esc_attr( $slider_dot_class );?><?php echo esc_attr( $slider_nav_class );?>">
	<?php if ( $showtitle == 'true' ){ ?>
		<div class="section-heading">
			<div class="section-title-content">
				<h2 class="title" style="color:<?php echo esc_attr( $section_title_color ); ?>;"><?php echo wp_kses_post( $title );?></h2>
				<p class="sub-title"><?php echo wp_kses_post( $subtitle );?></p>
			</div>
			<div class="owl-custom-nav owl-nav">
				<div class="owl-prev"><i class="fa fa-angle-left"></i></div><div class="owl-next"><i class="fa fa-angle-right"></i></div>
			</div>
			<div class="owl-custom-nav-bar"></div>
			<div class="clear"></div>
		</div>	
	<?php } ?>
	<div class="owl-theme owl-carousel rt-owl-carousel" data-carousel-options="<?php echo esc_attr( $owl_data );?>">
	<?php if ( $query->have_posts() )  { ?>
		<?php while ( $query->have_posts() ) : $query->the_post();?>
		<?php		
			$id = get_the_ID();
			$content = get_the_content();
			$content = apply_filters( 'the_content', $content );
			$content = wp_trim_words( $content, $count, '' );
			
			$thumbnail = false;
			if ( has_post_thumbnail() ){
				$thumbnail = get_the_post_thumbnail( null, $thumb_size );
			}
			else {
				if ( !empty( GREENOVA_Theme::$options['no_preview_image']['id'] ) ) {
					$thumbnail = wp_get_attachment_image( GREENOVA_Theme::$options['no_preview_image']['id'], $thumb_size );
				}
				elseif ( !empty( GREENOVA_Theme::$options['no_preview_image']['url'] ) ) {
					$thumbnail = '<img class="attachment-greenova-size5 size-greenova-size5 wp-post-image" src="'.GREENOVA_IMG_URL.'noimage_370x522.jpg" alt="'.get_the_title().'">';
				}
			}
		?>
		<div class="blog-box">
			<div class="blog-img-holder">	
				<?php if ( GREENOVA_Theme::$options['blog_date'] ) { ?>
					<div class="blog-content-holder"><span><?php echo wp_kses_post( $greenova_time_html );?></span></div>
				<?php } ?>
				<a href="<?php the_permalink(); ?>">
				<?php if ( has_post_thumbnail() ) { ?>
					<?php the_post_thumbnail( 'greenova-size2', ['class' => 'img-resfponsive'] );?>
				<?php } else {
					if ( !empty( GREENOVA_Theme::$options['no_preview_image']['id'] ) ) {
						$thumbnail = wp_get_attachment_image( GREENOVA_Theme::$options['no_preview_image']['id'], $thumb_size );
					}
					elseif ( !empty( GREENOVA_Theme::$options['no_preview_image']['url'] ) ) {
						$thumbnail = '<img class="attachment-greenova-size5 size-greenova-size5 wp-post-image" src="'.GREENOVA_IMG_URL.'noimage_370X270.jpg" alt="'.get_the_title().'">';
					}
					echo wp_kses_post( $thumbnail );
				} ?></a>
			</div>
			<div class="blog-bottom-content-holder">
				<h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
				<ul>
					<?php if ( GREENOVA_Theme::$options['blog_author_name'] ) { ?>
					<li class="green-author"><i class="fa fa-user" aria-hidden="true"></i><?php _e( '<span> By </span>', 'greenova-core' ) . the_author_posts_link();?></li>
					<?php } if ( GREENOVA_Theme::$options['blog_comment_num'] ) { ?>
					<li><i class="far fa-comment" aria-hidden="true"></i><a href="<?php echo get_comments_link( get_the_ID() ); ?>"> <?php echo esc_html( $greenova_comments_html );?></a></li>
					<?php } ?>
				</ul>
				<p><?php echo wp_kses_post( $content ); ?></p>
			</div>
		</div>
		<?php endwhile;?>
		<?php wp_reset_query();?>
		<?php } else { ?>
			<div class="rtin-single-team">
				<?php esc_html_e( 'No Project Found' , 'greenova-core' ); ?>
			</div>
		<?php } ?>
	</div>
</div>