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
                <ul></ul>
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
        if( !$('html').hasClass('mobile') )
        {
            $cities_content.height( $(window).height()-$('header').height()-105 );

            var cities_height = $selector.height()-$head.height()-20;

            $cities.height( cities_height );
            $bars.height( cities_height-40 );
        }
        else
        {
            var content_height = $(window).height()-$('header').height()-1;
            $cities_content.height(content_height);

            var map_height = content_height-$head.outerHeight();
            $map.css({height:map_height, top:$head.outerHeight()});
            $cities.height( map_height-35 );
            $bars.height( map_height-35 );
        }
    });

    $('input[name=display-mode]').change(function()
    {
        if( $(this).val() == "map")
        {
            $('.cities-content .selector').css({height:'auto'});
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