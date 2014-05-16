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
var metabolism = metabolism || {};

/**
 *
 */
metabolism.Utils = function() {

    var that = this;

    /* Public attributes. */

    that.timeout = false;

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
        var $covers = $('.cover');

        $covers.each(function()
        {
            var $cover              = $(this);
            var $element            = $cover.find(' > *');
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
    };

    /**
     *
     */
    that._cover = function( ratio_only )
    {
        var $covers = $('.cover');

        $covers.each(function()
        {
            var $element   = $(this).find(' > *');
            $element.data('ratio', parseInt($element.attr('width'))/parseInt($element.attr('height')));
        });

        if( ratio_only ) return;

        $(window).resize(function(){
            clearTimeout(that.timeout);
            that.timeout = setTimeout(function(){ that._resizeCover() }, 50);
        });
    };


    /**
     *
     */
    that._matchElements = function()
    {
        var $match_elements = $('[data-match]');

        $(window).resize(function()
        {
            $match_elements.each(function()
            {
                var $element1 = $(this);
                var $element2 = $(this).closest('article').find( $(this).data('match') );

                var element1_height = $element1.css('height', 'auto').height();
                var element2_height = $element2.css('height', 'auto').height();

                if( element1_height > element2_height )
                    $element2.height( element1_height );
                else
                    $element1.height( element2_height );
            });
        });

        $(window).load(function(){ $(this).resize() });
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

            $sizer.load(function(){ $(window).resize() });

            $(this).append($sizer);
            $(this).removeClass('has_sizer');

            var $covers = $('.cover');
            that._resizeCover($covers);
        });
    };


    /**
     *
     */
    that._svgPlaceholder = function()
    {
        $('[data-svg]').each(function()
        {
            var $this = $(this);

            if(Modernizr.svg)
            {
                $.get( BASEURL+'svg/'+$this.data('svg')+'.svg', function(svgDoc){

                    var importedSVGRootElement = document.importNode(svgDoc.documentElement,true);
                    $this.replaceWith( importedSVGRootElement );

                },"xml");
            }
            else
            {
                $this.replaceWith( '<img src="'+BASEURL+'images/'+$this.data( $this.data('img')?'img':'svg')+'.png"/>' );
            }
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
            that._matchElements();
            that._svgPlaceholder();
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
var UTILS = new metabolism.Utils();
