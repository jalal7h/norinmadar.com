<?

# jalal7h@gmail.com
# 2015/10/20
# Version 1.0.0

function is_display(){
	if(!$id = $_REQUEST['id']){
		e(__FUNCTION__.__LINE__);
	} else if(!$rw = table("irtoya_staff", $id)){
		e(__FUNCTION__.__LINE__);
	} else {
		$title = $rw['name'];
		
		$path = "data/autoparts/".$rw['id'];
		if(!$list = fileupload_filelist($path)){
			$list[0] = 'image.list/is-no-pic.jpg';
		}
		

		$c.= "
		<div class='is_display'>
		
			<div class='pics'>
				<a class='slideshow' href='".$list[0]."'><img class='main' src='".$list[0]."' /></a>
				
			</div>
			<div class='text'>
				<div class='name'><span>".lmtc("irtoya_staff:code")." : </span>".$rw['code']."</div>
				<div class='brand' ><span>نام محصول : </span>".$rw['name']." , ".$rw['brand_en']."</div>
				<div class='model' ><span>قیمت  : </span>".$rw['price']." , ".$rw['model_en']."</div>
				<br>
				".is_display_form( $rw )."
			</div>
			
			".($rw['desc'] ?"
			<div class='desc'>
				<div>".lmtc("irtoya_staff:desc")." : </div>
				<p class='p-dec'>".$rw['desc']."</p>
			
				<div>".lmtc("irtoya_staff:technical_features")." : </div>
				<p class='p-dec'>".$rw['technical_features']."</p>
			</div>
			" :"")."

		</div>
		
		";

		create_box($title, $c, $allow_eval=false, $framed=true, $position="center");
	}

	return false;
}


