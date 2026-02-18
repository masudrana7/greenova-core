<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

class GREENOVA_Theme_Download_Link extends WP_Widget {
	
	public function __construct() {
		$widget_ops = array(
			'classname' => 'rt_widget_download',
			'description' => esc_html__( 'Display Text With button' , 'greenova-core' ),
			'customize_selective_refresh' => true,
		);
		parent::__construct( 'rt-widget-download', esc_html__( 'Greenova: Download Link' , 'greenova-core' ), $widget_ops );
	}
	
	public function widget( $args, $instance ){
		echo wp_kses_post( $args['before_widget'] );		
		?>		
		<?php if( !empty( $instance['btn_text'] ) ) { ?>
		<a href="<?php echo esc_url( $instance['button_url'] ); ?>" download><i class="fa fa-file-pdf-o" aria-hidden="true"></i><?php if( !empty( $instance['btn_text'] ) ) echo wp_kses_post( $instance['btn_text'] ); ?></a>
		<?php } 
		echo wp_kses_post( $args['after_widget'] );
	}

	public function update( $new_instance, $old_instance ){
		$instance                  = array();		
		$instance['btn_text'] = ( ! empty( $new_instance['btn_text'] ) ) ? wp_kses_post( $new_instance['btn_text'] ) : '';
		$instance['button_url'] = ( ! empty( $new_instance['button_url'] ) ) ? wp_kses_post( $new_instance['button_url'] ) : '';
		return $instance;
	}

	public function form( $instance ){
		$defaults = array(
			'btn_text'	=> '',
			'button_url'	=> '',
		);
		$instance = wp_parse_args( (array) $instance, $defaults );

		$fields = array(
			'btn_text' => array(
				'label'   => esc_html__( 'Button Text', 'greenova-core' ),
				'type'    => 'text',
			),
			'button_url'   => array(
				'label'   => esc_html__( 'Download URL', 'greenova-core' ),
				'type'    => 'url',
			),
		);

		RT_Widget_Fields::display( $fields, $instance, $this );
	}
}