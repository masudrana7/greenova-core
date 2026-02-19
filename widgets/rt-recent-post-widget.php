<?php 
/**
* Widget API: Recent Post Widget class
* By : Radius Theme
*/
Class GREENOVA_Theme_Recent_Posts_With_Image_Widget extends WP_Widget {
	public function __construct() {
		$widget_ops = array(
			'classname' => 'rt_widget_recent_entries_with_image',
			'description' => esc_html__( 'Your site&#8217;s most recent Posts with Image.' , 'greenova-core' ),
			'customize_selective_refresh' => true,
		);
		parent::__construct( 'rt-recent-posts', esc_html__( 'Greenova : Recent Posts' , 'greenova-core' ), $widget_ops );
		$this->alt_option_name = 'rt_widget_recent_entries';
	}
	public function widget( $args, $instance ) {
		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}
		
		$args['before_title']='<h3 class="widgettitle">';
		$args['after_title']='</h3>';
		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : esc_html__( 'Recent Posts' , 'greenova-core' );		
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
		if ( ! $number )
			$number = 5;
		$show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : false;
		$result_query = new WP_Query( apply_filters( 'widget_posts_args', array(
			'posts_per_page'      => $number,
			'no_found_rows'       => true,
			'post_status'         => 'publish',
			'ignore_sticky_posts' => true
		) ) );
		if ($result_query->have_posts()) :
		?>
		<?php echo wp_kses_post($args['before_widget']); ?>
		<?php if ( $title ) {
			echo wp_kses_post($args['before_title']) . esc_html( $title ) . wp_kses_post($args['after_title']);
		} ?>
		<?php while ( $result_query->have_posts() ) : $result_query->the_post();		
			$id = get_the_ID();
			
			$thumbnail = false;
			if ( has_post_thumbnail() ){
				$thumbnail = get_the_post_thumbnail( $id, 'greenova-size3', array ( 'class' => 'media-object' ) );
			}
		?>
			<div class="media single-post">
				<div class="pull-left">
					<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">					
						<?php echo wp_kses_post( $thumbnail ); ?>
					</a>
				</div>
				<div class="media-body">					
					<?php if ( $show_date ) { ?>
					<div class="posted-date"><?php echo get_the_date(); ?></div>
					<?php } ?>
					<h4><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>
				</div>
			</div>
		<?php endwhile; ?>		
		<?php echo wp_kses_post($args['after_widget']); ?>
		<?php
		wp_reset_postdata();
		endif;
	}

	public function update( $new_instance, $old_instance ) {
		$instance 				= $old_instance;
		$instance['title'] 		= sanitize_text_field( $new_instance['title'] );
		$instance['number'] 	= (int) $new_instance['number'];
		$instance['show_date']  = isset( $new_instance['show_date'] ) ? (bool) $new_instance['show_date'] : false;
		return $instance;
	}
	
	public function form( $instance ){
		$defaults = array(
			'title'         => esc_html__( 'Latest Post' , 'greenova-core' ),
			'number'		=> '5',
			'show_date'		=> true,
			);
		$instance = wp_parse_args( (array) $instance, $defaults );

		$fields = array(
			'title'			=> array(
				'label'		=> esc_html__( 'Title', 'greenova-core' ),
				'type'		=> 'text',
				),
			'number'        => array(
				'label'		=> esc_html__( 'Number of posts to show', 'greenova-core' ),
				'type'      => 'number',
				),
			'show_date'		=> array(
				'label'		=> esc_html__( 'Display post date?', 'greenova-core' ),
				'type'      => 'checkbox',
				),
			);
		
		RT_Widget_Fields::display( $fields, $instance, $this );
	}		
}