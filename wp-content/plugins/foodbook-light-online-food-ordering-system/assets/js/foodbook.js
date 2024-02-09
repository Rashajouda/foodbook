/*---------------------------------------------
Template name :  fb
Version       :  1.0
Author        :  ThemeLooks
Author url    :  http://themelooks.com

NOTE:
------
Please DO NOT EDIT THIS JS, you may need to use "custom.js" file for writing your custom js.
We may release future updates so it will overwrite this file. it's better and safer to use "custom.js".

[Table of Content]

    01: SVG Image
    02: Top 50
----------------------------------------------*/

(function ($) {
    "use strict";

    var i, m, a, admin = {};

    i = {

        catSlug: "",
        taxonomy: "",
        options: {},

        init: function () {

            var $this = this;

            $this.getProducts();
            $this.allGetItems();
            $this.getProductByPaginate();
            $this.getProductByCategories();
            $this.getProductByTaxonomy();
            a.sendMail();


        },
        getProducts: function () {

            $.ajax({
                type: "POST",
                url: foodbookobj.ajaxurl,
                data: {
                    action: "woo_products_view",
                    catSlug: this.options.catSlug,
                    taxonomy: this.options.taxonomy,
                    page: this.options.page

                },
                beforeSend: function () {
                    $('.foodbook-products').html(a.lodingMarkup());
                },
                success: function (res) {

                    $('.foodbook-products').append(res);
                    // 
                    a.lodingRemove();


                }

            });

        },
        getProductByPaginate: function () {

            var $this = this;

            $(document).on('click', '[data-page-number]', function () {

                var $v = $(this).data('page-number');

                $(this).addClass('active');

                $this.options = {
                    catSlug: $this.catSlug,
                    taxonomy: $this.taxonomy,
                    page: $v

                }

                $this.getProducts();

            });

        },
        getProductByCategories: function () {

            var $this = this;

            $('[name="fb_product_category"]').on('change', function () {

                var $v = $(this).val();

                $this.catSlug = $v;
                $this.taxonomy = "category";

                $this.options = {
                    catSlug: $v,
                    taxonomy: $this.taxonomy,
                    page: 1

                }

                $this.getProducts();


            })

        },
        getProductByTaxonomy: function () {

            var $this = this;

            $('[name="fb_product_specialoffer"]').on('change', function () {

                var $v = $(this).val();

                $this.catSlug = $v;
                $this.taxonomy = "specialoffer";

                $this.options = {
                    catSlug: $v,
                    taxonomy: $this.taxonomy,
                    page: 1

                }

                $this.getProducts();


            })

        },
        allGetItems: function () {

            var $this = this;

            $(document).on('click', '.all_items', function () {

                $this.catSlug = "";
                $this.taxonomy = "";

                $this.options = {
                    catSlug: $this.catSlug,
                    taxonomy: $this.taxonomy,
                    page: 1

                }

                $this.getProducts();

                $('.fb_custom_checkbox input').removeAttr('checked');


            })

        }
       

    }

    //
    m = {

        cartBackBtn: false,
        openModal: false,
        isCartModal: false,
        productId: "",
        isVerifiedOwner: "",

        init: function () {

            var $this = this;

            $this.fbClosePopup();
            $this.modalOpen();
            $this.addToCart();
            $this.cartTemplate();
            $this.checkoutLoginRegisterTemplate();
            $this.placeOrder();
            $this.login();
            $this.register();
            $this.addCouponcode();
            $this.removeCouponcode();
            $this.shippingMethod();
            $this.cartBack();
            $this.cartCountBtn();
            $this.reviewBack();
            $this.productReview();

            //
            a.quantityPlusMinusEvent();


        },
        cartCountBtn: function () {

            var $this = this;
            
            $(document).on('click', '.fb_cart_count_btn', function (e) {

                e.preventDefault();
            
                if( !$this.isCartModal ) {

                    $this.isCartModal = true;

                    // check is Modal already open
                    if( !$this.openModal ) {
                        $this.modalTemplate();
                        $this.fbOpenPopUp();

                    }
                   
                    // Hide product info modal
                    $('.step-product-info').hide();
                    //
                    $('.step-reviews').hide();
                    // Show cart modal
                    $this.getCartItems();
                    // Active Tab                
                    a.tabDeactive();
                    a.tabActive('.fb_viewcart_tab');

                    var $productTab = $('.fb_product_tab');
                    $productTab.hide();
                    $productTab.next().hide();

                }


            })

        },
        modalOpen: function () {

            var $this = this;

            $(document).on('click', '.fb_order_cart_button', function (e) {

                e.preventDefault();

                $this.openModal = true;

                var $productId = $(this).data('pid');

                $this.productId = $productId;

                $this.getProductInfo();

                // Modal
                $this.modalTemplate();
                //
                $this.fbOpenPopUp();

            })

        },
        modalTemplate: function () {

            // Modal wrapper
            var temp = wp.template('fb_modal_wrapper');
            var t = temp();

            $('body').append(t);

            // Modal steps
            var temp = wp.template('fb_modal_steps');
            var t = temp();

            $('.fb_steps_wrapper').append(t)

        },
        cartTemplate: function () {

            var $this = this;

            $(document).on('click', '.remove_cart_item', function (e) {

                e.preventDefault();

                var current_qty = parseInt($(this).attr('data-quantity'));
                var id = $(this).attr('data-product_id');

                var cat_item_key = $(this).attr('data-cart_item_key');

                $.ajax({

                    type: 'POST',
                    url: foodbookobj.ajaxurl,
                    data: {
                        action: 'woo_cart_item_remove',
                        cart_item_key: cat_item_key
                    },
                    success: function (res) {
                        $('.step-cart').remove();
                        $this.getCartItems();
                        $this.cartCount();
                    }

                })

            });

        },
        checkoutLoginRegisterTemplate: function () {

            var $this = this;

            $(document).on('click', '.fb_checkout_order', function (e) {

                e.preventDefault();

                $('.step-cart').hide();


                if (foodbookobj.is_login) {

                    // Modal checkout
                    var data = $this.checkout();

                } else {

                    // Modal Login/Register 
                    var temp = wp.template('fb_loginreg');
                    var t = temp();

                    $('.fb_steps_wrapper').append(t)

                    // Active Tab                
                    a.tabDeactive();
                    a.tabActive('.fb_logreg_tab');

                    // login form tab
                    $this.fbMultiform();

                }


            })
        },
        fbMultiform: function () {

            let multiForm = $('.fb_multiform');
            if (multiForm.length) {
                let multiSelector = multiForm.find('.fb_form_selector_list .fb_single_form_selector input[type=radio]'),
                    forms = multiForm.find('.fb_single_form');

                multiSelector.on('click', function () {
                    let form = $(this).data('form');
                    forms.each(function () {
                        if ($(this).hasClass(form)) {
                            $(this).fadeIn().addClass('show')
                        } else {
                            $(this).hide().removeClass('show')
                        }
                    })
                })
            }

        },
        shippingMethod: function () {

            $(document).on('change', '[name="shipping_method"]', function () {

                $.ajax({
                    type: "POST",
                    url: foodbookobj.ajaxurl,
                    data: {
                        action: "woo_set_shipping_methods",
                        method: $(this).val()
                    },
                    success: function (res) {

                        $.ajax({

                            post: 'post',
                            url: foodbookobj.ajaxurl,
                            data: {
                                action: "woo_get_checkout_data"
                            },
                            success: function (res) {

                                var temp = wp.template('fb_billing_summary');
                                var t = temp(res.data);

                                $('.fb-billing-summary').html(t);

                            }

                        })

                    }
                })

            })

        },
        placeOrder: function () {
            var $this = this;

            $(document).on('submit', '#fb_place_order', function (e) {

                e.preventDefault();
                $this.createOrder();

            });

        },
        fbOpenPopUp: function () {

            let $target = $("#fb_popup_modal");

            if (!$target.length) {
                return false;
            }

            $target.fadeIn();
            $target.addClass('open');

            $(document.body).addClass('fbPopupModal-opened ');


        },
        fbClosePopup: function () {

            var $this = this;


            function removePopup() {
                $this.productId = "";
                $this.isVerifiedOwner = "";
                $this.openModal = false;
                $this.isCartModal = false;

                let $target = $("#fb_popup_modal")

                $target.fadeTo(1000, 0.01, function () {
                    $(this).slideUp(150, function () {
                        $(this).remove();

                    });
                });

                $(document.body).removeClass('fbPopupModal-opened');
            }

            $(document).on('click', '.fb_close_modal_btn', function (e) {
                e.preventDefault()
                removePopup()
            });

            $(document).on('click', '#fb_popup_modal', function (e) {
                let isShow = e.target === e.currentTarget;

                if (isShow) {
                    removePopup()
                }
            });

            $(document).on('keydown', function (e) {
                if (e.key === 'Escape') {
                    removePopup()
                }
            });


        },
        getProductInfo: function () {

            var $this = this;

            $.ajax({

                type: "post",
                url: foodbookobj.ajaxurl,
                data: {
                    action: "woo_product_byid",
                    product_id: $this.productId
                },
                success: function (res) {

                    var data = JSON.parse(res);

                    $this.isVerifiedOwner = data.verified_owner;

                    // Modal product info content
                    var temp = wp.template('fb_product_content');
                    var t = temp(data);

                    $('.fb_steps_wrapper').append(t);
                    //
                    $this.variationProduct();
                    // 
                    a.addExtraFeatures();
                    //
                    a.lodingRemove();

                    // Flying cart init
                    if( data.type != 'grouped' && data.type != 'external' ) {
                        a.flyingCart();
                    }

                    
                }

            })

        },
        productReview: function () {

            var $this = this;

            $(document).on('click', '.fb-product-review', function () {

                $this.getReviewAjax();

                // Hide product content modal
                $('.step-product-info').hide();

            })


        },
        reviewBack: function () {

            $(document).on('click', '.review-back', function () {

                // remove reviews modal
                $('.step-reviews').remove();
                // Show product content modal
                $('.step-product-info').fadeIn();

            })

        },
        getReviewAjax: function () {

            var $this = this,
                $productId = $this.productId;
            // 
            $.ajax({

                type: "post",
                url: foodbookobj.ajaxurl,
                data: {
                    action: "woo_product_reviews_byid",
                    product_id: $productId
                },
                beforeSend: function () {
                    // Preloader 
                    $('.fb_steps_wrapper').append(a.lodingMarkup());
                },
                success: function (res) {

                    // reset previous reviews modal
                    $('.step-reviews').remove();

                    // load review modal content pass reviews data and product id
                    var temp = wp.template('fb_modal_reviews');
                    var t = temp({ data: res, id: $productId, isVerifiedOwner: $this.isVerifiedOwner });
                    $('.fb_steps_wrapper').append(t);

                    // Preloader remove
                    a.lodingRemove();

                    // init reviews submit event func
                    $this.submitReview();

                }

            })

            return false;

        },
        submitReview: function () {

            var $thisObj = this;

            /// Rating active and assign value
            $('[data-rating]').on('click', function (e) {

                e.preventDefault();

                var $this = $(this);
                $this.addClass('active');
                $this.parent().parent().addClass('selected');
                $('[name="rating"]').val($this.data('rating'));
            })

            // Review comments form submit 
            $('#commentform').on('submit', function (e) {

                e.preventDefault();


                var $url = $(this).attr("action"),
                    formdata = $(this).serialize();

                $.ajax({

                    type: 'post',
                    url: $url,
                    data: formdata,
                    error: function (XMLHttpRequest, textStatus, errorThrown) {

                        var $selector = $('.fb-review-submit-message');

                        if (textStatus == 'error') {
                            $selector.html('<p class="fb-alert fb-alert-warning">' + foodbookobj.review_failed_alert + '</p>');
                        }

                    },
                    success: function (data, textStatus) {

                        var $selector = $('.fb-review-submit-message');

                        if (textStatus == 'success') {
                            $selector.html('<p class="fb-alert fb-alert-success">' + foodbookobj.review_success_alert + '</p>');
                            $thisObj.getReviewAjax();
                        } else {
                            $selector.html('<p class="fb-alert fb-alert-warning">' + foodbookobj.review_failed_alert + '</p>');
                        }

                    }

                });

                return false;

            })


        },
        variationProduct: function () {

            // omn Change

            $(document).on('change', '.fb-product-attribute', function () {

                var $t = $(this);

                var attr = $t.data('name-attr');
                var name = $t.data('name');

                $.ajax({
                    type: 'post',
                    url: foodbookobj.ajaxurl,
                    data: {
                        action: 'woo_get_variation_data',
                        attribute: attr,
                        name: name,
                        pid: $('[name="product_id"]').val()

                    },
                    success: function (res) {

                        if (!res) {
                            return;
                        }

                        $('[name="variation_id"]').val(res.data.variation_id);
                        $('.fb_total_Price').attr('data-item-price', res.data.display_price).text(foodbookobj.currency + res.data.display_price);
                        $('.fb-variable-price').html('');
                        $t.parent().parent().parent().find('.fb-variable-price').html(res.data.price_html);

                        $('.product-extra-options:checked').click();

                    }
                })


            })


        },
        addToCart: function () {

            var $thisObj = this;

            $(document).on('submit', '#fbs_single_add_to_cart_button', function (e) {
                e.preventDefault();

                // 

                var getAttributes = {};

                $('[data-product-attribute]').each(function () {

                    var t = $(this).data('product-attribute'),
                        v = $('[name="' + t + '"]:checked').val();

                    getAttributes[t] = v


                });

                // 
                var extraoptions = $(this).find('.product-extra-options:checked');

                var options = [];

                extraoptions.each(function () {

                    options.push($(this).val());

                })

                //
                var $this = $(this),
                    product_qty = $this.find('input[name=fb_quantity]').val() || 1,
                    product_id = $this.find('input[name=product_id]').val() || '',
                    variation_id = $this.find('input[name=variation_id]').val() || 0,
                    product_sku = $this.find('input[name=product_sku]').val() || '',
                    extra_options = options,
                    instructions = $this.find('[name=item_instructions]').val() || '';

                //
                var data = {
                    action: 'woo_fb_ajax_add_to_cart',
                    product_id: product_id,
                    product_sku: product_sku,
                    quantity: product_qty,
                    variation_id: variation_id,
                    instructions: instructions,
                    extra_options: extra_options,
                    attributes: getAttributes
                };



                $.ajax({
                    type: 'post',
                    url: foodbookobj.ajaxurl,
                    data: data,
                    success: function ( response ) {

                        if ( response.data.status == true ) {
                 
                            // Hide product info modal
                            $('.step-product-info').hide();

                            // cart modal open status
                            $thisObj.isCartModal = true;
                            // Show cart modal
                            $thisObj.getCartItems();
                            // Active Tab                
                            a.tabDeactive();
                            a.tabActive('.fb_viewcart_tab');

                            // cart count
                            $thisObj.cartCount();

                        } else {

                            var data = {
                                text: foodbookobj.dont_cart_msg,
                                alert: "alert-warning"
                            }

                            a.alert(data);

                        }

                    },
                });

                //return false;
            });

        },
        getCartItems: function () {

            var $this = this;

            $.ajax({

                type: "post",
                url: foodbookobj.ajaxurl,
                data: {
                    action: "woo_cart_items",
                },
                beforeSend: function () {

                    $('.fb_steps_wrapper').append(a.lodingMarkup());
                },
                success: function (res) {

                    // Modal product info content
                    var temp = wp.template('fb_cart_items');
                    var t = temp(res.data);

                    // Active Tab                
                    a.tabDeactive();
                    a.tabActive('.fb_viewcart_tab');

                    $this.isCartModal = true;

                    $('.fb_steps_wrapper').append(t)

                    if ($this.cartBackBtn) {
                        $('.fb_cart_back').hide();
                    }

                    a.lodingRemove();

                    // value assign false
                    $this.cartBackBtn = false;

                }



            })


        },
        cartCount: function () {
            $.ajax({

                type: "post",
                url: foodbookobj.ajaxurl,
                data: {
                    action: "woo_get_cart_count"
                },
                success: function (res) {
                    $('.fb_cart_count').text(res);

                }

            })
        },
        cartBack: function () {

            $(document).on('click', '.fb_cart_back', function () {

                $('.step-cart').remove();
                $('.step-product-info').show();
                $('.fb_add_to_cart_ajax').show();

                // Active Tab                
                a.tabDeactive();
                a.tabActive('.fb_product_tab');

            })
        },
        login: function () {

            var $this = this;

            $(document).on('submit', '#fb_form_log_in', function (e) {

                e.preventDefault();

                var $thisObj = $(this);

                var data = $thisObj.serialize();

                $.ajax({

                    type: "POST",
                    url: foodbookobj.ajaxurl,
                    data: {
                        action: "login_action",
                        data: data,
                        security: $thisObj.find('[name="security"]').val()
                    },
                    success: function (res) {

                        var r = res.data;

                        if (r.loggedin == true) {
                            window.location.href = foodbookobj.cart_url;
                        } else {
                            $('.fb-alert').remove();
                            $thisObj.prepend('<div class="fb-alert fb-alert-danger">' + r.message + '</div>');
                        }

                    }

                })

            })

        },
        register: function () {

            var $this = this;

            $(document).on('submit', '#fb_form_signup', function (e) {

                e.preventDefault();

                var $thisObj = $(this);

                var data = $thisObj.serialize();

                $.ajax({

                    type: "POST",
                    url: foodbookobj.ajaxurl,
                    data: {
                        action: "registration_action",
                        data: data,
                    },
                    success: function (res) {

                        var r = res.data;

                        if (r.loggedin == true) {
                            window.location.href = foodbookobj.cart_url;
                        } else {
                            $('.fb-alert').remove();
                            $thisObj.prepend('<div class="fb-alert fb-alert-danger">' + r.message + '</div>');
                        }

                    }

                })

            })
        },
        addCouponcode: function () {

            $(document).on('click', '.fb_add_coupon', function () {

                var $t = $(this).parent().find('[name="coupon_code"]');

                $.ajax({
                    type: "post",
                    url: foodbookobj.ajaxurl,
                    data: {
                        action: "woo_add_discount",
                        coupon_code: $t.val()
                    },
                    success: function (res) {

                        $.ajax({

                            post: 'post',
                            url: foodbookobj.ajaxurl,
                            data: {
                                action: "woo_get_checkout_data"
                            },
                            success: function (res) {

                                var temp = wp.template('fb_billing_summary');
                                var t = temp(res.data);

                                $('.fb-billing-summary').html(t);

                            }

                        })

                    }

                })


            })

        },
        removeCouponcode: function () {

            var $t = this;

            $(document).on('click', '.fb_remove_coupon', function (e) {

                e.preventDefault();
                var $this = $(this),
                    $url = $this.data('url'),
                    $code = $this.data('coupon');


                $.post($url + '?remove_coupon=' + $code).done(function (data) {

                    $.ajax({

                        post: 'post',
                        url: foodbookobj.ajaxurl,
                        data: {
                            action: "woo_get_checkout_data"
                        },
                        success: function (res) {

                            var temp = wp.template('fb_billing_summary');
                            var t = temp(res.data);

                            $('.fb-billing-summary').html(t);

                        }

                    })


                });

            })

        }


    }

    a = {

        init: function () {

            var $this = this;

            //SVG Image
            $this.SVGImage();

            // 
            $this.checkoutCoupon();

            //
            if ($(window).width() > 991) {
                $this.fbTop50();
            }

        },
        SVGImage: function () {

            $(window).on('load', function () {

                $('img.fb_svg').each(function () {
                    var $img = $(this);
                    var imgID = $img.attr('id');
                    var imgClass = $img.attr('class');
                    var imgURL = $img.attr('src');

                    $.get(imgURL, function (data) {
                        // Get the SVG tag, ignore the rest
                        var $svg = $(data).find('svg');

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

            });


        },
        fbTop50: function () {
            let a = $('.fb_top_50'),
                b = a.innerHeight(),
                c = b / 2;

            a.css({
                'margin-top': -c,
                'position': 'relative',
                'z-index': 99
            });
        },
        checkoutCoupon: function () {
            var coupon2 = $(".checkout_coupon");
            coupon2.insertAfter('.shop_table.woocommerce-checkout-review-order-table');
        },
        alert: function (data) {

            var temp = wp.template('fb_modal_alert');
            var t = temp(data);
            $('body').append(t)

            setTimeout(function () {
                $('.fb-alert-wrapper').fadeOut('300', function () {
                    $('.fb-alert-wrapper').remove();
                });

            }, 1000);

        },
        lodingMarkup: function () {

            var html = '';
            html += '<div class="fb-loading">';
            html += '<div class="circle"></div>';
            html += '<div class="circle"></div>';
            html += '<div class="circle"></div>';
            html += '<div class="shadow"></div>';
            html += '<div class="shadow"></div>';
            html += '<div class="shadow"></div>';
            html += '<span>Loading</span>';
            html += '</div>';

            return html;

        },
        lodingRemove: function () {

            $('.fb-loading').fadeOut('slow', function () {
                $(this).remove()
            });
        },
        quantityPlusMinusEvent: function () {

            /* Increase */
            $(document).on('click', '.fb_plus', function (e) {

                e.preventDefault();

                var $qty = $(this).parent().find('[name="fb_quantity"]');

                var currentVal = parseInt($qty.val());

                if (!isNaN(currentVal)) {
                    var q = currentVal + 1;

                    $qty.val(q);

                }

            });

            /* Decrease */
            $(document).on('click', '.fb_minus', function (e) {

                e.preventDefault();

                var $qty = $(this).parent().find('[name="fb_quantity"]');
                var currentVal = parseInt($qty.val());
                if (!isNaN(currentVal) && currentVal > 1) {
                    var q = currentVal - 1;
                    $qty.val(q);

                }
            });

        },
        tabActive: function (selector) {

            $(selector).addClass('active');

        },
        tabDeactive: function () {

            $('.fb_steps_item').removeClass('active');

        },
        addExtraFeatures: function () {

            var EP = 0;

            $(document).on('click', '.product-extra-options', function (e) {

                var el = document.querySelector('[data-item-price]').getAttribute('data-item-price');

                if ($(this).is(":checked")) {
                    EP += $(this).data('price');
                } else {
                    EP -= $(this).data('price');
                }

                var y = EP + parseInt(el);

                $('.fb_total_Price').html(foodbookobj.currency + y)


            })


        },
        sendMail: function () {

            $('#invitemail').on('submit', function (e) {
                e.preventDefault();

                var $this = $(this),
                    $email = $this.find('[name="invite_mail"]').val();

                $.ajax({

                    type: "post",
                    url: foodbookobj.ajaxurl,
                    data: {
                        action: "invitation_mail_action",
                        mail: $email
                    },
                    success: function (res) {

                        $this.append('<p class="invite-alert">' + res + '</p>');

                        $('.invite-alert').delay('3000').fadeOut('slow');

                    }

                })


            })

        },
        flyingCart: function () {

            $('.ajax_add_to_cart').on('click', function () {
                var cart = $('.fb_cart_icon');
                var imgtodrag = $('.fb_product_details_img').find("img").eq(0);
                if (imgtodrag) {
                    var imgclone = imgtodrag.clone()
                        .offset({
                            top: imgtodrag.offset().top,
                            left: imgtodrag.offset().left
                        })
                        .css({
                            'opacity': '0.5',
                            'position': 'absolute',
                            'height': '150px',
                            'width': '150px',
                            'z-index': '100000000'
                        })
                        .appendTo($('body'))
                        .animate({
                            'top': cart.offset().top + 10,
                            'left': cart.offset().left + 10,
                            'width': 75,
                            'height': 75
                        }, 1000, 'easeInOutExpo');

                    setTimeout(function () {
                        cart.addClass('fb-shake-animation');
                        //
                        setTimeout(function () {
                            cart.removeClass('fb-shake-animation')
                        }, 1000)

                    }, 1500);

                    imgclone.animate({
                        'width': 0,
                        'height': 0
                    }, function () {
                        $(this).detach()

                    });
                }
            });
        }



    }

    // Init
    m.init(); i.init(); a.init();


    /**
     *  Custom admin scripts 
     */

    admin = {


        init: function () {

            var $this = this;

            // datepicker init for Date filter 
            $(".datepicker").datepicker();

            // data table order view modal open
            $this.OrderViewModalOpen();

            // data table order view modal close
            $this.OrderViewModalClose();

            // Order Tracking status chnage
            $this.OrderTrackingStatusChnage();

            // Data table
            $this.dataTable();


        },
        OrderViewModalOpen: function () {

            //
            $(document).on('click', '.fb-view-order', function () {

                $(this).parent().find('.fb_popup_modal').addClass('open').fadeIn('300');
                $("body").addClass('fbPopupModal-opened');

            })

        },
        OrderViewModalClose: function () {

            function removeModal() {
                $('.fb_popup_modal').removeClass('open').fadeOut('300')
                $("body").removeClass('fbPopupModal-opened');
            }

            //
            $(document).on('click', '.fb_close_modal', removeModal);

            $('.fb_popup_modal').on('click', function (e) {
                let isShow = e.target === e.currentTarget;

                if (isShow) {
                    removeModal();
                }
            })

            $(document).on('keydown', function (e) {
                if (e.key === 'Escape') {
                    removeModal();
                }
            })

        },
        OrderTrackingStatusChnage: function () {

            var $that = this;

            $(document).on('click', '[data-tracking-status]', function () {

                var $this = $(this),
                    $orderID = $this.data('orderid'),
                    $status = $this.data('tracking-status');

                $.ajax({
                    type: "POST",
                    url: foodbookobj.ajaxurl,
                    data: {
                        action: "order_tracking_status_action",
                        orderId: $orderID,
                        status: $status
                    },
                    success: function (res) {
                        $('.status-active').removeClass('status-active')
                        $this.addClass('status-active')

                        $this.prevAll().addClass("fb-d-none")

                    }
                })
            })


        },
        dataTable: function () {

            $(document).ready(function () {

                // DataTable Default
                $('.foodbook-order-data-table').DataTable();

                // Click filter
                $(document).on('click', '[data-filter]', function () {

                    var t = $(this).data('filter');

                    $('.foodbook-order-data-table').DataTable().search(t,false, false).draw();

                })

            })

        }
        

    } // 

    // Init admin object

    admin.init();



}(jQuery))


