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
        template  : '<a class="ui-radio btn-radius with-icon border %color% %class%" href="">%name%</a>'
    };


    /* Private. */

    /**
     *
     */
    that._setupEvents = function() {

        that.config.$radios.click(function(e)
        {
            e.preventDefault();

            that.config.$radios.removeClass('active');
            that.config.$radios.find('input').prop('checked', false);

            $(this).addClass('active');
            $(this).find('input').prop('checked', true);
        })
    };


    /**
     *
     */
    that._prepareComponent = function() {

        that.config.$radios.each(function()
        {
            var html = that.config.template.replace('%color%', that.config.color);
            html = html.replace('%class%', $(this).val()+' radio-'+($(this).hasClass('dark')?'dark':'light'));
            html = html.replace('%name%', $(this).val());

            $(this).wrap( html );
        });

        that.config.$radios = that.config.$radios.parent();

    };


    that.__construct(config);

};



var radios = [];

function initializeRadios()
{
    $('input.ui-radio.checked').not('.ui-initialized').each(function(){

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