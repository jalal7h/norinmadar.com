<?
$GLOBALS['do_action'][] = 'cm_save';

function cm_save(){
	if(!$table = trim(strip_tags($_REQUEST['table']))){
		echo "err - ".__LINE__;
	} else if(!$id = (int)$_REQUEST['id']){
		echo "err - ".__LINE__;
	} else if(!$text = trim(strip_tags($_REQUEST['text']))){
		echo "err - ".__LINE__;
	} else {
		$name = trim(strip_tags($_REQUEST['name']));
		$email = trim(strip_tags($_REQUEST['email']));
		$date = U();
		$ip = $_SERVER['REMOTE_ADDR'];
		if(!dbq(" INSERT INTO `comments` (`table`,`table_id`,`user_name`,`user_email`,`text`,`date`,`ip`) VALUES ('$table', '$id', '$name', '$email', '$text', '$date','$ip') ")){
			echo dbe();
		}
		echo "
		<script>
		top.$(document).ready(function(){
			top.$('#cm_form').hide('slow');
			top.$('#aftersendmsg').show('slow');
		})
		</script>";
	}
}


