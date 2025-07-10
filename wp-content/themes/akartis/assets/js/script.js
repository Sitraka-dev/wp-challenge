jQuery(function($) {

    var scrollToTop = $(".scroll-to-top");
    
    $(window).on("scroll", function () {
		if ($(this).scrollTop() > 100) {
			scrollToTop.addClass("show");
		} else {
			scrollToTop.removeClass("show");
		}
	});

	$("#scroll-to-top-btn").on("click", function (e) {
		e.preventDefault();
		$("body, html").animate({ scrollTop: 0 });
	});
});