<?

# $dir : directory of destination, placed on `data` directory.
# $id : name of the subdirectory.
# $numb : number of the input[] to be saved. (empty == save all).
#
# fileupload_remove("slideshow", "11", "1");

function fileupload_remove($dir,$id,$numb=null){
	$dir = "data/$dir/$id";
	if(!file_exists($dir)){
		return true;
	} else if(!$dp = opendir($dir)){
		echo "err - ".__LINE__;
	} else while($d = readdir($dp)){
		$file_addr = $dir."/".$d;
		if(substr($d,0,1)=="."){
			continue;
		} else if(!$numb){
			// remove all
			@unlink($file_addr);
		} else {
			if(substr($d,0,strlen($numb)+1)==$numb."-"){
				@unlink($file_addr);
				break;
			}
		}
	}
	return true;
}
