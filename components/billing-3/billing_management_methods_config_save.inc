<?

function billing_management_methods_config_save(){
	if(!$method = $_REQUEST['method']){
		e(__FUNCTION__.__LINE__);
	} else {
		foreach($_REQUEST['datafield'] as $field => $value) {
			$array_of_set[$field] = $value;
		}
		dbs( "billing_method" , $array_of_set , array("method"=>$method) );

		return true;
	}

	return false;
}

