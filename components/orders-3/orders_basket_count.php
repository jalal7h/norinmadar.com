<?

function orders_basket_count(){
	if(!$_REQUEST['id']){
		continue;
	} else {
		$_SESSION['orders_basket'][intval($_REQUEST['id'])] = intval($_REQUEST['count']);
	}
}

