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
	$file_nnme_arr = fileupload_upload( array("input"=>"news") );
	#
	# update db
	$name = trim($_REQUEST['name']);
	$tag = trim($_REQUEST['tag']);
	$text = trim($_REQUEST['text']);
	dbq(" UPDATE `news` SET `name`='$name',`tag`='$tag',`text`='$text' ".($file_nnme_arr[0]?",`pic`='".$file_nnme_arr[0]."'":"")."
	WHERE `id`='$id' LIMIT 1 ");
}


