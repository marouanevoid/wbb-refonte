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

<?php include('includes/foot.php') ?>