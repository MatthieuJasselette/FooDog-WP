jQuery(document).ready(function($) {

	var options = {
		speed: 500,
		autoswitch: true,
		autoswitch_speed: 4500
	}

	
	$('.slidy').first().addClass('active');

	
	$('.slidy').hide();

	
	$('.active').show();

	
	$('#next').on('click', nextSlide);

	
	$('#prev').on('click', prevSlide);

	
	if (options.autoswitch === true) {
		setInterval(nextSlide, options.autoswitch_speed);
	}

	function nextSlide() {
		$('.active').removeClass('active').addClass('prevActive');		

		if ($('.prevActive').is(':last-child')) {		
			$('.slidy').first().addClass('active');
		} else {										
			$('.prevActive').next().addClass('active');
		}

		$('.prevActive').removeClass('prevActive');		
		$('.slidy').fadeOut(options.speed);				
		$('.active').fadeIn(options.speed);				
	}

	function prevSlide() {
		$('.active').removeClass('active').addClass('prevActive');		

		if ($('.prevActive').is(':first-child')) {		
			$('.slidy').last().addClass('active');
		} else {										
			$('.prevActive').prev().addClass('active');
		}
		
		$('.prevActive').removeClass('prevActive');		
		$('.slidy').fadeOut(options.speed);				
		$('.active').fadeIn(options.speed);		
	}

});