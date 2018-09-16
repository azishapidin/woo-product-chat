<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/*
 * Plugin Name: WooWhatsApp
 * Plugin URI: https://github.com/azishapidin/woo-whatsapp
 * Description: WordPress Plugin for Add WhatsApp button in every Single Product Page.
 * Version: 0.9.1
 * Author: Azis Hapidin
 * Author URI: https://azishapidin.com/
 * License: GPLv2
 */

// Start plugin activator.
function wooWhatsAppActicatePlugin()
{
   require_once __DIR__ . '/includes/activator.php';
}
register_activation_hook( __FILE__, 'wooWhatsAppActicatePlugin');
// End plugin acticator

// Add submenu setting to WooCommerce
add_action('admin_menu', 'wooWhatsAppAdminMenu');
function wooWhatsAppAdminMenu(){
   add_submenu_page('woocommerce', 'Woo WhatsApp', 'WooWhatsApp', 'manage_options', 'woo_whatsapp_admin', 'wooWhatsAppAdminPage' );
}
function wooWhatsAppAdminPage()
{
   require_once __DIR__ . '/includes/admin-display.php';
}
// End submenu setting

// Add WA Button on Single Product
function wooWhatsAppButtonAfterCart()
{
    require_once __DIR__ . '/includes/public.php';
}
if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {
   
   add_action('woocommerce_after_add_to_cart_button', 'wooWhatsAppButtonAfterCart');
}