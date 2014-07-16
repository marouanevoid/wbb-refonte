<?php $page = 'news' ?>
<?php include('includes/head.php') ?>

<div class="full-cream l-padding-bottom">


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
                            <h1>The Latest News</h1>
                        </td>

                        <td></td>
                    </tr>
                </table>
            <?php else: ?>
                <h1>Discover the World’s Best Bars</h1>
            <?php endif; ?>
        </section>

    </div>


    <!-- LATEST NEWS -->
    <div class="container full">

        <section class="bars">
            <div class="ui-slider type-bar has_sizer arrows dots" data-size="<?php if(!$is_mobile): ?>12x3<?php else: ?>4x3<?php endif ?>" data-display="<?=$is_mobile?1:3?>">

                <?php for($i=1; $i<7; $i++): ?>

                    <div class="ui-slide">
                        <?php include('components/thumb-article.php') ?>
                    </div>

                <?php endfor ?>
            </div>
        </section>
    </div>
</div>

<!-- EDITOR'S PICK -->
<div class="container l-margin-top <?=$is_mobile?'s':'m'?>-padding-bottom">

    <div class="twelve columns h1 m-margin-bottom color-brown <?php if( $is_mobile ): ?>align-center<?php endif ?>">
        Editor's Pick
    </div>

    <!-- 8 COLS -->
    <section class="articles padding eight columns">

        <?php $is_small=false; $has_image=true; $has_text=true; $has_quote=false; $has_video = false; include('components/article.php') ?>

        <?php $is_small=true; $has_image=true; $has_text=false; $has_quote=false; $has_video = false; $has_sponsor=true; include('components/article.php') ?>

        <?php $is_small=true; $has_image=false; $has_text=false; $has_quote=true; $has_video = false; $has_sponsor=false; include('components/article.php') ?>

        <?php $is_small=false; $has_image=true; $has_text=true; $has_quote=false; $has_video = true; include('components/article.php') ?>
    </section>

    <!-- 4 COLS -->
    <?php if( !$is_mobile ): ?>
        <aside class="articles padding four columns">

            <?php include('components/side-ad.php') ?>

            <?php $is_small=true; $has_image=false; $has_text=false; $has_quote=false; $has_video = false; include('components/article.php') ?>

            <?php $is_small=false; $has_image=true; $has_text=false; $has_quote=false; $has_video = true; include('components/article.php') ?>

            <?php $is_small=false; $has_image=true; $has_text=false; $has_quote=false; $has_video = false; include('components/article.php') ?>

            <?php $is_small=false; $has_image=true; $has_text=false; $has_quote=false; $has_video = false; include('components/article.php') ?>

            <?php $is_small=true; $has_image=false; $has_text=false; $has_quote=false; $has_video = false; include('components/article.php') ?>
        </aside>
    <?php endif ?>

</div>


<!-- AD -->
<?php if( !$is_mobile ): ?>
    <?php include('components/footer-ad.php') ?>
<?php endif ?>

    <div class="load-container">
        <!-- OLDER NEWS -->
        <div class="container <?php if( !$is_mobile ): ?>m-margin-top<?php endif ?>">

            <!-- 12 COLS -->
            <div class="articles older-news twelve columns">

                <?php $is_small=true; $has_image=true; $has_text=false; $has_quote=false; $has_video = true; include('components/article.php') ?>

                <?php $is_small=true; $has_image=false; $has_text=true; $has_quote=false; $has_video = false; include('components/article.php') ?>

                <?php $is_small=true; $has_image=true; $has_text=false; $has_quote=false; $has_video = false; include('components/article.php') ?>

                <div class="load-target"></div>
            </div>
        </div>

        <div class="twelve columns align-center l-margin-bottom <?=$is_mobile?'s-margin-top':''?>">
            <a class="h4 btn-radius border load-more brown large" href="tmp/data/news.php?">Older News</a>
        </div>
    </div>


<?php include('includes/foot.php') ?>