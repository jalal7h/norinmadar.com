<?
$GLOBALS['cmp']['news_management'] = 'مدیریت خبرها';

function news_management(){
	$url = "./?page=admin&cp=".$_REQUEST['cp'];
	$menu = array(
		"news_management_list" => "لیست خبرها",
		"news_management_form" => "ثبت خبر جدید",
	);
	listmaker_tabmenu($menu,$url);
}


