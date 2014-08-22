var title = encodeURIComponent($('meta[property="og:title"]').attr("content"));
var url   = encodeURIComponent($('meta[property="og:url"]').attr("content"));
var image = encodeURIComponent($('meta[property="og:image"]').attr("content"));
var description = encodeURIComponent($('meta[property="og:description"]').attr("content"));
var descriptionTW = encodeURIComponent($('meta[name="twitter:description"]').attr("content"));
var siteTW = encodeURIComponent($('meta[name="twitter:site"]').attr("content"));

//Share Facebook
$(document).on('click', '.fb-share',function(e){
    e.preventDefault();
    var share_url = 'http://www.facebook.com/sharer.php';
    share_url+='?s=100&p[title]='+title+'&p[summary]='+description+'&p[url]='+url;
    share_url+='&p[images][0]='+image;
    share_url+='&t='+title+'&e='+description;
    window.open(share_url + location.href, 'Share', 'toolbar=0,status=0,width=626,height=436');
});

//Share Twitter
if (descriptionTW.length > 140) {
    descriptionTW = descriptionTW.substr(0, 137)+'…';
};
$(document).on('click', '.twitter-share',function(e){
    e.preventDefault();
    window.open('http://twitter.com/share?text=' + descriptionTW + '&url=' + url + '&via='+siteTW  , 'Share', 'toolbar=0,status=0,width=626,height=436');
});

$(document).ready(function(){
    if(!ismobile && ! istablet){
        $("#share").hover(function() {
            $(".wrap-share").fadeIn("slow");
            if ($(this).hasClass("popup")) {
                $(".mask").fadeIn("slow");
            }
        });

        $(".wrap-share").hover(function() {
            $(".wrap-share").fadeIn("slow");
            if ($(this).hasClass("popup")) {
                PopIn.dom.mask.show();
            }
        }, function() {
            $(".wrap-share").fadeOut("slow");
            if ($(this).hasClass("popup")) {
                PopIn.dom.mask.hide();
            }
        });   
    }else{

        $("#share").click(function() {
            $(".wrap-share").fadeIn("slow");
                $(".mask").fadeIn("slow");
        });

        // $(".wrap-share").click(function() {
        //     $(".wrap-share").fadeIn("slow");
        //         PopIn.dom.mask.show();
        // });

    }

    $("#close-pop").click(function(){
        $("#share-pop").fadeOut("slow");
        $(".mask").fadeOut("slow");
    })
    $('#smsWindow').click(function() {
        $(this).target = "_blank";
        window.open($(this).prop('href'));
        return false;
    });
})