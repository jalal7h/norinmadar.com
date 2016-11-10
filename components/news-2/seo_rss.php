<?

$GLOBALS['seo_rss']['news'] = array( 
	
	"query" => " SELECT 
		`id`,
		`name`,
		`text`,
		`date` 
		FROM `news` WHERE 1 ORDER BY `id` DESC LIMIT 100 ",
	
	"link" => 'news_link( $rw )'
	
);
	

