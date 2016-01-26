/* Style Switcher JS */
(function($) {
	"use strict";
	//Cookies
	function setCookie(cname, cvalue, exdays) {
		var d = new Date();
		d.setTime(d.getTime() + (exdays*24*60*60*1000));
		var expires = "expires="+d.toUTCString();
		document.cookie = cname + "=" + cvalue + "; " + expires;
	}

	function getCookie(cname) {
		var name = cname + "=";
		var ca = document.cookie.split(';');
		for(var i=0; i<ca.length; i++) {
			var c = ca[i];
			while (c.charAt(0)==' ') c = c.substring(1);
			if (c.indexOf(name) != -1) return c.substring(name.length, c.length);
		}
		return "";
	}
	function removeColorClassOf(element){
		$(element).removeClass('green-bg blue-bg orange-bg navy-bg yellow-bg peach-bg red-bg beige-bg pink-bg cyan-bg celadon-bg brown-bg cherry-bg gray-bg purple-bg dark-bg');
	}
	function removeImageClassOf(element){
		$(element).removeClass('bg0 bg1 bg2 bg3 bg4 bg5 bg6 bg7 bg8 bg9 bg10 bg11 bg12 bg13 bg14 bg15 bg16 bg17 bg18 bg19 bg20 bg21 bg22 bg23 bg24 bg25 bg26 bg27 bg28 bg29 bg30');
	}
	$(window).load(function(){
		var orgWrapperClass = $('.wrapper').attr('class');
		
		//Toggle switcher panel
		$('.stoggler').click(function(){
			if($('.style-switcher').hasClass('open')) {
				$('.style-switcher').removeClass('open');
			} else {
				$('.style-switcher').addClass('open');
			}
		});
		
		//Load layout from cookie
		var pageLayout = getCookie('page_layout');
		if(pageLayout=='full') {
			$('.wrapper').removeClass('box-layout');
			$('.slayout').val('full');
		}
		if(pageLayout=='box') {
			$('.wrapper').addClass('box-layout');
			$('.slayout').val('box');
		}
		//Change layout
		$('.slayout').change(function(){
			$('.slayout option:selected').each(function() {
				if($(this).val()=='box') {
					$('.wrapper').addClass('box-layout');
				}
				if($(this).val()=='full') {
					$('.wrapper').removeClass('box-layout');
				}
				setCookie('page_layout', $(this).val(), 1);
			});
		});
		//Load class from cookie
		var bgClass = getCookie('background_class');
		var bgImageClass = getCookie('backgroundimage_class');
		if(bgClass!='' || bgImageClass!='') {
			$('body').addClass(bgClass);
			$('body').addClass(bgImageClass);
		}
		//Change class
		$('#bgsolid a').each(function(){
			$(this).click(function(event){
				event.preventDefault();
				
				var pageLayout = $('.slayout').val();
				if(pageLayout!='box') {
					$('.wrapper').addClass('box-layout');
					$('.slayout').val('box');
				}
				
				var bgClass = $(this).attr('class');
				
				removeColorClassOf('body');
				
				$('body').addClass(bgClass);
				setCookie('background_class', bgClass, 1);
				setCookie('page_layout', 'box', 1);
			});
		});
		//Change class image
		$('#bg a').each(function(){
			$(this).click(function(event){
				event.preventDefault();
				
				var pageLayout = $('.slayout').val();
				if(pageLayout!='box') {
					$('.wrapper').addClass('box-layout');
					$('.slayout').val('box');
				}
				
				var bgImageClass = $(this).attr('class');
				
				removeImageClassOf('body');
				
				$('body').addClass(bgImageClass);
				setCookie('backgroundimage_class', bgImageClass, 1);
				setCookie('page_layout', 'box', 1);
			});
		});
		//Reset
		$('#resetpreview').click(function(event){
			event.preventDefault();
			
			removeColorClassOf('body');
			removeImageClassOf('body');
			setCookie('background_class', '', 1);
			setCookie('backgroundimage_class', '', 1);
			
			$('.wrapper').removeClass('box-layout');
			$('.wrapper').addClass(orgWrapperClass);
			$('.slayout').val('');
			setCookie('page_layout', '', 1);
		});
	});
})($);