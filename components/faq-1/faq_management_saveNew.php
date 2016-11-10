<?

function faq_management_saveNew(){
	if(!$name = $_REQUEST['name']){
		e("error on faq_management_saveNew - ".__LINE__);
	} else if(!$text = $_REQUEST['text']){
		e("error on faq_management_saveNew - ".__LINE__);
	} else if(!dbq(" INSERT INTO `faq` (`name`,`text`) VALUES ('".$name."','".$text."') ")){
		e("error on faq_management_saveNew - ".__LINE__);
	} else {
		
	}
}

