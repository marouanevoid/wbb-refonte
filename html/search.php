<?php $page = 'search' ?>
<?php include('includes/head.php') ?>

    <div class="container l-margin">

        <aside class="three columns">
            <ul>

                <li>

                    <h3>Filters</h3>
                </li>

                <li>

                    <div class="drop-list">
                        <h3>Location</h3>
                        <a class="btn-round plus"></a>
                    </div>

                    <ul>

                        <h3>City</h3>

                        <select class="ui-dropdown" name="city" data-class="city">
                            <option disabled="disabled">Choose a City</option>
                            <option value="cty2">City 2</option>
                            <option value="cty3">City 3</option>
                            <option value="cty4">City 4</option>
                            <option value="cty5">City 5</option>
                            <option value="cty6">City 6</option>
                        </select>

                        <h3>Neigborhood</h3>

                        <li class="h4">
                            <span><input type="radio"/></span>All Neigborhoods
                            <ul>
                                <li><span><input type="checkbox"/></span>Brooklyon</li>
                                <li><span><input type="checkbox"/></span>Brooklyon</li>
                                <li><span><input type="checkbox"/></span>Brooklyon</li>
                                <li><span><input type="checkbox"/></span>Brooklyon</li>
                                <li><span><input type="checkbox"/></span>Brooklyon</li>
                                <li><span><input type="checkbox"/></span>Brooklyon</li>
                                <li><span><input type="checkbox"/></span>Brooklyon</li>
                                <li><span><input type="checkbox"/></span>Brooklyon</li>
                                <li><span><input type="checkbox"/></span>Brooklyon</li>
                                <li><span><input type="checkbox"/></span>Brooklyon</li>
                                <li><span><input type="checkbox"/></span>Brooklyon</li>
                                <li><span><input type="checkbox"/></span>Brooklyon</li>
                                <li><span><input type="checkbox"/></span>Brooklyon</li>
                                <li><span><input type="checkbox"/></span>Brooklyon</li>
                                <li><span><input type="checkbox"/></span>Brooklyon</li>
                                <li><span><input type="checkbox"/></span>Brooklyon</li>
                                <li><span><input type="checkbox"/></span>Brooklyon</li>
                                <li><span><input type="checkbox"/></span>Brooklyon</li>
                                <li><span><input type="checkbox"/></span>Brooklyon</li>
                                <li><span><input type="checkbox"/></span>Brooklyon</li>
                            </ul>
                        </li>

                        <li class="h4">
                            <span><input type="radio"/></span>Some specific Neigborhoods
                            <ul>
                                <li><span><input type="checkbox"/></span>Brooklyon</li>
                                <li><span><input type="checkbox"/></span>Brooklyon</li>
                                <li><span><input type="checkbox"/></span>Brooklyon</li>
                                <li><span><input type="checkbox"/></span>Brooklyon</li>
                                <li><span><input type="checkbox"/></span>Brooklyon</li>
                                <li><span><input type="checkbox"/></span>Brooklyon</li>
                                <li><span><input type="checkbox"/></span>Brooklyon</li>
                                <li><span><input type="checkbox"/></span>Brooklyon</li>
                                <li><span><input type="checkbox"/></span>Brooklyon</li>
                                <li><span><input type="checkbox"/></span>Brooklyon</li>
                                <li><span><input type="checkbox"/></span>Brooklyon</li>
                                <li><span><input type="checkbox"/></span>Brooklyon</li>
                                <li><span><input type="checkbox"/></span>Brooklyon</li>
                                <li><span><input type="checkbox"/></span>Brooklyon</li>
                                <li><span><input type="checkbox"/></span>Brooklyon</li>
                                <li><span><input type="checkbox"/></span>Brooklyon</li>
                                <li><span><input type="checkbox"/></span>Brooklyon</li>
                                <li><span><input type="checkbox"/></span>Brooklyon</li>
                                <li><span><input type="checkbox"/></span>Brooklyon</li>
                                <li><span><input type="checkbox"/></span>Brooklyon</li>
                            </ul>
                        </li>
                    </ul>
                </li>

                <li>

                    <div class="drop-list">
                        <h3>Bar Style</h3>
                        <a class="btn-round plus"></a>
                    </div>

                    <ul class="h4">
                        <li><span><input type="checkbox"/></span>Brooklyon</li>
                        <li><span><input type="checkbox"/></span>Brooklyon</li>
                        <li><span><input type="checkbox"/></span>Brooklyon</li>
                        <li><span><input type="checkbox"/></span>Brooklyon</li>
                        <li><span><input type="checkbox"/></span>Brooklyon</li>
                        <li><span><input type="checkbox"/></span>Brooklyon</li>
                        <li><span><input type="checkbox"/></span>Brooklyon</li>
                        <li><span><input type="checkbox"/></span>Brooklyon</li>
                        <li><span><input type="checkbox"/></span>Brooklyon</li>
                        <li><span><input type="checkbox"/></span>Brooklyon</li>
                        <li><span><input type="checkbox"/></span>Brooklyon</li>
                        <li><span><input type="checkbox"/></span>Brooklyon</li>
                        <li><span><input type="checkbox"/></span>Brooklyon</li>
                        <li><span><input type="checkbox"/></span>Brooklyon</li>
                        <li><span><input type="checkbox"/></span>Brooklyon</li>
                        <li><span><input type="checkbox"/></span>Brooklyon</li>
                        <li><span><input type="checkbox"/></span>Brooklyon</li>
                        <li><span><input type="checkbox"/></span>Brooklyon</li>
                        <li><span><input type="checkbox"/></span>Brooklyon</li>
                        <li><span><input type="checkbox"/></span>Brooklyon</li>
                    </ul>
                </li>

                <li>

                    <div class="drop-list">
                        <h3>Atmosphere</h3>
                        <a class="btn-round plus"></a>
                    </div>
                </li>

                <li>

                    <div class="drop-list">
                        <h3>Good for</h3>
                        <a class="btn-round plus"></a>
                    </div>
                </li>
            </ul>
        </aside>

        <div class="nine columns bar-filter">
            <h1>Search results</h1>

            <div class="m-margin-top">
                <div class="six columns h2">

                    <input type="radio" name="filter" value="(14) bars" class="ui-radio checked dark" data-color="brown" data-type="collapsed"/>
                    <input type="radio" name="filter" value="(10) articles" class="ui-radio dark" data-color="brown" data-type="collapsed"/>
                </div>

                <div class="six columns sort-by h3">

                    <span class="sort">Sort by :</span>

                    <input type="radio" name="view-type" value="grid" class="ui-radio checked dark" data-color="brown"/>
                    <input type="radio" name="view-type" value="list" class="ui-radio dark" data-color="brown"/>
                </div>
            </div>
        </div>

        <div class="nine columns search-results m-margin-top">

            <?php for($i=1; $i<13; $i++) : ?>
                <div class="four columns bar m-margin-bottom">
                    <?php include('components/bar-w-pic.php') ?>
                </div>
            <?php endfor ?>

            <div class="twelve columns align-center">
                <a class="h4 btn-radius border load-more brown" href="tmp/data/tips.php">See more bars</a>
            </div>
        </div>
    </div>

    <!-- AD -->
    <?php if( !$is_mobile ): ?>
        <?php include('components/footer-ad.php') ?>
    <?php endif ?>

<?php include('includes/foot.php') ?>
