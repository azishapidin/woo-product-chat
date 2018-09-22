<?php
require_once __DIR__ . '/main.php';

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if (!class_exists('WooCommerce')) {
	die('To use this plugin, you must install WooCommerce.');
}

// Set default value
if (!get_option('woo_wa_content')) {
	add_option( 'woo_wa_content', $wooWhatsAppDefault['content'] );
}

if (!get_option('woo_wa_button')) {
	add_option( 'woo_wa_button', $wooWhatsAppDefault['button'] );
}