$(function() {
    foursquareTips = new foursquareTips();
    foursquareTips.init();
    foursquareImages = new foursquareImages();
    foursquareImages.init();
});
function foursquareTips() {
    var foursquareTips = this;
    var options  = {};

    foursquareTips.init = function() {
        foursquareTips.tabs();
        foursquareTips.add();
        $('.loader').hide();
    }

    foursquareTips.tabs = function() {
        $('a[data-toggle="tab"]').on('shown', function (e) {
            var elementId = e.target.toString().match(/#.+/gi)[0];
            var content = $(elementId).find(".content_tips");
            if (content.find('.fstip').length < 1) {
                foursquareTips.load(elementId.substring(1), content);
            };

        })
    }

    foursquareTips.add = function() {
        $(document).on('click', '.fstip .add', function(){
            var loader = $(this).parent('.mt_footer').find('.loader');
            var container = $(this).parents('.fstip');

            var hash = container.attr('id');
            var barId = 1;
            var type = 'fstips';
            var act = 'wbb_bar_feed_add';

            loader.show();
            //feed/remove/{type}/{hash}/{bar}
            if($(this).is(':checked')){
                act = 'wbb_bar_feed_add';
            }else{
                act = 'wbb_bar_feed_remove';
            }
            $.ajax({
                type: "GET",
                url: Routing.generate(
                    act,
                    { type: type, hash: hash, bar: barId}
                ),
                dataType: "json",
                success: function(msg) {
                    loader.hide();
                },
                error: function(e) {
                    console.log('Error : ' + e);
                }
            });
        });
    }

    foursquareTips.load = function(type, container) {
        var loader = $(container).parent('.tips').find('.tips_action .loader');
        loader.show();

        $.ajax({
            type: "POST",
            url:  Routing.generate('wbb_bar_feeds_find',
                { type: "fstips", id: "43695300f964a5208c291fe3"}),
            dataType: 'json',
            success: function(response) {
                loader.hide();
                var template = null;
                $.each(response.data, function(key, feed){
                    var tipsHtml = $("#tips").html();
                    template = tipsHtml.format(
                        feed.id, feed.text, feed.likes.count, feed.user.firstName, feed.user.photo.prefix+'60x60'+feed.user.photo.suffix
                    );

                    container.append(template);
                });
            },
            error: function(e) {
                console.log(e);
                loader.hide();
            }
        });
    }
}

function foursquareImages() {
    var foursquareImages = this;
    var options  = {};

    foursquareImages.init = function() {
        foursquareImages.tabs();
        foursquareImages.add();
        $('.loader').hide();
    }

    foursquareImages.tabs = function() {
        $('a[data-toggle="tab"]').on('shown', function (e) {
            var elementId = e.target.toString().match(/#.+/gi)[0];
            var content = $(elementId).find(".content_imgs");

            if (content.find('.fsimg').length < 1) {
                foursquareImages.load(elementId.substring(1), content);
            };

        })
    }

    foursquareImages.add = function() {
        $(document).on('click', '.fsimg .add', function(){
            var loader = $(this).parent('.mt_footer').find('.loader');
            var container = $(this).parents('.fsimg');

            var hash = container.attr('id');
            var barId = 1;
            var type = 'fsimgs';
            var act = 'wbb_bar_feed_add';

            loader.show();
            //feed/remove/{type}/{hash}/{bar}
            if($(this).is(':checked')){
                act = 'wbb_bar_feed_add';
            }else{
                act = 'wbb_bar_feed_remove';
            }
            $.ajax({
                type: "GET",
                url: Routing.generate(
                    act,
                    { type: type, hash: hash, bar: barId}
                ),
                dataType: "json",
                success: function(msg) {
                    loader.hide();
                },
                error: function(e) {
                    console.log('Error : ' + e);
                }
            });
        });
    }

    foursquareImages.load = function(type, container) {
        var loader = $(container).parent('.imgs').find('.imgs_action .loader');
        loader.show();

        $.ajax({
            type: "POST",
            url:  Routing.generate('wbb_bar_feeds_find',
                { type: "fsimgs", id: "43695300f964a5208c291fe3"}),
            dataType: 'json',
            success: function(response) {
                loader.hide();
                var template = null;
                $.each(response.data, function(key, feed){
                    console.log(feed);
                    var imgsHtml = $("#imgs").html();
                    template = imgsHtml.format(
                        feed.id, feed.prefix+"200x200"+feed.suffix
                    );

                    container.append(template);
                });
            },
            error: function(e) {
                console.log(e);
                loader.hide();
            }
        });
    }
}


String.prototype.format = function() {
    var args = arguments;
    return this.replace(/{(\d+)}/g, function(match, number) {
        return typeof args[number] != 'undefined'
            ? args[number]
            : match
            ;
    });
};
