<?php
require_once __DIR__ . '/main.php';

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if (!class_exists('WooCommerce')) {
	die('To use this plugin, you must install WooCommerce.');
}

// Set default value
$wooWhatsAppObject->setDefault();