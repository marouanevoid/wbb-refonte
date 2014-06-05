/**
 * Search
 *
 * Copyright (c) 2014 - Metabolism
 * Author:
 *   - Jérome Barbato <jerome@metabolism.fr>
 *
 * License: GPL
 * Version: 1.0
 *
 * Requires:
 *   - jQuery
 *
 **/

/**
 * metabolism namespace.
 */
var meta = meta || {};

/**
 *
 */
meta.Search = function(config){

    var that = this;

    /* Public */

    that.config = {
        speed       : 400,
        throttle    : 250,
        easing      : 'easeInOutCubic',
        template    : '<li>'+
                            '<div class="container">'+
                                '<div class="twelve columns">'+
                                    '<a>%s</a>'+
                                '</div>'+
                            '</div>'+
                        '</li>'
    };

    that.context = {};
    that.search_timeout = false;


    /* Contructor. */

    /**
     *
     */
    that.__construct =  function(config)
    {
        that.config = $.extend(that.config, config);
        that._setupContext();
        that._setupEvents();
    };


    /* Private. */

    /**
     *
     */
    that._setupContext = function() {

        that.context.$header        = $('header');
        that.context.$normalHeader  = that.context.$header.find('.bar-finder .normal-mode, .nav nav');
        that.context.$searchHeader  = that.context.$header.find('.bar-finder .search-mode, .nav form');

        that.context.$form          = that.context.$header.find('.nav form');
        that.context.$input         = that.context.$form.find('input');
        that.context.$result        = that.context.$header.find('.search-result-proposal ul');

        var is_trident = !!(navigator.userAgent.match(/Trident/) && !navigator.userAgent.match(/MSIE/));
        if( is_trident || $('html').hasClass('ie') )
        {
            var placeholder = that.context.$input.attr('placeholder');
            var $placeholder = $('<span class="placeholder">'+placeholder+'</span>');

            that.context.$input.removeAttr('placeholder');
            that.context.$input.after($placeholder);

            $placeholder.on('click', function(){ that.context.$input.focus() });
            that.context.$input.on('keydown', function(){ $placeholder.hide() });
            that.context.$input.on('keyup', function(){ if(that.context.$input.val() == "") $placeholder.show() });
        }
    };


    /**
     *
     */
    that._search = function()
    {
        var q = that.context.$input.val();

        $.post('tmp/data/search.php',{q:q}, function( data )
        {
            if(data.code == 200)
            {
                var values  = data.values;
                var html    = "";

                $.each(values, function(index, value)
                {
                    var city = value.name.replace(data.q, '<b>'+data.q+'</b>');
                    html += that.config.template.replace('%s', city);
                });

                that.context.$result.html( html );
            }
        });
    };


    /**
     *
     */
    that._showForm = function()
    {
        that.context.$normalHeader.velocity({top:'50%', opacity:0}, { duration: that.config.speed, easing:that.config.easing, complete:function() {

            that.context.$normalHeader.hide();

            that.context.$searchHeader.css({display:'block', opacity:0}).velocity({top:'0%', opacity:1}, { duration: that.config.speed, easing:that.config.easing, complete:function(){
                that.context.$input.focus();
            }});
        }});
    };


    /**
     *
     */
    that._hideForm = function()
    {
        that.context.$result.parent().velocity("slideUp", { duration: that.config.speed, easing:that.config.easing, complete:function()
        {
            $(this).removeAttr('style');
            that.context.$input.val('');
            that.context.$result.empty();
            that.context.$form.find('.placeholder').show();
        }});

        that.context.$searchHeader.velocity({top:'-50%', opacity:0}, { duration: that.config.speed, easing:that.config.easing, complete:function() {

            that.context.$searchHeader.hide();
            that.context.$normalHeader.show().velocity({top:'0%', opacity:1}, { duration: that.config.speed, easing:that.config.easing});
        }});
    };


    /**
     *
     */
    that._setupEvents = function() {

        that.context.$header.find('.search').click(function() {
            that._showForm();
        });

        that.context.$header.find('.close').click(function() {
            that._hideForm();
        });

        that.context.$input.on('keydown', function(){
            clearInterval(that.search_timeout);
            that.search_timeout = setTimeout(function(){ that._search() }, that.config.throttle);
        })
    };



    that.__construct(config);

};

$(document).ready(function(){

    new meta.Search({});

});