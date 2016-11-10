<?

# it checks if its html sends it as html, and if not sends with simple mail function

function xmail( $mail_to , $mail_subject , $mail_text , $mail_from , $html=false ){
	$mail_headers = "From: ".$mail_from."\r\n";
	if($html){
		return mail_phpmailer( $mail_to , $mail_subject , $mail_text , $mail_from );
		// return mail_utf8( $mail_to , $mail_subject , $mail_text , $mail_headers );
	} else {
		return mail( $mail_to , $mail_subject , $mail_text , $mail_headers );
	}
}


