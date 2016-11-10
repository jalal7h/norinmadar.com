<?
$GLOBALS['do_action'][] = 'imgp_echo';

function imgp( $name ){
	return $GLOBALS['include_all_image'][$name];
}

function imgp_echo(){
	if(!$filename = $_REQUEST['filename']){
		echo "no file name";
	} else if(!$imgp = imgp($_REQUEST['filename'])){
		echo "no image with name of $filename ";
	} else {
		echofile( $imgp );
	}
}

