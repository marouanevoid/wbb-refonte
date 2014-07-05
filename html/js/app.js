
/**
 * Application
 *
 * Copyright (c) 2014 - Metabolism
 * Author:
 *   - Jérome Barbato <jerome@metabolism.fr>
 *
 * License: GPL
 * Version: 1.0
 *
 * Requires:
 *   - jQuery
 *
 **/

/**
 * indigen namespace.
 */
var meta = meta || {};

/**
 *
 */
meta.App = function() {

    var that = this;

    that.config = {
        speed   : 500,
        easing  : 'easeInOutCubic'
    };

    that.menu_open = false;



    that._mobileMenuEvents = function()
    {
        if( $(window).width() > 640 ) return;

        var $to_scroll  = $('.entire-content-scrollable, aside.mobile-menu');
        var $menu       = $('aside.mobile-menu');
        var $content    = $('.entire-content-scrollable');
        var $header     = $('header.mobile');
        var $menu_btn   = $header.find('.nav-icon a');
        var $body       = $('body');

        if( Modernizr.csstransforms3d )
        {
            $menu.on('webkitTransitionEnd transitionend msTransitionEnd oTransitionEnd', function () {

                if( that.menu_open )
                {
                    $body.removeClass('menu-open');
                    $to_scroll.removeAttr('style');
                    that.menu_open = false;
                }
                else
                {
                    var speed = Math.min(500, $(window).scrollTop()*2);
                    $('html,body').animate({scrollTop:0}, speed, that.config.easing, function()
                    {
                        $menu.height('auto');
                        $content.height($menu.height()-$header.height()-1);
                    });
                    that.menu_open = true;
                }
            });
        }

        $('header.mobile .nav-icon a').on('click touchstart', function(e)
        {
            e.preventDefault();

            if( that.menu_open )
            {
                $content.height('auto');
                $menu_btn.css('opacity', 1);

                if( Modernizr.csstransforms3d )
                {
                    $to_scroll.css({transform: 'translate3d(0,0,0)'});
                }
                else
                {
                    $to_scroll.animate({left:0}, that.config.speed, that.config.easing, function()
                    {
                        $body.removeClass('menu-open');
                        $to_scroll.removeAttr('style');
                        that.menu_open = false;
                    });
                }
            }
            else
            {
                $body.addClass('menu-open');
                $menu_btn.css('opacity', 0.5);

                $menu.height($content.height()+$header.height()+1);

                if( Modernizr.csstransforms3d )
                    $to_scroll.css({transform: 'translate3d(245px,0,0)'});
                else
                {
                    var speed = Math.min(500, $(window).scrollTop()*2);

                    $to_scroll.animate({left:'245px'}, that.config.speed, that.config.easing, function()
                    {
                        $('html,body').animate({scrollTop:0}, speed, that.config.easing, function()
                        {
                            $menu.height('auto');
                            $content.height($menu.height()-$header.height()-1);
                        });
                        that.menu_open = true;
                    });
                }
            }
        });

        /*$('.detect-scroll').swipe(
        {
            swipeLeft:function(){ $('header.mobile .nav-icon a').click() },
            swipeRight:function(){ $('header.mobile .nav-icon a').click() },
            threshold:4
        });*/

        $('.mobile-menu').swipe(
        {
            swipeLeft:function(){ $('header.mobile .nav-icon a').click() },
            threshold:30
        });

        /* bind events */
        $(document).on('focus', 'input[type=text], textarea', function()
        {
            $('body').addClass('fixfixed');
        })
        .on('blur', 'input[type=text], textarea', function()
        {
            $('body').removeClass('fixfixed');
            if( $(window).width() < 640 ) $('html,body').animate({scrollTop: $(window).scrollTop()-$('header.mobile').height()}, 300);
        });
    };



    that._barFinderEvents = function()
    {
        var $bar_finder = $('section.bar-finder');
        var $container  = $bar_finder.find('.twelve');
        var $is_animating = false;

        $('header .finder').click(function()
        {
            if($is_animating) return;

            if( $container.is(':visible') ) $bar_finder.find('.finder-close').click();
            else
            {
                $is_animating = true;

                $bar_finder.find('table').animate({opacity: '1'}, that.config.speed, that.config.easing);
                $bar_finder.find('.finder-arrow').animate({top: '-15px', opacity: '1'}, that.config.speed, that.config.easing);
                $bar_finder.find('.finder-close').animate({opacity: '1'}, that.config.speed, that.config.easing);
                $container.slideDown(that.config.speed, that.config.easing, function(){ $is_animating = false });
            }
        });

        $bar_finder.find('.finder-close').click(function()
        {
            if($is_animating) return;

            $is_animating = true;

            $bar_finder.find('table').animate({opacity: '0'}, that.config.speed, that.config.easing);
            $bar_finder.find('.finder-arrow').animate({top: '0', opacity: '0'}, that.config.speed, that.config.easing);
            $bar_finder.find('.finder-close').animate({opacity: '0'}, that.config.speed/2, that.config.easing);
            $container.slideUp(that.config.speed, that.config.easing, function(){ $is_animating = false });
        });
    };


    that._customScroll = function()
    {
        $('.custom-scroll').not('.jspScrollable').each(function()
        {
            $(this).jScrollPane({autoReinitialise: true, hideFocus:true});
        });
    };


    that._loadImages = function()
    {
        $('.force-load [data-src]').each(function()
        {
            $(this).attr('src', $(this).data('src'));
        });
    };



    /* Public attributes. */
    that._setupEvents = function(){

        $(window).load(function()
        {
            $("body").removeClass("loading").addClass("loaded");
        });

        $('a.see-more').click(function(e)
        {
            e.preventDefault();

            if( $(this).hasClass('fade') )
                $(this).velocity('fadeOut', { duration: speed, easing:easing});
            else
                $(this).velocity('slideUp', { duration: speed, easing:easing});

            $(this).next('.more').velocity('slideDown', { duration: speed, easing:easing});
        });

        $('a.scrolltop').click(function(e)
        {
            e.preventDefault();

            $('html, body').animate({scrollTop:0}, that.config.speed, that.config.easing);
        });

        that._barFinderEvents();

        that._mobileMenuEvents();

        that._loadImages();
        that._customScroll();

        $( document ).ajaxComplete(function() {

            setTimeout(function()
            {
                that._customScroll();

            }, 600);
        });
    };


    that._setupElements = function()
    {
        $('a.overlay-link').append('<img src="'+BASEURL+'images/blank.png"/>');
    };


    /**
     *
     */
    that.__construct = function()
    {
        that._setupElements();
        that._setupEvents();
        that._customScroll();
    };

    that.__construct();
};


$(document).ready(function()
{
    new meta.Ratio({max_width:1200,min_width:1024, default_width:1200});
    new meta.App();
});

