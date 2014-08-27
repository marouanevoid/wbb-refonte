0/**
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
        speed       : 400,
        easing      : 'easeInOutCubic',
        default_img : 'images/default.jpg',
        animate_arrow   : false,
        autoplay_delay  : 5000,
        autoplay        : false,
        animation       : 'latency',
        use_3D          : false,
        coumpteurCursor : 0,
        autodefile : (! ismobile && ! istablet && $('body.news').length) ? true : false,
        defileInterval : 0,
        totalItem : 0,
        defiledelay : 2000,
        orientation : 'right'
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

        var min_slide_length    = that.config.autoload ? 0 : 1;

        if( that.config.display_count )
            min_slide_length = that.config.display_count;

        that.config.has_arrows  = that.config.has_arrows && that.context.$slides.length > min_slide_length;
        that.config.has_dots    = that.config.has_dots && that.context.$slides.length > min_slide_length;
        that.config.swipe       = $('html').hasClass('mobile');

        that.context.offset     = parseInt(10000/that.config.display_count)/100;

        that.config.use_3D      = Modernizr.csstransforms3d && ( $('html').hasClass('webkit') || $('html').hasClass('mobile') );
    };



    that._addComponents = function() {

        that.context.$slider.wrapInner('<div class="ui-slides"><div class="ui-wrapper"/></div>');

        if( that.config.has_arrows ){

            that.context.$slider.append
            (
                '<div class="arrows"><a class="left"/><a class="right"/></div>'
            );

            that.context.$arrows = that.context.$slider.find('.arrows a');

            if( !that.config.infinite || (that.config.autoload && that.config.infinite) )
                that.context.$arrows.filter('.left').addClass('disabled');
        }

        if( that.config.has_dots ){

            that.context.$slider.append
            (
                '<div class="dots"></div>'
            );

            that.context.$dots = that.context.$slider.find('.dots');

            var html = new Array( that.context.$slides.length-that.config.display_count+2 ).join('<a></a>');

            that.context.$dots.append(html).find('a:first').addClass('active');
            that.context.$dots = that.context.$dots.find('a');
        }

    };

    /*
    * Auto defile
    **/
    that.startautoDefile = function(){

        clearInterval(that.config.defileInterval );
        if(that.config.autodefile){
            that.config.defileInterval = setInterval(function(){

                if(that.config.orientation == 'right'){
                    that.config.coumpteurCursor++;
                }else{
                    that.config.coumpteurCursor--;
                }
                
                if(that.config.coumpteurCursor > (that.config.totalItem - 3 )){
                    that.config.coumpteurCursor = that.config.totalItem - 3 ;
                    that.config.orientation = 'left';
                }else{
                    if(that.config.coumpteurCursor <= 0){
                        that.config.orientation = 'right';
                        that.config.coumpteurCursor++;
                    }
                }

                // trigger click on corespond 
                // btn
                that.context.$arrows.filter("." + that.config.orientation).trigger('click' , [true]);

            },that.config.defiledelay);
        }
    }

    /*
    * Stop auto defile
    */
    that.stopautoDefile = function(){
         clearInterval(that.config.defileInterval );
    }

    that._setupLayout = function() {

        that.context.$slides.not('.active').hide();

        if( !that.context.$slides.filter('.active').length ){

            if( that.config.display_count > 1 )
            {
                var $active_slides = that.context.$slides.slice(0, that.config.display_count);
                $active_slides.show().addClass('active');

                $active_slides.each(function(index)
                {
                    if( that.config.use_3D )
                        $(this).css({transform:'translate3d('+index*100+'%,0,0)'});
                    else
                        $(this).css({left:(Math.round(index*that.context.offset*100)/100)+'%'});

                })
            }
            else
                that.context.$slides.first().show().addClass('active');

            if( that.config.use_3D ) setTimeout(function(){ that.context.$slides.addClass('transform3d') }, 10)

            var $slides = that.context.$slides.filter('.active');
            $slides = $slides.add( that.context.$slides.last()).add($slides.next());

            that._loadImages($slides);
        }
    };


    that._loadImages = function( $container ){

        var $images = $container.find('img[data-src]');

        $images.each(function(){
            $(this).attr('src', $(this).data('src'));
            $(this).removeAttr('data-src');
        })

    };



    that._setupEvents = function() {

        if( that.config.has_arrows ){

            that.context.$arrows.click(function(e , fromFn)
            {
                e.preventDefault();


                clearInterval(that.config.defileInterval );
                if( $(this).hasClass('disabled') ){
                    console.log('disabled happend ==== ');
                    that.startautoDefile();
                    return;
                } 

                if( $(this).hasClass('left') ){
                    if(!fromFn){
                        that.config.coumpteurCursor--;
                        that.config.orientation = 'left';
                        console.log('real clickeeed ------- ');
                    }
                    that._slide('left');
                } 
                else {

                    if(!fromFn){
                        that.config.orientation = 'right';
                        that.config.coumpteurCursor++;
                    }
                    that._slide('right');
                } 

                /*
                * Start auto defile
                */

                that.startautoDefile();
            });
        }

        if( that.config.has_dots && $(window).width() > 640 ){

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
                tap:function(event, target){
                    var $article  = $(target).closest('article');
                    var href = $article.find('a.overlay-link').attr('href');

                    if( typeof(href) != "undefined") document.location.href = href;
                },
                threshold:20
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


        that.config.totalItem = that.config.$container.find('.ui-slide').length;
        /*
        * Start auto defile
        */

        that.startautoDefile();

        // add listner on hover Slider
        that.context.$slider.hover(that.stopautoDefile,that.startautoDefile);
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

                if( that.config.use_3D )
                    that._animateSlidesUsingTransform3D($current, $next, goto_left, callback);
                else
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
        if( !$next_elements.length ) $next_elements = $next.find('article');

        $next_elements.css({opacity:1, display:'block', left:0});

        $next_elements.each(function(index)
        {
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
        if($current.length==1)
        {
            $current.css({zIndex:1})
                .velocity({left:goto_left?'25%':'-25%', opacity:0}, that.config.speed, that.config.easing);

            $next.css({zIndex:2, opacity:0, left:goto_left?'-25%':'25%', display:'block'})
                .velocity({left:0, opacity:1}, that.config.speed, that.config.easing, function()
                {
                    $current.hide();
                    if(callback) callback();
                });
        }
        else
        {
            $current.animate({left:goto_left?'+='+that.context.offset+'%':'-='+that.context.offset+'%'}, that.config.speed, that.config.easing);

            $next.css({left:goto_left?'-'+that.context.offset+'%':'100%', display:'block'})
                .animate({left:goto_left?'0%':(100-that.context.offset)+'%'}, that.config.speed, that.config.easing, function()
                {
                    if( goto_left )
                        $current.last().hide();
                    else
                        $current.first().hide();

                    if(callback) callback();
                });
        }
    };

    that._animateSlidesUsingTransform3D = function($current, $next, goto_left, callback)
    {
        if($current.length==1)
        {
            $current.addClass('transform3d');
            $next.css({transform:'translate3d('+(goto_left?'-100':'100')+'%, 0, 0)', display:'block'});

            setTimeout(function()
            {
                $next.css({transform:'translate3d(0, 0, 0)'});
                $current.css({transform:'translate3d('+(goto_left?'100':'-100')+'%, 0, 0)'});

            }, 20);

            setTimeout(function()
            {
                $current.hide();

                if(callback) callback();

            }, that.config.speed+200);
        }
        else
        {
            $next.css({transform:'translate3d('+(goto_left?'-100': that.config.display_count*100)+'%, 0, 0)', display:'block'});

            setTimeout(function()
            {
                $next.css({transform:'translate3d('+(goto_left?'0': (that.config.display_count-1)*100)+'%, 0, 0)'});
                $current.each(function(index)
                {
                    $(this).css({transform:'translate3d('+(goto_left?(index+1)*100:(index-1)*100)+'%, 0, 0)'});
                });

            }, 20);


            setTimeout(function()
            {
                if( goto_left )
                    $current.last().hide();
                else
                    $current.first().hide();

                if(callback) callback();

            }, that.config.speed+200);
        }
    };




    that._animateArrow = function(){

        if( !that.config.animate_arrow || !that.config.has_arrows ) return;

        that.arrow_direction = true;

        that.arrow_interval = setInterval(function()
        {
            if( that.arrow_direction )
                that.context.$arrows.filter('.arrow-right').animate({right:'-101.5%'}, 500, 'easeInOutCubic');
            else
                that.context.$arrows.filter('.arrow-right').animate({right:'-100%'}, 500, 'easeInOutCubic');

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

            that.context.$arrows.filter('.arrow-right').animate({right:'-100%'}, 500, 'easeInOutCubic');
        }


        var goto_left       = direction == "left";
        var $current_slides  = that.context.$slides.filter('.active');
        var $next_slide     = goto_left ? $current_slides.first().prev(that.config.slide) : $current_slides.last().next(that.config.slide);

        if(!$next_slide.length && that.config.infinite)
        {
            if( goto_left )
            {
                $next_slide = that.context.$slides.last();
                $next_slide.insertBefore( that.context.$slides.first() );
            }
            else
            {
                $next_slide = that.context.$slides.first();
                $next_slide.insertAfter( that.context.$slides.last() );
            }

            that.context.$slides = that.context.$slider.find(that.config.slide);
        }

        if($next_slide.length) that._setupSlide( $next_slide, direction );
    };


    that._setupSlide = function( $next_slide, direction ){

        var $current_slides  = that.context.$slides.filter('.active');
        var next_slide_index = that.context.$slides.index($next_slide);
        var first_slide_index = that.context.$slides.index($current_slides.first());
        var last_slide_index = that.context.$slides.index($current_slides.last());

        if(
            that.is_running || that.context.$slider.hasClass('loading') ||
            next_slide_index == first_slide_index ||
            next_slide_index == last_slide_index

        ) return;

        that.is_running = true;

        var goto_left = direction == "left";

        if(that.config.has_arrows)
        {
            if( !that.config.infinite || (that.config.infinite && that.config.autoload && goto_left) )
            {
                if( ( next_slide_index >= that.context.$slides.length-1 && !that.config.autoload) || next_slide_index == 0 )
                {
                    that.context.$arrows.filter('.'+(goto_left?'left':'right')).addClass('disabled');
                    that.context.$arrows.filter('.'+(goto_left?'right':'left')).removeClass('disabled');
                }
                else
                    that.context.$arrows.filter('.'+(goto_left?'right':'left')).removeClass('disabled');
            }
            else
            {
                if( !that.config.infinite) that.context.$arrows.filter('.'+(goto_left?'right':'left')).removeClass('disabled');
            }
        }

        if(that.config.has_dots)
        {
            that.context.$dots.removeClass('active');

            var index = goto_left ? next_slide_index : next_slide_index-that.config.display_count+1;
            that.context.$dots.eq(index).addClass('active');
        }

        that._animateSlides($current_slides, $next_slide, goto_left, function(){

            if(goto_left)
                $current_slides.last().removeClass('active');
            else
                $current_slides.first().removeClass('active');

            $next_slide.addClass('active');

            that.is_running = false;
            if(!goto_left) that._loadImages( $next_slide.next(that.config.slide) );

            $(document).trigger('Slider.slideEnded', [goto_left?'left':'right', next_slide_index, that.context.$slides.length, that.context.$slider ]);
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
                animate_arrow   : $slider.hasClass('animate-arrow'),
                autoplay        : $slider.hasClass('autoplay'),
                display_count   : parseInt($slider.data('display')),
                animation       : animation
            }));

        $slider.addClass('ui-initialized');
        $slider.show();
    })
}