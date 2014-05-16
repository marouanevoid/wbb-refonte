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
var metabolism = metabolism || {};

/**
 *
 */
metabolism.Slider = function(config){
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
        default_img : 'images/default.jpg'
    };

    that.context = {
        $slider  : null,
        $slides  : null,
        $dots    : null,
        $arrows  : null
    };

    that.is_running = false;



    /* Private. */

    /**
     *
     */
    that._setupContext = function() {

        that.context.$slider    = that.config.$container;
        that.context.$slides    = that.context.$slider.find(that.config.slide);
        that.context.$dots      = that.context.$slider.find(that.config.dots);
    };



    that._addComponents = function() {

        var min_slide_length = that.config.autoload ? 0 : 1;

        if( that.config.has_arrows && that.context.$slides.length >= min_slide_length ){

            that.context.$slider.append
            (
                '<div class="arrows"><a class="left"><span/></a><a class="right"><span/></a>'
            );

            that.context.$arrows = that.context.$slider.find('.arrows a');

            if( !that.config.infinite || (that.config.autoload && that.config.infinite) )
                that.context.$arrows.filter('.left').hide();
        }

        if( that.config.has_dots && that.context.$dots.length > min_slide_length ){

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

        var that = this;

        if( that.config.has_arrows ){

            that.context.$arrows.click(function(e)
            {
                e.preventDefault();

                if( $(this).hasClass('left') ) that._slideTo('left');
                else  that._slideTo('right');
            });
        }

        if( that.config.swipe ){

            that.context.$slider.swipe(
            {
                swipeLeft:function(){ that._slideTo('right') },
                swipeRight:function(){ that._slideTo('left') },
                longTap: function(event, target) {
                    $(target).closest('.popin').click();
                }
            });
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



    that._animateSlides = function( $current, $prev, $next, goto_left, callback ){

        if(!$next.length)
        {
            if(callback) callback();
            return;
        }

        $current.css({zIndex:1})
                .transition({left:goto_left?'25%':'-25%', opacity:1}, that.config.speed, that.config.easing);

        $next.css({zIndex:2, opacity:0, left:goto_left?'-25%':'25%', display:'block'})
             .transition({left:0, opacity:1}, that.config.speed, that.config.easing, function()
        {
            $current.hide();
            if(callback) callback();
        });
    };



    that._slideTo = function( direction ){

        if(that.is_running || that.context.$slider.hasClass('loading') ) return;

        that.is_running = true;

        var goto_left = direction == "left";

        var $current_slide  = that.context.$slides.filter('.active');
        var $next_slide     = goto_left ? $current_slide.prev(that.config.slide) : $current_slide.next(that.config.slide);
        var $prev_slide     = goto_left ? $current_slide.next(that.config.slide) : $current_slide.prev(that.config.slide);

        if(!$next_slide.length && that.config.infinite)
            $next_slide = goto_left ? that.context.$slides.last() : that.context.$slides.first();

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

        that._animateSlides($current_slide, $prev_slide, $next_slide, goto_left, function(){

            $current_slide.removeClass('active');
            $next_slide.addClass('active');

            that.is_running = false;
            if(!goto_left) that._loadImages( $next_slide.next(that.config.slide) );

            $(document).trigger('Slider.slideEnded', [goto_left?'left':'right', $next_slide.index(), that.context.$slides.length, that.context.$slider ]);
        });
    };


    that.__construct(config);

};




$(document).ready(function(){

    var sliders = [];

    $('.ui-slider').each(function(){

        var $slider = $(this);

        sliders.push( new metabolism.Slider({
            $container  : $slider,
            has_dots    : $slider.hasClass('dots'),
            has_arrows  : $slider.hasClass('arrows'),
            infinite    : $slider.hasClass('infinite'),
            autoload    : $slider.hasClass('autoload'),
            swipe       : $slider.hasClass('swipe')
        }));

    })
});