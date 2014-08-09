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
        popinFrom = 'signin';
        e.preventDefault();
        $('.popin-block').html('');
        var url = $(this).attr('href');
        window.ajaxRequest = $.ajax({
            url: url,
            method: 'GET',
            success: function(html) {
                $('.popin-block').html(html);
                initializeDropdowns();
                initRegisterLoginForms();
                $('#show-popin').click();
            },
            beforeSend: function()
            {
                console.log(window.ajaxRequest);
                if (window.ajaxRequest != null) window.ajaxRequest.abort();

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
                    $('#register_form').after($('#message'));
                    $('#register-form #message').find('ul').remove();
                    var errorsList = $('#register-form #message').show().find('img').after('<ul></ul>').parent();
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
        var formUrl = form.attr('action') 
        $.ajax({
            type: "POST",
            url: formUrl,
            data: form.serialize(),
            success: function(data) {
                console.log(data);
                if (data.code === '400') {
                    $('#username').addClass('error');
                    $('#password').addClass('error');
                    $('#facebook-signup').after($('#message'));
                    $('#login_form #message').find('ul').remove();
                    var errorsList = $('#login_form #message').show().append('<div><ul></ul></div>').parent();
                    errorsList.find('ul').append('<li>' + data.error + '</li>');
                } else {
                    window.location.href = currentPage + '?favoriteAction=' + addFavorite;
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                // Si erreur communication ?
            }
        });
    });
}

jQuery(document).ready(function($) {

    $('#register_form_full').on('submit', function(e) {
        e.preventDefault();
        var url = $(this).attr('action');

        $.ajax({
            url: url,
            method: 'POST',
            data: $(this).serialize(),
            success: function(data) {
                if (data.code === 400) {
                    var errors = data.errors.messages;
                    var fields = data.errors.fields;

                    $('#message').show();
                    $('#create-account #message').find('ul').remove();
                    var errorsList = $('#create-account #message div').show().append('<ul></ul>').parent();

                    for (var i = 0; i < errors.length; i++) {
                        errorsList.find('ul').append('<li>' + errors[i] + '</li>');
                    }
                    var idPrefix = '#fos_user_registration_form_';
                    for (var i = 0; i < fields.length; i++) {

                        switch (fields[i]) {
                            case 'birthdate':
                                // birthday error
                                break;
                            case 'plainPassword':
                                $(idPrefix + fields[i] + '_first').addClass('error');
                                $(idPrefix + fields[i] + '_second').addClass('error');
                                break;
                            default:
                                $(idPrefix + fields[i]).addClass('error');
                                break;
                        }
                    }
                } else {
                    window.location.href = profileWithPopinUrl;
                }
            }
        });
    });

    $('#message').hide();
    // PopIn.resize($('#register'));

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
        var html = '<div id="success" class="text-align-center padding-top-80 padding-bottom-80">' +
                '<p class="margin-top-20 margin-bottom-20">Your email is now confirmed. Welcome in the World’s Best Bars community!</p>' +
                '<p>You can now save your favorite bars, leave tips and receive the latest news from World’s Best Bars</p>'+
                '</div>';
        $('.popin-block').html(html);
        PopIn.resize($('#register'));
        $('#show-popin').click();
    }
    if (showResettingForm !== "0") {
        $('#show-popin').click();
    }
    if(showEmailPopin) {
        $('#show-popin').click();
        PopIn.resize($('#register'));
    }
    if(showLoginForm) {
        $('.btn-signin').click();
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
        var favUrl = $(this).attr('href');
//        var url = "/app_dev.php"; //comment this line if you want it to work
        if (window.userConnected) {
            $.ajax({
                type: "POST",
                url: favUrl,
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
                            if (btn.parents('.profile-fav-block').length) {

                                var TypeEvent = "removeitem",
                                        cible = "";
                                if(btn.parents('.three.columns.m-margin-top, #tab-bars .bar-w-pic-list').length){
                                    btn.parents('.three.columns.m-margin-top, #tab-bars .bar-w-pic-list').remove();
                                    cible = 'bars';
                                }
                                else{
                                    if( btn.parents('.best-of-container, #tab-bestof .bar-w-pic-list').length){
                                        btn.parents('.best-of-container, #tab-bestof .bar-w-pic-list').remove();
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
                        favoriteName = response.message;
                        console.log(response.message);
                    } else {

                    }
                }
            });
        } else {
            $('.popin-block').html('');
            var url = $('.btn-signin').attr('href') + '?favorite=' + favUrl;
            popinFrom = 'favorite';
            $.ajax({
                url: url,
                method: 'GET',
                success: function(html) {
                    html = '<div class="title margin-bottom-30 wrap bold">You need to create a profile to favourite a bar or leave a tip</div>' + html;
                    $('.popin-block').html(html);
                    initializeDropdowns();
                    initRegisterLoginForms();
                    $('#show-popin').click();
                }
            });
        }
    });
});