function goto(id, t){	
		$(".contentbox-wrapper").animate({"left": -($(id).position().left)}, 600);
		$(".contentbox-wrapper").animate({"top": -($(id).position().top)}, 600);
		// remove "active" class from all links inside #nav
		$('#nav a').removeClass('active');
		// add active class to the current link
    	$(t).addClass('active');	
		}
