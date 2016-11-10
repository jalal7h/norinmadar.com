<?

function users_management_remove(){
	$need_confirm = false;
	if(!$id = $_REQUEST['id']){
		e(__LINE__);
	} else if($_REQUEST['confirm']=='1'){
		return users_management_remove_confirm( $id );
	} else {
		echo "<script>if(confirm('آیا مایل به حذف همه اطلاعات این کاربر هستید؟')){location.href='"._URL."/?page=admin&cp=".$_REQUEST['cp']."&do=".$_REQUEST['do']."&id=".$_REQUEST['id']."&p=".$_REQUEST['p']."&confirm=1';}</script>";
	}
}

function users_management_remove_confirm( $id ){
	// remove from etc
	dbq(" DELETE FROM `users` WHERE `id`='$id' LIMIT 1 ");
	echo "<script>location.href='"._URL."/?page=admin&cp=".$_REQUEST['cp']."&p=".$_REQUEST['p']."';</script>";
	die();
}

