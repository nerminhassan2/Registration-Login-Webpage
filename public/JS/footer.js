$(window).scroll(function(event) {
	function footer()
    {
        var scroll = $(window).scrollTop();
        if(scroll > 750)
        { 
            $(".footer-nav").fadeIn("slow").addClass("show");
        }
        else
        {
            $(".footer-nav").fadeOut("slow").removeClass("show");
        }
    }
    footer();
});
