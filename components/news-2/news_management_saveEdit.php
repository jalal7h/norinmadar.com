<?

function news_management_saveEdit(){
	if(!$id = $_REQUEST['id']){
		echo "err - ".__LINE__;
		return false;
	} else if(!$tnews = table("news",$id)){
		echo "err - ".__LINE__;
		return false;
	}
	#
	# upload photo
	#
	# update db
	$name = trim($_REQUEST['name']);
	$tag = trim($_REQUEST['tag']);
	$text = trim($_REQUEST['text']);
	

	$file_nnme_arr = fileupload_upload( array("id"=>$id, "input"=>"news") );
	
	if(! dbq(" UPDATE `news` SET `name`='$name',`tag`='$tag',`pic`='".$file_nnme_arr[0]."'	,`text`='$text' WHERE `id`='$id' LIMIT 1 ")){
	
		e(__FUNCTION__.__LINE__);
	
	} else {
	
	
	}

}


