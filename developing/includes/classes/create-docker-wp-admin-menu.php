<?php
/**
 * This creates the API Guys menus in wp-admin.
 *
 * @since   0.7.4
 * @package docker_wp_functionality
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class create the Admin menus.
 *
 * @since 0.7.4
 */
class Create_Docker_WP_Admin_Menu {
	/**
	 * Main construct
	 *
	 * @since 0.7.4
	 *
	 * @return void
	 */
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'docker_connect_wp_menu' ), 11 );
		// add_action( 'wp_ajax_docker_authorize_api', array( $this, 'docker_authorize_api' ) );
		// add_action('admin_enqueue_scripts', array( $this, 'docker_connect_wp_enqueue_scripts' ) );
		add_filter( 'set-screen-option', array( $this, 'test_table_set_option' ), 10, 3 );
	}

	/**
	 * Adds a menu page in the WordPress admin dashboard
	 * where docker API Authorization can be done.
	 *
	 * This function registers the admin page that will allow the user to
	 * input their docker API credentials and authorize the API connection.
	 *
	 * @return void
	 */
	public function docker_connect_wp_menu() {
		global $docker_your_members_page, $docker_your_organizations_page;

		$parent_exists = false;
		// Check if 'the-api-guys' menu exists
		$docker_options = get_option( 'docker_options' );
		if ( $docker_options ) {
			$parent_exists = true;
		}

		if ( $parent_exists ) {
			add_submenu_page(
				'the-api-guys',
				__( 'Docker API Connect', 'docker-wp-2025' ),
				__( 'Docker Connect', 'docker-wp-2025' ),
				'manage_options',
				'docker-wp-2025',
				array( $this, 'docker_admin_page_tabs' ),
			);
		} else {
			add_menu_page(
				__( 'Docker Settings', 'docker-wp-2025' ),
				__( 'Docker Settings', 'docker-wp-2025' ),
				'manage_options',
				'docker-wp-2025',
				array( $this, 'docker_admin_page_tabs' ),
				'dashicons-rest-api',
				3
			);
		}
	}

	/**
	 * Renders the docker API settings admin page.
	 *
	 * This function displays the docker API settings form, retrieves stored
	 * credentials, and processes form submissions to save new credentials.
	 *
	 * @return void
	 */
	public function docker_admin_page_tabs() {
		?>
<div class="wrap">
    <h1 class="logo"><?php esc_html_e( 'Docker Connect WP', 'docker-wp-2025' ); ?></h1>
    <p><?php esc_html_e( 'For now, it does not seem perfect, but the button needs to get clicked twice. The first time connects to docker.com where you select the appropriate company, then the second click will store the Token.', 'docker-wp-2025' ); ?>
    </p>

    <h2 class="nav-tab-wrapper" style="margin-bottom:.31rem;">
        <a href="?page=docker-wp-2025&tab=docker-settings"
            class="nav-tab <?php echo isset( $_GET['tab'] ) && $_GET['tab'] === 'docker-settings' ? 'nav-tab-active' : ''; ?>">
            <?php esc_html_e( 'Docker Settings', 'docker-wp-2025' ); ?>
        </a>
        <a href="?page=docker-wp-2025&tab=connect-docker"
            class="nav-tab <?php echo isset( $_GET['tab'] ) && $_GET['tab'] === 'connect-docker' ? 'nav-tab-active' : ''; ?>">
            <?php esc_html_e( 'Connect docker', 'docker-wp-2025' ); ?>
        </a>
        <a href="?page=docker-wp-2025&tab=docker-debug"
            class="nav-tab <?php echo isset( $_GET['tab'] ) && $_GET['tab'] === 'docker-debug' ? 'nav-tab-active' : ''; ?>">
            <?php esc_html_e( 'Debug docker', 'docker-wp-2025' ); ?>
        </a>
    </h2>
    <div>
        <?php
		$tab = isset( $_GET['tab'] ) ? $_GET['tab'] : 'connect-docker';
		switch ( $tab ) {
			case 'connect-docker':
				$this->docker_docker_connect();
				break;
			case 'docker-settings':
				$this->docker_collect_docker_settings();
				break;
			case 'docker-debug':
				$this->docker_connect_debug();
				break;
		}
		?>
    </div>
</div>
<?php
	}

	/**
	 * Enqueues JavaScript for the plugin's admin functionality.
	 *
	 * This function adds the necessary JavaScript file for the admin dashboard
	 * to handle the docker API authentication.
	 *
	 * @return void
	 */
	public function docker_docker_connect() {
		echo '<div style="padding:2rem;border:2px solid salmon;">' . __FUNCTION__ . '</div>';
	}

	/**
	 * Enqueues JavaScript for the plugin's admin functionality.
	 *
	 * This function adds the necessary JavaScript file for the admin dashboard
	 * to handle the docker API authentication.
	 *
	 * @return void
	 */
	public function docker_collect_docker_settings() {
		echo '<div style="padding:2rem;border:2px solid green;">' . __FUNCTION__ . '</div>';
	}

	/**
	 * Enqueues JavaScript for the plugin's admin functionality.
	 *
	 * This function adds the necessary JavaScript file for the admin dashboard
	 * to handle the docker API authentication.
	 *
	 * @return void
	 */
	public function docker_connect_debug() {
		echo '<div style="padding:2rem;border:2px solid gold;">' . __FUNCTION__ . '</div>';
	}

	/**
	 * Enqueues JavaScript for the plugin's admin functionality.
	 *
	 * This function adds the necessary JavaScript file for the admin dashboard
	 * to handle the docker API authentication.
	 *
	 * @return void
	 */
	public function docker_wp_2025_enqueue_scripts() {
		// wp_enqueue_script(
		// 'wp-env-local-js',
		// plugins_url( 'js/docker-auth-plugin.js', __DIR__),
		// array('jquery'),
		// '0.0.2',
		// true
		// );
		// wp_localize_script(
		// 'wp-env-local-js',
		// 'docker_connect_ajax_object',
		// array(
		// 'docker_connect_ajaxurl' => admin_url('admin-ajax.php'),
		// 'random_number'   => time(),
		// 'docker_connect_nonce'   => wp_create_nonce('docker-connect-nonce'),
		// 'explanation_one' => 'Set up anything from the PHP side here in this function ('.__FUNCTION__. '). Add the variable to the JS file.',
		// )
		// );
		wp_enqueue_style(
			'wp-env-local-css',
			plugins_url( 'css/wp-env-local.css', __DIR__ ),
			array(),
			'0.0.2'
		);
	}
}

new Create_Docker_WP_Admin_Menu();
