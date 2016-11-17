<?

function slideshow_management_form(){
	
	if(! $id = $_REQUEST['id'] ){
		//
	
	} else if(! $tSlideshow = table("slideshow",$id) ){
		echo "err - ".__LINE__;
	}

	?>
	<div id="slideshow_management_form">
	<form method=post enctype="multipart/form-data" action="./?page=admin&cp=<?=$_REQUEST['cp']?>&func=slideshow_management_list&do=<?=($tSlideshow?'saveEdit&id='.$id:'saveNew')?>">
	<?
	
	$GLOBALS['formName'] = "sForm";
	
	echo
	'<div class=devider ></div>'.
	ff(array( ("عنوان اسلاید") ,'n:name*'=>$tSlideshow,'inDiv')).
	ff(array("http://",'etc'=>'dir=ltr','n:link'=>$tSlideshow,'inDiv')).
	ff(array( ("توضیحات"),'n:description'=>$tSlideshow,'inDiv')).
	ff(array('عکس','n:slideshow[]'=>'','accept'=>'image/*','inDiv')).
	'<div class=devider ></div>'.
	ff(array( ("ثبت"),'n:submit'=>('ثبت'),'class'=>'submit_button','t:submit','inDiv'));
	
	?>
	</form>
	</div>
	<?
}


