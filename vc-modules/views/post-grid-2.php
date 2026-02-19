<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */
// phpcs:disable WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
if ( ! defined( 'ABSPATH' ) ) exit;

$thumb_size = 'greenova-size17';
$args = array(
	'posts_per_page' => $grid_item_number,
	'ignore_sticky_posts' => 1,
	'cat'       => $cat,
	'orderby'		 => $orderby,
	'order'			 => $order,
	);
	
$query = new WP_Query( $args );
$col_class = "col-lg-$col_lg col-md-$col_md col-sm-$col_sm col-xs-$col_xs";

?>
<div class="rt-post-vc-grid-2">
	<div class="row">
	<?php if ( $query->have_posts() ) { ?>
		<?php while ( $query->have_posts() ) : $query->the_post();?>
			<?php
				$id = get_the_ID();
				$content = get_the_content();
				$content = apply_filters( 'the_content', $content );
				$content = wp_trim_words( $content, $count, '' );
				$thumbnail = false;
				if ( has_post_thumbnail() ){
					$thumbnail = get_the_post_thumbnail( null, $thumb_size, array( 'class' => 'img-responsive' ) );
				}
				else {
					if ( !empty( GREENOVA_Theme::$options['no_preview_image']['url'] ) ) {
						$thumbnail = '<img class="img-responsive attachment-greenova-size5 size-greenova-size5 wp-post-image" src="'.GREENOVA_IMG_URL.'noimage_900X700.jpg" alt="'.get_the_title().'">';
					}
				}

				$comments_count = wp_count_comments( $id );
				$message =  $comments_count->approved ;
			?>
			<div class="<?php echo esc_attr( $col_class );?>">
				<div class="rtin-single-post">
					<div class="rtin-item-image">
						<a href="<?php the_permalink(); ?>">
							<?php echo wp_kses_post( $thumbnail ); ?>
						</a>
						<span class="date"><?php echo get_the_date(); ?></span>
					</div>
					<div class="rtin-item-info">
						<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						<p><?php echo wp_kses_post( $content ); ?></p>
						<?php if ( $showcomment == 'true' ){ ?>
						<span class="comments"><i class="far fa-comments" aria-hidden="true"></i>
							<?php esc_html_e( 'Comments' , 'greenova-core' ); ?>: <?php echo esc_html ( $message ); ?>
						</span>
						<?php } ?>
					</div>
				</div>
			</div>
		<?php endwhile;?>
		<?php if ( $show_button == 'true' ) { ?>
			<div class="rt-grid-fill-btn col-sm-12 col-xs-12">
				<a href="<?php echo esc_url( $buttonurl );?>" class="grid-fill-btn"><span><?php echo esc_html( $buttontext );?></span></a>
			</div>
		<?php } ?>
	<?php } else { ?>
		<div class="rtin-single-post">
			<?php esc_html_e( 'No Post Found' , 'greenova-core' ); ?>
		</div>
	<?php } ?>
	<?php wp_reset_query();?>
	</div>
</div>