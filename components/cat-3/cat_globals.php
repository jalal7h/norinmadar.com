<?

foreach($GLOBALS['cat_items'] as $k => $r){
	if($r[1]==true){
		$GLOBALS['cmp']['cat_management&l='.$k] = $r[0];
	}
}


