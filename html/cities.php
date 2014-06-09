<?php $page = 'cities' ?>
<?php include('includes/head.php') ?>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&amp;language=en"></script>
<script type="text/javascript" src="js/plugins/gmap3.min.js"></script>
<script type="text/javascript" src="js/cities.js"></script>

<section class="cities-content">

    <div id="map"></div>
    <div class="zoom">
        <a class="plus btn-round brown"></a><br/>
        <a class="minus btn-round brown"></a>
    </div>
    <div class="selector">
        <div class="heading">
            <h3>Find your city</h3>
            <form class="s-margin">
                <input type="text" name="city" placeholder="Type your city name..."/>
                <input type="submit" value=" "/>
                <input type="reset" value=" "/>
            </form>
            <?php if($is_mobile): ?>
                <input type="radio" name="display-mode" value="map" checked="checked" class="ui-radio with-icon" data-color="brown"/>
                <input type="radio" name="display-mode" value="list" class="ui-radio with-icon" data-color="brown"/>
            <?php endif ?>
        </div>
        <div class="scrolls">
            <div class="scroll-cities scroll custom-scroll">
                <ul>
                    <li id="">Alberdeen</li>
                    <li id="">Adelaide</li>
                    <li id="">Amesterdam</li>
                    <li id="">Antwerp</li>
                    <li id="">Athens</li>
                    <li id="">Atlanta</li>
                    <li id="">Auckland</li>
                    <li id="">Bali</li>
                    <li id="">Bangkok</li>
                    <li id="">Barcelona</li>
                    <li id="">Bastile and the Marais</li>
                    <li id="">Bath</li>
                    <li id="">Beijing</li>
                    <li id="">Berut</li>
                    <li id="">Belfast</li>
                    <li id="">Belgrade</li>
                    <li id="">Bengaluru</li>
                    <li id="">Berlin</li>
                    <li id="">Birmingham</li>
                    <li id="">Alberdeen</li>
                    <li id="">Adelaide</li>
                    <li id="">Amesterdam</li>
                    <li id="">Antwerp</li>
                    <li id="">Athens</li>
                    <li id="">Atlanta</li>
                    <li id="">Auckland</li>
                    <li id="">Bali</li>
                    <li id="">Bangkok</li>
                    <li id="">Barcelona</li>
                    <li id="">Bastile and the Marais</li>
                    <li id="">Bath</li>
                    <li id="">Beijing</li>
                    <li id="">Berut</li>
                    <li id="">Belfast</li>
                    <li id="">Belgrade</li>
                    <li id="">Bengaluru</li>
                    <li id="">Berlin</li>
                    <li id="">Birmingham</li>
                </ul>
            </div>
            <div class="scroll-bars scroll custom-scroll">
                <ul></ul>
            </div>
        </div>
    </div>

</section>

<script type="text/javascript">

    var $cities_content = $('.cities-content');
    var $cities = $('.cities-content .scroll-cities');
    var $bars = $('.cities-content .scroll-bars');
    var $head = $('.cities-content .heading');
    var $selector = $('.cities-content .selector');
    var $map = $('.cities-content #map');

    $(window).resize(function()
    {
        if( $(window).height() > 640 )
        {
            $cities_content.height( $(window).height()-$('header').height()-105 );

            var cities_height = $selector.height()-$head.height()-20;

            $cities.height( cities_height );
            $bars.height( cities_height-40 );
        }
        else
        {
            $cities_content.height($(window).height()-$('header').height());

            var map_height = $(window).height()-$('header').height()-$head.outerHeight();
            $map.css({height:map_height, top:$head.outerHeight()});
            $cities.height( map_height-35 );
            $bars.height( map_height-35 );
        }
    });

    $('input[name=display-mode]').change(function()
    {
        if( $(this).val() == "map")
        {
            $('.cities-content .scrolls').hide();
            $('.cities-content .zoom').show();
        }
        else
        {
            $('.cities-content .scrolls').show();
            $('.cities-content .zoom').hide();
        }

        $(window).resize();
    });

    $(document).ready(function(){ $(window).resize() });

</script>
<?php include('includes/foot.php') ?>