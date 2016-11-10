<?
$GLOBALS['cmp']['faq_management'] = 'سوالات متداول';

function faq_management(){

	$url = "./?page=admin&cp=".$_REQUEST['cp'];
	$menu = array(
		$_REQUEST['cp']."_list" => "لیست سوالات",
		$_REQUEST['cp']."_form" => "ثبت سوال جدید",
	);
	listmaker_tabmenu($menu,$url);
}

