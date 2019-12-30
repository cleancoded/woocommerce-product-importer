<?php /*
    Plugin Name: Cleancoded Woocommerce Product Importer
    Plugin URI:https://github.com/cleancoded/cleancoded-woocommerce-importer
    Description: Free CSV import utility for WooCommerce
    Version: 1.0
    Author: Cleancoded
    Author URI: https://cleancoded.com/
    Text Domain: cleancoded-woocommerce-product-importer  
*/

    
    class Cleancoded_Woocommerce_Product_Importer {
        
        public function __construct() {
            add_action( 'init', array( 'Cleancoded_Woocommerce_Product_Importer', 'translations' ), 1 );
            add_action('admin_menu', array('Cleancoded_Woocommerce_Product_Importer', 'admin_menu'));
            add_action('wp_ajax_cleancoded-woocommerce-product-importer-ajax', array('Cleancoded_Woocommerce_Product_Importer', 'render_ajax_action'));
        }

        public static function translations() {
            load_plugin_textdomain( 'cleancoded-woocommerce-product-importer', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
        }

        public static function admin_menu() {
            add_management_page( __( 'Woo Product Importer', 'cleancoded-woocommerce-product-importer' ), __( 'Woo Product Importer', 'cleancoded-woocommerce-product-importer' ), 'manage_options', 'cleancoded-woocommerce-product-importer', array('Cleancoded_Woocommerce_Product_Importer', 'render_admin_action'));
        }
        
        public static function render_admin_action() {
            $action = isset($_REQUEST['action']) ? $_REQUEST['action'] : 'upload';
            require_once(plugin_dir_path(__FILE__).'cleancoded-woocommerce-product-importer-common.php');
            require_once(plugin_dir_path(__FILE__)."cleancoded-woocommerce-product-importer-{$action}.php");
        }
        
        public static function render_ajax_action() {
            require_once(plugin_dir_path(__FILE__)."cleancoded-woocommerce-product-importer-ajax.php");
            die(); // this is required to return a proper result
        }
    }
    
    $Cleancoded_Woocommerce_product_importer = new Cleancoded_Woocommerce_Product_Importer();
