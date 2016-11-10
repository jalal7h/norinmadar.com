<?

function cm_list( $table , $id=null ){
	if(!$id){
		if(!$id = $_REQUEST['id']){
			echo "err - ".__LINE__;
			die();
		}
	}
	$c.= "<div class='cm_list'>";
	if(!$rs = dbq(" SELECT * FROM `comments` WHERE `table`='$table' AND `table_id`='$id' ORDER BY `date` ASC ")){
		echo "err - ".__LINE__;
	} else while($rw = dbf($rs)){
		$c.= cm_list_this($rw);
	}
	$c.= "</div>";

	return $c;
}

function cm_list_this($rw){
	$c.= '<div class="r" >
		<a class="name" '.($rw['user_email']!=''? 'href="mailto:'.$rw['user_email'].'"' : '') .' >'.($rw['user_name']?$rw['user_name']:"*** ****").'</a> : 
		<div class="date">'.substr((U2vaght($rw['date'])), 0, 16).'</div>
		<div class="text">'.nl2br(trim(strip_tags($rw['text']))).'</div>
		
	</div>';

	return $c;
}

