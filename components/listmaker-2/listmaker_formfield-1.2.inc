<?

# jalal7h@gmail.com
# 2015/10/15
# Version 1.2.6

/*
$GLOBALS['formName'] = "tForm";
echo
ff(array("عنوان",'n:name'=>$tTour,'inDiv')).
ff(array( lmtc("table:field") ,'n:city*'=>$tTour,'inDiv')).
ff(array("شهر",'n:city*'=>$tTour,'inDiv')).
ff(array('تاریخ','class'=>'calendar','n:date*'=>$tTour,'inDiv')).
ff(array('نوع سفر','n:tripType*'=>$tTour,'option'=>array('z' => 'زمینی','h' => 'هوایی'),'inDiv')).
ff(array('گروه','n:cat*'=>$tTour,'option'=>listmaker_select_options($table_name, $condition="", $returnArray=true) ,'inDiv')).
ff(array('خدمات','t:textarea','class'=>'tinymce','n:khadamat'=>$tTour,'inDiv')).
ff(array('مدت اقامت','n:modatEghamat*'=>$tTour,'inDiv')).
ff(array('عکس','n:file[]+'=>'','accept'=>'image/*','inDiv')).
ff('clear').
ff('hr').
ff('br').
ff(array('t:submit','n:submit'=>'ثبت','inDiv'));

there is [] and []+
*/

function ff($field){
	return listmaker_formfield($field);
}

