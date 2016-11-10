
// <div class='boxtab'>
// 	<div class='key'>هدفمندی موضوعی</div>
// 	<div class='body active'>something ...</div>
// </div>

$(document).ready(function(){
	$('.boxtab > .active').show();
	$('.boxtab > .key').on("click", function(){
		if( $(this).parent().find('.body').is(":visible") ){
			$(this).parent().find('.body').hide("fast");
		} else {
			$(this).parent().find('.body').show("fast");
		}
	});
});

