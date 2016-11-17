<?

$GLOBALS['block_layers']['slideshow_display'] = 'نمایش اسلاید شو';

function slideshow_display(){
	if(intval($_REQUEST['page'])>1){
		return false;
	}
	slideshow_display_nivo();
}



