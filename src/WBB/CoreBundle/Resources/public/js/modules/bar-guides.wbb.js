$(document).ready(function()
{
   $("form[name=filter]")[0].reset();
   var loadData = function(fit){
       var _type, _sortby, _limit, _display;
       if($("input[name=filter]:checked").val()=='best_of')
       {
           _type = 0;
           _limit   = 9;
       }
       else if($("input[name=filter]:checked").val()=='bar_list')
       {
           _type = 1;
           _limit   = 8;
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
           _offset += 8;
       else
           _offset += 9;
       var Guides = new meta.LoadMore({$button:$(".load-more"), url:_url});
       Guides._updateContent(fit);
   }
   $(".load-more").on('click', function()
   {
       $('.disableClick').show();
       loadData(false);
   });
   $("#criteria, input[name=view-type]").change(function(){
       $('.disableClick').show();
       $(".load-more").show();
       _offset = 0;
       if($('input[name=filter]:checked').val()=='bar_list')
       {
           _limit = 8;
       }else{
           _limit = 9;
       }
       //$(".load-target").html('');
       loadData(true);
   });
   loadData(true);

    $('input[name=filter]').change(function()
    {
        $('.disableClick').show();
        $(".load-more").show();
        _offset = 0;
        if( $('input[name=filter]:checked').val() == "bar_list")
        {
            $('li.distance').css('display','block');
            _limit = 8;
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
            _limit = 9;
        }
        //$(".load-target").html('');
        loadData(true);
    });
});

