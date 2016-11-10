<?

# jalal7h@gmail.com
# 2015/10/21
# Version 1.0.0

function is_management_form(){
	
	if(!$id = $_REQUEST['id']){
		// its new
	} else if(!$rw = table("irtoya_staff", $id)){
		e(__FUNCTION__.__LINE__);
	}

	
	
	echo 
	fm(array('name'=>'is_management_form' , 'class'=>'is_management_form' , 'method'=>'post' , 'action'=>'?page=admin&cp='.$_REQUEST['cp'].'&func='.$_REQUEST['cp'].'_list','save_switch'=>'do'));

	foreach ($GLOBALS['irtoya_staff_order_of_columns'] as $k => $column) {
		echo ff(array(lmtc("irtoya_staff:".$column),'n:'.$column=>$rw,'inDiv'));
	}

	echo 
		"<div></div>".
		"<div style='width: 80%;text-align: right; margin: 30px 0px 80px 0;'>".
		ff(array('عکس','n:autoparts[]+'=>'','accept'=>'image/*','inDiv')).
		ff('br').
		ff('br').
		ff('br').
		ff(array('t:submit','n:submit'=>'ثبت', 'class'=>'submit_button', 'inDiv')).
		"</div>".
		fm('close' , $listifcsselements=false );

}
