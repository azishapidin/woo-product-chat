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

 // Add WA Button on Single Product
 function WaButton()
 {
	require_once __DIR__ . '/includes/public.php';
 }
 if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {
    
    add_action('woocommerce_after_add_to_cart_button', 'WaButton');
 }