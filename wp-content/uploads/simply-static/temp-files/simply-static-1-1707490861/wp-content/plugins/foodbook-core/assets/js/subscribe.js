/*

[Main Script]

Project: foodbook
Version: 1.1
Author : themelooks.com

*/

(function ($) {
    'use strict';


	$( function(){

		/* ------------------------------------------------------------------------- *
        * Mail Chimp ajax
        * ------------------------------------------------------------------------- */

        var $subscribeForm = $('#subscribe_submit');

        $subscribeForm.on('submit', function () {

			var email = $('#sectsubscribe_email').val();
			$.ajax({

				type: 'POST',
				url: subscribeajax.action_url,
				data: {
				  sectsubscribe_email: email,
				  action: 'foodbook_subscribe_ajax',
				  security: subscribeajax.security
				},
				success: function( data ){
				  $(".newsletter-content").append(data);
				  $(".newsletter-content .alert").delay(3000).fadeOut();
				}
			});

          return false;

        });


	} );
})(jQuery);
