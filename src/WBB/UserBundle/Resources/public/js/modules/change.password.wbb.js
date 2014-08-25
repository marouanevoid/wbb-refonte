$(document).ready(function() {
    var textBtn = "";
    $('#change_password_form').on('submit', function(e){
        e.preventDefault();
        var form = $(this);
        var formUrl = form.attr('action');
        var requestID = $.ajax({
            type: "POST",
            url: formUrl,
            data: form.serialize(),
            success: function(data) {
                $('#change_password_form').find('input[type=submit]').val(textBtn);
                if (data.code === 400) {
                    var fields = data.errors.fields;
                    var errors = data.errors.messages;
                    console.log('this is me');
                    var idPrefix = '#fos_user_change_password_form_';
                    for (var i = 0; i < fields.length; i++) {
                        console.log(idPrefix + fields[i]);
                        switch (fields[i]) {
                            case 'plainPassword':
                                $(idPrefix + fields[i] + '_first').addClass('error');
                                $(idPrefix + fields[i] + '_second').addClass('error');
                                break;
                            default:
                                $(idPrefix + fields[i]).addClass('error');
                                break;
                        }
                    }
                    $('#change_password_form #message').find('ul').html('');
                    for (var i = 0; i < errors.length; i++) {
                        $('#change_password_form #message').find('ul').append('<li>' + errors[i] + '</li>');
                    }
                    $('#change_password_form #message').show();
                    // if ( ismobile || istablet )
                    $('html, body').animate({scrollTop: $('#message').offset().top }, 500, 'easeInOutCubic');
                }else{
                    window.location.href = Routing.generate('fos_user_profile_show');
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                // Si erreur communication ?
            },
            beforeSend: function() {
                textBtn = $('#change_password_form').find('input[type=submit]').val();
                $('#change_password_form').find('input[type=submit]').val("Loading...");
                if (requestID != null){
                    requestID.abort();
                }

                $('#change_password_form input').each(function(){
                    $(this).removeClass('error');
                });

            }
        });
    })
});
