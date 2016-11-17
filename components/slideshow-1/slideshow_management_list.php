<?

function slideshow_management_list(){
	
	switch($_REQUEST['do']){
		case 'saveNew' : 
			slideshow_management_saveNew();
			break;
		case 'saveEdit' : 
			slideshow_management_saveEdit();
			break;
		case 'remove' : 
			$id = intval($_REQUEST['id']);
			dbq(" DELETE FROM `slideshow` WHERE `id`='$id' LIMIT 1 ");
			break;
	}
	
	$list['query'] = " SELECT * FROM `slideshow` WHERE 1 ORDER BY `id` DESC ";
	$list['target_url'] = '_URL."/?page=".$_REQUEST["page"]."&cp=".$_REQUEST["cp"]."&func=slideshow_management_form&p=".$_REQUEST["p"]."&id=".$rw["id"]';
	$list['paging_url'] = '_URL."/?page=".$_REQUEST["page"]."&cp=".$_REQUEST["cp"]."&func=".$_REQUEST["func"]';
	$list['remove_url'] = '_URL."/?page=".$_REQUEST["page"]."&cp=".$_REQUEST["cp"]."&func=".$_REQUEST["func"]."&p=".$_REQUEST["p"]."&do=remove&id=".$rw["id"]';
	$list['remove_prompt'] = '("آیا مایل به حذف اسلاید با عنوان ".$rw["name"]." هستید?")';
	
	$list['list_array'] = array(
		// picture
		array(	"picture" => '$rw["pic"]'),
		
		// name
		array(	"content" => '$rw["name"]'),
		
		// description
		array(	"content" => '$rw["description"]'),
		
	);

	echo listmaker_list($list);

}


