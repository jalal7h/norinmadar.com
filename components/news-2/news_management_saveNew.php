<?

function news_management_saveNew(){

	$name = $_REQUEST['name'];
	$text = $_REQUEST['text'];
	$tag = $_REQUEST['tag'];
	$date = substr(U(),0,10);
	#
	# file upload
	
	$id = dbi();
	$file_nnme_arr = fileupload_upload( array("id"=>$id, "input"=>"news") );
	
	##


	# insert
	if(!dbq(" INSERT INTO `news` (`name`,`text`,`date`,`pic`,`tag`) VALUES ('$name','$text','$date','".$file_nnme_arr[0]."','$tag') ")){
		echo "err - ".__LINE__;
		echo dbe();
	}

	
	#
}


