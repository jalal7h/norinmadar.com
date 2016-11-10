<?

function admin_pre(){
	$rand=$_SESSION['hcfalf'];
	$us=cpt('user'.$rand, true);
	$pw=cpt('pass'.$rand, true);
	$su='ssus'.$rand;
	$sp='sspw'.$rand;
	if(!admin_check($_SESSION['admin'.$su],$_SESSION['admin'.$sp])){
		echo "per la stazione :-B";
		echo 'admin'.$su;
		die();
	}
	
	if(!$_REQUEST['do_pre']){
		;//
	} else if(!function_exists($_REQUEST['do_pre'])){
		echo "err - ".__LINE__;
	} else if(!call_user_func($_REQUEST['do_pre'])){
		echo "err - ".__LINE__;
	} else {
		;//
	}
}



