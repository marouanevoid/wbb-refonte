<?php include('includes/head.php') ?>


    <!-- Bar Card -->

        <div class="container">

            <?php for($i=1; $i<4; $i++) : ?>

                <div class="four columns l-margin-top">
                    <?php include('components/bar-w-pic.php') ?>
                </div>
            <?php endfor ?>

            <?php for($i=1; $i<5; $i++) : ?>

                <div class="three columns l-margin-top">
                    <?php include('components/bar-w-pic.php') ?>
                </div>
            <?php endfor ?>
        </div>
    <!-- End -->


    <!-- Best Of Card -->

    <div class="container">

        <?php for($i=1; $i<4; $i++) : ?>

            <div class="four columns l-margin-top">
                <?php include('components/bestof.php') ?>
            </div>
        <?php endfor ?>
    </div>
    <!-- End -->


    <!-- City Card -->

        <div class="container">

            <?php for($i=1; $i<7; $i++) : ?>

                <div class="two columns l-margin">
                    <?php include('components/city.php') ?>
                </div>
            <?php endfor ?>
        </div>
    <!-- End -->


<?php include('includes/foot.php') ?>