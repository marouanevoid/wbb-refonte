
/**
 * Cities
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
meta.Cities = function() {

    var that = this;

    that.config = {
        speed   : 500,
        easing  : 'easeInOutCubic',
        container : '.cities-content'
    };

    that.context = {};


    /**
     *
     */
    that._searchBars = function( city_id, neighborhood_id )
    {
        that._hideCitySelector();
        that._requestBars(city_id, neighborhood_id, function(neighborhoods, bars)
        {
            if(neighborhoods.length) that._showNeighborhoodSelector(neighborhoods);
            that._showBars(bars, true, true);
        });
    };


    /**
     *
     */
    that._showBars = function( bars, display_list, fit )
    {
        var html = "";
        var markers = [];

        $.each(bars, function(index, bar)
        {
            if( display_list ) html += '<li><a href="'+bar.url+'"><b>'+bar.name+'</b><br/><span>'+bar.address+'</span></a></li>';
            markers.push({address:bar.address, data:'<b>'+bar.name+'</b>'+bar.address, options:{icon:'images/markers/'+(index+1)+'.png'}, tag:bar.url});
        });

        if( display_list )
        {
            var $scrollBars = that.context.$container.find('.scroll-bars');
            $scrollBars.find('ul').html(html);
            $scrollBars.velocity('fadeIn', { duration: that.config.speed, easing:that.config.easing});

            setTimeout(function(){ $(window).resize() }, 40);
        }

        that.context.map.addMarkers(markers, fit);
    };


    /**
     *
     */
    that._hideBars = function()
    {
        var $scrollBars = that.context.$container.find('.scroll-bars');
        $scrollBars.find('ul').empty();
        $scrollBars.hide();

        that._showAllBars();

        that.context.map.reset();

    };


    /**
     *
     */
    that._showNeighborhoodSelector = function(neighborhoods)
    {
        var html = '<select name="neighborhood" class="ui-dropdown">';
        $.each(neighborhoods, function(index, neighborhood)
        {
            html += '<option value="'+neighborhood.id+'">'+neighborhood.name+'</option>';
        });
        html += '</select>';

        that.context.$container.find('form').after(html);

        initializeDropdowns();

    };

    /**
     *
     */
    that._removeNeighborhoodSelector = function()
    {
        that.context.$container.find('.ui-dropdown-container').remove();
    };


    /**
     *
     */
    that._hideCitySelector = function()
    {
        that.context.$container.find('.scroll-cities').hide();
    };

    /**
     *
     */
    that._showCitySelector = function()
    {
        that.context.$container.find('.scroll-cities').velocity('fadeIn', { duration: that.config.speed, easing:that.config.easing});

        setTimeout(function(){ $(window).resize() }, 40);
    };


    /**
     *
     */
    that._requestBars = function( city_id, neighborhood_id, callback )
    {
        $.get('tmp/data/poi.php', {city_id:city_id, neighborhood_id:neighborhood_id}, function( data )
        {
            if(data.code == 200 && callback)
                callback(data.neighborhoods, data.bars);
        });
    };


    /**
     *
     */
    that._setupEvents = function()
    {
        var $scroll     = that.context.$container.find('.scroll');
        var $zoom       = that.context.$container.find('.zoom');
        var $head       = that.context.$container.find('.heading');
        var $selector   = that.context.$container.find('.selector');


        $(window).resize(function()
        {
            $scroll.height( $selector.height()-$head.height()-25 );
        });


        that.context.$container.find('.scroll-cities').find('li').click(function()
        {
            that.context.$container.find('form input[name=city]').val( $(this).text() );
            that.context.$container.find('form').submit();
        });


        that.context.$container.find('form').submit(function(e)
        {
            e.preventDefault();

            var city_id = $(this).find('input[name=city]').val();
            var neighborhood_id = $(this).find('select[name=neighborhood]').val();

            $(this).find('input[type=submit]').hide();
            $(this).find('input[type=reset]').show();

            that._searchBars( city_id, neighborhood_id );
        });

        that.context.$container.find('form input[type=reset]').click(function(e)
        {
            that.context.$container.find('form input[type=submit]').show();
            that.context.$container.find('form input[type=reset]').hide();

            that._showCitySelector();
            that._removeNeighborhoodSelector();
            that._hideBars();

            $(window).resize();
        });

        $zoom.find('a').click(function()
        {
            if( $(this).hasClass('plus') )
            {
                that.context.map.zoomIn();
            }
            else
            {
                that.context.map.zoomOut();
            }
        });


    };


    /**
     *
     */
    that._showAllBars = function()
    {
        that._requestBars(false, false, function(neighborhoods, bars)
        {
            that._showBars(bars, false, false);
        });
    };


    /**
     *
     */
    that.__construct = function()
    {
        var $map = $('#map');
        if( !$map.length ) return;

        that.context.map = new meta.Map({$map:$map});
        that.context.$container = $(that.config.container);

        that._setupEvents();
        that._showAllBars();
    };

    that.__construct();
};


$(document).ready(function()
{
    new meta.Cities();
});

