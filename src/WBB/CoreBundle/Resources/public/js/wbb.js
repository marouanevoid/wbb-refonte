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
    /*$(function () {
        $("img").bind('error abort', function () {
            if(!$(this).parent().hasClass('city'))
                $(this).attr("src", BASEURL+'images/default.jpg');
        });
    });*/
    $('#city_selector').change(function(){
        document.location = $(this).val();
    });
    $(".star").click(function(){
        concole.log('click on star !');
        var btn = $(this);
        $.ajax({
            type: "POST",
            url:  '/',
            success: function() {
                if(btn.hasClass('active')){
                    btn.hide();
                    btn.removeClass('active');
                    if(btn.hasClass('changed')){
                        btn.removeClass('brown');
                        btn.addClass('dark');
                        btn.removeClass('changed');
                    }
                    if(btn.hasClass('nc')){
                        btn.addClass('force-disabled')
                    }
                    btn.show();
                }else{
                    btn.hide();
                    btn.addClass('active');
                    if(btn.hasClass('dark')){
                        btn.addClass('changed');
                        btn.addClass('brown');
                        btn.removeClass('dark');
                    }
                    if(btn.hasClass('force-disabled')){
                        btn.removeClass('force-disabled')
                    }
                    btn.show();
                }
            }
        });
    });
});