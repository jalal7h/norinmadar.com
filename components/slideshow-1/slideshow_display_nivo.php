<?

# jalal7h@gmail.com
# 2015/12/25
# Version 1.0.1

function slideshow_display_nivo(){
	
	?>
	<!--- slide show start -->
	<link rel="stylesheet" href="http://parsunix.com/cdn/js/nivo-slider/themes/default/default.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="http://parsunix.com/cdn/js/nivo-slider/nivo-slider.css" type="text/css" media="screen" />

	<div id="wrapper">
	<div class="slider-wrapper theme-default">
	<div class="ribbon"></div>
	<div id="slider" class="nivoSlider">

	<?
	
	if(!$rs = dbq(" SELECT * FROM `slideshow` ORDER BY `id` DESC ")){
		echo "err - ".__LINE__;
	
	} else if(!dbn($rs)){
		echo "err - ".__LINE__;
	
	} else while($rw = dbf($rs)){
		if($rw['link']!=''){
			echo "<a href='".$rw['link']."' >";
		}

		if( $rw['name'] ) {
			$title_of_img_tag = '<div class=slideshow_detail ><div class=name >'.$rw['name'].'</div><div class=description >'.$rw['description'].'</div></div>';

		} else {
			$title_of_img_tag = "";
		}
		echo '<img  title="'.$title_of_img_tag.'" src="'.$rw['pic'].'" />'."\n";

		if($rw['link']!=''){
			echo "</a>";
		}
		
	}

	?>
	</div>
	</div>
	</div>
	
	<script type="text/javascript" src="http://parsunix.com/cdn/js/nivo-slider/jquery.nivo.slider.pack.js"></script>
	<script type="text/javascript">
	$(window).load(function() {
		$('#slider').nivoSlider({
			pauseTime:5000
		});
	});
	</script>
	
	<?
}










