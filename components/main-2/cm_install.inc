<?

# jalal7h@gmail.com
# 2015/10/22
# Version 1.1.0

function cm_install($force=false){

	// return true;

	if(!file_exists("allow.inc")){
		return true;
	}

	cm_install_db();
	cm_install_htaccess();
}

function cm_install_db(){
	asort($GLOBALS['include_all_sql']);
	if(sizeof($GLOBALS['include_all_sql'])==0){
		return true;
	} else foreach($GLOBALS['include_all_sql'] as $k => $sql_path){
		#
		# get the content of sql file
		$sql_this = implode('',file($sql_path));
		if(strstr($sql_this, "\n--spi--\n")){
			continue;
		}
		$sql_content.= $sql_this;
		$log_file++;
		#
		# archive the sql file
		$fpsql = fopen($sql_path, "a+");
		fwrite($fpsql, "\n--spi--\n");
		fclose($fpsql);
	}

	if(!$sql_content = trim($sql_content)){
		return true;
	} else {
		$sql_content = str_ireplace("INSERT INTO ", "\n;cm_install;\nINSERT INTO ", $sql_content);
		$sql_content = str_ireplace("CREATE TABLE ", "\n;cm_install;\nCREATE TABLE ", $sql_content);
		$sql_content = str_ireplace("ALTER TABLE ", "\n;cm_install;\nALTER TABLE ", $sql_content);
		$sql_content = explode(";cm_install;\n", $sql_content);
		foreach($sql_content as $k => $query){
			if(!$query = trim($query)){
				continue;
			} else {
				$query_type = trim( substr($query,0,6) );
				$query_array[ $query_type ][] = $query;
			}
		}
		#
		# CREATE
		foreach($query_array["CREATE"] as $k => $query){
			if(!dbq($query)){
				echo dbe();
				echo "<hr>".$query;
				// die();
			} else {
				$log_create++;
			}
		}
		#
		# ALTER
		foreach($query_array["ALTER"] as $k => $query){
			if(!dbq($query)){
				echo dbe();
				echo "<hr>".$query;
				// die();
			} else {
				$log_alter++;
			}
		}
		#
		# INSERT
		foreach($query_array["INSERT"] as $k => $query){
			if(!dbq($query)){
				echo dbe();
				echo "<hr>".$query;
				// die();
			} else {
				$log_insert++;
			}
		}
		#
		# log display
		echo $log_file." files executed.<br />"; 
		echo $log_create." table created.<br />";
		echo $log_alter." alter done.<br />";
		echo $log_insert." insert done.<br />";
		die();
	}
}

function cm_install_htaccess(){

	# drop loop
	if($_REQUEST['do_action']!=''){
		return true;
	} else if($GLOBALS['cm_install_htaccess']){
		return true;
	}
	$GLOBALS['cm_install_htaccess'] = true;

	$new_ht = "RewriteEngine On\n\n";
	foreach ($GLOBALS['include_all_htaccess'] as $k => $text) {
		$new_ht.= "# \n";
		$ht_tmp = explode("/", $text);
		$new_ht.= "# ".$ht_tmp[1]."\n";
		$ht_tmp = file($text);
		if(!sizeof($ht_tmp)){
			//
		} else {
			foreach ($ht_tmp as $k => $v) {
				if(substr(trim($v),0,1)=="#"){
					// its commented, we should wiave it
					unset($ht_tmp[$k]);
				}
			}
			$ht_tmp = implode('', $ht_tmp);
		}
		$new_ht.= trim($ht_tmp);
		$new_ht.= "\n\n";
	}

	if(!file_exists(".htaccess")){
		$old_ht = "";
	} else {
		$old_ht = trim(file_get_contents(".htaccess"));
	}
	if(trim($new_ht)==trim($old_ht)){
		// e("htaccess same as past");
	} else {
		$fp = fopen(".htaccess", "w");
		fwrite($fp, $new_ht);
		fclose($fp);
		e("htaccess updated.");
	}
}


