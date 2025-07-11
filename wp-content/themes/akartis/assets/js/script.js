jQuery(function($) {

	// Scroll to top
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

	// menu sticky on scroll
	var trigger = $(window).height() / 3; // 100vh
    $(window).on('scroll', function () {
      if ($(window).scrollTop() >= trigger) {
        $('#main-header').addClass('sticky');
      } else {
        $('#main-header').removeClass('sticky');
      }
    });

	$('a[href^="#"]').on('click', function (e) {
      var target = $($(this).attr('href'));

      if (target.length) {
        e.preventDefault();
        $('html, body').animate({
          scrollTop: target.offset().top
        }, 500);
      }
    });
});