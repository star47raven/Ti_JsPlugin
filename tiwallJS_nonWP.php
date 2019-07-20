<?php
define('Tiwall_INC_DIR', Tiwall_DIR .'inc/');
define('Tiwall_INC_SETTING', Tiwall_DIR .'.setup/');
define('Tiwall_URL', Tiwall_DIR);
define('Tiwall_css', Tiwall_URL .'style/');
define('Tiwall_js', Tiwall_URL .'engine/');
define('Tiwall_img', Tiwall_URL .'img/');
define('Tiwall_struct', Tiwall_URL .'struct/');

function plugins_url($path) {
    return Tiwall_INC_DIR . $path;
}

require_once Tiwall_INC_DIR . 'php/tokener.php';

function ob_get_end() {
	$ob__content = ob_get_contents();
	ob_end_clean();
	return $ob__content;
}

function plugin_fineurl($url) {
	return Tiwall_URL . $url;
}

function load_unhinted() {
    load(array());
}

function load($atts) {
	$cat = isset($atts['cat']) && $atts['cat'] != '' ? 'categories~_filter=' . $atts['cat'] . '&' : '';
	$placeid = isset($atts['venue_id']) && $atts['venue_id'] != '' ? 'list~venue=' . $atts['venue_id'] : ''; 
	$pageid = isset($atts['page_id']) && $atts['page_id'] != '' ? 'list~page_id=' . $atts['page_id'] : ''; 
	$utility_js = plugin_fineurl('engine/utility.js');
	$scrollsync_js = plugin_fineurl('engine/scrollsync.js');
	ob_start(); ?>
	<script type="text/javascript" src="https://cdn.zirbana.com/js/jquery/1.7.2/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo $utility_js; ?>"></script>
	<script type="text/javascript" src="<?php echo $scrollsync_js; ?>"></script>
	<object id="anozb-plugfrm" style="width:100%; height:var(--ti-plugin-height, 500px);"
	data="<?php echo plugins_url('module.php?'.$cat.$placeid.$pageid)?>"> </object>
	<div style="height: 3px"></div>
<?php return ob_get_end(); }?>

<?php 
function loadsingle($atts){
	$urn = $atts['urn'];
	$utility_js = plugin_fineurl('engine/utility.js');
	$scrollsync_js = plugin_fineurl('engine/scrollsync.js');
	ob_start(); ?>
	<script type="text/javascript" src="https://cdn.zirbana.com/js/jquery/1.7.2/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo $utility_js; ?>"></script>
	<script type="text/javascript" src="<?php echo $scrollsync_js; ?>"></script>
	<object id="anozb-plugfrm" style="width:100%;height:var(--ti-plugin-height,500px);"
	data="<?php echo plugins_url('module.php?view=single&get~urn='.$urn)?>"> </object>
	<div style="height: 3px"></div>
<?php return ob_get_end(); }?>

<?php function loadreceipt() { ?>
<?php $test = $_GET['zb_result'];
$result = str_replace('\"', '"', $test); 
ob_start(); ?>
	<script type="text/javascript" src="https://cdn.zirbana.com/js/jquery/1.7.2/jquery.min.js"></script>
	<object id="anozb-plugfrm" style="width:100%;  height:var(--ti-plugin-height, 500px); margin-top:-30px;"
	 data='<?php echo plugins_url("module.php?backtoken=".$_GET['backtoken']."&zb_result=".urlencode($result))?>'> </object>
	<div style="height: 3px"></div>
<?php return ob_get_end(); } ?>
