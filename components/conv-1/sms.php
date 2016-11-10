<?

# jalal7h@gmail.com
# 2015/10/18
# Version 1.1.0

/*
sms( "user" , "users_register_do_sms" , array(
	"username"=>$username,
	"password"=>$password,
) );
*/

# who : admin / user / or a mobile number
# template_name : a template name / or a text message
# vars : something that we need to put it into the template_name content

function sms( $who , $template_name , $vars ){

	#
	# who
	switch ($who) {

		case 'admin':
			#
			# admin username 
			$rand=$_SESSION['hcfalf'];
			$su='ssus'.$rand;
			$username = $_SESSION['admin'.$su];
			#
			# admin cell
			$to = table("users", $username, "cell", "username");
			break;

		case 'user':
			if(!$uid = $_SESSION['uid']){
				return false;
			} else if(!$to = table("users", $uid, "cell")){
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
	# get the text
	if(!$text = texty( $template_name )){
		$text = $template_name;
	}
	foreach ($vars as $k => $v) {
		$text = str_replace('{'.$k.'}', $v, $text);
	}

	#
	# send the text
	sms_send( $to , $text );
}



