<?php $page = 'bar-details' ?>
<?php include('includes/head.php') ?>

    <!-- SUBHEADER -->
    <section class="container sub-header">

        <div class="three columns vcenter city-selector h4">
            You are in
            <a class="btn-radius with-icon border brown place" href="">New York</a>
        </div>

        <div class="six columns title vcenter">
            <h1>Macao Trading Co.</h1>
            <h3>Lower Manhattan, New York</h3>
        </div>

        <div class="three columns star-share vcenter">
            <a class="btn-round brown star" href=""></a>
            <a class="btn-round brown share" href=""></a>
        </div>

    </section>


    <!-- SLIDER -->
    <div class="container full gallery">
        <div class="main">
            <?php $j = 1 ?>
            <?php include('components/slider/image.php') ?>
        </div>
        <?php include('components/slider.php') ?>
    </div>

    <section class="container">
        <!-- MAIN CONTENT -->
        <article class="main">

            <div class="twelve columns h1 l-margin-top mobile-out">About the bar</div>

            <div class="eight columns l-margin-top">

                <p>
                    <strong>At a Glance : </strong> Amazing View ∙ Classic Music ∙ Contemporary<br/>
                    <br/>
                    From the team behind the acclaimed Employees Only and David Waltuck, chef and owner of Chanterelle, comes
                    a new super-hip Tribeca spot. Taking its inspiration from the brothels and opium dens of old 1930s Macao,
                    customers are encouraged to leave their inhibitions at the door and “embrace a little dose of erotic abandon”.
                    And most are more than happy to oblige. Macao was a Portuguese colony in China for centuries, which accounts
                    for the unique menu structure and the melding of European and Asian cuisine - many of the appetizers and
                    entrees are offered cooked “Chinese style” or “Portugese style”.<br/>
                    <br/>
                    Meanwhile dishes such as curried chicken and okra turnovers and bacalao fried rice have been created
                    to complement exotic and rather yummy cocktails such as the Drunken Dragon’s Milk, which combines
                    green-tea vodka blended with coconut purée, pandan syrup, Chinese five spice bitters and Thai basil,
                    and Yellow Fever, a concoction of rye, Benedictine and egg white. The décor is also influenced by Macao:
                    lots of warm wood with a gorgeous glass-backed bar and antique brica- brac scattered.<br/>
                    <br/>
                    Macao was a Portuguese colony in China for centuries, which accounts for the unique menu structure and
                    the melding of European and Asian cuisine - many of the appetizers and entrees are offered cooked “Chinese style”
                    or “Portugese style”.<br/>
                    <br/>
                    From the team behind the acclaimed Employees Only and David Waltuck, chef and owner of Chanterelle,
                    comes a new super-hip Tribeca spot. Taking its inspiration from the brothels and opium dens of old 1930s Macao,
                    customers are encouraged to leave their inhibitions at the door and “embrace a little dose of erotic abandon”.
                    And most are more than happy to oblige.
                </p>

                <!-- ALSO APPEARS -->
                <?php if( !$is_mobile ): ?>
                    <div class="also-appears">
                        <hr class="l-margin"/>
                        <?php include('components/also-appears.php') ?>
                    </div>
                <?php endif ?>
            </div>

            <!-- ASIDE -->
            <aside class="columns four">

                <div class="block informations">
                    <div class="contain">

                        <div class="gmap">
                            <div class="get-directions h4">
                                <a href="" class="btn-small-radius border brown">Get Directions</a>
                            </div>
                            <img src="http://maps.googleapis.com/maps/api/staticmap?center=354+West+Hubbard+Street+New+York,NY&zoom=16&size=660x240&maptype=roadmap&sensor=false"/>
                        </div>

                        <p>
                            354 West Hubbard Street<br/>
                            New York, NY<br/>
                            (555) 555-5555<br/>
                            <a href="">info@macaonyc.com</a>
                            <br/>
                            <a href="" class="btn-small-round www brown"></a>
                            <a href="" class="btn-small-round twitter"></a>
                            <a href="" class="btn-small-round facebook"></a>
                        </p>

                        <hr class="s-margin"/>

                        <p>
                            Hours: Today 5:00 pm - 2:00 am <a href="">(See all)</a><br/>
                            Accepts Credit Cards: Yes<br/>
                            Coat Check: Yes<br/>
                            Parking: Street<br/>
                            Price: $$$$  <a href="">(View menu)</a><br/>
                            Reservation: Yes<br/>
                            <a href="" class="btn-small-radius border brown">Make a Reservation</a>
                        </p>
                    </div>
                </div>

                <?php if( !$is_mobile ): ?>
                    <div class="block side-ad m-margin-top">
                        <img src="tmp/ad.side.jameson.png" alt="ad.jameson" width="300" height="250"/>
                        <div class="txt">Advertising</div>
                    </div>
                <?php endif ?>
            </aside>

        </article>
    </section>

    <!-- INSIDER TIPS -->
    <?php include('components/insider-tips.php') ?>

    <!-- ALSO APPEARS -->
    <?php if( $is_mobile ): ?>
        <div class="container">
            <div class="twelve columns">
                <div class="also-appears">
                    <?php include('components/also-appears.php') ?>
                    <hr class="l-margin-top"/>
                </div>
            </div>
        </div>
    <?php endif ?>

    <!-- ALSO LIKE -->
    <?php include('components/also-like.php') ?>

    <!-- AD -->
    <?php if( !$is_mobile ): ?>
        <?php include('components/footer-ad.php') ?>
    <?php endif ?>

<?php include('includes/foot.php') ?>