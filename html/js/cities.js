
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
            that._showBars(bars);
        });
    };


    /**
     *
     */
    that._showBars = function( bars )
    {
        var html = "";
        var markers = [];

        $.each(bars, function(index, bar)
        {
            html += '<li id="'+bar.id+'"><b>'+bar.name+'</b>'+bar.address+'</li>';
            markers.push({address:bar.address, data:'<b>'+bar.name+'</b>'+bar.address, options:{icon:'images/markers/'+index+'.png'}})
        });

        var $scrollBars = that.context.$container.find('.scroll-bars');
        $scrollBars.find('ul').html(html);
        $scrollBars.velocity('fadein', { duration: that.config.speed, easing:that.config.easing});

        that.context.map.addMarkers(markers, true);
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

        that.context.$container.find('.heading').append(html);

        initializeDropdowns();
    };


    /**
     *
     */
    that._hideCitySelector = function()
    {
        that.context.$container.find('.scroll-cities').velocity('fadeOut', { duration: that.config.speed, easing:that.config.easing});
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

            that._searchBars( city_id, neighborhood_id );
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
    };

    that.__construct();
};


$(document).ready(function()
{
    new meta.Cities();
});

