<?
$GLOBALS['do_action'][] = "seo_rss";

# jalal7h@gmail.com
# 2015/09/21
# Version 1.0

function seo_rss(){

	if(!$main_title = tab__temp('main_title')){
		$main_title = "";
	}
	if(!$main_description=tab__temp('websitedescription')){
		$main_description="";
	}
	
	$query = $GLOBALS['seo_rss'][$_REQUEST['feed']]['query'];
	$link0 = $GLOBALS['seo_rss'][$_REQUEST['feed']]['link'];

	@header('Content-Type: text/xml, charset=utf-8');
	echo '<?xml version="1.0" encoding="utf-8"?><rss version="2">'."\n".'<channel><title>'.seo_rss_clean($main_title).'</title><link>'._URL.'</link><description>'.seo_rss_clean($main_description).'</description><language>en</language><webMaster>'.tab__temp('email_address_webadmin').'</webMaster><pubDate>'.date('D, d M Y H:i:s').' -0500</pubDate>';
	
	if(!$query){
		echo "no query defined in seo_rss_config";
	} else if(!$rs = dbq($query)){
		// echo("error in seo_rss - ".__LINE__);
		echo "::".dbe()."::";
		echo $query;
	} else if(!dbn($rs)){
		echo("error in seo_rss - ".__LINE__);
	} else for($i=0; $i<dbn($rs); $i++){
		#
		# get the main variables
		if(!$rw = dbf($rs)){
			echo "Err - ".__LINE__;
		}
		$id = $rw['id'];
		$name = $rw['name'];
		$text = $rw['text'];
		$date = $rw['date'];
		eval("\$link = $link0;");
		#
		# clean variables
		$name = seo_rss_clean( $name );
		$name = clear_title( $name );
		$text = seo_rss_clean( $text );
		$text = clear_text( $text );
		#
		# echo row
		echo '<item>'."\n"
		.'<title>'.$name.'</title>'."\n"
		.'<link>'.$link.'</link>'."\n"
		.'<description>'.$text.'</description>'."\n"
		.'</item>'."\n";
	}
	echo '</channel></rss>'."\n";
}


function seo_rss_clean( $t ){
	$t = strip_tags($t);
	//$t = htmlspecialchars($t);
	$t = str_ireplace('ÙŒ' ,'Û', $t);
	$t = str_ireplace('Ù ' ,'Û', $t);
	$t = str_ireplace('ï¿œ', 'Û', $t);
	$t = str_ireplace('&#1740;', 'Û', $t);
	$t = str_replace('&', '', $t);
	$t = str_replace('>', '&gt;', $t);
	$t = str_replace('<', '&lt;', $t);

	return $t;
}



