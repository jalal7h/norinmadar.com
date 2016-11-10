<?
$GLOBALS['footergrid'][] = 'linkbar_footergrid';

function linkbar_footergrid(){
	$c = "<div class='grid-container' >";
	$tdd = 4;
	if(!$rs = dbq(" SELECT * FROM `_links` WHERE `parent`=0 ORDER BY `_id` ASC LIMIT $tdd ")){
		$c.= "err - ".__LINE__;
	} else if(!dbn($rs)){
		;//
	} else while($rw = dbf($rs)){
		$c.= "<a href='".$rw['_url']."'>".$rw['_title']."</a>";
	}
	$c.= "</div>";
	
	return $c;
}





