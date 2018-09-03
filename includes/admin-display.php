<?php

$default = 'Hello, I want to buy this product {{link}}';
if (count($_POST) > 0) {
    if (isset($_POST['woo_wa_phone_number'])) {
        if (!get_option('woo_wa_phone_number') || strlen(get_option('woo_wa_phone_number')) == 0) {
            add_option( 'woo_wa_phone_number', $_POST['woo_wa_phone_number'] );
        } else {
            update_option( 'woo_wa_phone_number', $_POST['woo_wa_phone_number'] );
        } 
    }
    if (isset($_POST['woo_wa_content'])) {
        if (!get_option('woo_wa_content') || strlen(get_option('woo_wa_content')) == 0) {
            add_option( 'woo_wa_content', $_POST['woo_wa_content'] );
        } else {
            update_option( 'woo_wa_content', $_POST['woo_wa_content'] );
        }
    }
    if (isset($_POST['woo_wa_button'])) {
        if (!get_option('woo_wa_button') || strlen(get_option('woo_wa_button')) == 0) {
            add_option( 'woo_wa_button', $_POST['woo_wa_button'] );
        } else {
            update_option( 'woo_wa_button', $_POST['woo_wa_button'] );
        }
    }
    $success = true;
}
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="wrap">
    <h1>WooCommerce Order to WhatsApp Setting</h1>
    <?php if(isset($success) && $success){ ?>
    <div class="notice notice-success is-dismissible">
        <p>Changes Saved :)</p>
    </div>
    <?php } ?>
    <form action="" method="post">
        <?php settings_fields( 'woocommerce-order-whatsapp' ); do_settings_sections( 'woocommerce-order-whatsapp' ); ?>
        <table class="form-table">
            <tr valign="top">
            <th scope="row">WhatsApp Phone Number</th>
            <td><input style="width: 300px;" type="text" name="woo_wa_phone_number" value="<?php echo esc_attr( get_option('woo_wa_phone_number') ); ?>" /></td>
            </tr>

            <tr valign="top">
            <th scope="row">Button Text</th>
            <td><input style="width: 300px;" type="text" name="woo_wa_button" value="<?php echo esc_attr( get_option('woo_wa_button') ); ?>" /></td>
            </tr>
            
            <tr valign="top">
            <th scope="row">Message</th>
            <td>
                <textarea  style="width: 300px;" rows="8" name="woo_wa_content"><?php echo esc_attr( get_option('woo_wa_content') ); ?></textarea><br>
                Formatting:
                <ul>
                    <li>You can use <strong>{{title}}</strong> to insert Product Name.</li>
                    <li>You can use <strong>{{link}}</strong> to insert Product URL.</li>
                </ul>
                Example: <em><?php echo $default ?></em> will be parsed to <strong>Hello, I want to buy this product https://example.com/store/product/cool-thsirt</strong>
            </td>
            </tr>
            
            </tr>
        </table>
        <?php submit_button(); ?>
    </form>
</div>