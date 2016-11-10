<?php

function f_front__f_html__header(){

	$vars['meta_title'] = tab__temp('main_title');

	if(!$id = $_REQUEST['page']){
		$id = 1;
	}
	if(!$rw = table("_pages", $id, null, "_page")){
		$id = 1;
	} else {

		#
		# title
		if($rw['meta_title']){ // it have an special title
			ob_start();
			eval("?>".$rw['meta_title']."<?");
			$vars['meta_title'] = ob_get_contents();
			ob_end_clean();
		} else {
			// its a normal page with no special title
			$vars['meta_title'] = tab__temp('main_title');
			$vars['meta_title'].=" , ".$rw['_title'];
		}
		
		#
		# kw
		if($rw['meta_kw']){ // it have an special title
			ob_start();
			eval("?>".$rw['meta_kw']."<?");
			$vars['meta_kw'] = ob_get_contents();
			ob_end_clean();
		} else {
			// its a normal page with no special title
			$vars['meta_kw'] = str_replace("،",",",tab__temp("keywords"));
		}
		
		#
		# desc
		if($rw['meta_desc']){ // it have an special title
			ob_start();
			eval("?>".$rw['meta_desc']."<?");
			$vars['meta_desc'] = ob_get_contents();
			ob_end_clean();
		} else {
			// its a normal page with no special title
			$vars['meta_desc'] = str_replace("،",",",tab__temp("websitedescription"));
		}

	}

	echo template_engine('html-tag-open',$vars);
}

function f_front__f_html__TOP(){
	$dates=U2Vaght(U());
	$dates=Vaght_2_Taghvim($dates);
	$dates=explode('&nbsp;',$dates);
	$vars['date']=$dates[1]." <span dir=rtl lang=fa>".str_replace('.','/',substr(U2Vaght(U()),2,8))."</span>";
	$vars['THEME']=_THEME;
	
	echo template_engine('header',$vars);
}

function f_front__f_html__DOWN(){
	echo template_engine('footer',$vars);
}

function f_front__f_html__copyright(){
	$vars['date-y'] = date("Y");
	return template_engine('copyright',$vars);
}

function f_front__f_html__footer(){
	$vars['THEME']=_THEME;
	$vars['date-y'] = date("Y");
	echo template_engine('html-tag-close',$vars);
}






