/**
 * Slider
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
 * metabolism namespace.
 */
var meta = meta || {};

/**
 *
 */
meta.Slider = function(config){
    var that = this;

    /* Contructor. */

    /**
     *
     */
    that.__construct =  function(config)
    {
        that.config = $.extend(that.config, config);
        that._setupContext();
        that._addComponents();
        that._setupLayout();
        that._setupEvents();
        that._animateArrow();
    };

    /* Public */

    that.config = {
        $container  : null,
        has_dots    : false,
        has_arrows  : false,
        slide       : '.ui-slide',
        dots        : '.dots',
        infinite    : false,
        autoload    : false,
        swipe       : false,
        speed       : 600,
        easing      : 'easeInOutCubic',
        default_img : 'images/default.jpg',
        animate_arrow   : false,
        autoplay_delay  : 5000,
        autoplay        : false,
        animation       : 'latency'
    };

    that.context = {
        $slider  : null,
        $slides  : null,
        $dots    : null,
        $arrows  : null
    };

    that.interval = false;
    that.is_running = false;
    that.arrow_interval = false;
    that.arrow_direction = true;



    /* Private. */

    /**
     *
     */
    that._setupContext = function() {

        that.context.$slider    = that.config.$container;
        that.context.$slides    = that.context.$slider.find(that.config.slide);
        that.context.$dots      = that.context.$slider.find(that.config.dots);

        var min_slide_length = that.config.autoload ? 0 : 1;

        that.config.has_arrows  = that.config.has_arrows && that.context.$slides.length > min_slide_length;
        that.config.has_dots    = that.config.has_dots && that.context.$slides.length > min_slide_length;
    };



    that._addComponents = function() {

        that.context.$slider.wrapInner('<div class="ui-slides"/>');

        if( that.config.has_arrows ){

            that.context.$slider.append
            (
                '<div class="arrows"><a class="left"/><a class="right"/></div>'
            );

            that.context.$arrows = that.context.$slider.find('.arrows a');

            if( !that.config.infinite || (that.config.autoload && that.config.infinite) )
                that.context.$arrows.filter('.left').hide();
        }

        if( that.config.has_dots ){

            var html = new Array( that.context.$slides.length+1 ).join('<a></a>');

            that.context.$dots.append(html).find('a:first').addClass('active');
            that.context.$dots = that.context.$dots.find('a');
        }
        else that.context.$dots.remove();

    };



    that._setupLayout = function() {

        that.context.$slides.not('.active').hide();

        if( !that.context.$slides.filter('.active').length ){

            that.context.$slides.first().show().addClass('active');

            var $slides = that.context.$slides.eq(0).add( that.context.$slides.eq(1) );
            that._loadImages($slides);
        }
    };


    that._loadImages = function( $container ){

        var $images = $container.find('img[data-src]');

        var is_oldIE = $('html').hasClass('ie8') || $('html').hasClass('ie9');

        $images.error(function(){

            if( is_oldIE ) $(this).css({opacity:1});
            else $(this).attr('src', BASEURL+that.config.default_img ).css({opacity:1});

        }).load(function(){

            $(this).css({opacity:1});
        });

        $images.each(function(){

            $(this).attr('src', $(this).data('src'));
            $(this).removeAttr('data-src');
        })

    };



    that._setupEvents = function() {

        if( that.config.has_arrows ){

            that.context.$arrows.click(function(e)
            {
                e.preventDefault();

                if( $(this).hasClass('left') ) that._slide('left');
                else  that._slide('right');
            });
        }

        if( that.config.has_dots ){

            that.context.$dots.click(function(e)
            {
                e.preventDefault();

                var index = $(this).index();
                that._slideTo(index);
            });
        }


        if( that.config.swipe ){

            that.context.$slider.swipe(
                {
                    swipeLeft:function(){ that._slide('right') },
                    swipeRight:function(){ that._slide('left') },
                    longTap: function(event, target) {
                        $(target).closest('.popin').click();
                    }
                });
        }

        if( that.config.autoplay ){

            $(window).load(function(){ that._setInterval() });

            that.context.$slider.hover(function(){ clearInterval(that.interval) }, function(){ that._setInterval()  });
        }

        $(document).on('Slider.update', function(event, $slider)
        {
            if( !$slider.is(that.context.$slider) ) return;

            that.context.$slides = that.context.$slider.find(that.config.slide);
            that._setupLayout();

            if( that.context.$slides.filter('.active').index() >= that.context.$slides.length-1)
            {
                if(!that.config.infinite) that.context.$arrows.filter('.right').fadeOut(that.config.speed);
            }
            else
            {
                var $next_slide = that.context.$slides.filter('.active').next(that.config.slide);
                that._loadImages( $next_slide );
            }

        });

    };


    that._setInterval = function(){

        clearInterval(that.interval);

        that.interval = setInterval(function(){

            that._slide('right');

        }, that.config.autoplay_delay);
    };



    that._animateSlides = function( $current, $next, goto_left, callback ){

        if(!$next.length)
        {
            if(callback) callback();
            return;
        }

        switch( that.config.animation )
        {
            case 'latency':

                that._animateSlidesWithLatency($current, $next, goto_left, callback);

            break;

            default:

                that._animateSlidesWithFade($current, $next, goto_left, callback);

            break;
        }
    };




    that._animateSlidesWithLatency = function($current, $next, goto_left, callback)
    {
        var latency = Math.round(that.config.speed/6);

        $current.css({zIndex:2});

        var $current_elements = $current.find('.content');

        if( !$current_elements.length ) $current_elements = $current.find('article');

        $current_elements.each(function(index)
        {
            $(this).delay(index*latency).velocity({left:goto_left?'100%':'-100%', opacity:0.25}, that.config.speed, that.config.easing);
        });

        $next.css({zIndex:1, left:0, display:'block'});

        var $next_elements = $next.find('.overlay');
        $next_elements.each(function(index)
        {
            $(this).css({opacity:1, display:'block'});
            $(this).delay(index*latency).velocity({opacity:0}, that.config.speed, that.config.easing);
        });

        var delay = $current_elements.length*latency+that.config.speed;

        setTimeout(function()
        {
            $current.hide();
            $current_elements.css({left:0, opacity:1});

            if(callback) callback();

        }, delay);
    };



    that._animateSlidesWithFade = function($current, $next, goto_left, callback)
    {
        $current.css({zIndex:1})
            .velocity({left:goto_left?'25%':'-25%', opacity:0}, that.config.speed, that.config.easing);

        $next.css({zIndex:2, opacity:0, left:goto_left?'-25%':'25%', display:'block'})
            .velocity({left:0, opacity:1}, that.config.speed, that.config.easing, function()
            {
                $current.hide();
                if(callback) callback();
            });
    };




    that._animateArrow = function(){

        if( !that.config.animate_arrow || !that.config.has_arrows ) return;

        that.arrow_direction = true;

        that.arrow_interval = setInterval(function()
        {
            if( that.arrow_direction )
                that.context.$arrows.filter('.arrow-right').velocity({right:'-101.5%'}, 500, 'easeInOutCubic');
            else
                that.context.$arrows.filter('.arrow-right').velocity({right:'-100%'}, 500, 'easeInOutCubic');

            that.arrow_direction = !that.arrow_direction;

        }, 500);
    };



    that._slideTo = function( index )
    {
        var $next_slide     = that.context.$slides.eq(index);
        var current_index   = that.context.$slides.filter('.active').index();

        that._setupSlide( $next_slide, current_index>index?'left':'right' );
    };


    that._slide = function( direction )
    {

        if( that.config.animate_arrow && that.arrow_interval )
        {
            clearInterval(that.arrow_interval);
            that.arrow_interval = false;

            that.context.$arrows.filter('.arrow-right').velocity({right:'-100%'}, 500, 'easeInOutCubic');
        }


        var goto_left = direction == "left";

        var $current_slide  = that.context.$slides.filter('.active');

        var $next_slide     = goto_left ? $current_slide.prev(that.config.slide) : $current_slide.next(that.config.slide);

        if(!$next_slide.length && that.config.infinite)
            $next_slide = goto_left ? that.context.$slides.last() : that.context.$slides.first();

        that._setupSlide( $next_slide, direction );
    };


    that._setupSlide = function( $next_slide, direction ){

        var $current_slide  = that.context.$slides.filter('.active');

        if(that.is_running || that.context.$slider.hasClass('loading') || $next_slide.index()==$current_slide.index() ) return;

        that.is_running = true;

        var goto_left = direction == "left";

        if(that.config.has_arrows)
        {
            if( !that.config.infinite || (that.config.infinite && that.config.autoload && goto_left) )
            {
                if( ($next_slide.index() >= that.context.$slides.length-1 && !that.config.autoload) || $next_slide.index() == 0 )
                    that.context.$arrows.filter('.'+(goto_left?'left':'right')).fadeOut(that.config.speed);
                else
                    that.context.$arrows.filter('.'+(goto_left?'right':'left')).fadeIn(that.config.speed);
            }
            else
            {
                that.context.$arrows.filter('.'+(goto_left?'right':'left')).fadeIn(that.config.speed);
            }
        }

        if(that.config.has_dots)
        {
            that.context.$dots.removeClass('active');
            that.context.$dots.eq($next_slide.index()).addClass('active');

            console.log($next_slide.index())
        }

        that._animateSlides($current_slide, $next_slide, goto_left, function(){

            $current_slide.removeClass('active');
            $next_slide.addClass('active');

            that.is_running = false;
            if(!goto_left) that._loadImages( $next_slide.next(that.config.slide) );

            $(document).trigger('Slider.slideEnded', [goto_left?'left':'right', $next_slide.index(), that.context.$slides.length, that.context.$slider ]);
        });
    };

    that.__construct(config);

};



var sliders = [];

function initializeSliders()
{
    $('.ui-slider').not('.ui-initialized').each(function(){

        var $slider = $(this);

        var animation = $slider.data('animation')?$slider.data('animation'):'slide';

        sliders.push( new meta.Slider(
        {
            $container      : $slider,
            has_dots        : $slider.hasClass('dots'),
            has_arrows      : $slider.hasClass('arrows'),
            infinite        : $slider.hasClass('infinite'),
            autoload        : $slider.hasClass('autoload'),
            swipe           : $slider.hasClass('swipe'),
            animate_arrow   : $slider.hasClass('animate-arrow'),
            autoplay        : $slider.hasClass('autoplay'),
            animation       : animation
        }));

        $slider.addClass('ui-initialized');
    })
}



$(document).ready(function(){

    initializeSliders();

});