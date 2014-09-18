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
        speed: 500,
        easing: 'easeInOutCubic'
    };

    that.menu_open = false;


    /*
    * Setup Events On Menu Mobile
    **/
    that._mobileMenuEvents = function() {
        if ($(window).width() > 640) return;

        var $to_scroll = $('.entire-content-scrollable, aside.mobile-menu');
        var $menu = $('aside.mobile-menu');
        var $content = $('.entire-content-scrollable');
        var $header = $('header.mobile');
        var $menu_btn = $header.find('.nav-icon a');
        var $body = $('body');

        if (Modernizr.csstransforms3d) {
            $menu.on('webkitTransitionEnd transitionend msTransitionEnd oTransitionEnd', function() {

                if (that.menu_open) {
                    $body.removeClass('menu-open');
                    $to_scroll.removeAttr('style');
                    that.menu_open = false;
                } else {
                    var speed = Math.min(500, $(window).scrollTop() * 2);
                    $('html,body').animate({
                        scrollTop: 0
                    }, speed, that.config.easing, function() {
                        $menu.height('auto');
                        $content.height($menu.height() - $header.height() - 1);
                    });
                    that.menu_open = true;
                }
            });
        }

        $('header.mobile .nav-icon a').on('click touchstart', function(e) {
            e.preventDefault();

            if (that.menu_open) {
                $content.height('auto');
                $menu_btn.css('opacity', 1);

                if (Modernizr.csstransforms3d) {
                    $to_scroll.css({
                        transform: 'translate3d(0,0,0)'
                    });
                } else {
                    $to_scroll.animate({
                        left: 0
                    }, that.config.speed, that.config.easing, function() {
                        $body.removeClass('menu-open');
                        $to_scroll.removeAttr('style');
                        that.menu_open = false;
                    });
                }
            } else {
                $body.addClass('menu-open');
                $menu_btn.css('opacity', 0.5);

                $menu.height($content.height() + $header.height() + 1);

                if (Modernizr.csstransforms3d)
                    $to_scroll.css({
                        transform: 'translate3d(245px,0,0)'
                    });
                else {
                    var speed = Math.min(500, $(window).scrollTop() * 2);

                    $to_scroll.animate({
                        left: '245px'
                    }, that.config.speed, that.config.easing, function() {
                        $('html,body').animate({
                            scrollTop: 0
                        }, speed, that.config.easing, function() {
                            $menu.height('auto');
                            $content.height($menu.height() - $header.height() - 1);
                        });
                        that.menu_open = true;
                    });
                }
            }
        });

        $('aside.mobile-menu a').on('click', function(e) {
            $('html,body').animate({
                scrollTop: 0
            }, 300);
            $('section.bar-finder').fadeIn(that.config.speed, that.config.easing, function() {
                $('header.mobile .nav-icon a').click();
                $('.mobile-menu').hide().removeAttr('style');
                $('.entire-content').hide();
            });
        });

        $('section.bar-finder .finder-close').click(function() {
            $('.entire-content').show();
            $('section.bar-finder').fadeOut(that.config.speed, that.config.easing, function() {
                $('section.bar-finder .finder-close').css('opacity', 1);
            });
        });

        $('.mobile-menu').swipe({
            swipeLeft: function() {
                $('header.mobile .nav-icon a').click()
            },
            threshold: 30
        });

        /* bind events */
        $(document).on('focus', 'input[type=text], textarea', function() {
                $('body').addClass('fixfixed');
            })
            .on('blur', 'input[type=text], textarea', function() {
                $('body').removeClass('fixfixed');
                if ($(window).width() < 640) $('html,body').animate({
                    scrollTop: $(window).scrollTop() - $('header.mobile').height()
                }, 300);
            });
    };



    that._barFinderEvents = function() {
        var $bar_finder = $('section.bar-finder');
        var $container = $bar_finder.find('.twelve');
        var $is_animating = false;

        $('header .finder').click(function() {
            if ($is_animating) return;

            if ($container.is(':visible')) $bar_finder.find('.finder-close').click();
            else {
                $is_animating = true;

                $bar_finder.find('table').animate({
                    opacity: '1'
                }, that.config.speed, that.config.easing);
                $bar_finder.find('.finder-arrow').animate({
                    top: '-15px',
                    opacity: '1'
                }, that.config.speed, that.config.easing);
                $bar_finder.find('.finder-close').animate({
                    opacity: '1'
                }, that.config.speed, that.config.easing);
                $container.slideDown(that.config.speed, that.config.easing, function() {
                    $is_animating = false
                });
            }
        });

        $bar_finder.find('.finder-close').click(function() {
            if ($is_animating) return;

            $is_animating = true;

            $bar_finder.find('table').animate({
                opacity: '0'
            }, that.config.speed, that.config.easing);
            $bar_finder.find('.finder-arrow').animate({
                top: '0',
                opacity: '0'
            }, that.config.speed, that.config.easing);
            $bar_finder.find('.finder-close').animate({
                opacity: '0'
            }, that.config.speed / 2, that.config.easing);
            $container.slideUp(that.config.speed, that.config.easing, function() {
                $is_animating = false
            });
        });

        if (window.homepage && window.shownav) {
            // demeande de dispatch lick on finder
            $('header .finder').click();
            var closed = false;
            $(window).on('scroll', function() {
                if ((!closed) && $(document).scrollTop() >= ($('.ipad').length ? 240 : 288)) {
                    $('header .finder').click();
                    closed = true;
                }
            });
        }
    };


    that._customScroll = function() {
        $('.custom-scroll').not('.jspScrollable').not('.jspNotScrollable').each(function() {
            //$(this).jScrollPane({autoReinitialise: true, hideFocus:true});
            $(this).jScrollPane({
                hideFocus: true
            });
        });

        var customScrollTimeout = false;

        $(window).resize(function() {
            clearTimeout(customScrollTimeout);
            customScrollTimeout = setTimeout(that._resizeCustomScroll, 10);
        });
    };

    that._resizeCustomScroll = function() {
        $('.custom-scroll').each(function() {
            var api = $(this).data('jsp');
            if (typeof(api) != "undefined" && $(this).is(':visible')) api.reinitialise();
        });
    };


    that._loadImages = function() {
        $('.force-load [data-src]').each(function() {
            $(this).attr('src', $(this).data('src'));
        });
    };



    /* Public attributes. */
    that._setupEvents = function() {

        $(window).load(function() {
            $("body").removeClass("loading").addClass("loaded");
            that._resizeCustomScroll();
        });

        $('a.see-more').click(function(e) {
            e.preventDefault();
            var speed = Math.min(500, $(window).scrollTop() * 2);

            if ($(this).hasClass('fade'))
                $(this).velocity('fadeOut', {
                    duration: speed,
                    easing: that.config.easing
                });
            else
                $(this).velocity('slideUp', {
                    duration: speed,
                    easing: that.config.easing
                });

            $(this).next('.more').velocity('slideDown', {
                duration: speed,
                easing: that.config.easing
            });
        });

        $('a.scrolltop').click(function(e) {
            e.preventDefault();

            $('html, body').animate({
                scrollTop: 0
            }, that.config.speed, that.config.easing);
        });


        if ($('html').hasClass('mobile')) {
            options_are_visible = false;

            $('header.desktop .logged .in-action').click(function(e) {
                var _this = $(this).closest('.logged');
                e.preventDefault();
                if (!options_are_visible)
                    $(_this).find('.actions').css({
                        opacity: 0.01,
                        display: 'block',
                        top: '80%'
                    }).stop().animate({
                        opacity: 1,
                        top: '100%'
                    }, 300, that.config.easing);
                else
                    $(_this).find('.actions').stop().animate({
                        opacity: 0.01,
                        top: '80%'
                    }, 300, that.config.easing, function() {
                        $(_this).find('.actions').hide();
                    });

                options_are_visible = !options_are_visible;
                return false;
            });
        } else {

            $('header.desktop .logged').hover(function() {
                var _this = $(this);
                if (_this.hasClass('opened'))
                    return false;
                $(this).find('.actions').css({
                    opacity: 0.01,
                    display: 'block',
                    top: '80%'
                }).stop().animate({
                    opacity: 1,
                    top: '100%'
                }, 300, that.config.easing, function() {
                    _this.addClass('opened');
                });

            }, function() {
                var _this = $(this);

                $(this).find('.actions').stop().animate({
                    opacity: 0.01,
                    top: '80%'
                }, 300, that.config.easing, function() {
                    _this.removeClass('opened');
                    $(this).hide();
                })
            });
        }

        that._barFinderEvents();
        that._mobileMenuEvents();
        that._loadImages();

        /*
        * Add the Globla Listner
        On any Ajax Request to 
        custumize the Scroll
        **/
        $(document).ajaxComplete(function() {
            that._customScroll();
            setTimeout(that._resizeCustomScroll, 600);
        });


        // Add the Event Resize for Search Bar
        $(window).on('resize', function() {
            $('.search-bar-mobile').css({
                'top': '0 !important'
            });
            $('.search-bar-mobile').addClass('top-important-0');
        });
        // dispatch resize
        $(window).resize();

        // add the event on serach
        $('.search-bar-mobile').find('.form-text').on('keyup', function() {
            var lentext = $(this).val();
            if (lentext) {
                $('.search-bar-mobile').find('.form-submit').show();
            } else {
                $('.search-bar-mobile').find('.form-submit').hide();
            }
        });

        // hide the submit on rest
        $('.search-bar-mobile').find('input[type=reset]').on('click', function() {
            $('.search-bar-mobile').find('.form-submit').hide();
            if (ismobile)
                $('header.mobile .search-result-proposal').hide();
        });

        // add Event on Mobile
        // for showing the Mask
        if (ismobile && !istablet) {

        	/*
        	* Show the Mask on search
        	is Opned
        	*/
            $('.mobile .search-pin-icon a.search').on('click', function() {
                // Show The mask
                PopIn.dom.mask.show();
                $('.search-bar-mobile').addClass('no-height');
                $('header').addClass('showing-search');
            });

            $('.mobile .search-bar-mobile .close').on('click', function() {
                PopIn.dom.mask.hide();
                $('.search-bar-mobile').removeClass('no-height');
                $('header').removeClass('showing-search');
            });

            /*
             * Show Rotate Notice on the landscape on Mobile
             ***/

            $(window).on("orientationchange", function() {
                var orientation = window.orientation;
                if (orientation != 0) {
                    $("body").addClass("landscape-mobile");
                } else {
                    $("body").removeClass("landscape-mobile");
                }
            });

            $(window).trigger("orientationchange");
        }
    };


    that._setupElements = function() {
        $('a.overlay-link').append('<img src="' + BASEURL + 'images/blank.png"/>');
    };


    /**
     *
     */
    that.__construct = function() {
        /*
         * First visite
         */

        // Tester si le cookies first visit existe
        // On le crée
        if ($.cookie('first_visite') === undefined) {
            $.cookie('first_visite', true, 0);
        } else {
            if ($.cookie('first_visite') == 'true') {
                $.cookie('first_visite', false, 0);
            }
        }

        that._setupElements();
        that._setupEvents();
        that._customScroll();
    };

    that.__construct();

};


$(document).ready(function() {
    new meta.Ratio({
        max_width: 1200,
        min_width: 1024,
        default_width: 1200
    });
    new meta.App();
    $('.entire-content').show();
    $('.entire-content').addClass('show');
});