function listmaker_formfield($field){
	if(!is_array($field)){
		switch ($field) {
			case 'br': return '<br />';
			case 'hr': return '<div class="divider"></div>';
			case 'clear': return '<div class="clear"></div>';
			default: return '<span class="listmaker_formfield_titlespan lmffts">'.$field.'</span>';
		}
	}
	foreach($field as $k0 => $r0){
#		$isNeeded = false;
#		$moreButton = false;
#		$inDiv = false;
		if(substr($k0,0,2)=='n:'){
			$field['name'] = substr($k0,2);
			if(strstr($field['name'],"*")){
				$field['name'] = str_replace("*","",$field['name']);
				$isNeeded = true;
			}
			if(strstr($field['name'],"[]+")){
				$field['name'] = str_replace("+","",$field['name']);
				$moreButton = true;
			}
			
			if(is_array($r0)){
				$field['value'] = $r0[$field['name']];
			} else {
				$field['value'] = $r0;
			}
		} else if(is_numeric($k0)){
			if($r0=='inDiv'){
				$inDiv = true;
			} else if(substr($r0,0,2)=='t:'){
				$field['type'] = substr($r0,2);
			} else {
				$field['placeholder'] = $r0;
			}
		}
	}
	
	if($field['id']=='' and $field['id']!='NuN'){
		$field['id'] = $GLOBALS['formName']."_".str_replace(array("[","]"),"",$field['name']);
	}
	
	if($field['type']==''){
		if($field['option']!=''){
			$field['type'] = 'select';
		} else if($field['accept']!=''){
			$field['type'] = 'file';
		} else {
			$field['type'] = 'text';
		}
	}
	
	switch($field['type']){
		
		case 'select' : 
			if($field['option']){
				foreach($field['option'] as $k => $r){
					$options.= "<option value='$k' >$r</option>";
				}
			}
			$c = "<select title='".$field['placeholder']."' ".
			($field['class']?"class='".$field['class']."' ":"").
			($field['name']?"name='".$field['name']."' ":"").
			($field['id']?"id='".$field['id']."' ":"").
			($field['etc']?$field['etc']." ":"").
			">".
			($field['placeholder']?"<option value='' >.. ".$field['placeholder']." ..</option>":"").
			$options.
			"</select>".
			($field['value']?"<script>document.getElementById('".$field['id']."').value='".$field['value']."'</script>":"");
			break;
			
		case 'textarea' : 
			$c = "<textarea title='".$field['placeholder']."' ".
			($field['class']?"class='".$field['class']."' ":"").
			($field['name']?"name='".$field['name']."' ":"").
			($field['id']?"id='".$field['id']."' ":"").
			($field['placeholder']?"placeholder='".$field['placeholder']."' ":"").
			($field['etc']?$field['etc']." ":"").
			">".
			$field['value'].
			"</textarea>";
			break;
		
		case 'checkbox' : 
			$c = "<label><input ".
			"type='".$field['type']."' ".
			($field['name']?"name='".$field['name']."' ":"").
			($field['checked']?"checked='".$field['checked']."' ":"").
			(intval($field['value'])>0?"checked='1' ":"").
			($field['id']?"id='".$field['id']."' ":"").
			($field['value']?"value='".$field['value']."' ":"value='1'").
			($field['etc']?$field['etc']." ":"").
			"/>&nbsp;".$field['placeholder']."</label>&nbsp;&nbsp;&nbsp;";
			break;
		
		// case 'file' : 
		// 	$c = "<span class='lmfffs'>".$field['placeholder']."</span><input ".
		// 	"type='".$field['type']."' ".
		// 	"class='lmff_file".($field['class']?" ".$field['class']:"")."' ".
		// 	($field['name']?"name='".$field['name']."' ":"").
		// 	($field['id']?"id='".$field['id']."' ":"").
		// 	($field['value']?"value='".$field['value']."' ":"").
		// 	($field['etc']?$field['etc']." ":"").
		// 	($field['accept']?"accept='".$field['accept']."' ":"").
		// 	"/>";
		// 	break;

		case 'file' : 
			$c = "<div class='lmff_div'><span onclick='lmff_div_select( this )' class='lmff_span submit_button'>".$field['placeholder']."</span>".
			"<input ".
			"type='".$field['type']."' ".
			"class='lmff_file".($field['class']?" ".$field['class']:"")."' ".
			($field['name']?"name='".$field['name']."' ":"").
			($field['id']?"id='".$field['id']."' ":"").
			($field['value']?"value='".$field['value']."' ":"").
			($field['etc']?$field['etc']." ":"").
			($field['accept']?"accept='".$field['accept']."' ":"").
			"/></div>";
			$moreButton_c_tmp = $c;
			break;
		
		DEFAULT : 
			$c = "<input title='".$field['placeholder']."' ".
			"type='".$field['type']."' ".
			($checked?"checked=1 ":"").
			($field['class']?"class='".$field['class']."' ":"").
			($field['name']?"name='".$field['name']."' ":"").
			($field['id']?"id='".$field['id']."' ":"").
			"value='".$field['value']."' ".
			($field['placeholder']?"placeholder='".$field['placeholder']."' ":"").
			($field['accept']?"accept='".$field['accept']."' ":"").
			($field['etc']?$field['etc']." ":"").
			"/>";
			break;
	}

	if($field['name']){
		$GLOBALS['ffcss-name'][] = $field['name'];
	}
	if($field['id']){
		$GLOBALS['ffcss'][] = $field['id'];
	}
	
	if($moreButton){
		$moreButton_c_tmp = str_replace("'", '"', $moreButton_c_tmp);
		$moreButton_c_tmp = addcslashes($moreButton_c_tmp, '"');
		// echo "\n\n\n";echo $moreButton_c_tmp;die();
		$c = "<span>$c</span>";
		$rand2 = "plus".rand(1000,9999);
		$c.= "<a onclick='$(\"#".$rand2."\").append(\"".$moreButton_c_tmp."\"); return false;' class='lmff_aplus' href='#' onclick=''>+ بیشتر</a>";
		$c.= "<div id='$rand2' ></div>";
	}

	$c.= listmaker_formfield_file_preuploadedfiles( $field );
	
	if($field['class']=='tinymce'){
		if(!$GLOBALS['tinymce-defined']){
			$GLOBALS['tinymce-defined'] = true;
			$c.= '
			<!--- tinymce --->
			<script src="http://parsunix.com/cdn/js/tinymce/tinymce.jquery/tinymce.min.js"></script>
			<script src="http://parsunix.com/cdn/js/tinymce/tinymce-set.js"></script>
			<!---->
			';
		}
	}
	
	if($inDiv){
		$c = "<div id='inDiv_".$field['id']."' >$c</div>\n";
	}
	
	if($isNeeded){
		$c.= "
		<script>
			$('form[name=\"".$GLOBALS['formName']."\"]').submit(function(event){
				if($('#".$field['id']."').val()==''){
					$('#".$field['id']."').css('backgroundColor','#fdd');
					$('#".$field['id']."').keydown(function(){
						$(this).css('backgroundColor','');
					});
					$('#".$field['id']."').change(function(){
						$(this).css('backgroundColor','');
					});
					event.preventDefault();
				}
			});
		</script>\n";
	}
	
	return $c;
}

