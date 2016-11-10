<?

function name_for_link( $name , $length=0 ){
	if($length > 0){
		$name = sub_string($name , 0 , $length);
	}
	$name = mb_ereg_replace('[^A-Za-z0-9آ-ی ]+','',$name);
	$name = trim($name);
	$name = str_replace(" ", "-", $name);
	$name = urlencode($name);

	return $name;
}