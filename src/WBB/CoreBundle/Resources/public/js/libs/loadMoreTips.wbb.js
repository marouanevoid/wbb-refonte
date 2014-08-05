
/**
 *
 */
meta.LoadMoreTips = function(config) {

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

        var $target     = that.context.$container.find('.tips-area');

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

        $elements.css({opacity:0, top:'6em', position:'relative'}).each(function(index){

            $(this).delay(100*(index+1)).velocity({opacity:1, top:0}, that.config.speed, that.config.easing);
        });

        setTimeout(function()
        {
            if(callback) callback();

        }, 100*$elements.length+that.config.speed );
    };
       that._customScroll = function()
        {
            $('.custom-scroll').not('.jspScrollable').each(function()
            {
                //$(this).jScrollPane({autoReinitialise: true, hideFocus:true});
                $(this).jScrollPane({hideFocus:true});
            });

            var customScrollTimeout = false;

            $(window).resize(function()
            {
                clearTimeout(customScrollTimeout);
                customScrollTimeout = setTimeout(that._resizeCustomScroll, 10);
            });
        };

        that._resizeCustomScroll = function()
        {
            $('.custom-scroll').each(function()
            {
                var api = $(this).data('jsp');
                if( typeof(api) != "undefined" && $(this).is(':visible') ) api.reinitialise();
             });
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
                
                if(parseInt(msg.difference)==0){
                    that.config.$button.hide();
                    if(is_mobile == 1)
                        that.config.$button.parent().hide();
                }

                if(parseInt(msg.difference)==0 && $(".line .three").length<=1)
                {
                    $('.line .three').addClass('six').removeClass('three');
                }
                if( callback ) callback();
                that._animate($target, $target.find(".line:last-child").find('> *').not('br') , function(){  
                        that.context.is_loading = false;
                        that.config.$button.removeClass('loading').text( TRAD.common.loadmore);
                        // setTimeout(function(){
                        //     // $('.custom-scroll').not('.jspScrollable').each(function()
                        //     // {
                        //     //     $(this).jScrollPane({autoReinitialise: true, hideFocus:true});
                        //     // });
                        //  that._customScroll();
                        // },500)

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

