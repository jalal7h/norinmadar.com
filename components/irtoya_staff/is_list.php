<?

# amirzakaria110@gmail.com
# 2015/10/20
# Version 1.0.0

$GLOBALS['block_layers']['is_list']="لیست محصولات";

function is_list($table_name=null , $page_id=null){
	
	if( $_REQUEST['q'] ){
		return;
	}

	if( $cat_id = $_REQUEST['cat_id'] ){
		$cat_query = " AND `cat`='$cat_id' ";
	}

	$list['name'] = 'is_list';
	$list['head'] = '';
	$list['tdd'] = 9;
	$list['quiet_if_empty'] = false;
	$list['exclude_in_query'] = true;
	$list['progressive'] = false;
	$list['query'] = " SELECT * FROM `irtoya_staff` WHERE 1 $cat_query ORDER BY `id` DESC ";
	$list['target_url'] = 'is_linkk( $rw )';
	$list['target_blank'] = false;
	$list['paging_url'] = '_URL."/?page=".$_REQUEST["page"]."&q=".$_REQUEST["q"]."&p=%%"';
	$list['pattern'] = 'is_list_this($rw)';
	$list['search'] = array("name","cat");
	
	if( $page_id ){
		$title = table( $table_name , $page_id , "_title" , "_id" );
		create_box($title, $allow_eval=false, $framed=true, $position="center");
	
	} else {
		echo $content;
	}

	echo listmaker_showcase($list);

}


function is_list_this( $rw ){

	$path = "data/autoparts/".$rw['id'];
	
	if(! $list = fileupload_filelist($path) ){
		$list[0] = 'image.list/is-no-pic.png';
	}

	for( $i=1; $i<sizeof($list) and $i<5; $i++ ){
		$tinypics.= "<img src='resize/100x100/".$list[$i]."' />\n";
	}

	$c.= "
		<img class='main' src='".$list[0]."' />
		
			
		<div>
			<div class='text'>".$rw['name']."، ".$rw['brand_fa']." ".$rw['model_fa']."</div>
			<div class='order'>ثبت سفارش</div>
		</div><!-- text -->


	";

	return $c;

}

function is_linkk( $rw ){
	return _URL."/product-".$rw["id"]."-".name_for_link($rw["name"])."-cat_id-".$rw["cat"].".html";
}
 
 

