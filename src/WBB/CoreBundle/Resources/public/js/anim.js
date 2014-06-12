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

    // Search Bar Mobile Display

        var openBtn=$('.search-pin-icon .search');
        var closeBtn=$('.search-bar-mobile .close');
        var searchBar=$('.search-bar-mobile');

        openBtn.click(function() {
            searchBar.fadeIn();
            searchBar.find('.container').show();
            setTimeout(function(){
                searchBar.find('.container').css({transform:'translate3d(0,0%,0)'})
            }, 10)
        });
        closeBtn.click(function() {
            searchBar.fadeOut();
            searchBar.find('.container').css({transform:'translate3d(0,-100%,0)'})
            setTimeout(function(){
                searchBar.hide()
            }, 500)
        });
    //
});