<?

# jalal7h@gmail.com
# 2015/00/00
# Version 1.0.0

function is_management_saveEdit(){

	foreach ($GLOBALS['irtoya_staff_order_of_columns'] as $k => $column) {
		$columns_and_values[] = "`".$column."`='".$_REQUEST[ $column ]."'";
	}

	

	if(!$id = $_REQUEST['id']){
		e(__FUNCTION__.__LINE__);
	} else if(!dbq(" UPDATE `irtoya_staff` SET ".implode(',', $columns_and_values)." WHERE `id`='".$id."' LIMIT 1 ")){
		e(__FUNCTION__.__LINE__);
	} else {
		fileupload_upload( array("id"=>$id, "input"=>"autoparts") );
		return true;
	}


	return false;
}
