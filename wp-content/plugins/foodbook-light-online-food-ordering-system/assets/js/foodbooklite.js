/*---------------------------------------------
Template name :  FoodBookLite
Version       :  2.7.0
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

    let i, m, a = {};

    i = {

        catSlug: "",
        taxonomy: "",
        options: {},

        init: function () {

            let $this = this;

            $this.getProducts();
            $this.allGetItems();
            $this.getProductByPaginate();
            $this.getProductByCategories();
            $this.getProductByTaxonomy();
            $this.productSearch();
            $this.getProductOrderbyFilter();
            $this.conditionalTimeSelectBox();
            a.sendMail();
            
        },
        getProducts: function () {

            let $cat = $('[data-cat]').data('cat'),
                $col = $('[data-col]').data('col'),
                $layout = $('[data-layout]').data('layout'),
                cat = this.options.catSlug ? this.options.catSlug : $cat;

            $.ajax({
                type: "POST",
                url: foodbookliteobj.ajaxurl,
                data: {
                    action: "woo_products_view",
                    catSlug: cat,
                    taxonomy: this.options.taxonomy,
                    filter_key: this.options.filter_key,
                    col: $col,
                    layout: $layout,
                    page: this.options.page

                },
                beforeSend: function () {
                    $('.foodbooklite-products').html(a.lodingMarkup());
                },
                success: function (res) {

                    $('.foodbooklite-products').append(res);
                    // 
                    a.lodingRemove();


                    a.productListReadMore();
                }

            });

        },
        getProductByPaginate: function () {

            let $this = this;

            $(document).on('click', '[data-page-number]', function () {

                let $v = $(this).data('page-number');

                //$( '[data-page-number]' ).removeClass('active');
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

            let $this = this;

            $('[name="fb_product_category"]').on('change', function () {

                let $v = $(this).val();

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

            let $this = this;

            $('[name="fb_product_specialoffer"]').on('change', function () {

                let $v = $(this).val();

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
        getProductOrderbyFilter:function(){

            let $this = this;

            $('[name="orderby"]').on('change', function () {

                let $v = $(this).val();

                $this.catSlug = "";
                $this.taxonomy = "";

                $this.options = {
                    catSlug: $this.catSlug,
                    taxonomy: $this.taxonomy,
                    filter_key: $v,
                    page: 1
                }

                $this.getProducts();

            })

        },
        allGetItems: function () {

            let $this = this;

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

        },
        productSearch: function () {

            let $this = this,
                $layout = $('[data-layout]').data('layout');

            $(document).on('keyup', '#fb_search', function (e) {

                e.preventDefault();

                $.ajax({
                    type: 'POST',
                    url: foodbookliteobj.ajaxurl,
                    data: {
                        action: 'woo_search_product',
                        keyword: $(this).val(),
                        layout: $layout                  
                    },
                    beforeSend: function () {
                        $('.foodbooklite-products').html(a.lodingMarkup());
                    },
                    success: function (res) {

                        if (res.length) {
                            $('.foodbooklite-products').html(res);

                        } else {
                            $this.getProducts()
                        }

                        a.lodingRemove();
                        a.productListReadMore();


                    }

                })


            });

        },
        conditionalTimeSelectBox: function() {

            $( '#fb_delivery_date' ).on( 'change', function() {
        
                $.ajax({

                    type: 'POST',
                    url: foodbookliteobj.ajaxurl,
                    data: {
                        action: 'order_time_lists_action',
                        date: $(this).val()
                    },
                    success: function (res) {
                        
                        $('#fb_delivery_time').html(res);
                    }

                })

            } )

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

            let $this = this;

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

            let $this = this;
            
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

                    let $productTab = $('.fb_product_tab');
                    $productTab.hide();
                    $productTab.next().hide();

                }


            })

        },
        modalOpen: function () {

            let $this = this;

            $(document).on('click', '.fb_order_cart_button', function (e) {

                e.preventDefault();

                $this.openModal = true;

                let $productId = $(this).data('pid');

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
            let modalTemp = wp.template('fb_modal_wrapper');
            let modal     = modalTemp();

            $('body').append(modal);

            // Modal steps
            let stepsTemp = wp.template('fb_modal_steps');
            let step      = stepsTemp();

            $('.fb_steps_wrapper').append(step)

        },
        cartTemplate: function () {

            let $this = this;

            $(document).on('click', '.remove_cart_item', function (e) {

                e.preventDefault();

                let current_qty = parseInt($(this).attr('data-quantity'));
                let id = $(this).attr('data-product_id');

                let cat_item_key = $(this).attr('data-cart_item_key');

                $.ajax({

                    type: 'POST',
                    url: foodbookliteobj.ajaxurl,
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

            let $this = this;

            $(document).on('click', '.fb_checkout_order', function (e) {

                e.preventDefault();

                $('.step-cart').hide();


                if (foodbookliteobj.is_login) {

                    // Modal checkout
                    let data = $this.checkout();

                } else {

                    // Modal Login/Register 
                    let temp = wp.template('fb_loginreg');
                    let t = temp();

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
                    url: foodbookliteobj.ajaxurl,
                    data: {
                        action: "woo_set_shipping_methods",
                        method: $(this).val()
                    },
                    success: function (res) {

                        $.ajax({

                            post: 'post',
                            url: foodbookliteobj.ajaxurl,
                            data: {
                                action: "woo_get_checkout_data"
                            },
                            success: function (res) {

                                let temp = wp.template('fb_billing_summary');
                                let t = temp(res.data);

                                $('.fb-billing-summary').html(t);

                            }

                        })

                    }
                })

            })

        },
        placeOrder: function () {
            let $this = this;

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

            let $this = this;


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

            let $this = this;

            $.ajax({

                type: "post",
                url: foodbookliteobj.ajaxurl,
                data: {
                    action: "woo_product_byid",
                    product_id: $this.productId
                },
                success: function ( res ) {

                    let data = JSON.parse(res);

                    $this.isVerifiedOwner = data.verified_owner;

                    // Modal product info content
                    let temp = wp.template('fb_product_content');
                    let t = temp(data);

                    $('.fb_steps_wrapper').append(t);

                    // Remove Thousands Separator
                    a.removeThousandsSeparator('item-price');
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

            let $this = this;

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

            let $this = this,
                $productId = $this.productId;
            // 
            $.ajax({

                type: "post",
                url: foodbookliteobj.ajaxurl,
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
                    let temp = wp.template('fb_modal_reviews');
                    let t = temp({ data: res, id: $productId, isVerifiedOwner: $this.isVerifiedOwner });
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

            let $thisObj = this;

            /// Rating active and assign value
            $('[data-rating]').on('click', function (e) {

                e.preventDefault();

                let $this = $(this);
                $this.addClass('active');
                $this.parent().parent().addClass('selected');
                $('[name="rating"]').val($this.data('rating'));
            })

            // Review comments form submit 
            $('#commentform').on('submit', function (e) {

                e.preventDefault();


                let $url = $(this).attr("action"),
                    formdata = $(this).serialize();

                $.ajax({

                    type: 'post',
                    url: $url,
                    data: formdata,
                    error: function (XMLHttpRequest, textStatus, errorThrown) {

                        let $selector = $('.fb-review-submit-message');

                        if (textStatus == 'error') {
                            $selector.html('<p class="fb-alert fb-alert-warning">' + foodbookliteobj.review_failed_alert + '</p>');
                        }

                    },
                    success: function (data, textStatus) {

                        let $selector = $('.fb-review-submit-message');

                        if (textStatus == 'success') {
                            $selector.html('<p class="fb-alert fb-alert-success">' + foodbookliteobj.review_success_alert + '</p>');
                            $thisObj.getReviewAjax();
                        } else {
                            $selector.html('<p class="fb-alert fb-alert-warning">' + foodbookliteobj.review_failed_alert + '</p>');
                        }

                    }

                });

                return false;

            })


        },
        variationProduct: function () {

            // omn Change

            $(document).on('change', '.fb-product-attribute', function () {

                let $t = $(this);

                let attr = $t.data('name-attr');
                let name = $t.data('name');

                $.ajax({
                    type: 'post',
                    url: foodbookliteobj.ajaxurl,
                    data: {
                        action: 'woo_get_variation_data',
                        attribute: attr,
                        name: name,
                        pid: $('[name="product_id"]').val()

                    },
                    success: function (res) {

                        if ( !res ) {

                            return;
                        }

                        $('[name="variation_id"]').val(res.data.variation_id);

                        $('.fb_total_Price').attr('data-item-price', res.data.display_price).text( a.currency_symbol_position( res.data.display_price ) );
                       
                        $('.fb-variable-price').html('');

                        $t.parent().parent().parent().find('.fb-variable-price').html(res.data.price_html);

                        $('.product-extra-options:checked').click();

                    }
                })


            })


        },
        addToCart: function () {

            let $thisObj = this;

            $(document).on('submit', '#fbs_single_add_to_cart_button', function (e) {
                e.preventDefault();

                // 

                let getAttributes = {};

                $('[data-product-attribute]').each(function () {

                    let t = $(this).data('product-attribute'),
                        v = $('[name="' + t + '"]:checked').val();

                    getAttributes[t] = v


                });

                // 
                let extraoptions = $(this).find('.product-extra-options:checked');

                let options = [],
                    formattedOptions = [];

                extraoptions.each(function () {

                    let $this = $(this);
                    options.push($this.val());
                    formattedOptions.push($this.data('formatted-price'));

                })

                //
                let $this = $(this),
                    product_qty = $this.find('input[name=fb_quantity]').val() || 1,
                    product_id = $this.find('input[name=product_id]').val() || '',
                    variation_id = $this.find('input[name=variation_id]').val() || 0,
                    product_sku = $this.find('input[name=product_sku]').val() || '',
                    extra_options = options,
                    instructions = $this.find('[name=item_instructions]').val() || '';

                //
                let data = {
                    action: 'woo_fb_ajax_add_to_cart',
                    product_id: product_id,
                    product_sku: product_sku,
                    quantity: product_qty,
                    variation_id: variation_id,
                    instructions: instructions,
                    extra_options: extra_options,
                    extra_formatted_options: formattedOptions,
                    attributes: getAttributes
                };


                $.ajax({
                    type: 'post',
                    url: foodbookliteobj.ajaxurl,
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

                            let data = {
                                text: foodbookliteobj.dont_cart_msg,
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

            let $this = this;

            $.ajax({

                type: "post",
                url: foodbookliteobj.ajaxurl,
                data: {
                    action: "woo_cart_items",
                },
                beforeSend: function () {
                    $('.fb_steps_wrapper').append( a.lodingMarkup() );
                },
                success: function (res) {

                    // Modal product info content
                    let temp = wp.template('fb_cart_items');
                    let t = temp(res.data);

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
                url: foodbookliteobj.ajaxurl,
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

            let $this = this;

            $(document).on('submit', '#fb_form_log_in', function (e) {

                e.preventDefault();

                let $thisObj = $(this);

                let data = $thisObj.serialize();

                $.ajax({

                    type: "POST",
                    url: foodbookliteobj.ajaxurl,
                    data: {
                        action: "login_action",
                        data: data,
                        security: $thisObj.find('[name="security"]').val()
                    },
                    success: function (res) {

                        let r = res.data;

                        if (r.loggedin == true) {
                            window.location.href = foodbookliteobj.cart_url;
                        } else {
                            $('.fb-alert').remove();
                            $thisObj.prepend('<div class="fb-alert fb-alert-danger">' + r.message + '</div>');
                        }

                    }

                })

            })

        },
        register: function () {

            let $this = this;

            $(document).on('submit', '#fb_form_signup', function (e) {

                e.preventDefault();

                let $thisObj = $(this);

                let data = $thisObj.serialize();

                $.ajax({

                    type: "POST",
                    url: foodbookliteobj.ajaxurl,
                    data: {
                        action: "registration_action",
                        data: data,
                    },
                    success: function (res) {

                        let r = res.data;

                        if (r.loggedin == true) {
                            window.location.href = foodbookliteobj.cart_url;
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

                let $t = $(this).parent().find('[name="coupon_code"]');

                $.ajax({
                    type: "post",
                    url: foodbookliteobj.ajaxurl,
                    data: {
                        action: "woo_add_discount",
                        coupon_code: $t.val()
                    },
                    success: function (res) {

                        $.ajax({

                            post: 'post',
                            url: foodbookliteobj.ajaxurl,
                            data: {
                                action: "woo_get_checkout_data"
                            },
                            success: function (res) {

                                let temp = wp.template('fb_billing_summary');
                                let t = temp(res.data);

                                $('.fb-billing-summary').html(t);

                            }

                        })

                    }

                })


            })

        },
        removeCouponcode: function () {

            let $t = this;

            $(document).on('click', '.fb_remove_coupon', function (e) {

                e.preventDefault();
                let $this = $(this),
                    $url = $this.data('url'),
                    $code = $this.data('coupon');


                $.post($url + '?remove_coupon=' + $code).done(function (data) {

                    $.ajax({

                        post: 'post',
                        url: foodbookliteobj.ajaxurl,
                        data: {
                            action: "woo_get_checkout_data"
                        },
                        success: function (res) {

                            let temp = wp.template('fb_billing_summary');
                            let t = temp(res.data);

                            $('.fb-billing-summary').html(t);

                        }

                    })


                });

            })

        }


    }

    a = {

        init: function () {

            let $this = this;

            //SVG Image
            $this.SVGImage();

            // 
            $this.checkoutCoupon();

            //
            $this.invoicePrint();
            //
            $this.checkoutPageScheduleType();

            // 
            $this.checkoutPageDateField();

            //
            if ($(window).width() > 991) {
                $this.fbTop50();
            }

        },
        SVGImage: function () {

            $(window).on('load', function () {

                $('img.fb_svg').each(function () {
                    let $img = $(this);
                    let imgID = $img.attr('id');
                    let imgClass = $img.attr('class');
                    let imgURL = $img.attr('src');

                    $.get(imgURL, function (data) {
                        // Get the SVG tag, ignore the rest
                        let $svg = $(data).find('svg');

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
            let coupon2 = $(".checkout_coupon");
            coupon2.insertAfter('.shop_table.woocommerce-checkout-review-order-table');
        },
        alert: function (data) {

            let temp = wp.template('fb_modal_alert');
            let t = temp(data);
            $('body').append(t)

            setTimeout(function () {
                $('.fb-alert-wrapper').fadeOut('300', function () {
                    $('.fb-alert-wrapper').remove();
                });

            }, 1000);

        },
        lodingMarkup: function () {

            let html = '';
            html += '<div class="fb-loading">';
            html += '<div class="circle"></div>';
            html += '<div class="circle"></div>';
            html += '<div class="circle"></div>';
            html += '<div class="shadow"></div>';
            html += '<div class="shadow"></div>';
            html += '<div class="shadow"></div>';
            html += '<span>'+foodbookliteobj.loading+'</span>';
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

                let $qty = $(this).parent().find('[name="fb_quantity"]');

                let currentVal = parseInt($qty.val());

                if (!isNaN(currentVal)) {
                    let q = currentVal + 1;

                    $qty.val(q);

                }

            });

            /* Decrease */
            $(document).on('click', '.fb_minus', function (e) {

                e.preventDefault();

                let $qty = $(this).parent().find('[name="fb_quantity"]');
                let currentVal = parseInt($qty.val());
                if (!isNaN(currentVal) && currentVal > 1) {
                    let q = currentVal - 1;
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

            let EP = 0;

            $(document).on( 'change', '.product-extra-options', function (e) {

                let el = document.querySelector('[data-item-price]').getAttribute('data-item-price');
                
                let ex = 0;

                $('.product-extra-options').each( function() {

                    if( $(this).is(":checked") ) {

                        let p = $(this).data('price');
                        ex += parseFloat( p );

                    }

                } )


                let y = parseFloat( ex ) + parseFloat(el);

                
                $('.fb_total_Price').html( a.currency_symbol_position( a.addThousandsSeparator( y.toFixed( foodbookliteobj.price_decimals ) ) ) )

            })

        },
        sendMail: function () {

            $('#invitemail').on('submit', function (e) {
                e.preventDefault();

                let $this = $(this),
                    $email = $this.find('[name="invite_mail"]').val();

                $.ajax({

                    type: "post",
                    url: foodbookliteobj.ajaxurl,
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
                let cart = $('.fb_cart_icon');
                let imgtodrag = $('.fb_product_details_img').find("img").eq(0);
                if (imgtodrag) {
                    let imgclone = imgtodrag.clone()
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
        },
        invoicePrint: function() {

            // Print event    
            let $print     = $(document).find('.fb-inv-print'),
                $printBack = $(document).find('.fb-inv-back');

            $print.on( 'click', function() {

                let t = $(this).closest( '.fb_modal_content' ),
                    i = $(t).find(".content-inner-hide"),
                    e = $(t).find(".fb-invoice-template");

                i.hide();
                e.show();
                $( this ).closest('.print-btn-area').find('.fb-inv-back').show()
                e.print();

            } )

            // Print Preview          
            $printBack.on( 'click', function() {

                let t = $(this).closest( '.fb_modal_content' ),
                    i = $(t).find(".content-inner-hide"),
                    e = $(t).find(".fb-invoice-template");
                    
                    i.show('slow')
                    e.hide('slow')
                    $(this).hide('slow')

            } )

        },
        currency_symbol_position: function( price = '' ) {

            let currency_pos = foodbookliteobj.currency_pos,
                $currency    = foodbookliteobj.currency,
                $price;


            switch(currency_pos) {
              case 'right':
                $price = price+$currency;
                break;
              case 'left_space':
                $price = $currency+' '+price;
                break;
              case 'right_space':
                $price = price+' '+$currency;
                break;
              default:
                $price = $currency+price;
                break;
                // code block
            }


            return $price;

        },
        pageAutoRefresh: function() {

            if( foodbookliteobj.is_page_custom_admin ) {
                
                let time = foodbookliteobj.page_auto_reload_time;
                setTimeout("location.reload(true);", time+'000');

            } 

        },
        productListReadMore: function() {

            // Configure/customize these variables.
           let showChar = foodbookliteobj.characters;  // How many characters are shown by default
           let ellipsestext = "...";
           let moretext = foodbookliteobj.show_more;
           let lesstext = foodbookliteobj.less;
                
           $('.fb-read-more').each(function() {
                 let content = $(this).html();

                 if(content.length > showChar) {

                    let c = content.substr(0, showChar);
                    let h = content.substr(showChar, content.length - showChar);

                    let html = c + '<span class="moreellipses">' + ellipsestext+ '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">' + moretext + '</a></span>';

                    $(this).html(html);
                 }

           });

           $(".morelink").on('click', function(){
                 if($(this).hasClass("less")) {
                    $(this).removeClass("less");
                    $(this).html(moretext);
                 } else {
                    $(this).addClass("less");
                    $(this).html(lesstext);
                 }
                 $(this).parent().prev().toggle();
                 $(this).prev().toggle();
                 return false;
           });


        },
        addThousandsSeparator: function (nStr) {
            nStr += '';
            let x = nStr.split('.');
            let x1 = x[0];
            let x2 = x.length > 1 ? foodbookliteobj.wc_decimal_separator + x[1] : '';
            let rgx = /(\d+)(\d{3})/;
            while (rgx.test(x1)) {
                x1 = x1.replace(rgx, '$1' + foodbookliteobj.wc_thousand_separator + '$2');
            }
            return x1 + x2;
        },
        removeThousandsSeparator: function( selector ) {

            let $s = $("[data-"+selector+"]"),
                $v = $s.data(selector);
           
                if ( $v.toString().includes(',')  ) {

                   let $d = $v.replace(/,/g, "");

                    $s.attr('data-'+selector, $d);

                }
        },
        checkoutPageDateField: function() {
            $('.foodbooklite-date-field').datepicker();
        },
        checkoutPageScheduleType: function() {

            let s = $('[name="fb_delivery_schedule_options"]'),
                t = $('.dp-date-wrapper'),
                deliveryDate = $('[name="fb_delivery_date"] option');

            if( s.val() == 'todayDelivery' ) {
               t.hide() 
            }
            s.on( 'click', function() {

                let $this = $(this);

                if( $this.val() == 'scheduleDelivery' ) {
                    t.show()
                } else {
                    t.hide()
                    // Selected data reset when user click on Today Delivery/Pickup option
                    deliveryDate.prop('selected', function() {
                    return this.defaultSelected;
                    });
                }

            } )

        }


    }

    // Init
    m.init(); i.init(); a.init();


}(jQuery))