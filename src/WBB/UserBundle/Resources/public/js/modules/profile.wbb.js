var wbb = wbb || {};
console.log($('.remove-tip').data('id'));
/**
 *
 */
wbb.LoadProfile = function() {

    var that = this;

    that.context = {
        requestID: null,
        $barsTarget: $('.list-bars'),
        $bestofsTarget: $('.list-bestof'),
        $tipsTarget: $('.list-tips'),
        $tipUser: $('.remove-tip'),
        content: 'bars'
    };

    that.config = {
        bars: {
            offset: 0,
            limit: 8,
            filter: 'date',
            display: 'grid',
            $more: $('.more-bars')
        },
        bestofs: {
            offset: 0,
            limit: 6,
            filter: 'date',
            display: 'grid',
            $more: $('.more-bestofs')
        },
        tips: {
            offset: 0,
            limit: 8,
            $more: $('.more-tips')
        }
    };

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

            if($(_this).data('tab') == "bars"){
                that.context.content = 'bars';
                console.log('show barrs');
                tabClose();
                $("#tab-bars").fadeIn("slow");
                $("#tab-bars").addClass("active");
                $("#view-account").attr("class", "bars-tab");

                if(that.config.bars.offset > 0)
                    return;
                that._request(that.context.$barsTarget, that.config.bars);
                that.config.bars.offset += that.config.bars.limit;
            }

            if($(_this).data('tab') == "bestof"){
                tabClose();
                console.log('show best of');

                $("#tab-bestof").fadeIn("slow");
                $("#tab-bestof").addClass("active");
                $("#view-account").attr("class", "bestof-tab");

                that.context.content = 'bestofs';
                if(that.config.bestofs.offset > 0)
                    return;
                that._request(that.context.$bestofsTarget, that.config.bestofs);
                that.config.bestofs.offset += that.config.bestofs.limit;
            }

            if($(_this).data('tab') == "tips"){
                console.log('show tips');
                tabClose();
                $("#tab-tips").fadeIn("slow");
                $("#tab-tips").addClass("active");
                $("#view-account").attr("class", "tips-tab");

                that.context.content = 'tips';
                if(that.config.tips.offset > 0)
                    return;
                that._request(that.context.$tipsTarget, that.config.tips);
                that.config.tips.offset += that.config.tips.limit;
            }
        });

        //load bars on radio buttons change
        $('input[name=bars-view-type]').change(function()
        {
            that.config.bars.display = $(this).val();
            that.config.bars.offset = 0;
            that.context.$barsTarget.empty();
            that._request(that.context.$barsTarget, that.config.bars);
            that.config.bars.offset += that.config.bars.limit;
        });

        //load bars on radio buttons change
        $('input[name=bestof-view-type]').change(function(){
            that.config.bestofs.display = $(this).val();
            that.config.bestofs.offset = 0;
            that.context.$bestofsTarget.empty();
            that._request(that.context.$bestofsTarget, that.config.bestofs);
            that.config.bestofs.offset += that.config.bestofs.limit;
        });

        //load bars on radio buttons change
        $('#criteria-bar').change(function(){
            that.config.bars.filter = $(this).val();
            that.config.bars.offset = 0;
            that.context.$barsTarget.empty();
            that._request(that.context.$barsTarget, that.config.bars);
            that.config.bars.offset += that.config.bars.limit;
        });

        //load bars on radio buttons change
        $('#criteria-bestof').change(function(){
            that.config.bestofs.filter = $(this).val();
            that.config.bestofs.offset = 0;
            that.context.$bestofsTarget.empty();
            that._request(that.context.$bestofsTarget, that.config.bestofs);
            that.config.bestofs.offset += that.config.bestofs.limit;
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



        var descrimentFunction = function(cible){
            var str = $(cible).html(),
                arr = str.split(')'),
                cstr = arr[0].substr(1),
                cint = Number(cstr),
                ncint = cint;
            cint--;

            str = str.replace(cstr , cint);

            $(cible).html(str);

            return cint;
        }
        // Add listner on Remove Items 
        $(document).on('removeitem' , function(e){
            var filterprof = $('.filter-profil');
            if(e.cible =='bars'){
                descrimentFunction(filterprof.find('.Bars'));

                that.context.content = 'bars';
                console.log('the offest is ::' + that.config.bars.offset);
                that._request(that.context.$barsTarget, {limit : 1 , offset : that.config.bars.offset-1 , filter : that.config.bars.filter , display : that.config.bars.display , $more : that.config.bars.$more});
            }
            if(e.cible =='bestof'){
                console.log('the offest is bestofs::' + that.config.bestofs.offset);
                descrimentFunction(filterprof.find('.collections'));
                that.context.content = 'bestofs';
                that._request(that.context.$bestofsTarget, {limit : 1 , offset : that.config.bestofs.offset-1 , filter : that.config.bestofs.filter , display : that.config.bestofs.display , $more : that.config.bestofs.$more});
            }
            if(e.cible == 'tips'){
                 console.log('the offest tips  is ::' + that.config.tips.offset);
                descrimentFunction(filterprof.find('.tips'));

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
            var _btnclose = $(this);
            $.get(Routing.generate('wbb_bar_tips_delete' , {tipId : $(this).attr('data-id') }) , function(res){
                // if is deleted
                _btnclose.parents('li.item-tips').remove();
                // dispatching Event removeitem
                $.event.trigger({
                    type: "removeitem",
                    cible: 'tips'
                });
            });

            return false;
        }

        $('.remove-tip').off('click').on('click' , removeHandler);
    }

    that._request = function ($target, config)
    {
        var _url = Routing.generate('wbb_profile_filters', {'content': that.context.content, 'filter': config.filter, 'offset': config.offset, 'limit': config.limit, 'display': config.display});
        that.context.requestID = $.ajax({
            type: "GET",
            url: _url,
            dataType: "json",
            success: function(msg) {
                $target.append(msg.htmldata);
                if($target === that.context.$tipsTarget){
                    // SetUp events of tips
                    that.setpEventAfterAjax();
                }
                if(msg.nbResults < config.limit)
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
                console.log('Profile.wbb.js - Error : ' + e);
            }
        });
    };

    that.__construct = function()
    {
        that._setupEvents();
    };

    that.removeTip = function(id)
    {

    };

    that.__construct();
};
