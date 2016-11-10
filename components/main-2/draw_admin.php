<?

function draw_admin(){
	?>
	<center>
	<div style="width: 1012px; max-width: 95%;">
	<table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%">
		<tr height="30" bgcolor="#ddd">
		<td align="left" width="300px" >
		&nbsp;&nbsp;&nbsp;<a style="font-weight:bold; color:#a0a0a0; font-size:13px; font-family:'Ceurior new'" href="?do=admin_logout">LogOut</a>
		&nbsp;<font color=blue>|</font>&nbsp;<a style="font-weight:bold; color:#a0a0a0; font-size:13px; font-family:'Ceurior new'" href="?do_action=admin_changepass">Change password</a>
		</td>
		<td align="center"><? draw_tasks()?></td>
		<td dir="rtl"><?
			if(isset($_REQUEST['cp'])){
				echo '&nbsp;&nbsp;&nbsp;<a href="?page=admin"> » مديريت</a>';
				if(isset($_REQUEST['do'])){
					echo '<a href="?page=admin&cp='.$_REQUEST['cp'].'"> » '.$GLOBALS['cmp'][$_REQUEST['cp']].'</a>';
				} else {
					echo ' » '.$GLOBALS['cmp'][$_REQUEST['cp']];
				}
			} else {
				echo '&nbsp;&nbsp;&nbsp; » مديريت';
			}
		?></td></tr>
		<tr height="1" bgcolor="#e3e3e3"><td colspan="3"></td></tr>
		<tr height="10"><td colspan="3"></td></tr>
		<tr><td colspan="3" align="center" valign=top >
		<?

		if($_REQUEST['cp']=='cat_management' and $_REQUEST['l']){
			$global_switch_complex = $GLOBALS['cmp'][$_REQUEST['cp']."&l=".$_REQUEST['l']];
		} else {
			$global_switch_complex = $GLOBALS['cmp'][$_REQUEST['cp']];
		}

		if($global_switch_complex){
			call_user_func($_REQUEST['cp']);
		} else {
			draw_cp_framework();
		}
		?>
		</td></tr>
		<tr height="10"><td colspan="3"></td></tr>
	</table>
	</div>
	</center>
	<?
}





