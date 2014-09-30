$(document).ready(function()
{
    /*
    * Select 2 sort by bar guide
    */
    if( $('.select2-dropdown.sort-bar-guide').length){
                  // insert select 2
        $('.select2-dropdown.sort-bar-guide').select2({
            minimumResultsForSearch: -1,
            dropdownCssClass : 'white-style',
            containerCssClass : 'white-style'
        });
    }
    var barsLimit = 8;
    var bestofLimit = 9;
    var haveDistance = $('#criteria').find('option[value=distance]').length;
   $("form[name=filter]")[0].reset();
   var loadData = function(){
       if(istablet==1)
       {
           if($('.bar-filter .bar-w-pic').length>0)
               barsLimit = 4;
           else
               barsLimit = 8;

           if($('.bar-filter .best-of-container').length>0)
               bestofLimit = 3;
           else
               bestofLimit = 9;
       }
       var _type, _sortby, _limit, _display;
       if($("input[name=filter]:checked").val()=='best_of')
       {
           _type = 0;
           _limit   = bestofLimit;
       }
       else if($("input[name=filter]:checked").val()=='bar_list')
       {
           _type = 1;
           _limit   = barsLimit;
       }
       _sortby  = $("#criteria").val();
       _display = $('input[name=view-type]:checked').val();
       console.log("Type : " + $("input[name=filter]:checked").val() );
//       console.log("City : " + _city );
       console.log("Sort by : " + _sortby );
//       console.log("Offset : " + _offset );
//       console.log("Limit : " + _limit );
       console.log("Display : " + _display );

       ////// TODO ADD THE LAT AND LON TO THE RESQUEST ////////
       var cibling_long = $.cookie('currentLong'),
           cibling_lat = $.cookie('currentLat');
      ///////////////////////////////////////////////////////
       var _url = Routing.generate('homepage')+"barguide/filter/"+_type+"/"+_city+"/"+_sortby+"/"+_offset+"/"+_limit+"/"+_display;


       if (_type==1)
           _offset += barsLimit;
       else
           _offset += bestofLimit;
       var Guides = new meta.LoadMore({$button:$(".load-more"), url:_url});
       Guides._updateContent();
   }
   $(".load-more").on('click', function()
   {
       if(istablet==1)
       {
               barsLimit = 4;
               bestofLimit = 3;
       }
       $('.disableClick').show();
       loadData();

       return false;
   });
   $("#criteria, input[name=view-type]").change(function(){
       if(istablet==1)
       {
           if($('.bar-filter .bar-w-pic').length>0)
               barsLimit = 4;
           else
               barsLimit = 8;

           if($('.bar-filter .best-of-container').length>0)
               bestofLimit = 3;
           else
               bestofLimit = 9;
       }
       $('.disableClick').show();
       $(".load-more").show();
       _offset = 0;
       if($('input[name=filter]:checked').val()=='bar_list')
       {
           _limit = barsLimit;
       }else{
           _limit = bestofLimit;
       }
       $(".load-target").html('');
       loadData();
   });
   loadData();

    $('input[name=filter]').change(function()
    {
        if(istablet==1)
        {
            if($('.bar-filter .bar-w-pic').length>0)
                barsLimit = 4;
            else
                barsLimit = 8;

            if($('.bar-filter .best-of-container').length>0)
                bestofLimit = 3;
            else
                bestofLimit = 9;
        }
        $('.disableClick').show();
        $(".load-more").show();
        _offset = 0;
        if( $('input[name=filter]:checked').val() == "bar_list")
        {   
            if(istablet || ismobile){
              if(haveDistance){
                $('#criteria').prepend('<option value=distance>Distance</option>');
              }
            }else{
             $('li.distance').css('display','block');  
            }
            _limit = barsLimit;
        }
        else
        {
            //$('#criteria')._instance._remove('popularity');
            if(istablet || ismobile ){
              var optionDistance = $('#criteria').find('option[value=distance]');
              if($('#criteria').val() == 'distance'){
                // dispatch click on popularity
                $('#criteria').find('option[value=popularity]').attr('selected' , 'selected');
                $('#criteria').parent('.ui-dropdown-container').find('.selected').text('Popularity');
              }
              if(optionDistance.length){
                  optionDistance.remove();
              }
                
            }else{
              $('li.distance').css('display','none');
              if($('#criteria').val()=='distance')
              {
                  $('.jspPane li.popularity').trigger("click");
                  $('#criteria').val('popularity');
                  $('li.popularity').css('display','block');
              } 
            }

            _limit = bestofLimit;
        }
        $(".load-target").html('');
        loadData();
    });
});

