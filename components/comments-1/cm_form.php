<?

function cm_form( $table , $id=null ){
	if(!$id){
		if(!$id = $_REQUEST['id']){
			echo "err - ".__LINE__;
			die();
		}
	}
	$c.= '
	<iframe name="frame00232c" style="display: none;"></iframe>
	<form id="cm_form" style="display: block;" class="cm_form" name="cm_form" onsubmit="if(cm_form.text.value==\'\')return false;" target="frame00232c" method="post" action="./?do_action=cm_save" >
		<input type="hidden" name="table" value="'.$table.'" />
		<input type="hidden" name="id" value="'.$id.'" />
		<input type="text" name="name" value="" placeholder="نام" />
		<input type="text" name="email" value="" dir=ltr placeholder="email address" />
		<textarea name="text" placeholder="* نظر شما"></textarea>
		<input type="submit" value="ارسال">
	</form>

	<div id="aftersendmsg" style="display: none; clear: both; border-top: 1px dashed #ccc; margin: 0 30px; padding: 20px 0 ;">
		<div class="convbox" >پیام شما ثبت شد و با تایید مدیریت روی سایت قرار خواهد گرفت.</div>
		<br>
	</div>
	';

	return $c;
}

