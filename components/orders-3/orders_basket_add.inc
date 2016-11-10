<?

function orders_basket_add(){
	if(!$id = intval($_REQUEST['id'])){
		error_log(__LINE__);
	} else if($_SESSION['orders_basket'][ $id ]){
		error_log(__LINE__);
	} else {
		$_SESSION['orders_basket'][ $id ]++;
	}
	
	echo "<script>location.href='./orders-basket';</script>";
	die();
}

