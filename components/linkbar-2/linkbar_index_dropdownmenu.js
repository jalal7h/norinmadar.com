
$(document).ready(function() {
	$('.mainmenu').mouseenter(function() {
		//$(this).find(".link").animate({'backgroundColor':'white' , 'color':'black'},20);
		var offset = $(this).offset();
		var offwidth = $(this).outerWidth(true);
		var newLeft = offset.left - (240 - offwidth);
		var newTop = offset.top + 52;
		// $('#stat0').html( 'offset.left : ' + offset.left + ' , offset.top : ' + offset.top + ' , offwidth : ' + offwidth );
		$(this).children(".box").offset({ top: newTop, left: newLeft });
		//css({'left' : newLeft , 'top' : newTop});
		$(this).children(".box").css({'display' : 'block', 'opacity':'1.0'});
	}).mouseleave(function(){
		$(this).children(".box").offset({ top: 0, left: 0 });
		$(this).children(".box").css({'display' : 'none','opacity':'0.8'});
	});
});

$(document).ready(function() {
	$('.submenu').mouseenter(function() {
		//$(this).find(".link").animate({'backgroundColor':'white' , 'color':'black'},20);
		var ofs0 = $(this).offset();
		var pos0 = $(this).position();
		var offwidth = $(this).outerWidth(true);
		if(ofs0.left < 250){
			var newLeft = 240;
		} else {
			var newLeft = -200;
		}
		var newTop = pos0.top;
		$("#i3").html("left:" + ofs0.left + " , top:" + newTop);
		$(this).children(".box").css({'left' : newLeft , 'top' : newTop});
		$(this).children(".box").css({'display' : 'block', 'opacity':'1.0'});
	}).mouseleave(function(){
		$(this).children(".box").css({'display' : 'none','opacity':'0.8'});
	});
});

