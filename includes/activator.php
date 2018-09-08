<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if (!class_exists('WooCommerce')) {
	die('To use this plugin, you must install WooCommerce.');
}

// Set default value
$defaultContent = 'Hello, I want to buy this product {{link}}';
if (!get_option('woo_wa_content')) {
	add_option( 'woo_wa_content', $defaultContent );
}
$defaultButton = 'Order via WhatsApp';
if (!get_option('woo_wa_button')) {
	add_option( 'woo_wa_button', $defaultButton );
}