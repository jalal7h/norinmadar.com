<?

# jalal7h@gmail.com
# 2015/00/00
# Version 1.0.0

function is_management_saveNew(){
	
	foreach ($GLOBALS['irtoya_staff_order_of_columns'] as $k => $column) {
		$columns[] = "`".$column."`";
		$values[] =  "'".$_REQUEST[ $column ]."'";
	}

	if(!dbq(" INSERT INTO `irtoya_staff` (".implode(',', $columns).") VALUES (".implode(',', $values).") ")){
		e(__FUNCTION__.__LINE__);
	} else {
		return true;
	}

	#
	# photo
	$id = dbi();
	fileupload_upload( array("id"=>$id, "input"=>"autoparts") );


	return false;
}
