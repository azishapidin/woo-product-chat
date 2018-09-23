<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/*
 * Plugin Name: WooWhatsApp
 * Plugin URI: https://github.com/azishapidin/woo-whatsapp
 * Description: WordPress Plugin for Add WhatsApp button in every Single Product Page.
 * Version: 1.2.2
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

/**
 * Public action.
 */
require_once __DIR__ . '/includes/public.php';