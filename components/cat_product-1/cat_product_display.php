<?

$GLOBALS['block_layers']['cat_product_display']="گروه محصولات";	

function cat_product_display($table_name=null , $page_id=null){

	echo "<div class='catP'>";
	
	$query = " SELECT * FROM `cat` WHERE `cat`='main' ORDER BY `id` DESC ";
	
	if(!$rs = dbq($query)){
		
		$content.= dbe();
		
	} else if(!dbn($rs)){
			
		$content.= "</div>";
		return false;

	} else while($rw = dbf($rs)){
	
		$content=cat_product_display_this($rw);
		
	}
	echo '</div>';
}

function cat_product_display_this($rw){

	$link="./?page=home"."&id=".$rw['id'];
	$name =$rw['name'];
	$path = $rw['logo'];
	$c = '
		<a href="'.$link.'" class="catP1" >	
		
			<img src="'.$path.'" />
			<div class="name">'.$name.'</div>
		
		</a>
	';
	echo $c;

	
}
