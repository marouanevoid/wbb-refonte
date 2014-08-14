
/*
* Pop In 
* JavaScript Class to Manage the PopIn
By VOID
***/
// Global Object Popin
window.PopIn = {}

PopIn.dom = {};
PopIn.loading = false;
// Initialize the Context
PopIn.initContext = function(){
	PopIn.dom = {
        loader : $('.popin-loader-gif'),
		clsloader : 'popin-loader-gif',
		mask : $('.mask'),
		close : $(".btn-close"),
        popin : $('.popup'),
		targetPopup : $('#register')
	}

	// Hide elements
	PopIn.dom.mask.hide();
}

// Close the Popin
PopIn.close = function(){
    // if the popin is not yet loaded
    // return 
    if(PopIn.loading == true)
        return false;
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

        //show lightbox window
        current_id.fadeIn("slow");

        // Add class to trigger ID
        current_id.addClass('void-popup');

        //Scroll to the popup just if is mobile
        /*
        if (current_id.hasClass("mobile")) {
            $(document).animate({
                scrollTop: PopIn.dom.targetPopup.offset().top},
            'slow');
        }
        */
        
        //show the mask
        mask.css("height", $(document).height());
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
        "top": (($(window).height() - current_id.height()) / 2), //+ $(window).scrollTop(),
        "left": (($(window).width() - current_id.width()) / 2) //+ $(window).scrollLeft()
    });
}

// init the Popin Loader
PopIn.initPopinLoader = function(){
    // var html = '<div class="popin-loader-gif"></div>';
    // $('body').append(html);
    // PopIn.resize($('.popin-loader-gif'));
}


// Show Loader
PopIn.showLoader = function(status){
    if(status){
        //PopIn.dom.loader.show();
        PopIn.dom.mask.addClass(PopIn.dom.clsloader);
    }else{
        //PopIn.dom.loader.hide();
        PopIn.dom.mask.removeClass(PopIn.dom.clsloader);
    }
}

// Init the Popin 
PopIn.init = function(){
	// Entry Point
    PopIn.initPopinLoader();
	PopIn.initContext();
	PopIn.initEvents();
}

// Start Loading Popin
PopIn.startLoading = function(){
    PopIn.loading = true;
    PopIn.dom.mask.show();

    // hide the Popin
    PopIn.dom.popin.hide();
    PopIn.showLoader(true);

    console.log('start Loading');
}

// end Loading Popin
PopIn.endLoading = function(){
    PopIn.loading = false;
    // show the Popin
    PopIn.dom.popin.show();
    PopIn.showLoader(false);

    console.log('end Loading');
}

$(function(){
	// On  dom is Ready
	PopIn.init();
});
