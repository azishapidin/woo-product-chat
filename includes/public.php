<?php
require_once __DIR__ . '/main.php'; 

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Add WA Button after add to cart button start
function wooWhatsAppButtonAfterAddToCart()
{
	global $product;
	global $wooWhatsAppObject;

	$phoneNumber = esc_attr($wooWhatsAppObject->getOption('woo_wa_phone_number'));
	$content = esc_attr($wooWhatsAppObject->getOption('woo_wa_content'));
	$button = esc_attr($wooWhatsAppObject->getOption('woo_wa_button'));
    ?>
	<button class="<?php echo $wooWhatsAppObject->getOption('woo_wa_button_class') ?>" id="<?php echo $wooWhatsAppObject->getOption('woo_wa_button_id', 'woowhatsapp-button') ?>" style="<?php echo $wooWhatsAppObject->getOption('woo_wa_button_css') ?>" type="button" onclick="openWA()"><?php echo $button ?></button>
	<script>
		var isMobile = navigator.userAgent.match(/Android/i) || navigator.userAgent.match(/webOS/i) || navigator.userAgent.match(/iPhone/i) || navigator.userAgent.match(/iPad/i) || navigator.userAgent.match(/iPod/i) || navigator.userAgent.match(/BlackBerry/i) || navigator.userAgent.match(/Windows Phone/i);
		if (isMobile) {
			document.getElementById("<?php echo $wooWhatsAppObject->getOption('woo_wa_button_id', 'woowhatsapp-button') ?>").style.display = 'block';
		} else {
			document.getElementById("<?php echo $wooWhatsAppObject->getOption('woo_wa_button_id', 'woowhatsapp-button') ?>").style.display = 'block';
		}
		function openWA(){
			var phoneNumber = "<?php echo esc_attr($phoneNumber); ?>",
				content = "<?php echo esc_attr($wooWhatsAppObject->getContent($content, $product)) ?>";
				link = "";
			if (isMobile) {
				link = "https://wa.me/" + phoneNumber + "?text=" + content;
			} else {
				<?php if ($wooWhatsAppObject->getOption('woo_wa_button_show_desktop') == 'yes') { ?>
				link = "https://web.whatsapp.com/send?phone=" + phoneNumber + "&text=" + content;
				<?php } ?>
			}
			var n = window.open(link, "_blank");
			n ? n.focus() : alert("Please allow popups for this website")
		}
	</script>
	<?php
}
if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {
   add_action('woocommerce_after_add_to_cart_button', 'wooWhatsAppButtonAfterAddToCart');
}
// Add WA Button after add to cart button end

// CSS style start
function wooWhatsAppCssHook() {
	global $wooWhatsAppObject;
    ?>
		<style>
		#<?php echo $wooWhatsAppObject->getOption('woo_wa_button_id', 'woowhatsapp-button') ?> {
			display: none;
		}
		</style>
	<?php
}
add_action('wp_head', 'wooWhatsAppCssHook');
// CSS Style end
?>