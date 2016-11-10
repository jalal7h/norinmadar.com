<?

$GLOBALS['seo_rss']['autoparts'] = array( 
	"query" => " SELECT 
		*,
		`id`, 
		`name`, 
		CONCAT(`model_fa`,' ',`brand_fa`) as `text`, UNIX_TIMESTAMP() as `date` 
		FROM `irtoya_staff` 
	WHERE 1 
	ORDER BY `id` DESC LIMIT 100 ",
	"link" => 'is_linkk($rw)'
);

