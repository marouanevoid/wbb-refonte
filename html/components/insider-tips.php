<section class="insider-tips m-margin-top">

    <div class="container load-container">

        <div class="twelve columns align-center l-margin-top m-margin-bottom h1">
            Insider Tips
        </div>

        <div class="line">

            <?php if( !$is_mobile ): ?>
                <div class="three columns box">
                    <?php include('components/tips/form.php') ?>
                </div>
            <?php endif ?>

            <div class="six columns box">
                <?php $is_expert=true; $is_foursquare=false; include('components/tips/tip.php') ?>
            </div>

            <div class="three columns box">
                <?php $is_expert=false; $is_foursquare=true; include('components/tips/tip.php') ?>
            </div>

        </div>

        <div class="line load-target"></div>

        <?php if( $is_mobile ): ?>

            <div class="twelve columns align-center m-margin">
                <a class="btn-radius border load-more brown" href="tmp/data/tips.php">Load More</a>
            </div>

            <div class="three columns box">
                <?php include('components/tips/form.php') ?>
            </div>

        <?php else: ?>

            <div class="twelve columns align-center m-margin">
                <a class="btn-radius border load-more brown" href="tmp/data/tips.php">Load More</a>
            </div>

        <?php endif ?>
    </div>

</section>