<?

function clear_title($t){
	
	// return $t;
	
	$t = str_replace(array("&gt;","&lt;","&amp;","&nbsp;","&raquo;","&laquo;","quot;","quot","laquo","raquo")," ",$t);
	$t = str_replace(array("<![","]>","CDATA")," ",$t);
	$t = str_replace(array(";","-","[","]","\\")," ",$t);
	$t = str_replace(array("&gt;","&lt;","%","?","&","*"," ","+","#","@",";","-","[","]","CDATA")," ",$t);
	$t = strip_tags($t);
	$t = trim($t);
	
	return $t;
}

function clear_text($t){
	
	//return "text";
	
	$t = str_replace(array("<![","]>","CDATA")," ",$t);
	$t = strip_tags($t);
	$t = str_replace(array("&gt;","&lt;","&amp;","&nbsp;","&zwnj;","&hellip;","&ocirc;","&lrm;","&apos;","&raquo;","&laquo;","quot;","laquo","raquo")," ",$t);
	$t = str_replace(array(";","-","[","]")," ",$t);
	$t = str_replace(array("&gt;","&lt;","%","?","&","*","+","#","@","\\",";","-","[","]",">","<","/")," ",$t);
	$t = trim($t);
	
	return $t;
}


