/**
 * Radio
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
meta.Radio = function(config){

    var that = this;

    /* Contructor. */

    /**
     *
     */
    that.__construct =  function(config)
    {
        that.config = $.extend(that.config, config);
        that._prepareComponent();
        that._setupEvents();
    };

    /* Public */

//drop-dark

    that.config = {
        $radios   : false,
        color     : false,
        template  : '<a class="ui-radio btn-radius border %color% %class%"></a>'
    };


    /* Private. */

    /**
     *
     */
    that._setupEvents = function() {

        that.config.$radios.click(function(e)
        {
            e.preventDefault();

            // if is desibled
            if($(this).hasClass('disabled-search')){
                return false;
            }

            /*
            *    if is not the radio of the barfined Mood
            */
            if (!$(this).find('input').data("value")){
                that.config.$radios.filter('.active').find('input').prop('checked', false);
                that.config.$radios.removeClass('active');

                $(this).addClass('active');
                $(this).find('input').prop('checked', true).trigger("change");
            }else{

               /*
               * Radio UI select/unselect 
               **/
                var $t = $(this);
                if($t.hasClass('active')){
                    $t.removeClass('active');
                    $(this).find('input').prop('checked', false).trigger("change");
                }else{
                    $t.addClass('active');
                    $(this).find('input').prop('checked', true).trigger("change");
                }
            }
        })
    };


    /**
     *
     */
    that._prepareComponent = function() {

        that.config.$radios.each(function()
        {
            var html = that.config.template.replace('%color%', that.config.color);
            html = html.replace('%class%', $(this).data('type')+' '+$(this).val()+' radio-'+($(this).hasClass('dark')?'dark':'light')+($(this).hasClass('with-icon')?' with-icon':''));
           
           var label;

           if ($(this).data("value"))
                label = $(this).data("value") ? $(this).data("value") : $(this).val().replace(/_/g,' ');
           else 
                label =  $(this).data('label') ? $(this).data('label') : $(this).val().replace(/_/g,' ');

            html = html.replace('%name%', label);
            var $component = $(html);
            /*
            *    if is not the radio of the barfined Mood
            */
            //if (!$(this).data("value")){
            if( $(this).is(':checked') ) $component.addClass('active');
            //}

            $(this).wrap( $component );
            $(this).after('<span>'+label+'</span>');
        });

        that.config.$radios = that.config.$radios.parent();

    };


    that.__construct(config);

};



var radios = [];

function initializeRadios()
{
    $('input.ui-radio:checked').not('.ui-initialized').each(function(){

        var $radio = $(this);
        var $radios = $( 'input.ui-radio[name="'+$(this).attr('name')+'"]' );

        radios.push( new meta.Radio(
        {
            $radios    : $radios,
            color      : $radio.data('color')
        }));

        $radio.addClass('ui-initialized');
    })
}



$(document).ready(function(){

    initializeRadios();

});