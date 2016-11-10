<?
$GLOBALS['cmp']['pages_management'] = 'مديريت صفحات';



##________________________________________________________________________________________________________
function pages_management(){
	
	//$_REQUEST['_data'] = addslashes($_REQUEST['_data']);
	
	switch($_REQUEST['do']){
	
		case 'addpage' :
			if(!$_REQUEST['_title']){
				echo cadr('invalid title');
				break;
			}
			if(!$res = db_query(" select `_page` from `_pages` order by `_page` desc limit 1 ")){
				echo cadr('err17');
				break;
			} elseif(mysql_num_rows($res)==0) {
				$newpage_id = 1;
			} else {
				$newpage_id = intval(mysql_result($res,0,0))+1;
				if(!db_query(" insert into `_pages` (`_page`,`_title`) values ('$newpage_id','".$_REQUEST['_title']."') ")){
					echo cadr("err24, query: <i> insert into `_pages` (`_page`,`_title`) values ('$newpage_id','".$_REQUEST['_title']."') </i>");
					break;
				} elseif(!$res=db_query(" insert into `_page_layers` 
				(_id,_page,_priority,_func,_type,_title,_data,_framed,_status) values 
				('','$newpage_id','1','post','HTML','بدون عنوان', '<br><br><center class=tx1>اين صفحه در حال طراحي ميباشد</center><br><br>','1','1' ) ")){
					echo cadr('err29');
					break;
				}
			}
			break;
	
		case 'renamepage' :
			if(!$res=db_query(" update `_pages` set `_title`='".$_REQUEST['_title']."' where `_page`='".$_REQUEST['_page']."' limit 1 ")){
				echo cadr("error35", "ERR");
			}
			break;
		
		case 'removepage' :
			$page = $_REQUEST['_page'];
			if(in_array($page,array('index1','register1'))){
				echo alert("you are not allowed to remove this page!");
				break;
			} else {
				if(!$res = db_query(" delete from `_page_layers` where `_page`='".$_REQUEST['_page']."' ")){
					echo cadr("error38","ERR");
				} 
				elseif(!$res = db_query(" delete from `_pages` where `_page`='".$_REQUEST['_page']."' ")){
					echo cadr("error41","ERR");
				}
			}
			break;
		
		case 'addlayer' :
			?>
			<fieldset style="width:100%;" dir="rtl">
			<legend class="CP_LAYOUT_TITLE">ايجاد بلاک جديد</legend>
			<form action="" method="post" onsubmit="if(form57._func.value==''){alert('نوع لايه مشخص نيست');return false;}" name="form57">
			<input type="hidden" name="page" value="admin" >
			<input type="hidden" name="cp" value="<?=$_REQUEST['cp']?>" >
			<input type="hidden" name="do" value="save_addlayer" >
			<input type="hidden" name="_page" value="<?=$_REQUEST['_page']?>" >
			<table>
				<tr>
					<td>نوع لايه : </td>
					<td>
					<select name="_func" class="tx1">
						<option value="">[انتخاب نشده]</option>
						<?
						for($ib=0; $ib<sizeof($GLOBALS['objects']); $ib++){
							echo '<option value="'.$GLOBALS['objects'][$ib]['name'].'">'.$GLOBALS['objects'][$ib]['title'].'</option>';
						}
						?>
					</select>
					</td>
				</tr>
				<tr>
					<td>عنوان لايه : </td>
					<td><input type="text" class="tx1" name="_title" value="" ></td>
				</tr>
				<tr><td colspan="2" height="10"></td></tr>
				<tr><td colspan="2" align="center"><input type="submit" class="submit_button submit1" value="ايجاد لايه" ></td></tr>
			</table>
			</form>
			<?
			return true;
			//return addlayer_panel();
		
		case 'save_addlayer' :
			if(!$_REQUEST['_func']){
				echo cadr("no layer-type selected");
				break;
			}
			if(!$res = db_query(" select `_priority` from `_page_layers` where `_page`='".$_REQUEST['_page']."' order by `_priority` desc limit 1 ")){
				echo cadr("er96");
				return false;
			} else if(mysql_num_rows($res)==1){
				$new_priority = intval(mysql_result($res,0,0))+1;
			} else {
				$new_priority = 1;
			}
			if(!$res = db_query(" insert into `_page_layers`
			(`_id`,`_page`,`_priority`,`_func`,`_type`,`_title`,`_data`,`_framed`,`_status`) values
			('','".$_REQUEST['_page']."','$new_priority','".$_REQUEST['_func']."','HTML', '".$_REQUEST['_title']."', '', 1, 1 ) ")){
				echo cadr ("er107");
			} else {
				;//echo cadr("block created successfuly","INF");
			}
			echo '<META http-equiv=Refresh Content="0; Url=?page=admin&cp='.$_REQUEST['cp'].'&do=editlayer&_id='.mysql_insert_id().'">';
			die();

		case 'changelayertype' :
			if(!$_REQUEST['_func']){
				echo cadr("no layer-type selected");
				break;
			}
			if(!$res = db_query(" update `_page_layers` set
			`_func`='".$_REQUEST['_func']."'
			,`_type`=''
			,`_data`=''
			,`_framed`=1
			where `_id`='".$_REQUEST['_id']."' ")){
				echo cadr ("er.fpm125");
			} else {
				;//echo cadr("block created successfuly","INF");
			}
			echo '<META http-equiv=Refresh Content="0; Url=?page=admin&cp='.$_REQUEST['cp'].'&do=editlayer&_id='.$_REQUEST['_id'].'">';
			die();
			break;
			
		
		case 'editlayer' :
			return editlayer_panel($_REQUEST['_id']);
			break;
		case 'save_editlayer' :
			if(!$res = db_query(" update `_page_layers` set 
				`_title`='".mysql_real_escape_string($_REQUEST['_title'])."'
				,`_data`='".mysql_real_escape_string($_REQUEST['_data'])."'
				,`_type`='".$_REQUEST['_type']."'
				,`_framed`='".intval($_REQUEST['_framed'])."'
			 where 1 and `_id`='".$_REQUEST['_id']."' limit 1 ")){
				echo cadr ("err - func.pages_management - ".__LINE__);
				echo mysql_error();
			} else {
				echo cadr("layer edited successfuly","INF");
			}
			break;
			
		case 'movedownlayer' :
			$res = db_query(" select * from `_page_layers` where `_id`='".$_REQUEST['_id']."' limit 1 ");
			$rec = mysql_fetch_array($res);
			pages_set_priority($rec['_page']);
			if(!$res=db_query(" select * from `_page_layers` where `_page`='".$rec['_page']."' and `_priority`>='".$rec['_priority']."' order by `_priority` asc limit 2 ")){
				echo cadr("er72");
				break;
			} elseif (mysql_num_rows($res)!=2){
				echo cadr("er75");
				break;
			} else {
				$rec_1 = mysql_fetch_array($res);
				$rec_2 = mysql_fetch_array($res);
				db_query(" update `_page_layers` set `_priority`='".$rec_1['_priority']."' where `_id`='".$rec_2['_id']."' limit 1 ");
				db_query(" update `_page_layers` set `_priority`='".$rec_2['_priority']."' where `_id`='".$rec_1['_id']."' limit 1 ");
			}
			break;
		
		case 'moveuplayer' :
			$res = db_query(" select * from `_page_layers` where `_id`='".$_REQUEST['_id']."' limit 1 ");
			$rec = mysql_fetch_array($res);
			pages_set_priority($rec['_page']);
			if(!$res=db_query(" select * from `_page_layers` where `_page`='".$rec['_page']."' and `_priority`<='".$rec['_priority']."' order by `_priority` desc limit 2 ")){
				echo cadr("er72");
				break;
			} elseif (mysql_num_rows($res)!=2){
				echo cadr("er75");
				break;
			} else {
				$rec_1 = mysql_fetch_array($res);
				$rec_2 = mysql_fetch_array($res);
				db_query(" update `_page_layers` set `_priority`='".$rec_1['_priority']."' where `_id`='".$rec_2['_id']."' limit 1 ");
				db_query(" update `_page_layers` set `_priority`='".$rec_2['_priority']."' where `_id`='".$rec_1['_id']."' limit 1 ");
			}
			break;
		
		case 'removelayer' :
			db_query(" delete from `_page_layers` where `_id`='".$_REQUEST['_id']."' limit 1 ");
			break;
		
		case 'deactivatelayer' :
			db_query(" update `_page_layers` set `_status`=0 where `_id`='".$_REQUEST['_id']."' limit 1 ");
			break;
		
		case 'activatelayer' :
			db_query(" update `_page_layers` set `_status`=1 where `_id`='".$_REQUEST['_id']."' limit 1 ");
			break;
			
		
		DEFAULT : 
			break;
	}
	
	$res = db_query(" select * from `_pages` where 1 order by `_page` ");
	if(mysql_num_rows($res)>0){
		$num=mysql_num_rows($res);
		for($i=0; $i<$num; $i++){
			$pg_index[$i] = mysql_fetch_array($res);
		}
	} else {
		echo cadr("<center class=tx1 >no page created</center>","ERR");
	}
	
	
?>
<br>
<table dir="rtl" cellpadding="0" cellspacing="0" border=0 width="100%">
	
	<tr height="34px"><td colspan=5 align="right" >
		
	
		<table dir="rtl" height="34px" width="100%" cellpadding="0" cellspacing="0" border="0">
			<tr height="34px">
				<td width="34px"><img src="templates/<?=_THEME?>/admin/tab_right.png" width="34"  height="34"></td>
				
				<td background="templates/<?=_THEME?>/admin/tab_bg.png" width="100%" >
					<table width="100%" cellpadding="0" cellspacing="0" border="0"><tr>
						<td  align="center" style="font-size:15px; font-weight:bold; color:#868686; cursor:default;">
							مديريت صفحات
						</td>
					</tr></table>
				</td>
				<td width="34px"><img src="templates/<?=_THEME?>/admin/tab_left.png" width="34"  height="34"></td>
			</tr>
		</table>
		
		
	</td></tr>

	<?

	for($i=0; $i<sizeof($pg_index); $i++){
		echo "
		<tr>
			<td > </td>
			<td > </td>
			<td > </td>
			<td > </td>
			<td > </td>
		</tr>
		<tr bgcolor='#d1d1d1'><td colspan=5 > </td></tr>
		<tr bgcolor='white'><td colspan=5 > </td></tr>
		<tr bgcolor='#f8f8f8' >
			<td width=30 ></td>
			<td width='150'><a title='نمايش' target='_blank' href='?page=".$pg_index[$i]['_page']."'>".($i+1).". <b> ".$pg_index[$i]['_title']."</b></a></td>
			
			<form method=post>
			<td width='200'>
				<input type=hidden name='page' value='".$_REQUEST['page']."' />
				<input type=hidden name='cp' value='".$_REQUEST['cp']."' />
				<input type=hidden name='do' value='renamepage' />
				<input type=hidden name='_page' value='".$pg_index[$i]['_page']."' />
				<input type=text style='width:120px;' name='_title' value='".$pg_index[$i]['_title']."' class=tx1>
				<input type=submit value='تغيير نام' class='submit1 submit_button' style='padding: 9px 10px !important'>
			</td>
			</form>
			
			<td align=center>
			<span class=tx1 style='cursor:default;' >بلاک ها:</span>
			";
			if(!$res = db_query(" select * from `_page_layers` where 1 and `_page`='".$pg_index[$i]['_page']."' order by `_priority` ")){
				echo cadr('err132');
				break;
			} else {
				$numrows=mysql_num_rows($res);
				echo "
				<table cellspacing=0 cellpadding=0>
				<tr height=5><td colspan=2></td></tr>
				<tr>
				<td width=10></td>
				<td>
				<table bgcolor='#bdbdbd' cellpadding=1 cellspacing=1 width=300 >";
				$prompt_for_status[0] = "کليک کنيد تا فعال شود";
				$prompt_for_status[1] = "کليک کنيد تا غير فعال شود";
				$key_for_status[0]="activatelayer";
				$key_for_status[1]="deactivatelayer";
				if($numrows==0){
					echo "<tr bgcolor='#efefef'><td class=tx1 style='color:#c18f8f;cursor:default;'>&nbsp;&nbsp;&nbsp;بدون محتوا</td></tr>";
				} else {
					for($j=0; $j<$numrows; $j++){
						$rec = mysql_fetch_array($res);
						echo "<tr bgcolor='".($rec['_status']==1?"#efefef":"#efe4e4")."'><td class=tx1 style='color:#c18f8f'>
						<table width='100%' cellpadding=0 cellspacing=0>
						<tr height=1 bgcolor=white><td colspan=3></td></tr>
						<tr>
						<td width=10></td>
						<td class=tx1 style='cursor:default;'>".$rec['_title']."</td>
						<td align=left>
							<a href='?page=".$_REQUEST['page']."&cp=".$_REQUEST['cp']."&_page=".$rec['_page']."&do=editlayer&_id=".$rec['_id']."'><img id=".rand(10000000,99999999)." onmouseover='HighLight(id,1)' onmouseout='HighLight(id,0)' src='templates/"._THEME."/admin/edit.gif' width=16 height=16 title='ويرايش' border=0 /></a>
						";
						if($numrows!=$j+1){
							echo "<a href='?page=".$_REQUEST['page']."&cp=".$_REQUEST['cp']."&_page=".$rec['_page']."&do=movedownlayer&_id=".$rec['_id']."'><img id=".rand(10000000,99999999)." onmouseover='HighLight(id,1)' onmouseout='HighLight(id,0)' src='templates/"._THEME."/admin/go-down.png' title='انتقال به پايين' border=0 /></a>";
						} else {
							echo "<a><img id=".rand(10000000,99999999)." onload='COLORATE(id,0)' src='templates/"._THEME."/admin/go-down.png' title='انتقال به پايين' border=0 /></a>";
						}
						if($j!=0){
							echo "<a href='?page=".$_REQUEST['page']."&cp=".$_REQUEST['cp']."&_page=".$rec['_page']."&do=moveuplayer&_id=".$rec['_id']."'><img id=".rand(10000000,99999999)." onmouseover='HighLight(id,1)' onmouseout='HighLight(id,0)' src='templates/"._THEME."/admin/go-up.png' title='انتقال به بالا' border=0 /></a>";
						} else {
							echo "<a><img id=".rand(10000000,99999999)." onload='COLORATE(id,0)' src='templates/"._THEME."/admin/go-up.png' title='انتقال به بالا' border=0 /></a>";
						}
						
						echo "
							<a href='javascript:if(confirm(\"آيا مايل به حذف اين لايه ميباشيد؟\"))location.href=\"?page=".$_REQUEST['page']."&cp=".$_REQUEST['cp']."&_page=".$rec['_page']."&do=removelayer&_id=".$rec['_id']."\"'><img id=".rand(10000000,99999999)." onmouseover='HighLight(id,1)' onmouseout='HighLight(id,0)' src='templates/"._THEME."/admin/delete_2.gif' title='حذف' border=0 width=16 height=16 /></a>
							<a href='?page=".$_REQUEST['page']."&cp=".$_REQUEST['cp']."&_page=".$rec['_page']."&do=".$key_for_status[$rec['_status']]."&_id=".$rec['_id']."'><img id=".rand(10000000,99999999)." onmouseover='HighLight(id,1)' onmouseout='HighLight(id,0)' src='templates/"._THEME."/admin/button_".$rec['_status'].".png' title='".$prompt_for_status[$rec['_status']]."' width=20 height=16 border=0 /></a>
						</td>
						</tr>
						<tr height=1 bgcolor=white><td colspan=3></td></tr>
						<tr height=1 bgcolor=#828282><td colspan=3></td></tr>
						</table>
						</td></tr>
						";
					}
				}
				echo "
				</table>
					
				</td></tr>
				<tr><td></td><td align=right>&nbsp;<a href='?page=".$_REQUEST['page']."&cp=".$_REQUEST['cp']."&_page=".$pg_index[$i]['_page']."&do=addlayer' title='براي ايجاد بلاک جديد، کليک کنيد' style='color:#3869b5; font-size:10px;'>ايجاد بلاک</a></td></tr>
				<tr height=5><td colspan=2></td></tr>
				</table>";
			}
			
			echo "
			</td>
			
			<td align=left width=100>
				<a href=\"javascript:if(confirm('Are you sure to delete this page?'))location.href='?page=".$_REQUEST['page']."&cp=".$_REQUEST['cp']."&do=removepage&_page=".$pg_index[$i]['_page']."'\">
				<img style='margin-left: 15px;' src='templates/"._THEME."/admin/delete5.png' width=32 height=32 border=0 title='Delete' id=".rand(10000000,99999999)." onload='COLORATE(id,0)' onmouseover='COLORATE(id,1)' onmouseout='COLORATE(id,0)'></a>
			</td>
			
		</tr>
		<tr height=10px ><td colspan=5 > </td></tr>
		";		
	}
	


	?>

	<tr height="34px"><td colspan=5 align="right" >
		
		<form method="get" action="" onsubmit="if(_title.value=='')return false; return confirm('ايا مايل به افزودن صفحه ميباشيد؟');">
		<input type="hidden" name="page" value="<?=$_REQUEST['page']?>">
		<input type="hidden" name="cp" value="<?=$_REQUEST['cp']?>">
		<input type="hidden" name="do" value="addpage">
	
		<table width="100%" cellpadding="0" cellspacing="0" border="0">
		<tr>
			<td align="right" class="tx1">
				<input placeholder="صفحه جدید" class="tx2" type="text" name="_title" style="background-color:#fff; width: 120px; margin-right: 180px;">
				<input type="submit"  value="ثبت صفحه" class="submit2 submit_button" style="font-size: 13px !important; padding: 9px 10px !important;"  >
			</td>
		</tr>
		</table>

		</form>

	</td></tr>


</table>
<br>



	
<?	
}




##________________________________________________________________________________________________________
function pages_set_priority($page){
	$res = db_query(" select `_id` from `_page_layers` where `_page`='$page' order by `_priority`,`_id` ");
	$num = mysql_num_rows($res);
	for($i=0; $i<$num; $i++){
		$rec = mysql_fetch_array($res);
		db_query(" update `_page_layers` set `_priority`='".($i+1)."' where `_id`='".$rec['_id']."' limit 1 ");
	}
}






##________________________________________________________________________________________________________
function addlayer_panel(){
	
	?>
	<form method="post" action="">
	<input type="hidden" name="page" value="admin" />
	<input type="hidden" name="cp" value="<?=$_REQUEST['cp']?>" />
	<input type="hidden" name="_page" value="<?=$_REQUEST['_page']?>" />
	<input type="hidden" name="do" value="save_addlayer" />

	<fieldset style="width:100%;" dir="rtl">
		<legend >ويرايش پست</legend>
		<center>
		<table width="80%" class="0" cellspacing="0">
			<tr height="20"><td colspan="2"></td></tr>
			<tr dir="rtl">
				<td>عنوان پست :</td>
				<td><input type="text" class="tx1" name="_title" style="width:150px;" value="" ></td>
			</tr>
			<tr height="10"><td colspan="2"></td></tr>
			<tr><td colspan="2">محتواي پست (text, html, php):</td></tr>
			<tr height="3"><td colspan="2"></td></tr>
			<tr>
				<td colspan="2">
					<textarea dir="ltr" name="_data" id="_data" class="tx1" style="width:100%; height:200px;" ></textarea>
				</td>
			</tr>
			<tr height="10"><td colspan="2"></td></tr>
			<tr height="1" bgcolor="#e3e0e0"><td colspan="2"></td></tr>
			<tr height="10"><td colspan="2"></td></tr>
			<tr><td colspan="2">فرمت پست : 
				<br><?=space(20,1)?><label><input type="radio" id="radio_dl_TEXT" name="_type" value="TEXT" onclick="tinyMCE_off('_data')" > Text</label>
				<br><?=space(20,1)?><label><input type="radio" id="radio_dl_HTML" name="_type" value="HTML" onclick="tinyMCE_on('_data')" > Html Code</label>
				<br><?=space(20,1)?><label><input type="radio" id="radio_dl_PHP5" name="_type" value="PHP5" onclick="tinyMCE_off('_data')" > PHP</label>
			</td></tr>
			<tr height="10"><td colspan="2"></td></tr>
			<tr height="1" bgcolor="#e3e0e0"><td colspan="2"></td></tr>
			<tr height="2"><td colspan="2"></td></tr>
			<tr>
				<td align="center">
					<input type="checkbox" name="_framed" checked value="1" >فريم اضافه شود
				</td>
				<td align="center">
					<input type="button" class="submit1" onclick="location.href='?page=admin&cp=<?=$_REQUEST['cp']?>'"  value="بازگشت" style="width:80px;">
					<input type="submit" class="submit1 submit_button" value="ثبت تغييرات" style="width:80px;">
				</td>
			</tr>
			<tr height="2"><td colspan="2"></td></tr>
			<tr height="1" bgcolor="#e3e0e0"><td colspan="2"></td></tr>
			<tr height="10"><td colspan="2"></td></tr>
		</table>
		</center>
	</fieldset>
	</form>
	<?
	return true;
}




##________________________________________________________________________________________________________
function editlayer_panel($layer_id){
	if(!$res = db_query(" select * from `_page_layers` where `_id`='$layer_id' limit 1 ")){
		echo cadr("er333");
		return false;
	} elseif(mysql_num_rows($res)!=1){
		echo cadr("er336-fpm");
		return false;
	} // else 

	$rec = mysql_fetch_array($res);
	
	?>
	<script src="http://tinymce.cachefly.net/4.0/tinymce.min.js"></script>
	<script src="http://parsunix.com/cdn/js/tinymce/tinymce-set+func.js"></script>
	
	<form method="post" action="">
	<input type="hidden" name="page" value="admin" />
	<input type="hidden" name="cp" value="<?=$_REQUEST['cp']?>" />
	<input type="hidden" name="_page" value="<?=$_REQUEST['_page']?>" />
	<input type="hidden" name="do" value="save_editlayer" />
	<input type="hidden" name="_id" value="<?=$layer_id?>" />
	<?

	switch($rec['_func']){
		case 'post' :
			?>
			<fieldset class="pages_management_editlayer_panel_post">
				<legend >ويرايش پست</legend>
				<center>
				<table width="80%" class="0" cellspacing="0">
					<tr height="20"><td colspan="2"></td></tr>
					<tr>
						<td width=140px >نوع بلاک : </td>
						<td>
						<select id="blocktype" onchange="if(confirm('بعد از انتخاب نوع جديد، تنضيمات فعلي اين بلاک از بين خواهد رفت، آيا مايل به ادامه ميباشيد؟')){location.href='?page=admin&cp=<?=$_REQUEST['cp']?>&do=changelayertype&_id=<?=$layer_id?>&_func='+value;}" name="_func" class="tx1">
							<?
							for($ib=0; $ib<sizeof($GLOBALS['objects']); $ib++){
								echo '<option value="'.$GLOBALS['objects'][$ib]['name'].'">'.$GLOBALS['objects'][$ib]['title'].'</option>';
							}
							?>
						</select><script> document.getElementById('blocktype').value="<?=$rec['_func']?>" </script>
						</td>
					</tr>
					<tr dir="rtl">
						<td>عنوان پست :</td>
						<td><input type="text" class="tx1" name="_title" value="<?=$rec['_title']?>" ></td>
					</tr>
					<tr height="10"><td colspan="2"></td></tr>
					<tr><td colspan="2">محتواي پست (text, html, php):</td></tr>
					<tr height="3"><td colspan="2"></td></tr>
					<tr>
						<td colspan="2">
							<textarea dir="ltr" name="_data" id="_data" class="tx1" ><?=str_replace("</TEXTAREA>","&lt;/TEXTAREA&gt;",str_replace("</textarea>","&lt;/textarea&gt;",$rec['_data']))?></textarea>
						</td>
					</tr>
					<tr height="10"><td colspan="2"></td></tr>
					<tr height="1" bgcolor="#e3e0e0"><td colspan="2"></td></tr>
					<tr height="10"><td colspan="2"></td></tr>
					<tr><td colspan="2">فرمت پست : 
						<br><label><input type="radio" id="radio_dl_TEXT" name="_type" value="TEXT" onclick="tinyMCE_off('_data')" > Text</label>
						<br><label><input type="radio" id="radio_dl_HTML" name="_type" value="HTML" onclick="tinyMCE_on('_data')" > Html Code</label>
						<br><label><input type="radio" id="radio_dl_PHP5" name="_type" value="PHP5" onclick="tinyMCE_off('_data')" > PHP</label>
					</td></tr>
					<script>
					$(function(){
						document.getElementById('radio_dl_<?=$rec['_type']?>').checked='checked';
						<?=($rec['_type']=='HTML'?"tinyMCE_on('_data');":"")?>
					})
					</script>
					<tr height="10"><td colspan="2"></td></tr>
					<tr height="1" bgcolor="#e3e0e0"><td colspan="2"></td></tr>
					<tr height="2"><td colspan="2"></td></tr>
					<tr>
						<td align="center">
							<input type="checkbox" name="_framed" <? if($rec['_framed'])echo "checked" ?> value="1" >فريم اضافه شود
						</td>
						<td align="center">
							<input type="button" class="submit1" onclick="location.href='?page=admin&cp=<?=$_REQUEST['cp']?>'"  value="بازگشت" style="width:80px;">
							<input type="submit" class="submit1 submit_button" value="ثبت تغييرات" style="width:80px;">
						</td>
					</tr>
					<tr height="2"><td colspan="2"></td></tr>
					<tr height="1" bgcolor="#e3e0e0"><td colspan="2"></td></tr>
					<tr height="10"><td colspan="2"></td></tr>
				</table>
				</center>
			</fieldset>
			<?
			break;
			
		//case 'indexbar' :
		//case 'user_menubar' :
		//case 'news_desk' :
		DEFAULT : 
			?>
			<input type="hidden" name="_framed" value="1">
			<fieldset style="width:100%;" dir="rtl">
				<legend >ويرايش منوي کاربر</legend>
				<center>
				<table width="80%" class="0" cellspacing="0">
					<tr height="20"><td colspan="2"></td></tr>
					<tr>
						<td>نوع لابه : </td>
						<td>
						<select id="blocktype" onchange="if(confirm('بعد از انتخاب نوع جديد، تنضيمات فعلي اين لابه از بين خواهد رفت، آيا مايل به ادامه ميباشيد؟')){location.href='?page=admin&cp=<?=$_REQUEST['cp']?>&do=changelayertype&_id=<?=$layer_id?>&_func='+value;}" name="_func" class="tx1">
							<?
							for($ib=0; $ib<sizeof($GLOBALS['objects']); $ib++){
								echo '<option value="'.$GLOBALS['objects'][$ib]['name'].'">'.$GLOBALS['objects'][$ib]['title'].'</option>';
							}
							?>
						</select><script> document.getElementById('blocktype').value="<?=$rec['_func']?>" </script>
						</td>
					</tr>
					<tr height="10"><td colspan="2"></td></tr>
					<tr dir="rtl">
						<td>عنوان لايه :</td>
						<td><input type="text" class="tx1" name="_title" style="width:150px;" value="<?=$rec['_title']?>" ></td>
					</tr>
					<tr height="10"><td colspan="2"></td></tr>
					<tr height="2"><td colspan="2"></td></tr>
					<tr height="1" bgcolor="#e3e0e0"><td colspan="2"></td></tr>
					<tr height="10"><td colspan="2"></td></tr>
					<tr height="3"><td colspan="2"></td></tr>
					<tr><td colspan="2" align="center">
						
						<table background="templates/<?=_THEME?>/admin/bg1.jpg" width="100%" ><tr><td>
						<table width="70%" align="center">
						<tr height="10"><td colspan="2"></td></tr>
						<tr>
							<td rowspan="2"><img src="templates/<?=_THEME?>/admin/info.png" ></td>
							<td>
							<span style="font-size:18px;">توجه!</span><br><br>
							براي ويرايش پيوندها به قسمت <a href="?page=admin&cp=" style="color:blue">مديريت پيوندها</a> ، و براي ويرايش بلاک هاي جانبي به قسمت <a href="?page=admin&cp=02" style="color:blue">مديريت بلاکها</a> مراجعه شود
							</td>
						</tr>
						<tr height="100%"><td></td></tr>
						<tr height="10"><td colspan="2"></td></tr>
						</table>
						</td></tr></table>
						
					</td></tr>
					<tr height="10"><td colspan="2"></td></tr>
					<tr height="1" bgcolor="#e3e0e0"><td colspan="2"></td></tr>
					<tr height="2"><td colspan="2"></td></tr>
					<tr>
						<td colspan="2" align="center">
							<input type="button" class="submit1" onclick="location.href='?page=admin&cp=<?=$_REQUEST['cp']?>'"  value="بازگشت" style="width:80px;">
							<input type="submit" class="submit1 submit_button" value="ثبت تغييرات" style="width:80px;">
						</td>
					</tr>
					<tr height="2"><td colspan="2"></td></tr>
					<tr height="1" bgcolor="#e3e0e0"><td colspan="2"></td></tr>
					<tr height="10"><td colspan="2"></td></tr>
				</table>
				</center>
			</fieldset>
			<?
			break;
	}
	?>
	</form>
	<?
	return true;
}







	
	
?>
