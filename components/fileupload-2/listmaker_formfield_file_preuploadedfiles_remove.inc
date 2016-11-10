<?
$GLOBALS['do_action'][] = 'listmaker_formfield_file_preuploadedfiles_remove';

function listmaker_formfield_file_preuploadedfiles_remove(){
	if(!admin_logged()){
		e(__FILE__.__LINE__);
	} else if(!$path = $_REQUEST['path']){
		e(__FILE__.__LINE__);
	} else if(!in_array($path, $_SESSION['listmaker_formfield-validtoremove'])){
		e(__FILE__.__LINE__);
	} else if(!unlink($path)){
		e(__FILE__.__LINE__);
	} else {
		e("$path removed");
		die();
	}

	e("invalid access for fileupload_remove");
	die();
}

