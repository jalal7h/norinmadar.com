<?
$GLOBALS['do_action'][] = "quick_resize";


function multi_size_pic($file_name, $nWD, $nHT){
	if($nWD==0 or $nHT==0){
		return false;
	}
	$PIC = $file_name;
	$PIC_tmp = "/tmp/tmp".rand(10000,99999).strrchr($PIC, ".");
	$PIC = _URL."/".$PIC;
	$SZ = getimagesize($PIC);
	$SW = $SZ[0];
	$SH = $SZ[1];
	
	if($SW-$nWD < $SH-$nHT){
		$CW=$nWD;
		$CH= round($CW * ($SH / $SW));
	} else {
		$CH=$nHT;
		$CW= round($CH * ($SW / $SH));
	}
	if($CH > $nHT){
		$CH = $nHT;
		$CW = round($CH * ($SW / $SH));
	}
	if($CW > $nWD){
		$CW=$nWD;
		$CH= round($CW * ($SH / $SW));
	}
	
	if(!resize_gd($PIC, '', $PIC_tmp, $CW, $CH, false)){
		echo "error - f_photo - ".__LINE__;
		return false;
	} else {
		$ext = strtolower(strrchr($file_name, '.'));
		switch($ext){
		
			case '.jpg' : 
			case '.jpeg' :
				$func_open = "imagecreatefromjpeg";
				$func_show = "imagejpeg";
				break;
			
			case '.bmp' : 
				$func_open = "imagecreatefromwbmp";
				$func_show = "imagewbmp";
				break;
			
			case '.gif' : 
				$func_open = "imagecreatefromgif";
				$func_show = "imagegif";
				break;
			
			case '.png' : 
			DEFAULT : 
				$func_open = "imagecreatefrompng";
				$func_show = "imagepng";
				break;
		}
		$IM = $func_open($PIC_tmp);
		imagealphablending($IM, true); // setting alpha blending on
		imagesavealpha($IM, true);
		header("Content-disposition: inline; filename=$file_name");
		header('Content-Type: image/'.substr($ext, 1));
		$expires = 60 * 60 * 24 * 30;
		$exp_gmt = gmdate("D, d M Y H:i:s", time() + $expires )." GMT";
		$mod_gmt = gmdate("D, d M Y H:i:s", time() + (3600 * -5 * 24 * 365) )." GMT";
		@header("Expires: {$exp_gmt}");
		@header("Last-Modified: {$mod_gmt}");
		@header("Cache-Control: public, max-age={$expires}");
		@header("Pragma: !invalid");
		echo $func_show($IM);
		imagedestroy($IM);
		unlink($PIC_tmp);
		die();
	}
}

function quick_resize(){
	multi_size_pic($_REQUEST['address'], $_REQUEST['width'], $_REQUEST['height']);
	die();
}



