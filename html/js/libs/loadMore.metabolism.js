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

        that.config.$button.click(function(e)
        {
            e.preventDefault();

            if(that.context.is_loading) return;

            that.context.is_loading = true;

            var $button     = that.config.$button;
            var $target     = that.context.$container.find('.load-target');
            var url         = $button.attr('href')+that.config.page+that.context.page;

            that._load(url, $target );
        });
    };



    that._setupContext = function(){

        that.context.$container = that.config.$button.closest('.load-container');
    };


    that._animate = function($target, $elements ){

        var target_height = $target.show().height();

        $elements.css({opacity:0, top:'4em'});
        $target.css({height:0, overflow:'hidden'});

        $target.velocity({height:target_height}, that.config.speed, that.config.easing, function()
        {
            $target.removeAttr('style');
        });

        $elements.each(function(index){

            $(this).delay(100*(index+1)).velocity({opacity:1, top:0}, that.config.speed, that.config.easing);
        });
    };


    that._load = function( url, $target)
    {
        $target.load(url, function()
        {
            $target.hide();

            $target.removeClass('load-target');
            $target.after('<div class="'+that.config.class+' load-target"/>');

            that._animate($target, $target.find('> *') );

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

