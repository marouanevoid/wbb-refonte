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

        var $target     = that.context.$container.find('.load-target');

        /* Récupérer la traduction pour loading */
        that.config.$button.addClass('loading').text(TRAD.common.loading);
        that._loadAjax(that.config.url, $target, function()
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


    that._load = function( url, $target, callback)
    {
        that.context.is_loading = true;
        $target.load(url, function()
        {
            if( callback ) callback();

            $target.hide();

            $target.removeClass('load-target');
            $target.after('<div class="'+that.config.class+' load-target"/>');

            $target.find('img[data-src]').each(function()
            {
                $(this).attr('src', $(this).data('src'));
                $(this).removeAttr('data-src');
            });
            $('line:first-child').addClass('first');

            that._animate($target, $target.find('> *').not('br') );

            that.context.is_loading = false;
        })
    };

    that._loadAjax = function( url, $target, callback)
    {

        that.context.is_loading = true;
        $.ajax({
            type: "GET",
            url: url,
            dataType: "json",
            success: function(msg) {
                $target.append(msg.htmldata);
                if( callback ) callback();
                $target.find(".line:last-child").hide();
                that.context.itemsNumber = $target.find('img[data-src]').length;
                $target.find('img[data-src]').each(function()
                {
                    $(this).load(function () {
                      that.context.itemsNumber--;
                      $(this).removeAttr('data-src');
                      alert(that.context.itemsNumber);
                      if (that.context.itemsNumber <= 0)
                        $target.find(".line:last-child").show();
                        that._animate($target, $target.find(".line:last-child").find('> *').not('br') );

                        that.context.is_loading = false;
                        that.config.$button.removeClass('loading').text( TRAD.common.morebars);
                    });
                    $(this).attr('src', $(this).data('src'));
                });
            },
            error: function(e) {
                console.log('Error : ' + e);
            }
        });
    };


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

