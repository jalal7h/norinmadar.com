<?

function billing_userCredit( $uid , $credit=0 ){
	if($credit!=0){ // update the credit
		if($credit > 0){ // add
			if(!dbq(" UPDATE `users` SET `wallet_credit`=`wallet_credit`+'".abs($credit)."' WHERE `id`='$uid' LIMIT 1 ")){
				e(__LINE__." : ".__FILE__);
			}
		} else { // mines
			if(!dbq(" UPDATE `users` SET `wallet_credit`=`wallet_credit`-'".abs($credit)."' WHERE `id`='$uid' LIMIT 1 ")){
				e(__LINE__." : ".__FILE__);
			}
		}
	}

	return table("users", $uid, "wallet_credit");
}


