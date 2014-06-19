<div class="detect-scroll"></div>
<aside class="mobile-menu">

    <table>

        <tr class="search">
            <td>
                <form class="dark">
                    <input type="text" placeholder="Search..."/>
                    <input type="submit" value=" "/>
                </form>
            </td>
        </tr>

        <tr class="header-nav">
            <td>
                <?php include('components/header/nav.php') ?>
            </td>
        </tr>

        <tr class="links">
            <td>
                <?php include('components/header/bar-finder-link.php') ?>
            </td>
        </tr>

        <tr class="signin">
            <td>
                <?php include('components/header/signin-register.php') ?>
            </td>
        </tr>

        <tr class="footer-nav">
            <td>
                <?php include('components/footer/nav.php') ?>
            </td>
        </tr>

        <tr class="socials">
            <td>
                <?php include('components/footer/social-icons.php') ?>
            </td>
        </tr>

        <tr class="touch">
            <td>
                <?php include('components/footer/keep-in-touch.php') ?>
            </td>
        </tr>

        <tr class="copyright">
            <td>
                <?php include('components/footer/copyright.php') ?>
            </td>
        </tr>
    </table>
</aside>

<header class="mobile">

    <div class="container">

        <div class="twelve columns">

            <table>
                <tr>
                    <td class="nav-icon">
                        <a>
                            <img src="images/icons/nav.mobile.png" alt="nav.mobile" width="19" height="17"/>
                        </a>
                    </td>

                    <td class="logo">
                        <a href="index.php">
                            <img src="images/logo.png" alt="logo" width="104" height="56"/>
                        </a>
                    </td>

                    <td class="search-pin-icon">

                        <a href="cities.php"><img src="images/icons/pin.border.png" alt="pin.border" width="12" height="16"/></a>

                        <a class="search"><img src="images/icons/search.png" alt="search" width="16" height="16"/></a>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <div class="search-bar-mobile nav">

        <div class="container">

            <div class="twelve columns s-margin">
                <form action="search.php">
                    <input type="text" name="q"/>
                    <input type="reset" value=" "/>
                </form>
                <a class="btn-radius border h4 close">Cancel</a>
            </div>
        </div>

        <div class="search-result-proposal"><ul></ul></div>

    </div>

</header>