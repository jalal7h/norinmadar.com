<?

# jalal7h@gmail.com
# 2015/09/18
# Version 1.1.1

// $list = array(
// 	array("name"=>"000", "text"=>"999"),
// 	array("name"=>"000", "text"=>"999"),
// 	array("name"=>"000", "text"=>"999"),
// );

function listmaker_clicktab($list){
	$c = '<div class="listmaker_clicktab">';
	if(!sizeof($list)){
		e("error on listmaker_clicktab - ".__LINE__);
	} else foreach($list as $k => $tab){
		$c.= '
		<div class="r">
			<div class="name" >'.$tab['name'].'</div>
			<div class="text" >'.nl2br($tab['text']).'</div>
		</div>';
	}
	$c.= '</div>';

	return $c;
}



