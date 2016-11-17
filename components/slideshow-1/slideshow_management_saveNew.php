<?

function slideshow_management_saveNew(){
	
	#
	# upload photo
	$file_nnme_arr = fileupload_upload( array("input"=>"slideshow") );
	
	#
	# insert
	$name = trim($_REQUEST['name']);
	$link = trim($_REQUEST['link']);
	$description = trim($_REQUEST['description']);
	
	if(! dbq(" INSERT INTO `slideshow` (`name`,`link`,`description`,`pic`) VALUES ('$name','$link','$description','".$file_nnme_arr[0]."') ") ){
		echo dbe();
	}

}


