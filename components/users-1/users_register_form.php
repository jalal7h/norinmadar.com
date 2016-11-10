<?

function users_register_form(){
	if($_SESSION['uid']){
		header("Location: ./userpanel");
		die();
	}

	echo 
	fm(array('name'=>'users_register_form' , 'class'=>'users_register_form' , 'method'=>'post' , 'action'=>'./register_do')).
	'<div class="d01">پرکردن تمام موارد اجباری است</div>
		<div class="container">
		<div class="d02">ثبت نام</div>'.
	ff(array("نام و نام خانوادگی",'n:name*'=>null)).
	ff(array("تلفن همراه",'n:cell*'=>null)).
	ff(array("پست الکترونیک",'n:username*'=>null)).
	ff(array("انتخاب کلمه عبور",'t:password','n:password*'=>null)).
	'<div class="d04">شما با کلیک کردن روی دکمه ثبت نام موافقت می کنید که تمامی <a href="./terms">قوانین سایت</a> پذیرفته اید.</div>'.
	ff(array('t:submit','class'=>'submit_button','n:submit'=>'ثبت نام')).
	'<div class="d05">اگر قبلآ ثبت نام کرده اید <a href="./login">وارد شوید</a></div>
	</div>'.
	fm('close');
}

