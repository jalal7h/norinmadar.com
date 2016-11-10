<?

function users_forgot_new(){
	$email = $_REQUEST['email'];
	$h = sha1($email."01q!");
	if($_REQUEST['h']!=$h){
		echo "<div style='width: 70%; margin: 120px auto 120px auto;' class='convbox'>خطایی رخ داده است!</div>";
	} else {
		echo "<form id=users_forgot_form method=post action='./?page=".$_REQUEST['page']."&do=save' onsubmit='return checkform_ufnew();' name=ufnew >
		<input type='hidden' name='email' value='$email'>
		<input type='hidden' name='h' value='".$_REQUEST['h']."'>
			<div class=container >
				<div class=d01>لطفا کلمه عبور جدید را وارد کنید!</div>
				<input placeholder='New password' type='password' id='password1' /><br>
				<input placeholder='Repeat password' type='password' id='password2' name='password' /><br>
				<input type='submit' value='ثبت کلمه عبور جدید' />
			</div>
		</form>";
		?>
		<script>
		function checkform_ufnew(){
			if(document.getElementById("password1").value==''){
				alert("لطفا کلمه عبور مناسب وارد کنید.");
			} else if(document.getElementById("password1").value!=document.getElementById("password2").value){
				alert("کلمه عبور مطابقت ندارد!");
			} else {
				return true;
			}
			return false;
		}
		</script>
		<?
	}
}

