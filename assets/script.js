// Navbar & heading Scrolling Effect
$(function () {
	$(document).scroll(function () {
		var $nav = $(".home_navbar");
		$nav.toggleClass('scrolled', $(this).scrollTop() > $nav.height());
	});
});