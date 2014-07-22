/**
 * Utils
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
meta.Utils = function() {

    var that = this;

    /* Public attributes. */

    that.timeout = false;
    that.first_launch = true;

    /* Public methods. */

    /**
     *
     */
    that._vCenter = function()
    {
        $('.vcenter').each(function()
        {
            $(this).wrapInner('<div class="table"><div class="td"></div></div>');
            $(this).removeClass('vcenter');
        });
    };


    that._resizeCover = function()
    {
        clearTimeout(that.timeout);

        that.timeout = setTimeout(function(){

            var $covers = $('.cover');

            $covers.each(function()
            {
                var $cover              = $(this);
                var $element            = $cover.find(' > img');
                var ratio               = $element.data('ratio');
                var margin              = parseInt($cover.data('margin'));
                if( isNaN(margin)) margin = 0;

                var container_width     = $cover.width()*(1+margin/100);
                var container_height    = $cover.height();

                if( container_width/ratio < container_height )
                {
                    var width = parseInt(container_height*ratio);
                    $element.css({width:width, height:container_height, left:(container_width-width)/2+'px', top:0});
                }
                else
                {
                    var height  = parseInt(container_width/ratio);
                    $element.css({width:container_width, height:height, top:(container_height-height)/2+'px', left:(-$cover.width()*margin/100)/2});
                }
            });

        }, that.first_launch?0:100);

        that.first_launch = false;


    };

    /**
     *
     */
    that._cover = function( ratio_only )
    {
        var $covers = $('.cover');

        $covers.each(function()
        {
            var $element   = $(this).find(' > img');
            $element.data('ratio', parseInt($element.prop('width'))/parseInt($element.prop('height')));
        });

        if( ratio_only ) return;

        that._resizeCover();

        $(window).resize(function(){
            that._resizeCover();
        });
    };



    /**
     *
     */
    that._detectSmartphone = function()
    {
        if($(window).width() <= 640 && $('html').hasClass('mobile')) $('html').addClass('smartphone');
    };


    /**
     *
     */
    that._sizer = function()
    {
        $('.has_sizer').each(function()
        {
            var $sizer = $('<img src="'+BASEURL+'images/sizer/'+$(this).data("size")+'.png" class="sizer"/>');

            $sizer.load(function(){ that._resizeCover() });

            $(this).append($sizer);
            $(this).removeClass('has_sizer');
        });
    };



    /**
     *
     */
    that._init = function()
    {
        $(document).ready(function()
        {
            that._vCenter();
            that._detectSmartphone();
            that._sizer();
            that._cover();
        });

        $( document ).ajaxComplete(function() {
            that._cover(true);
            that._vCenter();
            that._sizer();
        });

    };

    that._init();
};

if (!Array.prototype.indexOf) {
    Array.prototype.indexOf = function(obj, start) {
        for (var i = (start || 0), j = this.length; i < j; i++) {
            if (this[i] === obj) { return i; }
        }
        return -1;
    }
}

var console = console || {log:function(){}};
var UTILS = new meta.Utils();
