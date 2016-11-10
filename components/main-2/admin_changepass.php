<?
$GLOBALS['do_action'][] = 'admin_changepass';

function admin_changepass(){
	f_admin__a_html__header();
	f_admin__a_html__top();
	?>
	<style>
	input {
		margin: 1px;
		text-align: center;
		direction: rtl;
		font-size: 15px;
		width: 200px;
	}
	.container {
		box-shadow: 0 0 20px #ccc;
	}
	</style>
	<body bgcolor="#f4f3e9">
	<br><br><br><br><br><br>
	<form dir="rtl" action="" method="post">
	<input type="hidden" name="do_action" value="admin_changepass_save" >
		<table width="100%" height="100%"><tr><td align="center">
		<table cellpadding="0" cellspacing="1" bgcolor="#ccc" ><tr><td>
		<div class="container">
		<table bgcolor="#f8f8f8" width="400" >
			<tr height="40"><td colspan="2"></td></tr>
			<tr>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;پسورد قبلي : </td>
				<td><input class="input1" type="password" name="oldP" ></td>
			</tr>
			<tr>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;پسورد جديد : </td>
				<td><input class="input1" type="password" name="newP" ></td>
			</tr>
			<tr>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;تکرار پسورد : </td>
				<td><input class="input1" type="password" name="newP2" ></td>
			</tr>
			<tr height="30"><td colspan="2"></td></tr>
			<tr><td align="center" colspan="2">
			<input type="button" class="submit1" style="width:100px; height:25px;" onclick="location.href='?page=admin'" value="بازگشت">
			<input type="submit" class="submit1" style="width:100px; height:25px;" value="ثبت تغييرات">
			</td></tr>
			<tr height="30"><td colspan="2"></td></tr>
		</table>
		</div>
		</td></tr>
		</table>
		</td></tr></table>
	</form>
	</body>
	<?
	f_admin__a_html__down();
	f_admin__a_html__footer();
}











