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
        $tipsTarget: $('.list-tips')
    };

    that.config = {
        content : 'bars',
        filter: 'date',
        offset: 0,
        limit: 8,
        display: 'grid'
    };

    that._setupEvents = function ()
    {
        //Load bars on first page load
        that._request(that.context.$barsTarget);

        //load bars on radio buttons change
        $('input[name=filter]').change(function()
        {
            if($(this).data('tab') == "bars"){
                that.config.content = 'bars';
                that._request(that.context.$barsTarget);
                that.config.offset += that.config.limit;
            }

            if($(this).data('tab') == "bestofs"){
                that.config.content = 'bestofs';
                that._request(that.context.$bestofsTarget);
                that.config.offset += that.config.limit;
            }

            if($(this).data('tab') == "tips"){
                that.config.content = 'tips';
                that._request(that.context.$tipsTarget);
                that.config.offset += that.config.limit;
            }
        });
    };

    that._request = function ($target)
    {
        var _url = Routing.generate('wbb_profile_filters', {'content': that.config.content, 'filter': that.config.filter, 'offset': that.config.offset, 'limit': that.config.limit, 'display': that.config.display});
        that.context.requestID = $.ajax({
            type: "GET",
            url: _url,
            dataType: "json",
            success: function(msg) {
                console.log(msg);
                $target.append(msg.htmldata);

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

    that.__construct = function(  )
    {
            //
        that._setupEvents();
    };

    that.__construct();
};
