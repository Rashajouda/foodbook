/*---------------------------------------------
Template name :  SeoBiz
Version       :  1.0
Author        :  ThemeLooks
Author url    :  http://themelooks.com

NOTE:
------
Please DO NOT EDIT THIS JS, you may need to use "custom.js" file for writing your custom js.
We may release future updates so it will overwrite this file. it's better and safer to use "custom.js".

[Table of Content]

    01: Main Menu
    02: Sticky Nav
    03: Background Image
    04: Blog Isotope
    05: Changing svg color
    06: Preloader
    07: Contact Form
    08: Back to top button
----------------------------------------------*/


(function ($) {
    "use strict";

    /*===================
    01: Main Menu
    =====================*/
    $('ul.nav li a[href="#"]').on('click', function (event) {
        event.preventDefault();
    });

    /* Menu Maker */
    $(".nav-wrapper").menumaker({
        title: '<span></span>',
        format: "multitoggle"
    });

    $(window).on('scroll', function () {
        if (!$('ul.nav').hasClass('open')) {
            $('#menu-button').removeClass('menu-opened');
        };
    });

    $('.header .mobile_menu').find(".menu-item-has-children").prepend('<span class="submenu-button"></span>');
    $('.header .mobile_menu').find(".submenu-button").on("click", function(event){
        $(this).toggleClass("sub-menu-oppened");
        if ($(this).siblings('ul').hasClass('open')) {
            $(this).siblings('ul').removeClass('open').slideUp('200');
        } else {
            $(this).siblings('ul').addClass('open').slideDown('200');
        }
    });

    $('.mobile_menu').hide()
    $('.mobile_menu-button').on('click', function() {
        $('.mobile_menu').slideToggle('fast')
    })

    if ($(window).width() >= 992) {
        let $trigger = $('.menu-trigger');
        $trigger.on('click', function () {
            $(this).toggleClass('active');
            $('.main-menu-wrapper').toggleClass('show');
            $('.logo-holder').toggleClass('d-none');

            $('.nav-wrapper').toggleClass('active');
        })
    }

    /*========================
    02: Sticky Nav
    ==========================*/
    $(window).on("scroll", function () {
        var scroll = $(window).scrollTop();
        if (scroll < 100) {
            $(".header-main, .header-main2").removeClass("sticky fadeInDown animated");
        }
        else {
            $(".header-main, .header-main2").addClass("sticky fadeInDown animated");
        }
    });

    /*========================
    03: Background Image
    ==========================*/
    var $bgImg = $('[data-bg-img]');
    $bgImg.css('background-image', function () {
        return 'url("' + $(this).data('bg-img') + '")';
    }).removeAttr('data-bg-img').addClass('bg-img');

    /*============================================
    04: Blog Isotope
    ==============================================*/
    $( window ).on("load",function(){
        $('.blog-masonary').isotope({
          itemSelector: '.grid-item',
          percentPosition: true,
          animationOptions: {
              duration: 750,
              easing: "linear",
              queue: false
          },
          masonry: {
              columnWidth: '.grid-item'
          }
      });
    });

    /*==================================
    05: Changing svg color
    ====================================*/
    jQuery('img.svg').each(function () {
        var $img = jQuery(this);
        var imgID = $img.attr('id');
        var imgClass = $img.attr('class');
        var imgURL = $img.attr('src');

        jQuery.get(imgURL, function (data) {
            // Get the SVG tag, ignore the rest
            var $svg = jQuery(data).find('svg');

            // Add replaced image's ID to the new SVG
            if (typeof imgID !== 'undefined') {
                $svg = $svg.attr('id', imgID);
            }
            // Add replaced image's classes to the new SVG
            if (typeof imgClass !== 'undefined') {
                $svg = $svg.attr('class', imgClass + ' replaced-svg');
            }

            // Remove any invalid XML tags as per http://validator.w3.org
            $svg = $svg.removeAttr('xmlns:a');

            // Check if the viewport is set, else we gonna set it if we can.
            if (!$svg.attr('viewBox') && $svg.attr('height') && $svg.attr('width')) {
                $svg.attr('viewBox', '0 0 ' + $svg.attr('height') + ' ' + $svg.attr('width'));
            }

            // Replace image with new SVG
            $img.replaceWith($svg);

        }, 'xml');
    });

    /*==================================
    06: Preloader
    ====================================*/
    $(window).on('load', function () {
        $('.preloader').fadeOut(1000);
    });

    /*==================================
    07: Contact Form
    ====================================*/
    $('.contact-form-wrapper').on('submit', 'form', function (e) {
        e.preventDefault();

        var $el = $(this);

        $.post($el.attr('action'), $el.serialize(), function (res) {
            res = $.parseJSON(res);
            $el.parent('.contact-form-wrapper').find('.form-response').html('<span>' + res[1] + '</span>');
        });
    });

    /*============================================
    08: Back to top button
    ==============================================*/
    var $backToTopBtn = $('.back-to-top');

    if ($backToTopBtn.length) {
        var scrollTrigger = 400, // px
            backToTop = function () {
                var scrollTop = $(window).scrollTop();
                if (scrollTop > scrollTrigger) {
                    $backToTopBtn.addClass('show');
                } else {
                    $backToTopBtn.removeClass('show');
                }
            };

        backToTop();

        $(window).on('scroll', function () {
            backToTop();
        });

        $backToTopBtn.on('click', function (e) {
            e.preventDefault();
            $('html,body').animate({
                scrollTop: 0
            }, 700);
        });
    }

    let $anchors = $(".widget_tag_cloud .tagcloud").find("a");
    $anchors.each(function(){
        let value = $(this).html();
        $(this).html('#'+ value );
    });

    /*==================================
    10: Menu Responsive in Small Device
    ====================================*/
    function subMenu() {

        let $subMain = $('.main-menu .nav > .has-sub-item > ul');
        let $subSub = $('.main-menu .nav > .has-sub-item > ul ul');

        $subMain.each(function () {
            if ($(window).width() > 991) {
                if ($(this).offset().left + $(this).width() > $(window).width()) {
                    $(this).css({ 'left': 'auto', 'right': '0' });
                }
            }
        })

        $subSub.each(function () {
            if ($(window).width() > 991) {
                if ($(this).offset().left + $(this).width() > $(window).width()) {
                    $(this).css({ 'left': 'auto', 'right': '100%' });
                    $(this).find('.sub-menu').css({ 'left': 'auto', 'right': '100%' });
                }
            }
        })
    }

    subMenu();

    $(window).resize(subMenu);

}(jQuery));