(function($){
	$(window).scroll(function() {
		if ($(".navbar").offset().top > 50) {
			$(".navbar-fixed-top").addClass("scroll");
		} else {
			$(".navbar-fixed-top").removeClass("scroll");
		}
	});

	$(document).ready(function() {

		// Toggle Navbar on mobile
		$('.navbar-toggle').on( 'click', function() {
			if ( !$('.nav-menu').hasClass('open') ) {
				$('.nav-menu').slideDown().addClass('open');
			} else {
				$('.nav-menu').slideUp().removeClass('open');
			}
		});

		// Open Modal for Video
		$('.js-video-modal-open ').on('click', function() {
			$('.video-modal-wrapper').addClass('video-modal-open');
		});
		// Close Modal For Video
		$('.js-video-modal-close, .video-modal-wrapper').on('click', function() {
			$('.video-modal-wrapper').removeClass('video-modal-open');
		});

	});

})(jQuery); 