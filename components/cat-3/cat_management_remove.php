<?

function cat_management_remove(){
	if(!$id = $_REQUEST['id']){
		;//echo "err - ".__LINE__;
	} else if(!dbq(" DELETE FROM `cat` WHERE `id`='$id' LIMIT 1 ")){
		echo dbe();
	}
}

