<?

# jalal7h@gmail.com
# 2015/10/18
# Version 1.1.1

function linkbar_index_simple( $class=null ){
	$content.= '<div class="linkbar_index_simple'.($class?" ".$class:"").'">';
	$content.= linkbar_index_simple_ul();
	$content.= '</div>';
	
	return $content;
}

function linkbar_index_simple_ul($parent=0){
	
	if(!$rs = dbq(" SELECT * FROM `_links` WHERE `_type`='index' AND `parent`='$parent' AND `_status`='1' ORDER BY `_priority` ")){
		echo __FUNCTION__.__LINE__;
		echo dbe();
	} else if(!$nm = dbn($rs)){
		;//
	} else while($rw = dbf($rs)){
		$link = ($rw['_url']==''?"#":$rw['_url']);
		$content.= '<a href="'.$link.'">'.$rw['_title'].'</a>';
	}
	
	return $content;
}






