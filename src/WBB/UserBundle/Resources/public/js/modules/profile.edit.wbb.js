function readImage(input) {
    if ( input.files && input.files[0] ) {
        var FR= new FileReader();
        FR.onload = function(e) {
            $('#avatar-img').attr("src", e.target.result );
        };
        FR.readAsDataURL( input.files[0] );
    }
}

$(function(){
    // Entry Point
    $("#fos_user_profile_form_avatar_binaryContent").change(function(){
        readImage( this );
    });

    $(".auto-city").autocomplete({
        source: Routing.generate('wbb_cities_by_name'),
        minLength: 2
    });

    $(".auto-bars").autocomplete({
        source: Routing.generate('wbb_bars_by_name'),
        minLength: 2
    });

    $(".auto-brands").autocomplete({
        source: Routing.generate('wbb_tags_by_type_and_name', {'type': 6}),
        minLength: 2
    });

    $(".auto-cocktails").autocomplete({
        source: Routing.generate('wbb_tags_by_type_and_name', {'type': 3}),
        minLength: 2
    });

    //Edit Profile Validation
    $('#edit_profile_form').on('submit', function(e) {
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
                    $('#edit_profile_form #message').find('ul').remove();
                    var errorsList = $('#edit_profile_form #message div').show().append('<ul></ul>').parent();

                    for (var i = 0; i < errors.length; i++) {
                        errorsList.find('ul').append('<li>' + errors[i] + '</li>');
                    }
                    var idPrefix = '#fos_user_profile_form_';
                    for (var i = 0; i < fields.length; i++) {

                        switch (fields[i]) {
                            case 'birthdate':
                                $('.date-birthday .ui-dropdown').addClass('error');
                                break;
                            case 'country':
                                $('#edit_profile_form .country-dropdown .ui-dropdown').addClass('error');
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
});