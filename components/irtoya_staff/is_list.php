<?

# jalal7h@gmail.com
# 2015/10/20
# Version 1.0.0

function is_list(){

	?>
	<form class="is_list_search" method="get" action="">
		<input type="hidden" name="page" value="<?=$_REQUEST['page']?>">
		<input type="text" placeholder="جستجو در بین قطعات ..." name="q" value="<?=$_REQUEST['q']?>">
		<input type="submit" class="submit_button" value="جستجو" />
	</form>
	<?

	$list['name'] = 'is_list';
	$list['head'] = '';
	$list['tdd'] = 12;
	$list['quiet_if_empty'] = false;
	$list['exclude_in_query'] = true;
	$list['progressive'] = false;
	$list['query'] = " SELECT * FROM `irtoya_staff` WHERE 1 ORDER BY `id` DESC ";
	$list['target_url'] = 'is_linkk( $rw )';
	$list['target_blank'] = false;
	$list['paging_url'] = '_URL."/?page=".$_REQUEST["page"]."&q=".$_REQUEST["q"]."&p=%%"';
	$list['pattern'] = 'is_list_this($rw)';
	$list['search'] = array("name","brand_fa","brand_en","model_fa","model_en");

	echo listmaker_showcase($list);
}

function is_list_this( $rw ){
	$path = "data/autoparts/".$rw['id'];
	if(!$list = fileupload_filelist($path)){
		$list[0] = 'image.list/is-no-pic.jpg';
	}
	for($i=1; $i<sizeof($list) and $i<5; $i++){
		$tinypics.= "<img src='resize/100x100/".$list[$i]."' />\n";
	}
	for(    ; $i<5; $i++){
		$tinypics.= "<img src='image.list/is-no-pic.jpg' />\n";
	}

	$c.= "
	<img class='main' src='".$list[0]."' />
	<div class='tiny' >
		".$tinypics."
	</div>
	<div>
		<div class='text'>".$rw['name']."، ".$rw['brand_fa']." ".$rw['model_fa']."</div>
		<div class='order'>ثبت سفارش</div>
	</div><!-- text -->
	";

	return $c;
}

function is_linkk( $rw ){
	return _URL."/product-".$rw["id"]."-".name_for_link($rw["name"]).".html";
}


