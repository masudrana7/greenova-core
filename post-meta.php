<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */
// phpcs:disable WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound, WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound
if ( !class_exists( 'RT_Postmeta' ) ) {
	return;
}

$Postmeta = RT_Postmeta::getInstance();

/*-------------------------------------
#. Page Settings
---------------------------------------*/
$nav_menus = wp_get_nav_menus( array( 'fields' => 'id=>name' ) );
$nav_menus = array( 'default' => esc_html( 'Default' ) ) + $nav_menus;

$Postmeta->add_meta_box( 'page_settings', esc_html( 'Layout Settings' ), array( 'page', 'post', 'greenova_project' , 'greenova_team', 'green_testimonial', 'greenova_service' ), '', '', 'high', array(
	'fields' => array(
		'greenova_layout' => array(
			'label'   => esc_html( 'Layout' ),
			'type'    => 'select',
			'options' => array(
				'default'       => esc_html( 'Default' ),
				'full-width'    => esc_html( 'Full Width' ),
				'left-sidebar'  => esc_html( 'Left Sidebar' ),
				'right-sidebar' => esc_html( 'Right Sidebar' ),
				),
			'default'  => 'default',
			),
		'greenova_page_menu' => array(
			'label'    => esc_html( 'Main Menu' ),
			'type'     => 'select',
			'options'  => $nav_menus,
			'default'  => 'default',
			),
		'greenova_tr_header' => array(
			'label'    	  => esc_html( 'Transparent Header' ),
			'type'     	  => 'select',
			'options'  	  => array(
				'default' => esc_html( 'Default' ),
				'on'      => esc_html( 'Enabled' ),
				'off'     => esc_html( 'Disabled' ),
				),
			'default'  => 'default',
			),
		'greenova_top_bar' => array(
			'label' 	  => esc_html( 'Top Bar' ),
			'type'  	  => 'select',
			'options' => array(
				'default' => esc_html( 'Default' ),
				'on'      => esc_html( 'Enabled' ),
				'off'     => esc_html( 'Disabled' ),
				),
			'default'  	  => 'default',
			),
		'greenova_top_bar_style' => array(
			'label' 	=> esc_html( 'Top Bar Layout' ),
			'type'  	=> 'select',
			'options'	=> array(
				'default' => esc_html( 'Default'),
				'1'       => esc_html( 'Layout 1' ),
				'2'       => esc_html( 'Layout 2' ),
				'3'       => esc_html( 'Layout 3' ),
				'4'       => esc_html( 'Layout 4' ),
				'5'       => esc_html( 'Layout 5' ),
				'6'       => esc_html( 'Layout 6' ),
				'7'       => esc_html( 'Layout 7' ),
				'8'       => esc_html( 'Layout 8' ),
				),
			'default'   => 'default',
			),
		'greenova_header' => array(
			'label'   => esc_html( 'Header Layout' ),
			'type'    => 'select',
			'options' => array(
				'default' => esc_html( 'Default' ),
				'1'       => esc_html( 'Layout 1' ),
				'2'       => esc_html( 'Layout 2' ),
				'3'       => esc_html( 'Layout 3' ),
				'4'       => esc_html( 'Layout 4' ),
				'5'       => esc_html( 'Layout 5' ),
				'6'       => esc_html( 'Layout 6' ),
				'10'      => esc_html( 'Layout 7' ),
				'11'      => esc_html( 'Layout 8' ),
				'12'      => esc_html( 'Layout 9' ),
				'9'      => esc_html( 'Layout 10' ),
				'13'      => esc_html( 'Layout 11' ),
				),
			'default'  => 'default',
		),
		'greenova_top_padding' => array(
			'label'   => esc_html( 'Content Padding Top' ),
			'type'    => 'select',
			'options' => array(
				'default' => esc_html( 'Default' ),
				'0px'     => '0px',
				'10px'    => '10px',
				'20px'    => '20px',
				'30px'    => '30px',
				'40px'    => '40px',
				'50px'    => '50px',
				'60px'    => '60px',
				'70px'    => '70px',
				'80px'    => '80px',
				'90px'    => '90px',
				'100px'   => '100px',
				),
			'default'  => 'default',
			),
		'greenova_bottom_padding' => array(
			'label'   => esc_html( 'Content Padding Bottom' ),
			'type'    => 'select',
			'options' => array(
				'default' => esc_html( 'Default' ),
				'0px'     => '0px',
				'10px'    => '10px',
				'20px'    => '20px',
				'30px'    => '30px',
				'40px'    => '40px',
				'50px'    => '50px',
				'60px'    => '60px',
				'70px'    => '70px',
				'80px'    => '80px',
				'90px'    => '90px',
				'100px'   => '100px',
				),
			'default'  => 'default',
			),
		'greenova_banner' => array(
			'label'   => esc_html( 'Banner' ),
			'type'    => 'select',
			'options' => array(
				'default' => esc_html( 'Default' ),
				'on'	  => esc_html( 'Enabled' ),
				'off'	  => esc_html( 'Disabled' ),
				),
			'default'  => 'default',
			),
		'greenova_breadcrumb' => array(
			'label'   => esc_html( 'Breadcrumb' ),
			'type'    => 'select',
			'options' => array(
				'default' => esc_html( 'Default' ),
				'on'      => esc_html( 'Enabled' ),
				'off'	  => esc_html( 'Disabled' ),
				),
			'default'  => 'default',
			),
		'greenova_banner_type' => array(
			'label' => esc_html( 'Banner Background Type' ),
			'type'  => 'select',
			'options' => array(
				'default' => esc_html( 'Default' ),
				'bgimg'    => esc_html( 'Background Image' ),
				'bgcolor'  => esc_html( 'Background Color' ),
				),
			'default' => 'default',
			),
		'greenova_banner_bgimg' => array(
			'label' => esc_html( 'Banner Background Image' ),
			'type'  => 'image',
			'desc'  => esc_html( 'If not selected, default will be used' ),
			),
		'greenova_banner_bgcolor' => array(
			'label' => esc_html( 'Banner Background Color' ),
			'type'  => 'color_picker',
			'desc'  => esc_html( 'If not selected, default will be used' ),
			),
		'greenova_footer' => array(
			'label'   => esc_html( 'Footer Layout' ),
			'type'    => 'select',
			'options' => array(
				'default' => esc_html( 'Default' ),
				'1'       => esc_html( 'Layout 1' ),
				'2'       => esc_html( 'Layout 2' ),
			),
			'default'  => 'default',
		),
		'greenova_footer_top_bar' => array(
			'label' 	  => esc_html( 'Footer Top Bar' ),
			'type'  	  => 'select',
			'options' => array(
				'1' => esc_html( 'Default' ),
				'1'      => esc_html( 'Enabled' ),
				'0'     => esc_html( 'Disabled' ),
				),
			'default'  	  => 'default',
			),			
		),
	) );

