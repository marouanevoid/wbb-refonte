<article class="tip">
    <div class="content form">
        <form action="tmp/data/addTip.php" id="tips">
            <h3>Leave a tip</h3>
            <textarea class="s-margin-top" name="tip" placeholder="Type your tip ..."></textarea>
            <div class="m-margin-top h4 count">499 left</div>
            <input class="s-margin-top btn-small-radius brown" type="submit" value="Submit"/>
        </form>
        <br class="clear"/>
    </div>
</article>

<script type="text/javascript">
    new meta.Form(
    {
        $form : $('form#tips'),
        onComplete:function($form, data)
        {
            var $count = $form.find(".count");
            var count = $count.text();

            $count.addClass('success').text(data.message);

            $form.get(0).reset();

            setTimeout(function()
            {
                //restore state
                $count.removeClass('success').text(count);

            }, 2000);
        },
        onError:function($form, message)
        {
            var $count = $form.find(".count");
            var count = $count.text();

            $count.addClass('error').text(message);
            $form.find("textarea").addClass('error').focus();

            setTimeout(function()
            {
                //restore state
                $count.removeClass('error').text(count);
                $form.find("textarea").removeClass('error');

            }, 2000);
        }
    })
</script>