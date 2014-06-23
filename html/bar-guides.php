<?php $page = 'bar-guides' ?>
<?php include('includes/head.php') ?>

<div class="full-cream">

    <!-- SUBHEADER -->
    <div class="container">

        <section class="sub-header">

            <?php if( !$is_mobile ): ?>
                <table>
                    <tr>
                        <td>
                            <?php if( !$is_mobile ): ?>
                                <?php include('components/city-selector.php') ?>
                            <?php endif ?>
                        </td>

                        <td class="title">
                            <h1>Popular Bars</h1>
                        </td>

                        <td></td>
                    </tr>
                </table>
            <?php else: ?>
                <h1>Popular Bars</h1>
            <?php endif; ?>
        </section>
    </div>

    <!-- BARS -->
    <div class="container full">

        <section class="bars">

            <?php if($is_mobile): ?>

                <div class="force-load">
                    <?php for($i=1; $i<6; $i++): ?>
                        <?php include('components/bar-w-pic.php') ?>
                    <?php endfor ?>
                </div>

            <?php else : ?>

                <div class="ui-slider type-bar has_sizer arrows dots" data-size="12x3" data-display="3">

                    <?php for($i=1; $i<4; $i++): ?>

                        <div class="ui-slide">
                            <?php include('components/bar-w-pic.php') ?>
                        </div>
                    <?php endfor ?>
                </div>

            <?php endif ?>

        </section>
    </div>

    <!-- BEST OF -->
    <div class="container">

        <div class="twelve columns">

            <section class="bestof">
                <div class="align-center l-margin">
                    <h1>Best Of</h1>
                </div>

                <div class="ui-slider type-bestof has_sizer arrows dots" data-size="<?php if(!$is_mobile): ?>3x3<?php else: ?>4x3<?php endif ?>" data-display="<?=$is_mobile?1:3?>">

                    <?php for($i=1; $i<7; $i++): ?>

                        <div class="ui-slide">
                            <?php include('components/bestof.php') ?>
                        </div>
                    <?php endfor ?>
                </div>
            </section>
        </div>
    </div>

    <!-- BAR FILTER -->

    <section class="bar-filter">

        <div class="container s-margin-bottom">

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
                    <option value="popularity">Popularity</option>
                    <option value="date">Date</option>
                    <option value="distance">Distance</option>
                    <option value="alphabet">Alphabetical order</option>
                </select>

                <input type="radio" name="view-type" value="grid" class="ui-radio with-icon" data-color="brown" checked="checked"/>
                <input type="radio" name="view-type" value="list" class="ui-radio with-icon" data-color="brown"/>
            </div>
        </div>

        <div class="container">

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

        </script>

    </section>

    <!-- AD -->
    <?php if( !$is_mobile ): ?>
        <?php include('components/footer-ad.php') ?>
    <?php endif ?>
</div>

<?php include('includes/foot.php') ?>