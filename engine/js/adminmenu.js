function setCookie (name, value, expires, path, domain, secure) {
      document.cookie = name + "=" + escape(value) +
        ((expires) ? "; expires=" + expires : "") +
        ((path) ? "; path=" + path : "") +
        ((domain) ? "; domain=" + domain : "") +
        ((secure) ? "; secure" : "");
}
function getCookie(name) {
	var cookie = " " + document.cookie;
	var search = " " + name + "=";
	var setStr = null;
	var offset = 0;
	var end = 0;
	if (cookie.length > 0) {
		offset = cookie.indexOf(search);
		if (offset != -1) {
			offset += search.length;
			end = cookie.indexOf(";", offset)
			if (end == -1) {
				end = cookie.length;
			}
			setStr = unescape(cookie.substring(offset, end));
		}
	}
	return(setStr);
}

function initas () {
	
	ch_array = new Array("news", "newsadd", "statik", "vote", "images", "categories", 
		"users", "usersgroup", "profile", 
		"bannedip", "wfilter", "wsearch", 
		"settings", "db", "banners", "blocks", "theme", "email");

	as = location.href;
    if (as.indexOf("&")==-1 || "news&a=add"==as.substring(as.indexOf("=")+1, as.length) || "news&a=add#"==as.substring(as.indexOf("=")+1, as.length)) mo = as.substring(as.indexOf("=")+1, as.length);
    else mo = as.substring(as.indexOf("=")+1, as.indexOf("&"));
    if (mo.indexOf("#")!=-1) mo = mo.substring(0, mo.length-1);

	if (mo=="news&a=add") mo="newsadd";

    if (mo=="start" || mo=="" || mo==as || mo+"#"==as) {
      document.getElementById("menu-start").className += " has-current-submenu";
	  document.getElementById("menu-start0").className += " current";
    }

	if (ch_array.toString().indexOf(mo)==-1) return;

	time = new Date();
	year = time.getFullYear()+1;
		
	if (mo=="news" || mo=="statik" || mo=="vote" || mo=="images" || mo=="categories" || mo=="newsadd") { 
			document.getElementById("menu-news").className += " has-current-submenu";
			document.getElementById("menu-news0").className += " current";
			
			if (getCookie("menu-news1")=="0" || getCookie("menu-news1")==null) {
				document.getElementById("menu-news").className += " menu-open";
				setCookie("menu-news1", "1", "Mon, 01-Jan-"+year+" 00:00:00 GMT", "/");
			}
	}
	
	if (mo=="users" || mo=="usersgroup" || mo=="profile") { 
			document.getElementById("menu-users").className += " has-current-submenu";
			document.getElementById("menu-users0").className += " current";
			if (getCookie("menu-users1")=="0" || getCookie("menu-users1")==null) {
				document.getElementById("menu-users").className += " menu-open";
				setCookie("menu-users1", "1", "Mon, 01-Jan-"+year+" 00:00:00 GMT", "/");
			}
	}
	
	if (mo=="bannedip" || mo=="wfilter" || mo=="wsearch") { 
			document.getElementById("menu-util").className += " has-current-submenu"; 
			document.getElementById("menu-util0").className += " current";
			if (getCookie("menu-util1")=="0" || getCookie("menu-util1")==null) {
				document.getElementById("menu-util").className += " menu-open";
				setCookie("menu-util1", "1", "Mon, 01-Jan-"+year+" 00:00:00 GMT", "/");
			}
	}
	
	if (mo=="settings" || mo=="db" || mo=="banners" || mo=="blocks" || mo=="theme" || mo=="email") { 
			document.getElementById("menu-settings").className += " has-current-submenu"; 
			document.getElementById("menu-settings0").className += " current";
			if (getCookie("menu-settings1")=="0" || getCookie("menu-settings1")==null) {
				document.getElementById("menu-settings").className += " menu-open";
				setCookie("menu-settings1", "1", "Mon, 01-Jan-"+year+" 00:00:00 GMT", "/");
			}
	}

	document.getElementById(mo).className = "current"; 
	document.getElementById(mo+"0").className = "current"; 
}

