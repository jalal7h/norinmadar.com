<?

function send_mail( $send_dest, $send_subj, $send_cont, $send_from){
	return @ mail($send_dest,$send_subj,$send_cont,"From: ".$send_from."\r\n");
}

function send__send2sell($factorId=0){

	$send_dest=tab__temp('email_address_sell');
	$send_subj="NuN";
	$send_cont="NuN";
	$send_from=tab__temp('email_address_webadmin');

	return send_mail( $send_dest, $send_subj, $send_cont, $send_from);
}

function send_activatin_for_newpassword($username){
	$send_from=tab__temp('email_address_webadmin');
	$send_cont="please open the following link : "._URL."/?do=userForgotPasswordB&link=".
		cpt($_SERVER['REMOTE_ADDR'].date("H").$username)."&b64user=".urlencode(base64_encode($username));
	return send_mail( $username, "activation link for new password", $send_cont, $send_from);
}

function send_newPassword($username,$newPassword){
	$send_from=tab__temp('email_address_webadmin');
	$send_cont="your new password is : ".$newPassword;
	return send_mail( $username, "new password for you", $send_cont, $send_from);
}











