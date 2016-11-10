<?
$GLOBALS['cmp']['billing_management'] = 'حسابداری';

function billing_management(){
	$url = "./?page=admin&cp=".$_REQUEST['cp'];
	$menu = array(
		$_REQUEST['cp']."_stat" => "حساب روزانه" ,
		$_REQUEST['cp']."_users" => "فاکتور های کاربران" ,
		$_REQUEST['cp']."_methods" => "درگاه پرداخت آنلاین" ,
		$_REQUEST['cp']."_offline" => "پرداخت آفلاین" ,

	);
	listmaker_tabmenu($menu,$url);
}

