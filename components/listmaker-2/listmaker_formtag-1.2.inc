<?

# jalal7h@gmail.com
# 2015/08/19
# Version 1.2.1

# 
# echo 
# fm(array('name'=>'kfForm' , 'class'=>'some-class-name' , 'method'=>'post' , 'action'=>'./?page=44?do=jobs_karfarma_save','save_switch'=>'do')).
# ...
# fm('close' , $listifcsselements=true );
# 

function fm($array , $ffcss=false){
	return listmaker_formtag($array , $ffcss);
}

function listmaker_formtag($array, $ffcss=false){
	#
	# close form
	if($array=='close'){
		$c = '</form>';
		if($ffcss){
			echo "ffcss";
			ffcss();
		}
	#
	# open form
	} else {
		#
		# check if there is no name for this form, assign some name
		if($array['name']==''){
			$array['name'] = 'form'.rand(1001,9999);
		}
		$GLOBALS['formName'] = $array['name'];
		#
		# check if there is no method defined
		if($array['method']==''){
			$array['method'] = 'post';
		}
		#
		# check if its having some id and name of save switch
		if($array['save_switch']!=''){
			if($id = $_REQUEST['id']){
				$save_switch_string = "&".$array['save_switch']."=saveEdit&id=".$id;
			} else {
				$save_switch_string = "&".$array['save_switch']."=saveNew";
			}
			$array['action'].= $save_switch_string;
		}
		#
		# burn the <form tag
		$c = '<form	enctype="multipart/form-data" 
			'.($array['name'] ? 'name="'.$array['name'].'"':'').'
			'.($array['class'] ? 'class="'.$array['class'].'"':'').'
			method="'.($array['method'] ? $array['method']:'POST').'"
			action="'.$array['action'].'" >';
	}
	
	return $c;
}




