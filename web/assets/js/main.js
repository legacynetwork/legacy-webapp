$(document).ready(function() {
	'use strict';

	var $window = $(window),
		$body = $('body'),
		$searchWrapper = $('#main-search-input-wrapper'),
		$container = $('#masonry');

	function adaptToScreenSize() {
		$body.toggleClass('compact', $window.width() <= 1200);
		$body.toggleClass('mobile', $window.width() <= 768);
	}

	$('.js-cloak').removeClass('js-cloak');

	adaptToScreenSize();
	$searchWrapper.hide();

	/* ======= Activate Bootstrap tooltip and popover ======= */
	$('[data-toggle="tooltip"]').tooltip({container: 'body'});
	$('[data-toggle="popover"]').popover({container: 'body'});

	/* ======= metisMenu ======= */
	/* ref: https://github.com/onokumus/metisMenu */
	$('#menu').metisMenu();

	/* ======= Fixed Header animation ======= */

	$window
		.on('scroll', function() {
			 if ($window.scrollTop() > 0 ) {
				 $('#header').addClass('header-change');
			 }
			 else {
				 $('#header').removeClass('header-change');
			 }
		})
		.on('resize', adaptToScreenSize)
		.on('load', function() {
			$body.removeClass('preload');
		});

	/* ======= Toggle between Signup & Login Modals ======= */
	$('#signup-link').on('click', function(e) {
		$('#signup-modal').modal();
		$('#login-modal').modal('toggle');
		e.preventDefault();
	});

	$('#login-link').on('click', function(e) {
		$('#login-modal').modal();
		$('#signup-modal').modal('toggle');
		e.preventDefault();
	});

	


	/* ======= Main Navigation ======= */

	$('#main-nav-toggle').click(function() {
		$body.toggleClass('nav-toggled');
	});


	/* ====== Side Panel ======= */
	$('#side-panel-toggle').click(function(){
		if($(this).hasClass('panel-show')){
		$("#side-panel").animate({
		  right: "-=320" //same as the panel width
		  }, 500);
		  $(this).removeClass('panel-show').addClass('panel-hide')
		}
		else {
		$("#side-panel").animate({
		  right: "+=320" //same as the panel width
		  }, 500);
		  $(this).removeClass('panel-hide').addClass('panel-show');
		  $(this).tooltip('hide');
		}
	});

	// Close the panel by clicking the close button
	$('#side-panel .close').on('click', function(){
		$('#side-panel-toggle.panel-show').click();
	});


	/* ======= Fullscreen Modal ======= */
	$('#modal-view-controller').on('click', function(){
		$(this).closest('.modal').toggleClass('modal-fullscreen');
	});

	

	/* ===== Top Alert Close ======= */
	$('#top-alert-close').on('click', function(){
		$(this).closest('#top-alert').slideUp();
	});

	/* ========= Misc ========  */
	$('.cursor-pointer').on('click', function() {
		$(this)
		.closest('.input-group-icon-click')
		.find('input')
		.focus();
	});
});
