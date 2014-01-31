$(function() {
	$('.site-search').focus( function() {
  		$(this).addClass('active');
	});

	$('.site-search').blur( function() {
	  $(this).removeClass('active');
	});
});