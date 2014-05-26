/**
 *
 * TODO : mettre ce code dans un fichier séparé
 *
 **/
function in_array(needle, haystack, argStrict) {
    var key = '',
        strict = !! argStrict;

    if (strict) {
        for (key in haystack) {
            if (haystack[key] === needle) {
                return true;
            }
        }
    } else {
        for (key in haystack) {
            if (haystack[key] == needle) {
                return true;
            }
        }
    }

    return false;
}
function nodeToString ( node ) {
    var tmpNode = document.createElement( "div" );
    tmpNode.appendChild( node.cloneNode( true ) );
    var str = tmpNode.innerHTML;
    tmpNode = node = null; // prevent memory leaks in IE
    return str;
}

$(document).ready(function()
{
    new meta.Ratio({max_width:1200,min_width:1024, default_width:1200});
    var is_ie7 = $('html').hasClass('ie7');
});

$(window).load(function()
{
    $("body").removeClass("loading").addClass("loaded");
});