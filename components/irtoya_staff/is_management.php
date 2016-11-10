<?

# jalal7h@gmail.com
# 2015/10/20
# Version 1.0.0

$GLOBALS['cmp']['is_management'] = 'قطعات خودرو';

function is_management(){
	$url = "./?page=admin&cp=".$_REQUEST['cp'];
	$menu = array(
		$_REQUEST['cp']."_list" => "لیست قطعات",
		$_REQUEST['cp']."_form" => "ثبت قطعه جدید",
		$_REQUEST['cp']."_import_form" => "خروجی اکسل",
	);
	listmaker_tabmenu($menu,$url);
}



$GLOBALS['irtoya_staff_order_of_columns'] = array(
	'code',
	'brand_en',
	'brand_fa',
	'name',
	'year',
	'model_en',
	'model_fa',
	'quality',
	'price',
	'desc',
);


