(function ($) {
    "use strict";


    var foodbookliteAdmin = {

        init: function () {

            var $this = this;

            /**
             * datepicker init for Date filter 
             */

            $(".datepicker").datepicker();

            // Time picker
            $('.time-picker').mdtimepicker();

            // admin settings conditional field
            $this.conditionalField();

            // admin settings tab
            $this.adminSettingsTab();

            // Media uploader
            $this.mediaUploader();

            // color picker
            $this.colorPicker();
            
        },
        colorPicker: function () {
            $('.fb-color-field').wpColorPicker();
        },
        conditionalField: function () {

            /**
             * Conditional field for settings option
             */

            let addressFields = $('.fb-address-conditional-field'),
                zipFields     = $('.fb-zip-conditional-field'),
                branchAddressFields = $('.tatCmf-branch-address-field'),
                branchZipFields     = $('.tatCmf-branch-zip-code-field');

            // Onchange event
            $('[name="foodbooklite_options[location_type]"]').on( 'change', function() {

                let $this = $(this);

                if( $this.val() == 'address' ) {
                   addressFields.show('slow');
                   zipFields.hide('slow');
                }else {
                    addressFields.hide('slow');
                    zipFields.show('slow');
                }

            } )

            // Default
            
            if( $('[name="foodbooklite_options[location_type]"]').val() == 'address' ) {
                addressFields.show('slow');
                zipFields.hide('slow');
            } else {
                addressFields.hide('slow');
                zipFields.show('slow');
            }

            /**
             * Conditional field for add/edit branch option 
             */

            if( adminFoodbookliteobj.location_type == 'zip' ) {
                branchAddressFields.hide();
                branchZipFields.show();
            } else {
                branchAddressFields.show();
                branchZipFields.hide();
            }


        },
        adminSettingsTab: function () {

            // Tab
            var tabSelect = $('[data-tab-select]');
            var tab = $('[data-tab]');
            tabSelect.each(function () {
                var tabText = $(this).data('tab-select');
                $(this).on('click', function () {
                    localStorage.setItem("tabActivation", tabText);
                    
                    $(this).addClass('active').siblings().removeClass('active');
                    tab.each(function () {
                        if (tabText === $(this).data('tab')) {
                            $(this).fadeIn(500).siblings().hide(); // for click
                            // $(this).fadeIn(500).siblings().stop().hide(); // active if hover
                            $(this).addClass('active').siblings().removeClass('active');
                        }
                    });
                });
                if ($(this).hasClass('active')) {
                    tab.each(function () {
                        if (tabText === $(this).data('tab')) {
                            $(this).addClass('active');
                        }
                        if ($(this).hasClass('active')) {
                            $(this).show().siblings().hide();

                        }
                    });
                }
            });

            // localStorage.removeItem("tabActivation");
            
            // Check active tab
            let activateTab = localStorage.getItem("tabActivation");

            if( activateTab ) {
                $('[data-tab-select="'+activateTab+'"]').addClass('active').siblings().removeClass('active');
                $('[data-tab="'+activateTab+'"]').show().siblings().hide();
            }


        },
        mediaUploader: function () {

            // Media Upload
            var mediaUploader, t;

            $('.foodbooklite_image_upload_btn').on('click', function (e) {

                e.preventDefault();

                t = $(this).parent().find('.foodbooklite_background_image');

                if (mediaUploader) {
                    mediaUploader.open();
                    return;
                }
                mediaUploader = wp.media.frames.file_frame = wp.media({
                    title: 'Choose Image',
                    button: {
                        text: 'Choose Image'
                    }, multiple: false
                });
                mediaUploader.on('select', function () {
                    var attachment = mediaUploader.state().get('selection').first().toJSON();

                    t.val(attachment.url)

                });
                mediaUploader.open();
            });

        },
        currency_symbol_position: function( price = '' ) {

            var currency_pos = adminFoodbookliteobj.currency_pos,
                $currency = adminFoodbookliteobj.currency,
                $price;


            switch( currency_pos ) {
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

        }


    }

    // Init object

    foodbookliteAdmin.init();




})(jQuery)