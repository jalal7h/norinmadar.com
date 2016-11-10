<?

# jalal7h@gmail.com
# 2014/07/02
# Version 1.9.1

function template_engine($tpl=NULL, $vars=NULL, $tplFrame=NULL){
	
	$tplAddr = $GLOBALS['include_all_template'][$tpl.'.template.htm'];
	
	if(!$tpl){
		$tpl.='<br>no TPL-file defined!';
	} else if(! file_exists($tplAddr)){
		$tpl.='<br>TPL-file not found!'.__LINE__;
	} else if(!$tpl= @file($tplAddr)){
		$tpl.='<br>error in opening TPL-file, its empty, '.__LINE__;
	} else if(!$tpl= @implode('',$tpl)){
		$tpl.='<br>error in opening TPL-file, cant implode, '.__LINE__;
	}
	
	if($vars){
		foreach($vars as $k=>$r){
			$tpl=str_replace('{'.$k.'}',$r,$tpl);
		}
	}
	
	$tpl = preg_replace_callback(
			"|{([\.a-zA-Z0-9_\-\(\)\']+)}|",
			create_function(
			'$matches',
			'	$var=substr($matches[0],1,-1);
#				$var_fn = (strstr($var,"(")?substr($var, 0, strpos($var, "(") ) : $var);
				if(function_exists($var)){
					return $var();
				} elseif(defined($var)){
					return constant($var);
				} else if($_REQUEST["$var"]) {
					return $_REQUEST["$var"];
				} else if($GLOBALS["include_all_image"]["$var"]) {
					return $GLOBALS["include_all_image"]["$var"];
				} else if($tab__temp = tab__temp("$var")) {
					return $tab__temp;
				} else {
					;//return $var;
				}
			'),
			$tpl);
	
	$tpl = str_replace('﻿','',$tpl);
	return $tpl;
}



