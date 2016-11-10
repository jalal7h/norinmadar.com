<?

function orders_management_list_remove(){
	if(!$order_id = $_REQUEST['id']){
		echo "err - ".__FILE__." : ".__LILE__;
	} else if(!dbq(" DELETE FROM `orders_item` WHERE `order_id`='$order_id' ")){
		echo "err - ".__FILE__." : ".__LILE__;
	} else if(!dbq(" DELETE FROM `orders` WHERE `id`='$order_id' LIMIT 1 ")){
		echo "err - ".__FILE__." : ".__LILE__;
	} else {
		return true;
	}

	return false;
}

