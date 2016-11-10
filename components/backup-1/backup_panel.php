<?
$GLOBALS['cmp']['backup_panel'] = 'پشتيبان گيري';


##############################################################
$GLOBALS['Title4Table']['_ip_bin']='عبور و مرور';
$GLOBALS['Title4Table']['_links']='پيوندها';
$GLOBALS['Title4Table']['_page_frames']='بلاکهاي صفحات';
$GLOBALS['Title4Table']['_page_layers']='لايه هاي صفحات';
$GLOBALS['Title4Table']['_pages']='صفحات';
$GLOBALS['Title4Table']['_temp']='پيکربندي';
$GLOBALS['Title4Table']['users']='اطلاعات کاربران';
$GLOBALS['Title4Table']['_banks']='درگاه های پرداخت';
$GLOBALS['Title4Table']['_messagebox']='پیام های خصوصی';
$GLOBALS['Title4Table']['_payments']='اطلاعات مالی';
$GLOBALS['Title4Table']['groups']='باجه ها';
$GLOBALS['Title4Table']['keyfilter']='فیلترینگ کلمات';
$GLOBALS['Title4Table']['news']='اخبار سایت';
$GLOBALS['Title4Table']['pubIP']='بازدید ها';
$GLOBALS['Title4Table']['pos_cities']='شهرها';
$GLOBALS['Title4Table']['pos_country']='کشورها';
$GLOBALS['Title4Table']['cat']='دسته بندی ها';

##############################################################

##___________________________________________________________________________________________________
function backup_panel(){
	?>
	<br>
	<table dir="rtl" cellpadding="0" cellspacing="0" border=0 width="100%" class="tx1">
	
		<tr height="34px">
			<td colspan=7 align="right" >
			<table dir="rtl" height="34px" width="100%" cellpadding="0" cellspacing="0" border="0">
				<tr height="34px">
					<td width="34px"><img src="image.list/tab_right.png" width="34"  height="34"></td>
				
					<td background="image.list/tab_bg.png" width="100%" >
						<table width="100%" cellpadding="0" cellspacing="0" border="0"><tr>
							<td  align="center" style="font-size:15px; font-weight:bold; color:#868686; cursor:default;">پشتيبان گيري</td>
						</tr></table>
					</td>
					<td width="34px"><img src="image.list/tab_left.png" width="34"  height="34"></td>
				</tr>
			</table>
		</td>
		</tr>
		<tr height="10">
			<td colspan="99"></td>
		</tr>
		<form action="" method="post" name="form11">
		<input type="hidden" name="page" value="admin">
		<input type="hidden" name="cp" value="<?=$_REQUEST['cp']?>">
		<input type="hidden" name="do_pre" value="backup_dropZippedBackup">
		<?
		if(!$rec=backup_bringTableNames()){
			echo cadr("er35");
		} else {
			for($i=0; $i<sizeof($rec); $i++){
				?>
				<tr bgcolor='#d1d1d1'><td colspan=7 ></td></tr>
				<tr bgcolor='white'><td colspan=7 ></td></tr>
				<tr bgcolor='#f8f8f8' height="30" >
					<td></td>
					<td><?=($i+1)?></td>
					<td><b class="tx1"><?=($GLOBALS['Title4Table'][$rec[$i]]!=''?$GLOBALS['Title4Table'][$rec[$i]]:$rec[$i])?></b></td>
					<td></td>
					<td><span class="tx0">رکورد: </span><?=backup_bringTableRecordNum($rec[$i])?></td>
					<td>
					<label><input type="radio" checked name="<?=$rec[$i]?>" value="1">بله</label>
					<img src="s" width="2" height="1">
					<label><input type="radio" name="<?=$rec[$i]?>" value="0">خير</label>
					</td>
					<td></td>
				</tr>
				<tr bgcolor='white'><td colspan=7 ></td></tr>
				<tr bgcolor='#d1d1d1'><td colspan=7 ></td></tr>
				<tr height="8"><td colspan="7"></td></tr>
				<?
			}
		}
		?>
		</form>
		<tr height="10"><td colspan="7"></td></tr>
		<tr bgcolor='#d1d1d1'><td colspan=7 ></td></tr>
		<tr bgcolor='white'><td colspan=7 ></td></tr>
		<tr height="40" class="submit1">
			<td colspan="5">
			
			</td>
			<td colspan="2">
				<input type="button" onclick="form11.submit();" id="form11submit" value="دريافت" class="submit_button" >
			</td>
		</tr>
		<tr bgcolor='white'><td colspan=7 ></td></tr>
		<tr bgcolor='#d1d1d1'><td colspan=7 ></td></tr>
		<tr height="1"><td colspan="7"></td></tr>
		<tr bgcolor='#d1d1d1'><td colspan=7 ></td></tr>
		<tr bgcolor='#d7d7d7'><td colspan=7 ></td></tr>
		<tr bgcolor='#dfdfdf'><td colspan=7 ></td></tr>
		<tr bgcolor='#e7e7e7'><td colspan=7 ></td></tr>
		<tr height="120" bgcolor='#f9f9f9'>
		<td></td>
		<td colspan=5 >
			<form enctype="multipart/form-data" action="" method="post" name="form12" onsubmit="
			document.getElementById('form12submit').disabled=1;
			document.getElementById('form12submit').value='انتظار...';
			">
			<input type="hidden" name="page" value="admin">
			<input type="hidden" name="cp" value="<?=$_REQUEST['cp']?>">
			<input type="hidden" name="do_pre" value="backup_extractAndLoadZip">
			<br><br>
			<b class="tx2">بازيابي از فايل پشتيبان : </b><br>
			<span class="tx1">فايل پشتيبان موردنظر را آدرس دهي کرده، و براي بارگزاري ساختار و اطلاعات، فرم را تاييد کنيد ...</span>
			<br><br>
			<center>
			<input type="file" name="userfile" class="input1" style="width:250; height:20;" >
			<input type="submit" class="submit_button" value="بازيابي" id="form12submit">
			</center>
			</form>
		</td>
		<td></td>
		</tr>
		<tr height="1"><td colspan="7"></td></tr>
		<tr bgcolor='#d1d1d1'><td colspan=7 ></td></tr>
		<tr height="10"><td colspan="7"></td></tr>
	</table>
	<?
}





