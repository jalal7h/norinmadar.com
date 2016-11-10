<?
#v 2014-jan-9

function listmaker_select_options($table_name,$condition="",$returnArray=false){
	
	if(!$rs = dbq(" SELECT * FROM `$table_name` WHERE 1 ".$condition)){
		$c.= "err ".__LINE__;
	} else if(!dbn($rs)){
		$c.= "err ".__LINE__." - SELECT * FROM `$table_name` WHERE 1 ".$condition;
	} else while($rw = dbf($rs)){
		if($returnArray){
			$c[$rw['id']] = $rw['name'];
		} else {
			$c.= "<option value='".$rw['id']."' >".$rw['name']."</option>";
		}
	}
	
	return $c;
}


