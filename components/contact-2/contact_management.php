<?
$GLOBALS['cmp']['contact_management'] = 'تماس با ما';



function contact_management(){

	switch($_REQUEST['do']){
		case 'save_cu_changes' : 
			tab__temp('email_address_webadmin_cu_status',true,intval($_REQUEST['email_address_webadmin_cu_status']));
			tab__temp('email_address_sell_cu_status',true,intval($_REQUEST['email_address_sell_cu_status']));
			tab__temp('email_address_management_cu_status',true,intval($_REQUEST['email_address_management_cu_status']));
			tab__temp('email_address_support_cu_status',true,intval($_REQUEST['email_address_support_cu_status']));
			tab__temp('cu_company_addr',true,$_REQUEST['cu_company_addr']);
			tab__temp('cu_company_tell',true,$_REQUEST['cu_company_tell']);
			tab__temp('cu_company_fax',true,$_REQUEST['cu_company_fax']);

			tab__temp('email_address_webadmin', true, $_REQUEST['email_address_webadmin']);
			tab__temp('email_address_management', true, $_REQUEST['email_address_management']);
			tab__temp('email_address_sell', true, $_REQUEST['email_address_sell']);
			tab__temp('email_address_support', true, $_REQUEST['email_address_support']);
			break;
	}
	
	?>
	<form method="post" action="">
	<input type="hidden" name="page" value="admin" >
	<input type="hidden" name="cp" value="<?=$_REQUEST['cp']?>" >
	<input type="hidden" name="do" value="save_cu_changes" >
	<fieldset class="contact_management">
		
		<legend align="right">تماس با ما</legend>

		<div class="emails">
			<div>
				&nbsp;مديريت سايت<br>
				<input dir="ltr" type=text name="email_address_webadmin" value="<?=tab__temp('email_address_webadmin')?>">
			</div>

			<div>
				&nbsp;مدير شرکت<br>
				<input dir="ltr" type=text name="email_address_management" value="<?=tab__temp('email_address_management')?>">
			</div>

			<div>
				&nbsp;مدير فروش<br>
				<input dir="ltr" type=text name="email_address_sell" value="<?=tab__temp('email_address_sell')?>">
			</div>

			<div>
				&nbsp;بخش پشتيباني<br>
				<input dir="ltr" type=text name="email_address_support" value="<?=tab__temp('email_address_support')?>">
			</div>

		</div>

		<div class="delimiter"></div>

		<div class="path">
		
			<div>
				<span>آدرس شرکت : </span>
				<input type="text" name="cu_company_addr" value="<?=tab__temp('cu_company_addr')?>" >
			</div>

			<div>
				<span>تلفن شرکت :</span>
				<input type="text" name="cu_company_tell"  value="<?=tab__temp('cu_company_tell')?>" >
			</div>

			<div>
				<span>فکس شرکت : </span>
				<input type="text" name="cu_company_fax"  value="<?=tab__temp('cu_company_fax')?>" >
			</div>				
					
		</div>

		<center><input type="submit" class="submit_button" value="تاييد" ></center>

	</fieldset>
	</form>
	<?
}







?>
