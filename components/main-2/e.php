<?

function e($text){
	#
	// echo "<center>".$text."</center>";
	
	#
	// $fp = fopen("e","a+");fwrite($fp, date("[Y/m/d H:i:s] ").$text."\n");fclose($fp);

	#
	error_log($text);

	return false;
}


