<?php
/*
Plugin Name: ABC Styler for Elementor and Contact Form 7
Plugin URI: https://github.com/devatiq/abc-styler-elementor-cf7
Description: Seamlessly integrate and enhance your Elementor-powered WordPress website with the Elementor ABC Contact Form 7 Integration Plugin. This powerful extension simplifies the process of integrating Contact Form 7 forms into your Elementor designs, offering advanced styling options and flexible customization. Elevate your contact forms with ease and style.
Version: 1.0
Author: SupreoX Limited
Author URI: https://www.supreox.com/
License: GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: abccf7
Domain Path: /languages
Elementor tested up to: 3.16.3
Elementor Pro tested up to: 3.16.3
*/


if (!defined('ABSPATH')) exit; // Exit if accessed directly


// Define ABC_CF7_STYLER_PLUGIN_FILE.
if (!defined('ABC_CF7_STYLER_PLUGIN_FILE')) {
    define('ABC_CF7_STYLER_PLUGIN_FILE', __FILE__);
}
// Define ABC_CF7_STYLER_PLUGIN_DIR.
if (!defined('ABC_CF7_STYLER_PLUGIN_DIR')) {
    define('ABC_CF7_STYLER_PLUGIN_DIR', plugin_dir_path(__FILE__));
}
// Define ABC_CF7_STYLER_PLUGIN_URL.
if (!defined('ABC_CF7_STYLER_PLUGIN_URL')) {
    define('ABC_CF7_STYLER_PLUGIN_URL', plugins_url('', __FILE__));
}
// Define ABC_CF7_STYLER_PLUGIN_BASENAME.
if (!defined('ABC_CF7_STYLER_PLUGIN_BASENAME')) {
    define('ABC_CF7_STYLER_PLUGIN_BASENAME', plugin_basename(__FILE__));
}

// abcf7 plugin general init
function abcf7_plugin_general_init()
{

    // Check if the plugin is active
    include_once(ABSPATH . 'wp-admin/includes/plugin.php');

    if (is_plugin_active('contact-form-7/wp-contact-form-7.php')) {
        // Load Main plugin class
        require_once ABC_CF7_STYLER_PLUGIN_DIR . 'includes/Main.php';
        /**
         * Initiate the plugin class
         */
        \ABCCF7STYLER\ABCCF7STYLER::instance();
    } else {
        // Contact Form 7 is not active, display admin notice
        add_action('admin_notices', 'abccf7_admin_notice');

        function abccf7_admin_notice()
        {
            // contact form 7 download link
            $url = 'https://wordpress.org/plugins/contact-form-7/';
            $link = sprintf(
                /* translators: 1: Plugin Name 2: Elementor */
                esc_html__('"%1$s" requires "%2$s" to be installed and activated.', 'abccf7'),
                '<strong>' . esc_html__('ABC Styler for Elementor and Contact Form 7', 'abccf7') . '</strong>',
                '<strong><a href="' . $url . '" target="_blank">' . esc_html__('Contact Form 7', 'abccf7') . '</a></strong>'
            );

            echo '<div class="notice notice-warning is-dismissible"><p>';
            echo $link;
            echo '</p></div>';
        }
    }
}

add_action('plugins_loaded', 'abcf7_plugin_general_init');
