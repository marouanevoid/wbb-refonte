<section class="also-like">

    <div class="container m-padding-bottom">

        <div class="h1 twelve columns align-center l-margin-top m-margin-bottom">
            You May Also Like
        </div>

        <?php for($i=1; $i<5; $i++) : ?>

            <div class="three columns">
                <?php include('components/bar.php') ?>
            </div>

        <?php endfor ?>

    </div>

</section>