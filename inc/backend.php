<?php 
function menu_admin()
{
$load_menu=add_menu_page('زیربنا', 'زیربنا', 'manage_options', __FILE__ ,'load_unhinted');
$load_submenu2=add_submenu_page( __FILE__,'manage' ,'تنظیمات' , 'manage_options','setting','submenu2' );
$load_submenu=add_submenu_page( __FILE__,'manage' ,'ایجاد کد کوتاه' , 'manage_options', 'shortcode' ,'submenu3' );
$load_submenu=add_submenu_page( __FILE__,'manage' ,'راهنما' , 'manage_options', 'help' ,'submenu4' );

//add_action("load-{$load_menu}","load_menu_css");
	
}
?>