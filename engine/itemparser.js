var __ticache_html = [];
function getProxyHtml(target, options, callback, state) {
    if (__ticache_html[target] === undefined)
    {
        $.ajax("struct/" + target + ".html", { 
            success: function(htmlx) {
                __ticache_html[target] = htmlx;
                var newtml = htmlx;
                for (var key in options)
                {
                    newtml = newtml.replace("$" + target + key + "$", options[key]);
                }
                callback(newtml, state);
            }
        });
    }
    else {
        var newtml = __ticache_html[target];
        for (var key in options)
        {
            newtml = newtml.replace("$" + target + key + "$", options[key]);
        } 
        callback(newtml, state);
    }
}

function getEventItemHtml(itemOptions, callback, state) {
    getProxyHtml('item', itemOptions, callback, state);
}

function getEventPickHtml(pickOptions, callback, state) {
    getProxyHtml('pick', pickOptions, callback, state);
}

function getCategoryHtml(catOptions, callback, state) {
    getProxyHtml('cat', catOptions, callback, state);
}

var __ticonfig = null;
function getTiConf(callback) {
    if (__ticonfig)
        callback(__ticonfig);
    else
    {
        var xhr = new XMLHttpRequest();
        xhr.addEventListener("load", function() {
            __ticonfig = JSON.parse(this.responseText);
            callback(__ticonfig);
        });
        xhr.open("GET", "config.json");
        xhr.send();
    }
}

/*function isUrnAllowed(urn) {
    return ($.inArray(urn, __ticonfig.allowed_urns) > -1);
}*/

function processMiniCast(datx, micro) {
    if (!datx.related_channels)
        return null;

    var _nxDIR = datx.related_channels.director;
    _nxDIR = (!_nxDIR) ? null : _nxDIR.list.reduce((whole, c, i) => whole + (i && ' و ' || '') + c.title, "");

    var _nxAUT = datx.related_channels.writer;
    _nxAUT = (!_nxAUT) ? null : _nxAUT.list.reduce((whole, c, i) => whole + (i && ' و ' || '') + c.title, "");

    if (!(_nxDIR || _nxAUT))
        return "";
    else if (_nxDIR === _nxAUT)
        return (!micro ? "ن و ک: " : "") + _nxDIR;
    else
        return (!_nxDIR ? "" : ((!micro ? "ک: " : "") + _nxDIR)) + 
            ((_nxDIR && _nxAUT) ? " / " : "") + 
            (!_nxAUT ? "" : ((!micro ? "ن: " : "") + _nxAUT));
}