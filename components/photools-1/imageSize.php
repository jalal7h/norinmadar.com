<?

function imageSize($src,$wh){
	if(stristr($src,_URL)){
		$src=substr($src,strlen(_URL)+1,strlen($src));
	}
	if(!$SZ = @ getimagesize($src)){
		return '';
	}
	switch($wh){
		case 'w' :
		case 'W' :
			return $SZ[0];
			break;
		case 'h' :
		case 'H' :
			return $SZ[1];
			break;
	}
	return '';
}

