<?

function mail_phpmailer( $to , $subject , $content , $from="" ){
	
	#
	# define
	require("modules/phpmailer/class.phpmailer.php");
	$mail = new PHPMailer();
	$mail->IsSMTP();                                   // send via SMTP
	$mail->CharSet = 'UTF-8';
	$mail->Host     = "localhost"; // SMTP servers
	// $mail->SMTPAuth = true;     // turn on SMTP authentication
	// $mail->Username = "info@cocoro.ir";  // SMTP username
	// $mail->Password = '12w!@W!@W'; // SMTP password
	if($from==""){
		$mail->From     = "noreply@".str_replace("www.", "", $_SERVER['SERVER_NAME']);
		$mail->FromName = "no-reply";
	} else {
		$mail->From     = $from;
		$mail->FromName = "";
	}
	$mail->AddAddress( $to , "" ); 
	// $mail->AddReplyTo("someone@somewhere.com","some name");
	$mail->WordWrap = 50;                              // set word wrap
	// $mail->AddAttachment("/var/tmp/file.tar.gz");      // attachment
	// $mail->AddAttachment("/tmp/image.jpg", "new.jpg");
	// $mail->AddAttachment('data/netbarg/11/2-0aeed5d23e6f0ba46cbfe099d5cb8609.jpg'); 
	$mail->IsHTML(true);                               // send as HTML

	#
	# content
	$mail->Subject  =  $subject;
	$mail->Body     =  $content;
	// $mail->AltBody  =  "This is the text-only body";

	#
	# send
	if(!$mail->Send()){
		echo "Message was not sent - $date<p>";
		echo "Mailer Error: " . $mail->ErrorInfo;
	} else {
		return true;
	}
}





