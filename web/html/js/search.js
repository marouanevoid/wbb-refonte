
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
 * indigen namespace.
 */
var meta = meta || {};

/**
 *
 */
meta.SearchPage = function() {

    var that = this;

    that.config = {
        speed   : 500,
        easing  : 'easeInOutCubic',
        container : ''
    };

    that.context = {};


    that._setupContext = function()
    {
        that.context.$form_filter = $('form#filter');
        that.context.$form_search = $('form#search');
    };


    that._selectCities = function( id )
    {
        var $neigborhood = that.context.$form_filter.find('.neigborhood');

        //todo: construct neigborhood here then slidedown
        var html = '<li class="h4 radio-container">'+
                        '<label><input type="radio" name="neigborhoods" value="all"/><b></b>All Neigborhoods</label>'+
                        '<div class="custom-scroll">'+
                            '<ul>'+
                                '<li><label><input type="checkbox" name="neigborhood[]" value="brooklyn"/><b></b>Brooklyn</label></li>'+
                                '<li><label><input type="checkbox" name="neigborhood[]" value="brooklyn"/><b></b>Brooklyon</label></li>'+
                                '<li><label><input type="checkbox" name="neigborhood[]" value="brooklyn"/><b></b>Brooklyon</label></li>'+
                                '<li><label><input type="checkbox" name="neigborhood[]" value="brooklyn"/><b></b>Brooklyon</label></li>'+
                                '<li><label><input type="checkbox" name="neigborhood[]" value="brooklyn"/><b></b>Brooklyon</label></li>'+
                                '<li><label><input type="checkbox" name="neigborhood[]" value="brooklyn"/><b></b>Brooklyon</label></li>'+
                                '<li><label><input type="checkbox" name="neigborhood[]" value="brooklyn"/><b></b>Brooklyon</label></li>'+
                                '<li><label><input type="checkbox" name="neigborhood[]" value="brooklyn"/><b></b>Brooklyon</label></li>'+
                            '</ul>'+
                        '</div>'+
                    '</li>';

        $neigborhood.find('ul').html(html);

        $neigborhood.find('.custom-scroll').each(function()
        {
            $(this).jScrollPane({autoReinitialise: true, hideFocus:true});
        });

        $neigborhood.slideDown();
    };


    that._filterResults = function()
    {
        var data = that.context.$form_filter.serializeArray();
        //todo: filter result using data
    };


    that._setupEvents = function()
    {
        that.context.$form_filter.submit(function(e)
        {
            e.preventDefault();
            that._filterResults();
        });

        that.context.$form_filter.find('.drop-btn a').click(function()
        {
            if( $(this).hasClass('plus') )
            {
                $(this).addClass('minus').removeClass('plus').parent().next('.drop-list').slideDown(that.config.speed);
                that.context.$form_filter.find('.reset input[type="reset"]').show();
            }
            else
            {
                $(this).addClass('plus').removeClass('minus').parent().next('.drop-list').slideUp(that.config.speed);
            }
        });


        that.context.$form_search.find('input[type=text]').on('keyup', function()
        {
            if( $(this).val().length > 0 ) $(this).next().next().show();
            else $(this).next().next().hide();
        });


        that.context.$form_search.find('input[type=reset]').click(function()
        {
            $(this).hide();
        });


        that.context.$form_filter.find('input[type=reset]').click(function()
        {
            $(this).hide();
            that.context.$form_filter.find('.drop-btn a.minus').click();

            setTimeout(function()
            {
                that.context.$form_filter.find('.neigborhood > ul').empty();
                that.context.$form_filter.find('.neigborhood').hide();

            }, that.config.speed);
        });


        that.context.$form_filter.find('select[name=city]').change(function(){ that._selectCities( $(this).val() ) });

        that._radioEvents();
        that._checkboxEvents();
    };


    that._radioEvents = function()
    {
        that.context.$form_filter.on('change', 'input[type=radio]', function()
        {
            var $others = $(this).closest('form').find('input[name='+$(this).attr('name')+']');
            $others.parent().next().find('input[type=checkbox]').prop('checked', false);
        });
    };


    that._checkboxEvents = function()
    {
        that.context.$form_filter.on('change', 'input[type=checkbox]', function()
        {
            var $radio_container =  $(this).closest('.radio-container');
            var $radio =  $radio_container.find('input[type=radio]');
            $radio.prop('checked', true);

            var $others = $radio.closest('form').find('input[name='+$radio.attr('name')+']');
            $others.not($radio).closest('.radio-container').find('input[type=checkbox]').prop('checked', false);
        });
    };

    /**
     *
     */
    that.__construct = function()
    {
        that._setupContext();
        that._setupEvents();
    };

    that.__construct();
};


$(document).ready(function()
{
    if( !$('form#filter').length ) return;

    new meta.SearchPage();
});

