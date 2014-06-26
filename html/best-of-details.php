<?php $page = 'best-of-details' ?>
<?php include('includes/head.php') ?>

<div>

    <!-- SUBHEADER -->
    <div class="container">
        <section class="sub-header">
            <table>
                <tr>

                    <td></td>

                    <td class="title">
                        <h3>New York Best's</h3>
                        <h1>Rooftop Bars</h1>
                        <h3>
                            We recently took our research on the roof,
                            going all over the world to find the best rooftop bars.
                        </h3>
                    </td>

                    <td class="star-share">
                        <a class="btn-round brown star" href=""></a><a class="btn-round brown share" href=""></a>
                    </td>
                </tr>
            </table>
        </section>
    </div>
</div>

<!-- BARS -->
<div class="container bars force-load">

    <?php for($i=1; $i<9; $i++): ?>
        <?php if($i==3): ?>
            <div class="four columns">
                <?php $bestof=true; include('components/side-ad.php'); ?>
            </div>
        <?php endif ?>

        <div class="four columns">
            <?php $bestof=true; include('components/bar-w-pic.php'); ?>
        </div>
    <?php endfor ?>
</div>

<!-- ALSO LIKE -->
<div class="container also-like l-margin">

    <section class="bestof force-load">
        <div class="align-center l-margin-bottom">
            <?php if( !$is_mobile ): ?>
                <hr class="l-margin-bottom"/>
            <?php endif ?>
            <h1>You may also like</h1>
        </div>

        <?php if($is_mobile): ?>
            <div class="ui-slider type-bestof has_sizer arrows dots" data-size="4x3" data-display="1">
        <?php endif ?>
                <?php for($i=1; $i<4; $i++): ?>
                <div class="four columns <?php if($is_mobile): ?>ui-slide<?php endif ?>">
                    <?php include('components/bestof.php') ?>
                </div>
            <?php endfor ?>
        <?php if($is_mobile): ?>
            </div>
        <?php endif ?>
    </section>

</div>

<!-- AD -->
<?php if( !$is_mobile ): ?>
    <?php include('components/footer-ad.php') ?>
<?php endif ?>

<?php include('includes/foot.php') ?>
