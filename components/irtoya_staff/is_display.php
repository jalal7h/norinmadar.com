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
		$title = $rw['name']." ( ".$rw['brand_fa']." - ".$rw['model_fa']." )";
		
		$path = "data/autoparts/".$rw['id'];
		if(!$list = fileupload_filelist($path)){
			$list[0] = 'image.list/is-no-pic.jpg';
		}
		for($i=1; $i<sizeof($list) and $i<5; $i++){
			$tinypics.= "<a href='".$list[$i]."' class='slideshow'><img src='resize/100x100/".$list[$i]."' /></a>\n";
		}
		for(    ; $i<5; $i++){
			$tinypics.= "<img src='image.list/is-no-pic.jpg' />\n";
		}

		$c.= "
		<div class='is_display'>
			<div class='pics'>
				<a class='slideshow' href='".$list[0]."'><img class='main' src='".$list[0]."' /></a>
				<div class='tiny' >
					".$tinypics."
				</div>
			</div>
			<div class='text'>
				<div class='name'><span>".lmtc("irtoya_staff:code")." : </span>".$rw['code']."</div>
				<div class='brand' ><span>نوع خودرو : </span>".$rw['brand_fa']." , ".$rw['brand_en']."</div>
				<div class='model' ><span>مدل خودرو : </span>".$rw['model_fa']." , ".$rw['model_en']."</div>
				".($rw['year'] ?"<div class='year'><span>".lmtc("irtoya_staff:year")." : </span>".$rw['year']."</div>" :"")."
				".($rw['quality'] ?"<div class='quality'><span>".lmtc("irtoya_staff:quality")." : </span>".$rw['quality']."</div>" :"")."
				".($rw['price'] ?"<div class='price'><span>".lmtc("irtoya_staff:price")." : </span>".$rw['price']."</div>" :"")."
				<br>
				".is_display_form( $rw )."
			</div>
			
			".($rw['desc'] ?"
			<div class='desc'>
				<div>".lmtc("irtoya_staff:desc")." : </div>
				".$rw['desc']."
			</div>
			" :"")."

		</div>
		<div class='is_list_same'>
			".is_list_same()."
		</div>
		<div class='is_list_same2'>
			".is_list_same2()."
		</div>
		";

		create_box($title, $c, $allow_eval=false, $framed=true, $position="center");
	}

	return false;
}


