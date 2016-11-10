
document.write('<div id="hitbox-container"></div>');
document.write('<div id="hitbox-text" class="boxborder"></div>');
document.write('<div id="hitbox-close" ><img src="http://parsunix.com/cdn/img/icon/close30.png"/></div>');

function hitbox(text,w,h){
	$('#hitbox-container').css({'width':'100%','height':'100%'}).animate({'opacity':'0.7'},500);
	var left0 = screen.availWidth / 2;
	var left1 = left0 - (w/2);
	var top0 = screen.availHeight / 2;
	var top1 = top0 - (h/2);
	// alert('availWidth:' + screen.availWidth + ' - w:' + w + ' - left0:' + left0+' - left1:' + left1);
	$('#hitbox-text').css({'left':left1+'px','top':top1+'px'});
	$('#hitbox-text').css({'width':w+'px','height':h+'px','padding':'0px'});
	$('#hitbox-text').html(text);
//	$('#hitbox-text').animate({ WebkitTransform: 'rotate(-90deg)'},1500);
//	$('#hitbox-text').animate({ '-moz-transform': 'rotate(-90deg)'},1500);
	$('#hitbox-close').css({'display':'block','left':(left1-20)+'px','top':(top1-20)+'px'});
	
	return false;
}

function dehitbox(){
//	$('#hitbox-text').animate({ WebkitTransform: 'rotate(90deg)'},500);
//	$('#hitbox-text').animate({ '-moz-transform': 'rotate(90deg)'},500);
	$('#hitbox-text').html('');
	$('#hitbox-text').css({'width':'0px','height':'0px','padding':'0px'});
	var left0 = (screen.availWidth / 2);
	var top0 = (screen.availHeight / 2);
	$('#hitbox-text').css({'left':left0+'px','top':top0+'px'});
	$('#hitbox-close').css({'display':'none','left':left0+'px','top':top0+'px'});
	$('#hitbox-container').animate({'opacity':'0.0'},500).css({'width':'0px','height':'0px'});
}

$("#hitbox-close").on("click",function(){
	dehitbox();
});
$("#hitbox-container").on("click",function(){
	dehitbox();
});

$(document).keydown(function(e) {
	if(e.keyCode == '27'){
		dehitbox();
	}
});

$( document ).ready(function() {
	dehitbox();
});


