<?

$GLOBALS['seo_sitemap'][] = array( 

	"query" => " SELECT 
		*, UNIX_TIMESTAMP() as `date`
		FROM `irtoya_staff` WHERE 1 ORDER BY `id` ASC ",
	
	"link" => 'is_linkk( $rw )'
	
);

