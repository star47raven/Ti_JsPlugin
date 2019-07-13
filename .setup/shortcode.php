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
            var __config = { js: { debug: true } };
        </script>
        <script type="text/javascript" src="../engine/ti-get.js"></script>
        <script>
            function generateShortcode() {
                let s = '[zb-page';
                if ($('#allcats').attr('check') != 'true') {
                    s += 
                        ' cat="' + 
                        $('#helloKitty .sellcat[check="true"]').toArray()
                        .reduce((a, c) => a += (a ? ',' : '') + $(c).attr('cat'), "") + '"';
                }
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
                getTiCats(null, data => {
                    if (data.ok)
                        for (kitty in data.data) {
                            console.log(kitty);
                            $('#helloKitty').append(`
<div class="exotic-input checkbox sellcat" cat="${data.data[kitty].key}">
    <input name="cat" type="checkbox" />
</div>
<span>${data.data[kitty].text}</span>
<br/>`);
                        }
                });
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
                $('#helloKitty').on('exotic:check', '.sellcat', function() {
                    generateShortcode();
                });
                $('#allcats').on('exotic:check', function() {
                    if ($('#allcats').attr('check') == 'true')
                        $('#helloKitty').addClass('ti-hidden');
                    else
                        $('#helloKitty').removeClass('ti-hidden');
                    generateShortcode();
                });
            });
        </script>
        <form class="radiogroup">
            <h1><div id="scodeone" radio-class="type" class="exotic-input radiobox"><input type="radio" name="sone" /></div><span>کد کوتاه لیست</span></h1>
            <div id="settings-custom" class="main-settings ti-hidden">
                <div style="display: block">
                    <div id="allcats" class="exotic-input checkbox">
                        <input name="allcats" type="checkbox" />
                    </div>
                    <span>نمایش همه زمینه ها</span>
                    <br />
                    <div id="helloKitty" style="margin: 1rem">
                    </div>
                </div>
                <span class="duo-right">رویداد‌ها</span>
                <input class="exotic-input textbox duo-left" name="page_id" type="text" placeholder="Page ID/URN(s)" />
                <br />
                <span class="duo-right">محل/سالن‌ها</span>
                <input class="exotic-input textbox duo-left" name="venue_id" type="text" placeholder="Venue ID(s)" />
                <br style="margin-bottom: 30px" />
                <span>شناسه ها را با ویرگول انگلیسی "," از هم جدا کنید.</span>
            </div>
            <div id="output" class="ti-hidden"></div>
            
            <h1><div id="scodesingle" radio-class="type" class="exotic-input radiobox"><input type="radio" name="single" /></div><span>کد کوتاه تک رویداد</span></h1>
            <div id="settings-single" class="main-settings ti-hidden">
                <span class="duo-right">شناسه رویداد</span>
                <input class="exotic-input textbox duo-left" name="urn" type="text" placeholder="URN" />
            </div>
			<div id="outputs" class="ti-hidden"></div>
        </form>
        <center style="margin-bottom: 10px; margin-top: 15px;">Powered by <a><img src="http://x.anovase.com/logo-wide-w.svg" height="30px" style="vertical-align: baseline; margin-bottom: -5px;" /></a> 2018</center>
    </body>
</html> 