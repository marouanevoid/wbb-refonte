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

// facebook sign up
$(document).ready(function() {
    $('#facebook-signup').on('click', function() {
        FB.getLoginStatus(function(response) {
            if (response.status === 'connected') {
                FB.api('/me', function(response) {
                    console.log(response);
                    setTimeout(securityCheck, 500);
                });
            } else {
                FB.login(function(response) {
                    if (response.authResponse) {
                        console.log('Welcome!  Fetching your information.... ');
                        setTimeout(securityCheck, 500);
                    } else {
                        console.log('User cancelled login or did not fully authorize.');
                    }
                });
            }
        });
    });
});

function fillInForm(formId) {
    FB.getLoginStatus(function(response) {
        if (response.status === 'connected') {
            FB.api('/me', function(response) {
                console.log(response);
                if (formId === '#register_form_full') {
                    $(formId + ' #fos_user_registration_form_firstname').val(response.first_name);
                    $(formId + ' #fos_user_registration_form_lastname').val(response.last_name);
                    $(formId + ' #fos_user_registration_form_email').val(response.email);
                    if (response.gender === 'male') {
                        $('#fos_user_registration_form_title').find('option[value="M"]').attr('selected', 'selected').change();
                    } else {
                        $('#fos_user_registration_form_title').find('option[value="F"]').attr('selected', 'selected').change();
                    }
                    //alert(reponse.);
                } else if (formId === '#register_form') {
                    $(formId + ' #fos_user_registration_form_email').val(response.email);
                }
            });
        } else {
            FB.login(function(response) {
                if (response.authResponse) {
                    console.log('Welcome!  Fetching your information.... ');
                    fillInForm(formId);
                } else {
                    console.log('User cancelled login or did not fully authorize.');
                }
            });
        }
    });
}

// Register forms actions
$(document).ready(function() {
    $('#message').hide();
    $('#register_form').on('submit', function(e) {
        e.preventDefault();
        var form = $(this);
        var formUrl = form.attr('action');
        $.ajax({
            type: "POST",
            url: formUrl,
            data: form.serialize(),
            success: function(data) {
                if (data.code === '400') {
                    var errors = data.errors;
                    $('#message').find('ul').remove();
                    var errorsList = $('#message').show().append('<ul></ul>');
                    for (var i = 0; i < errors.length; i++) {
                        errorsList.find('ul').append('<li>' + errors[i] + '</li>');
                    }
                } else {
                    alert('Check your email fool !');
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                // Si erreur communication ?
            }
        });
    });
    $('#login_form').on('submit', function(e) {
        e.preventDefault();
        var form = $(this);
        var formUrl = form.attr('action');
        $.ajax({
            type: "POST",
            url: formUrl,
            data: form.serialize(),
            success: function(data) {
                console.log(data);
                if (data.code === '400') {
                    $('#login_error').html(data.error);
                } else {
                    window.location.reload();
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                // Si erreur communication ?
            }
        });
    });
});

// Popin
jQuery(document).ready(function($) {
    // Click anywhere on the page to get rid of lightbox window
    $('.mask').hide();
    $('.lighbox').click(function(e) {
        e.preventDefault();
        //Get clicked link data-show ID of tag to show
        var id_content = $(this).attr("data-show");
        var current_id = $("#" + id_content);
        var mask = $(".mask");

        if (current_id.length > 0) {
            //show lightbox window
            current_id.fadeIn("slow");

            // Add class to trigger ID
            current_id.addClass('void-popup');

            //show the mask
            mask.fadeIn("slow");
        } else {
            $('.mask').hide();
            current_id.removeClass("void-popup");
        }
    })
    $(".btn-close").click(function(e) {
        var current_popup = $(this).closest(".void-popup");
        current_popup.removeClass("void-popup");
        current_popup.fadeOut("fast");
        $(".mask").fadeOut("slow");
    })
});

// Favorites star
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
//        var url = "/app_dev.php"; //comment this line if you want it to work
        if (window.userConnected) {
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

                    }
                }
            });
        } else {
             $('#show-popin').click();
        }
    });
});