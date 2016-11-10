<?

function do_index_switch(){
	switch($_REQUEST['do']){
		
		case 'city__save_city' :
			$rand=$_SESSION['hcfalf'];
			$us=cpt('user'.$rand, true);
			$pw=cpt('pass'.$rand, true);
			$su='ssus'.$rand;
			$sp='sspw'.$rand;
			if(!admin_check($_SESSION['admin'.$su],$_SESSION['admin'.$sp])){
				echo "per la stazione :-B";
				die();
			}
			dbq(" update `pos_cities` set `name`='".$_REQUEST['name']."' where `id`='".$_REQUEST['id']."' limit 1 ");
			echo " update `pos_cities` set `name`='".$_REQUEST['name']."' where `id`='".$_REQUEST['id']."' limit 1 ";
			echo '
			<script>
			top.document.getElementById(\'city'.$_REQUEST['id'].'\').disabled = 0;
			top.document.getElementById(\'citysubm'.$_REQUEST['id'].'\').disabled = 0;
			</script>
			';
			die();
			
		case 'state__save_state' :
			$rand=$_SESSION['hcfalf'];
			$us=cpt('user'.$rand, true);
			$pw=cpt('pass'.$rand, true);
			$su='ssus'.$rand;
			$sp='sspw'.$rand;
			if(!admin_check($_SESSION['admin'.$su],$_SESSION['admin'.$sp])){
				echo "per la stazione :-B";
				die();
			}
			dbq(" update `pos_states` set `name`='".$_REQUEST['name']."' where `id`='".$_REQUEST['id']."' limit 1 ");
			echo " update `pos_states` set `name`='".$_REQUEST['name']."' where `id`='".$_REQUEST['id']."' limit 1 ";
			echo '
			<script>
			top.document.getElementById(\'state'.$_REQUEST['id'].'\').disabled = 0;
			top.document.getElementById(\'subm'.$_REQUEST['id'].'\').disabled = 0;
			</script>
			';
			die();
			
		case 'reservation__save_reservation' :
			$rand=$_SESSION['hcfalf'];
			$us=cpt('user'.$rand, true);
			$pw=cpt('pass'.$rand, true);
			$su='ssus'.$rand;
			$sp='sspw'.$rand;
			if(!admin_check($_SESSION['admin'.$su],$_SESSION['admin'.$sp])){
				echo "per la stazione :-B";
				die();
			}
			dbq(" update `reservation` set `name`='".$_REQUEST['name']."' where `id`='".$_REQUEST['id']."' limit 1 ");
			echo '
			<script>
			top.document.getElementById(\'reservation'.$_REQUEST['id'].'\').disabled = 0;
			top.document.getElementById(\'subm'.$_REQUEST['id'].'\').disabled = 0;
			</script>
			';
			die();
			
		case 'let_me_khow_states' : 
			$id = $_REQUEST['id'];
			echo "<option value='' > .. استان .. </option>";
			if(!$rs = dbq(" select * from `pos_states` where `parent`='$id' ")){
				echo "error - index - ".__LINE__;
			} else if(!$nm = mysql_num_rows($rs)){
				;//echo "error - index - ".__LINE__;
			} else {
				
				for($i=0; $i<$nm; $i++){
					$rw = mysql_fetch_array($rs);
					if(intval($_REQUEST['select'])==$rw['id']){
						echo '<option value="'.$rw['id'].'" selected >'.$rw['name'].'</option>';
					} else {
						echo '<option value="'.$rw['id'].'">'.$rw['name'].'</option>';
					}
				}
				
			}
			echo '<option value="other">دیگر ..</option>';
			die();
		
		case 'let_me_khow_cities' : 
			$id = $_REQUEST['id'];
			echo "<option value='' > .. شهر .. </option>";
			if(!$rs = dbq(" select * from `pos_cities` where `parent`='$id' ")){
				echo "error - index - ".__LINE__;
			} else if(!$nm = mysql_num_rows($rs)){
				;//echo "error - index - ".__LINE__;
			} else {
				for($i=0; $i<$nm; $i++){
					$rw = mysql_fetch_array($rs);
					if(intval($_REQUEST['select'])==$rw['id']){
						echo '<option value="'.$rw['id'].'" selected >'.$rw['name'].'</option>';
					} else {
						echo '<option value="'.$rw['id'].'">'.$rw['name'].'</option>';
					}
				}
				
			}
			echo '<option value="other">دیگر ..</option>';
			die();
		
		
		case 'ReceiveSMS' :
			sms_getNewMessages();
			die();
		
		case 'returnFromBank_bank' :
			payment_returnFromBank_bank($_REQUEST);
			die();
			break;
		
		case 'returnFromBank_user' :
			payment_returnFromBank_user($_REQUEST);
			die();
			break;
		
		case 'user_logout' : 
			user_logout();
			break;
		
		case 'admin_logout' : 
			admin_logout();
			break;
		
		case 'userForgotPasswordA' : 
			send_activatin_for_newpassword($_REQUEST['username']);
			f_front__f_html__header();
			?>
			<script>
			alert('لينک تاييد تغيير کلمه عبور به آدرس ايميل شما ارسال شده است\nبراي تغيير کلمه عبور بايد لينک را باز کنيد');
			top.document.getElementById('forgotpassTr').style.display='';
			top.document.getElementById('forgotpassForm').style.display='none';
			</script>
			<?
			die();
		
		case 'userForgotPasswordB' : 
			$link=$_REQUEST['link'];
			$username=base64_decode(urldecode($_REQUEST['b64user']));
			f_front__f_html__header();
			if($link!=cpt($_SERVER['REMOTE_ADDR'].date("H").$username)){
				?>
				<script>
				alert('لينک معتبر نيست');
				</script>
				<?
			} else {
				$newPassword=substr(md5(rand(10000001,99999999)),0,8);
				db_query(" update `users` set `password`='".$newPassword."' where `username`='$username' limit 1 ");
				send_newPassword($username,$newPassword);
				?>
				<script>
				alert('کلمه عبور جديد به آدرس ايميل شما ارسال شد');
				</script>
				<table width="100%" height="100%"><tr><td align="center"><a href="/?">صفحه اصلي</a></td></tr></table>
				<?
			}
			f_admin__a_html__footer();
			die();
		
		DEFAULT :
			;// do nothing
			break;
	}
}








