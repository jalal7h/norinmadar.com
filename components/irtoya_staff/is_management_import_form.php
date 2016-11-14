<?

# jalal7h@gmail.com
# 2015/00/00
# Version 1.0.0
function is_management_howtobuy_form(){

	
}

function is_management_import_form(){

	#
	# action
	switch ($_REQUEST['do_import']) {
		case 'saveNew':
			return is_management_import_save();
	}

	#
	# form
	echo 
	fm(array('name'=>'is_management_import_form' , 'class'=>'is_management_import_form' , 'method'=>'post' , 'action'=>'?page=admin&cp='.$_REQUEST['cp'].'&func='.$_REQUEST['func'],'save_switch'=>'do_import')).
	"<div class='text'>فایل اکسل خود را ضمیمه فرم کنید :‌ </div>".
	ff(array('انتخاب فایل اکسل','n:irtoya_staff[]'=>'','accept'=>'*','inDiv')).
	ff(array('t:submit','n:submit'=>'آپلود و ثبت قطعات' , 'class'=>'submit_button', 'inDiv'));
	fm( 'close' );

	echo "<br><br>
	<hr>
	<br>
	<br>
	<a href='"._URL."/?do_action=is_management_export_save' class='submit_button'>دانلود خروجی اکسل</a>
	";


}
