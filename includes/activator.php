<?php
require_once __DIR__ . '/main.php';

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if (!class_exists('WooCommerce')) {
	die('To use this plugin, you must install WooCommerce.');
}

// Set default value
$defaults = [
	'woo_wa_content' => $wooWhatsAppObject->default['content'],
	'woo_wa_button' => $wooWhatsAppObject->default['button'],
];

foreach ($defaults as $key => $value) {
	if (!get_option($key)) {
		add_option($key, $value);
	}
}