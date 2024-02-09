/*---------------------------------------------
Template name :  Foodbook
Version       :  1.0
Author        :  ThemeLooks
Author url    :  http://themelooks.com

[Table of Content]

    01: Home Banner Slider
    02: Video Popup
    03: Contact Info Svg
    04: Testimonial Slider
    05: Brand Logo Slider
    06: Project Isotope
    07: Counter up
    08: Team Svg
    09: Blog Slider
    10: Map
----------------------------------------------*/

( function( $ ) {
	"use strict";

	/*===================
    01: Home Banner Slider
    =====================*/
	var FoodbookSlider = function( $scope, $ ) {
		/*========================
	    01: Banner Slider
	    ==========================*/
	    var $bannerSlider = $scope.find('.banner_slider');

		/*==================================
	    01: Check Data
	    ====================================*/
	    var checkData = function (data, value) {
	        return typeof data === 'undefined' ? value : data;
	    };
		/*==================================
		06: Owl Carousel
		====================================*/
		var $owlCarousel = $scope.find('.banner_slider.owl-carousel');
		$owlCarousel.owlCarousel({
			items: checkData($owlCarousel.data('owl-items'), 1),
			margin: checkData($owlCarousel.data('owl-margin'), 0),
			loop: checkData($owlCarousel.data('owl-loop'), true),
			smartSpeed: 450,
			autoplay: checkData($owlCarousel.data('owl-autoplay'), true),
			autoplayTimeout: checkData($owlCarousel.data('owl-speed'), 8000),
			center: checkData($owlCarousel.data('owl-center'), false),
			animateIn: checkData($owlCarousel.data('owl-animate-in'), false),
			animateOut: checkData($owlCarousel.data('owl-animate-out'), false),
			nav: checkData($owlCarousel.data('owl-nav'), false),
			navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
			dots: checkData($owlCarousel.data('owl-dots'), false),
			responsive: checkData($owlCarousel.data('owl-responsive'), {})
		});
	};

	// Make sure you run this code under Elementor.
	$( window ).on( 'elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/sfoodbooksliderwidget.default', FoodbookSlider );
	} );


	/*===================
    02: Category Slider
    =====================*/
	var FoodbookCategorySlider = function( $scope, $ ) {

	    var checkData = function (data, value) {
	        return typeof data === 'undefined' ? value : data;
	    };
		/*==================================
		06: Owl Carousel
		====================================*/
		var $owlCarousel = $scope.find('.category-slider.owl-carousel');
		$owlCarousel.owlCarousel({
			items: checkData($owlCarousel.data('owl-items'), 1),
			margin: checkData($owlCarousel.data('owl-margin'), 0),
			loop: checkData($owlCarousel.data('owl-loop'), true),
			smartSpeed: 450,
			autoplay: checkData($owlCarousel.data('owl-autoplay'), true),
			autoplayTimeout: checkData($owlCarousel.data('owl-speed'), 8000),
			center: checkData($owlCarousel.data('owl-center'), false),
			animateIn: checkData($owlCarousel.data('owl-animate-in'), false),
			animateOut: checkData($owlCarousel.data('owl-animate-out'), false),
			nav: checkData($owlCarousel.data('owl-nav'), false),
			navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
			dots: checkData($owlCarousel.data('owl-dots'), false),
			responsive: checkData($owlCarousel.data('owl-responsive'), {})
		});

	};

	// Make sure you run this code under Elementor.
	$( window ).on( 'elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/foodbookcategoryslider.default', FoodbookCategorySlider );
	} );



	/*===================
	02: Testimonial Slider
	=====================*/
	var FoodbookTestimonialSlider = function( $scope, $ ) {

		var checkData = function (data, value) {
			return typeof data === 'undefined' ? value : data;
		};
		/*==================================
		06: Owl Carousel
		====================================*/
		var $owlCarousel = $scope.find('.testimonial-slider.owl-carousel');

		$owlCarousel.owlCarousel({
			items: checkData($owlCarousel.data('owl-items'), 2),
			margin: checkData($owlCarousel.data('owl-margin'), 30),
			loop: checkData($owlCarousel.data('owl-loop'), true),
			smartSpeed: 450,
			mouseDrag: checkData($owlCarousel.data('owl-mousedrag'), false),
			autoplay: checkData($owlCarousel.data('owl-autoplay'), true),
			autoplayTimeout: checkData($owlCarousel.data('owl-speed'), 8000),
			center: checkData($owlCarousel.data('owl-center'), false),
			animateIn: checkData($owlCarousel.data('owl-animate-in'), false),
			animateOut: checkData($owlCarousel.data('owl-animate-out'), false),
			nav: checkData($owlCarousel.data('owl-nav'), false),
			navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
			dots: checkData($owlCarousel.data('owl-dots'), false),
			responsive: checkData($owlCarousel.data('owl-responsive'), {
				0:{
				  items: 1
				},
				769:{
				  items: 2
				}
			})
		});


	};

	// Make sure you run this code under Elementor.
	$( window ).on( 'elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/foodbooktestimonialwidget.default', FoodbookTestimonialSlider );
	} );

	/*========================
	10: Map
	==========================*/
	var FoodbookMap = function( $scope, $ ) {
		var $map2 = $scope.find('#map-data-center');
		let $mapmarker = $map2.data('marker');
		if( $map2.length ){
			var setMap = function () {
				var map = new google.maps.Map($map2[0], {
					center: { lat: $map2.data('map-latitude'), lng: $map2.data('map-longitude') },
					zoom: $map2.data('map-zoom'),
					scrollwheel: false,
					disableDefaultUI: true,
					zoomControl: true,
					styles: [
						{
							"featureType": "water",
							"elementType": "geometry",
							"stylers": [
								{
									"color": "#e9e9e9"
								},
								{
									"lightness": 17
								}
							]
						},
						{
							"featureType": "landscape",
							"elementType": "geometry",
							"stylers": [
								{
									"color": "#f5f5f5"
								},
								{
									"lightness": 20
								}
							]
						},
						{
							"featureType": "road.highway",
							"elementType": "geometry.fill",
							"stylers": [
								{
									"color": "#ffffff"
								},
								{
									"lightness": 17
								}
							]
						},
						{
							"featureType": "road.highway",
							"elementType": "geometry.stroke",
							"stylers": [
								{
									"color": "#ffffff"
								},
								{
									"lightness": 29
								},
								{
									"weight": 0.2
								}
							]
						},
						{
							"featureType": "road.arterial",
							"elementType": "geometry",
							"stylers": [
								{
									"color": "#ffffff"
								},
								{
									"lightness": 18
								}
							]
						},
						{
							"featureType": "road.local",
							"elementType": "geometry",
							"stylers": [
								{
									"color": "#ffffff"
								},
								{
									"lightness": 16
								}
							]
						},
						{
							"featureType": "poi",
							"elementType": "geometry",
							"stylers": [
								{
									"color": "#f5f5f5"
								},
								{
									"lightness": 21
								}
							]
						},
						{
							"featureType": "poi.park",
							"elementType": "geometry",
							"stylers": [
								{
									"color": "#dedede"
								},
								{
									"lightness": 21
								}
							]
						},
						{
							"elementType": "labels.text.stroke",
							"stylers": [
								{
									"visibility": "on"
								},
								{
									"color": "#ffffff"
								},
								{
									"lightness": 16
								}
							]
						},
						{
							"elementType": "labels.text.fill",
							"stylers": [
								{
									"saturation": 36
								},
								{
									"color": "#333333"
								},
								{
									"lightness": 40
								}
							]
						},
						{
							"elementType": "labels.icon",
							"stylers": [
								{
									"visibility": "off"
								}
							]
						},
						{
							"featureType": "transit",
							"elementType": "geometry",
							"stylers": [
								{
									"color": "#f2f2f2"
								},
								{
									"lightness": 19
								}
							]
						},
						{
							"featureType": "administrative",
							"elementType": "geometry.fill",
							"stylers": [
								{
									"color": "#fefefe"
								},
								{
									"lightness": 20
								}
							]
						},
						{
							"featureType": "administrative",
							"elementType": "geometry.stroke",
							"stylers": [
								{
									"color": "#fefefe"
								},
								{
									"lightness": 17
								},
								{
									"weight": 1.2
								}
							]
						}
					]
				});

				if (typeof $map2.data('map-marker') !== 'undefined') {
					var data = $map2.data('map-marker'),
						i = 0;

					for (i; i < data.length; i++) {
						new google.maps.Marker({
							position: { lat: data[i][0], lng: data[i][1] },
							map: map,
							animation: google.maps.Animation.DROP,
							draggable: true,
							icon: $mapmarker
						});
					}
				}
			};
		}
		if ($map2.length) {
			$map2.css('height', 640);

			setMap();
		}
	};

	// Make sure you run this code under Elementor.
	$( window ).on( 'elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/sfoodbookmapwidget.default', FoodbookMap );
	} );

} )( jQuery );
