
INSERT INTO `_pages` (`_page`, `_title`) VALUES (51, 'اخبار سایت');
INSERT INTO `_page_layers` (`_id`, `_page`, `_priority`, `_func`, `_type`, `_title`, `_data`, `_framed`, `_status`) VALUES (51, 51, 1, 'news_list', '', 'اخبار سایت', '', 1, 1);

INSERT INTO `_pages` (`_page`, `_title`, `meta_title`, `meta_kw`, `meta_desc`) VALUES 
(52, 'نمایش خبر', '<?\r\necho news_meta( "title" );\r\n?>', '<?\r\necho news_meta( "kw" );\r\n?>', '<?\r\necho news_meta( "desc" );\r\n?>');
INSERT INTO `_page_layers` (`_id`, `_page`, `_priority`, `_func`, `_type`, `_title`, `_data`, `_framed`, `_status`) VALUES (52, 52, 1, 'news_display', '', 'نمایش خبر', '', 1, 1);

--spi--
