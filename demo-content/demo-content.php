<?php
/**
 * OCDI Demo importer configuration.
 *
 * @package RT\FinwaveCore
 */

use FluentForm\App\Models\Form;
use FluentForm\App\Models\FormMeta;
use FluentForm\Framework\Support\Arr;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * OCDI Demo importer configuration.
 */
class RTDemoimport {
	/**
	 * CLass constructor.
	 */
	public function __construct() {
		// Action Hooks.
		add_action( 'admin_enqueue_scripts', [ $this, 'custom_admin_css' ] );
		add_action( 'ocdi/after_import', [ $this, 'after_import_actions' ] );
        add_action( 'ocdi/after_import', array( $this, 'rt_layer_slider_import_setup' ) );
        add_action('ocdi/after_import', array( $this, 'delete_invalid_menu_items' ) );

		// Filter Hooks.
		add_filter( 'ocdi/import_files', [ $this, 'import_files' ] );
		add_filter( 'ocdi/plugin_page_setup', [ $this, 'import_page_setup' ] );
		add_filter( 'ocdi/plugin_intro_text', [ $this, 'intro_text' ] );

	}

	/**
	 * Demo contains file loading methods
	 *
	 * @return array
	 */
	public function import_files() {

        $demos_array = array(
			'demo1' => array(
				'title'             => __( 'Home 1 ( Elementor )', 'greenova-core' ),
				'page'              => __( 'Home 1', 'greenova-core' ),
				'categories'        => [ 'Elementor' ],
				'screenshot'        => GREENOVA_CORE_DEMO_BASE_URL . 'screenshots/1.jpg',
				'preview_link'      => 'https://www.radiustheme.com/demo/wordpress/themes/greenova-el/',
			),
			'demo2' => array(
				'title'             => __( 'Home 2 ( Elementor )', 'greenova-core' ),
				'page'              => __( 'Home 2', 'greenova-core' ),
				'categories'        => [ 'Elementor' ],
				'screenshot'        => GREENOVA_CORE_DEMO_BASE_URL . 'screenshots/2.jpg',
				'preview_link'      => 'https://www.radiustheme.com/demo/wordpress/themes/greenova-el/home-2/',
			),
			'demo3' => array(
				'title'             => __( 'Home 3 ( Elementor )', 'greenova-core' ),
				'page'              => __( 'Home 3', 'greenova-core' ),
				'categories'        => [ 'Elementor' ],
				'screenshot'        => GREENOVA_CORE_DEMO_BASE_URL . 'screenshots/3.jpg',
				'preview_link'      => 'https://www.radiustheme.com/demo/wordpress/themes/greenova-el/home-3/',
			),
            'demo4' => array(
                'title'             => __( 'Home 4 ( Elementor )', 'greenova-core' ),
                'page'              => __( 'Home 4', 'greenova-core' ),
                'categories'        => [ 'Elementor' ],
                'screenshot'        => GREENOVA_CORE_DEMO_BASE_URL . 'screenshots/4.jpg',
                'preview_link'      => 'https://www.radiustheme.com/demo/wordpress/themes/greenova-el/home-4/',
            ),
			'demo5' => array(
				'title'             => __( 'Home 5 ( Elementor )', 'greenova-core' ),
				'page'              => __( 'Home 5', 'greenova-core' ),
				'categories'        => [ 'Elementor' ],
				'screenshot'        => GREENOVA_CORE_DEMO_BASE_URL . 'screenshots/4.jpg',
				'preview_link'      => 'https://www.radiustheme.com/demo/wordpress/themes/greenova-el/home-5/',
			),
			'demo6' => array(
				'title'             => __( 'Home 6 ( Elementor )', 'greenova-core' ),
				'page'              => __( 'Home 6', 'greenova-core' ),
				'categories'        => [ 'Elementor' ],
				'screenshot'        => GREENOVA_CORE_DEMO_BASE_URL . 'screenshots/5.jpg',
				'preview_link'      => 'https://www.radiustheme.com/demo/wordpress/themes/greenova-el/home-6/',
			),
			'demo7' => array(
				'title'             => __( 'Home 7 ( Elementor )', 'greenova-core' ),
				'page'              => __( 'Home 7', 'greenova-core' ),
				'categories'        => [ 'Elementor' ],
				'screenshot'        => GREENOVA_CORE_DEMO_BASE_URL . 'screenshots/6.jpg',
				'preview_link'      => 'https://www.radiustheme.com/demo/wordpress/themes/greenova-el/home-7/',
			),
            'demo8' => array(
                'title'             => __( 'Home 1 ( Elementor Onepage )', 'greenova-core' ),
                'page'              => __( 'Home 1 ( Onepage )', 'greenova-core' ),
                'categories'        => [ 'Elementor' ],
                'screenshot'        => GREENOVA_CORE_DEMO_BASE_URL . 'screenshots/1.jpg',
                'preview_link'      => 'https://www.radiustheme.com/demo/wordpress/themes/greenova-el/home-1-one-page/',
            ),
			'demo9' => array(
				'title'             => __( 'Home 2 ( Elementor Onepage )', 'greenova-core' ),
				'page'              => __( 'Home 2 ( Onepage )', 'greenova-core' ),
				'categories'        => [ 'Elementor' ],
				'screenshot'        => GREENOVA_CORE_DEMO_BASE_URL . 'screenshots/2.jpg',
				'preview_link'      => 'https://www.radiustheme.com/demo/wordpress/themes/greenova-el/home-2-one-page/',
			),
			'demo10' => array(
				'title'             => __( 'Home 3 ( Elementor Onepage )', 'greenova-core' ),
				'page'              => __( 'Home 3 ( Onepage )', 'greenova-core' ),
				'categories'        => [ 'Elementor' ],
				'screenshot'        => GREENOVA_CORE_DEMO_BASE_URL . 'screenshots/3.jpg',
				'preview_link'      => 'https://www.radiustheme.com/demo/wordpress/themes/greenova-el/home-3-one-page/',
			),
			'demo11' => array(
				'title'             => __( 'Home 4 ( Elementor Onepage )', 'greenova-core' ),
				'page'              => __( 'Home 4 ( Onepage )', 'greenova-core' ),
				'categories'        => [ 'Elementor' ],
				'screenshot'        => GREENOVA_CORE_DEMO_BASE_URL . 'screenshots/4.jpg',
				'preview_link'      => 'https://www.radiustheme.com/demo/wordpress/themes/greenova-el/home-4-one-page/',
			),
			'demo12' => array(
				'title'             => __( 'Home 5 ( Elementor Onepage )', 'greenova-core' ),
				'page'              => __( 'Home 5 ( Onepage )', 'greenova-core' ),
				'categories'        => [ 'Elementor' ],
				'screenshot'        => GREENOVA_CORE_DEMO_BASE_URL . 'screenshots/5.jpg',
				'preview_link'      => 'https://www.radiustheme.com/demo/wordpress/themes/greenova-el/home-5-one-page/',
			),
			'demo13' => array(
				'title'             => __( 'Home 6 ( Elementor Onepage )', 'greenova-core' ),
				'page'              => __( 'Home 6 ( Onepage )', 'greenova-core' ),
				'categories'        => [ 'Elementor' ],
				'screenshot'        => GREENOVA_CORE_DEMO_BASE_URL . 'screenshots/6.jpg',
				'preview_link'      => 'https://www.radiustheme.com/demo/wordpress/themes/greenova-el/home-6-one-page/',
			),
			'demo14' => array(
				'title'             => __( 'Home 7 ( Elementor Onepage )', 'greenova-core' ),
				'page'              => __( 'Home 7 ( Onepage )', 'greenova-core' ),
				'categories'        => [ 'Elementor' ],
				'screenshot'        => GREENOVA_CORE_DEMO_BASE_URL . 'screenshots/7.jpg',
				'preview_link'      => 'https://www.radiustheme.com/demo/wordpress/themes/greenova-el/home-7-one-page/',
			),
            'demo15' => array(
                'title'             => __( 'Home ( WPBakery )', 'greenova-core' ),
                'page'              => __( 'Home 1', 'greenova-core' ),
                'categories'        => [ 'WPBakery' ],
                'screenshot'        => GREENOVA_CORE_DEMO_BASE_URL . 'screenshots/1.jpg',
                'preview_link'      => 'https://radiustheme.com/demo/wordpress/greenova/',
            ),
            'demo16' => array(
                'title'             => __( 'Home 2 ( WPBakery )', 'greenova-core' ),
                'page'              => __( 'Home 2', 'greenova-core' ),
                'categories'        => [ 'WPBakery' ],
                'screenshot'        => GREENOVA_CORE_DEMO_BASE_URL . 'screenshots/2.jpg',
                'preview_link'      => 'https://radiustheme.com/demo/wordpress/greenova/home-2/',
            ),
            'demo17' => array(
                'title'             => __( 'Home 3', 'greenova-core' ),
                'page'              => __( 'Home 3', 'greenova-core' ),
                'categories'        => [ 'WPBakery' ],
                'screenshot'        => GREENOVA_CORE_DEMO_BASE_URL . 'screenshots/3.jpg',
                'preview_link'      => 'https://radiustheme.com/demo/wordpress/greenova/home-3/',
            ),
            'demo18' => array(
                'title'             => __( 'Home 4 ( WPBakery )', 'greenova-core' ),
                'page'              => __( 'Home 4', 'greenova-core' ),
                'categories'        => [ 'WPBakery' ],
                'screenshot'        => GREENOVA_CORE_DEMO_BASE_URL . 'screenshots/4.jpg',
                'preview_link'      => 'https://radiustheme.com/demo/wordpress/greenova/home-4/',
            ),
            'demo19' => array(
                'title'             => __( 'Home 5( WPBakery )', 'greenova-core' ),
                'page'              => __( 'Home 5', 'greenova-core' ),
                'categories'        => [ 'WPBakery' ],
                'screenshot'        => GREENOVA_CORE_DEMO_BASE_URL . 'screenshots/5.jpg',
                'preview_link'      => 'https://radiustheme.com/demo/wordpress/greenova/home-5/',
            ),
            'demo20' => array(
                'title'             => __( 'Home 6 ( WPBakery )', 'greenova-core' ),
                'page'              => __( 'Home 6', 'greenova-core' ),
                'categories'        => [ 'WPBakery' ],
                'screenshot'        => GREENOVA_CORE_DEMO_BASE_URL . 'screenshots/6.jpg',
                'preview_link'      => 'https://radiustheme.com/demo/wordpress/greenova/home-6/',
            ),
            'demo21' => array(
                'title'             => __( 'Home 7 ( WPBakery )', 'greenova-core' ),
                'page'              => __( 'Home 7', 'greenova-core' ),
                'categories'        => [ 'WPBakery' ],
                'screenshot'        => GREENOVA_CORE_DEMO_BASE_URL . 'screenshots/6.jpg',
                'preview_link'      => 'https://radiustheme.com/demo/wordpress/greenova/home-7',
            ),
            'demo22' => array(
                'title'             => __( 'Home 1 ( Onepage WPBakery )', 'greenova-core' ),
                'page'              => __( 'Home 1 ( One Page )', 'greenova-core' ),
                'categories'        => [ 'WPBakery' ],
                'screenshot'        => GREENOVA_CORE_DEMO_BASE_URL . 'screenshots/1.jpg',
                'preview_link'      => 'https://radiustheme.com/demo/wordpress/greenova/home-1-one-page/',
            ),
            'demo23' => array(
                'title'             => __( 'Home 2 ( Onepage WPBakery )', 'greenova-core' ),
                'page'              => __( 'Home 2 ( One Page )', 'greenova-core' ),
                'categories'        => [ 'WPBakery' ],
                'screenshot'        => GREENOVA_CORE_DEMO_BASE_URL . 'screenshots/2.jpg',
                'preview_link'      => 'https://radiustheme.com/demo/wordpress/greenova/home-2-one-page/',
            ),
            'demo24' => array(
                'title'             => __( 'Home 3 ( Onepage WPBakery )', 'greenova-core' ),
                'page'              => __( 'Home 3 ( One Page )', 'greenova-core' ),
                'categories'        => [ 'WPBakery' ],
                'screenshot'        => GREENOVA_CORE_DEMO_BASE_URL . 'screenshots/3.jpg',
                'preview_link'      => 'https://radiustheme.com/demo/wordpress/greenova/home-3-onepage/',
            ),
            'demo25' => array(
                'title'             => __( 'Home 4 ( Onepage WPBakery )', 'greenova-core' ),
                'page'              => __( 'Home 4 ( One Page )', 'greenova-core' ),
                'categories'        => [ 'WPBakery' ],
                'screenshot'        => GREENOVA_CORE_DEMO_BASE_URL . 'screenshots/4.jpg',
                'preview_link'      => 'https://radiustheme.com/demo/wordpress/greenova/home-4-onepage/',
            ),
            'demo26' => array(
                'title'             => __( 'Home 5 ( Onepage WPBakery )', 'greenova-core' ),
                'page'              => __( 'Home 5 ( One Page )', 'greenova-core' ),
                'categories'        => [ 'WPBakery' ],
                'screenshot'        => GREENOVA_CORE_DEMO_BASE_URL . 'screenshots/5.jpg',
                'preview_link'      => 'https://radiustheme.com/demo/wordpress/greenova/home-5-onepage/',
            ),
            'demo27' => array(
                'title'             => __( 'Home 6 ( Onepage WPBakery )', 'greenova-core' ),
                'page'              => __( 'Home 6 ( One Page )', 'greenova-core' ),
                'categories'        => [ 'WPBakery' ],
                'screenshot'        => GREENOVA_CORE_DEMO_BASE_URL . 'screenshots/6.jpg',
                'preview_link'      => 'https://radiustheme.com/demo/wordpress/greenova/home-6-onepage/',
            ),
            'demo28' => array(
                'title'             => __( 'Home 7 ( Onepage WPBakery )', 'greenova-core' ),
                'page'              => __( 'Home 7 ( One Page )', 'greenova-core' ),
                'categories'        => [ 'WPBakery' ],
                'screenshot'        => GREENOVA_CORE_DEMO_BASE_URL . 'screenshots/6.jpg',
                'preview_link'      => 'https://radiustheme.com/demo/wordpress/greenova/home-6-onepage/',
            ),
		);

        $import_path   = trailingslashit( GREENOVA_CORE_DEMO_CONTENT ) . 'demo/';
        $config = array();
		foreach ( $demos_array as $key => $demo ) {

            $content = $demo['categories'][0] == 'WPBakery' ? $import_path . 'wpbakery/content.xml' : $import_path . '/elementor/content.xml';
            $export = $demo['categories'][0] == 'WPBakery' ? $import_path . 'wpbakery/export.dat' : $import_path . '/elementor/export.dat';
            $widgets = $demo['categories'][0] == 'WPBakery' ? $import_path . 'wpbakery/widgets.wie' : $import_path . '/elementor/widgets.wie';
            $redux = $demo['categories'][0] == 'WPBakery' ? $import_path . 'wpbakery/redux.json' : $import_path . '/elementor/redux.json';

            $config[] = array(
				'import_file_id'                => $key,
				'import_file_name'              => $demo['title'],
				'import_page_name'              => $demo['page'],
				'categories'                    => $demo['categories'],
				'local_import_file'             => $content,
				'local_import_widget_file'      => $widgets,
				'local_import_customizer_file'  => $export,
                'local_import_redux'           => [
                    [
                        'file_path'   => $redux,
                        'option_name' => 'greenova',
                    ],
                ],
				'import_preview_image_url'      => $demo['screenshot'],
				'preview_url'                   => $demo['preview_link'],
			);

		}
		return $config;
	}

