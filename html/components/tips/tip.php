<article class="tip" itemprop="review" itemscope="" itemtype="http://schema.org/Review">

    <table class="content <?php if($is_expert): ?>expert<?php endif ?>">

        <tr class="excerpt">
            <td colspan="2">
                <div class="scroll">
                <?php if($is_foursquare): ?>
                    <img src="images/icons/pin.foursquare-blue.png" alt="icon.foursquare" width="30" height="30"/><br/>
                <?php endif ?>
                “<span itemprop="description">
                    NY. This Portuguese/ Chinese fusion restaurant offers an exciting blend of exotic dishes that make dining at Macao a unique experience.
                </span>”
                </div>
            </td>
        </tr>

        <?php if($is_expert): ?>

        <tr>
            <td colspan="2">
                <hr class="s-margin-bottom"/>
            </td>
        </tr>

        <tr class="author">
            <td>
                <img src="tmp/user.ryan.png" alt="user" width="40" height="40"/>
            </td>
            <td>
                <?=$is_expert?'<b>Expert</b>':''?>
                <span itemprop="name">Ryan Melon</span>
            </td>
        </tr>

        <?php endif ?>

    </table>
</article>
