<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

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