	/**
	 * Enqueues a custom CSS file specifically for the "Install Demos" admin page.
	 *
	 * @param string $hook_suffix The current admin page hook suffix.
	 *
	 * @return void
	 */
	public function custom_admin_css( $hook_suffix ) {
		if ( 'appearance_page_install_demos' === $hook_suffix ) {
			wp_enqueue_style( 'custom-admin-css', GREENOVA_CORE_DEMO_BASE_URL . '/demo-content/css/main.css', [], '1.0.0' );
		}
	}

	/**
	 * After import actions.
	 *
	 * @param array $selected_import Import array.
	 *
	 * @return void
	 */
	public function after_import_actions( $selected_import ) {
		$this
			->set_menus($selected_import)
			->set_front_page($selected_import)
			->set_elementor_active_kit()
			->set_elementor_settings()
			->set_draft_post();
			update_option('permalink_structure', '/%postname%/');
		flush_rewrite_rules();
	}

	/**
	 * Assign menus to their locations.
	 *
	 * @return RTDemoimport
	 */

    private function set_menus( $selected_import ) {
        $main_menu = get_term_by( 'name', 'main menu', 'nav_menu' );
        set_theme_mod(
            'nav_menu_locations',
            [
                'primary'   => $main_menu->term_id,
            ]
        );
        return $this;
    }

