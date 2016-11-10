<?

# $param_array = array("q_position_" => $rw['id']);
# echo $url = listmaker_geturl($param_array);

function listmaker_geturl($param_array=null){
	foreach($_GET as $k0 => $r0){
		$URI[] = $k0."=".$r0;
	}
	$URI = implode("&",$URI);
	$url = _URL."/?".$URI;
	$url = str_replace("?","?&",$url);
	if(sizeof($param_array)){
		foreach($param_array as $k => $r){
			if($_REQUEST[$k]){
				# url_pre
				$url_tmp = explode("&".$k."=",$url);
				$url_pre = $url_tmp[0];
				# url_pst
				$url_pst = $url_tmp[1];
				//echo "<hr>$url - :$k: - $url_pst<hr>";
				if(strstr($url_pst,"&")){
					$url_pst = substr($url_pst,strpos($url_pst,"&"));
					$url = $url_pre.$url_pst;
				} else {
					$url = $url_pre;
				}
			}
		}
		foreach($param_array as $k => $r){
			if(strstr($url,"?")){
				$url.= "&".$k."=".$r;
			} else {
				$url.= "?".$k."=".$r;
			}
		}
	}
	# clear up url
	$url = str_replace("?&","?",$url);
	$url = str_replace("&&","&",$url);
	
	return $url;
}


