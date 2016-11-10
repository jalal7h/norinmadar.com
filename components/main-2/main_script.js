
/******* numeric force input **************************/
$(document).ready(function() {
    $(".numeric").keydown(function(event) {
        // Allow: backspace, delete, tab, escape, and enter
        if ( event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 27 || event.keyCode == 13 || 
             // Allow: Ctrl+A
            (event.keyCode == 65 && event.ctrlKey === true) || 
             // Allow: home, end, left, right
            (event.keyCode >= 35 && event.keyCode <= 39)) {
                 // let it happen, don't do anything
                 return;
        }
        else {
            // Ensure that it is a number and stop the keypress
            if (event.shiftKey || (event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 )) {
                event.preventDefault(); 
            }   
        }
    });
});
/**************************/


/******* confirm remove **************************/
$(document).ready(function() {
	$(".delete_button").click(function() {
		if(!confirm("آیا مایل به حذف میباشید؟")){
			return false;
		}
	});
});
/**************************/


/******* animate change color a tag **************************
$('a').on('hover',function(){
    function(){
        $(this).animate({'color': '#f5f5f5'},400);
    },
    function(){
        $(this).animate({'color': '#000'},400);
    }
});
/**************************/


function wget(urlpath, id, pars){ // jquery
	if(pars!=''){
		var mtd = 'POST';
	} else {
		var mtd = 'GET';
	}
	
	if(urlpath.indexOf("?")==-1){
		;//
	} else {
		if(pars=='') {
			pars = urlpath.substring(urlpath.indexOf("?")+1,urlpath.length);
		}
		urlpath = urlpath.substring(0,urlpath.indexOf("?"));
	}
	$.ajax({
		 type: mtd
		,url: urlpath
		,data: pars
		,cache: false
		,success: function(html){
			if(id!=''){
				$("#"+id).html(html);
			}
		}
	});
}

function form_check(e,t){
	if(e.value==''){
		alert('لطفا '+t+' را بطور درست وارد نمایید');
		e.focus();
		return false;
	} else {
		return true;
	}
}

function str_replace(find,replace,string){
	var fndLng=find.length;
	for(i=0; i<string.length; i++){
		if(string.substr(i,fndLng)==find){
			string=string.substring(0,i)+replace+string.substring(i+fndLng,string.length);
		}
	}
	return string;
}

function isnumeric(Str){
	var Str2 = Str;
	Str2++;Str2--;
	if(Str==Str2){
		return true;
	} else {
		return false;
	}
}

function Isnumber(Str){
	return isnumeric(Str);
}

function number_format(n){
	n = str_replace(",","",n);
	if(!isnumeric(n)){
		return n;
	} else {
		//
	}
	var l=0,t='',r='';
	n = n.toString();
	do {
		l = n.length;
		t = n.substring(l-3,l);
		n = n.substring(0,l-3);
		if(r!=''){
			r = t+","+r;
		} else {
			r = t;
		}
	} while(n.length>0);
	return r;
}
// alert(number_format("10000"));

$('.selectall').on('click', function(){
	this.select();
})