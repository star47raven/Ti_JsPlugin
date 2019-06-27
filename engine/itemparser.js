function INJECT(script) {
    document.writeIn(`<script type="text/javascript" src="${script}"></script>`);
}

INJECT `./struct.js/cat.js`;
INJECT `./struct.js/item.js`;
INJECT `./struct.js/pick.js`;

function getEventItemHtml(itemOptions, callback, state) {
    var newtml = __comp_item(itemOptions);
    callback(newtml, state);
}

function getEventPickHtml(pickOptions, callback, state) {
    console.warn(pickOptions);

    var newtml = __comp_pick(pickOptions);
    callback(newtml, state);
}

function getCategoryHtml(catOptions, callback, state) {
    var newtml = __comp_cat(catOptions);
    callback(newtml, state);
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