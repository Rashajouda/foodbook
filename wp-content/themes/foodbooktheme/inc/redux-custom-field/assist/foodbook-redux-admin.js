;( function($){
	"use strict";
	// Show Icon Box
	$( '.showicon' ).on( 'click', function(){
		$(this).next('.iconbox').toggle('300');
	} );
	

	// On click set icon in icon field
	$('.seticon').on( 'click', function(e){
		
		var $t = $(this),
			icon,
			$parent;
		
		// Get Icon
		icon = $t.data('icon');
		
		// Select parent element
		$parent = $( $t.parent() );
		// Set parent element data attr with icon
		$parent.data('seticon', icon );
		
		// Icon Set In Field
		$parent.next('.icon-field').val( $parent.data('seticon') );
		
	});
	
	// Icon Search
	$('.searchfield').keyup( function(){
		var input, filter, iconbox, span, getdata, i;
		input = $( this );
		
		filter = input.val().toUpperCase();
		
		iconbox = $( '.iconbox' );
		span = iconbox.find("span");
		
		console.log( span );
        
		for (i = 0; i < span.length; i++) {
			getdata = span[i];
			if (getdata.innerHTML.toUpperCase().indexOf(filter) > -1) {
				span[i].style.display = "";
			} else {
				span[i].style.display = "none";
        
			}
		}
		
	} );
	
	
} )(jQuery);