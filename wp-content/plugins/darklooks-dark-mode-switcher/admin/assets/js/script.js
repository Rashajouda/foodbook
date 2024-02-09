(function($){
    "use strict";

// Color Picker
$('.color-picker').wpColorPicker();

// Mobile Menu
$('.dl-menu-button').on('click', function() {
    $(this).toggleClass('menu-opened');
    // $('.dl-adminmenu').toggleClass('open');
    $('.dl-adminmenu').slideToggle('slow');
});


// Mobile Menu
function mobileMenu() {
    let $dlAdminmenu = $(".dl-adminmenu");
    if ($(window).width() < 992) {
        $dlAdminmenu.hide()
    } else {
        $dlAdminmenu.show()
    } 
}
$(window).on("resize", function() {mobileMenu()});
mobileMenu()


// admin settings tab
$('[data-tab-select]').on( 'click', function( e ) {

    e.preventDefault();
    var $this = $(this),
        $tabKey = $this.data('tab-select');

    localStorage.setItem("dl_active_tab", $tabKey);

    $('.active').removeClass('active');
    $this.addClass('active');

    $('[data-tab="'+$tabKey+'"]').addClass('active');

} )

// Check is active tab
let $is_tab_activate = localStorage.getItem("dl_active_tab");

if( $is_tab_activate ) {

    $('.active').removeClass('active');
    $('[data-tab-select="'+$is_tab_activate+'"]').addClass('active');
    $('[data-tab="'+$is_tab_activate+'"]').addClass('active');

} else {
    let t = $('.active').data('tab-select');
    $('[data-tab="'+t+'"]').addClass('active');
}

/**
 * Conditional Settings Fields
 * 
 */
 
let optionName = 'darklooks_options';
$('[data-required]').each( function( i ) {

    let $that = $(this),
        t = $that.data('required');

    $( '[name="'+optionName+'['+t[0]+']"]' ).on( 'click', function(e) {

        if( $(this).val() == t[2] ) {
            $that.show();
        } else {
            $that.hide();
            if( ! $that.is(":visible") ) {
                $('[data-dependency="'+$that.data('name')+'"]').hide();
            } else {
                $('[data-dependency="'+$that.data('name')+'"]').show();
            }
        }

    } )

    // On load condition check
    if( $( '[name="'+optionName+'['+t[0]+']"]:checked' ).val() == t[2] ) {
        $that.show();
    } else {
        $that.find('input').attr( 'checked', false );
        $that.hide();
    }

} );


// File Upload

var mediaUploader, t,u;

$('.dl-upload-btn').on('click', function (e) {

    e.preventDefault();

    t = $(this).parent().find('.dl-upload-input');
    u = $(this).parent().parent().find('.dl-upload-img');

    if (mediaUploader) {
        mediaUploader.open();
        return;
    }
    mediaUploader = wp.media.frames.file_frame = wp.media({
        multiple: false
    });
    mediaUploader.on('select', function () {
        var attachment = mediaUploader.state().get('selection').first().toJSON();
        u.attr('src',attachment.url)
        t.val(attachment.url)
    });
    mediaUploader.open();
});

/**
 * Range Slider
 * 
 */
var rangeSlider = $(".rs-range");
var rangeBullet = $(".rs-label");

rangeSlider.on("input", function() {
    var rsVal = rangeSlider.val();
    rangeBullet.html(rsVal);

    var bulletPosition = (rsVal / rangeSlider.attr('max'));
    var left = (bulletPosition * (rangeSlider.width() - 26)) + "px";
    rangeBullet.css('left', left);
});

/**
 * Radio Switch
 *  
 */

$('.dl-radio-switch').on( 'click', function() {
    $(this).parent().parent().find('.checked-on').removeClass('checked-on');
    $(this).parent().addClass( 'checked-on' );
} )

if( $('.dl-radio-switch').is(':checked') ) {
    $('.dl-radio-switch:checked').parent().addClass( 'checked-on' );
}

/**
 * Repeatable Text field
 * 
 */
$(document.body).on('click', '.addfield', function (e) {
    
    e.preventDefault();

    let $this = $(this),
        inner = $this.parent().find('.multiple-text-repeater-inner'),
        h = $('.field-group');
        $(h[0]).clone(true).appendTo(inner);
})

//
$(document.body).on('click', '.removefield', function () {
    var $this = $(this);
    $this.parent().remove();
})


/**
 * CSS Editor
 */

var isEditor = document.getElementById('dlcsseditor');

if( isEditor != null ) {
    // Css Editor
    var cssEditor = ace.edit("dlcsseditor");
    cssEditor.session.setMode("ace/mode/css");
    cssEditor.setTheme("ace/theme/twilight");

    $("form").on( 'submit', function( e ) {
        document.getElementById("dlcsseditorinput").value = cssEditor.getValue();
    } )


}


})(jQuery);