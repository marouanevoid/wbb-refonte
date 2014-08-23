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
        $('#edit_profile_form .country-dropdown .select2-choice').addClass('error');
    }

    if($('.date-birthday').hasClass('error')){
        $('.date-birthday .ui-dropdown').addClass('error');
        $('.date-birthday .select2-choice').addClass('error');
    }

    if($('#message').length && $('#message').hasClass('show'))
    {
        $('#message').show();
    }

    // Entry Point
    $("#fos_user_profile_form_avatar_binaryContent").change(function(){
        readImage( this );
        // if is IE 9
        if($('.ie9').length){
            var fname = $("#fos_user_profile_form_avatar_binaryContent").val();
            fname = fname.split('\'');
            fname = fname[fname.length-1];
            $('.file-name-selected-screen').find('p').text(fname);
            $('.file-name-selected-screen').show()
            $('.file-name-selected-screen-clear').show()
        }
    });

    // Resend email Verification token
    $('#resend-validation').on('click', function()
    {
        var _that = $(this);
        var requestID = $.ajax({
            type: "GET",
            url: Routing.generate('wbb_resend_email_confirmation'),
            dataType: "json",
            success: function(msg) {
                if(msg.code === 200){
                    _that.html("Confirmation email sent !");
                    setTimeout(function() { _that.fadeOut("slow") }, 5000);
                }
            },
            beforeSend: function()
            {
                if (requestID != null)
                    requestID.abort();
            },
            error: function(e) {
            }
        });
    });

    // click on close picture
    $('.ie9-close-pic').on('click',function(){
        $('.file-name-selected-screen').hide()
        $('.file-name-selected-screen-clear').hide()
        $("#fos_user_profile_form_avatar_binaryContent").val("");
    });

    $(".auto-city").autocomplete({
        source: Routing.generate('wbb_cities_by_name'),
        minLength: 2,
        select: function (event, ui) { }
    });

    $(".auto-bars").autocomplete({
        source: Routing.generate('wbb_bars_by_name'),
        minLength: 2,
        select: function (event, ui) { }
    });

    $(".auto-brands").autocomplete({
        source: Routing.generate('wbb_tags_by_type_and_name', {'type': 6}),
        minLength: 2,
        select: function (event, ui) { }
    });

    $(".auto-cocktails").autocomplete({
        source: Routing.generate('wbb_tags_by_type_and_name', {'type': 3}),
        minLength: 2,
        select: function (event, ui) {  }
    });

});