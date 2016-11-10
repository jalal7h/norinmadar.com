
$(document).ready(function(){

	$('#contact_display').on('submit', function(){
		if( $("#contact_display select").val()=='' ){
			alert("لطفا گیرنده پیام را به درستی وارد کنید");
		} else if( $("#contact_display input:nth-child(1)").val()=='' ){
			alert("لطفا نام خود را به درستی وارد کنید");
		} else if( $("#contact_display input:nth-child(3)").val()=='' ){
			alert("لطفا آدرس ایمیل خود را به درستی وارد کنید");
		} else if( $("#contact_display textarea").val()=='' ){
			alert("لطفا متن پیام را به درستی وارد کنید");
		} else {
			return true;
		}

		return false;
	});
})


