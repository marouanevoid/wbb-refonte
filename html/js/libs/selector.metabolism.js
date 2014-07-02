/**
 * Selector
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
meta.Selector = function(config){

    var that = this;

    /* Contructor. */

    /**
     *
     */
    that.__construct =  function(config)
    {
        that.config = $.extend(that.config, config);
        that._setupEvents();
    };

    /* Public */

//drop-dark

    that.config =
    {
        speed     : 500,
        easing    : 'easeInOutCubic',
        $selector : false
    };

    that.active = false;

    /* Private. */

    /**
     *
     */
    that._setupEvents = function() {

        that.config.$selector.find('.select').click(function(){

            if(that.active) return;

            that.active = true;
            $(this).addClass('active');

            var $selector = that.config.$selector.find('.selector');

            $selector.css({opacity:0.01, display:'block', top:'70%'});
            $selector.css({left:($(this).outerWidth()-$selector.outerWidth())/2});
            $selector.animate({opacity:1, top:'100%'}, that.config.speed, that.config.easing);

        });

        that.config.$selector.find('.close').click(function(){

            var $selector = that.config.$selector.find('.selector');

            that.config.$selector.find('.select').removeClass('active');

            $selector.animate({opacity:0.01, top:'70%'}, that.config.speed, that.config.easing, function()
            {
                $(this).hide();
                that.active = false;
            });

        });

    };

    that.__construct(config);
};



var selectors = [];

function initializeSelectors()
{
    $('.ui-selector').not('.ui-initialized').each(function()
    {
        var $selector = $(this);

        selectors.push( new meta.Selector({$selector:$selector}) );

        $selector.addClass('ui-initialized');
    });
}



$(document).ready(function(){

    initializeSelectors();

});