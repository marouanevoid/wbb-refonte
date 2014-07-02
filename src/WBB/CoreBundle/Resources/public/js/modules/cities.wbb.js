
/* The Namespace of the project */
var wbb = wbb || {};

wbb.CitiesPage = function () {

    var that = this;
    
    that.config = {
        speed   : 500,
        easing  : 'easeInOutCubic',
        container : '.cities-content'
    };

    that.context = {
        //filter_is_open: false
        city_id : 0,
        neighborhood_id : 0,
        is_clicked : false,
        ajaxRequest : null
    };

    that.first_resize = true;
    that.current_zoom_level = 3;
    that.max_zoom_level_for_bars = 11;
    that.timer = false;

    /* Search the bars after submitting */
    that._searchBars = function( city_id, neighborhood_id )
    {
        that._hideCitySelector();
        that._showBarsSelector();
        that.context.$container.find(".scroll-bars").find('ul').html("<span>Loading...</span>");
        console.log("[Cities] _searchBars - neighborhood_id :" + neighborhood_id);
        that._requestBars(city_id, neighborhood_id, function(neighborhoods, bars)
        {
            if(neighborhoods.length) that._showNeighborhoodSelector(neighborhoods);
            that._showBars(bars, true, true);
        });
    };

    that._requestBars = function( city_id, neighborhood_id, callback )
    {
        console.log(" Request Bars : " + Routing.generate('wbb_cities_bars', { cityID:city_id, suburbID:neighborhood_id}));
        console.log("[Cities] _requestBars - neighborhood_id :" + neighborhood_id);

        that.context.ajaxRequest = $.ajax({
                                            url: Routing.generate('wbb_cities_bars', { cityID:city_id, suburbID:neighborhood_id}),
                                            success: function( data )
                                            {
                                                if(data.code == 200 && callback)
                                                    callback(data.neighborhoods, data.bars);
                                            },
                                            beforeSend: function()
                                            {
                                                console.log("beforeSend");
                                                if (that.context.ajaxRequest != null)
                                                    that.context.ajaxRequest.abort();
                                            }
        });
    };

    /* Display the list of the bars */
    that._showBars = function( bars, display_list, fit )
    {
        var html = "";
        var markers = [];
        var address = "";

        $.each(bars, function(index, bar)
        {
            address = "";
            if(typeof bar.address != 'undefined' && bar.address != null && bar.address != 'null'){
                address = bar.address;
            }

                if(typeof bar.latitude != 'undefined' && typeof bar.longitude != 'undefined' && bar.latitude != null && bar.longitude != null){
                if( display_list ) html += '<li value="'+(index+1)+'" data-id="'+ bar.id + '" data-link="'+bar.url+'"><b>'+bar.name+'</b><br/><span>'+address+'</span></li>';
                markers.push({address:bar.latitude+','+bar.longitude, data:'<img src="'+bar.image_url+'"/><b>'+bar.name+'</b>'+address, options:{icon:BASEURL+'images/markers/'+(index+1)+'.png', optimized: false}, id:bar.id});
            }
        });
        if( display_list )
        {
            var $scrollBars = that.context.$container.find('.scroll-bars');
            $scrollBars.css({ opacity: 0 });
            if(bars.length>0)
                $scrollBars.find('ul').html(html);
            else
                $scrollBars.find('ul').html("No results");

            var api = $scrollBars.data('jsp');
            api.scrollToY(0, false);


            $scrollBars.velocity('fadeIn', { duration: that.config.speed});
            setTimeout(function(){ that._resize() }, 50);
        }
        that._hideCitySelector();

        that.context.map.addMarkers(markers, fit);
    };

    /* Hide City Selector to show Bars */
    that._hideCitySelector = function()
    {
        that.context.$container.find('.scroll-cities').hide();
    };

    /* Hide City Selector to show Bars */
    that._hideBarsSelector = function()
    {
        that.context.$container.find('.scroll-bars').hide();

        that._showAllCities(fit);

        if(fit) that.context.map.reset();
    };

    /* Hide City Selector to show Bars */
    that._showBarsSelector = function()
    {
        that.context.$container.find('.scroll-bars').show();
    };

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

                setTimeout(function(){$selector.show();},400);
            }, 300);
            that._resize();
        }
    };

    that._setupEvents = function()
    {
        var $zoom       = that.context.$container.find('.zoom');
        var $selector   = that.context.$container.find('.selector');
        var $cities     = that.context.$container.find('.scroll-cities');
        var $bars       = that.context.$container.find('.scroll-bars');

        if($('input[name=city]').val()=='')
            that.context.$container.find('form input[type=submit]').attr("disabled", "disabled");
        else
            that.context.$container.find('form input[type=submit]').removeAttr("disabled");

        /* On Click on one City from the list */
        $cities.on('click', 'li', function()
        {
            if( !$('html').hasClass('mobile') || $(window).width() > 640 ) that._openFilter();
            /* Update the text on the input */
            that.context.$container.find('form input[name=city]').val( $(this).text() );
            that.context.is_clicked = true;
            that.context.city_id = $(this).data('id');
            that.context.$container.find('form').submit();
        });


        $bars.on('click', 'li', function()
        {
            document.location.href = $(this).data('link');
        });

        /* Event to center and animate the markup */
        that.context.$container.find('.scroll-bars, .scroll-cities').on('mouseenter', 'li', function()
        {
            var $this = $(this);
            var marker = that.context.map.getMarker( $(this).attr('data-id') );

            clearTimeout(that.timer);

            that.timer = setTimeout(function()
            {

                if( typeof marker  != 'undefined' && marker )
                {
                    marker.setAnimation(google.maps.Animation.BOUNCE);
                    setTimeout(function(){ marker.setAnimation(null) }, 700);
                }

                if( $this.closest('.scroll').hasClass('scroll-bars')  )
                    that.context.map.setCenter( marker.getPosition() );

            }, 200);


        });

        /* on the Leave Event, stop to animate the markup */
        that.context.$container.find('.scroll-bars, .scroll-cities').on('mouseleave', 'li', function()
        {
            clearTimeout(that.timer);
            var marker = that.context.map.getMarker( $(this).attr('data-id') );
            if( typeof marker  != 'undefined' && marker ) marker.setAnimation(null);
        });

        /* When we click on the submit button */
        that.context.$container.find('form').submit(function(e)
        {
            e.preventDefault();

            $(this).find('input[name=city]').prop('disabled', true);

            var city_id         = that.context.city_id;
            var neighborhood_id = that.context.neighborhood_id;

            /* Empty the list of bars and Neighborhood from the last time */
            $(this).find('select[name=neighborhood]').val("");
            that.context.$container.find(".scroll-bars").find('ul').html("");

            /* Hide the submit button */
            $(this).find('input[type=submit]').hide();

            /* Show the Reset button, it's to clear input */
            $(this).find('input[type=reset]').show();
            if (that.context.is_clicked == true)
                that._searchBars( city_id, neighborhood_id );
            else
            {
                that._requestCities($(this).find('input[name=city]').val(), function(query, cities)
                {
                    console.log("Cities Submit : " + cities.length);
                    if (cities.length > 1 )
                        that._showCities(query, cities, true, false);
                    else if (cities.length == 1 ) {
                        console.log("Cities Submit id : " + cities[0].id);
                        that.context.$container.find('form input[name=city]').val( cities[0].name );
                        that.context.city_id = cities[0].id;
                        that._searchBars( cities[0].id, 0 );
                    }
                });
            }
        });


        that.context.$container.find('form input[type=reset]').click(function(e)
        {
            that._backToCities(true);
        });


        that.context.map.addZoomListener(function( zoomLevel ){
            console.log("zooming..." + zoomLevel);

            if( that.current_zoom_level > zoomLevel && zoomLevel == 6 )
            {
                $("form[name=filter]")[0].reset();
                that._backToCities(false);
            }

            that.current_zoom_level = zoomLevel;
            that._resize();

        });

        $zoom.find('a').click(function()
        {
            if( $(this).hasClass('plus') )
                that.context.map.zoomIn();
            else
                that.context.map.zoomOut();
            //setTimeout(function(){ that._resize() }, 250);
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
                setTimeout(function(){ that._openFilter() }, $('html').hasClass('mobile')?200:0 );
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

        /* On click */
        $selector.find('input[name=city], input[type=submit]').click(function()
        {
            console.log("click on input selector");
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

        /* Changes on the input of city */
        that.context.$container.find('form input[name=city]').on('keyup', function()
        {
            if($('input[name=city]').val()=='')
                that.context.$container.find('form input[type=submit]').attr("disabled", "disabled");
            else
                that.context.$container.find('form input[type=submit]').removeAttr("disabled");
            if($('form input[name=city]').val().length>2  || !$('form input[name=city]').val().length )
            {
                that.context.$container.find('.scroll-cities').find('ul').html("<span>Loading...</span>");
                that.context.is_clicked = false;
                that._requestCities($(this).val(), function(query, cities)
                {
                    that._showCities(query, cities, true, false, function(){
                        var $scrollCitiesItems = that.context.$container.find('.scroll-cities li');

                        /*if($('form input[name=city]').val().length > 0)
                        {
                            //var re = new RegExp('(' + $('input[name=city]').val() + ')', 'gi');
                           // $scrollCitiesItems.html($scrollCitiesItems.html().replace(re, '<b>$1</b>'));
                        }*/
                    });
                });
            }

        });

        /* Update the Bars when we change Neighborhood */
        $(document).on('change', '.selector select[name=neighborhood]', function()
        {
            var city_id         = that.context.city_id;
            var neighborhood_id = $(".selector select[name=neighborhood]").val();

            that.context.$container.find(".scroll-bars").find('ul').html("<span>Loading...</span>");
            that._searchBars( city_id, neighborhood_id );

        });


        $(window).resize(function()
        {
            that._resize();
        });

    };

    that._backToCities = function( fit )
    {
        that.context.$container.find('form input[name=city]').prop('disabled', false);
        that.context.$container.find('form input[type=submit]').show();
        that.context.$container.find('form input[type=reset]').hide();

        if( $('html').hasClass('ie9') )
            that.context.$container.find('form input[name=city]').focus().blur();

        that._showCitySelector();
        that._removeNeighborhoodSelector();
        that._hideBars(fit);
        that.context.$container.find('.scroll-cities').find('ul').html("<span>Loading...</span>");
        if( !$('html').hasClass('mobile') || $(window).width() > 640 )
            that._showAllCities(true);
        setTimeout(function(){ that._resize() }, 50);
        that.context.$container.find('form input[type=submit]').attr("disabled", "disabled");
    }

    that._showCitySelector = function()
    {
        that.context.$container.find('.scroll-cities').velocity('fadeIn', { duration: that.config.speed, easing:that.config.easing});

        setTimeout(function(){ that._resize() }, 50);
    };

    that._removeNeighborhoodSelector = function()
    {
        that.context.$container.find('.ui-dropdown-container').remove();
    };

    that._hideBars = function(fit)
    {
        var $scrollBars = that.context.$container.find('.scroll-bars');
        $scrollBars.find('ul').empty();
        $scrollBars.hide();

        that._showAllCities(fit);

        if(fit) that.context.map.reset();

    };

    that._showAllCities = function( fit )
    {
        that._requestCities("", function(query, cities)
        {
            that._showCities(query, cities, true, false);
            if( !$('html').hasClass('mobile') || $(window).width() > 640 )
                that._openFilter();
        });
    };

    that._requestCities = function( query, callback )
    {
        console.log("[Cities] _requestCities, URL : " + Routing.generate('wbb_cities_list', {keywords: query}));
        that.context.ajaxRequest = $.ajax({
                                            url: Routing.generate('wbb_cities_list', {keywords: query}) ,
                                            success: function( data )
                                            {
                                                if(data.code == 200 && callback)
                                                    callback(query, data.cities);
                                            }, beforeSend: function()
                                            {
                                                console.log("beforeSend");
                                                if (that.context.ajaxRequest != null)
                                                    that.context.ajaxRequest.abort();
                                            }
        });
    };

    that._showCities = function( query, cities, display_list, fit, callback )
    {
        var html = "";
        var markers = [];

        $.each(cities, function(index, city)
        {
            if(typeof city.latitude != 'undefined' && typeof city.longitude != 'undefined' && city.latitude != null && city.longitude != null){
                var cityName = city.name;
                if (query != "")
                {
                    var re = new RegExp('(' + query + ')', 'gi');
                    cityName = cityName.replace(re, '<b>$1</b>');
                }
                if( display_list ) html += '<li data-id="'+city.id+'">'+cityName+'</li>';
                markers.push({address:city.latitude+','+city.longitude, options:{icon:BASEURL+'images/map.pin.png', optimized: false}, id:city.id});
            }
        });

        if( display_list )
        {
            var $scrollCities = that.context.$container.find('.scroll-cities');
            if(cities.length>0)
            {
                $scrollCities.find('ul').html(html);
                var api = $scrollCities.data('jsp');
                api.scrollToY(0, false);
            }else
            {
                $scrollCities.find('ul').html("No results");
            }

        }

        that.context.map.addMarkers(markers, false);

        //if( fit ) that.context.map.reset();
        if( callback )
            callback();
    };

    that._showNeighborhoodSelector = function(neighborhoods)
    {
        if( that.context.$container.find('select[name=neighborhood]').length ) return;

        var html = '<select name="neighborhood" class="ui-dropdown">';
        html += '<option value="-1">All</option>';
        $.each(neighborhoods, function(index, neighborhood)
        {
            html += '<option value="'+neighborhood.id+'">'+neighborhood.name+'</option>';
        });
        html += '</select>';

        that.context.$container.find('form').append(html);

        initializeDropdowns();

    };

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

                //$cities.height( cities_height );
                //$bars.height( cities_height-40 );
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



    that.__construct = function()
    {
        $("form[name=filter]")[0].reset();
        var $map = $('#map');
        if( !$map.length ) return;

        /* Initilize global vars */
        that.context.map = new wbb.Map({$map:$map});

        that.context.$container = $(that.config.container);

        that._setupEvents();
        that._showAllCities(false);

        that._resize();
    };

    that.__construct();

};

$(document).ready(function()
{
    new wbb.CitiesPage();
});

