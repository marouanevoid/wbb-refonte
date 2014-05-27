<?php $page = 'index' ?>
<?php include('includes/head.php') ?>

<div class="full-cream l-padding-bottom">


    <!-- SUBHEADER -->
    <div class="container">

        <section class="sub-header">

            <?php if( !$is_mobile ): ?>
                <table>
                    <tr>
                        <td>
                            <?php if( !$is_mobile ): ?>
                                <?php include('components/city-selector.php') ?>
                            <?php endif ?>
                        </td>

                        <td class="title">
                            <h1>Discover the World’s Best Bars</h1>
                        </td>

                        <td></td>
                    </tr>
                </table>
            <?php else: ?>
                <h1>Discover the World’s Best Bars</h1>
            <?php endif; ?>
        </section>

    </div>


    <!-- BARS -->
    <div class="container full">

        <section class="bars">
            <div class="ui-slider type-bar has_sizer arrows infinite dots" data-size="<?php if(!$is_mobile): ?>12x3<?php else: ?>4x3<?php endif ?>">

                <?php for($i=1; $i<3; $i++): ?>

                    <?php if(!$is_mobile): ?>

                        <div class="ui-slide">
                            <?php for($j=1; $j<4; $j++) : ?>
                                <?php include('components/bar-w-pic.php') ?>
                            <?php endfor ?>
                        </div>

                    <?php else: ?>

                        <?php for($j=1; $j<4; $j++) : ?>
                            <div class="ui-slide">
                                <?php include('components/bar-w-pic.php') ?>
                            </div>
                        <?php endfor ?>

                    <?php endif; ?>

                <?php endfor ?>
            </div>
        </section>

    </div>


    <!-- CITIES -->
    <div class="container">

        <section class="cities">
            <div class="twelve columns align-center l-margin-top m-margin-bottom">
                <h1>Discover Bars from Top Cities</h1>
                <h3 class="s-margin-top">Select your city</h3>
            </div>

            <div class="twelve columns">
                <div class="ui-slider type-cities has_sizer arrows infinite" data-size="<?php if(!$is_mobile): ?>1x6<?php else: ?>8x3<?php endif ?>">

                    <?php for($i=1; $i<3; $i++): ?>

                        <div class="ui-slide">

                            <?php for($j=1; $j<($is_mobile?4:7); $j++) : ?>

                                <?php include('components/city.php') ?>

                            <?php endfor ?>
                        </div>

                    <?php endfor ?>

                </div>
            </div>
        </section>

    </div>


    <!-- BEST OF -->
    <div class="container">

        <section class="bestof">
            <div class="twelve columns align-center l-margin">
                <h1>Latest Best Of</h1>
            </div>

            <div class="ui-slider type-bestof has_sizer arrows infinite" data-size="<?php if(!$is_mobile): ?>3x3<?php else: ?>4x3<?php endif ?>">

                <?php for($i=1; $i<3; $i++): ?>

                    <?php if(!$is_mobile): ?>

                        <div class="ui-slide">
                            <?php for($j=1; $j<4; $j++) : ?>
                                <?php include('components/bestof.php') ?>
                            <?php endfor ?>
                        </div>

                    <?php else: ?>

                        <?php for($j=1; $j<4; $j++) : ?>
                            <div class="ui-slide">
                                <?php include('components/bestof.php') ?>
                            </div>
                        <?php endfor ?>

                    <?php endif; ?>

                <?php endfor ?>

            </div>
        </section>

    </div>

</div>

<!-- NEWS -->
<div class="container l-margin-top m-padding-bottom">

    <!-- LATEST ARTICLES -->
    <section class="articles eight columns">

        <div class="h1 m-margin-bottom color-brown <?php if( $is_mobile ): ?>align-center<?php endif ?>">
            Latest Articles
        </div>

        <?php $is_small=true; $has_image=true; $has_text=false; include('components/article.php') ?>
        <?php $is_small=true; $has_image=false; $has_text=true; include('components/article.php') ?>
        <?php $is_small=false; $has_image=true; $has_text=true; include('components/article.php') ?>

        <?php if( !$is_mobile ): ?>
            <a class="btn-radius border brown h4 s-margin-top" href="">See all articles</a>
        <?php endif ?>

    </section>

    <!-- NEWLY ADDED BARS -->
    <aside class="four columns">

        <div class="h1 m-margin-bottom color-brown <?php if( $is_mobile ): ?>align-center l-margin-top<?php endif ?>">
            Newly Added Bars
        </div>

        <?php for($i=1; $i<7; $i++) : ?>
            <?php include('components/bar-wo-pic.php') ?>
        <?php endfor ?>

        <a class="btn-radius border brown h4 s-margin-top" href="">See all bars</a>

        <?php if( !$is_mobile ): ?>
            <?php include('components/side-ad.php') ?>
        <?php endif ?>

    </aside>

</div>


<!-- AD -->
<?php if( !$is_mobile ): ?>
    <?php include('components/footer-ad.php') ?>
<?php endif ?>


<?php include('includes/foot.php') ?>