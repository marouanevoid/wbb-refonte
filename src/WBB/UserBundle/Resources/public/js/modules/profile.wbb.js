var wbb = wbb || {};

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
            limit: 8,
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
        $('input[name=filter]').change(function()
        {
            if($(this).data('tab') == "bars"){
                that.context.content = 'bars';
                that._request(that.context.$barsTarget, that.config.bars);
                that.config.bars.offset += that.config.bars.limit;
            }

            if($(this).data('tab') == "bestof"){
                that.context.content = 'bestofs';
                that._request(that.context.$bestofsTarget, that.config.bestofs);
                that.config.bestofs.offset += that.config.bestofs.limit;
            }

            if($(this).data('tab') == "tips"){
                that.context.content = 'tips';
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
    };

    that._request = function ($target, config)
    {
        var _url = Routing.generate('wbb_profile_filters', {'content': that.context.content, 'filter': config.filter, 'offset': config.offset, 'limit': config.limit, 'display': config.display});
        that.context.requestID = $.ajax({
            type: "GET",
            url: _url,
            dataType: "json",
            success: function(msg) {
                console.log(msg);
                $target.append(msg.htmldata);

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

    that.__construct();
};