(function($){
// sidebar admin menu
adminMenu = {

	init : function() { 
		time = new Date();
		year = time.getFullYear()+1;

		if (getCookie("menu-news1")=="1") document.getElementById("menu-news").className += " menu-open";
		if (getCookie("menu-users1")=="1") document.getElementById("menu-users").className += " menu-open";
		if (getCookie("menu-util1")=="1") document.getElementById("menu-util").className += " menu-open";
		if (getCookie("menu-settings1")=="1") document.getElementById("menu-settings").className += " menu-open";

		initas();
		$('#adminmenu div.menu-toggle').each( function() {
			if ( $(this).siblings('.submenu').length )
				$(this).click(function(){

				    if (getCookie(this.id)=="1") setCookie(this.id, "0", "Mon, 01-Jan-"+year+" 00:00:00 GMT", "/");
					else setCookie(this.id, "1", "Mon, 01-Jan-"+year+" 00:00:00 GMT", "/");

					adminMenu.toggle( $(this).siblings('.submenu') );
					});
			else
				$(this).hide();
		});

		$('#adminmenu li.menu-top .menu-image').click( function() { window.location = $(this).siblings('a.menu-top')[0].href; } );
		this.favorites();

		if (getCookie("fold_menu")=="1" ) adminMenu.fold();
	    else adminMenu.fold(1);

		$('.menu-separator').click(function(){
			if ( $('#content').hasClass('folded') ) {
				adminMenu.fold(1);
			    setCookie("fold_menu", "0", "Mon, 01-Jan-"+year+" 00:00:00 GMT", "/");
			} else {
				adminMenu.fold();
				setCookie("fold_menu", "1", "Mon, 01-Jan-"+year+" 00:00:00 GMT", "/");
			}
		});

	},

	restoreMenuState : function() {
		$('#adminmenu li.has-submenu').each(function(i, e) {
			var v = getUserSetting( 'm'+i );
			if ( $(e).hasClass('has-current-submenu') ) return true; // leave the current parent open

			if ( 'o' == v ) $(e).addClass('menu-open');
			else if ( 'c' == v ) $(e).removeClass('menu-open');
		});
	},

	toggle : function(el) {

		el['slideToggle'](150, function(){el.css('display','');}).parent().toggleClass( 'menu-open' );

		$('#adminmenu li.has-submenu').each(function(i, e) {
			var v = $(e).hasClass('menu-open') ? 'o' : 'c';
		});

		return false;
	},

	fold : function(off) {
		if (off) {
			$('#content').removeClass('folded');
			$('#adminmenu li.has-submenu').unbind();
		} else {
			$('#content').addClass('folded');
			$('#adminmenu li.has-submenu').hoverIntent({
				over: function(e){
					var m = $(this).find('.submenu'), t = e.clientY, H = $(window).height(), h = m.height(), o;

					if ( (t+h+10) > H ) {
						o = (t+h+10) - H;
						m.css({'marginTop':'-'+o+'px'});
					} else if ( m.css('marginTop') ) {
						m.css({'marginTop':''})
					}
					m.addClass('sub-open');
				},
				out: function(){ $(this).find('.submenu').removeClass('sub-open').css({'marginTop':''}); },
				timeout: 220,
				sensitivity: 8,
				interval: 100
			});

		}
	},

	favorites : function() {
		$('#favorite-inside').width($('#favorite-actions').width()-4);
		$('#favorite-toggle, #favorite-inside').bind( 'mouseenter', function(){$('#favorite-inside').removeClass('slideUp').addClass('slideDown'); setTimeout(function(){if ( $('#favorite-inside').hasClass('slideDown') ) { $('#favorite-inside').slideDown(100); $('#favorite-first').addClass('slide-down'); }}, 200) } );

		$('#favorite-toggle, #favorite-inside').bind( 'mouseleave', function(){$('#favorite-inside').removeClass('slideDown').addClass('slideUp'); setTimeout(function(){if ( $('#favorite-inside').hasClass('slideUp') ) { $('#favorite-inside').slideUp(100, function(){ $('#favorite-first').removeClass('slide-down'); } ); }}, 300) } );
	}
};

$(document).ready(function(){adminMenu.init();});
})(jQuery);
