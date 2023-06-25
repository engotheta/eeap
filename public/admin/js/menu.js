$(document).ready(function() {

	$('.menu_dropdown').click(function(){
		$(this).toggleClass('menu_closed').addClass('menu_open');
		$(this).next('.sub_menu').toggle();
	});
	
	var menu = $('.menu_name');
		if(menu.val() === 'footer_menu'){
			$('.for_main_only').hide();
			$('.parent').fadeOut();

			$('#featured').fadeOut();
		}		
		if(menu.val() === 'home_sidebar'){
			$('.not_sidebar').hide();
			$('.parent').show();
			$('#featured').show();
		}		
		if(menu.val() === 'main_nav'){
			$('#featured').fadeOut();
		}

	$('.menu_name').on('change', function(){
				
		if(menu.val() === 'footer_menu'){
    		$('.for_main_only').fadeOut();
    		$('.parent').fadeOut();
    		$('#featured').fadeOut();
		} else {
			$('.for_main_only').fadeIn();
			$('.not_sidebar').show();
			$('#featured').fadeOut();
			$('.parent').show();
		}
		if(menu.val() === 'home_sidebar'){
			$('.not_sidebar').fadeOut();

			$('#featured').show();
			$('.parent').show();
			$('.for_main_only').hide();
		}
	});


});
