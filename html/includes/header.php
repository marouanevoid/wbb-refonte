<header class="desktop">

    <div class="container">

        <div class="twelve columns">

            <table>
                <tr>

                    <td class="logo">
                        <a href="index.php">
                            <img src="images/logo-placeholder.png" alt="logo" width="157" height="85"/>
                        </a>
                    </td>

                    <td>
                        <?php include('components/header/nav.php') ?>
                    </td>

                    <td class="bar-finder">
                        <?php include('components/header/bar-finder-link.php') ?>

                        <img src="images/misc/border.brown.png" alt="border" width="1" height="40"/>

                        <a href="" class="search">
                            <img src="images/icons/search.png" alt="search" width="16" height="16"/>
                        </a>
                    </td>

                    <td>
                        <?php include('components/header/signin-register.php') ?>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</header>

<?php include('components/bar-finder.php') ?>