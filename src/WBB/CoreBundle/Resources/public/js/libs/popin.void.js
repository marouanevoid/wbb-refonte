
/*
* Pop In 
* JavaScript Class to Manage the PopIn
By VOID
***/
// Global Object Popin
window.PopIn = {}

PopIn.dom = {};

// Initialize the Context
PopIn.initContext = function(){
	PopIn.dom = {
		cible : $(''),
		mask : $('.mask'),
		close : $(".btn-close"),
		popin : $('.popup')
	}

	// Hide elements
	PopIn.dom.mask.hide();
}

// Close the Popin
PopIn.close = function(){
	var current_popup = $("body").find(".void-popup");
    current_popup.fadeOut("fast");
    PopIn.dom.mask.fadeOut("slow", function() {
        current_popup.removeClass("void-popup");
        if (current_popup.hasClass("mobile")) {
            current_popup.attr("class", "popup mobile");
        } else {
            current_popup.attr("class", "popup");
        };
    });
}

// Set Up the Events
PopIn.initEvents = function(){
	// on Resize
	$(window).on('resize' , function(){

	});
	// on Scroll 
	$(window).on('Scroll' , function(){

	});
    // click on the trigger .lightbox
    $('.lighbox').on('click' , PopIn.show);

	// click on the Mask and the btn close
    PopIn.dom.mask.add(PopIn.dom.close).on('click',PopIn.close);

    // add event change on Popin Change
    if(! PopIn.dom.popin.hasClass("mobile") ) {
	    PopIn.dom.popin.on('change' , function(){
	    	PopIn.resize($(this));
	    });
	}


}

// Update PopIn
PopIn.updatePopin = function(){
	PopIn.resize(PopIn.dom.popin);
}

PopIn.show = function(e){
    e.preventDefault();
    //Get clicked link data-show ID of tag to show
    var id_content = $(this).attr("data-show");
    var current_id = $('#' + id_content) ;
    var mask = PopIn.dom.mask;

    if (current_id.length > 0) {

        //Centred popup
        // if (!current_id.hasClass("mobile")) {
        //     PopIn.resize(current_id);
        // }

        //show lightbox window
        current_id.fadeIn("slow");

        // Add class to trigger ID
        current_id.addClass('void-popup');

        //show the mask
        mask.fadeIn("slow");
    } else {
        PopIn.dom.mask.hide();
        current_id.removeClass("void-popup");
    }

    PopIn.dom.popin.change();
}

// Resize the Popin
PopIn.resize = function(target){
    //Centred popup
    var current_id = target;
    current_id.css({
        "top": (($(window).height() - current_id.height()) / 2) + $(window).scrollTop(),
        "left": (($(window).width() - current_id.width()) / 2) + $(window).scrollLeft()
    });
}

PopIn.init = function(){
	// Entry Point
	PopIn.initContext();
	PopIn.initEvents();
}

$(function(){
	// On  dom is Ready
	PopIn.init();
});
