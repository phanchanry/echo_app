;(function($){
	$.fn.Menu = function(){};
	$.fn.Menu.setting = {toogle:null, menu:null, content:null, open:true, active:null};
	var $this = $.fn.Menu;
	
	$.fn.Menu.init = function(options){
		$this.setting = $.extend($this.setting, options || {});		
		
		$this.collapse($('>div', $this.setting.menu));
		
		$('ul li.nav-header', $this.setting.menu).hover(function(){
            if($('#sidebar').hasClass('right-sidebar')){
                if(!$this.setting.open){
                    $(this).find('.content').css('right','38px');
                    $(this).find('.content').css('left','auto');
                    $(this).find('ul.submenu').css('right','38px');
                    $(this).find('ul.submenu').css('left','auto');
                    $(this).find('ul.submenu').addClass('show');
                    $(this).find('.content').removeClass('hide');
                    $(this).find('.content').addClass('content-hover');
                    $(this).find('ul.submenu').addClass('submenu-hover');
                    $(this).find('ul.submenu a').addClass('contents-hover');
                }
            } else{
                if(!$this.setting.open){
                    $(this).find('.content').css('right','auto');
                    $(this).find('.content').css('left','38px');
                    $(this).find('ul.submenu').css('right','auto');
                    $(this).find('ul.submenu').css('left','38px');
                    $(this).find('.content').removeClass('hide');
                    $(this).find('.content').addClass('content-hover');
                    $(this).find('ul.submenu').addClass('show');
                    $(this).find('ul.submenu').addClass('submenu-hover');
                    $(this).find('ul.submenu a').addClass('contents-hover');
                }
            }

		},function(){
            if($('#sidebar').hasClass('right-sidebar')){
                if(!$this.setting.open){
                    $(this).find('.content').addClass('hide').removeClass('content-hover');
                    $(this).find('ul.submenu').removeClass('show').removeClass('submenu-hover');
                    $(this).find('ul.submenu a').removeClass('contents-hover');
                }
            } else{
                if(!$this.setting.open){
                    $(this).find('.content').addClass('hide').removeClass('content-hover');
                    $(this).find('ul.submenu').removeClass('show').removeClass('submenu-hover');
                    $(this).find('ul.submenu a').removeClass('contents-hover');
                }
            }
		});

        $('ul li.nav-header .search-toogle').click(function(){
            if($('#sidebar').hasClass('right-sidebar')){
                if($('ul li.nav-header #sidebar-search').hasClass('open')){
                    $('ul li.nav-header #sidebar-search').removeClass('open');
                    $('ul li.nav-header .search-toogle i').removeClass('glyphicon-remove').addClass('glyphicon-search');
                    $('ul li.nav-header #sidebar-search').css('right','auto');
                    $('ul li.nav-header #sidebar-search').css('left','38px');
                } else{
                    $('ul li.nav-header #sidebar-search').addClass('open');
                    $('ul li.nav-header .search-toogle i').removeClass('glyphicon-search').addClass('glyphicon-remove');
                    $('ul li.nav-header #sidebar-search').css('right','38px');
                    $('ul li.nav-header #sidebar-search').css('left','auto');
                }
            } else{
                if($('ul li.nav-header #sidebar-search').hasClass('open')){
                    $('ul li.nav-header #sidebar-search').removeClass('open');
                    $('ul li.nav-header .search-toogle i').removeClass('glyphicon-remove').addClass('glyphicon-search');
                } else{
                    $('ul li.nav-header #sidebar-search').addClass('open');
                    $('ul li.nav-header .search-toogle i').removeClass('glyphicon-search').addClass('glyphicon-remove');
                }
            }
        });
	
		$($this.setting.toogle).unbind('*').click(function(e){
			$this.active();
			$this.toogle();			
		});
	};
	
	$.fn.Menu.collapse = function(el){
		$('>ul>li', el).each(function(index, li){
			$this.collapse(li);
			
			$(">a", li).unbind('*').click(function(e){				
				var current = $('>ul', li);
				if(current.length>0){
					var active = $('>ul>li>ul:visible', el);
					if(active.length>0 && active!=current){
						active.collapse('hide');
					}				
					current.collapse((current.is(':visible') ? 'hide' : 'show'));
									
					return false;
				}
				else{
					$(">a", li).removeClass('active');
					$(this).addClass('active');
				}
			});    
        });
	};
	
	$.fn.Menu.active = function(){
		if($this.setting.open){
			var active = $('>div>ul>li>ul:visible', $this.setting.menu);
			$this.setting.active = (active.length>0) ? active : null;
		}
	};
	
	$.fn.Menu.toogle = function(){
        if($('#sidebar').hasClass('right-sidebar')){
            $('#main-content').addClass('mln');
            if($this.setting.open){
                w = '38px';
                if($this.setting.active){
                    $this.setting.active.addClass('hide');
                }

                $('ul .content', $this.setting.menu).addClass('hide');
                $this.setting.open = false;

                $('ul li.nav-header .search-toogle').css('display','block');
                $('ul li.nav-header #sidebar-search').css('display','none');
            }
            else{
                w = '225px';
                if($this.setting.active){
                    $this.setting.active.removeClass('hide');
                }

                $('ul .content', $this.setting.menu).removeClass('hide');
                $this.setting.open = true;

                $('ul li.nav-header .search-toogle').css('display','none');
                $('ul li.nav-header #sidebar-search').css('display','block');

                $('ul li.nav-header #sidebar-search').removeClass('open');
                $('ul li.nav-header .search-toogle i').removeClass('glyphicon-remove').addClass('glyphicon-search');

            }
            $($this.setting.menu).css('width', w)/*.css('transition','all 0.1s ease')*/;
            $($this.setting.content).css('margin-right', w)/*.css('transition','all 0.1s ease')*/;
        } else{
            if($this.setting.open){
                w = '38px';
                if($this.setting.active){
                    $this.setting.active.addClass('hide');
                }

                $('ul .content', $this.setting.menu).addClass('hide');
                $this.setting.open = false;

                $('ul li.nav-header .search-toogle').css('display','block');
                $('ul li.nav-header #sidebar-search').css('display','none');
            }
            else{
                w = '225px';
                if($this.setting.active){
                    $this.setting.active.removeClass('hide');
                }

                $('ul .content', $this.setting.menu).removeClass('hide');
                $this.setting.open = true;

                $('ul li.nav-header .search-toogle').css('display','none');
                $('ul li.nav-header #sidebar-search').css('display','block');

                $('ul li.nav-header #sidebar-search').removeClass('open');
                $('ul li.nav-header .search-toogle i').removeClass('glyphicon-remove').addClass('glyphicon-search');

            }
            $($this.setting.menu).css('width', w)/*.css('transition','all 0.1s ease')*/;
            $($this.setting.content).css('margin-left', w)/*.css('transition','all 0.1s ease')*/;
        }



	};
})(jQuery);
$(document).ready(function(){
	$.fn.Menu.init({toogle:'#menu-toogle', menu:'#sidebar', content:'#main-content'});
});