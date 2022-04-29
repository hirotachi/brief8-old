<?php
/**
 * Plugin Name: Ober Plugin
 * Plugin URI: https://bslthemes.site/ober/
 * Description: This plugin it's designed for Ober Theme
 * Version: 1.0.2
 * Author: beshleyua
 * Author URI: https://bslthemes.site/
 * Text Domain: ober-plugin
 * Domain Path: /language/
 * License: http://www.gnu.org/licenses/gpl.html
 */

/* Load plugin text-domain */
function ober_plugin_load_textdomain() {
	load_plugin_textdomain( 'ober-plugin', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
}
add_action( 'plugins_loaded', 'ober_plugin_load_textdomain' );

/* Custom Post Types */
require plugin_dir_path( __FILE__ ) . 'custom-post-types.php';

/* ACF ober fields extention */
require plugin_dir_path( __FILE__ ) . 'acf-ext/acf-ui-google-font/acf-ui-google-font.php';
require plugin_dir_path( __FILE__ ) . 'acf-ext/acf-cf7/acf-cf7.php';

/**
 * Include Elementor Functions
 */
require_once plugin_dir_path( __FILE__ ) . 'elementor/functions.php';

/**
 * Enabled Custom Post Type Elementor Supports
 */
function ober_elementor_cpt_support() {
    $cpt_support = get_option( 'elementor_cpt_support' );

	if( ! $cpt_support ) {
	    $cpt_support = [ 'page', 'post', 'portfolio' ];
	    update_option( 'elementor_cpt_support', $cpt_support );
	} else if( ! in_array( 'portfolio', $cpt_support ) ) {
	    $cpt_support[] = 'portfolio';
	    update_option( 'elementor_cpt_support', $cpt_support );
	}
}
function ober_elementor_disable_fonts_and_colors() {
	$color_schemes = get_option( 'elementor_disable_color_schemes' );
	$typography_schemes = get_option( 'elementor_disable_typography_schemes' );

	if( ! $color_schemes ) {
	    update_option( 'elementor_disable_color_schemes', 'yes' );
	}
	if( ! $typography_schemes ) {
	    update_option( 'elementor_disable_typography_schemes', 'yes' );
	}
}

/* Update permalink structure when plugin is activated */
function ober_plugin_activate() {
	update_option( 'rewrite_rules', '' );
	ober_elementor_cpt_support();
	ober_elementor_disable_fonts_and_colors();
}
function ober_plugin_deactivate() {
	update_option( 'rewrite_rules', '' );
}

register_activation_hook( __FILE__, 'ober_plugin_activate' );
register_deactivation_hook( __FILE__, 'ober_plugin_deactivate' );

?>
