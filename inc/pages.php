<?php
require_once 'php/tokener.php';
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
	 global $current_user; get_currentuserinfo();
	$user_info='user_login='. $current_user->user_login.'&user_email='.$current_user->user_email.'&user_firstname='.$current_user->user_firstname.'&user_lastname='.$current_user->user_firstname.'&display_name='.$current_user->display_name.'&user_id='.$current_user->ID.'&user_level='.$current_user->user_level;
	$utility_js = plugin_fineurl('engine/utility.js');
	$scrollsync_js = plugin_fineurl('engine/scrollsync.js');
	ob_start(); ?>
	<script type="text/javascript" src="https://cdn.zirbana.com/js/jquery/1.7.2/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo $utility_js; ?>"></script>
	<script type="text/javascript" src="<?php echo $scrollsync_js; ?>"></script>
	<object  id="anozb-plugfrm" style="width:100%;  height:var(--ti-plugin-height, 500px);"
	data="<?php echo plugins_url('module.php?'.$cat.$placeid.$pageid.'&'.$user_info, __FILE__ )?>"> </object>
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
	<object  id="anozb-plugfrm" style="width:100%;  height:var(--ti-plugin-height, 500px);"
	data="<?php echo plugins_url('module.php?view=single&get~urn='.$urn, __FILE__ )?>"> </object>
	<div style="height: 3px"></div>
<?php return ob_get_end(); }?>

<?php function loadreceipt() { ?>
<?php $test= $_GET['zb_result'];
$result = str_replace('\"', '"', $test); 
ob_start(); ?>
	<script type="text/javascript" src="https://cdn.zirbana.com/js/jquery/1.7.2/jquery.min.js"></script>
	<object  id="anozb-plugfrm" style="width:100%;  height:var(--ti-plugin-height, 500px); margin-top:-30px;"
	 data='<?php echo plugins_url("module.php?backtoken=".$_GET['backtoken']."&zb_result=".urlencode($result), __FILE__ )?>'> </object>
	<div style="height: 3px"></div>
<?php return ob_get_end(); } ?>

<?php
function submenu2(){
?>
<object style="width: 100%;height: 100vh" data=<?php echo plugin_fineurl(".setup/settings.php")?>></object>
<?php
}
?>

<?php
function submenu3(){
?>
<object style="width: 100%;height: 100vh" data=<?php echo plugin_fineurl(".setup/shortcode.php")?>></object>
<?php
}
?>

<?php
function submenu4(){
?>
<object style="width: 100%;height: 100vh" data=<?php echo plugin_fineurl(".setup/document.php")?>></object>
<?php
}
?>