##___________________________________________________________________________________________________
function backup_bringTableNames(){
	if(!$res=db_query(" show tables ")){ 
		echo cadr("er65");
		return false; 
	} else if(!$num=mysql_num_rows($res)){
		echo cadr("er68");
		return false;
	} else {
		for($i=0; $i<$num; $i++)
			$rec[$i] = mysql_result($res, $i, 0);
		return $rec ;
	}
}




##___________________________________________________________________________________________________
function backup_bringTableRecordNum($tableName){
	if(!$res=db_query(" describe `$tableName` ")){
		echo cadr('error96');
		return false;
	} else if(mysql_num_rows($res)==0){
		echo cadr('error99');
		return false;
	} else {
		$field=mysql_result($res, 0, 0);
		if(!$res2=mysql_query(" select count(`$field`) from `$tableName` where 1 ")){
			echo cadr('error104');
			return false;
		} else {
			return mysql_result($res2,0,0);
		}
	}
}



##___________________________________________________________________________________________________
function backup_dropZippedBackup(){
	if(!$SQLFILE=CP_DATABASE__CREATESQLFILE())return false;
	$z = new PHPZip();
	$z -> addFile($SQLFILE,"backup_".DomainBaseName."_".date('Y.m.d').".sql");
	$zipped = $z -> file();
	if(!INJECT_BACKUP_IN_FILE($zipped)){
		echo '<META http-equiv=Content-Type content="text/html; charset=utf-8">';
		echo "<script>alert('".__TOOLS___62."') </script>";
	}
}




//*****************************************************************************____________________CP_DATABASE__CREATESQLFILE
function CP_DATABASE__CREATESQLFILE(){

	if(!$TABLES = backup_bringTableNames($GLOBALS['dtbname']))
		{ echo "<center class=ER1> Error in progress </center>"; return false; }
	
	$SQLFILE='';	
	
	for($i=0; $i<sizeof($TABLES); $i++)
		if($_REQUEST[$TABLES[$i]]){
			$SQLFILE .= LOAD_TABLE_STRUCTURE($TABLES[$i]);
			$SQLFILE .= LOAD_TABLE_DATA($TABLES[$i]);
		}
	
	if(!$SQLFILE)
		return true;
	else
		return $SQLFILE;
}


