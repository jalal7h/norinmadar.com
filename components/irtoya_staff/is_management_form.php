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

	echo 
		
		ff(array("نام محصول",'n:name'=>$rw,'inDiv')).
		
		ff(array("کدمحصول",'n:code'=>$rw,'inDiv')).
		
		ff(array("مشخصات فنی",'t:textarea','n:technical_features'=>$rw,'inDiv')).
		
		ff(array('دسته بندی','n:cat*'=>$rw,'option'=>cat_display('main'),'inDiv')).
		
		ff(array("تعداد",'n:number'=>$rw,'inDiv')).
		
		ff(array("قیمت",'n:price'=>$rw,'inDiv')).
		
		ff(array("توضیحات",'t:textarea','n:desc'=>$rw,'inDiv')).
		

		ff(array('عکس','n:autoparts[]+'=>'','accept'=>'image/*','inDiv')).
		ff('br').
		ff('br').
		ff('br').
		
		ff(array('t:submit','n:submit'=>'ثبت', 'class'=>'submit_button', 'inDiv')).
		"</div>".
		fm('close' , $listifcsselements=false );

}
