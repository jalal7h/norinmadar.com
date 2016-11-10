<?

$GLOBALS['block_layers']['news_list'] = 'لیست خطی خبر ها';

function news_list( $table_name=null , $page_id=null ){
	$content.= "<div class='news_list'>";
	$tdd = 10;
	$stt = $tdd * intval($_REQUEST['p']);
	if($q = $_REQUEST['q']){
		$q_query = " AND (`name` LIKE '%$q%' OR `text` LIKE '%$q%' OR `tag` LIKE '%$q%') ";
	}
	$query = " SELECT * FROM `news` WHERE 1 $q_query ORDER BY `date` DESC LIMIT $stt , $tdd ";
	if(!$rs = dbq($query)){
		$content.= dbe();
	} else if(!dbn($rs)){
		$content.= "</div>";
		return false;
	} else while($rw = dbf($rs)){
		$content.= news_list_this($rw);
	}
	$link = "./?page=".$_REQUEST['page']."&p=";
	$content.= listmaker_paging($query, $link, $tdd);
	$content.= "</div>";

	if($page_id){
		$title = table( $table_name , $page_id , "_title" , "_id" );
		create_box( $title , $content, $allow_eval=false, $framed=true, $position="center");
	} else {
		echo $content;
	}

	return true;
}

function news_list_this( $rw ){
	$link = news_link( $rw );
	$date = vaght_2_taghvim( U2Vaght($rw['date']) );
	$text = sub_string(trim(strip_tags($rw['text'])),0,500);
	$tag = "";
	if($rw['tag']){
		$tag = $rw['tag'];
		$tag = str_replace("،", ",", $tag);
		$tag = explode(",", $tag);
		if(sizeof($tag)>0){
			foreach ($tag as $k => $r ) {
				$tag_arr[] = "<a href='./?q=".urlencode($r)."' >$r</a>";
			}
			$tag = "کلمات کلیدی: ".implode(" , ", $tag_arr);
		}
	}
	$c = '
	<div class="r" >
		<a href="'.$link.'" class="r" >
			<img src="resize/310x224/'.$rw['pic'].'" />
			<div class="visit">'.$rw['visit'].' بازدید</div>
			<div class="name">'.$rw['name'].'</div>
		</a>
		<div class="date">'.$date.'</div>
		<div class="text">'.$text.' ..</div>
		<div class="tag">'.$tag.'</div>
	</div>';

	return $c;
}

