<?

$GLOBALS['block_layers']['contact_display'] = 'فرم تماس با ما';

function contact_display($table_name, $page_id){
	
	switch($table_name){
		case '_page_layers' :
			$query = " select * from `_page_layers` where `_id`='$page_id' limit 1 ";
			break;
		case '_page_frames' :
			$query = " select * from `_page_frames` where `_id`='$page_id' limit 1 ";
			break;
	}
	
	if(!$res_page=db_query($query)){
		$content.=cadr("Invalid page-id", "ERR");
		return false;
	} // else
	$rec_page = mysql_fetch_array($res_page);
	
	$error_flag = true;
	if($_REQUEST['do']=='send_contactUsForm'){
		$error_flag = false;
		if($send_dest=tab__temp("email_address_".$_REQUEST['_dest'])){
			;//
		} else {
			$error_flag = true;
		}
		$send_subj = "contact, from ".$_REQUEST['name'];
		$send_cont = $_REQUEST['_cont'];
		$send_from = $_REQUEST['_mail'];
	}
	
	if($error_flag==false){
		send_mail(
			 $send_dest
			,$send_subj
			,$send_cont
			,$send_from
		);
		$content.= "<br><center class=tx2>پيغام شما با موفقيت ارسال شد</center><br>";
	} else {
		if($_REQUEST['do']=='send_contactUsForm'){
			$content.= "<center class=er1>اختلال در ارسال ايميل</center>";
		}
		$vars=NULL;
		$vars['page']=$_REQUEST['page'];
		$vars['email_address_management_cu_status']=intval(tab__temp('email_address_management_cu_status'));
		$vars['email_address_sell_cu_status']=intval(tab__temp('email_address_sell_cu_status'));
		$vars['email_address_support_cu_status']=intval(tab__temp('email_address_support_cu_status'));
		$vars['email_address_webadmin_cu_status']=intval(tab__temp('email_address_webadmin_cu_status'));
		$vars['cu_company_addr']=tab__temp('cu_company_addr');
		$vars['cu_company_tell']=tab__temp('cu_company_tell');
		$vars['cu_company_fax']=tab__temp('cu_company_fax');
		if($_SESSION['uid']){
			$rw = mysql_fetch_array(dbq(" select * from `users` where `username`='".$_SESSION['uid']."' limit 1 "));
			$vars['user_mail'] = $rw['username'];
			$vars['user_name'] = $rw['name'];
			$vars['user_tell'] = $rw['tell'];
			$vars['user_cell'] = $rw['cell'];
		} else {
			$vars['user_mail'] = "";
			$vars['user_name'] = "";
			$vars['user_tell'] = "";
			$vars['user_cell'] = "";
		}
		$content.= template_engine('contact',$vars);
	}
	
	return create_box($rec_page['_title'], $content, $allow_eval, $rec_page['_framed'], $rec_page['_position']);
}




