
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



    that._mobileMenuEvents = function()
    {
        $('header.mobile .nav-icon a').on('click touchstart', function(e)
        {
            e.preventDefault();

            var $to_scroll  = $('.entire-content-scrollable');
            var $body       = $('body');
            var transformation;

            if( $body.hasClass("menu-open") )
            {
                if( Modernizr.csstransforms3d )
                    $to_scroll.css({transform: 'translate3d(0,0,0)'});
                else
                    $to_scroll.animate({left:0}, that.config.speed, that.config.easing);

                setTimeout(function()
                {
                    $body.removeClass('menu-open');
                    $to_scroll.removeAttr('style');

                }, that.config.speed);
            }
            else
            {
                $body.addClass('menu-open');

                if( Modernizr.csstransforms3d )
                    $to_scroll.css({transform: 'translate3d(245px,0,0)'});
                else
                    $to_scroll.animate({left:'245px'}, that.config.speed, that.config.easing);

            }
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

                $bar_finder.find('table').velocity({opacity: '1'}, speed, easing);
                $bar_finder.find('.finder-arrow').velocity({top: '-15px', opacity: '1'}, speed, easing);
                $bar_finder.find('.finder-close').velocity({opacity: '1'}, speed, easing);
                $container.velocity('slideDown', { duration: speed, easing:easing, complete:function(){ $is_animating = false } });
            }
        });

        $bar_finder.find('.finder-close').click(function()
        {
            if($is_animating) return;

            $is_animating = true;

            $bar_finder.find('table').velocity({opacity: '0'}, speed, easing);
            $bar_finder.find('.finder-arrow').velocity({top: '0', opacity: '0'}, speed, easing);
            $bar_finder.find('.finder-close').velocity({opacity: '0'}, speed/2, easing);
            $container.velocity('slideUp', { duration: speed, easing:easing, complete:function(){ $is_animating = false } });
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
            $(this).next('.more').slideToggle(that.config.speed, that.config.easing);
        });

        that._barFinderEvents();
        that._mobileMenuEvents();
    };



    /**
     *
     */
    that.__construct = function()
    {
        that._setupEvents();
    };

    that.__construct();
};


$(document).ready(function()
{
    new meta.Ratio({max_width:1200,min_width:1024, default_width:1200});
    new meta.App();
});

