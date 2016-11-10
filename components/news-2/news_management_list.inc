<?

function news_management_list(){
	switch($_REQUEST['do']){
		case 'saveNew' : 
			news_management_saveNew();
			break;
		case 'saveEdit' : 
			news_management_saveEdit();
			break;
		case 'remove' : 
			$id = intval($_REQUEST['id']);
			dbq(" DELETE FROM `news` WHERE `id`='$id' LIMIT 1 ");
			break;
	}
	
	$list['query'] = " SELECT * FROM `news` WHERE 1 ORDER BY `id` DESC ";
	$list['target_url'] = '_URL."/?page=".$_REQUEST["page"]."&cp=".$_REQUEST["cp"]."&func=news_management_form&p=".$_REQUEST["p"]."&id=".$rw["id"]';
	$list['paging_url'] = '_URL."/?page=".$_REQUEST["page"]."&cp=".$_REQUEST["cp"]."&func=".$_REQUEST["func"]';
	$list['remove_url'] = '_URL."/?page=".$_REQUEST["page"]."&cp=".$_REQUEST["cp"]."&func=".$_REQUEST["func"]."&p=".$_REQUEST["p"]."&do=remove&id=".$rw["id"]';
	$list['remove_prompt'] = '"آیا مایل به حذف خبر با عنوان ".$rw["name"]." هستید?"';
	
	$list['list_array'] = array(
		// picture
		array(	"picture" => '$rw["pic"]'),
		
		// name
		array(	"content" => '$rw["name"]'),
		
		// text
		array(	"content" => 'substr(strip_tags($rw["text"]),0,300)." .."'),
		
	);
	echo listmaker_list($list);
}


