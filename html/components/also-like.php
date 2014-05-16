<section class="also-like">

    <div class="container m-padding-bottom">

        <div class="twelve columns align-center l-margin-top m-margin-bottom">
            <h1>You May Also Like</h1>
        </div>

        <?php for($i=1; $i<5; $i++) : ?>

            <div class="three columns">
                <?php include('components/bar.php') ?>
            </div>

        <?php endfor ?>

    </div>

</section>