<?


function linkbar_index_dropdown(){
	// $content.= '<div id=stat0 >00</div>';
	$content.= '<div class="dropdownmenu">';
	$content.= linkbar_index_ul();
	$content.= '</div>';
	
	return $content;
}

function linkbar_index_ul($parent=0){
	
	if($parent==0){
		$content.= '
		<div onclick="location.href=\'./\'" class="dropmenurecord mainmenu" >
			<a class="link" href="./" >خانه</a>
		</div>';
	}
	
	if(!$rs = dbq(" SELECT * FROM `_links` WHERE `_type`='index' AND `parent`='$parent' ORDER BY `_priority` ")){
		echo "err - ".__LINE__;
		echo dbe();
	} else if(!$nm = dbn($rs)){
		;//
	} else {
		while($rw = dbf($rs)){
			$sublinks = linkbar_index_ul($rw['_id']);
			$link = ($rw['_url']==''?"#":$rw['_url']);
			$content.= '
			<div onclick="location.href=\''.$link.'\'" class="dropmenurecord '.($parent==0?"mainmenu":"submenu").'" >
				<a class="link" href="'.$link.'" >'.$rw['_title'].'</a>
				<div class="box" >'.linkbar_index_ul($rw['_id']).'</div>
			</div>
			';
		}
	}
	
	return $content;
}






