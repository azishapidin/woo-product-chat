<?php
/*
 * Plugin Name: WooWhatsApp
 * Plugin URI: https://github.com/azishapidin/woo-whatsapp
 * Description: WordPress Plugin for Add WhatsApp button in every Single Product Page.
 * Version: 0.9.1
 * Author: Azis Hapidin
 * Author URI: https://azishapidin.com/
 * License: MIT License
 */

 // Define activator
 function activator()
 {
    require_once __DIR__ . '/includes/activator.php';
 }
 register_activation_hook( __FILE__, 'activator' );

 // Add submenu setting to WooCommerce
 add_action('admin_menu', 'woo_whatsapp_admin');
 function woo_whatsapp_admin(){
    add_submenu_page( 'woocommerce', 'WooCommerce WhatsApp', 'WooWhatsApp', 'manage_options', 'woo_whatsapp_admin', 'wooWaAdmin' );
 }
 function wooWaAdmin()
 {
    require_once __DIR__ . '/includes/admin-display.php';
 }