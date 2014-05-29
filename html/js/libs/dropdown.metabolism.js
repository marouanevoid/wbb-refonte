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
meta.Dropdown = function(config){

    var that = this;

    /* Contructor. */

    /**
     *
     */
    that.__construct =  function(config)
    {
        that.config = $.extend(that.config, config);
        that._prepareComponent();

        if( !$('html').hasClass('mobile') )
            that._setupEvents();
    };

    /* Public */

//drop-dark

    that.config = {
        speed     : 500,
        easing    : 'easeInOutCubic',
        $dropdown : false,
        color     : false,
        template  : '<div class="ui-dropdown-container">'+
                        '<div class="btn-radius border ui-dropdown %color%">'+
                            '<span>%name%</span>'+
                            '<div class="choice">'+
                                '<ul>%options%</ul>'+
                            '</div>'+
                        '</div>'+
                        '<div class="ui-dropdown-placeholder"></div>'+
                    '</div>'
    };


    /* Private. */

    /**
     *
     */
    that._setupEvents = function() {

        var $dropdown = that.config.$dropdown_replacement;

        that.config.$dropdown_value.click(function() {

            if( $dropdown.hasClass("dropdown-open") ){

                $dropdown.find('.choice').velocity('slideUp',{ speed: that.config.speed, easing:that.config.easing, complete:function(){
                    $dropdown.removeClass('dropdown-open')
                }});
            }
            else{
                that.config.$dropdown_placeholder.css({width:$dropdown.width(), height:$dropdown.height()});
                $dropdown.css({width:$dropdown.width()});
                $dropdown.addClass('dropdown-open').find('.choice').velocity('slideDown',{ speed: that.config.speed, easing:that.config.easing});
            }
        });

        $dropdown.find('.choice li').click(function(){

            that.config.$dropdown_value.text( $(this).text() );
            that.config.$dropdown_value.click();

            var $options = that.config.$dropdown.find('option');
            $options.removeAttr('selected');
            $options.eq( $(this).index() ).attr('selected', 'selected');
        })
    };


    /**
     *
     */
    that._prepareComponent = function() {

        var html     = "";
        var $options = that.config.$dropdown.find('option');

        $options.each(function()
        {
            if( !$(this).attr('disabled') )
                html += "<li>"+$(this).val()+"</li>"
        });

        html = that.config.template.replace('%options%', html);
        html = html.replace('%name%', $options.first().val());
        html = html.replace('%color%', 'drop-'+that.config.color);

        that.config.$dropdown_replacement = $(html);
        that.config.$dropdown.after(that.config.$dropdown_replacement);

        that.config.$dropdown_placeholder   = that.config.$dropdown_replacement.find('.ui-dropdown-placeholder');
        that.config.$dropdown_value         = that.config.$dropdown_replacement.find('span');

        that.config.$dropdown_replacement.append(that.config.$dropdown);

    };


    that.__construct(config);

};



var dropdowns = [];

function initializeDropdowns()
{
    $('select.ui-dropdown').not('.ui-initialized').each(function(){

        var $dropdown = $(this);

        dropdowns.push( new meta.Dropdown(
        {
            $dropdown  : $dropdown,
            color      : $dropdown.hasClass('dark')?'dark':'light'
        }));

        $dropdown.addClass('ui-initialized');
    })
}



$(document).ready(function(){

    initializeDropdowns();

});