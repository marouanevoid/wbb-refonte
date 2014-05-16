
$(document).ready(function()
{
    new metabolism.Ratio({max_width:1200,min_width:1024, default_width:1200});
    var is_ie7 = $('html').hasClass('ie7');
});

$(window).load(function()
{
    $("body").removeClass("loading").addClass("loaded");
});