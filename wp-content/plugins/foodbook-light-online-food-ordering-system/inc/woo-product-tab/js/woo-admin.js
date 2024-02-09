(function($) {
	"use strict";


$(document).on( 'click', '.remove-group', function() {

	$(this).parent().remove();
  

} )


var count = $( '.foodbooklite-fields-group' ).length;


$('.add-group').on( 'click', function() {

    // deep clone the targeted row
    
    var new_row = '';

	  	new_row += '<div class="foodbooklite-fields-group" data-count="'+count+'">';

			new_row += '<div class="group-title-wrapper group-title-wrapper-list-type form-field">';
				new_row +=	'<label>List Type</label>';
				new_row +=	'<div class="group-title-wrapper-list-type-inner">';
				new_row +=		'<div>';
				new_row +=			'<span>Checkbox</span>';
				new_row +=			'<input type="radio" name="extra_featured['+count+'][list_type]" value="checkbox" class="group-title" checked />';
				new_row +=		'</div>';
				new_row +=		'<div>';
				new_row +=			'<span>Radio</span>';
				new_row +=			'<input type="radio" name="extra_featured['+count+'][list_type]" value="radio" class="group-title" />';
				new_row +=		'</div>';
				new_row +=	'</div>';
			new_row += '</div>';
			new_row += '<p class="group-title-wrapper form-field">';
				new_row += '<label>Feature Section Title</label>';
				new_row += '<input type="text" name="extra_featured['+count+'][group_title]" class="group-title" />';
			new_row += '</p>';
			new_row += '<div class="field-repeater-wrapper">';
				new_row += '<div class="field-repeater-inner">';
					new_row += '<div class="field-repeater">';
						new_row += '<input type="text" placeholder="Frature Title" name="extra_featured['+count+'][group_feature][0][title]" class="group-title" />';
						new_row += '<input type="text" placeholder="Price" name="extra_featured['+count+'][group_feature][0][price]" class="group-title" />';
						new_row += '<span class="remove-repeater-field fb-btn">Remove</span>';
					new_row += '</div>';
				new_row += '</div>';
				new_row += '<button class="add-repeater-field fb-btn fb-btn-margin-top fb-btn-margin-bottom">Add</button>';
			new_row += '</div>';
			new_row += '<span class="remove-group fb-btn fb-btn-margin-top">Remove Group</span>';
		new_row += '</div>';

       	count ++;


    // append the new row to the table
    $('.foodbooklite-extra-featured-inner').append( new_row );


} )


// Add repeater field

var count = $( '.field-repeater' ).length;

$(document).on( 'click', '.add-repeater-field', function(e) {

	e.preventDefault();

	var $this = $(this);

	var groupCount = $this.parent().parent().data('count');

	var inner = $this.parent().find('.field-repeater-inner');

	var $new_repeater = '';
	$new_repeater += '<div class="field-repeater">';
	$new_repeater +='<input type="text" placeholder="Frature Title" name="extra_featured['+groupCount+'][group_feature]['+count+'][title]" class="group-title" />';
	$new_repeater +='<input type="text" placeholder="Price" name="extra_featured['+groupCount+'][group_feature]['+count+'][price]" class="group-title" />';
	$new_repeater +='<span class="remove-repeater-field fb-btn">Remove</span>';
	$new_repeater +='</div>';


	count++;

	inner.append( $new_repeater );


} )

// remove repeater field

$(document).on( 'click', '.remove-repeater-field', function() {

	var $this = $( this );

	$this.parent().remove();


} )



})(jQuery)