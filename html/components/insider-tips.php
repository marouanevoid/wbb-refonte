<section class="insider-tips m-margin-top">

    <div class="container">

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
                <?php include('components/tips/expert.php') ?>
            </div>

            <div class="three columns box">
                <?php include('components/tips/regular.php') ?>
            </div>

            <?php if( $is_mobile ): ?>
                <div class="twelve columns align-center m-margin">
                    <a class="btn-radius border load-more brown">Load More</a>
                </div>
            <?php endif ?>
        </div>

        <?php if( $is_mobile ): ?>
            <div class="three columns box">
                <?php include('components/tips/form.php') ?>
            </div>
        <?php endif ?>

        <?php if( !$is_mobile ): ?>
            <div class="twelve columns align-center m-margin">
                <a class="btn-radius border load-more brown">Load More</a>
            </div>
        <?php endif ?>
    </div>

</section>