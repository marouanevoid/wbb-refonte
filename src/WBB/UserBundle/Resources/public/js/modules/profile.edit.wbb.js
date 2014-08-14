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

    if($('#fos_user_profile_form_country').hasClass('error')){
        $('#edit_profile_form .country-dropdown .ui-dropdown').addClass('error');
    }

    if($('.date-birthday').hasClass('error')){
        $('.date-birthday .ui-dropdown').addClass('error');
    }

    if($('#message').length && $('#message').hasClass('show'))
    {
        $('#message').show();
    }

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

});