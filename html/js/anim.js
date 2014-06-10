/* TODO : Integrate in App.js */

var speed = 500;
var easing = "easeInOutCubic";

$( document ).ready(function() {

    // Search Drop Down Lists

        var plusBtn=$('.search .drop-list .btn-round');

        plusBtn.click(function(){
            if (plusBtn.hasClass('plus')) {
                $(this).addClass('minus').removeClass('plus').parent().next().slideDown();
            }
            else {
                $(this).addClass('plus').removeClass('minus').parent().next().slideUp();
            }
        });
    //
});