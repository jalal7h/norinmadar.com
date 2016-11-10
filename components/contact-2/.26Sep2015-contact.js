
$(document).ready(function(){

	$('#contact_form').on('submit', function(){
		if(document.getElementById('_dest').value==''){
			alert('لطفاَ دريافت کننده ايميل را مشخص کنيد');
			return false;
		}
		if( 0
			|| (form21.name.value=='')
			|| (form21.tell.value=='')
			|| (form21._mail.value=='')
		){
			alert('لطفاَ اطلاعات را کامل وارد کنيد');
			return false;
		}
		if(!mailValidate(document.getElementById('_mail').value)){
			return false;
		}
	});
})


