$(document).ready(function()
{
   var loadData = function(){
       var _type, _sortby, _limit, _display;
       if($("input[name=filter]:checked").val()=='best_of'){
           _type = 0;
           _limit   = 9;
       }else{
           _type = 1;
           _limit   = 8;
       }
       _sortby  = $("#criteria").val();
       _display = $('input[name=view-type]:checked').val();

       var _url = Routing.generate('homepage')+"barguide/filter/"+_type+"/"+_city+"/"+_sortby+"/"+_offset+"/"+_limit+"/"+_display;
 
       if (_type==1)
           _offset += 8;
       else
           _offset += 9;
       var Guides = new meta.LoadMore({$button:$(".load-more"), url:_url});
       Guides._updateContent();
   }
   $(".load-more").on('click', function()
   {
       loadData();
   });
   $("#criteria, input[name=filter], input[name=view-type]").change(function(){
       _offset = 0;
       $(".load-target").html('');
       loadData();
   });
   loadData();
});

