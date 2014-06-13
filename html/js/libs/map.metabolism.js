/**
 * Map
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
meta.Map = function(config){

    var that = this;

    /* Public */

    that.config = {
        speed       : 400,
        $map        : false,
        easing      : 'easeInOutCubic',
        map         :[
                        {
                            "featureType": "water",
                            "stylers": [
                                { "color": "#bdbec0" }
                            ]
                        },{
                            "featureType": "landscape.natural",
                            "stylers": [
                                { "color": "#faf3e1" }
                            ]
                        },{
                            "featureType": "administrative",
                            "elementType": "labels.text.fill",
                            "stylers": [
                                { "color": "#b5985e" }
                            ]
                        },{
                            "featureType": "transit",
                            "stylers": [
                                { "visibility": "off" }
                            ]
                        },{
                            "featureType": "road",
                            "stylers": [
                                { "visibility": "on" }
                            ]
                        }
                    ]

    };

    that.context = {};


    /* Contructor. */


    /**
     *
     */
    that.__construct =  function(config)
    {
        that.config = $.extend(that.config, config);
        that._setupContext();
    };


    /* Private. */

    /**
     *
     */
    that._setupContext = function() {

        that.config.$map.gmap3({
            map:{
                options: {
                    center:[25,0],
                    zoom: 3,
                    mapTypeId: google.maps.MapTypeId.ROADMAP,
                    mapTypeControl: false,
                    navigationControl: false,
                    scrollwheel: true,
                    zoomControl : false,
                    panControl: false,
                    streetViewControl: false,
                    styles: that.config.map
                }
            }
        });
    };


    /**
     *
     */
    that.reset = function() {

        that.config.$map.gmap3({
            map:{
                options: {
                    center:[25,0],
                    zoom: 3
                }
            }
        });
    };


    /**
     *
     */
    that.zoomIn = function() {

        var map = that.config.$map.gmap3('get');
        if(map.getZoom() < 21 ) map.setZoom( map.getZoom()+1 );
    };


    /**
     *
     */
    that.zoomOut = function() {

        var map = that.config.$map.gmap3('get');
        if(map.getZoom() >  3) map.setZoom( map.getZoom()-1 );
    };


    /**
     *
     */
    that.getMarker = function( id ) {

        return that.config.$map.gmap3({
            get: {
                id: id
            }
        });
    };


    /**
     *
     */
    that.addMarkers = function( markers, fit ){

        that.config.$map.gmap3({
            clear: {
                name:["overlay", "marker"]
            }
        });

        that.config.$map.gmap3({
            marker:{
                values:markers,
                options:{
                    draggable: false
                },
                events:{
                    mouseover: function(marker, event, context){

                        if( typeof(context.id) != 'undefined')
                            $('#'+context.id ).addClass('active');

                        if( typeof(context.data) == 'undefined') return;

                        that.config.$map.gmap3({
                            overlay:{
                                latLng: marker.getPosition(),
                                options:{
                                    content:  '<div class="label">'+context.data+'</div>',
                                    offset:{
                                        y:-95,
                                        x:30
                                    }
                                }
                            }
                        });
                    },
                    mouseout: function(marker, event, context){

                        if( typeof(context.id) != 'undefined')
                            $('#'+context.id ).removeClass('active');

                        that.config.$map.gmap3({
                            clear: {
                                name:["overlay"]
                            }
                        });

                    },
                    click: function(marker, event, context){

                        if( typeof(context.id) != 'undefined')
                            $('#'+context.id ).click();
                    }
                },
                cluster:{
                    radius: 15,
                    3: {
                        content: "<div class='cluster'></div>",
                        width: 20,
                        height: 30
                    },
                    events: {
                        click:function(cluster, event, data) {
                            var gmap = that.config.$map.gmap3('get');

                            gmap.panTo(data.data.latLng);
                            gmap.setZoom(gmap.getZoom()+2);
                        }
                    }
                }
            }
        });

        if(fit) that.config.$map.gmap3({autofit:{maxZoom: 16}});
    };


    that.__construct(config);
};