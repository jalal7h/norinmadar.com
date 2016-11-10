<?

$GLOBALS['seo_sitemap'][] = array( 
	
	"query" => " SELECT 
		*, `date` 
		FROM `news` WHERE 1 ORDER BY `id` DESC LIMIT 100 ",
	
	"link" => 'news_link( $rw )'
	
);
	
