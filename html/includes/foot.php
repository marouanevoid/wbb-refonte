        <?php if( $is_mobile ): ?>
            <?php include('includes/mobile/footer.php') ?>
        <?php else: ?>
            <?php include('includes/footer.php') ?>
        <?php endif ?>

        </div>
    </div>

    <div id="fb-root"></div>

    <script type="text/javascript">

        $(document).ready(function()
        {
            //facebook
            (function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) return;
                js = d.createElement(s); js.id = id;
                js.src = "//connect.facebook.net/fr_FR/sdk.js#xfbml=1&version=v2.0";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));

            //twitter
            !function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');
        })

    </script>

</body>
</html>