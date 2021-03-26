$(document).ready(function () {
    /*
	$(window).scroll(function () {
        if ($(document).scrollTop() > 0.1) {
            var parentwidth = $("nav").width();
            $("nav").addClass("scrolled").width(parentwidth);
        } else {
            $("nav").removeClass("scrolled");
			$("nav").removeAttr('style');
        }
    });
	*/
	
	// setting div size to the window height automatically!
	//$('.window-adjust').css('height', $(window).height() - 250);
});

$(window).resize(function(){
	//$('.window-adjust').css('height', $(window).height() - 250);
});

function button_click(btn){
    $.ajax({
        type : "POST",
        url  : window.location.href,
        data : {
            currency_id : btn.value
        },
        success: function(res){
            $("#custom-modal").append(res); //TODO: figure this shit
        }
    });

}