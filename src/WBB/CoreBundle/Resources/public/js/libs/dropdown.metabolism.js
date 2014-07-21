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
                            '<span class="selected">%name%</span>'+
                            '<div class="slide">'+
                                '<div class="choice custom-scroll">'+
                                    '<ul>%options%</ul>'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                        '<div class="ui-dropdown-placeholder"></div>'+
                    '</div>'
    };

    that.active = false;
    that.currentScroll = 0;

    /* Private. */

    /**
     *
     */
    that._setupEvents = function() {

        var $dropdown = that.config.$dropdown_replacement;

        if( !$('html').hasClass('mobile') )
        {
            that.config.$dropdown_value.click(function() {

                if( !$dropdown.hasClass("dropdown-open") ){

                    that.currentScroll = $(window).scrollTop();
                    that.config.$dropdown_placeholder.css({width:$dropdown.width(), height:$dropdown.height()});

                    $dropdown.find('.custom-scroll').show();
                    $dropdown.addClass('dropdown-open').find('.slide').velocity('slideDown', {speed:that.config.speed, easing:that.config.easing, complete: function()
                    {
                        that.active = true;
                    }});
                }
            });

            $dropdown.find('.choice li').click(function(){

                that.config.$dropdown_value.text( $(this).text() );

                var $options = that.config.$dropdown.find('option');

                $options.removeAttr('selected');

                var index = $(this).index();
                if( $options.filter(':disabled').length ) index++;

                $options.eq( index ).prop('selected', true);

                $dropdown.find('.choice li').show();
                $(this).hide();
                
                //$options.eq( index ).attr('selected', 'selected');

                that.config.$dropdown.trigger('change');

                $(document).click();
            });

            $(document).click(function(e)
            {
                if( (!$(e.target).closest('.ui-dropdown').length || $(e.target).hasClass('selected')) && that.active )
                {
                    that.active = false;
                    $dropdown.find('.custom-scroll').hide();
                    $dropdown.find('.slide').velocity('slideUp', {speed:that.config.speed, easing:that.config.easing, complete:function(){
                        $dropdown.removeClass('dropdown-open');
                    }});
                }
            });

            if( $('html').hasClass('ie9') )
            {
                $(window).scroll(function()
                {
                    that._lockscroll();
                });
            }

            $dropdown.find('select').on('change', function()
            {
                that.config.$dropdown_value.text( $(this).find('option:selected').text() );
            });
        }
        else
        {
            $dropdown.find('select').on('change', function()
            {
                //$dropdown.css({width : $dropdown.width()});
                that.config.$dropdown_value.text( $(this).find('option:selected').text() );
            });
        }
    };


    that._lockscroll = function(){

        if( that.active) $('html,body').scrollTop(that.currentScroll);
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
                html += "<li class='"+$(this).val()+"' "+($(this).index()==0?'style="display:none"':'')+">"+$(this).text()+"</li>"
        });

        html = that.config.template.replace('%options%', html);
        html = html.replace('%name%', $options.first().text());
        html = html.replace('%color%', 'drop-'+that.config.color+' '+that.config.$dropdown.data('class'));

        that.config.$dropdown_replacement = $(html);
        that.config.$dropdown.after(that.config.$dropdown_replacement);

        that.config.$dropdown_placeholder   = that.config.$dropdown_replacement.find('.ui-dropdown-placeholder');
        that.config.$dropdown_value         = that.config.$dropdown_replacement.find('span');

        that.config.$dropdown_replacement.append(that.config.$dropdown);

        if( !$('html').hasClass('mobile') )
        {
            var drop_width = that.config.$dropdown_replacement.width()+60;
            that.config.$dropdown_replacement.css({width:Math.max(200, drop_width)});
        }
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