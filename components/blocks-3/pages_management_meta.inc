<?

$GLOBALS['page-metatag'] = array(
	'meta_title',
	'meta_kw',
	'meta_desc',
);

function pages_management_meta(){
	
	switch ($_REQUEST['do2']){
		case 'save':
			pages_management_meta_save();
			break;
	}

	if(!$id = $_REQUEST['id']){
		die();
	} else if(!$rw = table("_pages", $id, null, "_page")){
		e(__FUNCTION__.__LINE__);
	} else {
		?>
		<form name="pages_management_meta" class="pages_management_meta" method="post" action="./?page=admin&cp=<?=$_REQUEST['cp']?>&do=<?=$_REQUEST['do']?>&id=<?=$_REQUEST['id']?>&do2=save">
			<? foreach ($GLOBALS['page-metatag'] as $k => $column) { ?>
			<div>
				<span><?=lmtc("_pages:".$column)?> ..</span>
				<textarea placeholder="&lt;?php // $rw

some php code


?&gt;" name="<?=$column?>"><?=$rw[$column]?></textarea>
			</div>
			<? } ?>
			
			<div class='submit-div'>
				<input type="button" value="بازگشت" class="submit_button" onclick="location.href='./?page=admin&cp=<?=$_REQUEST['cp']?>'" />
				<input type="submit" value="ثبت" class="submit_button" />
			</div>

		</form>
		<?
	}
}

function pages_management_meta_save(){
	
	foreach ($GLOBALS['page-metatag'] as $k => $column) {
		$fields[] = "`".$column."`='".mysql_real_escape_string( $_REQUEST[ $column ] )."'";
	}

	if(!$id = $_REQUEST['id']){
		die();
	} else if(!$rw = table("_pages", $id, null, "_page")){
		e(__FUNCTION__.__LINE__);
	} else if(!dbq(" UPDATE `_pages` SET ".implode(',', $fields)." WHERE `_page`='".$id."' LIMIT 1 ")){
		e(__FUNCTION__.__LINE__);
		echo dbe();
	} else {
		return true;
	}
}


