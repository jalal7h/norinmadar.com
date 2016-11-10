<?

# jalal7h@gmail.com
# 2015/10/21
# Version 1.3.3

$GLOBALS['DB_POINTER'] = false;
function db_connect($S=false){
#	if($GLOBALS['DB_POINTER']){
#		return $GLOBALS['DB_POINTER'];
#	} else 
	if(!$db = @mysql_connect($GLOBALS['sqlhost'], $GLOBALS['sqluser'], $GLOBALS['sqlpass'])){
		$prompt = "problem connecting to mysql server - (invalid username / password)";
	} else if(!@mysql_query("SET NAMES 'utf8'")){
		$prompt = "problem setting NAMES - (cant set names)";
	} else if(!@mysql_select_db($GLOBALS['dtbname']) ){
		$prompt = "
		<div style='width:100%;padding-top:8%; font:bold 30px monospace; margin:auto;'>
		<img style='width:350px; max-width:50%; margin-bottom:30px;' src='http://parsunix.com/cdn/img/tools2.png' >
		<br>
		MySQL service is down !
		</div>
		";
	} else {
		$GLOBALS['DB_POINTER']=$db;
		return $db;
	}
	
	if($S==true){
		;
	} else {
		echo "<center class=er1 >$prompt</center>";
		die();
	}
	
	return false;
}


function db_query($query=''){
	if($query==''){
		return false;
	} else {
		if(db_connect()){
			if($res = mysql_query($query)){
				return $res;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
}


function dbq($query=''){
	if(!$query){
		echo "No query defined!";
	} else {
		$query = str_replace("ي","ی",$query);	
		if($query==''){
			return false;
		} else {
			if(db_connect()){
				if($res = mysql_query($query)){
					return $res;
				} else {
					return false;
				}
			} else {
				return false;
			}
		}
	}

	return false;
}


function dbf($rs=null){
	if($rs==null){
		echo "No \$rs pointer defined!";
	} else {
		return mysql_fetch_assoc($rs);
	}

	return false;
}


function dbr($rs=null,$r="",$c=""){
	if($rs==null){
		echo "No \$rs pointer defined!";
	} else if($r==null and $r!==0){
		echo "No \$row pointer defined!";
	} else if($c==""){
		return mysql_result($rs,$r);
	} else {
		return mysql_result($rs,$r,$c);
	}

	return false;
}

function dbn($rs=null){
	if($rs==null){
		echo "No \$rs pointer defined!";
	} else {
		return mysql_num_rows($rs);
	}

	return false;
}

function dbi(){
	return mysql_insert_id();
}

function dbe(){
	// cm_install($force=true);
	return mysql_error();
}

function dbs($table, $array_set, $array_where){
	
	foreach($array_set as $k => $r){
		$string_set[] = "`$k`='$r'";
	}
	$string_set = implode(",",$string_set);
	
	foreach($array_where as $k => $r){
		$string_where[] = "`$k`='$r'";
	}
	$string_where = implode(" AND ",$string_where);

	$query = " UPDATE `$table` SET $string_set WHERE $string_where ";
	// e($query);

	return dbq($query);
}


















