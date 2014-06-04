<?php $page = 'index' ?>
<?php include('includes/head.php') ?>

<div class="full-cream">

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
                            <h1>Popular Bars</h1>
                        </td>

                        <td></td>
                    </tr>
                </table>
            <?php else: ?>
                <h1>Popular Bars</h1>
            <?php endif; ?>
        </section>
    </div>

    <!-- BARS -->
    <div class="container full">

        <section class="bars">
            <div class="ui-slider type-bar has_sizer arrows infinite dots" data-size="<?php if(!$is_mobile): ?>12x3<?php else: ?>4x3<?php endif ?>" data-display="<?=$is_mobile?1:3?>">

                <?php for($i=1; $i<7; $i++): ?>

                    <div class="ui-slide">
                        <?php include('components/bar-w-pic.php') ?>
                    </div>
                <?php endfor ?>
            </div>
        </section>
    </div>

    <!-- BEST OF -->
    <div class="container">

        <div class="twelve columns">

            <section class="bestof">
                <div class="align-center l-margin">
                    <h1>Best Of</h1>
                </div>

                <div class="ui-slider type-bestof has_sizer arrows infinite" data-size="<?php if(!$is_mobile): ?>3x3<?php else: ?>4x3<?php endif ?>" data-display="<?=$is_mobile?1:3?>">

                    <?php for($i=1; $i<7; $i++): ?>

                        <div class="ui-slide">
                            <?php include('components/bestof.php') ?>
                        </div>
                    <?php endfor ?>
                </div>
            </section>
        </div>
    </div>

    <!-- BAR FILTER -->
    <?php include('components/bar-filter.php') ?>

    <!-- AD -->
    <?php if( !$is_mobile ): ?>
        <?php include('components/footer-ad.php') ?>
    <?php endif ?>
</div>

<?php include('includes/foot.php') ?>