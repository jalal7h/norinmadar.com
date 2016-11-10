<?

function users_forgot_send(){
	$email = $_REQUEST['username'];
	$h = sha1($email."01q!");
	$link = _URL."/?page=".$_REQUEST['page']."&do=new&email=".$email."&h=".$h;
	echo "<div style='width: 70%; margin: 120px auto 120px auto;' class='convbox'>لینک تنظیم مجدد کلمه عبور به آدرس ایمیل \"$email\" ارسال شد.<br>لطفا با باز کردن لینک فرم مربوطه را تکمیل نمایید.</div>";

	$subj = "درخواست کلمه عبور جدید!";
	$text = "سلام,

	با توجه به درخواست شما برای ثبت کلمه عبور جدید ، ما یک پیوند برای تنظیم مجدد کلمه عبور به آدرس ایمیل شما ارسال نمودیم.
	لینک : 
	$link

با تشکر";
	$head = "\"noreply\" <noreply@".str_replace("www.","",$_SERVER['SERVER_NAME']).">\r\n";

	mail($email, $subj, $text, $head);
}

