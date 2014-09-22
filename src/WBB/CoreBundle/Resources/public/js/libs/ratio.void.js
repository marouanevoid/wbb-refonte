
/**
 * Ratio
 *
 * Copyright (c) 2014 - VOID Maroc
 *
 * License: GPL
 * Version: 1.5 (2014/01/21)
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
meta.Ratio = function(config) {

    var that = this;

    /* Public */

    that.config =
    {
        max_width       : 1920,
        min_width       : 1280,
        default_width   : 1024,
        default_size    : 10,
        min_size        : 7
    };

    /* Private */

    /**
     *
     */
    that.__contructor = function(config)
    {
        that.config = $.extend(that.config, config);

        $(window).resize(function()
        {
            that._resize();
        });
    };

    /**
     *
     */
    that._resize = function( )
    {
        var ratio = Math.min(that.config.max_width, Math.max($(window).width(),that.config.min_width)) * that.config.default_size / that.config.default_width;
        ratio     = Math.max( that.config.min_size, parseInt(ratio*10)/10);

        $('body').css('font-size', ratio );
    };

    // init
    that.__contructor(config);
    that._resize();

};