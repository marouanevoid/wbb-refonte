$(document).ready(function()
{
    var loadData = function(){
        var _url = Routing.generate('homepage')+"bar/"+_bar+"/tips/"+_offset+"/"+_limit;

        var tips = new meta.LoadMoreTips({$button:$(".load-more"), url:_url});
        tips._updateContent();
        _offset += _limit;
    }
    $(".load-more").on('click', function()
    {
        loadData();
    });
    loadData();
    _limit = 8;
});