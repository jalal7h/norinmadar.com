<?

$GLOBALS['block_layers']['news_list_air'] = 'لیست تصویری خبر ها';

function news_list_air(){
	echo "<div class='news_list_air'>";
	$query = " SELECT * FROM `news` WHERE 1 $q_query ORDER BY `date` DESC LIMIT 12 ";
	if(!$rs = dbq($query)){
		echo dbe();
	} else if(!dbn($rs)){
		echo "</div>";
		return false;
	} else while($rw = dbf($rs)){
		$div_arr[($i++%3)].= news_list_air_this($rw);
	}
	foreach($div_arr as $i => $div_this){
		echo "<div class='div_r'>".$div_this."</div>";
	}
	echo "</div>";

	return true;
}

function news_list_air_this( $rw ){
	$link = news_link( $rw );
	$date = vaght_2_taghvim( U2Vaght($rw['date']) );
	$text = sub_string(trim(strip_tags($rw['text'])),0,500);
	
	$c.= '<a href="'.$link.'" >
		<img src="'.$rw['pic'].'" />
		<div class="name">'.$rw['name'].'</div>
		<div class="text">'.$text.' ..</div>
	</a>';

	return $c;
}

