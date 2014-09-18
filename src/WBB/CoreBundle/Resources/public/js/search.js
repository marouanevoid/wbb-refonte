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
var globalAjaxCode;
/**
 *
 */
meta.SearchPage = function() {

    var that = this;
    var currentFilter = "Bar",
        formatedUrl = "",
        formatedCity = "";
    compteurNews = 0,
        start = 0,
        lastConsultedURL = "",
        compteurBars = 0,
        currentFilterLoaded = "";
    currentQuery = "",
        from_loadMore = false,
        currentTabActive = "Bar",
        totalLoadedImage = 0;
    that.config = {
        speed: 500,
        easing: 'easeInOutCubic',
        container: ''
    };

    that.context = {};


    that._setupContext = function() {
        that.context.$form_filter = $('form#filter');
        that.context.$form_search = $('form#search');
    };

    /*
     * The HTML template of tow display ( list and row of results)
     ***/
    that.template = {
        barWithPicture: function(filter, isfavorite, fav_url, url_link, favObj) {
            var htmlT = (!ismobile ? '<div class="three columns m-margin-top">' : '') + '<article class="bar-w-pic" data-type="%type">';
            if (filter != 'News') {
                htmlT += '<a data-id="' + favObj.id + '" data-type="bar" data-name="' + favObj.name + '" href="' + fav_url + '" class="btn-round dark star' + (isfavorite ? ' active ' : '') + '"></a>';
            }
            htmlT += '<div class="txt">';
            htmlT += '    <h2>%title</h2>';
            if (filter != 'News') {
                htmlT += '    <h3>%city, %country</h3>';
            }

            if (filter != 'News') {
                htmlT += '    <div class="hover">';
                htmlT += '        <div class="tags %tag-non-founed">%tags</div>';
                htmlT += '    </div>';
            }

            htmlT += '</div>';
            htmlT += '<a href="' + (getBaseURL()) + url_link + '" class="overlay-link"></a>';
            htmlT += '<div class="color gradient"></div>';
            htmlT += '<div class="color gray"></div>';
            htmlT += '<img src="" class="image-search-item scale-with-grid" data-src="%img" alt="%title"/>';
            htmlT += '</article>' + (!ismobile ? '</div>' : '');

            return htmlT;


        },
        barWithPictureList: function(filter, isfavorite, fav_url, url_link, favObj) {
            var htmlT = (!ismobile ? '<div>' : '') + '<article class="bar-w-pic-list" data-type="%type">';
            htmlT += '<div class="three columns s-margin-top">';

            htmlT += '    <div class="bar-w-pic list">';
            if (filter != 'News')
                htmlT += '<a data-id="' + favObj.id + '" data-type="bar" data-name="' + favObj.name + '" href="' + fav_url + '" class="btn-round dark star' + (isfavorite ? ' active ' : '') + '"></a>';

            htmlT += '        <a href="' + (getBaseURL()) + url_link + '" class="overlay-link"></a>';

            htmlT += '        <img class="scale-with-grid image-search-item" src="" data-src="%img" alt="%title"/>';
            htmlT += '    </div>';
            htmlT += '</div>';
            htmlT += ' <div class="nine columns s-margin-top">';
            htmlT += '    <h2 class="s-margin-top"><a href="' + (getBaseURL()) + url_link + '">%title</a></h2>';
            htmlT += '    <h3 class="xs-margin-top">%city, %country</h3>';
            htmlT += '    <p class="s-margin-top">';
            htmlT += '        %description';

            htmlT += '    </p>';
            if (filter != 'News')
                htmlT += '    <div class="tags %tag-non-founed">%tags</div>';
            htmlT += ' </div>';
            htmlT += '  <div class="separator"><hr/></div>';
            htmlT += '</article>' + (!ismobile ? '</div>' : '');

            return htmlT;
        }
    }

    /*
     * Clear the content
     **/
    that.clearContent = function() {
        $('.bars-w-pic-list .dist-target').empty();
        $('.bars-w-pic-list .dist-target').html('');
        $('.details-barlist .dist-target').empty();
        $('.details-barlist .dist-target').html('');
    }

    /*
     * Utils
     **/
    that.shortName = function(str, leng, strconcat) {
        var length = str.length;
        return str.substr(0, leng) + (length > leng ? (strconcat ? strconcat : '...') : '');
    }

    /*
     * Escaped
     **/
    that.escapit = function(str) {
            return str.replace(new RegExp('&', 'g'), '%26');
        }
        /*
        Check the active Tab
        **/
    that.checkActiveTab = function() {
        var cindex = 0;
        if (currentFilter == 'News') {
            cindex = 1;
        }
        $('.screen-compteur').find('a').removeClass('active');
        $($('.screen-compteur').find('a')[cindex]).addClass('active');
    }

    /*
     * Image Loaded
     */
    that._imageLoaded = function() {
        totalLoadedImage--;
        $(this).removeAttr('data-src');
        if (totalLoadedImage == 0) {

            $('.loader-search-page').hide();

            // Do Annimation
            that._animate($(".load-target"), $('.dist-target .line:last-child').find('> *').not('br'));

        }
    }

    /*
     * Generate the Html list by response
     **/
    that.generateListByResults = function(res, callbackHandler, notreset) {


        var heighlightFunction = function() {
            // test if there is News and Bars 
            var newsLength = Number(res.hits.news),
                BarsLength = Number(res.hits.bars);

            // if there is News on The Results

            var replaceIntger = function(number, cible, nbbar, nbnews) {
                var ccibleNew = $('.screen-compteur a[data-index=1]'),
                    ccibleBar = $('.screen-compteur a[data-index=0]');


                // var str = cible.html();
                //     arr = str.split(')'),
                //     strl = arr[0].substr(1);


                //     if(nbbar <= 1){
                //         str = str.replace('Bars' , 'Bar');
                //         str = str.replace('BARS' , 'BAR');
                //     }else{
                //         if(str.indexOf(') Bars<')<=-1 && str.indexOf(') BARS<')<=-1){
                //             str = str.replace('Bar' , 'Bars');
                //             str = str.replace('BAR' , 'BARS');
                //         }
                //     }

                // cible.html(str.replace(strl , number));


                if (nbbar <= 0) {
                    ccibleBar.find('span').text('NO BAR');
                } else {
                    if (nbbar == 1) {
                        ccibleBar.find('span').text('(1) BAR');
                    } else {
                        ccibleBar.find('span').text('(' + nbbar + ') BARS');
                    }
                }

                if (nbnews <= 0) {
                    ccibleNew.find('span').text('NO NEWS');
                } else {
                    if (nbnews == 1) {
                        ccibleNew.find('span').text('(1) NEWS');
                    } else {
                        ccibleNew.find('span').text('(' + nbnews + ') NEWS');
                    }
                }

            }


            var ccibleNews = $('.screen-compteur a[data-index=1]'),
                ccibleBars = $('.screen-compteur a[data-index=0]');

            if (newsLength > 0) {
                that.desibledBtn(ccibleNews, true);
                replaceIntger(newsLength, ccibleNews, BarsLength, newsLength);
                // Set Compteur News
            } else {
                that.desibledBtn(ccibleNews, false);
                replaceIntger(0, ccibleNews, BarsLength, newsLength);
            }

            // if there is Bars on the Results
            if (BarsLength > 0) {
                that.desibledBtn(ccibleBars, true);
                replaceIntger(BarsLength, ccibleBars, BarsLength, newsLength);
            } else {
                that.desibledBtn(ccibleBars, false);
                replaceIntger(0, ccibleBars, BarsLength, newsLength);
            }
        }

        if (res.hits && res.hits.hit && res.hits.hit.length > 0) {
            var htmlBar = "",
                htmlBarList = "",
                htmlBarList = "";
            $.each(res.hits.hit, function(index, curor) {
                var type = "";
                var isFaved = (curor.fields.favorite ? curor.fields.favorite : false);
                var favUrl = (curor.fields.favorite_url ? curor.fields.favorite_url : '#');
                var url_link = (curor.fields.url ? (URL_MODE + curor.fields.url) : '#');
                var chtml = that.template.barWithPicture(currentFilter, isFaved, favUrl, url_link, {
                    id: curor.fields.wbb_id,
                    name: curor.fields.name
                }).replace('%type', type);
                var chtml2 = that.template.barWithPictureList(currentFilter, isFaved, favUrl, url_link, {
                    id: curor.fields.wbb_id,
                    name: curor.fields.name
                }).replace('%type', type);

                // Update Labels of Bar and News
                if (curor.id.indexOf('News') > -1) {
                    compteurNews++;
                    type = 'News';
                } else {
                    if (curor.id.indexOf('Bar') > -1) {
                        compteurBars++;
                        type = 'Bar';
                    }
                }

                //if(type == 'Bar'){
                var nameString = curor.fields.name;

                chtml = chtml.replace(new RegExp('%title', 'ig'), that.shortName(nameString, (currentFilter == 'News' ? 25 : 25)));
                chtml2 = chtml2.replace(new RegExp('%title', 'ig'), that.shortName(nameString, (currentFilter == 'News' ? 35 : 35)));
                if (curor.fields.city) {
                    chtml = chtml.replace('%city', curor.fields.city);
                    chtml2 = chtml2.replace('%city', curor.fields.city);
                } else {
                    chtml = chtml.replace('%city', '');
                    chtml2 = chtml2.replace('%city', '');
                }

                if (curor.fields.country) {
                    chtml = chtml.replace('%country', curor.fields.country);
                    chtml2 = chtml2.replace('%country', curor.fields.country);
                } else {
                    chtml = chtml.replace(', %country', "");
                    chtml2 = chtml2.replace(', %country', "");
                }
                // if there is tags
                // search key start by tags_...
                // and push it to array
                var tagsLength = 0,
                    TagsArray = [];
                for (key in curor.fields) {
                    if (key.indexOf('tags_') > -1) {
                        if ($.isArray(curor.fields[key]) && curor.fields[key].length)
                            TagsArray.push(curor.fields[key]);
                    }
                }

                if (TagsArray && TagsArray.length) {
                    // make tags url
                    var stringtag = "";
                    var limitBoucle = 0;
                    for (var i = 0, ln = TagsArray.length; i < ln; i++) {
                        for (var j = 0, lin = TagsArray[i].length; j < lin; j++) {
                            if (limitBoucle >= 5) {
                                break;
                                return false;
                            }
                            limitBoucle++;
                            stringtag += "<a href='" + Routing.generate('wbb_cloudsearch_searchresults') + '?tag=' + that.escapit(TagsArray[i][j]) + "'>" + TagsArray[i][j] + "</a> , ";
                        }
                    }

                    stringtag = stringtag.substr(0, stringtag.length - 2);
                    chtml = chtml.replace('%tags', stringtag);
                    chtml2 = chtml2.replace('%tags', stringtag);

                    // chtml = chtml.replace('%tags' , curor.fields.tags_style.join(', '));
                    // chtml2 = chtml2.replace('%tags' , curor.fields.tags_style.join(', '));

                    chtml = chtml.replace('%tags-non-founed', "");
                    chtml2 = chtml2.replace('%tags-non-founed', "");
                } else {
                    chtml = chtml.replace('%tags', "");
                    chtml = chtml.replace('%tag-non-founed', "display-none");
                    chtml2 = chtml2.replace('%tags', "");
                    chtml2 = chtml2.replace('%tag-non-founed', "display-none");

                }


                if (curor.fields.wbb_media_url) {
                    chtml = chtml.replace(new RegExp('%img', 'ig'), curor.fields.wbb_media_url);
                    chtml2 = chtml2.replace(new RegExp('%img', 'ig'), curor.fields.wbb_media_url);
                } else {
                    chtml = chtml.replace(new RegExp('%img', 'ig'), defaultImg);
                    chtml2 = chtml2.replace(new RegExp('%img', 'ig'), defaultImg);
                }
                if (curor.fields.slug) {
                    chtml = chtml.replace(new RegExp('%link', 'ig'), curor.fields.slug);
                    chtml2 = chtml2.replace(new RegExp('%link', 'ig'), curor.fields.slug);
                }
                if (curor.fields.seo_description) {
                    chtml = chtml.replace('%description', curor.fields.seo_description)
                    chtml2 = chtml2.replace('%description', curor.fields.seo_description)
                } else {
                    chtml = chtml.replace('%description', "")
                    chtml2 = chtml2.replace('%description', "")
                }

                //}

                htmlBar += chtml;
                htmlBarList += chtml2;


            });
            // set The Label

            // Append The HTML to Dom

            $('.bars-w-pic-list .dist-target').append('<div class="line search-block-only">' + htmlBarList + '</div>');
            $('.details-barlist .dist-target').append('<div class="line search-block-only">' + htmlBar + '</div>');

            // if the image is not loaded then 
            // Load the default Image
            $('.image-search-item').error(function() {
                $(this).attr('src', defaultImg);
            });


            /*
             * Load Image One By One
             */
            var imageToLoad = $('.bars-w-pic-list').add('.details-barlist').find('img[data-src]');
            totalLoadedImage = imageToLoad.length;
            /*
             * Hide All item on Start
             */
            $('.dist-target .line:last-child').find('> *').not('br').css({
                opacity: 0,
                top: '6em',
                position: 'relative'
            });

            imageToLoad.each(function() {
                $(this).load(that._imageLoaded);
                $(this).error(that._imageLoaded);
                $(this).attr('src', $(this).data('src'));
            });



            if (callbackHandler)
                callbackHandler();

            //that._animate($(".load-target"), $('.dist-target .line:last-child').find('> *').not('br'));

            // disabled buttons compteurs
            var cursorIndex = 0;
            if (currentFilter == 'News') {
                cursorIndex = 1;
            } else {
                cursorIndex = 0;
            }

        } else {
            // TODO : No results then show label no resluts
            // there is no more to loaded
            // hide buttons Load More

            // hide Loader
            $('.loader-search-page').hide();

            $('.load-more-bars-btn').hide();
            $('.load-more-news-btn').hide();
            $('.bars-w-pic-list .dist-target').empty();
            $('.details-barlist .dist-target').empty();
            $('.details-barlist .dist-target').html('');
            $('.bars-w-pic-list .dist-target').html('');
            $('.bars-w-pic-list .dist-target').append("<p class='" + (ismobile ? 'text-align-center' : '') + ' no-result' + "'>There are no results matching your request.</p>");
            $('.details-barlist .dist-target').append("<p class='" + (ismobile ? 'text-align-center' : '') + ' no-result' + "'>There are no results matching your request.</p>");

            if (callbackHandler)
                callbackHandler();
        }


        heighlightFunction();

        // auto Focus on Tab
        var newsLength = Number(res.hits.news),
            BarsLength = Number(res.hits.bars);

        // if there is no Bar so focus on Artciles
        if (BarsLength == 0 && currentFilter == 'Bar') {
            if (newsLength > 0)
                $($('.screen-compteur').find('a')[1]).click();
        }

        // if we was select the article and there is no artilce but bars
        // then show bars
        if (newsLength == 0 && currentFilter == 'News') {
            if (BarsLength > 0)
                $($('.screen-compteur').find('a')[0]).click();
        }

        setTimeout(function() {

            if (res.hits && res.hits.found) {
                var totalExist = res.hits.found;
                var totalLoaded = $('.display-bar-width-list-parent .bar-w-pic').length;
                if (totalLoaded < totalExist) {
                    // Set Text 

                    $('.loadmore-trigger').each(function() {
                        $(this).text($(this).attr('data-text'));
                    });
                    // Set The start
                    start = totalLoaded;
                    if (currentFilter == 'Bar') {
                        $('.load-more-bars-btn').show();
                        $('.load-more-news-btn').hide();
                    } else {
                        $('.load-more-bars-btn').hide();
                        $('.load-more-news-btn').show();
                    }
                } else {
                    // there is no more to loaded
                    // hide buttons Load More
                    $('.load-more-bars-btn').hide();
                    $('.load-more-news-btn').hide();
                }

            }
        }, 100);
    }


    /*
     ** Send the Request To the Server
     ***/
    that.getSearchResult = function(q, callbackHandler) {

        // test if Result is aleady Loaded
        // By Filter
        // if(currentFilterLoaded == currentFilter){
        //     return false;
        // }

        $('.loader-search-page').show();
        // Hide the button load More on strat generating 
        $('.load-more-bars-btn').hide();
        $('.load-more-news-btn').hide();

        var limit;

        // test if we are comming from Load More
        // Thene set the limit by device

        if (from_loadMore) {
            if (istablet) {
                limit = 3
            } else {
                if (ismobile) {
                    limit = 6
                } else {
                    limit = 12;
                }
            }
        } else {
            // we are not comming from 
            // Load More
            limit = 12;
        }

        var ccibleURLing = (URL_MODE != '/app_dev.php' ? '' : URL_MODE);

        lastConsultedURL = getBaseURL() + ccibleURLing + '/search?entity=' + currentFilter + '&' + q + (formatedUrl != '' ? ('&' +
                formatedUrl) : '') + ('&limit=' + limit) + ('&start=' + start) +
            (formatedCity != '' ? formatedCity : '');

        // if the resquest is started
        // then abort it
        if (globalAjaxCode) {
            globalAjaxCode.abort();
        }
        // Then Load it
        globalAjaxCode = $.get(lastConsultedURL, function(response) {
            that.generateListByResults(response, callbackHandler);
        });

        currentFilterLoaded = currentFilter;
    }

    /*
    * Generate neiborhod List 
    On city Selected
    **/
    that._selectCities = function(slug) {
        if (!slug || slug == "" || slug.length == 1) {
            formatedCity = '';
            return false;
        }

        // Refrech 

        // set the City filter
        formatedCity = "&city=" + slug;
        /////
        // Send the request Serach
        that.clearContent();
        start = 0;
        that.goSearch();
        ////
        var $neigborhood = that.context.$form_filter.find('.neigborhood');

        // Load Ajax
        $.get(Routing.generate('wbb_city_suburbs', {
            citySlug: slug
        }), function(res) {
            //todo: construct neigborhood here then slidedown
            var html = '<li class="h4 radio-container">' +
                '<label><input type="checkbox" name="neigborhoods" value="all"/><b></b>All neighborhood</label>' +
                '<div ' + ($(window).width() > 640 && res.suburbs.length > 7 ? 'class="custom-scroll"' : 'class="without-scroll"') + '>' +
                '<ul class="checkbox-container">';

            var liSubrb = "";
            $.each(res.suburbs, function(index, cursor) {
                liSubrb += '<li><label><input type="checkbox" class="neigborhood-checkbox" name="district[]" value="' + that.escapit(cursor.name) + '"/><b></b>' + cursor.name + '</label></li>';
            });

            html += liSubrb;

            html += '</ul>' +
                '<br class="clear"/>' +
                '</div>' +
                '</li>';

            $neigborhood.find('ul').html(html);

            $neigborhood.find('.custom-scroll').each(function() {
                $(this).jScrollPane({
                    autoReinitialise: true,
                    hideFocus: true
                });
            });

            if (slug != '')
                $neigborhood.slideDown();
            that.setUpEventFilterAjax()
        });
    };

    /*
     * GoSearch
     *Trigger the research
     ***/

    that.goSearch = function(q) {
            that.getSearchResult(q ? q : ('q=' + currentQuery), function() {
                var _this = $('.sort-by').find('.active');
                var cindex = $(_this).attr('data-index');
                if ($(_this).hasClass('grid')) {
                    $('.display-bar-width-picture-parent').show();
                    $('.display-bar-width-list-parent').hide();
                } else {
                    if ($(_this).hasClass('list')) {
                        $('.display-bar-width-picture-parent').hide();
                        $('.display-bar-width-list-parent').show();
                    }
                }
            });
            return false;
        }
        /*
         * Toggle Show Search bar Nav
         **/

    /*
     * Desibled prop
     ***/
    that.desibledBtn = function(cible, status) {
            if (!status) {
                cible.addClass('disabled-search');
                cible.attr('disabled', 'disabled');
            } else {
                cible.removeClass('disabled-search');
                cible.removeAttr();
            }

        }
        /*
         * Get the current Tab Active
         ***/
    that.getCurrentTabActive = function() {
            currentFilter = ($('.screen-compteur .active').attr('data-index') == 0 ? 'Bar' : 'News');
        }
        /*
         * generate the URL on checkbox filters Selected
         */

    that.generateUrlFromCheckBox = function() {
        var data = that.context.$form_filter.serializeArray(),
            checkedBox = that.context.$form_filter.find('input[type=checkbox]:checked').not('input[name=neigborhoods]');

        var arrayFilter = [];
        checkedBox.each(function() {
            var cible = $(this);
            if (!arrayFilter[cible.attr('name')]) {
                arrayFilter[cible.attr('name')] = [];
                arrayFilter[cible.attr('name')].push(cible.val());
            } else {
                arrayFilter[cible.attr('name')].push(cible.val());
            }

        });

        formatedUrl = "";
        start = 0;
        // Generate the url of query
        for (k in arrayFilter) {
            formatedUrl += (k.substr(0, k.length - 2)) + '=' + arrayFilter[k].join(',') + '&';
        }

        // delete the@ on the end of string url
        formatedUrl = formatedUrl.substr(0, formatedUrl.length - 1);

    }


    that._filterResults = function() {
        that.generateUrlFromCheckBox();
        // Send The Request To Ajax
        compteurBars = 0;
        compteurNews = 0;

        if (!ismobile) {
            that.getCurrentTabActive();
            that.clearContent();
            that.goSearch();
        }
    };


    that._setupEvents = function() {
        that.context.$form_filter.find('.drop-btn a').click(function(e, groupeCheckBoxOpened) {
            if ($(this).hasClass('plus')) {
                $(this).addClass('minus').removeClass('plus').parent().next('.drop-list').stop().slideDown(that.config.speed);
                that.context.$form_filter.find('.reset input[type="reset"]').show();
                // if there is handler after open
                if (groupeCheckBoxOpened)
                    groupeCheckBoxOpened();
            } else {
                $(this).addClass('plus').removeClass('minus').parent().next('.drop-list').stop().slideUp(that.config.speed);
            }

            that.context.$form_filter.find('.custom-scroll').each(function() {
                var api = $(this).data('jsp');
                if (typeof(api) != "undefined") api.reinitialise();
            });
        });


        that.context.$form_search.find('input[type=text]').on('keyup', function() {
            if ($(this).val().length > 0) $(this).next().next().show();
            else $(this).next().next().hide();
        });


        that.context.$form_search.find('input[type=reset]').click(function() {
            that.context.$form_search.find('#city_search').val('');
            $(this).hide();
            // Reset the current Query
            // currentQuery = "*";
            // that.goSearch();
            return false;
        });


        that.context.$form_filter.find('input[type=reset]').not('.no-action-search-cancel').click(function(e, from_applay) {
            if (ismobile)
                e.preventDefault();
            // on the Mobile if there is 
            // a filter send the serrch to get
            // the result befor set
            if (!from_applay && ismobile) {
                // focus active on current Tab (bar/article)
                that.getCurrentTabActive();
                // formatedUrl = "";
                start = 0;
                // formatedCity = "";
                that.clearContent();
                that.goSearch();

            } else {
                // if is not mobile
                // and if action is not comming on dispatch
                // then start Ajax
                if (!from_applay) {
                    limit = 0;
                    formatedUrl = '';
                    start = 0;
                    formatedCity = '';
                    that.clearContent();
                    that.goSearch();
                }
            }


            $(this).hide();


            if (!ismobile) {
                // Empty the url format
                if (!from_applay || (from_applay && from_applay != 'from_constracter'))
                    formatedUrl = "";
                start = 0;
                formatedCity = "";
                that.context.$form_filter.find('.drop-btn a.minus').click();

                // hide the select
                // $('.city-drop-down').parent('.ui-dropdown-container').find('.selected').text('Choose a City');
                $("select.select2-dropdown").select2('val', '');
                $("select.select2-dropdown").select2('data', null);
                $("select.select2-dropdown").select2({
                    placeholder: 'Choose a City',
                    allowClear: true
                });

                $('.city-drop-down').val('');
                setTimeout(function() {
                    that.context.$form_filter.find('.neigborhood > ul').empty();
                    that.context.$form_filter.find('.neigborhood').hide();

                }, that.config.speed);

                // uncheck all checkbox
                // Empty the url format
                if (!from_applay || (from_applay && from_applay != 'from_constracter')) {
                    $('#filter input[type=checkbox]').prop('checked', false);
                }
            }
            if (ismobile)
                return false;

        });

        /*
        * Click on Cancel button
        To cancel all filter and to rest 
        Filters
        ***/
        that.context.$form_filter.find('.no-action-search-cancel').click(function() {
            formatedUrl = "";
            start = 0;
            formatedCity = "";
            that.context.$form_filter.find('.drop-btn a.minus').click();

            // hide the select
            $('.city-drop-down').parent('.ui-dropdown-container').find('.selected').text('Choose a City');
            // Select 2
            $("select.select2-dropdown").select2('val', '');
            $("select.select2-dropdown").select2('data', null);
            $("select.select2-dropdown").select2({
                placeholder: 'Choose a City',
                allowClear: true
            });
            $('.city-drop-down').val('');
            setTimeout(function() {
                that.context.$form_filter.find('.neigborhood > ul').empty();
                that.context.$form_filter.find('.neigborhood').hide();

            }, that.config.speed);

            // uncheck all checkbox
            $('#filter input[type=checkbox]').prop('checked', false);

            // send the request
            // Clear the content
            // send the request Search
            that.clearContent();
            that.goSearch();

        });

        that.context.$form_filter.find('select[name=city]').change(function() {
            that._selectCities($(this).val())
        });

        that._radioEvents();
        that._checkboxEvents();

        /*
         * Click on the Filter Handler ( Articles - Bars)
         **/

        $('.screen-compteur').find('a').click(function() {

            // if the is btn is desibled or the filter is already loaded then 
            // Return False
            var ccible = $($(this).find('input[type=radio]')[0]).attr('data-type');

            if ($(this).hasClass('disabled-search') || ccible == currentFilterLoaded) {
                return false;
            }
            // Rest the start Index to 0 
            start = 0
            var dataindex = $(this).attr('data-index');

            that.clearContent();

            if (dataindex == 0) {
                currentFilter = "Bar";
                //$('.load-more-bars-btn').show();
                //$('.load-more-news-btn').hide();
            } else {
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
            currentFilterLoaded = currentFilter;
            return false;
        });

        // Append the Ajax Event
        that.setUpEventFilterAjax();

        // Add Event On buttoms
        $('.sort-by a.grid').attr('data-index', 0);
        $('.sort-by a.list').attr('data-index', 1);
        $('.sort-by a.grid').add('.sort-by a.list').on('click', function() {
            var cindex = $(this).attr('data-index');
            if ($(this).hasClass('grid')) {
                $('.display-bar-width-picture-parent').show();
                $('.display-bar-width-list-parent').hide();
            } else {
                if ($(this).hasClass('list')) {
                    $('.display-bar-width-picture-parent').hide();
                    $('.display-bar-width-list-parent').show();
                }
            }

            return false;
        });

        // click on load More button
        $('.loadmore-trigger').on('click', function(e) {
            e.preventDefault();
            $(this).text(TRAD.common.loading);
            // set the Load More flag
            from_loadMore = true;
            that.goSearch();
            from_loadMore = false;
            return false;
        });

        // add the listener on form 
        $('#search').on('submit', function() {
            // rest the start
            start = 0;
            var querry = $(this).find('input[type=text]').val();
            if (querry != '') {
                that.clearContent();
                currentQuery = querry;
                that.goSearch('q=' + currentQuery);
            }
            return false;
        });

        // click on Applay Filter
        $('#applay-filter').off('click').on('click', function() {
            that.clearContent();
            that.goSearch();

            // hide form on the Mobile
            $('.bar-filter-form, .bar-filter').fadeIn(function() {
                if (ismobile)
                    $('html, body').animate({
                        scrollTop: 0
                    }, 500, 'easeInOutCubic');
            });
            // Show the serach Nav Bar
            $('.search-bar-mobile.search-area').show();
            if ($(window).width() < 640)
                $('aside.filters').hide();
            //that.context.$form_filter.find('input[type=reset]').trigger('click', ['from_applay']);
            // animate the page
            if (ismobile)
                $('html, body').animate({
                    scrollTop: 0
                }, 500, 'easeInOutCubic');
            return false;
        });

        // Add Event on submit 
        that.context.$form_filter.on('submit', function() {
            that.clearContent();
            that.goSearch();

            // // hide form on the Mobile
            //  that.context.$form_filter.find('input[type=reset]').click();
            return false;
        });

    };

    /*
     *  Add the Event Handler to Load Ajax
     * On Each filter Change
     */
    that.setUpEventFilterAjax = function() {
        var handler = function(e) {
                // Set the default the flag of already Loaded
                currentFilterLoaded = "";
                that._filterResults();
            }
            //$('.checkbox-container').find('label').off('click',handler).on('click' , handler);
        that.context.$form_filter.find('input[type=checkbox]').not('input[name=neigborhoods]').off('change').on('change', handler);

        // event of nieborhood
        $('input[name=neigborhoods]').off('change').on('change', function() {
            if ($(this).is(':checked')) {
                $('input.neigborhood-checkbox').prop('checked', true);
                $('input.neigborhood-checkbox').change();
            } else {
                $('input.neigborhood-checkbox').prop('checked', false);
                $('input.neigborhood-checkbox').change();
            }

        });

        $('input.neigborhood-checkbox').change(function() {
            var checkedlength = $('input.neigborhood-checkbox:checked').length,
                totalSelected = $('input.neigborhood-checkbox').length;
            if (totalSelected == checkedlength) {
                $('input[name=neigborhoods]').prop('checked', true);
            } else {
                $('input[name=neigborhoods]').prop('checked', false);
            }
        });

    }

    that._animate = function($target, $elements, callback) {

        var target_height = $target.show().height();

        $elements.css({
            opacity: 0,
            top: '6em',
            position: 'relative'
        }).each(function(index) {

            $(this).delay(100 * (index + 1)).velocity({
                opacity: 1,
                top: 0
            }, that.config.speed, that.config.easing);
        });

        setTimeout(function() {
            if (callback) callback();

        }, 100 * $elements.length + that.config.speed);
    };
    that._radioEvents = function() {
        that.context.$form_filter.on('change', 'input[type=radio]', function() {
            var $others = $(this).closest('form').find('input[name=' + $(this).attr('name') + ']');

            $others.parent().next().find('input[type=checkbox]').prop('checked', false);
        });
    };


    that._checkboxEvents = function() {
        that.context.$form_filter.on('change', 'input[type=checkbox]', function() {
            var $radio_container = $(this).closest('.radio-container');
            var $radio = $radio_container.find('input[type=radio]');
            $radio.prop('checked', true);

            var $others = $radio.closest('form').find('input[name=' + $radio.attr('name') + ']');
            $others.not($radio).closest('.radio-container').find('input[type=checkbox]').prop('checked', false);
        });
    };

    /*
    * Init the Query String 
    To start search with the convient Query
    */

    that.initSearchQueryMode = function() {
            // check if the checkbox is defined
            // Then send the request
            // search by query if there is query
            var searchByQuery = function() {
                if (queryestQ && queryestQ != "undefined") {
                    currentQuery = (queryestQ == '' ? '*' : queryestQ);
                } else {
                    currentQuery = '*';
                }
            };
            var groupeCheckBoxOpened = function() {
                that.generateUrlFromCheckBox();
                if (formatedUrl != "") {
                    // there is query tag go search
                    searchByQuery();
                    that.goSearch();
                    searchedByQuery = true;
                }
            }


            setTimeout(function() {
                var checkedTagLength = that.context.$form_filter.find('input[type=checkbox]:checked').not('input[name=neigborhoods]');
                var compteursCheck = 0,
                    selfttarget;
                $('.filter-tags-check').each(function() {
                    if ($(this).attr('checked')) {
                        compteursCheck++;
                        selfttarget = $(this);
                        $(this).prop('checked', true);
                    }
                });
                if (compteursCheck && selfttarget) {
                    // Open the parent Accordien
                    selfttarget.closest('li.grouped-fields-search').find('.drop-btn a').trigger('click', [groupeCheckBoxOpened]);
                } else {
                    searchByQuery();
                    that.goSearch();
                }
            }, 100);
        }
        /**
         *
         */
    that.__construct = function() {
        that._setupContext();
        that._setupEvents();


        $($('.screen-compteur').find('a')[0]).attr('data-index', 0);
        $($('.screen-compteur').find('a')[1]).attr('data-index', 1);



        // check if tab already actived
        that.getCurrentTabActive();


        that.initSearchQueryMode();


        // add the callps class
        $('.screen-compteur .ui-radio').addClass('collapsed');



        // hide the button load More on Init
        $('.load-more-bars-btn').hide();
        $('.load-more-news-btn').hide();

        // dispatch click on the city select 
        that.context.$form_filter.find('select[name=city]')[0].selectedIndex = 0;
        that.context.$form_filter.find('input[type=reset]').trigger('click', ['from_constracter']);

    };

    that.__construct();
};


$(document).ready(function() {
    if (!$('form#filter').length) return;
    new meta.SearchPage();

    // on city select
    $("select.select2-dropdown").select2({
        placeholder: 'Choose a City',
        allowClear: true,
        minimumResultsForSearch: 5,
        dropdownCssClass: 'select2-search-filter white-style',
        containerCssClass: 'select2-search-filter white-style',
        sortResults: function(results, container, query) {
            if (query.term) {
                // use the built in javascript sort function
                return results.sort(function(a, b) {
                    if (a.text > b.text) {
                        return 1;
                    } else if (a.text < b.text) {
                        return -1;
                    } else {
                        return 0;
                    }
                });
            }
            return results;
        }
    });
});

function getBaseURL() {
    var url = location.href; // entire url including querystring - also: window.location.href;
    var baseURL = url.substring(0, url.indexOf('/', 14));


    if (baseURL.indexOf('http://localhost') != -1) {
        // Base Url for localhost
        var url = location.href; // window.location.href;
        var pathname = location.pathname; // window.location.pathname;
        var index1 = url.indexOf(pathname);
        var index2 = url.indexOf("/", index1 + 1);
        var baseLocalUrl = url.substr(0, index2);

        return baseLocalUrl;
    } else {
        // Root Url for domain name
        return baseURL;
    }

}