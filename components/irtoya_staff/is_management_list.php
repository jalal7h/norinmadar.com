<?

# jalal7h@gmail.com
# 2015/00/00
# Version 1.0.0

function is_management_list(){
	
	switch ($_REQUEST['do']) {
		
		case 'saveNew':
			is_management_saveNew();
			break;
		
		case 'saveEdit':
			is_management_saveEdit();
			break;
		
		case 'remove':
			is_management_remove();
			break;
		
		default:
			# code...
			break;
	}

	$clmns = $GLOBALS['irtoya_staff_order_of_columns'];
	
	$list['name'] = 'is_management_list';
	$list['query'] = " SELECT * FROM `irtoya_staff` WHERE 1 ORDER BY `id` DESC ";
	$list['tdd'] = 7;
	$list['target_url'] = '_URL."/?page=".$_REQUEST["page"]."&cp=".$_REQUEST["cp"]."&func=".$_REQUEST["cp"]."_form&id=".$rw["id"]';
	$list['paging_url'] = '_URL."/?page=".$_REQUEST["page"]."&cp=".$_REQUEST["cp"]."&func=".$_REQUEST["func"]';
	$list['remove_url'] = '_URL."/?page=".$_REQUEST["page"]."&cp=".$_REQUEST["cp"]."&func=".$_REQUEST["func"]."&do=remove&id=".$rw["id"]';
	$list['remove_prompt'] = '"آیا مایل به حذف مورد به نام ".$rw["name"]." هستید?"';
	
	foreach ($GLOBALS['irtoya_staff_order_of_columns'] as $k => $column) {
		$list['list_array'][] = array("head"=>lmtc("irtoya_staff:".$column), "content" => '$rw[\''.$column.'\']');
		$list['search'][] = $column;
	}

	echo listmaker_list($list);

}
