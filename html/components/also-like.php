<section class="also-like">

    <div class="container m-padding-bottom">

        <div class="h1 twelve columns align-center l-margin-top m-margin-bottom">
            You May Also Like
        </div>

        <?php for($i=1; $i<5; $i++) : ?>

            <div class="three columns">
                <?php if($is_mobile): ?>
                    <?php include('components/bar-wo-pic.php') ?>
                <?php else: ?>
                    <?php include('components/bar-w-pic.php') ?>
                <?php endif ?>
            </div>

        <?php endfor ?>

    </div>

</section>