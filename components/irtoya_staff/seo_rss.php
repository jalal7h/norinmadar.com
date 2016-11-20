<?

$GLOBALS['seo_rss']['produc'] = array( 
	"query" => " SELECT 
		*,
		`id`, 
		`name`, 
		CONCAT(`name`,' ',`cat`) as `text`, UNIX_TIMESTAMP() as `date` 
		FROM `irtoya_staff` 
	WHERE 1 
	ORDER BY `id` DESC LIMIT 100 ",
	"link" => 'is_linkk($rw)'
);

