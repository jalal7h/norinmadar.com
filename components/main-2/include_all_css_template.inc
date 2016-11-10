<?
$GLOBALS['do_action'][] = "include_all_css_template";

function include_all_css_template(){
	$path = "templates/"._THEME."/css/";
	@header("Content-disposition: filename=styles.css");
	@header("Content-type: text/css");
	if(!$dp = opendir($path)){
		echo "err - ".__LINE__;
	} else while($d = readdir($dp)){
		if(substr($d,0,1)=='.'){
			continue;
		} else if(strrchr($d,".")!='.css'){
			continue;
		} else {
			$files[] = $path.$d;
		}
	}
	sort($files);
	foreach($files as $k => $file){
		$css = implode('',file($file));
		$displayFlag = false;
		if(trim(str_replace(array("/*admin*/","/*index*/"), "", $css))==''){
			continue;
		} else if(strstr($css,"/*admin*/")){
			if($_REQUEST['page']=='admin'){
				$displayFlag = true;
			}
		} else if(strstr($css,"/*index*/")){
			if($_REQUEST['page']!='admin'){
				$displayFlag = true;
			}
		} else {
			$displayFlag = true;
		}
		// $css = trim(str_replace(array("/*admin*/","/*index*/"), "", $css));
		if($displayFlag){
			echo "\n/* * * * * * * * * * * * * * * * * * * * * * * css : ".$file."  * * * * * * * */\n";
			echo $css;
			echo "\n/* * * * * * * */\n\n";
		}
	}
}


