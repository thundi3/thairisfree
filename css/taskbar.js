$(document).ready(function(){



	//Adjust panel height

	$.fn.adjustPanel = function(){ 

		$(this).find("ul, .subpanel").css({ 'height' : 'auto'}); //Reset subpanel and ul height

		

		var windowHeight = $(window).height(); //Get the height of the browser viewport

		var panelsub = $(this).find(".subpanel").height(); //Get the height of subpanel	

		var panelAdjust = windowHeight - 100; //Viewport height - 100px (Sets max height of subpanel)

		var ulAdjust =  panelAdjust - 25; //Calculate ul size after adjusting sub-panel (27px is the height of the base panel)

		

		if ( panelsub >= panelAdjust ) {	 //If subpanel is taller than max height...

			$(this).find(".subpanel").css({ 'height' : panelAdjust }); //Adjust subpanel to max height

			$(this).find("ul").css({ 'height' : ulAdjust}); //Adjust subpanel ul to new size

		}

		else if ( panelsub < panelAdjust ) { //If subpanel is smaller than max height...

			$(this).find("ul").css({ 'height' : 'auto'}); //Set subpanel ul to auto (default size)

		}

	};

	

	//Execute function on load

	$("#chatpanel").adjustPanel(); //Run the adjustPanel function on #chatpanel

	$("#alertpanel").adjustPanel(); //Run the adjustPanel function on #alertpanel

	

	//Each time the viewport is adjusted/resized, execute the function

	$(window).resize(function () { 

		$("#chatpanel").adjustPanel();

		$("#alertpanel").adjustPanel();

	});

	

	//Click event on Chat Panel + Alert Panel	

	$("#chatpanel a:first, #alertpanel a:first").click(function() { //If clicked on the first link of #chatpanel and #alertpanel...

		if($(this).next(".subpanel").is(':visible')){ //If subpanel is already active...

			$(this).next(".subpanel").hide(); //Hide active subpanel

			$("#footpanel li a").removeClass('active'); //Remove active class on the subpanel trigger

		}

		else { //if subpanel is not active...

			$(".subpanel").hide(); //Hide all subpanels

			$(this).next(".subpanel").toggle(); //Toggle the subpanel to make active

			$("#footpanel li a").removeClass('active'); //Remove active class on all subpanel trigger

			$(this).toggleClass('active'); //Toggle the active class on the subpanel trigger

		}

		return false; //Prevent browser jump to link anchor

	});

	

	//Click event outside of subpanel

	$(document).click(function() { //Click anywhere and...

		$(".subpanel").hide(); //hide subpanel

		$("#footpanel li a").removeClass('active'); //remove active class on subpanel trigger

	});

	$('.subpanel ul').click(function(e) { 

		e.stopPropagation(); //Prevents the subpanel ul from closing on click

	});

	

	//Delete icons on Alert Panel

	$("#alertpanel li").hover(function() {

		$(this).find("a.delete").css({'visibility': 'visible'}); //Show delete icon on hover

	},function() {

		$(this).find("a.delete").css({'visibility': 'hidden'}); //Hide delete icon on hover out

	});


	

});

