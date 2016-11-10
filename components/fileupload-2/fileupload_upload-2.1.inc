<?

# jalal7h@gmail.com
# 2015/08/21
# Version 2.1.1

# $list = array(
# 	$id : name of the subdirectory. (if not null)
# 	$input : name of <input tag. / directory of destination, placed on `data` directory.
# 	$numb : number of the input[] to be saved. (empty == save all).
# 	$ext : valid file extensions for upload (empty = picture) [ jpeg , png , gif , mp4 ]
# );
# $array_of_file_path = fileupload_upload( array("id"=>"2", "input"=>"pic") );

function fileupload_upload( $list ){
	$id = $list['id'];
	$input = $list['input'];
	if(!$numb = $list['numb']){
		$numb = null;
	}
	if(!$ext = $list['ext']){
		$ext = array("jpg","jpeg","gif","png");
	}

	$debug = false;
	
	# make dir
	$base_dir = "data/$input";
	if(!file_exists($base_dir)){
		if($debug)echo "<br>".__LINE__;
		mkdir($base_dir);
	}
	if($id){
		$base_dir.= "/$id";
	}
	if(!file_exists($base_dir)){
		if($debug)echo "<br>".__LINE__;
		mkdir($base_dir);
	}
	
	$_FILE = $_FILES[$input];
	$count = sizeof($_FILE['name']);
	for($i=0; $i<=$count; $i++){
		if($debug)echo "<br>".__LINE__;
		if($numb){
			if($numb!=$i){
				if($debug)echo "<br>".__LINE__;
				continue;
			}
		}
		if($_FILE['error'][$i]!=0){
			if($debug)echo "<br>err ".__LINE__;
			continue;
		} else if($_FILE['size'][$i]==0){
			if($debug)echo "<br>err ".__LINE__;
			continue;
		} else {
			$file_name = $_FILE['name'][$i];
			$file_extn = substr(strtolower(strrchr($file_name, '.')),1);
			$file_nnme = $base_dir."/".$i."-".($id?"":rand(1000,9999)."-").md5($file_name.date("U")).".".$file_extn;
			$file_nnme_arr[] = $file_nnme;
			$file_addr = $_FILE['tmp_name'][$i];
			if(!in_array($file_extn, $ext)){
				if($debug)echo "<br>err ".__LINE__;
				return false;
			} else if(!copy($file_addr,$file_nnme)){
				if($debug)echo "<br>err ".__LINE__;
				return false;
			}
		}
	}
	
	return $file_nnme_arr;
}
