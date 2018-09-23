<?php

/**
 * WooWhatsApp main class.
 *
 * @package    WooWhatsApp
 * @author     Azis Hapidin <azishapidin@gmail.com>
 * @link       https://wordpress.org/plugins/woowhatsapp/
 * @link       https://azishapidin.com/
 */
class WooWhatsApp
{
    /**
     * Default option.
     * 
     * @var string
     */
    public $default = [
        'content' => 'Hello, I want to buy this product {{link}}',
        'button' => 'Chat via WhatsApp',
    ];

    /**
     * Content getter function.
     * 
     * @param string $format Content Format.
     * @param \WC_Data\WC_Abstract_Legacy_Product\WC_Product $product WooCommerce Product
     * 
     * @return string
     */
    function getContent($format = '', $product)
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

    /**
     * Set plugin option to database.
     *
     * @param string $key   Option Key
     * @param string $value Option Value
     * 
     * @return void
     */
    public function setOption($key = '', $value = '')
    {
        if (!get_option($key) && !is_string(get_option($key))) {
            add_option($key, $value);
        } else {
            update_option($key, $value);
        }
    }

    /**
     * Get option from database.
     *
     * @param string $key       Option key.
     * @param string $default   Default value if option not found.
     * @return void
     */
    public function getOption($key = '', $default = '')
    {
        $result = get_option($key);
        if (!$result && !is_string($result)) {
            return $default;
        }
        
        return $result;
    }
}

$wooWhatsAppObject = new WooWhatsApp();