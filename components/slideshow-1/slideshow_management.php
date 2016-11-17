<?
$GLOBALS['cmp']['slideshow_management'] = 'اسلایدشو';

function slideshow_management(){
	
	$url = "./?page=admin&cp=".$_REQUEST['cp'];
	$menu = array(
		"slideshow_management_list" => ("لیست اسلایدها"),
		"slideshow_management_form" => ("ثبت اسلاید جدید"),
	);

	listmaker_tabmenu($menu,$url);

}


