
$(document).ready(function(){
	
	//
	// preuploader remove agent
	$('.listmaker_formfield_file_preuploadedfiles a').on('click', function(){
		wget('./', '', 'do_action=listmaker_formfield_file_preuploadedfiles_remove&path=' + $(this).attr('rel'));
		$(this).hide("fast");
	})
	
});

function lmff_div_select( elem ) {
	var elem_input = $(elem).parent().find('.lmff_file');
	$(elem_input).trigger('click');
}





