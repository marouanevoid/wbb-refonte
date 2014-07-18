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
            var placeholder = 'Type a tip ...',
                textarea = $("form#tips textarea").val();
            if(textarea.indexOf(placeholder)>-1 || textarea.length == 0 || textarea == ""){

                $("form#tips textarea").addClass('error');
                return false;
            }else{
                $("form#tips textarea").removeClass('error');
            }

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
        /*console.log(data[0].value.replace(/^\s+|\s+$/g,''));*/
        var url = that.form.attr('action');
        var nbItems = 0;

        if(data[0].value.replace(/^\s+|\s+$/g,'')=="")
        {
            $("form#tips textarea").val('');
            that.form.find(".count").text("250 left");
            $("form#tips textarea").focus();
        }else
        {
            $.post( url, data, function(data)
            {
                if(data.code == 200)
                {
                    if( that.config.onComplete )
                        that.config.onComplete( that.form, data );
                    if($('.line:last-child .three').length==0)
                        $('.line:last-child').remove();
                    nbItems = $('.insider-tips .three').length;
                    
                    if(ismobile==1)
                    {
                        $('.line.wbbtips').prepend(data.tip);
                        if(nbItems>=4)
                        {
                            $('.line:last-child .three:last-child').remove();
                            $(".load-more").show();
                            $(".load-more").parent().show();
                        }
                    }else
                    {
                        if(nbItems==0)
                        {
                            $('.line.wbbtips .six').removeClass('six').addClass('three').after(data.tip);
                        }else
                        {
                            $('.line.wbbtips .three:first-child').after(data.tip);
                        }
                        if(nbItems>=4)
                        {
                            $('.line:last-child .three:last-child').remove();
                            $(".load-more").show();
                            $(".load-more").parent().show();
                        }
                    }


                }
                else
                {
                    if( that.config.onError ) that.config.onError( that.form, data.message );
                }
            });
        }
    };

    that.__construct(config);

};