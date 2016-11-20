<?

$GLOBALS['seo_rss']['product'] = array( 
	"query" => " SELECT 
		*,
		`id`, 
		`name`, 
		`desc` as `text`, UNIX_TIMESTAMP() as `date` 
		FROM `irtoya_staff` 
	WHERE 1 
	ORDER BY `id` DESC LIMIT 100 ",
	"link" => 'is_linkk($rw)'
);

