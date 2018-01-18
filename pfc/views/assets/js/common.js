$(document).ready(function($) {
	$(window).scroll(function(event) {
		if($(this).scrollTop() > 45){
			$('#logo1').addClass('d-none').removeClass('d-inline animated pulse');
			$('#logo2').addClass('d-inline animated jello').removeClass('d-none');
		}else{
			$('#logo1').addClass('d-inline animated pulse').removeClass('d-none');
			$('#logo2').addClass('d-none').removeClass('d-inline animated jello');
		}
	});
	
	$("#link-pontuacao").click(function() {
    var offset = 80; 

    $('html, body').animate({
        	scrollTop: $("#pontuacao").offset().top - offset
    	}, 1000);
	});
});