    /**
     * @return void
     */

    public function rt_layer_slider_import_setup() {
        $slider_files = array(
            trailingslashit( GREENOVA_CORE_DEMO_CONTENT ) . 'demo/slider-1.zip',
            trailingslashit( GREENOVA_CORE_DEMO_CONTENT ) . 'demo/slider-2.zip',
            trailingslashit( GREENOVA_CORE_DEMO_CONTENT ) . 'demo/slider-3.zip',
            trailingslashit( GREENOVA_CORE_DEMO_CONTENT ) . 'demo/slider-4.zip',
            trailingslashit( GREENOVA_CORE_DEMO_CONTENT ) . 'demo/slider-5.zip',
        );

        if ( class_exists( 'LS_Sliders' ) && count( $slider_files ) > 0 ) {
            require_once LS_ROOT_PATH.'/classes/class.ls.importutil.php';
            require_once LS_ROOT_PATH.'/classes/class.ls.filesystem.php';
            foreach( $slider_files as $slider_file ){
                if( file_exists( $slider_file ) ) {
                    new LS_ImportUtil( $slider_file );
                }
            }
        }
    }

	/**
	 * Assign front page and posts page (blog page).
	 *
	 * @return RTDemoimport
	 */
	private function set_front_page($selected_import) {
		$front_page_id = $this->get_page_by_title( $selected_import['import_page_name'], 'page' );

		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $front_page_id->ID );

