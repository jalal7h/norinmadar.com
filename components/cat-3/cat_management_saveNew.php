<?

function cat_management_saveNew(){
	
	#
	# checking for variables
	$l = $_REQUEST['l'];
	$parent = intval($_REQUEST['parent']);

	#
	# uploading the logo file
	$fileupload_upload = fileupload_upload( array("id"=>$l, "input"=>"cat") );
	$logo = $fileupload_upload[0];
	
	#
	# trying to put it into db
	if(!$name = $_REQUEST['name']){
		return false;
	} else if(!dbq(" INSERT INTO `cat` (`name`,`cat`,`parent`,`logo`) VALUES ('$name','$l','$parent','$logo') ")){
		e(dbe());
	}
}

