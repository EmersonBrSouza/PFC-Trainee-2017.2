$(document).ready(function () {

   /*  ==========================================
        Navbar effect
        ========================================== */
    (function ($) {
        $(document).ready(function () {

            // hide .navbar first
            //$("nav").hide();

            // fade in .navbar
            $(function () {
                $(window).scroll(function () {

                    // set distance user needs to scroll before we start fadeIn
                    if ($(this).scrollTop() > 350) {
                        $('nav').fadeIn();
                    } else {
                        $('nav').fadeOut();
                    }
                });
            });

        });
    }(jQuery));
});

window.addEventListener('load',function (){
	$('.form-group').addClass('animated zoomIn')
});

$('#confirmar').on('click',function(event) {
	$('.form-group').removeClass('zoomIn')
	$('.form-group').addClass('animated zoomOut')
});