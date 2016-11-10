<?

# jalal7h@gmail.com
# 2015/07/20
# Version 1.1.3

function listmaker_paging($__query, $__link, $tdd=10, $debug=false){
	
	$__query = str_ireplace(" * "," COUNT(*) ",$__query);
	if(stristr($__query, " LIMIT ")){
		$tmp = explode(' LIMIT ',$__query);
		$__query = $tmp[0];
	}
	if(stristr($__query, " ORDER BY ")){
		$tmp = explode(' ORDER BY ',$__query);
		$__query = $tmp[0];
	}
	if(stristr($__query, " GROUP BY ")){
		$tmp = explode(' GROUP BY ',$__query);
		$__query = $tmp[0];
	}
	
	$page_number_field = $__link;
	if(strstr($page_number_field, "=%%")){
		$page_number_field = explode("=%%", $page_number_field);
		$page_number_field = $page_number_field[0];
		$page_number_field = strrev($page_number_field);
		$page_number_field = explode("&", $page_number_field);
		$page_number_field = $page_number_field[0];
		$page_number_field = strrev($page_number_field);
	} else if(substr(strrev($page_number_field), 0, 1)=="="){
		$page_number_field = strrev($page_number_field);
		$page_number_field = explode("&", $page_number_field);
		$page_number_field = $page_number_field[0];
		$page_number_field = strrev($page_number_field);
		$page_number_field = explode("=", $page_number_field);
		$page_number_field = $page_number_field[0];
	} else {
		$page_number_field = "p";
		if(strstr($__link, "?")){
			$__link.= "&".$page_number_field."=";
		} else {
			$__link.= "?".$page_number_field."=";
		}
	}
	// e("paging - ".__LINE__." : ".$page_number_field);
	$p = intval($_REQUEST[$page_number_field]);
	
	if(!$rs2 = dbq($__query)){
		if($debug)echo "err - ".__LINE__;
		$c.= dbe();
	} else if(!$cnt = dbr($rs2,0,0)){
		if($debug)echo "err - ".__LINE__;
		;//
	} else {
		if($debug)echo "err - ".__LINE__;
		$pge = ceil($cnt / $tdd);
		if($pge > 1){
			$c.= "<div class='listmaker_list_paging' >";
			$c.= "صفحه : ";
			for($i=0; $i<$pge; $i++){
				if($pge>10){
					if($i>=$pge-5){
						;// do
					} else if($i<=5){
						;// do
					} else if($i>=$p+5){
						if(!$second1){
							$c.= " &nbsp; ... ";
							$second1 = true;
						}
						continue;
					} else if($i<=$p-5){
						if(!$second2){
							$c.= " &nbsp; ... ";
							$second2 = true;
						}
						continue;
					}
				}
				if(strstr($__link, "%%")){
					$link = str_replace("%%", $i, $__link);
				} else {
					$link = $__link.$i;
				}
				if($debug)echo "err - ".__LINE__;
				if($p == $i){
					$c.= "<b style=''>".($i+1)."</b> ";
				} else {
					$c.= "<a href='".$link."' >".($i+1)."</a> ";
				}
			}
			$c.= "</div>";
		}
	}
	
	return $c;
}











