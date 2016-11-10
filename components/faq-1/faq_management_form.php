<?

function faq_management_form(){
	if($id = $_REQUEST['id']){
		$rw = table("faq", $id);
	}
	echo
	fm(array('name'=>'faq_management_form' , 'class'=>'faq_management_form' , 'method'=>'post' , 'action'=>'?page=admin&cp='.$_REQUEST['cp'].'&func='.$_REQUEST['cp'].'_list','save_switch'=>'do')).
	ff(array("عنوان سوال",'n:name'=>$rw,'inDiv')).
	ff(array('پاسخ','t:textarea','n:text'=>$rw,'inDiv')).
	ff(array('t:submit','n:submit'=>'ثبت', 'class'=>'submit_button','inDiv'));
	fm('close');
}

