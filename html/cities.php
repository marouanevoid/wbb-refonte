<?php $page = 'cities' ?>
<?php include('includes/head.php') ?>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&amp;language=en"></script>
<script type="text/javascript" src="js/plugins/gmap3.min.js"></script>
<script type="text/javascript" src="js/cities.js"></script>

<section class="cities-content">

    <div id="map"></div>
    <div class="selector">
        <div class="heading">
            <h3>Find your city</h3>
            <form class="m-margin">
                <input type="text" name="city" placeholder="Type your city name..."/>
                <input type="submit" value=" "/>
                <input type="reset" value=" "/>
            </form>
        </div>
        <div class="scroll-cities scroll">
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
        <div class="scroll-bars scroll">
            <ul></ul>
        </div>
    </div>

</section>

<script type="text/javascript">

    var $scroll = $('.cities-content .scroll');
    var $head = $('.cities-content .heading');
    var $selector = $('.cities-content .selector');

    $(window).resize(function()
    {
        $scroll.height( $selector.height()-$head.height()-25 );
    });

    $(document).ready(function(){ $(window).resize() });

</script>
<?php include('includes/foot.php') ?>