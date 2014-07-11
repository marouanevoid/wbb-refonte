jQuery(document).ready(function($) {
	// Click anywhere on the page to get rid of lightbox window
	$('.mask').hide();
	$('.lighbox').click(function(e) {
		e.preventDefault();
		//Get clicked link data-show ID of tag to show
		var id_content = $(this).attr("data-show");
		var current_id = $("#"+id_content);
		var mask = $(".mask");

		if (current_id.length > 0) {
			//show lightbox window
			current_id.show('slow');
			// Add class to trigger ID
			current_id.addClass('void-popup');
			//show the mask
			mask.show('fast');	
		} else {
			$('.mask').hide();
			current_id.removeClass("void-popup");
		}
	})
	$(".btn-close").click(function(e){
		var current_popup = $(this).closest(".void-popup");
		current_popup.removeClass("void-popup");
		current_popup.hide("fast");
		$(".mask").hide("slow");
	})
});