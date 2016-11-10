<?php

# jalal7h@gmail.com
# 2015/10/07
# Version 1.1.2

$GLOBALS['block_layers']['faq_display'] = 'سوالات متداول';

function faq_display($table_name=null, $page_id=null){
	if(!$rs = dbq(" SELECT * FROM `faq` WHERE 1 ORDER BY `name` ASC ")){
		e("error on faq_display - ".__LINE__);
	} else if(!dbn($rs)){
		e("error on faq_display - ".__LINE__);
	} else while($rw = dbf($rs)){
		$list[] = array("name"=>$rw['name'], "text"=>$rw['text']);
	}

	$content = listmaker_clicktab($list);

	if($page_id){
		$title = table( $table_name , $page_id , "_title" , "_id" );
		create_box( $title , "<br>".$content, $allow_eval=false, $framed=true, $position="center");
	} else {
		echo $content;
	}
}

