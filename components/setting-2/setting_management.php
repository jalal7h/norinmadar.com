<?
$GLOBALS['cmp']['setting_management'] = 'تنظيمات سايت';

function setting_management(){
	if($_REQUEST['do']=='save_websiteconfiguration'){
		tab__temp('main_title', true, $_REQUEST['main_title']);
		tab__temp('keywords', true, $_REQUEST['keywords']);
		tab__temp('websitedescription', true, $_REQUEST['websitedescription']);
		tab__temp('template', true, $_REQUEST['template']);
		
		tab__temp('sms_state', true, $_REQUEST['sms_state']);

		tab__temp('webstatus_signup', true, $_REQUEST['webstatus_signup']);
		tab__temp('webstatus_main', true, $_REQUEST['webstatus_main']);
		tab__temp('money_unit', true, $_REQUEST['money_unit']);
		tab__temp('UserInviteTemplateBody', true, $_REQUEST['UserInviteTemplateBody']);
		tab__temp('UserInviteTemplateTitle', true, $_REQUEST['UserInviteTemplateTitle']);
		tab__temp('__sms_notify_content', true, $_REQUEST['__sms_notify_content']);
		tab__temp('RefferalRevard', true, $_REQUEST['RefferalRevard']);
		tab__temp('__instruction_tab', true, $_REQUEST['__instruction_tab']);
		tab__temp('about', true, $_REQUEST['about']);
		echo "<script>alert('تغييرات ثبت شد')</script>";
		die();
	}
	?>
	<iframe name="iframe8" style="display:none;"></iframe>
	<form method="post" action="" target="iframe8" name="form8">
	<input type="hidden" name="page" value="<?=$_REQUEST['page']?>" >
	<input type="hidden" name="do" value="save_websiteconfiguration" >
	<fieldset class="setting_management">
		
		<legend>تنظيمات سايت</legend>

		<div>
			<span>اسم شرکت :</span>
			<input type="text" name="main_title" value="<?=tab__temp('main_title')?>">
		</div>

		<div>
			<span>فعاليت شرکت : </span>
			<input type="text" name="websitedescription" value="<?=tab__temp('websitedescription')?>">
		</div>

		<div>
			<span>کلمات کلیدی : </span>
			<input type="text" name="keywords" value="<?=tab__temp('keywords')?>">
		</div>

		<div>
			<span>واحد پولی : </span>
			<input type="text" name="money_unit" value="<?=tab__temp('money_unit')?>">
		</div>

		<div>
			<span>قالب سايت : </span>
			<select name="template">
				<?
				if(!@$dp=opendir('templates')){
					echo "<option value='Default' >Default</option>";
				} else {
					while($dn=readdir($dp)){
						if($dn=='.' or $dn=='..' or is_file("templates/".$dn)){
							continue;
						} else {
							echo "<option value='$dn' >$dn</option>";
						}
					}
				}
				?>
			</select>
			<script>form8.template.value="<?=tab__temp('template')?>";</script>
		</div>

		<div class="copyright_div">
			<span>کپی رایت :</span>
			<textarea name="about" ><?=tab__temp('about')?></textarea>
		</div>

		<div>
			<span>وضعیت سایت</span>
			<select name="webstatus_main">
				<option value="1">فعال</option>
				<option value="0">غيرفعال</option>
			</select>
			<script>form8.webstatus_main.value="<?=(int)tab__temp('webstatus_main')?>";</script>
		</div>

		<div>
			<span>ارسال پیامک</span>
			<select name="sms_state">
				<option value="1">فعال</option>
				<option value="0">غيرفعال</option>
			</select>
			<script>form8.sms_state.value="<?=(int)tab__temp('sms_state')?>";</script>
		</div>

		<div class="submit_div">
			<input type="submit" class="submit_button" value="ثبت تغييرات" >
		</div>

	</fieldset>
	</form>
	<?
}








