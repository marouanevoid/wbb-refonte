/* TODO : Integrate in App.js */

var speed = 500;
var easing = "easeInOutCubic";

$( document ).ready(function() {


// Dropdown

    $('.dropdown').click(function() {
        if( $('.dropdown').hasClass("dropdown-open") ){
            $(this).removeClass('dropdown-open').find('.choice').slideDown(speed);
        }
        else{
            $(this).addClass('dropdown-open').find('.choice').slideUp(speed);
        }
    });
// End Dropdown
});