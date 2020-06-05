<?php
/**
 *  * Plugin Name: Now playing for AzuraCast
 *  * Description: Shows in a widget what is currently being played on the AzuraCast instance.
 *  * Plugin URI: https://javik.net/azuracast-widget
 *  * Version: 2.0.3
 *  * Author: Javik
 *  * Author URI: https://javik.net
 *  * Text Domain: now-playing-widget-fuer-azuracast-stationen
 *  * Domain Path: /languages
 *   */
define( 'AZURAWIDGET_VERSION', '2.0.1' );
define( 'AZURAWIDGET_FILE', __FILE__);

require_once( __DIR__ . "/vendor/autoload.php" );

final class Azuracast_Plugin {

	/**
	 * Make notice handling transient.
	 */
	public static function notice_activation_hook() {
		set_transient( 'azuracast_install_notice', true, 5 );
	}

	/**
	 * Create activation notice
	 */
	public static function install_notice() {
		/* Check transient, if available display notice */
		if( get_transient( 'azuracast_install_notice' ) ){
			?>
			<div class="updated notice is-dismissible">
				<p>
					<?php
					// Workaround: Won't output without echo()
					echo ( sprintf( __( 'Thank you for using this plugin! If you enjoy my plugin, would you consider buying me a <a href="%s" target="_blank"><strong>coffee</strong></a>?', 'now-playing-widget-fuer-azuracast-stationen' ),
						'https://paypal.me/benny003'
					) );
					?>
				</p>
			</div>
			<?php
			/* Delete transient, only display this notice once. */
			delete_transient( 'azuracast_install_notice' );
		}
	}

	public static function action_links( $links ) {

		$links = array_merge( array(
			'<a target="_blank" href="https://paypal.me/benny003">' . __( 'Donation', 'now-playing-widget-fuer-azuracast-stationen' ) . '</a>',
			'<a target="_blank" href="https://github.com/SirJavik/Now-Playing-Widget-for-Azuracast-Stations">' . __( 'GitHub', 'now-playing-widget-fuer-azuracast-stationen' ) . '</a>'
		), $links );

		return $links;
	}

	/**
	 * Register plugin actions to WordPress
	 */
	public static function register_actions() {
		add_action( 'admin_notices', array( 'Azuracast_Plugin', 'install_notice' ) );
		add_action( 'plugin_action_links_' . plugin_basename( __FILE__ ), array( 'Azuracast_Plugin', 'action_links' ) );
		add_action( 'widgets_init', array( 'Azuracast_Plugin', 'register_custom_widget' ) );
		add_action( 'wp_enqueue_scripts', array( 'Azuracast_Plugin', 'register_styles' ) );
		add_action( 'wp_enqueue_scripts', array( 'Azuracast_Plugin', 'register_scripts' ) );
		add_action( 'plugins_loaded', array( 'Azuracast_Plugin', 'load_plugin_textdomain' ) );
	}

	/**
	 * Registers widget to wordpress
	 */
	public static function register_custom_widget() {
		register_widget( 'javik\azuracast_plugin\Azuracast_Widget' );
	}

	/**
	 * Enqueuing widget styles
	 */
	public static function register_styles() {
		wp_register_style(
			'azurawidget',
			plugin_dir_url( __FILE__ ) . "assets/css/azuracast-widget.css",
			null,
			AZURAWIDGET_VERSION
		);

		wp_enqueue_style( 'azurawidget' );
	}

	/**
	 * Enqueuing widget scripts
	 */
	public static function register_scripts() {
		wp_enqueue_script(
			'nchansubscriber',
			plugin_dir_url( __FILE__ ) . 'assets/js/NchanSubscriber.js',
			array( "jquery" ),
			AZURAWIDGET_VERSION,
			true
		);

		wp_enqueue_script(
			'azurawidget-asynchron',
			plugin_dir_url( __FILE__ ) . 'assets/js/azurawidget-asynchron.js',
			array( "jquery" ),
			AZURAWIDGET_VERSION,
			true
		);
	}

	/**
	 * Loads textdomain
	 */
	public static function load_plugin_textdomain() {
		load_plugin_textdomain( 'now-playing-widget-fuer-azuracast-stationen', false, basename( dirname( __FILE__ ) ) . '/languages/' );
	}
}
register_activation_hook( __FILE__, array('Azuracast_Widget', 'notice_activation_hook') );

// Plugin actions
Azuracast_Plugin::register_actions();
