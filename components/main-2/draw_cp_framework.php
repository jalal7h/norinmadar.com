<?

function draw_cp_framework(){
	?>
	<div class="draw_cp_framework">
	<?
	$i = 0;
	$r = 6;
	foreach($GLOBALS['cmp'] as $func => $title){
		if($title==""){
			continue;
		}
		draw_cp_framework_this( $func , $title );
	}
	?>
	</div>
	<?
}

function draw_cp_framework_this( $func , $title ){
	echo '<a href="./?page=admin&cp='.$func.'">
	<div class="title">'.$title.'</div>
	</a>';
}





