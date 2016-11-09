$(window).resize(function () {
	$(function () 
	{		
    	var $empty = $('#header ul li.empty');
        var FullScreen = $(window).width();
		
        var empty = FullScreen - ($('#header ul li.logo').width() + $('#header ul li.name-software').width() + $('#header ul li.logout').width());		
		$empty.width(empty);
		
		var $bar_action_left = $('#bar-action .left');
		var $bar_action_right = $('#bar-action .right');
		var bar_action_right = FullScreen - $bar_action_left.width();
		$bar_action_right.width(bar_action_right);
			
    	var $navigation = $('#main-menu #navigation');		
		var navigation  = FullScreen -  $('#main-menu #account-status').width();		
		$navigation.width(navigation);	
		
	});
});

$(document).ready(function () {
	$(function () 
	{	
    	var $empty = $('#header ul li.empty');
        var FullScreen = $(window).width();
		
        var empty = FullScreen - ($('#header ul li.logo').width() + $('#header ul li.name-software').width() + $('#header ul li.logout').width());		
		$empty.width(empty);
		
		var $bar_action_left = $('#bar-action .left');
		var $bar_action_right = $('#bar-action .right');
		var bar_action_right = FullScreen - $bar_action_left.width();
		$bar_action_right.width(bar_action_right);
		
    	var $navigation = $('#main-menu #navigation');		
		var navigation  = FullScreen -  $('#main-menu #account-status').width();		
		$navigation.width(navigation);
				
	});
});

