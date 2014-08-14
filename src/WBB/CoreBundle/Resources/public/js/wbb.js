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

        // Set the PopIn Loading Flag
        PopIn.startLoading();
        window.ajaxRequest = $.ajax({
            url: url,
            method: 'GET',
            success: function(html) {
                // Set the PopIn Loading Flag
                PopIn.endLoading();

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

    function submitShareMail(element) {
        window.shareRequest = $.ajax({
            url: element.attr('action'),
            method: 'GET',
            data: element.serialize(),
            success: function(html) {
                // Set the PopIn Loading Flag
                PopIn.endLoading();
                $('.popin-block').html(html);
                $('#show-popin').click();
                // add listner on click send mail
                $('.popin-block').find('form').off('submit').on('submit' , function (e) {
                        e.preventDefault();
                        submitShareMail($(this));
                    }
                );
            },
            beforeSend: function()
            {
                if (window.shareRequest != null) window.shareRequest.abort();
            }
        });
    }

    $('.email-share').on('click', function(e) {
        e.preventDefault();
        $('.popin-block').html('');
        var url = $(this).data('href');

        // Set the PopIn Loading Flag
        PopIn.startLoading();
        window.ajaxRequest = $.ajax({
            url: url,
            method: 'GET',
            success: function(html) {
                // Set the PopIn Loading Flag
                PopIn.endLoading();
                $('.popin-block').html(html);
                $('#show-popin').click();

                // add listner on click send mail
                $('.popin-block').find('form').off('submit').on('submit' , function (e) {
                        e.preventDefault();
                        submitShareMail($(this));
                    }
                );
            },
            beforeSend: function()
            {
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
                if (data.code == '400') {
                    var errors = data.errors.messages;
                    var fields = data.errors.fields;

                    $('#message').show();
                    $('#register_form').after($('#message'));
                    $('#register-form #message').find('ul').remove();
                    $('#register-form #message div').append('<ul></ul>').parent();
                    $('#register_form input').each(function() {
                        $(this).removeClass('error');
                    });
                    $('#register_form .ui-dropdown').each(function() {
                        $(this).removeClass('error');
                    });
                    var idPrefix = '#fos_user_registration_form_';
                    for (var i = 0; i < fields.length; i++) {
                        switch (fields[i]) {
                            case 'country':
                                $('#register-form .country-dropdown .ui-dropdown').addClass('error');
                                break;
                            case 'birthdate':
                                $('#register-form .date-birthday .ui-dropdown').addClass('error');
                                break;
                            case 'birthday':
                                $('#register-form .date-birthday .ui-dropdown').addClass('error');
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
                    for (var i = 0; i < errors.length; i++) {
                        $('#register-form #message').find('ul').append('<li>' + errors[i] + '</li>');
                    }
                } else {
                    if (addFavorite.indexOf('favorite') > -1) {
                        $.cookie('light_action', 'favorite');
                    } else {
                        $.cookie('light_action', 'tips');
                    }
                    $.cookie('light_type', window.lightType);
                    $.cookie('light_url', addFavorite);
                    $.cookie('light_from', 'register');
                    $.cookie('light_name', window.lightName);

                    $.cookie('just_loggedin', true);
                    window.location.reload();
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
        var error = false;
        $('#username').removeClass('error');
        $('#password').removeClass('error');
        if ($('#username').val().trim() === '') {
            error = true;
            $('#username').addClass('error');
        }
        if ($('#password').val().trim() === '') {
            error = true;
            $('#password').addClass('error');
        }
        if (!error) {
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
                        var errorsList = $('#login_form #message').show().append('<ul></ul>').parent();
                        errorsList.find('ul').append('<li>' + data.error + '</li>');
                    } else {
                        if (addFavorite != 0) {
                            if (addFavorite.indexOf('favorite') > -1) {
                                $.cookie('light_action', 'favorite');
                            } else {
                                $.cookie('light_action', 'tips');
                            }
                            $.cookie('light_type', window.lightType);
                            $.cookie('light_url', addFavorite);
                            $.cookie('light_from', 'login');
                            $.cookie('light_name', window.lightName);
                        }

                        $.cookie('just_loggedin', true);
                        window.location.reload();
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    // Si erreur communication ?
                }
            });
        }
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
                    $('#register_form_full input').each(function() {
                        $(this).removeClass('error');
                    });
                    $('#register_form_full .ui-dropdown').each(function() {
                        $(this).removeClass('error');
                    });
                    for (var i = 0; i < fields.length; i++) {

                        switch (fields[i]) {
                            case 'birthdate':
                                $('.date-birthday .ui-dropdown').addClass('error');
                                break;
                            case 'birthday':
                                $('.date-birthday .ui-dropdown').addClass('error');
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


// Animate the scroll to focus on PopIn
function animateToPopIn(){
    if ( ismobile )
        $('html, body').animate({scrollTop:0}, 500, 'easeInOutCubic');
}



// syncronise Bar favorie
function syncBarFav(cible,status){
    var href = cible.attr('href'),
        currentTitle = cible.parent('article').find('.overlay-link').attr('href');
    // find the other Bar on dom 
    // wich content the same name
    $('.star').closest('article').find('.overlay-link').each(function(){
        if($(this).attr('href') == currentTitle){
            // This bar is like favoried Bar
            // set the Class active
            var artcileParent =  $(this).parents('article');
            if(status){
                var btn = artcileParent.find('.star');
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
            }
            else{
                var btn = artcileParent.find('.star');
                btn.removeClass('active');
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
            // set the href url
            artcileParent.find('.star').attr('href' , href);
        }
    });
} 

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
        window.lightName = $(this).attr('data-name');
        window.lightType = $(this).attr('data-type');
//        var url = "/app_dev.php"; //comment this line if you want it to work
        if (window.userConnected) {
            if(btn.hasClass('active')){
                btn.addClass('loading-active');
            }else{
                btn.addClass('loading');
            }
            $.ajax({
                type: "POST",
                url: favUrl,
                success: function(response) {
                    btn.removeClass('loading');
                    btn.removeClass('loading-active');

                    if (response.code === 200) {
                        btn.attr('href', response.href);
                        if (btn.hasClass('active')) {
                            btn.hide();
                            btn.removeClass('active');
                            // search sync bars
                            syncBarFav(btn,true);
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
                               /* if(btn.parents('.three.columns.m-margin-top, #tab-bars .bar-w-pic-list').length || btn.parents('article').not('.bestof').length ){
                                    btn.parents('.three.columns.m-margin-top, #tab-bars .bar-w-pic-list').remove();
                                    cible = 'bars';

                                    if( btn.parents('article').not('.bestof').length ){
                                        btn.parents('article').not('.bestof').remove();
                                    }
                                }
                                else{
                                    if( btn.parents('.best-of-container, #tab-bestof .bar-w-pic-list').length || btn.parents('article.bestof').length ){
                                        btn.parents('.best-of-container, #tab-bestof .bar-w-pic-list').remove();
                                        cible = 'bestof';

                                        if( btn.parents('article.bestof').length ){
                                            btn.parents('article.bestof').remove();
                                        }
                                    }
                                }*/
                                // global var on window
                                //window.cibleDeleted = cible;
                                // dispatching Event removeitem

                                var clickedItem = {type:  btn.data("type"), id:  btn.data("id")};

                                $.event.trigger({
                                    type: "removeitem",
                                    cible: clickedItem
                                });
                            }
                        } else {
                            btn.hide();
                            btn.addClass('active');

                            // search sync bars
                            syncBarFav(btn,false);

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
            // Set the PopIn Loading Flag
            PopIn.startLoading();
            $.ajax({
                url: url,
                method: 'GET',
                success: function(html) {
                    // Set the PopIn Loading Flag
                    PopIn.endLoading();

                    html = '<div class="title margin-bottom-30 wrap bold">You need to create a profile to favourite a bar or leave a tip</div>' + html;
                    $('.popin-block').html(html);
                    initializeDropdowns();
                    initRegisterLoginForms();
                    $('#show-popin').click();

                    // focus on Popin if is Mobile
                    animateToPopIn();
                }
            });
        }
    });
});