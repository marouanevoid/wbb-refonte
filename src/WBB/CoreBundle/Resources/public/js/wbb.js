function in_array(needle, haystack, argStrict) {
    var key = '',
            strict = !!argStrict;

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

function nodeToString(node) {
    var tmpNode = document.createElement("div");
    tmpNode.appendChild(node.cloneNode(true));
    var str = tmpNode.innerHTML;
    tmpNode = node = null; // prevent memory leaks in IE
    return str;
}

$(document).ready(function() {
    var allInputs = $(":input");
    $(allInputs).attr('autocomplete', 'off');
    $('#city_selector').change(function() {
        document.location = $(this).val();
    });
    $(document).on("click", ".star", function(e) {
        e.preventDefault();
        var btn = $(this);
        var url = $(this).attr('href');
        $.ajax({
            type: "POST",
            url: url,
            success: function(response) {
                if (response.code === 200) {
                    btn.attr('href', response.href);
                    if (btn.hasClass('active')) {
                        btn.hide();
                        btn.removeClass('active');
                        if (btn.hasClass('changed')) {
                            btn.removeClass('brown');
                            btn.addClass('dark');
                            btn.removeClass('changed');
                        }
                        if (btn.hasClass('nc')) {
                            btn.addClass('force-disabled')
                        }
                        btn.show();
                    } else {
                        btn.hide();
                        btn.addClass('active');
                        if (btn.hasClass('dark')) {
                            btn.addClass('changed');
                            btn.addClass('brown');
                            btn.removeClass('dark');
                        }
                        if (btn.hasClass('force-disabled')) {
                            btn.removeClass('force-disabled')
                        }
                        btn.show();
                    }
                    console.log(response.message);
                } else {
                    $('#show-popin').click();
                }

            }
        });
    });
});