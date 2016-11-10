<?






##________________________________________________________________________________________________________
function tab__temp($key='', $insert=false, $val=NULL){
	if(!$key){
		return false;
	}
	if($insert==true){
		if(!$res=db_query(" update `_temp` set `_val`='$val' where `_key`='$key' limit 1 ")){
			;// do nothing
		}
	}
	if(!$res=db_query(" select `_val` from `_temp` where `_key`='$key' limit 1 ")){
		;// do nothing
	} else if(mysql_num_rows($res)!=1) {
		;// do nothing
	} else {
		return mysql_result($res,0,0);
	}
	return false;
}


function table($tableName, $id=null, $fieldName=null, $idFieldName="id"){
	if(!$rs = dbq(" SELECT ".($fieldName?"`$fieldName`":"*")." FROM `$tableName` 
		WHERE ".($id==null?'1':"`$idFieldName`='$id' LIMIT 1")." ")){
		echo "err - table - $tableName, $id, $fieldName";
		echo mysql_error();
	} else if(mysql_num_rows($rs)!=1){
		//echo "error - no record found on table $tableName:$id:$fieldName";
		return false;
	} else {
		if($fieldName){
			return mysql_result($rs, 0, 0);
		} else {
			return mysql_fetch_assoc($rs);
		}
	}
}




?>
