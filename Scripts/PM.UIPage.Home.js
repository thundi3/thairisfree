$(window).resize(function () {
	$(function () 
	{		
		var FullScreen_Height = $(window).height();
		var FullScreen_nHeight = FullScreen_Height - 320;
						
		$('#job-info ul li.job-info-body').height(FullScreen_nHeight); 
		$('#job-info .job-info-body-wrapper').height(FullScreen_nHeight);		
		
	});
});

$(document).ready(function () {
	$(function () 
	{	
		var FullScreen_Height = $(window).height();
		var FullScreen_nHeight = FullScreen_Height - 320;
						
		$('#job-info ul li.job-info-body').height(FullScreen_nHeight); 
		$('#job-info .job-info-body-wrapper').height(FullScreen_nHeight);	
		
	});
});

