$(document).ready(function()
{
    var barsLimit = 8;
    var bestofLimit = 9;

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
            $('li.distance').css('display','block');
            _limit = barsLimit;
        }
        else
        {
            $('li.distance').css('display','none');
            if($('#criteria').val()=='distance')
            {
                $('.jspPane li.popularity').trigger("click");
                $('#criteria').val('popularity');
                $('li.popularity').css('display','block');
            }
            _limit = bestofLimit;
        }
        $(".load-target").html('');
        loadData();
    });
});

