<?

function cat_management_saveEdit(){
	$l = $_REQUEST['l'];
	if(!$name = $_REQUEST['name']){
		;//echo "err - ".__LINE__;
	} else if(!$id = $_REQUEST['id']){
		e("err - ".__LINE__);
	} else {
		$fileupload_upload = fileupload_upload( array("id"=>$l, "input"=>"cat") );
		if($fileupload_upload){
			$query_logo = " , `logo`='".$fileupload_upload[0]."' ";
		}
		if(!dbq(" UPDATE `cat` SET `name`='$name' $query_logo WHERE `id`='$id' LIMIT 1 ")){
			e(dbe());
		}
	}
}

