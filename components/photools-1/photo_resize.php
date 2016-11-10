<?


	function createNewImg(&$img, $file, $qualityLevel='')
	{
		switch ($GLOBALS['imgType']) {
			case 'gif':
				if($file)imagegif($img, $file);
				else imagegif($img);
				break;
				
			case 'jpg':
				if ($qualityLevel>0) imagejpeg($img, $file, $qualityLevel);
				elseif($file) imagejpeg($img, $file);
				else imagejpeg($img);
				break;
	
			case 'png':
				if($file) imagepng($img, $file);
				else imagepng($img);
				break;
		}	
		imagedestroy($img);
	}




	function &getImg($sourceFileName)
	{
		$arr = getimagesize($sourceFileName);
		if (is_array($arr)) {
			switch ($arr[2]) {
				case 1:
					$img = imagecreatefromgif($sourceFileName);
					$GLOBALS['imgType'] = 'gif';
					return $img;
					break;
				case 2:
					$img = imagecreatefromjpeg($sourceFileName);
					$GLOBALS['imgType'] = 'jpg';
					return $img;
					break;
				case 3:
					$img = imagecreatefrompng($sourceFileName);
					imagealphablending($img, true); // setting alpha blending on
					imagesavealpha($img, true);
					$GLOBALS['imgType'] = 'png';
					return $img;
					break;
			}
		}
	}


	



	function checkGdFileType($filename)
	{
		$GLOBALS['gdNoSupport'] = '';
		$arr = @ getimagesize($filename);
		$res = false;
		if (is_array($arr)) {
			switch ($arr[2]) {
				case 1:
					$GLOBALS['gdNoSupport'] = 'GIF';
					if (function_exists('imagecreatefromgif') && function_exists('imagegif')) {
						$res = true;
					}
					break;
				case 2:
					$GLOBALS['gdNoSupport'] = 'JPG';
					if (function_exists('imagecreatefromjpeg') && function_exists('imagejpeg')) {
						$res = true;
					}
					break;
				case 3:
					$GLOBALS['gdNoSupport'] = 'PNG';
					if (function_exists('imagecreatefrompng') && function_exists('imagepng')) {
						$res = true;
					}
					break;
			}
		}
		return $res;
	}
	





	function &getImageCreate($destWidth, $destHeight)
	{
		if (function_exists('imagecreatetruecolor') && $GLOBALS['gdInfo']>=2) {
			$image = @ imagecreatetruecolor($destWidth, $destHeight); 
		} else {
			$image = @ imagecreate($destWidth, $destHeight); 
		}
		return $image; 
	}




	function getImageCopyResampled(&$destImage, &$img, $x1, $y1, $x2, $y2, $destWidth, $destHeight, $srcWidth, $srcHeight)
	{
		if (function_exists('imagecopyresampled') && $GLOBALS['gdInfo']>=2) {
			@ imagecopyresampled($destImage, $img, $x1, $y1, $x2, $y2, $destWidth, $destHeight, $srcWidth, $srcHeight);
		} else {
			@ imagecopyresized($destImage, $img, $x1, $y1, $x2, $y2, $destWidth, $destHeight, $srcWidth, $srcHeight);
		}	
	}


//////////////////////////////////////////////////////////////////////////////////




	function resize_gd($sourceFileName, $folder, $destinationFileName, $newWidth, $newHeight, $keepProportion)
	{
		$phpinfo = getVersionGd();
		$newWidth = (int)$newWidth;
		$newHeight = (int)$newHeight;
		if (!$GLOBALS['gdInfo'] >= 1 || ! checkGdFileType($sourceFileName)) {
			return false;
		}
		$img = &getImg($sourceFileName);
		$srcWidth = imagesx($img);
		$srcHeight = imagesy($img);

		if ( $keepProportion && ($newWidth != 0 && $srcWidth<$newWidth) && ($newHeight!=0 && $srcHeight<$newHeight) ) {
			if ($sourceFileName != $folder . $destinationFileName) {
				@ copy($sourceFileName, $folder . $destinationFileName);
			}
			return true;
		}
		
		if ($keepProportion == true) {
			if ($newWidth != 0 && $newHeight != 0) {
				$ratioWidth = $srcWidth/$newWidth; 
				$ratioHeight = $srcHeight/$newHeight; 
				if( $ratioWidth < $ratioHeight ){ 
					$destWidth = $srcWidth/$ratioHeight;
					$destHeight = $newHeight; 
				} else { 
					$destWidth = $newWidth; 
					$destHeight = $srcHeight/$ratioWidth; 
				}
			} else {
				if ($newWidth != 0) {
					$ratioWidth = $srcWidth/$newWidth; 
					$destWidth = $newWidth; 
					$destHeight = $srcHeight/$ratioWidth; 
				} else if ($newHeight != 0) {
					$ratioHeight = $srcHeight/$newHeight; 
					$destHeight = $newHeight; 
					$destWidth = $srcWidth/$ratioHeight; 
				} else {
					$destWidht = $srcWidth;
					$destHeight = $srcHeight;
				}
			}
		} else {
			$destWidth = $newWidth; 
			$destHeight = $newHeight; 
		}
		$destWidth = round($destWidth);
		$destHeight = round($destHeight);
		
		$destImage = &getImageCreate($destWidth, $destHeight); 
		
		getImageCopyResampled($destImage, $img, 0, 0, 0, 0, $destWidth, $destHeight, $srcWidth, $srcHeight);
		imagedestroy($img);
		$img = &$destImage;
		createNewImg($img, $folder . $destinationFileName, 80);
		return true;
	}






?>
