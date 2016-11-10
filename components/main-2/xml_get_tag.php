<?

function xml_get_tag( $xml , $tag ){
	$tmp0 = $xml;
	$tmp0 = explode("</$tag>", $tmp0);
	$tmp0 = $tmp0[0];
	$tmp0 = explode("<$tag>", $tmp0);
	$tmp0 = $tmp0[1];
	// $tmp0 = base64_decode($tmp0);
	return $tmp0;
}

