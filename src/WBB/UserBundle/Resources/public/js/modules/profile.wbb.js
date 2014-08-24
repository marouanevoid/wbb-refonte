var wbb = wbb || {};

wbb.LoadProfile = function() {

    var that = this;
    var lastactivatedTab = "";
    var _count = {}
    that.context = {
        requestID: null,
        $barsTarget: $('.list-bars'),
        $bestofsTarget: $('.list-bestof'),
        $tipsTarget: $('.list-tips'),
        $tipUser: $('.remove-tip'),
        content: 'bars',
        filter: 'date',
        display: 'grid'
    };

    that.config = {
        bars: {
            offset: 0,
            limit: 8,
            $more: $('.more-bars')
        },
        bestofs: {
            offset: 0,
            limit: 9,
            $more: $('.more-bestofs')
        },
        tips: {
            offset: 0,
            limit: 8,
            $more: $('.more-tips')
        }
    };

    /*
    * Personalize the Scroll
    */
    that.PersonalizeScroll = function(){
        $('.custom-scroll').not('.jspNotScrollable').not('.jspScrollable').each(function()
        {
            //$(this).jScrollPane({autoReinitialise: true, hideFocus:true});
            $(this).jScrollPane({hideFocus:true});
        });
    }

    // init compteurs
    that.compteurInitialize = function(){
        _count.tips = $('[data-tab=tips]').attr('data-count');
        _count.bestof = $('[data-tab=bestof]').attr('data-count');
        _count.bars = $('[data-tab=bars]').attr('data-count');
    }


    that._setupEvents = function ()
    {
        //Load bars on first page load
        that._request(that.context.$barsTarget, that.config.bars);
        that.config.bars.offset += that.config.bars.limit;

        //load bars on radio buttons change
        $('.filter-profil a.ui-radio').on('click', function()
        {
            var _this = $(this).find('.ui-radio');
            var tabClose = function(){
                $(".tab").each(function(){
                    // if ($(this).hasClass("active")) {
                        $(this).removeClass("active");
                        $(this).fadeOut("fast");
                   // }
                })
            };

//            if ( $(_this).data('tab') == lastactivatedTab )
//                return false;
            lastactivatedTab = $(_this).data('tab');
            if($(_this).data('tab') == "bars"){
                that.context.content = 'bars';
                tabClose();
                $("#tab-bars").fadeIn("slow");
                $("#tab-bars").addClass("active");
                $("#view-account").attr("class", "bars-tab");

                // display Mode List or grid
                //var currentActive = $('.filter-view').find('.ui-radio.active').hasClass("grid") ? 'grid' : 'list';
                $('.filter-view').find('.ui-radio.active').click();

                if(that.config.bars.offset > 0)
                    return;
                that._request(that.context.$barsTarget, that.config.bars);
                that.config.bars.offset += that.config.bars.limit;

            }

            if($(_this).data('tab') == "bestof"){
                tabClose();
                $("#tab-bestof").fadeIn("slow");
                $("#tab-bestof").addClass("active");
                $("#view-account").attr("class", "bestof-tab");

                that.context.content = 'bestofs';
                $('.filter-view').find('.ui-radio.active').click();

                if(that.config.bestofs.offset > 0)
                    return;
                that._request(that.context.$bestofsTarget, that.config.bestofs);
                that.config.bestofs.offset += that.config.bestofs.limit;
            }

            if($(_this).data('tab') == "tips"){
                tabClose();
                $("#tab-tips").fadeIn("slow");
                $("#tab-tips").addClass("active");
                $("#view-account").attr("class", "tips-tab");
                // //// Update Scroll 
                // $('.custom-scroll-profile').each(function() { var api = $(this).data('jsp'); if( typeof(api) != "undefined" && $(this).is(':visible') ) api.reinitialise(); });
                // // end update scroll
                that.context.content = 'tips';
                if(that.config.tips.offset > 0)
                    return;
                that._request(that.context.$tipsTarget, that.config.tips);
                that.config.tips.offset += that.config.tips.limit;
            }
        });

        //Changes display
        $('input[name=view-type]').change(function()
        {
            that.context.display = $(this).val();
            if(that.context.content === 'bars'){
                that.config.bars.offset = 0;
                that.config.bars.$more.show();
                that.context.$barsTarget.empty();
                that._request(that.context.$barsTarget, that.config.bars);
                that.config.bars.offset += that.config.bars.limit;
            }else{
                that.config.bestofs.offset = 0;
                that.config.bestofs.$more.show();
                that.context.$bestofsTarget.empty();
                that._request(that.context.$bestofsTarget, that.config.bestofs);
                that.config.bestofs.offset += that.config.bestofs.limit;
            }

        });

        //Changes filter criteria
        $('#criteria').change(function(){
            that.context.filter = $(this).val();
            if(that.context.content === 'bars'){
                that.config.bars.offset = 0;
                that.config.bars.$more.show();
                that.context.$barsTarget.empty();
                that._request(that.context.$barsTarget, that.config.bars);
                that.config.bars.offset += that.config.bars.limit;
            }else{
                that.config.bestofs.offset = 0;
                that.config.bestofs.$more.show();
                that.context.$bestofsTarget.empty();
                that._request(that.context.$bestofsTarget, that.config.bestofs);
                that.config.bestofs.offset += that.config.bestofs.limit;
            }
        });

        //load more button for tips
        that.config.tips.$more.click(function(){
            that._request(that.context.$tipsTarget, that.config.tips);
            that.config.tips.offset += that.config.tips.limit;
        });

        //load more button for bestofs
        that.config.bestofs.$more.click(function(){
            that._request(that.context.$bestofsTarget, that.config.bestofs);
            that.config.bestofs.offset += that.config.bestofs.limit;
        });

        //load more button for bars
        that.config.bars.$more.click(function(){
            that._request(that.context.$barsTarget, that.config.bars);
            that.config.bars.offset += that.config.bars.limit;
        });

        var descrimentFunction = function(cible,itype){
            var stringTip = '',
                stringBar = '',
                stringBest = '';

            if ( itype == 'tip' ) {
                _count.tips--;
                if(_count.tips <= 0){
                    stringTip = "no tip";
                }else{
                    if(_count.tips == 1){
                        stringTip = "(1) Tip"
                    }else{
                        stringTip = "("+ _count.tips +") Tips";
                    }
                }

                $(cible).find('span').text(stringTip);
            } else {
                if ( itype == 'bar' ){
                    _count.bars--;
                    if(_count.bars <= 0){
                        stringBar = "No bar";
                    }else{
                        if(_count.bars == 1){
                            stringBar = "(1) Bar"
                        }else{
                            stringBar = "("+ _count.bars +") Bars";
                        }
                    }
                    $(cible).find('span').text(stringBar);
                } else {
                    if ( itype == 'best of' ){
                        _count.bestof--;
                        if(_count.bestof <= 0){
                            stringBest = "No collection";
                        }else{
                            if(_count.bestof == 1){
                                stringBest = "(1) collection"
                            }else{
                                stringBest = "("+ _count.bestof +") collections";
                            }
                        }

                        $(cible).find('span').text(stringBest);
                    }
                }
            }


        }
        // Add listner on Remove Items 
        $(document).on('removeitem' , function(e){

            var filterprof = $('.filter-profil');

            //e.cible = window.cibleDeleted;

            if(e.cible.type =='bar'){
                descrimentFunction(filterprof.find('.js-tab-show-bar').closest('a'), e.cible.type);
                var itemToDelete = $('.list-bars').find("a[data-id= " + e.cible.id + "]").parents(".bar-w-pic");
                
                if(! ismobile ){
                    itemToDelete = itemToDelete.parent();
                }

                if (itemToDelete.parents(".bar-w-pic-list").length)
                    itemToDelete.parents(".bar-w-pic-list").remove();
                else
                    itemToDelete.remove();
                that.context.content = 'bars';
                that._request(that.context.$barsTarget, {limit : 1 , offset : that.config.bars.offset-1 , filter : that.context.filter , display : that.context.display , $more : that.config.bars.$more});
            }
            if(e.cible.type =='best of'){
                descrimentFunction(filterprof.find('.js-tab-show-bestof').closest('a'), e.cible.type);

                $('.list-bestof').find("a[data-id= " + e.cible.id + "]").parents(".bestof-item-container").remove();
                that.context.content = 'bestofs';
                that._request(that.context.$bestofsTarget, {limit : 1 , offset : that.config.bestofs.offset-1 , filter : that.context.filter , display : that.context.display , $more : that.config.bestofs.$more});
            }
            if(e.cible.type == 'tip'){
                descrimentFunction(filterprof.find('.js-tab-show-tips').closest('a'), e.cible.type);
                that.context.content = 'tips';
                that._request(that.context.$tipsTarget, {limit : 1 , offset : that.config.tips.offset-1 , filter : 'date' , display : 'grid' , $more : that.config.tips.$more});
            }
        }); 


        // focus on active Tab
        var activedTab = $('.filter-profil .ui-radio.active');
        if(activedTab.length)
        {
            activedTab.click();
        }
    };

    // Aadd Handler on Ajax loaded
    that.setpEventAfterAjax = function(){
        // add listner on delete tips

        var removeHandler = function(){
            if(!confirm(' Are you sure you want to delete this tip ?'))
                return false;

            var _btnclose = $(this);
            $.get(Routing.generate('wbb_bar_tips_delete' , {tipId : $(this).attr('data-id') }) , function(res){
                // if is deleted
                _btnclose.parents('li.item-tips').remove();
                // dispatching Event removeitem
                $.event.trigger({
                    type: "removeitem",
                    cible: {type: 'tip', id: null}
                });
            });

            return false;
        }

        $('.remove-tip').off('click').on('click' , removeHandler);
    }

    that._request = function ($target, config)
    {
        // Show Loader
        $('.loader-profile-flux').show();

        var _url = Routing.generate('wbb_profile_filters', {'content': that.context.content, 'filter': that.context.filter, 'offset': config.offset, 'limit': config.limit, 'display': that.context.display});
        that.context.requestID = $.ajax({
            type: "GET",
            url: _url,
            dataType: "json",
            success: function(msg) {
                // Hide Loader
                $('.loader-profile-flux').hide();

                $target.append(msg.htmldata);
                /*
                * Personalize Scroll on Tips
                */

                that.PersonalizeScroll();

                if($target === that.context.$tipsTarget){
                    // SetUp events of tips
                    that.setpEventAfterAjax();
                }
                if(msg.nbResults < config.limit || msg.difference == 0)
                    config.$more.hide();

                $target.find('img[data-src]').each(function()
                {
                    $(this).load(that._imageLoaded);
                    $(this).error(that._imageLoaded);
                    $(this).attr('src', $(this).data('src'));
                });

            },
            beforeSend: function()
            {
                if (that.context.requestID != null)
                    that.context.requestID.abort();
            },
            error: function(e) {
            }
        });
    };

    that.__construct = function()
    {
        that._setupEvents();
        that.compteurInitialize();

    };

    that.removeTip = function(id){};

    that.__construct();
};
