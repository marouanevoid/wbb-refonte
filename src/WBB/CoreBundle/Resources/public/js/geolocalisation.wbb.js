
  $(function(w){
    /** Tools geolocalisation global functions **/
      function getDistanceFromLatLonInKm(lat1,lon1,lat2,lon2) {
        var R = 6371; // Radius of the earth in km
        var dLat = deg2rad(lat2-lat1);  // deg2rad below
        var dLon = deg2rad(lon2-lon1); 
        var a = 
          Math.sin(dLat/2) * Math.sin(dLat/2) +
          Math.cos(deg2rad(lat1)) * Math.cos(deg2rad(lat2)) * 
          Math.sin(dLon/2) * Math.sin(dLon/2)
          ; 
        var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a)); 
        var d = R * c; // Distance in km
        return d;
      }

      function deg2rad(deg) {
        return deg * (Math.PI/180)
      }

      // // find the nearest Point refer to the current position

      // function nearestPosition(array){
      //   var  clat = $.cookie('currentLat'),
      //        clong = $.cookie('currentLong'),
      //        cindex = 0,
      //        distance = getDistanceFromLatLonInKm(clat , clong , array[0].lat , array[0].lon);

      //  for(var i=1; i<array.length ; i++){
      //     var cdistane = getDistanceFromLatLonInKm(clat , clong , array[i].lat , array[i].lon);
      //     if(cdistane < distance){
      //       distance = cdistane;
      //       cindex = i;
      //     }
      //  }

      // return {km : distance , index : cindex};

      // }
    /** End function  tools geolocalisation **/

    // callback function 
      function stockCurrentLatAndLong(position) {

        var currentLat = position.coords.latitude ,
            currentLong = position.coords.longitude;

        // stock this on coockies

        if( $.cookie ){
          $.cookie('currentLong' , currentLong);
          $.cookie('currentLat' , currentLat);

          // send the request Ajax to get the nearest point
          $.ajax({
                      url: Routing.generate('wbb_nearest_city', { latitude : $.cookie('currentLat') , longitude : $.cookie('currentLong') }) ,
                      success: function( data )
                      { 
                        if(data){
                          if(data.id)
                            $.cookie('near_id', data.id)
                          if(data.slug)
                            $.cookie('near_islug', data.slug)
                          if(data.latitude)
                            $.cookie('near_latitude', data.latitude)
                          if(data.longitude)
                            $.cookie('near_longitude' , data.longitude);
                        }
                        // init near Location
                        initNearPositions(data);
                      }
          });
        }

      }


      // init theLocation near
      function initNearPositions(data){
          // TODO : where the user is accept geolocalisation 
          // And the nearest Lat lon is stocked
      }

    // if the current navigator support geolocalisation
    // if the geolocalisation is aleady stocked 

    //if(navigator.geolocation && ( ! $.cookie('currentLat') || $.cookie('currentLat') == '' ))
      //navigator.geolocation.getCurrentPosition(stockCurrentLatAndLong);
  })



