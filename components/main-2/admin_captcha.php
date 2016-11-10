<?
$GLOBALS['do_action'][] = 'admin_captcha';

function admin_captcha(){
	$rand=rand(1000,9999);
	$_SESSION['security_number'] = $rand;
	// tab__temp('security_number', true, $rand);
	$im = imagecreatefrompng( imgp('SECPHOTOBG'.rand(1,4).'.png') );
	$color_R = rand(120,200);
	$color_G = rand(120,200);
	$color_B = 255 + 240 - $color_R - $color_G;
	$cl = imagecolorallocate( $im , $color_R , $color_G , $color_B );
	imagestring($im,24,8,2,$rand,$cl);
	header('Content-type:image/png');
	header('Content-Disposition: Attachment;filename=captcha.png');
	echo imagepng($im);
	imagedestroy($im);
	die();
}



