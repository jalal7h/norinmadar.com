<?
$GLOBALS['do_action'][] = 'users_logout';

function users_logout(){
	unset($_SESSION['uid']);
	echo "<script>location.href='./';</script>";
	die();
}

