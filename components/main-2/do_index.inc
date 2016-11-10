<?

function do_index(){
	
	if($_REQUEST['page']=='admin'){
		$rand=$_SESSION['hcfalf'];
		$us=cpt('user'.$rand, true);
		$pw=cpt('pass'.$rand, true);
		$su='ssus'.$rand;
		$sp='sspw'.$rand;
		
		if(
			(!admin_check($_SESSION['admin'.$su],$_SESSION['admin'.$sp])) and 
			(!admin_login($_POST[$us],cpt($_POST[$pw])))
		){
			f_admin__a_html__header();
			f_admin__a_html__top();
			admin_login_form();
			f_admin__a_html__down();
			f_admin__a_html__footer();
		} else {
			if(pinCodeRequest!==false){
				if(!knownIP($_SESSION['admin'.$su],true)){
					IncAtc();
					echo "unknown ip";
					die();
				}
			}
			admin_pre();
			f_admin__a_html__header();
			f_admin__a_html__top();
			draw_admin();
			f_admin__a_html__down();
			f_admin__a_html__footer();
		}
	} else {
		if(!$res=db_query(" select * from `_pages` where `_page`='".$_REQUEST['page']."' limit 1 ")){
			// echo "<center class=er1>invalid progress</center>";
		} elseif(mysql_num_rows($res)!=1){
			$_REQUEST['page']=1;
		} else {
			;// do nothing
		}
		
		do_index_switch();
		
		if(tab__temp('webstatus_main')!=1){
			f_admin__a_html__header();
			?>
			<table bgcolor="#f4f2ed" height="100%" width="100%"><tr>
			<td align="center" style="font-size:24;">وبسايت در حال آماده سازي ميباشد</td>
			</tr></table>
			<?
			f_admin__a_html__footer();
			die();
		}
		ob_start();
		f_front__f_html__header();
		f_front__f_layers__draw($_REQUEST['page']);
		f_front__f_html__footer();
		$content = ob_get_contents();
		ob_end_clean();
		echo $content;
		do_pre();
	}
}







