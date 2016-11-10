<?

function orders_management_list_sent(){
	if(!$id = $_REQUEST['id']){
		echo "err - ".__FILE__." : ".__LILE__;
	} else if(!dbq(" UPDATE `orders` SET `date_sent`='".U()."' WHERE `id`='$id' LIMIT 1 ")){
		echo "err - ".__FILE__." : ".__LILE__;
	} else {
		return true;
	}

	return false;
}

