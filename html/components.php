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

                <div class="two columns l-margin-top">
                    <?php include('components/city.php') ?>
                </div>
            <?php endfor ?>
        </div>
    <!-- End -->

    <!-- Drop Down -->

        <div class="container">

            <div class="three columns l-margin">

                <select class="ui-dropdown">
                    <option disabled="disabled">City 1</option>
                    <option>City 2</option>
                    <option>City 3</option>
                    <option>City 4</option>
                    <option>City 5</option>
                    <option>City 6</option>
                </select>

            </div>

            <div class="three columns l-margin">

                <select class="ui-dropdown dark">
                    <option disabled="disabled">City 1</option>
                    <option>City 2</option>
                    <option>City 3</option>
                    <option>City 4</option>
                    <option>City 5</option>
                    <option>City 6</option>
                </select>

            </div>
        </div>
    <!-- End -->


<?php include('includes/foot.php') ?>