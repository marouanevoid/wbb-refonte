<?php $is_bestof = isset($bestof) && $bestof; ?>
<article class="bar-w-pic <?=$is_bestof?'best-of':''?>">

    <a href="" class="btn-round dark star active"></a>

    <div class="txt">
        <?php if($is_bestof) : ?>
            <span class="number h2"><?=$i?></span>
        <?php endif ?>
        <h2>Berry Park</h2>
        <h3>Lower Manhattan, New York</h3>
        <div class="hover">
            <div class="tags">rooftop, romance, ambiente</div>
            <?php if($is_bestof) : ?>
                <div class="description">
                    The first of America’s "revivalist"classic cocktail
                    bars hasn’t changed a nick over the past 9 years
                    and that is good news for you! Helmed by ...
                </div>
            <?php endif ?>
        </div>

    </div>
    <a href="bar-details.php" class="overlay-link"></a>

    <div class="color gradient"></div>
    <div class="color gray"></div>
    <img src="" class="scale-with-grid" data-src="tmp/bar.jpg" alt="bar.berry-park" width="570" height="428"/>
</article>