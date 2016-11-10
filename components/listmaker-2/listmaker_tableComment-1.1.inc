<?

# jalal7h@gmail.com
# 2015/09/29
# Version 1.1

function lmtc( $table_n_field ){
	return listmaker_tableComment( $table_n_field );
}

function listmaker_tableComment( $table_n_field ){
	#
	# fix variables
	$table_n_field = explode(":", $table_n_field);
	$table = trim($table_n_field[0]);
	$field = trim($table_n_field[1]);
	#
	# get the name
	if(!$rs = dbq(" SELECT COLUMN_COMMENT FROM INFORMATION_SCHEMA.COLUMNS WHERE table_schema='".$GLOBALS['dtbname']."' AND table_name='".$table."' and `COLUMN_NAME`='".$field."' ")){
		e(__FUNCTION__.__LINE__);
	} else if(!$comment = dbr($rs, 0, 0)){
		e(__FUNCTION__.__LINE__);
	} else {
		return $comment;
	}
}

