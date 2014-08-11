
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
    var currentFilter = "Bar",
        formatedUrl = "",
        compteurNews = 0,
        start = 0 , 
        lastConsultedURL  = "",
        compteurBars = 0,
        currentFilterLoaded = "";
        currentQuery = "",
        currentTabActive = "Bar";
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

    /*
    * The HTML template of tow display ( list and row of results)
    ***/
    that.template = {
        barWithPicture : function(filter,isfavorite , fav_url , url_link){
                                var htmlT = (!ismobile ? '<div class="three columns m-margin-top">' : '') + '<article class="bar-w-pic" data-type="%type">';
                                if(filter != 'News'){ 
                                    htmlT += '<a href="'+ fav_url +'" class="btn-round dark star'+ (isfavorite ? ' active ' : '') +'"></a>' ;
                                }
                                htmlT +='<div class="txt">' ;
                                    htmlT +='    <h2>%title</h2>' ;
                                if(filter != 'News'){
                                    htmlT +='    <h3>%city, %country</h3>';
                                }

                                if(filter != 'News'){
                                    htmlT +='    <div class="hover">' ;
                                    htmlT +='        <div class="tags %tag-non-founed">%tags</div>';
                                    htmlT +='    </div>' ;
                                }

                                htmlT +='</div>' ;
                                htmlT +='<a href="' + url_link + '" class="overlay-link"></a>' ;
                                htmlT +='<div class="color gradient"></div>' ;
                                htmlT +='<div class="color gray"></div>' ;
                                htmlT +='<img src="%img" class="image-search-item scale-with-grid" data-src="%img" alt="%title" width="570" height="428"/>';
                                htmlT +='</article>' + (!ismobile ? '</div>' : '');

                                return htmlT;


        },
        barWithPictureList : function(filter,isfavorite , fav_url , url_link){
                            var htmlT = '<article class="bar-w-pic-list" data-type="%type">';
                            htmlT += '<div class="three columns s-margin-top">';

                            htmlT += '    <div class="bar-w-pic list">';
                            if(filter != 'News') 
                                htmlT += '<a href="'+ fav_url +'" class="btn-round dark star'+ (isfavorite ? ' active ' : '') +'"></a>' ;

                            htmlT +='        <a href="' + url_link + '" class="overlay-link"></a>';

                            htmlT += '        <img class="scale-with-grid image-search-item" src="%img" alt="%title" width="570" height="428"/>' ;
                            htmlT += '    </div>' ;
                            htmlT += '</div>';
                            htmlT += ' <div class="nine columns s-margin-top">';
                            htmlT += '    <h2 class="s-margin-top"><a href="bar-details.php">%title</a></h2>';
                            htmlT +='    <h3 class="xs-margin-top"><a href="bar-details.php">%city, %country</a></h3>' ; 
                            htmlT +='    <p class="s-margin-top">';
                            htmlT += '        %description' ;

                            htmlT +='    </p>';
                            if(filter != 'News') 
                                htmlT +='    <div class="tags %tag-non-founed">%tags</div>';
                            htmlT +=' </div>';
                            htmlT +='  <div class="separator"><hr/></div>'; 
                            htmlT +='</article>';

                            return htmlT;
                    }
    }

    /*
    * Clear the content 
    **/
    that.clearContent = function(){
        $('.bars-w-pic-list .dist-target').empty();
        $('.bars-w-pic-list .dist-target').html('');
        $('.details-barlist .dist-target').empty();
        $('.details-barlist .dist-target').html('');
    }

    /*
    * Utils
    **/
    that.shortName = function(str , leng , strconcat){
        var length = str.length;
        return str.substr(0,leng) + (length > leng ? ( strconcat ? strconcat : '...'  ) : '');
    }
    /*
    * Generate the Html list by response
    **/
    that.generateListByResults = function(res , callbackHandler , notreset){
        

        var heighlightFunction = function(){
            // test if there is News and Bars 
            var newsLength = Number(res.hits.news),
                BarsLength = Number(res.hits.bars);

            // if there is News on The Results

            var replaceIntger = function(number , cible){
                var str = cible.html();
                    arr = str.split(')'),
                    strl = arr[0].substr(1);

                cible.html(str.replace(strl , number));
            }
            var ccibleNews = $('.screen-compteur a[data-index=1]'),
                ccibleBars = $('.screen-compteur a[data-index=0]');

            if(newsLength > 0){
                that.desibledBtn( ccibleNews, true );
                replaceIntger( newsLength ,ccibleNews);
                // Set Compteur News
            }else{
                that.desibledBtn(ccibleNews , false);
                replaceIntger( 0 ,ccibleNews);
            }

            // if there is Bars on the Results
            if(BarsLength > 0){
                that.desibledBtn(ccibleBars , true );
                replaceIntger( BarsLength ,ccibleBars);
            }else{
                that.desibledBtn(ccibleBars , false);
                replaceIntger( 0 ,ccibleBars);
            }
        }

        if(res.hits && res.hits.hit && res.hits.hit.length > 0){
            var htmlBar = "",
                htmlBarList = "",
                htmlBarList = "";
            $.each(res.hits.hit , function(index , curor){
                var type = "";
                var isFaved = ( curor.fields.favorite ? curor.fields.favorite  : false );
                var favUrl = (curor.fields.favorite_url ? curor.fields.favorite_url : '#' );
                var url_link = (curor.fields.url ? ( URL_MODE +  curor.fields.url )  : '#');
                var chtml = that.template.barWithPicture(currentFilter,isFaved, favUrl , url_link).replace('%type' , type);
                var chtml2 = that.template.barWithPictureList(currentFilter,isFaved , favUrl , url_link).replace('%type' , type);

                // Update Labels of Bar and News
                if(curor.id.indexOf('News')>-1){
                    compteurNews++;
                    type = 'News';
                }
                else{
                    if(curor.id.indexOf('Bar')>-1){
                      compteurBars++;
                      type = 'Bar';
                    }
                }

                //if(type == 'Bar'){
                    var nameString = curor.fields.name;

                    chtml = chtml.replace(new RegExp('%title','ig') , that.shortName(nameString , ( currentFilter == 'News' ? 50 : 25 ) )  );
                    chtml2 = chtml2.replace(new RegExp('%title','ig') , nameString);
                    chtml = chtml.replace('%city' , curor.fields.city);
                    chtml2 = chtml2.replace('%city' , curor.fields.city);
                    chtml = chtml.replace('%country' , curor.fields.country);
                    chtml2 = chtml2.replace('%country' , curor.fields.country);

                    // if there is tags
                    if(curor.fields.tags_style && curor.fields.tags_style.length){
                        // make tags url
                        // var stringtag = "";
                        // for(var i=0,ln = curor.fields.tags_style.length ; i<ln ; i++ ){
                        //    stringtag = "<a href='?tag=" + curor.fields.tags_style[i] + "'>"+ curor.fields.tags_style[i]  + "</a>, " 
                        // }
                        // chtml = chtml.replace('%tags' , stringtag.substr(0, stringtag.length-2) );
                        // chtml2 = chtml2.replace('%tags' , stringtag.substr(0, stringtag.length-2)  );
                        chtml = chtml.replace('%tags' , curor.fields.tags_style.join(', '));
                        chtml2 = chtml2.replace('%tags' , curor.fields.tags_style.join(', '));

                        chtml = chtml.replace('%tags-non-founed' , "");
                        chtml2 = chtml2.replace('%tags-non-founed' , "");
                    }else{
                        chtml = chtml.replace('%tags' , "");
                        chtml = chtml.replace('%tag-non-founed' , "display-none");
                        chtml2 = chtml2.replace('%tags' , "");
                        chtml2 = chtml2.replace('%tag-non-founed' , "display-none");

                    }
                    if(curor.fields.wbb_media_url){
                        chtml = chtml.replace('%img' , curor.fields.wbb_media_url );
                        chtml2 = chtml2.replace('%img' ,curor.fields.wbb_media_url);
                    }else{
                        chtml = chtml.replace('%img' , defaultImg );
                        chtml2 = chtml2.replace('%img' , defaultImg );
                    }
                    if(curor.fields.slug){
                        chtml = chtml.replace(new RegExp('%link','ig') , curor.fields.slug);
                        chtml2 = chtml2.replace(new RegExp('%link','ig') , curor.fields.slug);
                    }
                    if(curor.fields.seo_description){
                        chtml = chtml.replace('%description' , curor.fields.seo_description)
                        chtml2 = chtml2.replace('%description' , curor.fields.seo_description)
                    }else{
                        chtml = chtml.replace('%description' , "")
                        chtml2 = chtml2.replace('%description' , "")
                    }

                //}

                htmlBar+=chtml;
                htmlBarList+=chtml2;


            });
            // set The Label

            // Append The HTML to Dom

            $('.bars-w-pic-list .dist-target').append(htmlBarList );
            $('.details-barlist .dist-target').append( htmlBar);

            // if the image is not loaded then 
            // Load the default Image
            $('.image-search-item').error(function(){
                //$(this).attr('src' , defaultImg);
            });

            if(callbackHandler)
                callbackHandler();

           // that._animate($('.load-target'),$("article.bar-w-pic"));
           //$('.dist-target .line').find('> *').not('br').css({opacity:0, top:'6em', position:'relative'});

           setTimeout(function(){
              // that._animate($(".load-target"), $(".load-target").find('> *').not('br'));
               //that._animate($(".load-target"), $('.dist-target .line').find('> *').not('br'));
           },10);


            // disabled buttons compteurs
            var cursorIndex = 0;
            if(currentFilter == 'News'){
                cursorIndex = 1;
            }else{
                cursorIndex = 0 ;
            }

        }else{
            // TODO : No results then show label no resluts
            // there is no more to loaded
            // hide buttons Load More
            $('.load-more-bars-btn').hide();
            $('.load-more-news-btn').hide();
            $('.bars-w-pic-list .dist-target').empty();
            $('.details-barlist .dist-target').empty();
            $('.details-barlist .dist-target').html('');
            $('.bars-w-pic-list .dist-target').html('');
            $('.bars-w-pic-list .dist-target').append("<p>There are no results matching your request.</p>");
            $('.details-barlist .dist-target').append("<p>There are no results matching your request.</p>");
            
        }


        heighlightFunction();

        setTimeout(function(){

            if(res.hits && res.hits.found ){
                var totalExist = res.hits.found;
                var totalLoaded = $('.display-bar-width-list-parent .bar-w-pic').length;
                if(totalLoaded < totalExist){
                    // Set Text 

                    $('.loadmore-trigger').each(function(){
                        $(this).text($(this).attr('data-text'));
                    });
                    // Set The start
                    start = totalLoaded ; 
                    if(currentFilter == 'Bar'){
                        $('.load-more-bars-btn').show();
                        $('.load-more-news-btn').hide();
                    }
                    else{
                        $('.load-more-bars-btn').hide();
                        $('.load-more-news-btn').show();
                    }
                }else{
                    // there is no more to loaded
                    // hide buttons Load More
                    $('.load-more-bars-btn').hide();
                    $('.load-more-news-btn').hide();
                }
                
            }
        },100);
    }


    /*
    ** Send the Request To the Server 
    ***/
    that.getSearchResult = function(q , callbackHandler ){
        
        // test if Result is aleady Loaded
        // By Filter
        // if(currentFilterLoaded == currentFilter){
        //     return false;
        // }

        $('.loader-search-page').show();
        // Hide the button load More on strat generating 
        $('.load-more-bars-btn').hide();
        $('.load-more-news-btn').hide();

        var limit = ((ismobile || $('.ipad').length > 0) ? 3 : 12 ),
        lastConsultedURL = '/app_dev.php/search?entity=' + currentFilter +'&' + q + (formatedUrl != '' ? ('&' + formatedUrl) : '')  + ( '&limit=' + limit) + ('&start=' + start) ;


        $.get(lastConsultedURL, function(response){
            //// ///////
            $('.loader-search-page').hide();
            ////// /////
            that.generateListByResults(response , callbackHandler);
        });

        currentFilterLoaded = currentFilter;
    }

    /*
    * Generate neiborhod List 
    On city Selected
    **/
    that._selectCities = function( slug )
    {
        if(!slug || slug == "" || slug.length == 1)
        {
            return false;
        }
        var $neigborhood = that.context.$form_filter.find('.neigborhood');

        // Load Ajax
        $.get(Routing.generate('wbb_city_suburbs' , {citySlug : slug}), function(res){
            //todo: construct neigborhood here then slidedown
            var html = '<li class="h4 radio-container">'+
                            '<label><input type="radio" name="neigborhoods" value="all"/><b></b>All Neigborhoods</label>'+
                            '<div '+($(window).width()>640?'class="custom-scroll"':'')+'>'+
                                '<ul class="checkbox-container">';

                                var liSubrb = "";
                                $.each(res.suburbs , function(index , cursor){
                                    liSubrb+= '<li><label><input type="checkbox" name="district[]" value="' + cursor.slug+ '"/><b></b>' + cursor.name+ '</label></li>';
                                });

                                html+=liSubrb;

                                html += '</ul>'+
                                '<br class="clear"/>'+
                            '</div>'+
                        '</li>';

            $neigborhood.find('ul').html(html);

            $neigborhood.find('.custom-scroll').each(function()
            {
                $(this).jScrollPane({autoReinitialise: true, hideFocus:true});
            });

            $neigborhood.slideDown();
            that.setUpEventFilterAjax()
        });
    };

    /*
    * GoSearch 
    *Trigger the research
    ***/

    that.goSearch = function(q){
        that.getSearchResult(q ? q : ( 'q='+ currentQuery ) , function(){
            $('.sort-by').find('.active').click();
        });
        return false;
    }

    /*
    * Desibled prop
    ***/
    that.desibledBtn = function(cible ,status){
        if(!status){
            cible.addClass('disabled-search');
            cible.attr('disabled' , 'disabled');
        }else{
            cible.removeClass('disabled-search');
            cible.removeAttr();
        }

    }
    /*
    * Get the current Tab Active
    ***/
    that.getCurrentTabActive = function(){
       currentFilter =  ( $('.screen-compteur .active').attr('data-index') == 0 ? 'Bar' : 'News' ) ;
    }
    /*
    * generate the URL on checkbox filters Selected 
    */
    
    that._filterResults = function()
    {
        var data = that.context.$form_filter.serializeArray(),
            checkedBox = that.context.$form_filter.find('input[type=checkbox]:checked');
        //todo: filter result using data

        var arrayFilter  = [];
        checkedBox.each(function(){
            var cible = $(this);
            if(! arrayFilter[cible.attr('name')]){
                arrayFilter[cible.attr('name')] = [];
                arrayFilter[cible.attr('name')].push(cible.val());
            }else{
                arrayFilter[cible.attr('name')].push(cible.val());
            }

        });

        formatedUrl = "";
         start = 0;
        // Generate the url of query
        for( k in arrayFilter ){
            formatedUrl += (k.substr(0,k.length-2)) + '=' + arrayFilter[k].join(',') + '&';
        }

        // delete the@ on the end of string url
        formatedUrl = formatedUrl.substr(0,formatedUrl.length-1);
        // Send The Request To Ajax

        compteurBars = 0;
        compteurNews = 0;

        if( ! ismobile){
            that.getCurrentTabActive();
            that.clearContent();
            that.goSearch();
        }
    };


    that._setupEvents = function()
    {
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
            that.context.$form_search.find('#city_search').val('');
            $(this).hide();
            // Reset the current Query
            currentQuery = "";
            return false;
        });


        that.context.$form_filter.find('input[type=reset]').click(function()
        {
            $(this).hide();
            // Empty the url format
            formatedUrl = "";
            start = 0;
            that.context.$form_filter.find('.drop-btn a.minus').click();

            // hide the select
            $('.city-drop-down').parent('.ui-dropdown-container').find('.selected').text('Choose a City');
            $('.city-drop-down').val('');
            setTimeout(function()
            {
                that.context.$form_filter.find('.neigborhood > ul').empty();
                that.context.$form_filter.find('.neigborhood').hide();

            }, that.config.speed);
        });


        that.context.$form_filter.find('select[name=city]').change(function(){ that._selectCities( $(this).val() ) });

        that._radioEvents();
        that._checkboxEvents();

        /*
        * Click on the Filter Handler ( Articles - Bars)
        **/

        $('.screen-compteur').find('a').click(function(){

            // if the is btn is desibled or the filter is already loaded then 
            // Return False
            var ccible = $($(this).find('input[type=radio]')[0]).attr('data-type');

            if($(this).hasClass('disabled-search') || ccible == currentFilterLoaded){
                return false;
            }
            // Rest the start Index to 0 
            start = 0
            var dataindex = $(this).attr('data-index');

            that.clearContent();
            
            if(dataindex == 0){
                currentFilter  = "Bar";
                //$('.load-more-bars-btn').show();
                //$('.load-more-news-btn').hide();
            }
            else{
                currentFilter = "News";
            }

            // hide the Load More Buttons
            // and waiting for Answer
            $('.load-more-bars-btn').hide();
            $('.load-more-news-btn').hide();

            // Start Search
            that.goSearch();

            // save the curren Filter to cancel the 
            // Re-search if is already Loaded
            currentFilterLoaded = currentFilter ;
            return false;
        });
        
        // Append the Ajax Event
        that.setUpEventFilterAjax();

        // Add Event On buttoms
        $('.sort-by a.grid').attr('data-index' , 0);
        $('.sort-by a.list').attr('data-index' , 1);
        $('.sort-by a.grid').add('.sort-by a.list').on('click' , function(){
            var cindex = $(this).attr('data-index');
            if($(this).hasClass('grid')){
                $('.display-bar-width-picture-parent').show();
                $('.display-bar-width-list-parent').hide();
            }else{
                if($(this).hasClass('list')){
                    $('.display-bar-width-picture-parent').hide();
                    $('.display-bar-width-list-parent').show();
                }
            }
        });

        // click on load More button
        $('.loadmore-trigger').on('click' ,function(e){
            e.preventDefault();
            $(this).text(TRAD.common.loading);
            that.goSearch();
            return false;
        });

        // add the listener on form 
        $('#search').on('submit' , function(){
            var querry = $(this).find('input[type=text]').val();
            if( querry !=''){
                that.clearContent();
                currentQuery = querry;
                that.goSearch('q=' + currentQuery);
            }
            return false;
        });

        // click on Applay Filter
        $('#applay-filter').on('click' , function(){
            that.clearContent();
            that.goSearch();

            // hide form on the Mobile
             that.context.$form_filter.find('input[type=reset]').click();
            return false;
        });

        // Add Event on submit 
        that.context.$form_filter.on('submit' , function(){
            that.clearContent();
            that.goSearch();

            // hide form on the Mobile
             that.context.$form_filter.find('input[type=reset]').click();
            return false;
        });

    };

    /*
    *  Add the Event Handler to Load Ajax
    * On Each filter Change
    */
    that.setUpEventFilterAjax = function(){
        var handler = function(e){
                // Set the default the flag of already Loaded
                currentFilterLoaded = "";
                that._filterResults();

        }
        //$('.checkbox-container').find('label').off('click',handler).on('click' , handler);
        that.context.$form_filter.find('input[type=checkbox]').off('change').on('change' , handler);

    }

    that._animate = function($target, $elements, callback ){

        var target_height = $target.show().height();

        $elements.css({opacity:0, top:'6em', position:'relative'}).each(function(index){

            $(this).delay(100*(index+1)).velocity({opacity:1, top:0}, that.config.speed, that.config.easing);
        });

        setTimeout(function()
        {
            if(callback) callback();

        }, 100*$elements.length+that.config.speed );
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


        $($('.screen-compteur').find('a')[0]).attr('data-index' , 0);
        $($('.screen-compteur').find('a')[1]).attr('data-index' , 1);



        // check if tab already actived
        that.getCurrentTabActive();

        // if the query is existed on the url then start search with given query
        if(queryestQ && queryestQ != "undefined"){
            that.goSearch('q=' + (queryestQ == '' ? '*' : queryestQ ));
            currentQuery = (queryestQ == '' ? '*' : queryestQ ) ;
        }else{
            // if the Tag is exist then get bar by Tag
            if(queryestTag && queryestTag != "undefined")
            {
                that.goSearch('tag=' + queryestTag);
            }
        }


        

        // add the callps class
        $('.screen-compteur .ui-radio').addClass('collapsed');



        // hide the button load More on Init
        $('.load-more-bars-btn').hide();
        $('.load-more-news-btn').hide();

        // dispatch click on the city select 
        that.context.$form_filter.find('select[name=city]').change();

        // setup default value of select city
        $('.city-drop-down').parent('.ui-dropdown-container').find('.selected').text('Choose a City');
        $('.city-drop-down').val('');

        that.context.$form_filter.find('.neigborhood > ul').empty();
        that.context.$form_filter.find('.neigborhood').hide();

        // uncheck all CheakBox
        that.context.$form_filter.find('input[type=checkbox]').prop('checked', false);

    };

    that.__construct();
};


$(document).ready(function()
{
    if( !$('form#filter').length ) return;
    new meta.SearchPage();


});