		$blog_page_id = $this->get_page_by_title( 'Blog' );
		update_option( 'page_for_posts', $blog_page_id->ID );
		return $this;
	}

	/**
	 * Sets the active Elementor kit.
	 *
	 * @return RTDemoimport
	 */
	private function set_elementor_active_kit() {
		global $wpdb;

		// phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery, WordPress.DB.DirectDatabaseQuery.NoCaching
		$pageIds = $wpdb->get_results(
			$wpdb->prepare(
				"SELECT ID FROM $wpdb->posts WHERE (post_name = %s OR post_title = %s) AND post_type = 'elementor_library' AND post_status = 'publish'",
				'default-kit',
				'Default Kit'
			)
		);

		if ( ! is_null( $pageIds ) ) {
			$pageId    = 0;
			$deleteIds = [];

			// Retrieve page with greater id and delete others.
			if ( count( $pageIds ) > 1 ) {
				foreach ( $pageIds as $page ) {
					if ( $page->ID > $pageId ) {
						if ( $pageId ) {
							$deleteIds[] = $pageId;
						}

						$pageId = $page->ID;
					} else {
						$deleteIds[] = $page->ID;
					}
				}
			} else {
				$pageId = $pageIds[0]->ID;
			}

			// Update `elementor_active_kit` page.
			if ( $pageId > 0 ) {
				wp_update_post(
					[
						'ID'        => $pageId,
						'post_name' => sanitize_title( 'Default Kit' ),
					]
				);
				update_option( 'elementor_active_kit', $pageId );
			}
		}

		return $this;
	}

	/**
	 * Sets the Elementor default settings.
	 *
	 * @return RTDemoimport
	 */
	private function set_elementor_settings() {
		update_option( 'elementor_disable_color_schemes', 'yes' );
		update_option( 'elementor_disable_typography_schemes', 'yes' );
		update_option( 'elementor_unfiltered_files_upload', '1' );
		update_option( 'elementor_experiment-e_font_icon_svg', 'inactive' );

		return $this;
	}

	/**
	 * Updates the 'Hello World!' blog post by making it a draft
	 *
	 * @return RTDemoimport
	 */
	private function set_draft_post() {
		$helloWorld = $this->get_page_by_title( 'Hello World!', 'post' );

		if ( $helloWorld ) {
			$helloWorldArgs = [
				'ID'          => $helloWorld->ID,
				'post_status' => 'draft',
			];

			wp_update_post( $helloWorldArgs );
		}

		return $this;
	}

    public function delete_invalid_menu_items() {
        $menu_locations = get_nav_menu_locations();
        foreach ($menu_locations as $location => $menu_id) {
            $menu_items = wp_get_nav_menu_items($menu_id);
            if ($menu_items) {
                foreach ($menu_items as $menu_item) {
                    if (empty($menu_item->title) || trim($menu_item->title) === '(no title)') {
                        wp_delete_post($menu_item->ID, true);
                    }
                }
            }
        }
    }

	/**
	 * Install Demos Menu - Menu Edited
	 *
	 * @param array $default_settings Default settings.
	 * @return array
	 */
	public function import_page_setup( $default_settings ) {
		$default_settings['parent_slug'] = 'themes.php';
		$default_settings['page_title']  = esc_html__( 'Import Demo Data', 'greenova-core' );
		$default_settings['menu_title']  = esc_html__( 'Import Demo Data', 'greenova-core' );
		$default_settings['capability']  = 'import';
		$default_settings['menu_slug']   = 'install_demos';

		return $default_settings;
	}

	/**
	 * Generates and returns the introduction text for the RT Install Demos page.
	 *
	 * @param string $default_text The existing default text to append to.
	 *
	 * @return string
	 */
	public function intro_text( $default_text ) {
		$auto_install   = admin_url( 'themes.php?page=install_demos' );
		$manual_install = admin_url( 'themes.php?page=install_demos&import-mode=manual' );

		ob_start();
		?>
        <h1>RT Install Demos</h1>
        <div class="greenova-core_intro-text vtdemo-one-click">
            <div id="poststuff">
                <div class="postbox important-notes">
                    <h3><span>Important notes:</span></h3>
                    <div class="inside">
                        <ol>
                            <li>Please note, this import process will take time. So, please be patient.</li>
                            <li>Please make sure you've installed recommended plugins before you import this content.</li>
                            <li>All images are for demo purposes only. So, images may repeat in your site content.</li>
                        </ol>
                    </div>
                </div>

                <div class="postbox vt-support-box vt-error-box">
                    <h3><span>Don't Edit Parent Theme Files:</span></h3>
                    <div class="inside">
                        <p>Don't edit any files from the parent theme! Use only <strong>Child Theme</strong> files for your customizations!</p>
                        <p>If you receive future updates from our theme, you'll lose any edited customizations from your parent theme.</p>
                    </div>
                </div>

                <div class="postbox vt-support-box">
                    <h3><span>Need Support?</span> <a href="https://themeforest.net/user/rt" target="_blank" class="cs-section-video"><i class="fal fa-hand-point-right"></i> <span>How to?</span></a></h3>
                    <div class="inside">
                        <p>Have any doubts regarding this installation or any other issues? Please feel free to send us an email at rt@gmail.com.</p>
                        <a href="https://themeforest.net/user/rt" class="button-primary" target="_blank">Docs</a>
                        <a href="https://themeforest.net/user/rt/" class="button-primary" target="_blank">Support</a>
                        <a href="https://themeforest.net/item/greenova/123456?ref=rt" class="button-primary" target="_blank">Item Page</a>
                    </div>
                </div>
                <div class="nav-tab-wrapper vt-nav-tab">
					<?php
					// phpcs:ignore WordPress.Security.NonceVerification.Recommended
					$is_manual_mode      = isset( $_GET['import-mode'] ) && 'manual' === $_GET['import-mode'];
					$auto_active_class   = $is_manual_mode ? '' : ' nav-tab-active';
					$manual_active_class = $is_manual_mode ? ' nav-tab-active' : '';
					?>
                    <a href="<?php echo esc_url( $auto_install ); ?>" class="nav-tab vt-mode-switch vt-auto-mode<?php echo esc_attr( $auto_active_class ); ?>">Auto Import</a>
                    <a href="<?php echo esc_url( $manual_install ); ?>" class="nav-tab vt-mode-switch vt-manual-mode<?php echo esc_attr( $manual_active_class ); ?>">Manual Import</a>
                </div>
            </div>
        </div>
		<?php
		$default_text .= ob_get_clean();

		return $default_text;
	}


	/**
	 * Get page by title.
	 *
	 * @param string $title Page name.
	 * @param string $post_type Post type.
	 *
	 * @return WP_Post
	 */
	private function get_page_by_title( $title, $post_type = 'page' ) {
		$query = new WP_Query(
			[
				'post_type'              => esc_html( $post_type ),
				'title'                  => esc_html( $title ),
				'post_status'            => 'all',
				'posts_per_page'         => 1,
				'no_found_rows'          => true,
				'ignore_sticky_posts'    => true,
				'update_post_term_cache' => false,
				'update_post_meta_cache' => false,
				'orderby'                => 'post_date ID',
				'order'                  => 'ASC',
			]
		);

		return ! empty( $query->post ) ? $query->post : null;
	}
}

add_action( 'plugins_loaded', 'greenova_demo_importer_init' );
/**
 * Initializes the Quixa demo importer.
 *
 * @return RTDemoimport
 */
function greenova_demo_importer_init() {
	return new RTDemoimport();
}