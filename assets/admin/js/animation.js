if(m = /([^\/]+)$/.exec(window.location.href)){
	switch(m[0]) {
		case 'extra_page_fadeIn.html':
			SetupBodyBringToViewAnimation("fadeIn");
			break;
		case 'extra_page_rotateInLeft.html':
			SetupBodyBringToViewAnimation("rotateInLeft");
			break;	
		case 'extra_page_whirlIn.html':
			SetupBodyBringToViewAnimation("whirlIn");
			break;	
		case 'extra_page_slideInSkew.html':
			SetupBodyBringToViewAnimation("slideInSkew");
			break;				
		case 'extra_page_tumbleIn.html':
			SetupBodyBringToViewAnimation("tumbleIn");				
			break;
		case 'extra_page_expandIn.html':
			SetupBodyBringToViewAnimation("expandIn");				
			break;
		case 'extra_page_fallFromTop.html':
			SetupBodyBringToViewAnimation("fallFromTop");
			break;			
	}
}