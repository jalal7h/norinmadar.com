<?

function users_management_login(){
	if(!$id = $_REQUEST['id']){
		 e(__LINE__);
	} else {
		$_SESSION['uid'] = $id;
		echo "<script>location.href='"._URL."/userpanel';</script>";
		die();
	}
}