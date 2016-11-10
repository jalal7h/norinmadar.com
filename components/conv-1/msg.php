<?

# jalal7h@gmail.com
# 2015/10/18
# Version 1.1.0

/*
msg( 
	"admin", "nb_adminCoponCountCheck" , 
	array(
		"netbarg_name"=>table("netbarg",$netbarg_id,"name"), 
		"netbarg_id"=>$netbarg_id,
	)
);
*/

# who : admin / user / or an email address
# template_name : a template name / or a text message
# vars : something that we need to put it into the template_name content

function msg( $who , $template_name , $vars ){
	#
	switch ($who) {

		case 'admin':
			$to = tab__temp('email_address_webadmin');
			break;

		case 'user':
			if(!$uid = $_SESSION['uid']){
				return false;
			} else if(!$to = table("users", $uid, "username")){
				return false;
			} else {
				// its OK
			}
			break;

		default:
			$to = $who;
			break;
	}
	#
	if(!$template = texty( $template_name )){
		$template = $template_name;
	}
	foreach ($vars as $k => $v) {
		$template = str_replace('{'.$k.'}', $v, $template);
	}
	#
	$template = explode("::::", $template);
	$subject = trim($template[0]);
	$text = trim($template[1]);
	#
	$from = "noreply@".str_replace("www.", "", $_SERVER['SERVER_NAME']);
	if( function_exists("mailq") ){
		mailq( $to , $subject , $text , $from, $html=false );
	} else {
		mail( $to , $subject , $text , "From: ".$from."\r\n" );
	}
}



