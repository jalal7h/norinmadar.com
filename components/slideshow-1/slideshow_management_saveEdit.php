<?

function slideshow_management_saveEdit(){
	
	if(! $id = $_REQUEST['id'] ){
		echo "err - ".__LINE__;
		return false;
		
	} else if(! $tSlideshow = table("slideshow",$id) ){
		echo "err - ".__LINE__;
		return false;
	}
	
	#
	# upload photo
	$file_nnme_arr = fileupload_upload( array("input"=>"slideshow") );
	
	#
	# update db
	$name = trim($_REQUEST['name']);
	$link = trim($_REQUEST['link']);
	$description = trim($_REQUEST['description']);
	dbq(" UPDATE `slideshow` SET `name`='$name', `description`='$description' ".($file_nnme_arr[0]?", `pic`='$file_nnme_arr[0]'":"").", `link`='$link' WHERE `id`='$id' LIMIT 1 ");

}


