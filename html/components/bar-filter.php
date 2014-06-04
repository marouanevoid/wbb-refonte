<!-- BAR FILTER -->

<section class="bar-filter">

    <div class="container">

        <div class="twelve columns">
            <hr class="l-margin-top m-margin-bottom"/>
        </div>

        <div class="six columns h2">

            <input type="radio" name="filter" value="bar_list" class="ui-radio checked dark" data-color="brown" data-type="collapsed"/>
            <input type="radio" name="filter" value="best of" class="ui-radio dark" data-color="brown" data-type="collapsed"/>
        </div>

        <div class="six columns sort-by h3">

            <span class="sort">Sort by :</span>

            <select class="ui-dropdown light" name="city">
                <option disabled="disabled">Popularity</option>
                <option value="cty2">City 2</option>
                <option value="cty3">City 3</option>
                <option value="cty4">City 4</option>
                <option value="cty5">City 5</option>
                <option value="cty6">City 6</option>
            </select>

            <input type="radio" name="view-type" value="grid" class="ui-radio checked dark" data-color="brown"/>
            <input type="radio" name="view-type" value="list" class="ui-radio dark" data-color="brown"/>
        </div>
    </div>

    <div class="container">
        <?php for($i=1; $i<9; $i++) : ?>

            <div class="three columns m-margin-top">
                <?php include('components/bar-w-pic.php') ?>
            </div>
        <?php endfor ?>

        <?php for($i=1; $i<6; $i++) : ?>

            <?php include('components/bar-w-pic-list.php') ?>
        <?php endfor ?>

        <div class="twelve columns align-center m-margin">
            <a class="h4 btn-radius border load-more brown" href="tmp/data/tips.php">See more bars</a>
        </div>
    </div>
</section>