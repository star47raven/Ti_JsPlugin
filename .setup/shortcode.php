<?php
    error_reporting(0);

  require_once('../inc/php/paths.php');
    $app_config = null;

    $f = file_get_contents($config_path);
    if ($f)
        $app_config = json_decode($f);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="../style/core.css" />
        <link rel="stylesheet" href="../style/setup.css" />
    </head>
    <body>
        <script type="text/javascript" src="https://cdn.zirbana.com/js/jquery/1.7.2/jquery.min.js"></script>
        <script type="text/javascript" src="../engine/exoticengine.js"></script>
        <script>
            function generateShortcode() {
                let s = '[zb-page';
                $.map($('#settings-custom input[type="text"]'), k => {
                    //if ($(k).val())
                    s += ` ${$(k).attr('name')}="${$(k).val()}"`;
                });
                s += ']';
                $('#output').text(s);

                let x = '[zb-page-single';
                $.map($('#settings-single input[type="text"]'), k => {
                    //if ($(k).val())
                    x += ` ${$(k).attr('name')}="${$(k).val()}"`;
                });
                x += ']';
                $('#outputs').text(x);
            }

            $(document).ready(() => {
                generateShortcode();
                $('input[type="text"]').on('input', generateShortcode);
                $('input[name="sone"]').on('exotic:check', function() {  
                    if ($(this).prop('checked')){
                        $('#settings-custom').removeClass('ti-hidden');
						$('#output').removeClass('ti-hidden');
					}
					else {
                        $('#settings-custom').addClass('ti-hidden');
						$('#output').addClass('ti-hidden');
					}
                });
                $('input[name="single"]').on('exotic:check', function() {  
                    if ($(this).prop('checked')){
                        $('#settings-single').removeClass('ti-hidden');
						$('#outputs').removeClass('ti-hidden');
					}
					else {
                        $('#settings-single').addClass('ti-hidden');
						$('#outputs').addClass('ti-hidden');
					}
                });
            });
        </script>
        <form class="radiogroup">
            <h1><div id="scodeone" class="exotic-input radiobox"><input type="radio" name="sone" /></div><span>کد کوتاه لیست</span></h1>
            <div id="settings-custom" class="main-settings ti-hidden">
                <span class="duo-right">زمینه‌ها</span>
                <input class="exotic-input textbox duo-left" name="cat" type="text" placeholder="<?= isset($app_config->categories->_filter) ? $app_config->categories->_filter : '' ?>" />
                <br />
                <span class="duo-right">رویداد‌ها</span>
                <input class="exotic-input textbox duo-left" name="page_id" type="text" placeholder="<?= isset($app_config->list->page_id) ? $app_config->list->page_id : '' ?>" />
                <br />
                <span class="duo-right">محل/سالن‌ها</span>
                <input class="exotic-input textbox duo-left" name="venue_id" type="text" placeholder="<?= isset($app_config->list->venue) ? $app_config->list->venue : '' ?>" />
                <br style="margin-bottom: 30px" />
                <span>شناسه ها را با ویرگول انگلیسی "," از هم جدا کنید.</span>
            </div>
			<div id="output" class="ti-hidden"></div>
            <h1><div id="scodesingle" class="exotic-input radiobox"><input type="radio" name="single" /></div><span>کد کوتاه تک رویداد</span></h1>
            <div id="settings-single" class="main-settings ti-hidden">
                <span class="duo-right">شناسه رویداد</span>
                <input class="exotic-input textbox duo-left" name="urn" type="text" placeholder="URN" />
            </div>
            
			<div id="outputs" class="ti-hidden"></div>
        </form>
        <center style="margin-bottom: 10px; margin-top: 15px;">Powered by <a><img src="http://x.anovase.com/logo-wide-w.svg" height="30px" style="vertical-align: baseline; margin-bottom: -5px;" /></a> 2018</center>
    </body>
</html> 