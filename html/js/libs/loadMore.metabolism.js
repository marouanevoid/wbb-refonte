/**
 * Load More
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
meta.LoadMore = function(config) {

    var that = this;

    that.context = {

        page : 1,
        is_loading : false
    };

    that.config = {

        $button : false,
        page    : '?page=',
        class   : 'line',
        speed   : 500,
        easing  : 'easeInOutCubic'
    };


    /* Public attributes. */
    that._setupEvents = function(){

        that.config.$button.on('click', function(e)
        {
            e.preventDefault();

            if(that.context.is_loading) return;


            var $button     = $(this);
            var $target     = that.context.$container.find('.load-target');
            var url         = $button.attr('href')+that.config.page+that.context.page;

            $button.data('text', $button.text());
            $button.addClass('loading').text(TRAD.loading);

            that._load(url, $target, function()
            {
                $button.removeClass('loading').text( $button.data('text'));
            });
        });
    };



    that._setupContext = function(){

        that.context.$container = that.config.$button.closest('.load-container');
    };


    that._animate = function($target, $elements, callback ){

        var target_height = $target.show().height();

        $elements.css({opacity:0, top:'6em', position:'relative'}).each(function(index){

            $(this).delay(100*(index+1)).velocity({opacity:1, top:0}, that.config.speed, that.config.easing);
        });
    };


    that._load = function( url, $target, callback)
    {
        that.context.is_loading = true;

        callback()
        $target.load(url, function()
        {
            $target.hide();

            $target.removeClass('load-target');
            $target.after('<div class="'+that.config.class+' load-target"/>');

            $target.find('img[data-src]').each(function()
            {
                $(this).attr('src', $(this).data('src'));
                $(this).removeAttr('data-src');
            });

            that._animate($target, $target.find('> *').not('br'), callback );

            that.context.page +=1;
            that.context.is_loading = false;
        })
    };


    /**
     *
     */
    that.__construct = function( config )
    {
        that.config = $.extend(that.config, config);

        that._setupContext();
        that._setupEvents();
    };

    that.__construct( config );
};

$(document).ready(function()
{
   $('.load-more').each(function()
   {
        new meta.LoadMore({$button:$(this)});
   });

});

