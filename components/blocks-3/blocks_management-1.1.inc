<?
$GLOBALS['cmp']['blocks_management'] = 'مديريت بلوک ها';

function blocks_management(){
	
	//$_REQUEST['_data'] = addslashes($_REQUEST['_data']);
	
	switch($_REQUEST['do']){
			
		case 'addframe' :
			?>
			<fieldset>
			<legend class="CP_LAYOUT_TITLE">ايجاد بلاک جديد</legend>
			<form action="" method="post" onsubmit="if(form1._func.value==''){alert('نوع بلاک مشخص نيست');return false;}" name="form1">
			<input type="hidden" name="page" value="admin" >
			<input type="hidden" name="cp" value="<?=$_REQUEST['cp']?>" >
			<input type="hidden" name="do" value="save_addframe" >
			<input type="hidden" name="_position" value="<?=$_REQUEST['_position']?>" >
			<table>
				<tr>
					<td>نوع بلاک : </td>
					<td>
					<select name="_func" class="tx1">
						<option value="">[انتخاب نشده]</option>
						<?
						foreach($GLOBALS['block_layers'] as $func => $name){
							echo '<option value="'.$func.'">'.$name.'</option>';
						}
						?>
					</select>
					</td>
				</tr>
				<tr>
					<td>عنوان بلاک : </td>
					<td><input type="text" class="tx1" name="_title" value="" ></td>
				</tr>
				<tr><td colspan="2" height="10"></td></tr>
				<tr><td colspan="2" align="center"><input type="submit" class="submit1 submit_button" value="ايجاد بلاک" ></td></tr>
			</table>
			</form>
			<?
			return true;
			
		case 'save_addframe' :
			if(!$_REQUEST['_func']){
				echo cadr("no block-type selected");
				break;
			}
			if(!$res = db_query(" select `_priority` from `_page_frames` where `_position`='".$_REQUEST['_position']."' order by `_priority` desc limit 1 ")){
				echo cadr("er65");
				return false;
			} else if(mysql_num_rows($res)==1){
				$new_priority = intval(mysql_result($res,0,0))+1;
			} else {
				$new_priority = 1;
			}
			if(!$res = db_query(" insert into `_page_frames`
			(`_id`,`_position`,`_priority`,`_func`,`_type`,`_title`,`_data`,`_framed`,`_status`) values
			('','".$_REQUEST['_position']."','$new_priority','".$_REQUEST['_func']."','HTML', '".$_REQUEST['_title']."', '', 1, 1 ) ")){
				echo cadr ("er75");
			} else {
				;//echo cadr("block created successfuly","INF");
			}
			echo '<META http-equiv=Refresh Content="0; Url=?page=admin&cp='.$_REQUEST['cp'].'&do=editframe&_id='.mysql_insert_id().'">';
			die();
			break;
	
		case 'changeframetype' :
			if(!$_REQUEST['_func']){
				echo cadr("no block-type selected");
				break;
			}
			if(!$res = db_query(" update `_page_frames` set
			`_func`='".$_REQUEST['_func']."'
			,`_type`=''
			,`_data`=''
			,`_framed`=1
			where `_id`='".$_REQUEST['_id']."' ")){
				echo cadr ("er..79");
			} else {
				;//echo cadr("block created successfuly","INF");
			}
			echo '<META http-equiv=Refresh Content="0; Url=?page=admin&cp='.$_REQUEST['cp'].'&do=editframe&_id='.$_REQUEST['_id'].'">';
			die();
			break;

		
		case 'editframe' :
			return editframe_panel($_REQUEST['_id']);
			break;
		case 'save_editframe' :
			if(!$res = db_query(" update `_page_frames` set 
				`_title`='".$_REQUEST['_title']."'
				,`_data`='".$_REQUEST['_data']."'
				,`_type`='".$_REQUEST['_type']."'
				,`_func`='".$_REQUEST['_func']."'
				,`_framed`='".intval($_REQUEST['_framed'])."'
			 where 1 and `_id`='".$_REQUEST['_id']."' limit 1 ")){
				echo cadr ("err - func.blocks_management - ".__LINE__);
			} else {
				echo cadr("layer edited successfuly","INF");
			}
			break;
			
		case 'movedownframe' :
			$res = db_query(" select * from `_page_frames` where `_id`='".$_REQUEST['_id']."' limit 1 ");
			$rec = mysql_fetch_array($res);
			blocks_set_priority($rec['_position']);
			if(!$res=db_query(" select * from `_page_frames` where `_position`='".$rec['_position']."' and `_priority`>='".$rec['_priority']."' order by `_priority` asc limit 2 ")){
				echo cadr("er.58");
				break;
			} elseif (mysql_num_rows($res)!=2){
				echo cadr("er.61");
				break;
			} else {
				$rec_1 = mysql_fetch_array($res);
				$rec_2 = mysql_fetch_array($res);
				db_query(" update `_page_frames` set `_priority`='".$rec_1['_priority']."' where `_id`='".$rec_2['_id']."' limit 1 ");
				db_query(" update `_page_frames` set `_priority`='".$rec_2['_priority']."' where `_id`='".$rec_1['_id']."' limit 1 ");
			}
			break;
		
		case 'moveupframe' :
			$res = db_query(" select * from `_page_frames` where `_id`='".$_REQUEST['_id']."' limit 1 ");
			$rec = mysql_fetch_array($res);
			blocks_set_priority($rec['_position']);
			if(!$res=db_query(" select * from `_page_frames` where `_position`='".$rec['_position']."' and `_priority`<='".$rec['_priority']."' order by `_priority` desc limit 2 ")){
				echo cadr("er.76");
				break;
			} elseif (mysql_num_rows($res)!=2){
				echo cadr("er.79");
				break;
			} else {
				$rec_1 = mysql_fetch_array($res);
				$rec_2 = mysql_fetch_array($res);
				db_query(" update `_page_frames` set `_priority`='".$rec_1['_priority']."' where `_id`='".$rec_2['_id']."' limit 1 ");
				db_query(" update `_page_frames` set `_priority`='".$rec_2['_priority']."' where `_id`='".$rec_1['_id']."' limit 1 ");
			}
			break;
		
		case 'deleteframe' :
			db_query(" delete from `_page_frames` where `_id`='".$_REQUEST['_id']."' limit 1 ");
			break;
		
		
		
		case 'disactivateframe' :
			db_query(" update `_page_frames` set `_status`=0 where `_id`='".$_REQUEST['_id']."' limit 1 ");
			break;
		
		case 'activateframe' :
			db_query(" update `_page_frames` set `_status`=1 where `_id`='".$_REQUEST['_id']."' limit 1 ");
			break;
	
	}
		
		
	$position[]="top";
	$position[]="left";
	$position[]="right";
	$position[]="down";
	$layer_titlebgcolor[0]="#c6b9b9";
	$layer_titlebgcolor[1]="#cecece";
	$layer_bodybgcolor[0]="#e3d1d1";
	$layer_bodybgcolor[1]="#f4f4f4";
	
	for($i=0; $i<sizeof($position); $i++){
		if($res = db_query(" select * from `_page_frames` where 1 and `_position`='".$position[$i]."' order by `_priority`  ")){
			$num = mysql_num_rows($res);
			for($j=0; $j<$num; $j++){
				$rec[$position[$i]][$j] = mysql_fetch_array($res);
			}
		} else {
			echo cadr("er81");
		}
	}
	?>
	<table cellpadding="1" cellspacing="0" width="100%" class="blocks_management" >
		
		<!-- top s -->
		<tr><td colspan="3">
				<fieldset><? $pos="top" ?>
					<legend class="CP_LAYOUT_TITLE"><a href="?page=admin&cp=<?=$_REQUEST['cp']?>&do=addframe&_position=<?=$pos?>" style="font-size:11px;color:blue;">اضافه به بالا</a></legend>
					<?
					if(sizeof($rec[$pos])==0){
						echo "<center style='font-size:10px; color:#868686;'><i><br>no layers<br><br></i></center>";
					} else {
						for($i=0; $i<sizeof($rec[$pos]); $i++){
							$frame_id=$rec[$pos][$i]['_id'];
							if(!$frame_res = db_query(" select * from `_page_frames` where `_id`='$frame_id' limit 1 ")){
								echo cadr("invalid progress");
								return false;
							} 
							$frame_res = mysql_fetch_array($frame_res);
							$img_src = "image.list/block__".$frame_res['_func'].".gif";
							?>
							<table class="block-box" cellpadding="0" cellspacing="1"><tr><td>
							<table width="100%" cellpadding="0" cellspacing="0" bgcolor="<?=$layer_bodybgcolor[intval($frame_res['_status'])]?>">
								<tr bgcolor="<?=$layer_titlebgcolor[intval($frame_res['_status'])]?>" class="block-head">
									<td colspan="4">&nbsp;&nbsp;&nbsp;<b><?=$frame_res['_title']?></b></td>
									<td align="left">
										<? 
										if($rec[$pos][$i]['_status']==1){ ?>
										<a title='کليک کنيد تا غيرفعال شود' href="?page=admin&cp=<?=$_REQUEST['cp']?>&do=disactivateframe&_id=<?=$rec[$pos][$i]['_id']?>"><img src="image.list/blocks-button_1.png" border="0"></a>
										<? } else {?>
										<a title='کليک کنيد تا فعال شود' href="?page=admin&cp=<?=$_REQUEST['cp']?>&do=activateframe&_id=<?=$rec[$pos][$i]['_id']?>"><img src="image.list/blocks-button_0.png" border="0"></a>
										<? } ?>
									</td>
									<td></td>
								</tr>
								<tr bgcolor="#979797" height="1"><td colspan="6"></td></tr>
								<tr height="5"><td colspan="6"></td></tr>
								<tr>
									<td width="10"></td>
									<td width="50"><img src="<?=$img_src?>" ></td>
									<td width="10"></td>
									<td>
									<?
									$object_name = $GLOBALS['block_layers'][ $frame_res['_func'] ];
									echo "<span class='box-title' title='نوع بلاک'>".$object_name."</span><br>"?></td>
									<td align="left">
										<table cellpadding="2" cellspacing="1" width="1" height="1" bgcolor="#d2d2d2">
											<tr>
												<td bgcolor="white"><a title="ويرايش بلاک" href="?page=admin&cp=<?=$_REQUEST['cp']?>&do=editframe&_id=<?=$rec[$pos][$i]['_id']?>"><img id='<?=rand(1000000,9999999)?>' onmouseover='HighLight(id,1)' onmouseout='HighLight(id,0)' src="image.list/blocks-edit.png" border="0" ></a></td>
												<td bgcolor="white">
													<? if($i>0){ ?>
													<a title="انتقال به بالا" href="?page=admin&cp=<?=$_REQUEST['cp']?>&do=moveupframe&_id=<?=$rec[$pos][$i]['_id']?>"><img id='<?=rand(1000000,9999999)?>' onmouseover='HighLight(id,1)' onmouseout='HighLight(id,0)' src="image.list/blocks-go-up.png" border="0" ></a>
													<? } else { ?>
													<img id='<?=rand(1000000,9999999)?>' onload="COLORATE(id,0)" src="image.list/blocks-go-up.png" border="0" >
													<? } ?>
												</td>
											</tr>
											<tr>
												<td bgcolor="white"><a href="javascript:if(confirm('آيا مايل به حذف اين بلاک ميباشيد؟'))location.href='?page=admin&cp=<?=$_REQUEST['cp']?>&do=deleteframe&_id=<?=$rec[$pos][$i]['_id']?>'"><img id='<?=rand(1000000,9999999)?>' onmouseover='HighLight(id,1)' onmouseout='HighLight(id,0)' src="image.list/blocks-delete_2.png" border="0" ></a></td>
												<td bgcolor="white">
													<? if($i!=sizeof($rec[$pos])-1){ ?>
													<a title="انتقال به پايين" href="?page=admin&cp=<?=$_REQUEST['cp']?>&do=movedownframe&_id=<?=$rec[$pos][$i]['_id']?>"><img id='<?=rand(1000000,9999999)?>' onmouseover='HighLight(id,1)' onmouseout='HighLight(id,0)' src="image.list/blocks-go-down.png" border="0" ></a>
													<? } else { ?>
													<img id='<?=rand(1000000,9999999)?>' onload="COLORATE(id,0)" src="image.list/blocks-go-down.png" border="0" >
													<? } ?>
												</td>
											</tr>
										</table>
									</td>
									<td width="10"></td>
								</tr>
								<tr height="5"><td colspan="6"></td></tr>
							</table>
							</td></tr></table>
							<?
						}
					}
					?>
				</fieldset>
		</td></tr>
		<!-- top e -->
		
		<tr>
			
			<!-- left s -->
			<td width="230">
					<fieldset><? $pos="left" ?>
						<legend class="CP_LAYOUT_TITLE"><a href="?page=admin&cp=<?=$_REQUEST['cp']?>&do=addframe&_position=<?=$pos?>" style="font-size:11px;color:blue;">اضافه به چپ</a></legend>
						<?
						if(sizeof($rec[$pos])==0){
							echo "<center style='font-size:10px; color:#868686;'><i><br>no layers<br><br></i></center>";
						} else {
							for($i=0; $i<sizeof($rec[$pos]); $i++){
								$frame_id=$rec[$pos][$i]['_id'];
								if(!$frame_res = db_query(" select * from `_page_frames` where `_id`='$frame_id' limit 1 ")){
									echo cadr("invalid progress");
									return false;
								} 
								$frame_res = mysql_fetch_array($frame_res);
								$img_src = "image.list/block__".$frame_res['_func'].".gif";
								?>
								<table class="block-box" cellpadding="0" cellspacing="1"><tr><td>
								<table width="100%" cellpadding="0" cellspacing="0" bgcolor="<?=$layer_bodybgcolor[intval($frame_res['_status'])]?>">
									<tr bgcolor="<?=$layer_titlebgcolor[intval($frame_res['_status'])]?>" class="block-head">
										<td colspan="4">&nbsp;&nbsp;&nbsp;<b><?=$frame_res['_title']?></b></td>
										<td align="left">
											<? 
											if($rec[$pos][$i]['_status']==1){ ?>
											<a title='کليک کنيد تا غيرفعال شود' href="?page=admin&cp=<?=$_REQUEST['cp']?>&do=disactivateframe&_id=<?=$rec[$pos][$i]['_id']?>"><img src="image.list/blocks-button_1.png" border="0"></a>
											<? } else {?>
											<a title='کليک کنيد تا فعال شود' href="?page=admin&cp=<?=$_REQUEST['cp']?>&do=activateframe&_id=<?=$rec[$pos][$i]['_id']?>"><img src="image.list/blocks-button_0.png" border="0"></a>
											<? } ?>
										</td>
										<td></td>
									</tr>
									<tr bgcolor="#979797" height="1"><td colspan="6"></td></tr>
									<tr height="5"><td colspan="6"></td></tr>
									<tr>
										<td width="10"></td>
										<td width="50"><img src="<?=$img_src?>" ></td>
										<td width="10"></td>
										<td>
										<?
										$object_name = $GLOBALS['block_layers'][ $frame_res['_func'] ];
										echo "<span class='box-title' title='نوع بلاک'>".$object_name."</span><br>";
										?>
										</td>
										<td align="left">
											<table cellpadding="2" cellspacing="1" width="1" height="1" bgcolor="#d2d2d2">
												<tr>
													<td bgcolor="white"><a title="ويرايش بلاک" href="?page=admin&cp=<?=$_REQUEST['cp']?>&do=editframe&_id=<?=$rec[$pos][$i]['_id']?>"><img id='<?=rand(1000000,9999999)?>' onmouseover='HighLight(id,1)' onmouseout='HighLight(id,0)' src="image.list/blocks-edit.png" border="0" ></a></td>
													<td bgcolor="white">
														<? if($i>0){ ?>
														<a title="انتقال به بالا" href="?page=admin&cp=<?=$_REQUEST['cp']?>&do=moveupframe&_id=<?=$rec[$pos][$i]['_id']?>"><img id='<?=rand(1000000,9999999)?>' onmouseover='HighLight(id,1)' onmouseout='HighLight(id,0)' src="image.list/blocks-go-up.png" border="0" ></a>
														<? } else { ?>
														<img id='<?=rand(1000000,9999999)?>' onload="COLORATE(id,0)" src="image.list/blocks-go-up.png" border="0" >
														<? } ?>
													</td>
												</tr>
												<tr>
													<td bgcolor="white"><a href="javascript:if(confirm('آيا مايل به حذف اين بلاک ميباشيد؟'))location.href='?page=admin&cp=<?=$_REQUEST['cp']?>&do=deleteframe&_id=<?=$rec[$pos][$i]['_id']?>'"><img id='<?=rand(1000000,9999999)?>' onmouseover='HighLight(id,1)' onmouseout='HighLight(id,0)' src="image.list/blocks-delete_2.png" border="0" ></a></td>
													<td bgcolor="white">
														<? if($i!=sizeof($rec[$pos])-1){ ?>
														<a title="انتقال به پايين" href="?page=admin&cp=<?=$_REQUEST['cp']?>&do=movedownframe&_id=<?=$rec[$pos][$i]['_id']?>"><img id='<?=rand(1000000,9999999)?>' onmouseover='HighLight(id,1)' onmouseout='HighLight(id,0)' src="image.list/blocks-go-down.png" border="0" ></a>
														<? } else { ?>
														<img id='<?=rand(1000000,9999999)?>' onload="COLORATE(id,0)" src="image.list/blocks-go-down.png" border="0" >
														<? } ?>
													</td>
												</tr>
											</table>
										</td>
										<td width="10"></td>
									</tr>
									<tr height="5"><td colspan="6"></td></tr>
								</table>
								</td></tr></table>
								<?
							}
						}
						?>
					</fieldset>
			</td>
			<!-- left e -->

			
			<!-- center s -->
			<td>
				<fieldset><? $pos="center" ?>
					<legend class="CP_LAYOUT_TITLE">اضافه به وسط</legend>
						<table width="100%"><tr>
							<td width="30"></td>
							<td>
								<br><br>براي ويرايش محتويات وسط صفحه بايد به قسمت <a href="./?page=admin&cp=pages_management" style="color:blue">مديريت صفحات</a> مراجعه کنيد
								<br><br>
								<br>
							</td>
							<td width="30"></td>
						</tr>
						<tr><td colspan="3" height="10"></td></tr>
						</table>							
				</fieldset>
			</td>
			<!-- center e -->

			
			<!-- right s -->
			<td width="230">
					<fieldset><? $pos="right" ?>
						<legend class="CP_LAYOUT_TITLE"><a href="?page=admin&cp=<?=$_REQUEST['cp']?>&do=addframe&_position=<?=$pos?>" style="font-size:11px;color:blue;">اضافه به راست</a></legend>
						<?
						if(sizeof($rec[$pos])==0){
							echo "<center style='font-size:10px; color:#868686;'><i><br>no layers<br><br></i></center>";
						} else {
							for($i=0; $i<sizeof($rec[$pos]); $i++){
								$frame_id=$rec[$pos][$i]['_id'];
								if(!$frame_res = db_query(" select * from `_page_frames` where `_id`='$frame_id' limit 1 ")){
									echo cadr("invalid progress");
									return false;
								} 
								$frame_res = mysql_fetch_array($frame_res);
								$img_src = "image.list/block__".$frame_res['_func'].".gif";
								?>
								<table class="block-box" cellpadding="0" cellspacing="1"><tr><td>
								<table width="100%" cellpadding="0" cellspacing="0" bgcolor="<?=$layer_bodybgcolor[intval($frame_res['_status'])]?>">
									<tr bgcolor="<?=$layer_titlebgcolor[intval($frame_res['_status'])]?>" class="block-head">
										<td colspan="4">&nbsp;&nbsp;&nbsp;<b><?=$frame_res['_title']?></b></td>
										<td align="left">
											<? 
											if($rec[$pos][$i]['_status']==1){ ?>
											<a title='کليک کنيد تا غيرفعال شود' href="?page=admin&cp=<?=$_REQUEST['cp']?>&do=disactivateframe&_id=<?=$rec[$pos][$i]['_id']?>"><img src="image.list/blocks-button_1.png" border="0"></a>
											<? } else {?>
											<a title='کليک کنيد تا فعال شود' href="?page=admin&cp=<?=$_REQUEST['cp']?>&do=activateframe&_id=<?=$rec[$pos][$i]['_id']?>"><img src="image.list/blocks-button_0.png" border="0"></a>
											<? } ?>
										</td>
										<td></td>
									</tr>
									<tr bgcolor="#979797" height="1"><td colspan="6"></td></tr>
									<tr height="5"><td colspan="6"></td></tr>
									<tr>
										<td width="10"></td>
										<td width="50"><img src="<?=$img_src?>" ></td>
										<td width="10"></td>
										<td><?
										$object_name = $GLOBALS['block_layers'][ $frame_res['_func'] ];
										echo "<span class='box-title' title='نوع بلاک'>".$object_name."</span><br>";
										?>
										</td>
										<td align="left">
											<table cellpadding="2" cellspacing="1" width="1" height="1" bgcolor="#d2d2d2">
												<tr>
													<td bgcolor="white"><a title="ويرايش بلاک" href="?page=admin&cp=<?=$_REQUEST['cp']?>&do=editframe&_id=<?=$rec[$pos][$i]['_id']?>"><img id='<?=rand(1000000,9999999)?>' onmouseover='HighLight(id,1)' onmouseout='HighLight(id,0)' src="image.list/blocks-edit.png" border="0" ></a></td>
													<td bgcolor="white">
														<? if($i>0){ ?>
														<a title="انتقال به بالا" href="?page=admin&cp=<?=$_REQUEST['cp']?>&do=moveupframe&_id=<?=$rec[$pos][$i]['_id']?>"><img id='<?=rand(1000000,9999999)?>' onmouseover='HighLight(id,1)' onmouseout='HighLight(id,0)' src="image.list/blocks-go-up.png" border="0" ></a>
														<? } else { ?>
														<img id='<?=rand(1000000,9999999)?>' onload="COLORATE(id,0)" src="image.list/blocks-go-up.png" border="0" >
														<? } ?>
													</td>
												</tr>
												<tr>
													<td bgcolor="white"><a href="javascript:if(confirm('آيا مايل به حذف اين بلاک ميباشيد؟'))location.href='?page=admin&cp=<?=$_REQUEST['cp']?>&do=deleteframe&_id=<?=$rec[$pos][$i]['_id']?>'"><img id='<?=rand(1000000,9999999)?>' onmouseover='HighLight(id,1)' onmouseout='HighLight(id,0)' src="image.list/blocks-delete_2.png" border="0" ></a></td>
													<td bgcolor="white">
														<? if($i!=sizeof($rec[$pos])-1){ ?>
														<a title="انتقال به پايين" href="?page=admin&cp=<?=$_REQUEST['cp']?>&do=movedownframe&_id=<?=$rec[$pos][$i]['_id']?>"><img id='<?=rand(1000000,9999999)?>' onmouseover='HighLight(id,1)' onmouseout='HighLight(id,0)' src="image.list/blocks-go-down.png" border="0" ></a>
														<? } else { ?>
														<img id='<?=rand(1000000,9999999)?>' onload="COLORATE(id,0)" src="image.list/blocks-go-down.png" border="0" >
														<? } ?>
													</td>
												</tr>
											</table>
										</td>
										<td width="10"></td>
									</tr>
									<tr height="5"><td colspan="6"></td></tr>
								</table>
								</td></tr></table>
								<?
							}
						}
						?>
					</fieldset>
			</td>
			<!-- right e -->
		</tr>
		
		<!-- down s -->
		<tr><td colspan="3">
				<fieldset><? $pos="down" ?>
					<legend class="CP_LAYOUT_TITLE"><a href="?page=admin&cp=<?=$_REQUEST['cp']?>&do=addframe&_position=<?=$pos?>" style="font-size:11px;color:blue;">اضافه به پايين</a></legend>
					<?
					if(sizeof($rec[$pos])==0){
						echo "<center style='font-size:10px; color:#868686;'><i><br>no layers<br><br></i></center>";
					} else {
						for($i=0; $i<sizeof($rec[$pos]); $i++){
							$frame_id=$rec[$pos][$i]['_id'];
							if(!$frame_res = db_query(" select * from `_page_frames` where `_id`='$frame_id' limit 1 ")){
								echo cadr("invalid progress");
								return false;
							} 
							$frame_res = mysql_fetch_array($frame_res);
							$img_src = "image.list/block__".$frame_res['_func'].".gif";
							?>
							<table class="block-box" cellpadding="0" cellspacing="1"><tr><td>
							<table width="100%" cellpadding="0" cellspacing="0" bgcolor="<?=$layer_bodybgcolor[intval($frame_res['_status'])]?>">
								<tr bgcolor="<?=$layer_titlebgcolor[intval($frame_res['_status'])]?>" class="block-head">
									<td colspan="4">&nbsp;&nbsp;&nbsp;<b><?=$frame_res['_title']?></b></td>
									<td align="left">
										<? 
										if($rec[$pos][$i]['_status']==1){ ?>
										<a title='کليک کنيد تا غيرفعال شود' href="?page=admin&cp=<?=$_REQUEST['cp']?>&do=disactivateframe&_id=<?=$rec[$pos][$i]['_id']?>"><img src="image.list/blocks-button_1.png" border="0"></a>
										<? } else {?>
										<a title='کليک کنيد تا فعال شود' href="?page=admin&cp=<?=$_REQUEST['cp']?>&do=activateframe&_id=<?=$rec[$pos][$i]['_id']?>"><img src="image.list/blocks-button_0.png" border="0"></a>
										<? } ?>
									</td>
									<td></td>
								</tr>
								<tr bgcolor="#979797" height="1"><td colspan="6"></td></tr>
								<tr height="5"><td colspan="6"></td></tr>
								<tr>
									<td width="10"></td>
									<td width="50"><img src="<?=$img_src?>" ></td>
									<td width="10"></td>
									<td>
									<?
									$object_name = $GLOBALS['block_layers'][ $frame_res['_func'] ];
									echo "<span class='box-title' title='نوع بلاک'>".$object_name."</span><br>";
									?>
									</td>
									<td align="left">
										<table cellpadding="2" cellspacing="1" width="1" height="1" bgcolor="#d2d2d2">
											<tr>
												<td bgcolor="white"><a title="ويرايش بلاک" href="?page=admin&cp=<?=$_REQUEST['cp']?>&do=editframe&_id=<?=$rec[$pos][$i]['_id']?>"><img id='<?=rand(1000000,9999999)?>' onmouseover='HighLight(id,1)' onmouseout='HighLight(id,0)' src="image.list/blocks-edit.png" border="0" ></a></td>
												<td bgcolor="white">
													<? if($i>0){ ?>
													<a href="?page=admin&cp=<?=$_REQUEST['cp']?>&do=moveupframe&_id=<?=$rec[$pos][$i]['_id']?>"><img id='<?=rand(1000000,9999999)?>' onmouseover='HighLight(id,1)' onmouseout='HighLight(id,0)' src="image.list/blocks-go-up.png" title="انتقال به بالا" border="0" ></a>
													<? } else { ?>
													<img id='<?=rand(1000000,9999999)?>' onload="COLORATE(id,0)" src="image.list/blocks-go-up.png" border="0" >
													<? } ?>
												</td>
											</tr>
											<tr>
												<td bgcolor="white"><a href="javascript:if(confirm('آيا مايل به حذف اين بلاک ميباشيد؟'))location.href='?page=admin&cp=<?=$_REQUEST['cp']?>&do=deleteframe&_id=<?=$rec[$pos][$i]['_id']?>'"><img id='<?=rand(1000000,9999999)?>' onmouseover='HighLight(id,1)' onmouseout='HighLight(id,0)' src="image.list/blocks-delete_2.png" border="0" ></a></td>
												<td bgcolor="white">
													<? if($i!=sizeof($rec[$pos])-1){ ?>
													<a href="?page=admin&cp=<?=$_REQUEST['cp']?>&do=movedownframe&_id=<?=$rec[$pos][$i]['_id']?>"><img id='<?=rand(1000000,9999999)?>' onmouseover='HighLight(id,1)' onmouseout='HighLight(id,0)' src="image.list/blocks-go-down.png" title="انتقال به پايين" border="0" ></a>
													<? } else { ?>
													<img id='<?=rand(1000000,9999999)?>' onload="COLORATE(id,0)" src="image.list/blocks-go-down.png" border="0" >
													<? } ?>
												</td>
											</tr>
										</table>
									</td>
									<td width="10"></td>
								</tr>
								<tr height="5"><td colspan="6"></td></tr>
							</table>
							</td></tr></table>
							<?
						}
					}
					?>
				</fieldset>
		</td></tr>
		<!-- down e -->

	</table>
	<?
}


function blocks_set_priority($position){
	$res = db_query(" select `_id` from `_page_frames` where `_position`='$position' order by `_priority`,`_id` ");
	$num = mysql_num_rows($res);
	for($i=0; $i<$num; $i++){
		$rec = mysql_fetch_array($res);
		db_query(" update `_page_frames` set `_priority`='".($i+1)."' where `_id`='".$rec['_id']."' limit 1 ");
	}
}


function editframe_panel($frame_id){
	if(!$res = db_query(" select * from `_page_frames` where `_id`='$frame_id' limit 1 ")){
		echo cadr("er333");
		return false;
	} elseif(mysql_num_rows($res)!=1){
		echo cadr("er336");
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
	<input type="hidden" name="do" value="save_editframe" />
	<input type="hidden" name="_id" value="<?=$frame_id?>" />
	<?

	switch($rec['_func']){

		case 'post' :
			?>
			<fieldset class="blocks_management_editframe_panel_post">
				<legend >ويرايش پست</legend>
				<center>
				<table width="80%" class="0" cellspacing="0" dir=rtl >
					<tr height="20"><td colspan="2"></td></tr>
					<tr>
						<td width=140px >نوع بلاک : </td>
						<td>
						<select id="blocktype" onchange="if(confirm('بعد از انتخاب نوع جديد، تنضيمات فعلي اين بلاک از بين خواهد رفت، آيا مايل به ادامه ميباشيد؟')){location.href='?page=admin&cp=<?=$_REQUEST['cp']?>&do=changeframetype&_id=<?=$frame_id?>&_func='+value;}" name="_func" class="tx1" value="<?=$rec['_title']?>" >
							<?
							foreach($GLOBALS['block_layers'] as $func => $name){
								echo '<option value="'.$func.'">'.$name.'</option>';
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
							<textarea dir="ltr" name="_data" id="_data" class="tx1" ><?
							echo str_replace("</TEXTAREA>","&lt;/TEXTAREA&gt;",str_replace("</textarea>","&lt;/textarea&gt;",$rec['_data']))?></textarea>
						</td>
					</tr>
					<tr height="10"><td colspan="2"></td></tr>
					<tr height="1" bgcolor="#e3e0e0"><td colspan="2"></td></tr>
					<tr height="10"><td colspan="2"></td></tr>
					<tr><td colspan="2">فرمت پست : 
						<br><label><input type="radio" onclick="tinyMCE_off('_data')" id="radio_dl_TEXT" name="_type" value="TEXT" > Text</label>
						<br><label><input type="radio" onclick="tinyMCE_on('_data')" id="radio_dl_HTML" name="_type" value="HTML" > Html Code</label>
						<br><label><input type="radio" onclick="tinyMCE_off('_data')" id="radio_dl_PHP5" name="_type" value="PHP5" > PHP</label>
					</td></tr>
					<script>
					document.getElementById('radio_dl_<?=$rec['_type']?>').checked='checked';
					<?=($rec['_type']=='HTML'?"tinyMCE_on('_data');":"")?>
					</script>
					<tr height="10"><td colspan="2"></td></tr>
					<tr height="1" bgcolor="#e3e0e0"><td colspan="2"></td></tr>
					<tr height="2"><td colspan="2"></td></tr>
					<tr>
						<td align="center">
							<input type="checkbox" name="_framed" <? if($rec['_framed'])echo "checked" ?> value="1" >فريم اضافه شود
						</td>
						<td align="center">
							<input type="button" class="submit1 submit_button" onclick="location.href='?page=admin&cp=<?=$_REQUEST['cp']?>'"  value="بازگشت" style="width:80px;">
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
			<fieldset>
				<legend >ويرايش منوي کاربر</legend>
				<center>
				<table width="80%" class="0" cellspacing="0">
					<tr height="20"><td colspan="2"></td></tr>
					<tr>
						<td>نوع بلاک : </td>
						<td>
						<select id="blocktype" onchange="if(confirm('بعد از انتخاب نوع جديد، تنضيمات فعلي اين بلاک از بين خواهد رفت، آيا مايل به ادامه ميباشيد؟')){location.href='?page=admin&cp=<?=$_REQUEST['cp']?>&do=changeframetype&_id=<?=$frame_id?>&_func='+value;}" name="_func" class="tx1">
							<?
							foreach($GLOBALS['block_layers'] as $func => $name){
								echo '<option value="'.$func.'">'.$name.'</option>';
							}
							?>
						</select><script> document.getElementById('blocktype').value="<?=$rec['_func']?>" </script>
						</td>
					</tr>
					<tr height="10"><td colspan="2"></td></tr>
					<tr dir="rtl">
						<td>عنوان بلاک :</td>
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
							براي ويرايش پيوندها به قسمت <a href="?page=admin&cp=" style="color:blue">مديريت پيوندها</a> ، و براي ويرايش صفحات کاربري به قسمت <a href="
							?page=admin&cp=03" style="color:blue">مديريت صفحات</a> مراجعه شود
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
							<input type="button" class="submit1 submit_button" onclick="location.href='?page=admin&cp=<?=$_REQUEST['cp']?>'"  value="بازگشت" style="width:80px;">
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




