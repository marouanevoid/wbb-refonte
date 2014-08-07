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
    $('.btn-signin').on('click', function(e) {
        e.preventDefault();
        $('.popin-block').html('');
        var url = $(this).attr('href');
        $.ajax({
            url: url,
            method: 'GET',
            success: function(html) {
                $('.popin-block').html(html);
                initializeDropdowns();
                initRegisterLoginForms();
                $('#show-popin').click();
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

                    var birthdayParts = response.birthday.split('/');
                    var month = (parseInt(birthdayParts[0]));
                    var day = (parseInt(birthdayParts[1]));
                    var year = (parseInt(birthdayParts[2]));
                    $('#fos_user_registration_form_birthdate_month').find('option[value="' + month + '"]').attr('selected', 'selected').change();
                    $('#fos_user_registration_form_birthdate_day').find('option[value="' + day + '"]').attr('selected', 'selected').change();
                    $('#fos_user_registration_form_birthdate_year').find('option[value="' + year + '"]').attr('selected', 'selected').change();
                } else if (formId === '#register_form') {
                    $(formId + ' #fos_user_registration_form_email').val(response.email);
                    var birthdayParts = response.birthday.split('/');
                    var month = (parseInt(birthdayParts[0]));
                    var day = (parseInt(birthdayParts[1]));
                    var year = (parseInt(birthdayParts[2]));

                    $(formId + ' #fos_user_registration_form_birthdate_month').find('option[value="' + month + '"]').attr('selected', 'selected').change();
                    $(formId + ' #fos_user_registration_form_birthdate_day').find('option[value="' + day + '"]').attr('selected', 'selected').change();
                    $(formId + ' #fos_user_registration_form_birthdate_year').find('option[value="' + year + '"]').attr('selected', 'selected').change();
                }
            });
        } else {
            FB.login(function(response) {
                if (response.authResponse) {
                    fillInForm(formId);
                } else {
                    console.log('User cancelled login or did not fully authorize.');
                }
            }, {scope: 'email,user_birthday,user_location'});
        }
    });
}

// Register forms actions
function initRegisterLoginForms() {
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
                }, {scope: 'email,user_birthday,user_location'});
            }
        });
    });

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
                    var errorsList = $('#message').show().find('img').after('<ul></ul>').parent();
                    for (var i = 0; i < errors.length; i++) {
                        errorsList.find('ul').append('<li>' + errors[i] + '</li>');
                    }
                } else {
                    var html = '<div id="success" class="text-align-center padding-top-80">' +
                            '<div class="subtitle text-transform-uppercase margin-top-80">Congratulations!</div>' +
                            '<p class="margin-top-20 margin-bottom-20">You are now registered on  World’s Best Bars.</p>' +
                            '<p>Check your mailbox <br />' +
                            'to confirm your subscription.</p>' +
                            '</div>';
                    $('.popin-block').html(html);
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
}

// Popin
jQuery(document).ready(function($) {

    function resizer(element){
        //Centred popup
        var current_id = $("#" + element);
        // width = -1 * parseInt((current_id.width()/2));
        // height = -1 * parseInt((current_id.height()/2));
        // current_id.css('margin-left', width).css('margin-top', height);
        current_id.css({
            "top": (($(window).height() - current_id.height()) / 2) + $(window).scrollTop(),
            "left": (($(window).width() - current_id.width()) / 2) + $(window).scrollLeft()
        });
    }

    // Click anywhere on the page to get rid of lightbox window
    $('.mask').hide();
    $('.lighbox').click(function(e) {
        e.preventDefault();
        //Get clicked link data-show ID of tag to show
        var id_content = $(this).attr("data-show");
        var current_id = $("#" + id_content);
        var current_ui = $("#" + id_content +" .ui");
        var mask = $(".mask");

        if (current_id.length > 0) {

            //Centred popup
            resizer(id_content);

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
    });

    $(".btn-close").click(function(e) {
        var current_popup = $(this).closest(".void-popup");
        current_popup.fadeOut("fast");
        $(".mask").fadeOut("slow", function() {
            current_popup.removeClass("void-popup");
            current_popup.attr("class", "popup");
        });
    });

    $(".mask").click(function(e) {
        var current_popup = $("body").find(".void-popup");
        current_popup.fadeOut("fast");
        $(".mask").fadeOut("slow", function() {
            current_popup.removeClass("void-popup");
            current_popup.attr("class", "popup");
        });
    });

    if (showNewPassword) {
        var url = newPasswordUrl;
        $.ajax({
            url: url,
            method: 'GET',
            success: function(html) {
                $('.popin-block').html(html);
                $('#show-popin').click();
            }
        });
    }
    if (showConfirmed) {
        var html = 'Your email is now confirmed. Welcome in the World’s Best Bars community!' +
                'You can now save your favorite bars, leave tips and receive the latest news from World’s Best Bars';
        $('.popin-block').html(html);
        $('#show-popin').click();
    }
    if (showResettingForm !== "0") {
        $('#show-popin').click();
    }
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

                            // destroy the item parent on profile
                            if(btn.parents('.profile-fav-block').length){

                                var TypeEvent = "removeitem",
                                    cible = "";
                                if(btn.parents('.three.columns.m-margin-top').length){
                                    btn.parents('.three.columns.m-margin-top').remove();
                                    cible = 'bars';
                                }
                                else{
                                    if( btn.parents('.best-of-container').length){
                                        btn.parents('.best-of-container').remove();
                                         cible = 'bestof';
                                    }
                                }

                                // dispatching Event removeitem
                                $.event.trigger({
                                    type: "removeitem",
                                    cible: cible
                                });
                            }
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
            $('.popin-block').html('');
            var url = $('.btn-signin').attr('href');
            $.ajax({
                url: url,
                method: 'GET',
                success: function(html) {
                    $('.popin-block').html(html);
                    initializeDropdowns();
                    initRegisterLoginForms();
                    $('#show-popin').click();
                }
            });
        }
    });
});