<?

// list of files in /path/to/files

function fileupload_filelist($path){
	if(!$dp = @opendir($path)){
		// echo "err - ".__LINE__;
	} else while($d = @readdir($dp)){
		if(substr($d, 0, 1)=='.'){
			continue;
		} else {
			$list[] = $path."/".$d;
		}
	}
	
	if(sizeof($list)){
		return $list;
	} else {
		return false;
	}
}



