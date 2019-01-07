<?php
require_once 'php/tokener.php';
function load($atts){
	if($atts['cat']!="")
		$cat = $atts['cat'];
	if($atts['venue_id']!="")
		$placeid = $atts['venue_id'];
	 global $current_user; get_currentuserinfo();
	$user_info='user_login='. $current_user->user_login.'&user_email='.$current_user->user_email.'&user_firstname='.$current_user->user_firstname.'&user_lastname='.$current_user->user_firstname.'&display_name='.$current_user->display_name.'&user_id='.$current_user->ID.'&user_level='.$current_user->user_level;
?>
	<script type="text/javascript" src="https://cdn.zirbana.com/js/jquery/1.7.2/jquery.min.js"></script>
	<script type="text/javascript" src="/wp-content/plugins/tiwallJS/engine/utility.js"></script>
	<script type="text/javascript" src="/wp-content/plugins/tiwallJS/engine/scrollsync.js"></script>
	<object  id="anozb-plugfrm" style="width:100%;  height:var(--ti-plugin-height, 500px); margin-top:-30px;"
	data="<?php echo plugins_url('module.php?categories~_filter='.$cat.'&list~venue='.$placeid.'&'.$user_info, __FILE__ )?>"> </object>
	<div style="height: 3px"></div>
<?php }?>
<?php 
function loadsingle($atts){
	if($atts['urn']!="")
		$urn = $atts['urn'];?>
	<script type="text/javascript" src="https://cdn.zirbana.com/js/jquery/1.7.2/jquery.min.js"></script>
	<script type="text/javascript" src="/wp-content/plugins/tiwallJS/engine/utility.js"></script>
	<script type="text/javascript" src="/wp-content/plugins/tiwallJS/engine/scrollsync.js"></script>
	<object  id="anozb-plugfrm" style="width:100%;  height:var(--ti-plugin-height, 500px); margin-top:-30px;"
	data="<?php echo plugins_url('module.php?view=single&get~urn='.$urn, __FILE__ )?>"> </object>
	<div style="height: 3px"></div>
<?php }?>
<?php function loadreceipt() { ?>
<?php $test= $_GET['zb_result'];
$result = str_replace('\"', '"', $test);?>
	<script type="text/javascript" src="https://cdn.zirbana.com/js/jquery/1.7.2/jquery.min.js"></script>
	<object  id="anozb-plugfrm" style="width:100%;  height:var(--ti-plugin-height, 500px); margin-top:-30px;"
	 data='<?php echo plugins_url("module.php?backtoken=".$_GET['backtoken']."&zb_result=".urlencode($result), __FILE__ )?>'> </object>
	<div style="height: 3px"></div>
<?php } ?>
<?php
function submenu2(){
?>
<object style="width: 100%;height: 100vh"  data="../wp-content/plugins/tiwallJS/.setup/settings.php"></object>
<?php
}
?>
<?php
function submenu3(){
?>
<object style="width: 100%;height: 100vh"  data="../wp-content/plugins/tiwallJS/.setup/shortcode.php"></object>
<?php
}
?>
<?php
function submenu4(){
?>
<object style="width: 100%;height: 100vh"  data="../wp-content/plugins/tiwallJS/.setup/document.php"></object>
<?php
}
?>