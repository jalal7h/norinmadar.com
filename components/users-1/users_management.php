<?
$GLOBALS['cmp']['users_management'] = 'کاربران';

function users_management(){
	switch($_REQUEST['do']){
		case 'login':
			users_management_login();
			break;
		case 'remove':
			users_management_remove();
			break;
	}
	$list['query'] = " SELECT * FROM `users` WHERE `permission`='0' ORDER BY `id` DESC ";
	$list['target_url'] = '_URL."/?page=".$_REQUEST["page"]."&cp=".$_REQUEST["cp"]."&do=login&id=".$rw["id"]';
	$list['paging_url'] = '_URL."/?page=".$_REQUEST["page"]."&cp=".$_REQUEST["cp"]."&func=".$_REQUEST["func"]';
	$list['remove_url'] = '_URL."/?page=".$_REQUEST["page"]."&cp=".$_REQUEST["cp"]."&do=remove&id=".$rw["id"]';
	$list['remove_prompt'] = '"آیا مایل به حذف  کاربر هستید?"';
	$list['list_array'] = array(
		#
		# name
		array( "head" => "نام کاربر" , "content" => '"<span title=\'".$rw[\'username\']."\'>".$rw["name"]."</span>"' , "attr" => array( "width" => "200px" , "align" => 'center' , "dir" => "rtl") ),
		#
		# payments
		array( "head" => "پرداخت" , "content" => 'number_format(intval(dbr(dbq(" SELECT SUM(`cost`) FROM `billing_invoice` WHERE `uid`=\'".$rw[\'id\']."\' AND `date`>0 AND `method`!=\'wallet\' "),0,0)))." تومان"' , "attr" => array( "align" => 'right',"dir" => "rtl") ),
		#
		# credit
		array( "head" => "اعتبار" , "content" => 'number_format(billing_userCredit($rw["id"]))." تومان"' , "attr" => array( "align" => 'right',"dir" => "rtl") ),
	);
	echo listmaker_list($list);
}

