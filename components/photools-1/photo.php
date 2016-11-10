<?

function IMGSIZE($SRC,$wh){
	if(stristr($SRC,_URL)){
		$SRC=substr($SRC,strlen(_URL)+1,strlen($SRC));
	}
	if(!$SZ = @ getimagesize($SRC))return '';
	
	switch($wh){
		case 'w' :
		case 'W' :
			return $SZ[0];
			break;
		case 'h' :
		case 'H' :
			return $SZ[1];
			break;
	}
	return '';
}

function RESIZE_IMG($SRC,$nWD=0, $nHT=0){
	$SZ = getimagesize($SRC);
	$SW = $SZ[0];
	$SH= $SZ[1];
	if($nWD==0)$nWD=600;
	if($nHT==0)$nHT=450;
	if( $SW <=$nWD && $SH<=$nHT )return $SRC;
	if($SW > $SH){ $CW=$nWD; $CH= intval($CW * ($SH / $SW)) ;}
	if($SW <=$SH){ $CH=$nHT; $CW= intval($CH * ($SW / $SH)) ;}
	if(! resize_gd($SRC, '', $SRC, $CW, $CH, false))return false;
	return $SRC;
}

function FIND_MY_PLANS_PHOTO($id){
	$dir = @ opendir('face_img/plans_img/');
	while($DIR = @ readdir($dir))
		if(substr($DIR, 0, 8)=='V_PUB'.$id){@ closedir($dir);return "face_img/plans_img/$DIR";break;}
	@ closedir($dir);
	return "face_img/plans_img/nopic2show.jpg";
}

function DEL_MY_PLANS_PHOTO($id){
	$dir = @ opendir('face_img/plans_img/');
	while($DIR = @ readdir($dir))
		if(substr($DIR, 0, 8)=='V_PUB'.$id){@ closedir($dir);unlink("face_img/plans_img/$DIR");break;}
	@ closedir($dir);
	
	return false;
}

function DRAW_MY_EMAIL_ADDRESS_ON_GIF($email){
	$CW=strlen($email)*9;
	$CH=18;
	$IM = imagecreate( $CW, $CH );
	$WHITE = imagecolorallocate($IM, 255, 255, 255);
	$BLACK = imagecolorallocate($IM, 0, 0, 0);
	imagefill($IM, 0, 0, $WHITE);
	imagestring($IM,12,0,0,$email,$BLACK);
	imagegif($IM);
	imagedestroy($IM);
	return true;
}












