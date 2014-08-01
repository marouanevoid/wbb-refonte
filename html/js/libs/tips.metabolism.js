/**
 * Tips
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
meta.Tips = function(config){

    var that = this;

    /* Contructor. */

    /**
     *
     */
    that.__construct =  function(config)
    {
        that.config = $.extend(that.config, config);
        that._prepareComponent();
        that._setupEvents();
    };

    /* Public */

    that.config =
    {
        speed     : 500,
        easing    : 'easeInOutCubic',
        $selector : false
    };

    that.context = {};
    that.is_animating = false;


    /* Private. */

    /**
     *
     */
    that._setupEvents = function() {

        that.config.$selector.mouseover(function()
        {
            $.cookie( 'ui-tips_'+that.config.$selector.attr('id'), true, { expires: 365, path: '/' });

            var $tips = that.context.tips;

            $tips.animate({opacity:0.01, bottom:'120%'}, that.config.speed, that.config.easing, function()
            {
                $tips.hide();
                that.config.$selector.unbind('mouseover');
            });
        });

        $(window).load(function()
        {
            that.context.tips.animate({opacity:1, bottom:'100%'}, that.config.speed, that.config.easing);
        });
    };


    that._prepareComponent = function(){

        that.context.tips = $('<span class="tips"><b></b>'+that.config.$selector.data('tips')+'</span>');
        that.config.$selector.wrap('<span class="ui-tips"/>');
        that.config.$selector.parent().append(that.context.tips);

        that.context.tips.css({opacity:0.01, display:'block', bottom:'120%'});
        that.context.tips.css({left:(that.config.$selector.outerWidth()-that.context.tips.outerWidth())/2});
    };

    that.__construct(config);
};


function initializeTips()
{
    $('[data-tips]').not('.ui-initialized').each(function()
    {
        var $selector = $(this);

        if( $.cookie( 'ui-tips_'+$selector.attr('id') ) != 'true' )
            new meta.Tips({$selector:$selector});

        $selector.addClass('ui-initialized');
    });
}



$(document).ready(function(){

    initializeTips();

});