<?
$GLOBALS['cmp']['orders_management'] = 'لیست سفارشات';

function orders_management(){
	$url = "./?page=admin&cp=".$_REQUEST['cp'];
	$menu = $GLOBALS['orders_management-menu'];
	listmaker_tabmenu($menu,$url);
}

