<?
$GLOBALS['do_action'][] = "seo_sitemap";

function seo_sitemap(){
	
	$date = date("Y-m-d\TH:i:s\+00:00", U());
	
	@header('Content-Type: text/xml, charset=utf-8');
	echo '<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.google.com/schemas/sitemap/0.84"><url><loc>'._URL.'/</loc><lastmod>'.$date.'</lastmod><changefreq>always</changefreq><priority>1</priority></url>';

	if(!sizeof($GLOBALS['seo_sitemap'])){
		//
	} else foreach ($GLOBALS['seo_sitemap'] as $k => $r) {
		
		$query = $r['query'];
		$link0 = $r['link'];

		if(!$query){
			echo "no query defined in seo_sitemap";
		} else if(!$rs = dbq($query)){
			// echo("error in seo_rss - ".__LINE__);
			echo "::".dbe()."::";
			echo $query;
		} else if(!dbn($rs)){
			// echo("error in seo_rss - ".__LINE__);
		} else for($i=0; $i<dbn($rs); $i++){
			#
			# get the main variables
			if(!$rw = dbf($rs)){
				echo "Err - ".__LINE__;
			}
			eval("\$link = $link0;");
			if(intval($rw['date'])=='0'){
				$rw['date'] = $date;
			}
			#
			# echo row
			echo "\n<url>\n"
			."<loc>".$link."</loc>\n"
			."<lastmod>".date("Y-m-d\TH:i:s\+00:00", $rw['date'])."</lastmod>\n"
			."<priority>0.5</priority>\n"
			."<changefreq>daily</changefreq>\n"
			."</url>\n";
		}
	}

	echo "</urlset>";
}



