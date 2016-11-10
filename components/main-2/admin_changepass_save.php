<?
$GLOBALS['do_action'][] = 'admin_changepass_save';

function admin_changepass_save(){
	f_admin__a_html__header();
	f_admin__a_html__top();
	?>
	<body bgcolor="#f4f3e9">
	<table width="100%" height="100%"><tr><td align="center">
		<?
		$oldP = $_POST['oldP'];
		$newP = $_POST['newP'];
		$newP2 = $_POST['newP2'];
		if(empty($oldP)or empty($newP)or empty($newP2) or ($newP!=$newP2)){
			echo "فرم کامل پر نشده است<br><a href='javascript:history.go(-1)'>بازگشت</a>";
		} else {
			$rand=$_SESSION['hcfalf'];
			$su='ssus'.$rand;
			$sp='sspw'.$rand;
			$username = $_SESSION["admin".$su];
			if(!admin_check($username,cpt($oldP))){
				echo "کلمه عبور اشتباه وارد شده<br><a href='javascript:history.go(-1)'>بازگشت</a>";
			} else {
				db_query(" update `users` set `password`='".$newP."' where `username`='$username' limit 1 ");
				$_SESSION["admin".$sp]=$newP;
				echo "کلمه عبور با موفقيت ثبت شد<br><a href='?page=admin'>بازگشت</a>";
			}
		}
		// echo "<script>location.href='./?page=admin'</script>";
		?>
		</td></tr>
	</table>
	</body>
	<?
	f_admin__a_html__down();
	f_admin__a_html__footer();
}


