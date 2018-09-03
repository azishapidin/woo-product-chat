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
	global $product;
	$data = [];
	$data['title'] = $product->get_title();
	$data['link'] = get_permalink($product->get_id());
	$phoneNumber = esc_attr( get_option('woo_wa_phone_number') );
	$content = esc_attr( get_option('woo_wa_content') );
	$button = esc_attr( get_option('woo_wa_button') );
	foreach ($data as $key => $value) {
		$content = str_replace('{{' . $key . '}}', $value, $content);
	}
	?>
	<button id="chat-wa" type="button" onclick="openWA()"><?php echo $button ?></button>
	<script>
	function openWA(){
		var t = "<?php echo $phoneNumber ?>",
        	a = "<?php echo $content ?>";
		if (navigator.userAgent.match(/Android/i) || navigator.userAgent.match(/webOS/i) || navigator.userAgent.match(/iPhone/i) || navigator.userAgent.match(/iPad/i) || navigator.userAgent.match(/iPod/i) || navigator.userAgent.match(/BlackBerry/i) || navigator.userAgent.match(/Windows Phone/i)) var e = "https://wa.me/" + t + "?text=" + a;
		else e = "https://web.whatsapp.com/send?phone=" + t + "&text=" + a;
		var n = window.open(e, "_blank");
		n ? n.focus() : alert("Please allow popups for this website")
	}
	</script>
	<?php
 }
 if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {
    
    add_action('woocommerce_after_add_to_cart_button', 'WaButton');
 }