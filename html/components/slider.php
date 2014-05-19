<div class="ui-slider type-bar has_sizer arrows infinite" data-size="4x3">

    <?php for($i=1; $i<3; $i++): ?>

        <div class="ui-slide">

            <?php for($j=2; $j<6; $j++): ?>

                <?php include('components/slider/image.php') ?>

            <?php endfor ?>
        </div>

    <?php endfor ?>

</div>