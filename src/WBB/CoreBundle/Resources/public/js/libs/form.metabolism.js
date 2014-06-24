/**
 * Dropdown
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
meta.Form = function(config){

    var that = this;

    /* Contructor. */

    /**
     *
     */
    that.__construct =  function(config)
    {
        that.config = $.extend(that.config, config);
        that.form = that.config.$form;

        that._setupEvents();
    };

    /* Public */

    that.config = {
        speed     : 500,
        easing    : 'easeInOutCubic',
        $form     : false,
        onSubmit  : false,
        onComplete: false,
        onError   : false
    };

    that.form = false;

    /* Private. */

    /**
     *
     */
    that._setupEvents = function()
    {
        that.form.submit(function(e)
        {
            e.preventDefault();
            if( that.config.onSubmit )
            {
                if( that.config.onSubmit() ) that._sendData();
            }
            else
            {
                that._sendData();
            }
        });
    };


    that._sendData = function()
    {
        var data = that.form.serializeArray();
        var url = that.form.attr('action');

        $.post( url, data, function(data)
        {
            if(data.code == 200)
            {
                if( that.config.onComplete )
                    that.config.onComplete( that.form, data );
                if($('.insider-tips .three').length==0)
                {
                    $('.line.wbbtips .six').removeClass('six').addClass('three').after(data.tip);
                }else
                {
                    $('.line.wbbtips .three:first-child').after(data.tip);
                }
                if($('.insider-tips .three').length>=4 || ($('.insider-tips .three').length>=4 && ($('.insider-tips .three').length-4)%8!=0))
                {
                    if($('.line:last-child .three').length==0)
                    {
                        $('.line:last-child').remove();
                    }
                    $('.line:last-child .three:last-child').remove();
                }
                console.log($(".line .three"))

//                if($)
            }
            else
            {
                if( that.config.onError ) that.config.onError( that.form, data.message );
            }
        });
    };

    that.__construct(config);

};