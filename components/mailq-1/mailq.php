<?

# its on top of xmail, just working with xmail
# its storing mail in queue, and sends it via cron

function mailq( $to , $subject , $text , $from , $html=true ){
	if($html){
		$html = 1;
	} else {
		$html = 0;
	}
	$text = mysql_real_escape_string($text);
	if(!dbq(" INSERT INTO `mailq` (`to`,`subject`,`text`,`mail_from`,`html`) VALUES ('$to','$subject','$text','$from','$html') ")){
		e("error on mailq - ".__LINE__);
		e(dbe());
		return false;
	} else {
		return true;
	}
}