//*****************************************************************************____________________INJECT_BACKUP_IN_FILE
function INJECT_BACKUP_IN_FILE($FILE){
	$fileName="backup_".DomainBaseName."_".date('Y.m.d').".zip";
	@ header('Content-disposition: filename='.$fileName.'');
	@ header('Content-type: unknown/unknown');
	echo $FILE;
	exit;
	return true;
}


//*****************************************************************************____________________LOAD_TABLE_STRUCTURE
function LOAD_TABLE_STRUCTURE($TB){
	
	$m=0;
	$n=0;
		
	$SEND = "\nCREATE TABLE $TB ( \n ";
	if(!$sql=db_query(" DESCRIBE $TB ")){
		echo "<center class=ER1> Error in progress </center>";
		return false;
	}
	
	if(!$NuM=mysql_num_rows($sql))
		return false;
	
	for($i=0; $i<mysql_num_rows($sql); $i++){
		if(mysql_result($sql, $i, 3)=='MUL')$MUL[$m++] = mysql_result($sql, $i, 0);
		if(mysql_result($sql, $i, 3)=='PRI')$PRI[$n++] = mysql_result($sql, $i, 0);
		for($j=0,$ROW=false; $j<mysql_num_fields($sql); $j++)
			$ROW[$j]=mysql_result($sql, $i, $j);
		$SEND .= CHECK_VARIABLES_FIELDS($ROW);
		if($i!=mysql_num_rows($sql)-1)$SEND.=" ,\n ";
	}

	if(sizeof($PRI)){		
		$SEND .= " , \n PRIMARY KEY  ( ";
		for($k=0; $k<sizeof($PRI); $k++){
			if($PRI[$k]=='')continue;
			
			$SEND .= $PRI[$k] ;
			if( $k != sizeof($PRI)-1 )$SEND .=" , ";}
		$SEND .= " ) ";
	}
			
	if(sizeof($MUL)!=0){		
		for($k=0; $k<sizeof($MUL); $k++)
			if($MUL[$k]!='')$SEND .= " , \n KEY ".$MUL[$k]." (".$MUL[$k].") ".$KT ;
	}
	$SEND .= "\n) ; \n\n";
	return $SEND;
}



//*****************************************************************************____________________CHECK_VARIABLES_FIELDS
function CHECK_VARIABLES_FIELDS($FLDS){
	
	if($FLDS[2]=='YES') $FLDS[2] = '  ';
	if($FLDS[2]=='' or ($FLDS[2]=="NO") ) $FLDS[2] = ' NOT NULL ';
	if($FLDS[3]=='PRI') $FLDS[3] = '  ';
	if($FLDS[3]=='MUL') $FLDS[3] = '  ';
	if($FLDS[3]=='UNI') $FLDS[3] = ' UNIQUE KEY ';
	if($FLDS[4]!=''   ) $FLDS[4] = " DEFAULT '".$FLDS[4]."'";
	
	$ROW = $FLDS[0] .' '. $FLDS[1] .' '. $FLDS[2] .' '. $FLDS[3] .' '. $FLDS[4] .' '. $FLDS[5]  ;
	return $ROW ;
}



//*****************************************************************************____________________LOAD_TABLE_DATA
function LOAD_TABLE_DATA($TB){
	
	if(!$sql=db_query(" SELECT * FROM $TB  WHERE 1 ")){
		echo "<center class=ER1> Error in progress </center>"; 
		return false;
	}	
	if(mysql_num_rows($sql)==0)return false;	
	$SEND = " INSERT INTO $TB VALUES ";	
	$FirstRecord=true;
	for($i=0; $i<mysql_num_rows($sql); $i++){
		if($FirstRecord==true)
			$FirstRecord=false;
		else $SEND .= " , ";
		$SEND .= "( ";
		$FLDS = mysql_fetch_array($sql);
		$SEND .= CHECK_DATA_FIELDS($FLDS);
		$SEND .= " )\n";
	}
	$SEND .= ";\n";
	return $SEND;
}


