<div class="ui-slider type-bar has_sizer arrows infinite" data-size="8x3">

    <?php for($i=1; $i<3; $i++): ?>

        <div class="ui-slide">

            <?php for($j=1; $j<6; $j++): ?>

                <div class="image foursquare">
                    <span></span>
                    <img src="tmp/slider/<?=$j?>.jpg"/>
                </div>

            <?php endfor ?>
        </div>

    <?php endfor ?>

</div>