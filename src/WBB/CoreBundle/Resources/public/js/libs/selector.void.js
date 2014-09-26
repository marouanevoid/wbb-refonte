/**
 * Selector
 *
 * Copyright (c) 2014 - VOID Maroc
 *
 * License: GPL
 * Version: 1.0
 *
 * Requires:
 *   - jQuery
 *
 **/

/**
 * meta namespace.
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
        speed     : 300,
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

            if(that.active)
            {
                that.config.$selector.find('.close').click();
                return;
            }

            that.active = true;
            $(this).addClass('active');

            var $selector = that.config.$selector.find('.selector');
            var $scroll = $selector.find('.custom-scroll');
            $selector.css({opacity:0.01, display:'block', top:'70%'});
            $selector.css({left:($(this).outerWidth()-$selector.outerWidth())/2});
            //$selector.animate({opacity:1, top:'100%'}, that.config.speed, that.config.easing);
            $selector.animate({opacity:1, top:'100%'}, that.config.speed, that.config.easing, function()
            {
                if($scroll.length) api.reinitialise();
            });

            if($scroll.length)
            {
                var api = $scroll.data('jsp');
                api.reinitialise();
            }


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

        $(document).on('click touchstart', function(e)
        {
            if( !$(e.target).closest('.ui-selector').length && that.active )
            {
                that.config.$selector.find('.close').click();
            }
        });

        that.config.$selector.find('li').click(function(){

            var $select = that.config.$selector.find('.select');
            $select.text( $(this).text() );

            $(document).trigger('citySelected', [$(this).text(), $(this).attr('id')]);

            that.config.$selector.find('.close').click();
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