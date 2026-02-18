<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

class GREENOVA_Theme_CTA_Widget extends WP_Widget {
	
	public function __construct() {
		$widget_ops = array(
			'classname' => 'rt_widget_cta',
			'description' => esc_html__( 'Display Text With button' , 'greenova-core' ),
			'customize_selective_refresh' => true,
		);
		parent::__construct( 'rt-widget-cta', esc_html__( 'Greenova: Call To Action' , 'greenova-core' ), $widget_ops );
	}
	
	public function widget( $args, $instance ){
		echo wp_kses_post( $args['before_widget'] );

		if ( !empty( $instance['bg_image'] ) ) {
			$html = wp_get_attachment_image_src( $instance['bg_image'], 'full' );
			$html = $html[0];
			$html = '<img src="' . esc_url( $html ) . '" alt="' . esc_attr( $html ) . '">';
		}
		elseif ( !empty( $instance['title'] ) ) {
			$html = apply_filters( 'widget_title', $instance['title'] );
			$html = $args['before_title'] . esc_html ( $html ) .$args['after_title'];
		}
		else {
			$html = '';
		}

		echo wp_kses_post( $html );
		?>
		<p class="rtin-des"><?php if( !empty( $instance['text'] ) ) echo wp_kses_post( $instance['text'] ); ?></p>		
		<?php if( !empty( $instance['button_text'] ) ) { ?>
		<a href="<?php echo esc_url( $instance['button_url'] ); ?>" class="slider-dark-button"><span><?php if( !empty( $instance['button_text'] ) ) echo wp_kses_post( $instance['button_text'] ); ?></span></a>
		<?php } ?>
		<?php
		echo wp_kses_post( $args['after_widget'] );
	}

	public function update( $new_instance, $old_instance ){
		$instance                  = array();		
		$instance['bg_image']      = ( ! empty( $new_instance['bg_image'] ) ) ? sanitize_text_field( $new_instance['bg_image'] ) : '';
		$instance['text']   	   = ( ! empty( $new_instance['text'] ) ) ? wp_kses_post( $new_instance['text'] ) : '';
		$instance['button_text']  = ( ! empty( $new_instance['button_text'] ) ) ? sanitize_text_field( $new_instance['button_text'] ) : '';
		$instance['button_url']   = ( ! empty( $new_instance['button_url'] ) ) ? sanitize_text_field( $new_instance['button_url'] ) : '';
		return $instance;
	}

	public function form( $instance ){
		$defaults = array(			
			'bg_image'		=> '',
			'text' 			=> '',
			'button_text'	=> '',
			'button_url'	=> '',
		);
		$instance = wp_parse_args( (array) $instance, $defaults );

		$fields = array(
			'bg_image'        => array(
				'label'   => esc_html__( 'Background Image', 'greenova-core' ),
				'type'    => 'image',
			),
			'text' => array(
				'label'   => esc_html__( 'Title Text', 'greenova-core' ),
				'type'    => 'text',
			),
			'button_text' => array(
				'label'   => esc_html__( 'Button Text', 'greenova-core' ),
				'type'    => 'text',
			),
			'button_url'   => array(
				'label'   => esc_html__( 'Button URL', 'greenova-core' ),
				'type'    => 'url',
			),
		);

		RT_Widget_Fields::display( $fields, $instance, $this );
	}
}