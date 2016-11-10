
$(document).ready(function(){
	$('form.billing_userpanel_payment_offline').on('submit', function(e){
		if( $(this).find('input[name="transaction"]').val()=='' ){
			alert('لطفا شماره تراکنس / سریال را وارد کنید');
			e.preventDefault();
		} else if( $(this).find('input[name="date"]').val()=='' ){
			alert('لطفا تاریخ پرداخت را وارد کنید');
			e.preventDefault();
		} else {
			return true;
		}
	});
});