function listmaker_formfield_file_preuploadedfiles( $field ){
	if($field['type']!='file'){
		;//
	} else if(!$table_id = $_REQUEST['id']){
		;//
	} else {
		$dir = "data/".str_replace(array("[","]"), "", $field['name'])."/".$table_id;
		if(!file_exists($dir)){
			;//
		} else if(!$dp = opendir($dir)){
			;//
		} else {
			$c.= "<div class='listmaker_formfield_file_preuploadedfiles lmfffpuf'>";
			while($d = readdir($dp)){
				if(substr($d,0,1)=='.'){
					continue;
				} else {
					# 
					# add this file to array of valid-to-remove, it will allow remove-agent to file be removed via ajax wget
					$_SESSION['listmaker_formfield-validtoremove'][] = $dir."/".$d;
					// $_SESSION['listmaker_formfield-validtoremove'] = null;
					$ext = substr(strtolower(strrchr($d, ".")),1);
					if(in_array( $ext, array("jpg","jpeg","png","gif"))){
						$c.= "<a rel='".$dir."/".$d."' title='حذف فایل' ><div class='imgc'><img src='resize/40x40/".$dir."/".$d."' /></div><span>".$d."</span></a>";
					} else {
						$c.= "<a rel='".$dir."/".$d."' title='حذف فایل' ><div class='imgc notpic'>".strtoupper($ext)."</div><span>".$d."</span></a>";
					}
					
				}
			}
			$c.= "</div>";
		}
	}

	return $c;
}

function ffcss(){
	echo "<pre>";
	foreach($GLOBALS['ffcss'] as $k => $r){
		if(!trim($r)){
			continue;
		}
		echo "\n#$r {\n\t\n}";
	}
	echo "\n- - - - - - - - - - - - - - - - - -\n";
	echo " UPDATE `table_name` SET \n";
	foreach($GLOBALS['ffcss-name'] as $k => $r){
		if(!trim($r)){
			continue;
		}
		$list0[] = '`'.$r.'`=\'".$_REQUEST[\''.$r.'\']."\'';
	}
	echo implode(",\n", $list0)."\n";
	echo ' WHERE `id`=\'$id\' ';
	echo "\n- - - - - - - - - - - - - - - - - -\n";
	echo " INSERT INTO `table_name` (";
	foreach($GLOBALS['ffcss-name'] as $k => $r){
		if(!trim($r)){
			continue;
		}
		$list1[] = $r;
	}
	echo "`".implode("`,`", $list1)."`) VALUES (";
	foreach($GLOBALS['ffcss-name'] as $k => $r){
		if(!trim($r)){
			continue;
		}
		$list2[] = '".$_REQUEST[\''.$r.'\']."';
	}
	echo "'".implode("','", $list2)."')";
	echo "\n- - - - - - - - - - - - - - - - - -\n";
	echo "</pre>";
	die();
}




