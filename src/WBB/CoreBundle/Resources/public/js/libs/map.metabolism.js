
var wbb = wbb || {};

/**
 *
 */
wbb.Map = function(config){

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
                    maxZoom: 21,
                    minZoom: 3,
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
        map.panTo(0);
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



    that.setCenter = function( position ) {

        var map = that.config.$map.gmap3('get');

        //if( !map.getBounds().contains(position) )
        that.config.$map.gmap3('get').panTo( position );
    };


    that.addZoomListener = function ( callback ){

        var map = that.config.$map.gmap3('get');

        google.maps.event.addListener(map, 'zoom_changed', function() {
            var zoomLevel = map.getZoom();
            callback(zoomLevel);
        });

    };
    /**
     *
     */
    that.addMarkers = function( markers, fit ){

        var map = that.config.$map.gmap3('get');

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

                        if( $('html').hasClass('mobile') ) return;

                        if( typeof(context.id) != 'undefined')
                            $('html').find("li[data-id=" + context.id + "]").addClass('active');

                        if( typeof(context.data) == 'undefined'){
                            marker.setIcon(BASEURL+'images/map.pin.grey.png');
                            return;
                        }

                        var align = "right";
                        if( map.getBounds().getNorthEast().lng() - marker.getPosition().lng() < 0.0122 ) align = "left";
                        console.log(" MAP OVER ");
                        console.log(map.getBounds().getNorthEast().lng() - marker.getPosition().lng());
                        that.config.$map.gmap3({
                            overlay:{
                                latLng: marker.getPosition(),
                                options:{
                                    content:  '<div class="label '+align+'">'+context.data+'</div>',
                                    offset:{
                                        y:-95,
                                        x:30
                                    }
                                }
                            }
                        });
                    },
                    mouseout: function(marker, event, context){

                        if( typeof(context.data) == 'undefined')
                        {
                            marker.setIcon(BASEURL+'images/map.pin.png');
                        }

                        if( typeof(context.id) != 'undefined')
                            $('html').find("li[data-id=" + context.id + "]").removeClass('active');

                        that.config.$map.gmap3({
                            clear: {
                                name:["overlay"]
                            }
                        });

                    },
                    click: function(marker, event, context){

                        if( typeof(context.id) != 'undefined')
                            $('html').find("li[data-id=" + context.id + "]").click();
                    }
                }/*,
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
                }*/
            }
        });

        if(fit) that.config.$map.gmap3({autofit:{maxZoom: 16}});
    };


    that.__construct(config);
};