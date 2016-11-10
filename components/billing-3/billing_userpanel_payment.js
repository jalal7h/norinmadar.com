
$(document).ready(function(){
	$('.billing_userpanel_payment').on('submit', function( event ){
		if( $('#billing_cost').val()=='' || $('#billing_cost').val()<100 || (blngpf.method.value=='wallet' && parseInt($('#billing_cost').val())>billing_userCredit) ){
			$('#billing_cost').focus();
			$('#billing_cost').css({'border':'1px solid red'});
		} else if(blngpf.method.value==''){
			$('.billing_userpanel_payment div.text').css({'color': 'red','font-size':'22px'});
		} else {
			console.log( blngpf.cost.value );
			console.log( ppc_userCredit );
			blngpf.submit();
		}
		event.preventDefault();
	});
});