/*-------------------------------------
#. Projects
---------------------------------------*/
$Postmeta->add_meta_box( 'project_info', esc_html( 'Project Info' ), array( 'greenova_project' ), '', '', 'high', array(
	'fields' => array(
		'greenova_proj_client' => array(
			'label' => esc_html( 'Client' ),
			'type'  => 'text',
			),
		'greenova_proj_url' => array(
			'label' => esc_html( 'Live Demo' ),
			'type'  => 'text',
			),
		)
	)
);
/*-------------------------------------
#. Team
---------------------------------------*/
$team_socials = array(
	'facebook' => array(
		'label' => esc_html( 'Facebook' ),
		'type'  => 'text',
		'icon'  => 'fa-facebook-f',
		'color' => '#3b5998',
		),
	'twitter' => array(
		'label' => esc_html( 'Twitter' ),
		'type'  => 'text',
		'icon'  => 'fa-twitter',
		'color' => '#1da1f2',
		),
	'linkedin' => array(
		'label' => esc_html( 'Linkedin' ),
		'type'  => 'text',
		'icon'  => 'fa-linkedin-in',
		'color' => '#006fa6',
		),
	'gplus' => array(
		'label' => esc_html( 'Google Plus' ),
		'type'  => 'text',
		'icon'  => 'fa-google-plus-g',
		'color' => '#dd4f43',
		),
	'skype' => array(
		'label' => esc_html( 'Skype' ),
		'type'  => 'text',
		'icon'  => 'fa-skype',
		'color' => '#02B4EB',
		),
	'youtube' => array(
		'label' => esc_html( 'Youtube' ),
		'type'  => 'text',
		'icon'  => 'fa-youtube',
		'color' => '#DD2C28',
		),
	'pinterest' => array(
		'label' => esc_html( 'Pinterest' ),
		'type'  => 'text',
		'icon'  => 'fa-pinterest-p',
		'color' => '#CB1F27',
		),
	'instagram' => array(
		'label' => esc_html( 'Instagram' ),
		'type'  => 'text',
		'icon'  => 'fa-instagram',
		'color' => '#AA3DB2',
		),
	'github' => array(
		'label' => esc_html( 'Github' ),
		'type'  => 'text',
		'icon'  => 'fa-github',
		'color' => '#111',
		),
	'stackoverflow' => array(
		'label' => esc_html( 'Stackoverflow' ),
		'type'  => 'text',
		'icon'  => 'fa-stack-overflow',
		'color' => '#F48024',
		),
	);

