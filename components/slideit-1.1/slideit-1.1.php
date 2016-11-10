<?

# jalal7h@gmail.com
# 2015/10/10
# Version 1.1.1

// 	$path = "data/irtoya_slide/".$rw['id'];
// 	slideit( $path );

function slideit( $path , $time=1000 , $class="" ){
	
	$file_list = fileupload_filelist( $path );
	
	if($class){
		$elem_class = $class;
		$elem_class = strrev($elem_class);
		$elem_class = explode(" ", $elem_class);
		$elem_class = $elem_class[0];
		$elem_class = strrev($elem_class);
		$elem_class = str_replace(".", "", $elem_class);
		$elem_class.= " slideit";
	} else {
		$class = ".slideit";
		$elem_class = "slideit";
	}
	
	$fs = getimagesize($file_list[0]);

	$c.= '<div class="'.$elem_class.'">';	
	foreach ($file_list as $k => $file) {
		$c.= "<img src='".$file."' />";
	}
	$c.= '</div>';

	$c.= "
	<script>
		$(document).ready(function(){

			slideit_w = $('.slideit').width();
			slideit_h = slideit_w * ".$fs[1].";
			slideit_h = slideit_h / ".$fs[0].";
			slideit_h = Math.round(slideit_h);

			console.log(slideit_w + 'x' + slideit_h);
			$('.slideit').height( slideit_h );


			size0 = $('".$class." > img').size();
			i0 = 1;
			disable_auto_flag = 0;
			setInterval( function(){
				if(disable_auto_flag==0){
					$('".$class." > img:nth-child('+i0+')').css({'opacity':'0.0'});
					i0 = (i0%size0);
					i0++;
					$('".$class." > img:nth-child('+i0+')').css({'opacity':'1.0'});
				}
			}, ".$time.");
			$('".$class." > img').on('mouseenter', function(){
				console.log('mouse enter');
				disable_auto_flag = 1;
			}).on('mouseleave', function(){
				console.log('mouse leave');
				disable_auto_flag = 0;
			})
		})
	</script>
	";

	return $c;
}




