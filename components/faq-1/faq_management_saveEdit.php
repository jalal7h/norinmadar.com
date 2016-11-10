<?

function faq_management_saveEdit(){
	if(!$id = $_REQUEST['id']){
		e("error on faq_management_saveEdit - ".__LINE__);
	} else if(!$name = $_REQUEST['name']){
		e("error on faq_management_saveEdit - ".__LINE__);
	} else if(!$text = $_REQUEST['text']){
		e("error on faq_management_saveEdit - ".__LINE__);
	} else if(!dbq(" UPDATE `faq` SET `name`='".$name."',`text`='".$text."' WHERE `id`='$id' LIMIT 1 ")){
		e("error on faq_management_saveEdit - ".__LINE__);
	} else {
		
	}
}

