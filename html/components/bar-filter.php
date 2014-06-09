<!-- BAR FILTER -->

<section class="bar-filter">

    <div class="container">

        <div class="twelve columns">
            <hr class="l-margin-top m-margin-bottom"/>
        </div>

        <div class="six columns h2">

            <input type="radio" name="filter" value="bar_list" class="ui-radio" data-color="brown" data-type="collapsed" checked="checked"/>
            <input type="radio" name="filter" value="best_of" class="ui-radio" data-color="brown" data-type="collapsed"/>
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

            <input type="radio" name="view-type" value="grid" class="ui-radio" data-color="brown" checked="checked"/>
            <input type="radio" name="view-type" value="list" class="ui-radio" data-color="brown"/>
        </div>
    </div>

    <div class="container">

        <div class="bars-w-pic">
            <?php for($i=1; $i<9; $i++) : ?>

                <div class="three columns m-margin-top force-load">
                    <?php include('components/bar-w-pic.php') ?>
                </div>
            <?php endfor ?>
        </div>

        <div class="bars-w-pic-list s-margin-top" style="display: none">
            <?php for($i=1; $i<6; $i++) : ?>

                <?php include('components/bar-w-pic-list.php') ?>
            <?php endfor ?>
        </div>

        <div class="twelve columns align-center m-margin">
            <a class="h4 btn-radius border load-more brown" href="tmp/data/tips.php">See more bars</a>
        </div>
    </div>

    <script type="text/javascript">
        $('input[name=view-type]').change(function()
        {
            if( $(this).val() == "grid")
            {
                $('.bars-w-pic').show();
                $('.bars-w-pic-list').hide();
            }
            else
            {
                $('.bars-w-pic').hide();
                $('.bars-w-pic-list').show();
            }
        })
    </script>

</section>