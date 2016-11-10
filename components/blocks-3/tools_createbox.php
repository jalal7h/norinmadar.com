<?

function create_box($title, $content, $allow_eval=false, $framed=true, $position="center"){
	
	$tpl_name = 'block';
	
	if(!$framed){
		if($allow_eval==true){
			eval("?>$content<?");
		} else {
			echo $content;
		}
		return true;
	} else {
		$vars['block-title']=$title;
		if($allow_eval==true){
			ob_start();
			eval("?>$content<?");
			$content = ob_get_contents();
			ob_end_clean();
		} else {
			;//
		}
		$vars['block-content']=$content;
		$vars['_THEME']=_THEME;
		$vars['position']=$position;
		
		if(function_exists("imageSize")){
			$vars['imagesize-w-post_position.middle.left']= imageSize('templates/'._THEME.'/front/post_'.$position.'.middle.left.gif',"W");
			$vars['imagesize-w-post_position.middle.right']= imageSize('templates/'._THEME.'/front/post_'.$position.'.middle.right.gif',"W");
		}
		echo template_engine($tpl_name,$vars);
	}
	return true;
}

