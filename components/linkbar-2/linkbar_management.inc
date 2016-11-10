<?
$GLOBALS['cmp']['linkbar_management'] = 'مديريت پيوندها';

define('__userPanelLink', false);
define('__doubleLevel', true);
define('__sublink', false);

function linkbar_management(){
	switch($_REQUEST['do']){
		
		case 'activatelik' :
			db_query(" update `_links` set `_status`=1 where `_id`='".$_REQUEST['_id']."' ");
			break;
		
		case 'deactivatelik' :
			db_query(" update `_links` set `_status`=0 where `_id`='".$_REQUEST['_id']."' ");
			break;
		
		case 'moveuplink' :
			$res = db_query(" select * from `_links` where `_id`='".$_REQUEST['_id']."' limit 1 ");
			$rec = mysql_fetch_array($res);
			linkbar_set_priority($rec['_type']);
			if(!$res=db_query(" select * from `_links` where `_type`='".$rec['_type']."' and `_priority`<='".$rec['_priority']."' order by `_priority` desc limit 2 ")){
				echo cadr("er - ".__LINE__);
				break;
			} elseif (mysql_num_rows($res)!=2){
				echo cadr("er - ".__LINE__);
				break;
			} else {
				$rec_1 = mysql_fetch_array($res);
				$rec_2 = mysql_fetch_array($res);
				db_query(" update `_links` set `_priority`='".$rec_1['_priority']."' where `_id`='".$rec_2['_id']."' limit 1 ");
				db_query(" update `_links` set `_priority`='".$rec_2['_priority']."' where `_id`='".$rec_1['_id']."' limit 1 ");
			}
			break;
		
		case 'movedownlink' :
			$res = db_query(" select * from `_links` where `_id`='".$_REQUEST['_id']."' limit 1 ");
			$rec = mysql_fetch_array($res);
			linkbar_set_priority($rec['_type']);
			if(!$res=db_query(" select * from `_links` where `_type`='".$rec['_type']."' and `_priority`>='".$rec['_priority']."' order by `_priority` asc limit 2 ")){
				echo cadr("er - ".__LINE__);
				break;
			} elseif (mysql_num_rows($res)!=2){
				echo cadr("er - ".__LINE__);
				break;
			} else {
				$rec_1 = mysql_fetch_array($res);
				$rec_2 = mysql_fetch_array($res);
				db_query(" update `_links` set `_priority`='".$rec_1['_priority']."' where `_id`='".$rec_2['_id']."' limit 1 ");
				db_query(" update `_links` set `_priority`='".$rec_2['_priority']."' where `_id`='".$rec_1['_id']."' limit 1 ");
			}
			break;
		
		case 'deletelink' :
			db_query(" delete from `_links` where 1 and `_id`='".$_REQUEST['_id']."' OR `parent`='".$_REQUEST['_id']."' ");
			break;
			
		case 'editlink' :
			return editlink_panel($_REQUEST['_id']);
			break;
			
		case 'save_editlink' :
			//if(strtolower(substr($_REQUEST['_url'],0,7))!='http://'){
			//	$_REQUEST['_url']="http://".$_REQUEST['_url'];
			//}
			if(!db_query(" update `_links` set `_url`='".$_REQUEST['_url']."', `_title`='".$_REQUEST['_title']."',`parent`='".$_REQUEST['parent']."' where `_id`='".$_REQUEST['_id']."' limit 1 ")){
				echo cadr("err67");
			} else {
				echo cadr("پيوند با موفقيت ويرايش شد","INF");
			}
			break;
		
		case 'save_addlink' :
			//if(strtolower(substr($_REQUEST['_url'],0,7))!='http://'){
			//	$_REQUEST['_url']="http://".$_REQUEST['_url'];
			//}
			$res=db_query(" select `_priority` from `_links` where `_type`='".$_REQUEST['_type']."' order by `_priority` desc limit 1 ");
			if(mysql_num_rows($res)==1){
				$new_priority=intval(mysql_result($res,0,0))+1;
			} else {
				$new_priority=1;
			}
			if(!$res=db_query(" insert into `_links` 
			(`_id`,`_url`,`_title`,`_type`,`_priority`,`_status`,`parent`) values 
			('','".$_REQUEST['_url']."','".$_REQUEST['_title']."','".$_REQUEST['_type']."',$new_priority,1,'".$_REQUEST['parent']."') ")){
				echo cadr("er - ".__LINE__);
			} else {
				echo cadr("پيوند جديد با موفقيت ثبت شد","INF");
			}
			break;
	}
	
	if(!$res_i= db_query(" select * from `_links` where `_type`='index' and `parent`='".intval($_REQUEST['parent'])."' order by `_priority` ")){
		echo dbe();
		return false;
	}
	$num=mysql_num_rows($res_i);
	for($i=0; $i<$num; $i++){
		$rec_i[$i]=mysql_fetch_array($res_i);
	}
	?>
	<fieldset dir="rtl" style="width:100% ">
	<legend align="right">پيوندهاي صفحه اصلي<?=($_REQUEST['parent']?" [".table("_links",$_REQUEST['parent'],"_title","_id")."]":"")?></legend>
	<br>
	<table width="95%" dir="ltr" cellpadding="0" cellspacing="0">
	<tr height="34px" >
	<td width="34px"><img src="image.list/tab_left.png" width="34"  height="34"></td>
	<td width="250" background="image.list/tab_bg.png" align=center ></td>
	<td width="50%" background="image.list/tab_bg.png" align=center >آدرس</td>
	<td width="50%" background="image.list/tab_bg.png" align=center >عنوان</td>
	<td width="34px"><img src="image.list/tab_right.png" width="34"  height="34"></td>
	</tr>
	</table>
	<table align="center" width="95%" height="100%" cellpadding="0" cellspacing="1" border="0" bgcolor="#f0f0f0"><tr><td>
	<table width="100%" height="100%" cellpadding="0" cellspacing="0" border="0" bgcolor="white">
	<tr height="10"><td colspan="9"></td></tr>
	<?
	if(sizeof($rec_i)==0){
		echo "<tr><th colspan=99 ><br><center>پیوندی ثبت نشده است</center></th></tr>";
	} else for($i=0; $i<sizeof($rec_i); $i++){
		if($rec_i[$i]['_status']){
			$bgcolor='white';
			$anchore_title="کليک کنيد تا غيرفعال شود";
			$anchor_do="deactivatelik";
		}
		else {
			$bgcolor='#fdf5f5';
			$anchore_title="کليک کنيد تا فعال شود";
			$anchor_do="activatelik";
		}
		echo '
		<tr bgcolor="#f0f0f0" height=1><td colspan=9></td></tr>
		<tr bgcolor="white" height=2><td colspan=9></td></tr>
		<tr bgcolor="'.$bgcolor.'" >
			<td width=15></td>
			<td class=tx1>'.($i+1).'. &nbsp;<b>'.$rec_i[$i]["_title"].(__sublink?' (<a href="./?page=admin&cp=linkbar_management&parent='.$rec_i[$i]["_id"].'" style="color:blue;">زیرپیوند</a>)':'').'</b></td>
			<td class=tx1><i>'.$rec_i[$i]["_url"].'</i></td>
			<td>
				<a href="?page=admin&cp='.$_REQUEST['cp'].'&do='.$anchor_do.'&_id='.$rec_i[$i]["_id"].'">
				<img id="'.rand(1000000,9999999).'" onmouseover="HighLight(id,1)" onmouseout="HighLight(id,0)" src="image.list/linkbar-button_'.$rec_i[$i]["_status"].'.png" border=0 title="'.$anchore_title.'"></a>
			</td>
		';
		if($i!=0)echo '
			<td>
				<a href="?page=admin&cp='.$_REQUEST['cp'].'&do=moveuplink&_id='.$rec_i[$i]["_id"].'">
				<img id="'.rand(1000000,9999999).'" onmouseover="HighLight(id,1)" onmouseout="HighLight(id,0)" src="image.list/linkbar-go-up.png" border=0 title="انتقال به بالا"></a>
			</td>
		'; else echo '<td><img id="'.rand(1000000,9999999).'" onload="COLORATE(id,0)" src="image.list/linkbar-go-up.png" border=0 title="انتقال به بالا"></td>';
		if($i+1!=sizeof($rec_i))echo '
			<td>
				<a id="'.rand(1000000,9999999).'" onmouseover="HighLight(id,1)" onmouseout="HighLight(id,0)"  href="?page=admin&cp='.$_REQUEST['cp'].'&do=movedownlink&_id='.$rec_i[$i]["_id"].'">
				<img id="'.rand(1000000,9999999).'" onmouseover="HighLight(id,1)" onmouseout="HighLight(id,0)" src="image.list/linkbar-go-down.png" border=0 title="انتقال به پايين"></a>
			</td>';
		else echo '<td><img id="'.rand(1000000,9999999).'" onload="COLORATE(id,0)" src="image.list/linkbar-go-down.png" border=0 title="انتقال به پايين"></td>';
		echo '	<td>
				<a href="javascript:if(confirm(\'آيا مايل به حذف اين پيوند ميباشيد؟\'))location.href=\'?page=admin&cp='.$_REQUEST['cp'].'&do=deletelink&_id='.$rec_i[$i]["_id"].'\'">
				<img id="'.rand(1000000,9999999).'" onmouseover="HighLight(id,1)" onmouseout="HighLight(id,0)" src="image.list/linkbar-delete_2.gif" border=0 title="حــذف"></a>
			</td>
			<td>
				<a href="?page=admin&cp='.$_REQUEST['cp'].'&do=editlink&_id='.$rec_i[$i]["_id"].'">
				<img id="'.rand(1000000,9999999).'" onmouseover="HighLight(id,1)" onmouseout="HighLight(id,0)" src="image.list/linkbar-edit.png" border=0 title="ويرايش"></a>
			</td>
			<td width=15></td>
		</tr>';
	}
	?>
	<tr height="15"><td colspan="9"></td></tr>
	<tr bgcolor="#f0f0f0" height=1><td colspan=9></td></tr>
	<tr height=1><td colspan=9></td></tr>
	<tr bgcolor="#f0f0f0" height=1><td colspan=9></td></tr>
	<tr height="3"><td colspan="9"></td></tr>
	<tr height=1 class="CP_LINKS_TR"  >
		<td></td>
		<td colspan=8>
		<b>افزايش پيوند جديد</b> (در صفحه اصلي) :</td></tr>
	<tr height="5"><td colspan="9"></td></tr>
	<form method="post" action="">
	<input type="hidden" name="page" value="admin">
	<input type="hidden" name="cp" value="<?=$_REQUEST['cp']?>">
	<input type="hidden" name="do" value="save_addlink">
	<input type="hidden" name="_type" value="index">
	<input type="hidden" name="parent" value="<?=$_REQUEST['parent']?>">
	<tr class="CP_LINKS_TR" >
		<td></td>
		<td>&nbsp;&nbsp;&nbsp;عنوان پيوند جديد : <input class="tx1" type="text" name="_title"></td>
		<td>آدرس پيوند جديد : <input class="tx1" dir="ltr" type="text" name="_url"></td>
		<td colspan="5"><input class="submit1" type="submit" value="ايجاد پيوند"></td>
	<td></td></tr>
	</form>
	<tr height="3"><td colspan="9"></td></tr>
	<tr style="color:#ececec" height=1><td colspan=9></td></tr>
	<tr height="6"><td colspan="9"></td></tr>
	<tr bgcolor="#f0f0f0" height=1><td colspan=9></td></tr>
	<tr height=1><td colspan=9></td></tr>
	<tr bgcolor="#f0f0f0" height=1><td colspan=9></td></tr>
	</table>
	</td></tr>
	</table>
	<br>
	</fieldset>
	<?
	if(__userPanelLink===true){
	echo '<br><hr  style="height:1px; color:#dbdbdb"><br>';
	if(!$res_u = db_query(" select * from `_links` where `_type`='user' order by `_priority`  ")){
		echo cadr ("er_57");
		return false;
	}
	$num=mysql_num_rows($res_u);
	for($i=0; $i<$num; $i++){
		$rec_u[$i]=mysql_fetch_array($res_u);
	}
	?>
	<fieldset dir="rtl" style="width:100% ">
	<legend align="right">پيوندهاي محیط کاربری</legend>
	<br>
	<table width="95%" dir="ltr" cellpadding="0" cellspacing="0">
	<tr height="34px" >
	<td width="34px"><img src="image.list/tab_left.png" width="34"  height="34"></td>
	<td width="250" background="image.list/tab_bg.png" align=center ><img src="s" width=250 height="1"></td>
	<td width="50%" background="image.list/tab_bg.png" align=center >آدرس</td>
	<td width="50%" background="image.list/tab_bg.png" align=center >عنوان</td>
	<td width="34px"><img src="image.list/tab_right.png" width="34"  height="34"></td>
	</tr>
	</table>
	<table align="center" width="95%" height="100%" cellpadding="0" cellspacing="1" border="0" bgcolor="#f0f0f0"><tr><td>
	<table width="100%" height="100%" cellpadding="0" cellspacing="0" border="0" bgcolor="white">
	<tr height="10"><td colspan="9"></td></tr>
	<?
	for($i=0; $i<sizeof($rec_u); $i++){
		if($rec_u[$i]['_status']){
			$bgcolor='white';
			$anchore_title="کليک کنيد تا غيرفعال شود";
			$anchor_do="deactivatelik";
		}
		else {
			$bgcolor='#fdf5f5';
			$anchore_title="کليک کنيد تا فعال شود";
			$anchor_do="activatelik";
		}
		echo '
		<tr bgcolor="#f0f0f0" height=1><td colspan=9></td></tr>
		<tr bgcolor="white" height=2><td colspan=9></td></tr>
		<tr bgcolor="'.$bgcolor.'" >
			<td width=15></td>
			<td class=tx1>'.($i+1).'. &nbsp;<b>'.$rec_u[$i]["_title"].'</b></td>
			<td class=tx1><i>'.$rec_u[$i]["_url"].'</i></td>
			<td>
				<a href="?page=admin&cp='.$_REQUEST['cp'].'&do='.$anchor_do.'&_id='.$rec_u[$i]["_id"].'">
				<img id="'.rand(1000000,9999999).'" onmouseover="HighLight(id,1)" onmouseout="HighLight(id,0)" src="image.list/linkbar-button_'.$rec_u[$i]["_status"].'.png" border=0 title="'.$anchore_title.'"></a>
			</td>';
		if($i!=0)echo '
			<td>
				<a href="?page=admin&cp='.$_REQUEST['cp'].'&do=moveuplink&_id='.$rec_u[$i]["_id"].'">
				<img id="'.rand(1000000,9999999).'" onmouseover="HighLight(id,1)" onmouseout="HighLight(id,0)" src="image.list/linkbar-go-up.png" border=0 title="انتقال به بالا"></a>
			</td>
		'; else echo '<td><img id="'.rand(1000000,9999999).'" onload="COLORATE(id,0)" src="image.list/linkbar-go-up.png" border=0 title="انتقال به بالا"></td>';
		if($i+1!=sizeof($rec_u))echo '
			<td>
				<a id="'.rand(1000000,9999999).'" onmouseover="HighLight(id,1)" onmouseout="HighLight(id,0)"  href="?page=admin&cp='.$_REQUEST['cp'].'&do=movedownlink&_id='.$rec_u[$i]["_id"].'">
				<img id="'.rand(1000000,9999999).'" onmouseover="HighLight(id,1)" onmouseout="HighLight(id,0)" src="image.list/linkbar-go-down.png" border=0 title="انتقال به پايين"></a>
			</td>';
		else echo '<td><img id="'.rand(1000000,9999999).'" onload="COLORATE(id,0)" src="image.list/linkbar-go-down.png" border=0 title="انتقال به پايين"></td>';
		echo '	<td>
				<a href="javascript:if(confirm(\'آيا مايل به حذف اين پيوند ميباشيد؟\'))location.href=\'?page=admin&cp='.$_REQUEST['cp'].'&do=deletelink&_id='.$rec_u[$i]["_id"].'\'">
				<img id="'.rand(1000000,9999999).'" onmouseover="HighLight(id,1)" onmouseout="HighLight(id,0)" src="image.list/linkbar-delete_2.gif" border=0 title="حــذف"></a>
			</td>
			<td>
				<a href="?page=admin&cp='.$_REQUEST['cp'].'&do=editlink&_id='.$rec_u[$i]["_id"].'">
				<img id="'.rand(1000000,9999999).'" onmouseover="HighLight(id,1)" onmouseout="HighLight(id,0)" src="image.list/linkbar-edit.png" border=0 title="ويرايش"></a>
			</td>
			<td width=15></td>
		</tr>';
	}
	?>
	<tr height="15"><td colspan="9"></td></tr>
	<tr bgcolor="#f0f0f0" height=1><td colspan=9></td></tr>
	<tr height=1><td colspan=9></td></tr>
	<tr bgcolor="#f0f0f0" height=1><td colspan=9></td></tr>
	<tr height="3"><td colspan="9"></td></tr>
	<tr height=1 class="CP_LINKS_TR"  >
		<td></td>
		<td colspan=8>
		<b>افزايش پيوند جديد</b> (در محیط کاربری) :</td></tr>
	<tr height="5"><td colspan="9"></td></tr>
	<form method="post" action="">
	<input type="hidden" name="page" value="admin">
	<input type="hidden" name="cp" value="<?=$_REQUEST['cp']?>">
	<input type="hidden" name="do" value="save_addlink">
	<input type="hidden" name="_type" value="user">
	<tr class="CP_LINKS_TR" >
		<td></td>
		<td>&nbsp;&nbsp;&nbsp;عنوان پيوند جديد : <input class="tx1" type="text" name="_title"></td>
		<td>آدرس پيوند جديد : <input class="tx1" type="text" dir="ltr" name="_url"></td>
		<td colspan="5"><input class="submit1" type="submit" value="ايجاد پيوند"></td>
	<td></td></tr>
	</form>
	<tr height="3"><td colspan="9"></td></tr>
	<tr style="color:#ececec" height=1><td colspan=9></td></tr>
	<tr height="6"><td colspan="9"></td></tr>
	<tr bgcolor="#f0f0f0" height=1><td colspan=9></td></tr>
	<tr height=1><td colspan=9></td></tr>
	<tr bgcolor="#f0f0f0" height=1><td colspan=9></td></tr>
	</table>
	</td></tr>
	</table>
	<br>
	</fieldset>
	<?
	}
	?>
	<tr height="6"><td colspan="9"></td></tr>
	<tr bgcolor="#f0f0f0" height=1><td colspan=9></td></tr>
	<tr height=1><td colspan=9></td></tr>
	<tr bgcolor="#f0f0f0" height=1><td colspan=9></td></tr>
	</table>
	</fieldset>
	<br><br>
	<?
}

function linkbar_set_priority($type){
	$res = db_query(" select `_id` from `_links` where `_type`='$type' order by `_priority`,`_id` ");
	$num = mysql_num_rows($res);
	for($i=0; $i<$num; $i++){
		$rec = mysql_fetch_array($res);
		db_query(" update `_links` set `_priority`='".($i+1)."' where `_id`='".$rec['_id']."' limit 1 ");
	}
}

function editlink_panel($linkId){
	if(!$res=db_query(" select * from `_links` where `_id`='$linkId' limit 1 ")){
		echo cadr("err356");
		return false;
	}
	$rec=mysql_fetch_array($res);
	?>
	<center>
	<fieldset style="width:100%;" dir="rtl">
	<legend align="right">ويرايش پيوند</legend>
	<table align="center" width="95%" height="100%" cellpadding="0" cellspacing="0" border="0">
	<tr><td colspan="3">
		<table width="100%" height="100%" cellpadding="0" cellspacing="0" border="0">
		<form method="post" action="">
			<tr height=25><td colspan=3></td></tr>
			<tr bgcolor="#f0f0f0" height=1><td colspan=3></td></tr>
			<tr height=1><td colspan=3></td></tr>
			<tr bgcolor="#f0f0f0" height=1><td colspan=3></td></tr>
			<tr height="3"><td colspan="3"></td></tr>
			<input type="hidden" name="page" value="admin">
			<input type="hidden" name="cp" value="<?=$_REQUEST['cp']?>">
			<input type="hidden" name="do" value="save_editlink">
			<input type="hidden" name="_id" value="<?=$linkId?>">
			<tr>
				<td>عنوان پيوند : <input class="tx1" type="text" name="_title" value="<?=$rec['_title'] ?>"></td>
				<td>آدرس پيوند : <input class="tx1" type="text" dir="ltr" name="_url" value="<?=$rec['_url'] ?>"></td>
				<td align="right"><input class="submit1"  type="submit" value="ثبت تغييرات"></td>
			</tr>
			<tr height="3"><td colspan="3"></td></tr>
			<tr bgcolor="#f0f0f0" height=1><td colspan=3></td></tr>
			<tr height=1><td colspan=3></td></tr>
			<tr bgcolor="#f0f0f0" height=1><td colspan=3></td></tr>
			<tr height=25><td colspan=3></td></tr>
		</form>
		</table>
	</td></tr>
	</table>
	</fieldset>
	</center>
	<?
	return true;
}








