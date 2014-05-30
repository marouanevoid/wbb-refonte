<article class="<?=$is_small?'small':'large'?>">

    <?php if($has_image): ?>
        <div class="img">
            <div class="cover">
                <img src="tmp/article1.jpg" width="600" height="400" alt="article1"/>
            </div>
            <a class="plus-btn" href=""></a>
        </div>
    <?php endif ?>

    <div class="title vcenter">
        <h2>The Bar Project From<br/>Ballantine’s</h2>

        <?php if($has_text):?>
            <p class="m-margin">
                Taking over the spot that was once home to
                the much loved diner, Florent, The Vinatta Project
                is the latest addition to the Meatpacking District’s
                cocktail scene. The bartenders hail from the
                acclaimed Mulberry Project and the drinks,
                as you’d expect, are of a comparably high standard.
            </p>
        <?php endif ?>

        <?php if(!$has_image): ?>
            <a class="plus-btn" href=""></a>
        <?php endif ?>

    </div>

</article>