$team_socials = apply_filters( 'team_socials', $team_socials );

GREENOVA_Theme::$team_social_fields = $team_socials;

$Postmeta->add_meta_box( 'team_settings', esc_html( 'Team Member Settings' ), array( 'greenova_team' ), '', '', 'high', array(
	'fields' => array(
		'greenova_team_designation' => array(
			'label' => esc_html( 'Designation' ),
			'type'  => 'text',
			),
		'greenova_team_address' => array(
			'label' => esc_html( 'Address' ),
			'type'  => 'text',
			),
		'greenova_team_fax' => array(
			'label' => esc_html( 'Fax' ),
			'type'  => 'text',
			),
		'greenova_team_phone' => array(
			'label' => esc_html( 'Phone Number' ),
			'type'  => 'text',
			),
		'greenova_team_email' => array(
			'label' => esc_html( 'Email' ),
			'type'  => 'text',
			),
		'greenova_team_socials_header' => array(
			'label' => esc_html( 'Socials' ),
			'type'  => 'header',
			'desc'  => esc_html( 'Put your social links here' ),
			),
		'greenova_team_socials' => array(
			'type'  => 'group',
			'value'  => $team_socials
			),
		)
	)
);

$Postmeta->add_meta_box( 'team_skills', esc_html( 'Team Skills' ), array( 'greenova_team' ), '', '', 'high', array(
	'fields' => array(
		'greenova_team_skill' => array(
			'type'  => 'repeater',
			'button' => esc_html( 'Add New Skill' ),
			'value'  => array(
				'skill_name' => array(
					'label' => esc_html( 'Skill Name' ),
					'type'  => 'text',
					'desc'  => esc_html( 'eg. Investment' ),
					),
				'skill_value' => array(
					'label' => esc_html( 'Skill Percentage (%)' ),
					'type'  => 'text',
					'desc'  => esc_html( 'eg. 75' ),
					),
				)
			),
		)
	)
);

/*-------------------------------------
#. Service
---------------------------------------*/
$Postmeta->add_meta_box( 'greenova_service_info', esc_html( 'Service Info' ), array( 'greenova_service' ), '', '', 'high', array(
	'fields' => array(
		'greenova_service_info_title' => array(
			'label' => esc_html( 'Service Info Title' ),
			'type'  => 'text',
			),
		'greenova_service_info_des' => array(
			'label' => esc_html( 'Service Info Description' ),
			'type'  => 'text',
		),
		'greenova_service_info_image' => array(
			'label' => esc_html( 'Service Info Image' ),
			'type'  => 'image',
		),
		'greenova_service_infos' => array(
			'type'  => 'repeater',
			'button' => esc_html( 'Add New Info' ),
			'value'  => array(
				'skill_name' => array(
					'label' => esc_html( 'Benefit Title' ),
					'type'  => 'text',
					'desc'  => esc_html( 'eg. Impact the environment' ),
					),
				'skill_value' => array(
					'label' => esc_html( 'Benefit Description' ),
					'type'  => 'text',
					),
				)
			),
		)
	)
);

/*-------------------------------------
#. Testimonial
---------------------------------------*/
$Postmeta->add_meta_box( 'testimonial_info', esc_html( 'Testimonial Info' ), array( 'green_testimonial' ), '', '', 'high', array(
		'fields' => array(
			'greenova_tes_designation' => array(
				'label' => esc_html( 'Designation' ),
				'type'  => 'text',
			),
			'greenova_tes_rating' => array(
				'label' => esc_html( 'Rating' ),
				'type'  => 'number',
			),
		),
	)
);