//*****************************************************************************____________________CHECK__DATA_FIELDS
function CHECK_DATA_FIELDS($FLDS){
	$ROW = '';
	for($i=0; $i<sizeof($FLDS)/2; $i++){
		$KEY = $FLDS[$i];
		$KEY = addslashes($KEY);
		$ROW .= " '".$KEY."' ";
		if($i!=sizeof($FLDS)/2-1)$ROW .= ',';
		else return $ROW ;
	}
	return $ROW;
}



/********/






##___________________________________________________________________________________________________
function backup_extractAndLoadZip(){

	$FILE = $_FILES['userfile']['tmp_name'];
	$filename = basename($_FILES['userfile']['name']);
	
	//$TOPFREESBMTJS=" top.document.getElementById('form12submit').value='بازيابي'; top.document.getElementById('form12submit').disabled=0;";
	/*************************************************************UPLOAD*SECURITY************************************************/
	switch(strtolower(strrchr($filename, '.'))){
		case '.sql' :
		case '.txt' :
			if(!$RECEIVE=implode('',file($_FILES['userfile']['tmp_name'])))
				{echo "<script> alert('Error in progress0'); $TOPFREESBMTJS </script>";}
			break;
			
		case '.zip'  :
			if(!$RECEIVE=UNZIP_UPLOADED_FILE('userfile'))
				{echo "<script> alert('Error in progress1'); $TOPFREESBMTJS </script>";}
			break;
		
		DEFAULT : 
			echo "<script> alert('Invalid file type [none backup]'); $TOPFREESBMTJS </script>";
			return false;
			break;
	}
	/*************************************************************UPLOAD*SECURITY************************************************/

	$CREATES = SEPARATE_SQLFILE($RECEIVE,'CREATE TABLE ');
	$INSERTS = SEPARATE_SQLFILE($RECEIVE,'INSERT INTO '); 
	
	for($i=0; $i<sizeof($CREATES); $i++)
		if(!CREATE__NEW__TABLE($CREATES[$i]))
			;//
	for($i=0; $i<sizeof($INSERTS); $i++)
		if(!INSERTS__NEW__ROWS($INSERTS[$i]))
			;//
	echo "<script> $TOPFREESBMTJS </script>";
	
	return true;
}









//*****************************************************************************____________________SEPARATE_SQLFILE
function SEPARATE_SQLFILE($RECEIVE,$CODE){
	
	$k=0;$s=0;
	$ROWS = explode('CREATE TABLE ',$RECEIVE);
	if(substr($RECEIVE,0,13)!='CREATE TABLE ')$ROWS[0]=false;
	for($i=0; $i<sizeof($ROWS); $i++){
		if(!$ROWS[$i])continue;
		$ROWS[$i] = 'CREATE TABLE '.$ROWS[$i];
		$TMP = explode('INSERT INTO ',$ROWS[$i]);
		for($p=0; $p<sizeof($TMP); $p++)
			if(substr($TMP[$p],0,13)!='CREATE TABLE ')
				$TMP[$p]='INSERT INTO '.$TMP[$p];
		for($j=0; $j<sizeof($TMP); $j++)
			$ROWTMP[$k++]=$TMP[$j];
	}$ROWS = $ROWTMP;
	
	for($i=0; $i<sizeof($ROWS); $i++)
		if($ROWS[$i])
			if(substr($ROWS[$i],0,strlen($CODE))==$CODE)
				$SEND[$s++] = $ROWS[$i];

	return $SEND;
}





//*****************************************************************************____________________CREATE__NEW__TABLE
function CREATE__NEW__TABLE($SQL){
	
	
	db_connect();

	$TABLE=explode(' ',$SQL);$TABLE=$TABLE[2];
	if($TABLE)
		if(!$dropsql=db_query(" DROP TABLE $TABLE "))
			echo "<center class=ER1> Error in removing table `$TABLE` </center>";


	if(!$sql=db_query($SQL))
		echo "<center class=ER1> Error in MySQL. </center>";

}





//*****************************************************************************____________________INSERTS__NEW__ROWS
function INSERTS__NEW__ROWS($SQL){

	if(!$sql=db_query($SQL))
		echo " <script> alert('Error in restoring data'); </script> ";
}












?>
