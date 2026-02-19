<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */
if ( ! defined( 'ABSPATH' ) ) exit;

$thumb_size = 'greenova-size5';
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
<div class="rt-post-vc-grid-3">
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
						$thumbnail = '<img class="img-responsive attachment-greenova-size5 size-greenova-size5 wp-post-image" src="'.GREENOVA_IMG_URL.'noimage_370X370.jpg" alt="'.get_the_title().'">';
					}
				}

				$comments_count = wp_count_comments( $id );
				$message =  $comments_count->approved ;
				$greenova_comments_number = number_format_i18n( get_comments_number() );
				$greenova_comments_html = $greenova_comments_number < 2 ? esc_html__( 'Comment' , 'greenova-core' ) : esc_html__( 'Comments' , 'greenova-core' );
				$greenova_comments_html = $greenova_comments_number . ' ' . $greenova_comments_html;
				
				$greenova_date = sprintf( '<span class="day">%s</span><span class="month">%s</span>', get_the_time( 'd' ), get_the_time( 'M' ) );

			?>
			<div class="<?php echo esc_attr( $col_class );?>">
				<div class="media rtin-single-post">
					<div class="media-left rtin-item-image">
						<a href="<?php the_permalink(); ?>">
							<?php echo wp_kses_post( $thumbnail ); ?>
						</a>
						<span class="date"><?php echo wp_kses_post( $greenova_date ); ?></span>
						
						
					</div>
					<div class="media-body rtin-item-info">
						<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						<span class="user"><i class="fa fa-user" aria-hidden="true"></i><?php esc_html_e( 'by ' , 'greenova-core' ); ?><?php the_author_posts_link(); ?>
						</span>
						<?php if ( $showcomment == 'true' ){ ?>
						<span class="comments"><i class="far fa-comments" aria-hidden="true"></i>
							<a href="<?php echo esc_url( get_comments_link( get_the_ID() ) ); ?>"><?php echo esc_html( $greenova_comments_html );?></a>
						</span>
						<?php } ?>
						<p><?php echo wp_kses_post( $content ); ?></p>
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