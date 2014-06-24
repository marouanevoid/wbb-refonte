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

$(document).ready(function(){
    $('img').error(function(){
        $(this).attr('src', BASEURL+'images/default.jpg');
    });
    $('#city_selector').change(function(){
        document.location = $(this).val();
    });
});