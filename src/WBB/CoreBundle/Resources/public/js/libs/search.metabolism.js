/**
 * Search
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
meta.Search = function(config){

    var that = this;

    /* Public */

    that.config = {
        speed       : 400,
        throttle    : 250,
        easing      : 'easeInOutCubic',
        template    : '<li>'+
                            '<div class="container">'+
                                '<div class="twelve columns">'+
                                    '<a>%s</a>'+
                                '</div>'+
                            '</div>'+
                        '</li>',
        template_mobile    : '<li>'+
                                '<a>%s</a>'+
                             '</li>'
    };

    that.context = {};
    that.search_timeout = false;
    that.show_results = false;
    that.show_form = false;


    /* Contructor. */

    /**
     *
     */
    that.__construct =  function(config)
    {
        that.config = $.extend(that.config, config);
        that._setupContext();
        that._setupEvents();
    };


    /* Private. */

    /**
     *
     */
    that._setupContext = function() {

        that.context.$header        = $('header');
        that.context.$normalHeader  = that.context.$header.find('.bar-finder .normal-mode, .nav nav');
        that.context.$searchHeader  = that.context.$header.find('.bar-finder .search-mode, .nav form');

        that.context.$form          = that.context.$header.find('.nav form');
        that.context.$input         = that.context.$form.find('input');
        that.context.$result        = that.context.$header.find('.search-result-proposal ul');

        var is_trident = !!(navigator.userAgent.match(/Trident/) && !navigator.userAgent.match(/MSIE/));
        if( is_trident || $('html').hasClass('ie') )
        {
            var placeholder = that.context.$input.attr('placeholder');
            var $placeholder = $('<span class="placeholder">'+placeholder+'</span>');

            that.context.$input.removeAttr('placeholder');
            that.context.$input.after($placeholder);

            $placeholder.on('click', function(){ that.context.$input.focus() });
            that.context.$input.on('keydown', function(){ $placeholder.hide() });
            that.context.$input.on('keyup', function(){ if(that.context.$input.val() == "") $placeholder.show() });
        }
    };


    /**
     *
     */
    that._search = function()
    {
        var q = that.context.$input.val();

        if( $(window).width() < 640 )
        {
            var result_height = $(window).height()-$('header.mobile .search-bar-mobile > .container').height();
            $('header.mobile .search-result-proposal').height(result_height);

            $('.entire-content').hide();
        }

        $.post('/tmp-search.php',{q:q}, function( data )
        {
            if(data.code == 200)
            {
                var values  = data.values;
                var html    = "";

                $.each(values, function(index, value)
                {
                    var result = value.name.replace(data.q, '<b>'+data.q+'</b>');

                    if( $(window).width() < 640 )
                        html += that.config.template_mobile.replace('%s', result);
                    else
                        html += that.config.template.replace('%s', result);
                });

                that.context.$result.html( html );

                that.show_results = true;
            }
        });
    };


    /**
     *
     */
    that._showForm = function()
    {
        if(that.show_form) return;

        that.show_form = true;

        if( $(window).width() > 640 )
        {
            that.context.$normalHeader.velocity({top:'50%', opacity:0}, { duration: that.config.speed, easing:that.config.easing, complete:function() {

                that.context.$normalHeader.hide();

                that.context.$searchHeader.css({display:'block', opacity:0}).velocity({top:'0%', opacity:1}, { duration: that.config.speed, easing:that.config.easing, complete:function(){
                    that.context.$input.focus();
                }});
            }});
        }
        else
        {
            var $searchBar = $('.search-bar-mobile');

            $searchBar.fadeIn();
            $searchBar.find('.container').show();

            setTimeout(function(){
                $searchBar.find('.container').css({transform:'translate3d(0,0%,0)'});
            }, 10);

            $('html,body').animate({scrollTop:0},500);
        }
    };


    /**
     *
     */
    that._hideForm = function()
    {
        that.show_form = false;

        that.context.$result.parent().velocity("slideUp", { duration: that.config.speed, easing:that.config.easing, complete:function()
        {
            $(this).removeAttr('style');
            that.context.$input.val('');
            that.context.$result.empty();
            that.context.$form.find('.placeholder').show();
            that.show_results = false
        }});

        if( $(window).width() > 640 )
        {
            that.context.$searchHeader.velocity({top:'-50%', opacity:0}, { duration: that.config.speed, easing:that.config.easing, complete:function() {

                that.context.$searchHeader.hide();
                that.context.$normalHeader.show().velocity({top:'0%', opacity:1}, { duration: that.config.speed, easing:that.config.easing});
            }});
        }
        else
        {
            var $searchBar = $('.search-bar-mobile');
            $('.entire-content').show();

            $searchBar.fadeOut();
            $searchBar.find('.container').css({transform:'translate3d(0,-100%,0)'});

            setTimeout(function(){
                $searchBar.hide()
            }, 500);
        }
    };


    /**
     *
     */
    that._setupEvents = function() {


        that.context.$header.find('.search').click(function() {
            that._showForm();
        });

        that.context.$header.find('.close').click(function() {
            that._hideForm();
        });

        that.context.$input.on('keyup', function(){
            clearInterval(that.search_timeout);
            that.search_timeout = setTimeout(function(){ that._search() }, that.config.throttle);

            if( that.context.$input.val() == "" ) that.context.$input.next('input[type=reset]').hide();
            else that.context.$input.next('input[type=reset]').show();
        });

        that.context.$input.next('input[type=reset]').click(function(){
            $('.entire-content').show();
            that.context.$input.next('input[type=reset]').hide();
        });

        that.context.$result.on('click', 'a', function(){
            that.context.$input.val( $(this).text() );

            that.context.$result.parent().velocity("slideUp", { duration: that.config.speed, easing:that.config.easing, complete:function()
            {
                $(this).removeAttr('style');
                that.context.$result.empty();
                that.context.$form.submit();
            }});
        });

        $(document).click(function(e){
            if(that.show_results)
            {
                that.context.$result.parent().velocity("slideUp", { duration: that.config.speed, easing:that.config.easing, complete:function()
                {
                    $(this).removeAttr('style');
                    that.context.$result.empty();
                }});
            }
        });
    };



    that.__construct(config);

};

$(document).ready(function(){

    new meta.Search({});

});