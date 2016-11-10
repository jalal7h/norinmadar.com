<?

function lmtc( $table_n_field ){
	return listmaker_tableComment( $table_n_field );
}

function listmaker_tableComment( $table_n_field ){
	#
	# fix variables
	$table_n_field = explode(":", $table_n_field);
	$table = $table_n_field[0];
	$field = $table_n_field[1];
	#
	# get the name
	if(!$rs = dbq(" SELECT COLUMN_COMMENT FROM INFORMATION_SCHEMA.COLUMNS WHERE table_schema='".$GLOBALS['dtbname']."' AND table_name='".$table."' and `COLUMN_NAME`='".$field."' ")){
		e("listmaker_tableComment - ".__LINE__);
	} else if(!$comment = dbr($rs, 0, 0)){
		e("listmaker_tableComment - ".__LINE__);
	} else {
		return $comment;
	}
}

