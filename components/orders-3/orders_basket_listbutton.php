<?

function orders_basket_listbutton(){
	if(sizeof($_SESSION['orders-basket'])==0){
		return true;
	} else {
		echo "<a class='orders_basket_addbutton' href='orders-basket-".$rw['id']."'><img src='".imgp("orders_basket_addbutton.png")."' /></a>";
	}
}

