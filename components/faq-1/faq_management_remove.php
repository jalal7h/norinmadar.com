<?

function faq_management_remove(){
	if(!$id = $_REQUEST['id']){
		e("error on faq_management_saveEdit - ".__LINE__);
	} else if(!dbq(" DELETE FROM `faq` WHERE `id`='$id' LIMIT 1 ")){
		e("error on faq_management_saveEdit - ".__LINE__);
	} else {
		
	}
}

