$(function () {
    $(document).ready(function(){
		$("[animation]").click(function(e){
			TriggerBodyRemoveFromViewAnimation($(this).attr('animation'), $(this).attr('href'))
            return false;
        });
        var heightDocs = $(document).height() - 51 - 38;
        $('#main-content').css('min-height', heightDocs);
		
        // BEGIN SLIMSCROLL
//        $('.scroller-list').slimScroll({
//            railVisible: true
//        });
//        $('.scroller').slimScroll({
//            "height": "500"
//        });
//        ('.slimScrollDiv').slimScroll({
//            "height": "250"
//        });
//        $('.slimScroll-scroll-visible').slimScroll({
//            "height": "250",
//            "alwaysVisible": true
//        });
//        $('.slimScroll-scroll-rail-visible').slimScroll({
//            "height": "250",
//            "railVisible": true,
//            "alwaysVisible": true
//        });
        // END SLIMSCROLL
		
		

        // BEGIN FULL SCREEN
        $('.btn-fullscreen').click(function() {
						
			  if (!document.fullscreenElement &&    // alternative standard method
				  !document.mozFullScreenElement && !document.webkitFullscreenElement && !document.msFullscreenElement ) {  // current working methods
				if (document.documentElement.requestFullscreen) {
				  document.documentElement.requestFullscreen();
				} else if (document.documentElement.msRequestFullscreen) {
				  document.documentElement.msRequestFullscreen();
				} else if (document.documentElement.mozRequestFullScreen) {
				  document.documentElement.mozRequestFullScreen();
				} else if (document.documentElement.webkitRequestFullscreen) {
				  document.documentElement.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);
				}
			  } else {
				if (document.exitFullscreen) {
				  document.exitFullscreen();
				} else if (document.msExitFullscreen) {
				  document.msExitFullscreen();
				} else if (document.mozCancelFullScreen) {
				  document.mozCancelFullScreen();
				} else if (document.webkitExitFullscreen) {
				  document.webkitExitFullscreen();
				}
			  }
        });
        // END FULL SCREEN

        // BEGIN TOOLTIP
        //$('.tooltips').tooltip();
        // END TOOLTIP

        // BEGIN PORTLET
        $(".portlet").each(function(index, element) {
            var me = $(this);
            $(">.portlet-header>.tools>i", me).click(function(e){
                if($(this).hasClass('fa-chevron-up')){
                    $(">.portlet-body", me).slideUp('fast');
                    $(this).removeClass('fa-chevron-up').addClass('fa-chevron-down');
                }
                else if($(this).hasClass('fa-chevron-down')){
                    $(">.portlet-body", me).slideDown('fast');
                    $(this).removeClass('fa-chevron-down').addClass('fa-chevron-up');
                }
                else if($(this).hasClass('fa-cog')){
                    //Show modal
                }
                else if($(this).hasClass('fa-refresh')){
                    //$(">.portlet-body", me).hide();
                    $(">.portlet-body", me).addClass('wait');

                    setTimeout(function(){
                        //$(">.portlet-body>div", me).show();
                        $(">.portlet-body", me).removeClass('wait');
                    }, 1000);
                }
                else if($(this).hasClass('fa-times')){
                    me.remove();
                }
            });
        });
        // END PORTLET

        // BEGIN THEME SWITCHER
        var setColorTheme = function (color) {
            $.cookie('#color-style', color);
            $('#color-style').attr('href', 'css/themes/' + color + '.css');
        }
        $('ul.color-options > li').click(function () {
            var color = $(this).attr('data-style');
            setColorTheme(color);
            $('ul.color-options > li').removeClass('active');
            $(this).addClass('active');
        });
//        if ($.cookie('#color-style')) {
//            setColorTheme($.cookie('#color-style'));
//            $('ul.color-options > li').removeClass('active');
//            $('ul.color-options').find('li.color-' + $.cookie('#color-style')).addClass('active');
//        }
        // END THEME SWITCHER

        // BEGIN HEADER SWITCHER
        $('#header-option').change(function(){
            if($('#header-option').val() == 'fixed'){
                $('#topbar > .navbar').removeClass('navbar-default');
                $('#topbar > .navbar').addClass('navbar-fixed-top');
                $('#main-container').css('padding-top','50px');
            }
            if($('#header-option').val() == 'default'){
                $('#topbar > .navbar').removeClass('navbar-fixed-top');
                $('#topbar > .navbar').addClass('navbar-default');
                $('#topbar > .navbar.navbar-default').css('margin-bottom','0');
                $('#topbar > .navbar.navbar-default').css('border-width','0');
                $('#main-container').css('padding-top','0');
            }
        });
        // END HEADER SWITCHER

        // BEGIN SIDEBAR SWITCHER
        $('#sidebar-option').change(function(){
            if($('#sidebar-option').val() == 'fixed'){
                $('#sidebar').addClass('position-fixed');
            }
            if($('#sidebar-option').val() == 'default'){
                $('#sidebar').removeClass('position-fixed')
            }
        });
        // END SIDEBAR SWITCHER

        // BEGIN FORM CHAT
        $('.btn-chat').click(function () {
            $('#list-app-form').hide();
            if($('#chat-box').is(':visible')){
                $('#chat-form').toggle('slide', {
                    direction: 'right'
                }, 500);
                $('#chat-box').hide();
            } else{
                $('#chat-form').toggle('slide', {
                    direction: 'right'
                }, 500);
            }

        });
		
		$('.chat-box-close').click(function(){
			$('#chat-box').hide();
            $('#chat-form .chat-group a').removeClass('active');
		});
        $('.chat-form-close').click(function(){
            $('#chat-form').toggle('slide', {
                direction: 'right'
            }, 500);
            $('#chat-box').hide();
        });
		
        $('#chat-form .chat-group a').unbind('*').click(function(){
            $('#chat-box').hide();
            $('#chat-form .chat-group a').removeClass('active');
            $(this).addClass('active');
            var strUserName = $('> small', this).text();
            $('.display-name', '#chat-box').html(strUserName);
            var userStatus = $(this).find('span.user-status').attr('class');
            $('#chat-box > .chat-box-header > span.user-status').removeClass().addClass(userStatus);
            var chatBoxStatus = $('span.user-status', '#chat-box');
            var chatBoxStatusShow = $('#chat-box > .chat-box-header > small');
            if(chatBoxStatus.hasClass('is-online')){
                chatBoxStatusShow.html('Online');
            } else if(chatBoxStatus.hasClass('is-offline')){
                chatBoxStatusShow.html('Offline');
            } else if(chatBoxStatus.hasClass('is-busy')){
                chatBoxStatusShow.html('Busy');
            } else if(chatBoxStatus.hasClass('is-idle')){
                chatBoxStatusShow.html('Idle');
            }


			var offset = $(this).offset();
			var h_main = $('#chat-form').height();
			var h_title = $("#chat-box > .chat-box-header").height();
			var top = ($('#chat-box').is(':visible') ? (offset.top - h_title - 40) : (offset.top + h_title - 20));
			
			if((top + $('#chat-box').height()) > h_main){
				top = h_main - 	$('#chat-box').height();
			}
			
			$('#chat-box').css({'top': top});			
			
			if(!$('#chat-box').is(':visible')){
				$('#chat-box').toggle('slide',{
					direction: 'right'
				}, 500);
			}
        });
        // END FORM CHAT

        // BEGIN LIST APP
        $('.btn-list-app').click(function () {
            $('#chat-form').hide();
            if($('#list-app-form').is(':visible')){
                $('#list-app-form').toggle('slide', {
                    direction: 'right'
                }, 500);
                $(this).children().removeClass('fa-arrow-circle-left').addClass('fa-arrow-circle-right');
            } else{
                $('#list-app-form').toggle('slide', {
                    direction: 'right'
                }, 500);
                $(this).children().removeClass('fa-arrow-circle-right').addClass('fa-arrow-circle-left');
            }

        });
        // END LIST APP

    });
})

