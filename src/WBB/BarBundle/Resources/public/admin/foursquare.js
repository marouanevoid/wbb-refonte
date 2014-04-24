$(function() {
    foursquareFeed = new FoursquareFeed();
    foursquareFeed.init();
});

function FoursquareFeed() {
    var foursquareFeed = this;
    var options  = {};

    foursquareFeed.init = function() {
        foursquareFeed.tabs();
        foursquareFeed.more();
        foursquareFeed.add();
        $('.loader').hide();
    }

    foursquareFeed.tabs = function() {
        $('a[data-toggle="tab"]').on('shown', function (e) {
            var elementId = e.target.toString().match(/#.+/gi)[0];

            if (elementId == "#list_feed") {
                e.preventDefault();
                window.location.reload(true);
            } else {
                var content = $(elementId).find(".content_fsfeeds");

                if (content.find('.fsfeed').length < 1) {
                    foursquareFeed.load(elementId.substring(1), content);
                };
            }

        })
    }

    foursquareFeed.more = function() {
        $('.more').on('click', function() {
            var id = $(this).data('next');
            var type    = $(this).parents('.tab-pane').attr('id');
            var content = $(this).parents(".fsfeeds").find(".content_fsfeeds");
            foursquareFeed.load(type, content, id);
        })
    }

    foursquareFeed.add = function() {
        $(document).on('click', '.add', function(){
            var loader = $(this).parent('.mt_footer').find('.loader');
            var container = $(this).parents('.fsfeed');

            var hash = container.attr('id');
            var thematic = $('#thematic-'+hash).val();
            var type = $(this).parents('.tab-pane').attr('id');

            loader.show();
            $.ajax({
                type: "GET",
                url: Routing.generate(
                    'bmwi_forum_feedadmin_add',
                    { type: type, hash: hash, thematic_id: thematic}
                ),
                dataType: "json",
                success: function(msg) {
                    loader.hide();
                    $(container).addClass('fsfeed_disabled');
                    $(container).find('.mt_footer').empty();
                },
                error: function(response) {
                    console.log('Error!: ' + response);
                }
            });
        });
    }

    foursquareFeed.load = function(type, container, next) {
        var query = null;
        next = next || false;
        query = {
            type: type,
            next: next !== false ? next:''
        };

        loader = $(container).parent('.fsfeeds').find('.fsfeeds_action .loader');
        nextBtn = $(container).parent('.fsfeeds').find('input.more');

        loader.show();
        $.ajax({
            type: "POST",
            url:  Routing.generate('bmwi_forum_feedadmin_list', query),
            dataType: 'json',
            success: function(response) {
                loader.hide();
                var thematic = "";

                $(nextBtn).data('next', response.next);

                $('#filter_thematic_value option').each(function(key, option) {
                    thematic += "<option value='"+ $(option).val() +"' >"+ $(option).text() +"</option>";
                });

                $.each(response.data, function(key, feed){
                    var feedHtml = feed.disable ? $("#fsfeedDisabled").html():$("#fsfeed").html();
                    var template = null;

                    if (response.type == 'twitter') {
                        template = feedHtml.format(
                            feed.id_str, 'http://twitter.com/'+feed.user.screen_name, feed.user.profile_image_url, '@'+feed.user.screen_name, feed.user.name,
                            feed.created_at, feed.text, thematic
                        );
                    } else if (response.type == 'facebook') {
                        if (feed.message) {
                            template = feedHtml.format(
                                feed.id, feed.link, feed.picture,
                                'BMW i', '', feed.created_time, feed.message, thematic
                            );
                        };
                    }

                    container.append(template);
                });
            },
            error: function(response) {
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
