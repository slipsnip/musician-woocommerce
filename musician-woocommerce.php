<?php
/**
 * Plugin Name:       Woocommerce Theme Customisations for musician wordpress theme
 * Description:       Contains woocommerce customizations pertaining to musician theme.
 * Plugin URI:        https://github.com/slipsnip/musician-woocommerce
 * Version:           1.0.0
 * Author:            Michael Esch
 * Requires at least: 3.0.0
 * Tested up to:      4.4.2
 *
 * @package Theme_Customisations
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Main Theme_Customisations Class
 *
 * @class Musician_Woocommerce_Customisations
 * @version	1.0.0
 * @since 1.0.0
 * @package	Musician_Woocommerce
 */
final class Musician_Woocommerce_Customisations {

	public function __construct() {
		add_action( 'init', array( $this, 'musician_woocommerce_customisationssetup' ), -1 );
		require_once( 'wc-custom/functions.php' );
	}

	/**
	 * Setup all the things
	 */
	public function musician_woocommerce_customisations_setup() {
		add_action( 'wp_enqueue_scripts', array( $this, 'musician_woocommerce_customisations_css' ), 999 );
		add_action( 'wp_enqueue_scripts', array( $this, 'musician_woocommerce_customisations_js' ) );
		add_filter( 'template_include',   array( $this, 'musician_woocommerce_customisations_template' ), 11 );
		add_filter( 'wc_get_template',    array( $this, 'musician_woocommerce_customisations_wc_get_template' ), 11, 5 );
	}

	/**
	 * Enqueue the CSS
	 *
	 * @return void
	 */
	public function musician_woocommerce_customisations_css() {
		wp_enqueue_style( 'custom-css', plugins_url( '/wc-custom/style.css', __FILE__ ) );
	}

	/**
	 * Enqueue the Javascript
	 *
	 * @return void
	 */
	public function musician_woocommerce_customisations_js() {
		wp_enqueue_script( 'custom-js', plugins_url( '/wc-custom/main.js', __FILE__ ));
	}

	/**
	 * Look in this plugin for template files first.
	 * This works for the top level templates (IE single.php, page.php etc). However, it doesn't work for
	 * template parts yet (content.php, header.php etc).
	 *
	 * Relevant trac ticket; https://core.trac.wordpress.org/ticket/13239
	 *
	 * @param  string $template template string.
	 * @return string $template new template string.
	 */
	public function musician_woocommerce_customisations_template( $template ) {
		if ( file_exists( untrailingslashit( plugin_dir_path( __FILE__ ) ) . '/wc-custom/templates/' . basename( $template ) ) ) {
			$template = untrailingslashit( plugin_dir_path( __FILE__ ) ) . '/wc-custom/templates/' . basename( $template );
		}

		return $template;
	}

	/**
	 * Look in this plugin for WooCommerce template overrides.
	 *
	 * For example, if you want to override woocommerce/templates/cart/cart.php, you
	 * can place the modified template in <plugindir>/wc-custom/templates/woocommerce/cart/cart.php
	 *
	 * @param string $located is the currently located template, if any was found so far.
	 * @param string $template_name is the name of the template (ex: cart/cart.php).
	 * @return string $located is the newly located template if one was found, otherwise
	 *                         it is the previously found template.
	 */
	public function musician_woocommerce_customisations_wc_get_template( $located, $template_name, $args, $template_path, $default_path ) {
		$plugin_template_path = untrailingslashit( plugin_dir_path( __FILE__ ) ) . '/wc-custom/templates/woocommerce/' . $template_name;

		if ( file_exists( $plugin_template_path ) ) {
			$located = $plugin_template_path;
		}

		return $located;
	}
} // End Class

/**
 * Plugin entery point
 *
 * @return void
 */
function musician_woocommerce_customisations_main() {
	new Musician_Woocommerce_Customisations();
}

/**
 * Initialise the plugin
 */
add_action( 'plugins_loaded', 'musician_woocommerce_customisations_main' );
