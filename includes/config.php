<?php

/**
 * Define configuration for this plugin.
 */

$wooWhatsAppDefault = [
    'content'   => 'Hello, I want to buy this product {{link}}',
    'button'    => 'Order via WhatsApp',
];

/**
 * Add content getter function.
 * 
 * @param string $format Content Format.
 * @param \WC_Data\WC_Abstract_Legacy_Product\WC_Product $product WooCommerce Product
 */
function wooWhatsAppGetContent($format = '', $product)
{
    if ($format == '') {
        $format = $wooWhatsAppDefault['content'];
    }
    $data = [];
    $data['title'] = $product->get_title();
    $data['link'] = get_permalink($product->get_id());
    foreach ($data as $key => $value) {
        $format = str_replace('{{' . $key . '}}', $value, $format);
    }

    return $format;
}