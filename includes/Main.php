<?php
namespace ABCCF7STYLER;
/**
* ABCCF7ElementorPack.
* Main plugin class that holds entire plugin.
* @author  ABCCF7
* @since   v0.0.1
* @version   v1.1.0
*/

// If this file is called directly, abort!!!
defined('ABSPATH') or die('This is not the place you deserve!');



class ABCCF7STYLER {
	/**
	 * Addon Version
	 *
	 * @since 1.0.0
	 * @var string The addon version.
	 */

	public $version = '1.0';

	/**
	 * Minimum Elementor Version
	 *
	 * @since 1.0.0
	 * @var string Minimum Elementor version required to run the addon.
	 */
	const MINIMUM_ELEMENTOR_VERSION = '3.5.0';

	/**
	 * Minimum PHP Version
	 *
	 * @since 1.0.0
	 * @var string Minimum PHP version required to run the addon.
	 */
	const MINIMUM_PHP_VERSION = '7.4';

	/**
	 * Instance
	 *
	 * @since 1.0.0
	 * @access private
	 * @static
	 * @var \Elementor_Test_Addon\Plugin The single instance of the class.
	 */
	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 * @access public
	 * @static
	 * @return \Elementor_Test_Addon\Plugin An instance of the class.
	 */
	public static function instance() {

		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;

	}


	/**
	 * Constructor
	 *
	 * Perform some compatibility checks to make sure basic requirements are meet.
	 * If all compatibility checks pass, initialize the functionality.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function __construct() {

		if ( $this->is_compatible() ) {
			add_action( 'elementor/init', [ $this, 'init' ] );
		}
        // set the constants first
        $this->setConstants();

        // register the activation
        register_activation_hook(__FILE__, [$this, 'activate']);

        // registser the deactivation
        register_deactivation_hook(__FILE__, [$this, 'deactivate']);

        // Enqueue CSS file here
       // add_action( 'elementor/frontend/after_enqueue_styles', [ $this, 'abccf7_enqueue_styles' ] );

        // Register your styles
        add_action( 'wp_enqueue_scripts', [ $this, 'abccf7_enqueue_styles' ] );
	}

	
    /**
     * setConstants.
     * define default constants
     * @author   ABCCF7
     * @since   v0.0.1
     * @version   v1.1.0   
     * @access   public
     * @return   void
     */
     
     public function setConstants()
     {
        define( 'ABC_CF7_STYLER_VERSION', $this->version );
        define( 'ABC_CF7_STYLER_MINIMUM_ELEMENTOR_VERSION', self::MINIMUM_ELEMENTOR_VERSION );
        define( 'ABC_CF7_STYLER_MINIMUM_PHP_VERSION', self::MINIMUM_PHP_VERSION );
        define('ABCCF7_NAME', 'ABC CF7 Styler for Elementor');       

     }

     /**
     * Enqueue custom Js/CSS styles.
     *
     * @since 1.0.0
     * @access public
     */
    public function abccf7_enqueue_styles() {
        wp_enqueue_style(
            'abccf7styler-custom-styles', // Unique handle for your stylesheet
            ABC_CF7_STYLER_PLUGIN_URL . '/assets/css/style.css', // URL to your style.css file
            [], // Dependencies 
            ABC_CF7_STYLER_VERSION, // Version number
            'all' // Media type
        );
    }
	/**
	 * Compatibility Checks
	 *
	 * Checks whether the site meets the addon requirement.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function is_compatible() {

		// Check if Elementor installed and activated
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
			return false;
		}

		// Check for required Elementor version
		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );
			return false;
		}

		// Check for required PHP version
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
			return false;
		}

		return true;

	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have Elementor installed or activated.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_missing_main_plugin() {
        if (isset($_GET['activate'])) {
            unset($_GET['activate']);
        }

        $message = sprintf(
            /* translators: 1: Plugin Name 2: Elementor */
            esc_html__('"%1$s" requires "%2$s" to be installed and activated.', ABC_CF7_STYLER_TEXT_DOMAIN),
            '<strong>' . esc_html__(ABCCF7_NAME, ABC_CF7_STYLER_TEXT_DOMAIN) . '</strong>',
            '<strong>' . esc_html__('Elementor', ABC_CF7_STYLER_TEXT_DOMAIN) . '</strong>'
        );

        printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);

	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required Elementor version.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_minimum_elementor_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', ABC_CF7_STYLER_TEXT_DOMAIN ),
			'<strong>' . esc_html__(ABCCF7_NAME, ABC_CF7_STYLER_TEXT_DOMAIN) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', ABC_CF7_STYLER_TEXT_DOMAIN ) . '</strong>',
			 self::MINIMUM_ELEMENTOR_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required PHP version.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_minimum_php_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', ABC_CF7_STYLER_TEXT_DOMAIN ),
			'<strong>' . esc_html__(ABCCF7_NAME, ABC_CF7_STYLER_TEXT_DOMAIN) . '</strong>',
			'<strong>' . esc_html__( 'PHP', ABC_CF7_STYLER_TEXT_DOMAIN ) . '</strong>',
			 self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	/**
	 * Initialize
	 *
	 * Load the addons functionality only after Elementor is initialized.
	 *
	 * Fired by `elementor/init` action hook.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function init() {

		add_action( 'elementor/widgets/register', [ $this, 'register_widgets' ] );
		

	}



        /**
     * activate.
     * function that runs on plugin activation
     * @author   ABCCF7
     * @since   v0.0.1
     * @version   v1.1.0   
     * @access   public
     * @return   void
     */
    public function activate()
    {
        // flush rewrite rules
        flush_rewrite_rules();

        $isInstalled = get_option('ABCCF7_installed');

        if (!$isInstalled) {
            update_option('ABCCF7_installed', time());
        }

        update_option('ABCCF7_installed', ABC_CF7_STYLER_TEXT_DOMAIN);
    }

    /**
     * deactivate.
     * function that runs on plugin deactivation
     * @author   ABCCF7
     * @since   v0.0.1
     * @version   v1.1.0   
     * @access   public
     * @return   void
     */
    public function deactivate()
    {
        // Flush reqrite rules
        flush_rewrite_rules();
    }

    /**
     * Register Widgets
     *
     * Load widgets files and register new Elementor widgets.
     *
     * Fired by `elementor/widgets/register` action hook.
     *
     * @param \Elementor\Widgets_Manager $widgets_manager Elementor widgets manager.
     */
    public function register_widgets($widgets_manager) {

		// Include Widget configurations
		require_once ABC_CF7_STYLER_PLUGIN_DIR . '/includes/BaseWidgets.php'; 

        // Include Widget configurations      
		require_once ABC_CF7_STYLER_PLUGIN_DIR . '/includes/Widgets/Main.php';        
        
        $widgets_manager->register(new \includes\Widgets\ABCCF7\Main());
        
    }

}
