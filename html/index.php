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
            <div class="ui-slider type-bar has_sizer arrows dots" data-size="<?php if(!$is_mobile): ?>12x3<?php else: ?>4x3<?php endif ?>" data-display="<?=$is_mobile?1:3?>">

                <?php for($i=1; $i<4; $i++): ?>

                    <div class="ui-slide">
                        <?php include('components/bar-w-pic.php') ?>
                    </div>

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
                <div class="ui-slider type-cities has_sizer arrows dots" data-size="<?php if(!$is_mobile): ?>1x6<?php else: ?>8x3<?php endif ?>" data-display="<?=$is_mobile?3:6?>">

                    <?php for($i=1; $i<10; $i++): ?>

                        <div class="ui-slide">
                            <?php include('components/city.php') ?>
                        </div>

                    <?php endfor ?>

                </div>
            </div>
        </section>

    </div>


    <!-- BEST OF -->
    <div class="container">

        <div class="twelve columns">

            <section class="bestof">
                <div class="align-center l-margin">
                    <h1>Latest Best Of</h1>
                </div>

                <div class="ui-slider type-bestof has_sizer arrows dots" data-size="<?php if(!$is_mobile): ?>3x3<?php else: ?>4x3<?php endif ?>" data-display="<?=$is_mobile?1:3?>">

                    <?php for($i=1; $i<7; $i++): ?>

                            <div class="ui-slide">
                                <?php include('components/bestof.php') ?>
                            </div>
                    <?php endfor ?>
                </div>
            </section>
        </div>
    </div>

</div>

<!-- NEWS -->
<div class="container l-margin-top m-padding-bottom">

    <!-- LATEST ARTICLES -->
    <section class="articles eight columns">

        <div class="h1 m-margin-bottom color-brown <?php if( $is_mobile ): ?>align-center<?php endif ?>">
            Latest News
        </div>

        <?php $is_small=true; $has_image=true; $has_text=false; $has_quote=false; include('components/article.php') ?>
        <?php $is_small=true; $has_image=false; $has_text=true; $has_quote=false; include('components/article.php') ?>
        <?php $is_small=false; $has_image=true; $has_text=true; $has_quote=false; include('components/article.php') ?>

        <a class="btn-radius border brown h4 s-margin-top" href="">See all articles</a>

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