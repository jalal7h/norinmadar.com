<?

function faq_management_list(){
	
	switch ($_REQUEST['do']) {
		case 'saveNew':
			faq_management_saveNew();
			break;
		
		case 'saveEdit':
			faq_management_saveEdit();
			break;

		case 'remove':
			faq_management_remove();
			break;
	}

	$list['name'] = 'faq_management_list';
	$list['query'] = " SELECT * FROM `faq` WHERE 1 ORDER BY `name` ASC ";
	$list['tdd'] = 12;
	$list['target_url'] = '_URL."/?page=".$_REQUEST["page"]."&cp=".$_REQUEST["cp"]."&func=".$_REQUEST["cp"]."_form&id=".$rw["id"]';
	$list['paging_url'] = '_URL."/?page=".$_REQUEST["page"]."&cp=".$_REQUEST["cp"]."&func=".$_REQUEST["func"]';
	$list['remove_url'] = '_URL."/?page=".$_REQUEST["page"]."&cp=".$_REQUEST["cp"]."&func=".$_REQUEST["func"]."&do=remove&id=".$rw["id"]';
	$list['remove_prompt'] = '"آیا مایل به حذف هستید?"';
	$list['list_array'] = array (
		array("content" => '$rw[\'name\']'),
	);
	$list['search'] = array("name");
	echo listmaker_list($list);
}

