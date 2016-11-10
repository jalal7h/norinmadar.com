
$(document).ready(function(){
	$("input[type=file].green").wrap("<div class='greenwrapper'></div>");
	$("div.greenwrapper").append("<span class='trigger submit_button'>0</span>");
	$('input[type=file].green').each(function() {
		$(this).parent().find('span.trigger').html( $(this).attr("rel") );
	});

	$('span.trigger').on('click', function(e){
        e.preventDefault();
        var elem_input = $(this).parent().find('input[type=file]');
        elem_input.trigger('click');
    });
});

