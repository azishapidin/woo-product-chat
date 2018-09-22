<?php
require_once __DIR__ . '/main.php';

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if( isset( $_GET[ 'tab' ] ) ) {
    $active_tab = $_GET[ 'tab' ];
} else {
    $active_tab = 'general';
}

$errorMessage = null;
if (count($_POST) > 0) {
    if ( 
        ! isset( $_POST['_token'] ) 
        || ! wp_verify_nonce( $_POST['_token'], 'woo_wa_admin_update' ) 
    ) {
     
       echo 'Sorry, your nonce did not verify.';
       exit;
     
    }
    if (isset($_POST['woo_wa_phone_number']) && is_null($errorMessage)) {
        if (!ctype_digit($_POST['woo_wa_phone_number'])) {
            $errorMessage = 'WhatsApp Number must be numeric.';
        } else {
            $wooWhatsAppObject->setOption('woo_wa_phone_number', sanitize_text_field($_POST['woo_wa_phone_number']));
            $success = true;
        }
    }
    if (isset($_POST['woo_wa_content']) && is_null($errorMessage)) {
        $wooWhatsAppObject->setOption('woo_wa_content', sanitize_text_field($_POST['woo_wa_content']));
        $success = true;
    }
    if (isset($_POST['woo_wa_button']) && is_null($errorMessage)) {
        $wooWhatsAppObject->setOption('woo_wa_button', sanitize_text_field($_POST['woo_wa_button']));
        $success = true;
    }
}
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="wrap">
    <h1>WooCommerce Chat to WhatsApp Setting</h1>
    <h2 class="nav-tab-wrapper">
        <a href="?page=woo_whatsapp_admin&tab=general" class="nav-tab <?php echo $active_tab == 'general' ? 'nav-tab-active' : ''; ?>">General</a>
        <a href="?page=woo_whatsapp_admin&tab=advance" class="nav-tab <?php echo $active_tab == 'advance' ? 'nav-tab-active' : ''; ?>">Advance Settings</a>
    </h2>
    <?php if(isset($success) && $success){ ?>
    <div class="notice notice-success is-dismissible">
        <p>Changes Saved :)</p>
    </div>
    <?php } ?>
    <?php if(!is_null($errorMessage)){ ?>
    <div class="notice notice-error is-dismissible">
        <p><?php echo $errorMessage; ?></p>
    </div>
    <?php } ?>
    <form action="" method="post">
        <?php if ($active_tab == 'general') { ?>
        <?php settings_fields( 'woocommerce-order-whatsapp' ); do_settings_sections( 'woocommerce-order-whatsapp' ); ?>
        <?php wp_nonce_field( 'woo_wa_admin_update', '_token' ); ?>
        <table class="form-table">
            <tr valign="top">
            <th scope="row">WhatsApp Phone Number</th>
            <td>
                <input style="width: 300px;" type="text" name="woo_wa_phone_number" value="<?php echo esc_attr( get_option('woo_wa_phone_number') ); ?>" placeholder="Example: 62888XXXXXXX" />
                <br><small>Don't forget to add country code prefix, like 62 for Indonesia.</small>
            </td>
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
                Example: <em><?php echo esc_attr($wooWhatsAppObject->defaultContent); ?></em> will be parsed to <strong>Hello, I want to buy this product https://example.com/store/product/cool-thsirt</strong>
            </td>
            </tr>
            
            </tr>
        </table>
        <?php } elseif ($active_tab == 'advance') { ?>
        <p>This tab for advance settings like CSS Style, button class, etc.</p>
        <?php } ?>
        <?php submit_button(); ?>
    </form>
</div>