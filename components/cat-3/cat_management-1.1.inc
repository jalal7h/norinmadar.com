<?

# jalal7h@gmail.com
# 2015/09/09
# Version 1.1.1

// $url = "./?page=admin&cp=".$_REQUEST['cp'];
// 	$menu = array(
// 		"ms_management_list" => "لیست موبایل ها",
// 		"ms_management_form" => "ثبت موبایل جدید",
// 		"cat_management&l=brand" => "برندها",
// 		"cat_management&l=stuff_status" => "وضعیت ها",
// 		"cat_management&l=mobile_sim" => "سیم ها",
// 		"cat_management&l=mobile_os" => "سیستم عامل ها",
// 		"cat_management&l=mobile_browser" => "مرورگر",
// 	);
// 	listmaker_tabmenu($menu,$url);

function cat_management(){
	
	if(!$l = $_REQUEST['l']){
		if(!sizeof($GLOBALS['cat_items'])){
			echo "err - ".__LINE__;
		} else foreach($GLOBALS['cat_items'] as $l => $r){
			break;
		}
	} else {
		$r = $GLOBALS['cat_items'][$l];
	}

	$parent = intval($_REQUEST['parent']);
	$parent0 = $parent;
	while($parent0>0){
		$parent_status = " <a href='./?page=admin&cp=".$_REQUEST['cp']."&func=".$_REQUEST['func']."&l=$l&parent=$parent0' >» ".table('cat',$parent0,'name')."</a>".$parent_status;
		$parent0 = table("cat",$parent0,'parent');
	}
	
	switch($_REQUEST['do']){
		
		case 'movedown':
			cat_management_ordmove($_REQUEST['id'] , "+");
			break;

		case 'moveup':
			cat_management_ordmove($_REQUEST['id'] , "-");
			break;

		case 'saveNew' : 
			cat_management_saveNew();
			break;
			
		case 'saveEdit' : 
			cat_management_saveEdit();
			break;

		case 'remove' :
			cat_management_remove();
			break;
	}
	
	
	echo "<div id=cat_form_management >
	<div id=cat_management >";

	// if(!$GLOBALS['cat_spread_management']){
	// 	echo "<select onchange='location.href=\""._URL."/?page=admin&cp=".$_REQUEST['cp']."&func=".$_REQUEST['func']."&l=\"+this.value' id=l >";
	// 	foreach($GLOBALS['cat_items'] as $k0 => $r0){
	// 		$r0 = $r0[0];
	// 		echo "<option value='$k' >$r</option>";
	// 	}
	// 	echo "</select>";
	// }

	echo "
	<script>
	document.getElementById('l').value='".$l."';
	</script>
	<div class=delimiter ></div>
	<div class=title ><font color=green ><a href='./?page=admin&cp=".$_REQUEST['cp']."&func=".$_REQUEST['func']."&l=$l'>» ".$GLOBALS['cat_items'][$l][0]."</a></font>$parent_status</div>
	<div class=delimiter ></div>
	";
	
	# list
	if(!$rs = dbq(" SELECT * FROM `cat` WHERE `cat`='".$l."' AND `parent`='$parent' ORDER BY `ord` ")){
		echo dbe();
	} else if(!dbn($rs)){
		echo "<br><br><br><center>هنوز موردی ثبت نشده است</center><br><br><br><br><br>";
	} else while($rw = dbf($rs)){
		echo "
		<div class=record >
			<form enctype='multipart/form-data' method=post action='./?page=admin&cp=".$_REQUEST['cp']."&func=".$_REQUEST['func']."&l=".$_REQUEST['l']."&parent=".$_REQUEST['parent']."&id=".$rw['id']."&do=saveEdit' >
				
				<a onclick='if(!confirm(\"آیا مایل به حذف هستید؟\"))return false;' href='"._URL."/?page=admin&cp=".$_REQUEST['cp']."&func=".$_REQUEST['func']."&l=".$_REQUEST['l']."&parent=".$_REQUEST['parent']."&do=remove&id=".$rw['id']."' ><img src='image.list/cat-delete_2.png' /></a>
				
				<a href='"._URL."/?page=admin&cp=".$_REQUEST['cp']."&func=".$_REQUEST['func']."&l=".$_REQUEST['l']."&parent=".$_REQUEST['parent']."&do=moveup&id=".$rw['id']."' ><img class=arrow src='".imgp("cat-arrow-up.png")."' /></a>

				<a href='"._URL."/?page=admin&cp=".$_REQUEST['cp']."&func=".$_REQUEST['func']."&l=".$_REQUEST['l']."&parent=".$_REQUEST['parent']."&do=movedown&id=".$rw['id']."' ><img class=arrow src='".imgp("cat-arrow-down.png")."' /></a>
				
				<input type='text' name='name' value='".$rw['name']."' >

				".($GLOBALS['cat_items'][$l][3]==true?"<input class='green' rel='آپلود' type='file' name='cat[]'/>":"")."

				<input type='submit' class='submit_button' value='ویرایش' >
				".($r[2]?"<a class=subanchor href='"._URL."/?page=admin&cp=".$_REQUEST['cp']."&func=".$_REQUEST['func']."&parent=".$rw['id']."'>زیردسته</a>":"")."
			</form>
		</div>";
	}
	
	# new form
	echo "
	<div id=new >
		<form method=post action='"._URL."/?page=admin&cp=".$_REQUEST['cp']."&func=".$_REQUEST['func']."&do=saveNew&l=".$_REQUEST['l']."&parent=".$_REQUEST['parent']."' >
		<input type=text name='name' value='' id='newName' >
		".($GLOBALS['cat_items'][$l][3]==true?"<input class='green' rel='آپلود' type='file' name='logo'/>":"")."
		<input type=submit class='submit_button' value='ثبت' >
		</form>
	</div>
	<script>document.getElementById('newName').focus();</script>
	
	<div class=delimiter ></div>
	
	</div>
	</div>";
}









