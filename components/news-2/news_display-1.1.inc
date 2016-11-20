<?php

# jalal7h@gmail.com
# 2015/10/07
#  1.2

$GLOBALS['block_layers']['news_display'] = 'نمایش خبر';

function news_display(){
	
	if(! $id = $_REQUEST['id'] ){
		// if no news selected, display the last one.
		$id = dbr(dbq(" SELECT `id` FROM `news` WHERE 1 ORDER BY `id` DESC LIMIT 1 "),0,0);
		$_REQUEST['id'] = $id;
	}
	
	if(! dbq(" UPDATE `news` SET `visit`=`visit`+1 WHERE `id`='$id' LIMIT 1 ") ){
		$c.= "err - ".__LINE__;
		$c.= dbe();

	} else if(! $rw = table("news",$id )){
		$c.= "err - ".__LINE__;

	} else {
		
		$vars['name'] = $rw['name'];
		$vars['pic'] = $rw['pic'];
		$vars['text'] = nl2br($rw['text']);
		$vars['date'] = str_replace(".","/",substr(u2vaght($rw['date']),0,10));
		$vars['visit'] = number_format($rw['visit']);
		
		if( $rw['tag'] ){
			$tag = $rw['tag'];
			$tag = str_replace("،", ",", $tag);
			$tag = explode(",", $tag);
			if( sizeof($tag) > 0 ){
				foreach( $tag as $k => $r ){
					$tag_arr[] = "<a href='./?q=".urlencode($r)."' >$r</a>";
				}
				$vars['tag'] = "<div class='tag'>کلمات کلیدی: ".implode(" , ", $tag_arr)."</div>";
			}
		}

		if(function_exists("cm_form")){
			$vars['comments'] = "<div class='comments'>";
			$vars['comments'].= cm_list("news");
			$vars['comments'].= cm_form("news");
			$vars['comments'].= "</div>";
		}

		$c.= template_engine('news_display',$vars);

	}

	create_box($rw['name'] , $c, $allow_eval=false, $framed=true, $position="center");

}



