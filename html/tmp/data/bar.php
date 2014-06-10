<?php $is_mobile = isset($_GET['mobile']); ?>
<?php if( isset($_GET['list']) ): ?>

    <?php for($i=1; $i<6; $i++) : ?>
        <?php include('../../components/bar-w-pic-list.php') ?>
    <?php endfor ?>

<?php else: ?>

    <?php for($i=1; $i<13; $i++) : ?>
        <?php if(!$is_mobile): ?><div class="three columns m-margin-top"><?php endif ?>
        <?php include('../../components/bar-w-pic.php') ?>
        <?php if(!$is_mobile): ?></div><?php endif ?>
    <?php endfor ?>

<?php endif; ?>