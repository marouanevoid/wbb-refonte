<header class="desktop">

    <div class="container">

        <div class="twelve columns">

            <table>
                <tr>

                    <td class="logo">
                        <a href="index.php">
                            <img src="images/logo-placeholder.png" alt="logo" width="158" height="85"/>
                        </a>
                    </td>

                    <td class="nav">
                        <?php include('components/header/nav.php') ?>
                        <form action="search.php">
                            <input type="text" placeholder=" Start typing..." name="q" autocomplete="off"/>
                        </form>
                    </td>

                    <td class="bar-finder">

                        <?php include('components/header/bar-finder-normal.php') ?>
                        <?php include('components/header/bar-finder-search.php') ?>

                    </td>

                    <td>
                        <?php include('components/header/logged.php') ?>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <div class="search-result-proposal"><ul></ul></div>

</header>



<?php include('components/bar-finder.php') ?>