<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

class GREENOVA_Theme_Address_Widget extends WP_Widget {
	public function __construct() {
		parent::__construct(
            'greenova_address', // Base ID
            esc_html__( 'Greenova : Address (for footer)', 'greenova-core' ), // Name
            array( 'description' => esc_html__( 'Address Widget', 'greenova-core' ) ) // Args
            );
	}

	public function widget( $args, $instance ){
		echo wp_kses_post( $args['before_widget'] );
		if ( ! empty( $instance['title'] ) ) {
			echo wp_kses_post( $args['before_title'] ) . esc_html( apply_filters( 'widget_title', $instance['title'] ) ) . wp_kses_post( $args['after_title'] );
		}
		?>
		<ul class="corporate-address">
			<?php 
			if( !empty( $instance['weekday'] ) ){
				?><li class="weekday"><i class="far fa-clock" aria-hidden="true"></i><?php echo esc_html( $instance['weekday'] ); ?></li><?php
			}
			if( !empty( $instance['address'] ) ){
				?><li class="address"><i class="fas fa-map-marker-alt" aria-hidden="true"></i><?php echo esc_html( $instance['address'] ); ?></li><?php
			}  
			if( !empty( $instance['phone'] ) ){
				?><li class="phone"><i class="fas fa-phone-alt" aria-hidden="true"></i> <a href="tel:<?php echo esc_attr( $instance['phone'] ); ?>"><?php echo esc_html( $instance['phone'] ); ?></a></li><?php
			}   
			if( !empty( $instance['email'] ) ){
				?><li class="mail"><i class="far fa-envelope" aria-hidden="true"></i> <a href="mailto:<?php echo esc_attr( $instance['email'] ); ?>"><?php echo esc_html( $instance['email'] ); ?></a></li><?php
			}  
			if( !empty( $instance['fax'] ) ){
				?><li class="fax"><i class="fa fa-fax" aria-hidden="true"></i> <?php echo esc_html( $instance['fax'] ); ?></li><?php
			}   
			?>
		</ul>
		<?php
		echo wp_kses_post( $args['after_widget'] );
	}

	public function update( $new_instance, $old_instance ){
		$instance              = array();
		$instance['title']     = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';
		$instance['weekday']   = ( ! empty( $new_instance['weekday'] ) ) ? sanitize_text_field( $new_instance['weekday'] ) : '';
		$instance['address']   = ( ! empty( $new_instance['address'] ) ) ? sanitize_text_field( $new_instance['address'] ) : '';
		$instance['phone']     = ( ! empty( $new_instance['phone'] ) ) ? sanitize_text_field( $new_instance['phone'] ) : '';
		$instance['email']     = ( ! empty( $new_instance['email'] ) ) ? sanitize_email( $new_instance['email'] ) : '';
		$instance['fax']       = ( ! empty( $new_instance['fax'] ) ) ? sanitize_text_field( $new_instance['fax'] ) : '';
		return $instance;
	}

	public function form( $instance ){
		$defaults = array(
			'title'   => esc_html__( 'Corporate Office' , 'greenova-core' ),
			'weekday' => '',
			'address' => '',
			'phone'   => '',
			'email'   => '',
			'fax'     => ''  
			);
		$instance = wp_parse_args( (array) $instance, $defaults );

		$fields = array(
			'title'     => array(
				'label' => esc_html__( 'Title', 'greenova-core' ),
				'type'  => 'text',
				),
			'weekday'   => array(
				'label' => esc_html__( 'Working Time', 'greenova-core' ),
				'type'  => 'text',
				),
			'address'   => array(
				'label' => esc_html__( 'Address', 'greenova-core' ),
				'type'  => 'text',
				),      
			'phone'     => array(
				'label' => esc_html__( 'Phone Number', 'greenova-core' ),
				'type'  => 'text',
				),      
			'email'     => array(
				'label' => esc_html__( 'Email', 'greenova-core' ),
				'type'  => 'text',
				),      
			'fax'       => array(
				'label' => esc_html__( 'Fax', 'greenova-core' ),
				'type'  => 'text',
				),
			);

		RT_Widget_Fields::display( $fields, $instance, $this );
	}
}