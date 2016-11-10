<?

function news_management_form(){
	if(!$id = $_REQUEST['id']){
		;//
	} else if(!$tnews = table("news",$id)){
		echo "err - ".__LINE__;
	}
	?>
	<div id="news_management_form">
	<form method=post enctype="multipart/form-data" action="./?page=admin&cp=<?=$_REQUEST['cp']?>&func=news_management_list&do=<?=($tnews?'saveEdit&id='.$id:'saveNew')?>">
	<?
	
	$GLOBALS['formName'] = "newsForm";
	
	echo
	'<div class=devider ></div>'.
	ff(array("عنوان خبر",'n:name*'=>$tnews,'inDiv')).
	ff(array("شرح خبر",'n:text'=>$tnews,'t:textarea','class'=>'tinymce','inDiv')).
	ff(array("کلمات کلیدی (با ویرگول جدا کنید)",'n:tag'=>$tnews,'inDiv')).
	ff(array('عکس','n:news[]'=>'','accept'=>'image/*','inDiv')).
	ff(array("ثبت",'n:submit'=>'ثبت','class'=>'submit_button','t:submit','inDiv')).
	'<div class=devider ></div>';
	
	?>
	</form>
	</div>
	<?
}


