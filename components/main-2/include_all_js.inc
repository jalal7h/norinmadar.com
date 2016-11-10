<?
$GLOBALS['do_action'][] = "include_all_js";

function include_all_js(){
	@header("Content-disposition: filename=scripts.js");
	@header("Content-type: application/x-javascript");
	if(!$GLOBALS['include_all_js']){
		echo "/*** no other js found ***/";
		return true;
	} else foreach($GLOBALS['include_all_js'] as $k => $file){
		$this_file = implode("",file($file));
		
		if(strstr($this_file,"/*admin*/") and ($_REQUEST['page']!='admin')){
			continue;
		} else if(strstr($this_file,"/*index*/") and ($_REQUEST['page']=='admin')){
			continue;
		} else if(strstr($this_file,"/*footer*/")){
			continue;
		} else {
			echo "\n/* * * * * * * * * * * * * * * * * * * * * * * js-footer : ".$file."  * * * * * * * */\n";
			echo $this_file;
			echo "\n/* * * * * * * */\n\n";
		}
	}
}



