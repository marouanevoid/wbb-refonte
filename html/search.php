<?php $page = 'search' ?>
<?php include('includes/head.php') ?>
<script type="text/javascript" src="js/search.js"></script>

<?php if($is_mobile): ?>
    <?php include('includes/mobile/search-bar.php') ?>
<?php endif ?>

    <div class="container l-padding">

        <aside class="three columns filters">

            <form id="filter">

                <div class="reset m-margin-bottom">
                    <h3>Filters</h3>
                    <input type="reset" value="<?=$is_mobile?' ':'Reset'?>"/>
                </div>

                <ul>
                    <li>
                        <div class="drop-btn">
                            <h3>Location</h3>
                            <a class="btn-round plus brown"></a>
                        </div>

                        <div class="drop-list">

                            <?php if(!$is_mobile):?><label class="h3">City</label><?php endif ?>

                            <select class="ui-dropdown" name="city" data-class="city">
                                <option disabled="disabled">Choose a City</option>
                                <option value="cty2">City 2</option>
                                <option value="cty3">City 3</option>
                                <option value="cty4">City 4</option>
                                <option value="cty5">City 5</option>
                                <option value="cty6">City 6</option>
                            </select>

                            <div class="neigborhood">
                                <label class="h3">Neigborhood</label>
                                <ul></ul>
                            </div>

                        </div>
                    </li>
                    <li>
                        <div class="drop-btn">
                            <h3>Bar style</h3>
                            <a class="btn-round plus brown"></a>
                        </div>

                        <div class="drop-list">

                            <ul>
                                <li><label><input type="checkbox" name="neigborhood[]" value="brooklyn"/><b></b>Hotel Bar</label></li>
                                <li><label><input type="checkbox" name="neigborhood[]" value="brooklyn"/><b></b>Amazing Views</label></li>
                                <li><label><input type="checkbox" name="neigborhood[]" value="brooklyn"/><b></b>Speakeasy</label></li>
                            </ul>

                        </div>
                    </li>
                </ul>

                <div class="submit s-margin-top">
                    <input type="submit" value="Apply Filters"/>
                </div>

            </form>

        </aside>

        <div class="nine columns bar-filter-form">

            <?php if(!$is_mobile): ?>

                <h1>Search results</h1>

                <div class="five columns m-margin">
                    <form id="search">
                        <input type="text" name="city" placeholder="Type your city name..."/>
                        <input type="submit" class="search" value=" "/>
                        <input type="reset" value=" "/>
                    </form>
                </div>

            <?php endif ?>

            <div class="six columns h2">
                <input type="radio" name="filter" value="(14) bars" checked="checked" class="ui-radio" data-color="brown" data-type="collapsed"/>
                <input type="radio" name="filter" value="(10) articles" class="ui-radio" data-color="brown" data-type="collapsed"/>
            </div>

            <div class="six columns sort-by h3">
                <?php if($is_mobile) :?>
                    <a class="btn-radius border brown filter-btn">Filter</a>
                <?php endif ?>
                <input type="radio" name="view-type" value="grid" class="ui-radio with-icon" data-color="brown" checked="checked"/>
                <input type="radio" name="view-type" value="list" class="ui-radio with-icon" data-color="brown"/>
            </div>

        </div>

        <section class="nine columns bar-filter m-margin-top">

            <div class="bars-w-pic force-load  <?php if($is_mobile): ?>m-margin-top<?php endif ?> load-container">

                <?php for($i=1; $i<13; $i++) : ?>
                    <?php if(!$is_mobile): ?><div class="three columns m-margin-top"><?php endif ?>
                    <?php include('components/bar-w-pic.php') ?>
                    <?php if(!$is_mobile): ?></div><?php endif ?>
                <?php endfor ?>

                <div class="load-target"></div>

                <div class="twelve columns align-center m-margin load-more-container">
                    <a class="h4 btn-radius large border load-more brown" href="tmp/data/bar.php?<?=$is_mobile?'&mobile':''?>">See more bars</a>
                </div>

            </div>

            <div class="bars-w-pic-list load-container" style="display: none">

                <?php for($i=1; $i<6; $i++) : ?>
                    <?php include('components/bar-w-pic-list.php') ?>
                <?php endfor ?>

                <div class="load-target"></div>

                <div class="twelve columns align-center m-margin load-more-container">
                    <a class="h4 btn-radius large border load-more brown" href="tmp/data/bar.php?list=1<?=$is_mobile?'&mobile':''?>">See more bars</a>
                </div>

            </div>

        </section>
    </div>

    <script type="text/javascript">

        $('input[name=view-type]').change(function()
        {
            if( $(this).val() == "grid")
            {
                $('.bars-w-pic-list').fadeOut(200, 'easeInOutCubic', function()
                {
                    $('.bars-w-pic').show();

                    var $elements = $('.bars-w-pic article');

                    $elements.addClass('enable3d').css({opacity:0, top:'6em', position:'relative'}).each(function(index){

                        $(this).delay(60*(index+1)).velocity({opacity:1, top:0}, 600, 'easeInOutCubic');
                    });
                });
            }
            else
            {
                $('.bars-w-pic').fadeOut(200, 'easeInOutCubic', function()
                {
                    $('.bars-w-pic-list').show();

                    var $elements = $('.bars-w-pic-list article');

                    $elements.addClass('enable3d').css({opacity:0, top:'6em', position:'relative'}).each(function(index){

                        $(this).delay(100*(index+1)).velocity({opacity:1, top:0}, 600, 'easeInOutCubic');
                    });
                });
            }
        });

        $('.filter-btn').click(function()
        {
            $('aside.filters').fadeIn(500, 'easeInOutCubic', function()
            {
                $('.bar-filter-form, .bar-filter').hide();
            });
        });

        $('aside.filters input[type=reset]').click(function()
        {
            $('.bar-filter-form, .bar-filter').show();
            if( $(window).width() < 640 ) $('aside.filters').fadeOut();
        });

    </script>

    <!-- AD -->
    <?php if( !$is_mobile ): ?>
        <?php include('components/footer-ad.php') ?>
    <?php endif ?>

<?php include('includes/foot.php') ?>
