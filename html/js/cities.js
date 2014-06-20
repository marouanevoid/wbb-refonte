
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

    that.context = {
        filter_is_open: false
    };

    that.first_resize = true;

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
            if( display_list ) html += '<li id="'+bar.id+'" data-link="'+bar.url+'"><b>'+bar.name+'</b><br/><span>'+bar.address+'</span></li>';
            markers.push({address:bar.address, data:'<img src="'+bar.image_url+'"/><b>'+bar.name+'</b>'+bar.address+'<span>'+bar.tags+'</span>', options:{icon:'images/markers/'+(index+1)+'.png'}, id:bar.id});
        });

        if( display_list )
        {
            var $scrollBars = that.context.$container.find('.scroll-bars');
            $scrollBars.find('ul').html(html);
            $scrollBars.velocity('fadeIn', { duration: that.config.speed, easing:that.config.easing});

            setTimeout(function(){ that._resize() }, 50);
        }

        that.context.map.addMarkers(markers, fit);
    };


    /**
     *
     */
    that._showCities = function( cities, display_list, fit )
    {
        var html = "";
        var markers = [];

        $.each(cities, function(index, city)
        {
            if( display_list ) html += '<li id="'+city.id+'">'+city.name+'</li>';
            markers.push({address:city.name, options:{icon:'images/map.pin.png'}, id:city.id});
        });

        if( display_list )
        {
            var $scrollCities = that.context.$container.find('.scroll-cities');
            $scrollCities.find('ul').html(html);
        }

        that.context.map.addMarkers(markers, false);

        if( fit ) that.context.map.reset();
    };


    /**
     *
     */
    that._hideBars = function()
    {
        var $scrollBars = that.context.$container.find('.scroll-bars');
        $scrollBars.find('ul').empty();
        $scrollBars.hide();

        that._showAllCities(true);

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

        setTimeout(function(){ that._resize() }, 50);
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
    that._requestCities = function( callback )
    {
        $.get('tmp/data/cities.php', function( data )
        {
            if(data.code == 200 && callback)
                callback(data.cities);
        });
    };


    /**
     *
     */
    that._setupEvents = function()
    {
        var $zoom       = that.context.$container.find('.zoom');
        var $selector   = that.context.$container.find('.selector');
        var $cities     = that.context.$container.find('.scroll-cities');
        var $bars       = that.context.$container.find('.scroll-bars');


        $cities.on('click', 'li', function()
        {
            if( !$('html').hasClass('mobile') || $(window).width() > 640 ) that._openFilter();

            that.context.$container.find('form input[name=city]').val( $(this).text() );
            that.context.$container.find('form').submit();
        });


        $bars.on('click', 'li', function()
        {
            document.location.href = $(this).data('link');
        });


        that.context.$container.find('.scroll-bars, .scroll-cities').on('mouseenter', 'li', function()
        {
            var marker = that.context.map.getMarker( $(this).attr('id') );
            if( typeof marker  != 'undefined' && marker ) marker.setAnimation(google.maps.Animation.BOUNCE);
        });


        that.context.$container.find('.scroll-bars, .scroll-cities').on('mouseleave', 'li', function()
        {
            var marker = that.context.map.getMarker( $(this).attr('id') );
            if( typeof marker  != 'undefined' && marker ) marker.setAnimation(null);
        });


        that.context.$container.find('form').submit(function(e)
        {
            e.preventDefault();

            $(this).find('input[name=city]').prop('disabled', true);

            var city_id         = $(this).find('input[name=city]').val();
            var neighborhood_id = $(this).find('select[name=neighborhood]').val();

            $(this).find('input[type=submit]').hide();
            $(this).find('input[type=reset]').show();

            that._searchBars( city_id, neighborhood_id );
        });


        that.context.$container.find('form input[type=reset]').click(function(e)
        {
            that.context.$container.find('form input[name=city]').prop('disabled', false);
            that.context.$container.find('form input[type=submit]').show();
            that.context.$container.find('form input[type=reset]').hide();

            if( $('html').hasClass('ie9') )
                that.context.$container.find('form input[name=city]').focus().blur();

            that._showCitySelector();
            that._removeNeighborhoodSelector();
            that._hideBars();

            setTimeout(function(){ that._resize() }, 50);
        });


        $zoom.find('a').click(function()
        {
            if( $(this).hasClass('plus') )
                that.context.map.zoomIn();
            else
                that.context.map.zoomOut();
        });


        that.context.$container.find('input[name=display-mode]').change(function()
        {
            if( $(this).val() == "map")
            {
                $('.cities-content .scrolls').hide();
                $('.cities-content .zoom').show();
            }
            else
            {
                $('.cities-content .scrolls').show();
                $('.cities-content .zoom').hide();
            }

            that._resize();
        });



        $selector.find('input[name=city], input[type=submit]').click(function()
        {
            if( !$('html').hasClass('mobile') || $(window).width() > 640 )
            {
                that._openFilter();
            }
            else
            {
                var $modes = that.context.$container.find('input[name=display-mode]');
                var $mode_list = $modes.filter('[value=list]');
                var $mode_map = $modes.filter('[value=map]');

                $mode_map.prop('checked', false);
                $mode_map.parent().removeClass('active');


                $mode_list.parent().addClass('active');
                $mode_list.prop('checked', true).trigger("change");
            }
        });


        $(window).resize(function()
        {
            that._resize();
        });

    };


    /**
     *
     */
    that._openFilter = function()
    {

        var $head       = that.context.$container.find('.heading');
        var $selector   = that.context.$container.find('.selector');

        if( !that.context.filter_is_open )
        {
            that.context.filter_is_open = true;

            $selector.height($selector.height());
            that.context.$container.find('.scrolls').css({opacity:0, display:'block'});
            that.context.$container.find('.scrolls .custom-scroll').height(that.context.$container.height()*0.8-$head.height()-90);

            $selector.velocity({height:that.context.$container.height()*0.8-70}, that.config.speed, that.config.easing);

            setTimeout(function()
            {
                that.context.$container.find('.scrolls').velocity({opacity:1}, that.config.speed, that.config.easing);

            }, 300);
        }
    };


    /**
     *
     */
    that._showAllCities = function( fit )
    {
        that._requestCities(function(cities)
        {
            that._showCities(cities, true, fit);
        });
    };


    /**
     *
     */
    that._resize = function()
    {
        var $cities_content     = that.context.$container;
        var $cities             = that.context.$container.find('.scroll-cities');
        var $bars               = that.context.$container.find('.scroll-bars');
        var $map                = that.context.$container.find('#map');

        var $scroll     = that.context.$container.find('.scroll');
        var $head       = that.context.$container.find('.heading');
        var $header     = $('header');
        var $selector   = that.context.$container.find('.selector');

        if( !$('html').hasClass('mobile') || $(window).width() > 640 )
        {
            if( !$('html').hasClass('mobile') || that.first_resize )
            {
                that.first_resize = false;

                $cities_content.height( $(window).height()-$header.height()-$('footer').height() );

                var cities_height = $selector.height()-$head.height()-20;

                $cities.height( cities_height );
                $bars.height( cities_height-40 );
            }

            $scroll.height( $selector.height()-$head.height()-25 );

            if( that.context.filter_is_open )
            {
                that.context.$container.find('.scrolls .custom-scroll').height(that.context.$container.height()*0.8-$head.height()-90);
                $selector.height(that.context.$container.height()*0.8-70);
            }
        }
        else
        {
            $cities_content.height($(window).height() - $header.height());

            var map_height = $(window).height() - $header.height() - $head.outerHeight();

            $map.css({height:map_height, top:$head.outerHeight()});
            $cities.height( map_height-20 );
            $bars.height( map_height-20 );
        }
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
        that._showAllCities(false);

        that._resize();
    };

    that.__construct();
};


$(document).ready(function()
{
    new meta.Cities();
});

