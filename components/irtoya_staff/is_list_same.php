<?

# jalal7h@gmail.com
# 2015/10/20
# Version 1.0.0

function is_list_same(){

	$list['name'] = 'is_list_same';
	$list['head'] = '';
	$list['tdd'] = 2;
	$list['quiet_if_empty'] = false;
	$list['exclude_in_query'] = true;
	$list['progressive'] = false;
	$list['query'] = " SELECT * FROM `irtoya_staff` WHERE 1 AND `id`!='".$_REQUEST['id']."' ORDER BY rand() ";
	$list['target_url'] = '_URL."/product-".$rw["id"]."-".name_for_link($rw["name"]).".html"';
	$list['target_blank'] = true;
	$list['pattern'] = 'is_list_this($rw)';
	
	return listmaker_showcase($list);
}
