<?

function billing_management_users_activity( $uid ){
	$rw = table("users", $uid);
	echo "
	<div class='billing_management_users_activity' >
		<div class='name' >
			<span>نام : </span>
			<span>".$rw['name']." &lt;".$rw['username']."&gt;</span>
		</div>
		<div class='credit' >
			<span>اعتبار : </span>
			<span>".number_format(billing_userCredit($uid))." تومان</span>
		</div>
	</div>";
}

