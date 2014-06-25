var meta = meta || {};

/**
 *
 */
meta.LoadMore = function(config) {

    var that = this;

    that.context = {
        is_loading : false,
        itemsNumber : 0
    };

    that.config = {
        $button : false,
        $target : null,
        class   : 'line',
        speed   : 500,
        easing  : 'easeInOutCubic'
    };


    /* Public attributes. */
    that._setupEvents = function(){

        /*that.config.$button.on('click', function(e)
        {
            e.preventDefault();
            that._updateContent();
        });*/
    };

    that._updateContent = function() {

        if(that.context.is_loading) return;

        that.config.$target     = that.context.$container.find('.load-target');

        /* Récupérer la traduction pour loading */
        that.config.$button.addClass('loading').text(TRAD.common.loading);
        that._loadAjax(that.config.url, function()
        {

        });
    };



    that._setupContext = function(){

        that.context.$container = that.config.$button.closest('.load-container');
    };


    that._animate = function($target, $elements, callback ){

        var target_height = $target.show().height();

        $elements.addClass('enable3d').css({opacity:0, top:'6em', position:'relative'}).each(function(index){

            $(this).delay(100*(index+1)).velocity({opacity:1, top:0}, that.config.speed, that.config.easing);
        });

        setTimeout(function()
        {
            if(callback) callback();
            $elements.removeClass('enable3d');

        }, 100*$elements.length+that.config.speed );
    };

    that._loadAjax = function( url, callback)
    {

        that.context.is_loading = true;
        $.ajax({
            type: "GET",
            url: url,
            dataType: "json",
            success: function(msg) {
                that.config.$target.append(msg.htmldata);
                if(parseInt(msg.difference)==0)
                    that.config.$button.hide();

                if( callback ) callback();
                that.config.$target.find(".line:last-child").hide();
                that.context.itemsNumber = that.config.$target.find('img[data-src]').length;
                that.config.$target.find('img[data-src]').each(function()
                {
                    $(this).load(that._imageLoaded);
                    $(this).error(that._imageLoaded);
                    $(this).attr('src', $(this).data('src'));
                });
                $('.disableClick').hide();
            },
            error: function(e) {
                console.log('Load More - Error : ' + e);
            }
        });
    };

    that._imageLoaded = function ()
    {
        that.context.itemsNumber--;
        console.log(" itemsNumber : " + that.context.itemsNumber + " , " + $(this));
        $(this).removeAttr('data-src');
        if (that.context.itemsNumber <= 0)
            that.config.$target.find(".line:last-child").show();
        that._animate(that.config.$target, that.config.$target.find(".line:last-child").find('> *').not('br') );

        that.context.is_loading = false;
        if($("input[name=filter]:checked").val()=='bar_list')
        {
            that.config.$button.removeClass('loading').text( TRAD.common.morebars);
        }else
        {
            that.config.$button.removeClass('loading').text( TRAD.common.morebestof);
        }
    }

    /**
     *
     */
    that.__construct = function( config )
    {
        that.config = $.extend(that.config, config);

        that._setupContext();
        that._setupEvents();
    };

    that.__construct( config );
};

