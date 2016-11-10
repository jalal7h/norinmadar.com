<?

# jalal7h@gmail.com
# 2015/10/22
# Version 1.2.4

/************
	$list['name'] = 'some-name-for-class';
	$list['head'] = 'آخرین ها';
	$list['tdd'] = 12;
	$list['quiet_if_empty'] = true;
	$list['exclude_in_query'] = true;
	$list['progressive'] = true;
	$list['query'] = " SELECT * FROM `dastedo` WHERE 1 ORDER BY `id` DESC ";
	$list['target_url'] = '_URL."/dastedo-".$rw["id"]."-".name_for_link($rw["name"]).".html"';
	$list['target_blank'] = false;
	$list['paging_url'] = '_URL."/?page=".$_REQUEST["page"]."&q=".$_REQUEST["q"]."&dpl=';
	$list['pattern'] = '"<img src=\'".$rw["pic"]."\' /><div class=\'name\'>".$rw["name"]."</div>"';
	$list['search'] = array("name");

	echo listmaker_showcase($list);
*************/

function listmaker_showcase($list){

	#
	# paging
	if($paging_url = trim($list['paging_url'])){
		#
		# bake the paging url
		eval("\$paging_url = $paging_url;");
		
		#
		# page number field
		if($list['page_number_field']!=''){
			$page_number_field = $list['page_number_field'];
		} else {
			$page_number_field = $paging_url;
			if(strstr($page_number_field, "=%%")){
				$page_number_field = explode("=%%", $page_number_field);
				$page_number_field = $page_number_field[0];
				$page_number_field = strrev($page_number_field);
				$page_number_field = explode("&", $page_number_field);
				$page_number_field = $page_number_field[0];
				$page_number_field = strrev($page_number_field);
			} else if(substr(strrev($page_number_field), 0, 1)=="="){
				$page_number_field = strrev($page_number_field);
				$page_number_field = explode("&", $page_number_field);
				$page_number_field = $page_number_field[0];
				$page_number_field = strrev($page_number_field);
				$page_number_field = explode("=", $page_number_field);
				$page_number_field = $page_number_field[0];
			} else {
				$page_number_field = "p";
			}
		}
		// e("list: ".$page_number_field);
		$p = intval($_REQUEST[$page_number_field]);
	}

	# 
	# fix initial query
	if(!stristr($list['query'], " WHERE ")){
		if(stristr($list['query'], " ORDER ")){
			$list['query'] = explode(" ORDER ", $list['query']);
			$list['query'][0].= " WHERE 1 ";
			$list['query'] = implode(" ORDER ", $list['query']);
		} else {
			$list['query'].= " WHERE 1 ";
		}
	}
	if(!stristr($list['query'], " ORDER ")){
		$list['query'].= " ORDER BY `id` DESC ";
	}

	#
	# exclude in query
	if($list['exclude_in_query'] and sizeof($GLOBALS['exclude_in_query'])){
		$list['query'] = explode(' WHERE ', $list['query']);
		$list['query'][1] = " `id` NOT IN (".implode(",", $GLOBALS['exclude_in_query']).") AND ".$list['query'][1];
		$list['query'] = implode(" WHERE ", $list['query']);
	}
	
	#
	# making content for paging c
	if($list['paging_select']){
		foreach($list['paging_select'] as $paging_select_name => $paging_select_value){
			$add_to_end_of_url.= "&".$paging_select_name."=".$_REQUEST[$paging_select_name];
			if(intval($_REQUEST[$paging_select_name])!=0){
				$paging_select_query.=" `$paging_select_name`='".$_REQUEST[$paging_select_name]."' AND ";
			}
		}
		$list['query'] = str_ireplace(" WHERE "," WHERE $paging_select_query ", $list['query']);
		
		$paging_url.= $add_to_end_of_url;
		foreach($list['paging_select'] as $paging_select_name => $paging_select_value){
			$rand = rand(10000,99999);
			$select_url = $paging_url;
			$select_url = str_replace('&'.$paging_select_name.'=','&nt=',$select_url);
			$select_url = str_replace('&'.$page_number_field.'=','&nt=',$select_url);
			$paging_c.= "
			<div id='paging_select".$rand."' class='paging_select'>
			<select onchange=\"location.href='".$select_url."&".$paging_select_name."='+this.value;\" >
				".(strstr($paging_select_value," value=''")?"":"<option value=''></option>")."
				$paging_select_value
			</select>
			</div>
			<script>$('#paging_select".$rand." select').val('".$_REQUEST[$paging_select_name]."')</script>
			";
		}
	}

	#
	# add search parameter in QUERY, and also in URL
	if($list['search']){
		if($q = $_REQUEST['q']){
			// $add_to_end_of_url.= "&q=".$q;
			$search_query.= " ( ";
			foreach ($list['search'] as $k => $field) {		
				$search_query.= " `".$field."` LIKE '%".$q."%' OR ";
			}
			$search_query.= "0) AND ";
		}
		if($search_query!=''){
			$list['query'] = str_ireplace(" WHERE "," WHERE ".$search_query." ", $list['query']); // *
		}
	}

	# 
	# query
	$tdd = ($list['tdd']>0?$list['tdd']:10);
	$stt = $tdd * $p;
	$list['query'].= " LIMIT $stt,$tdd ";
	if(!$rs = dbq($list['query'])){
		e("err ".__LINE__);
		e($list['query']);
	} else if(!dbn($rs)){
		if($list['quiet_if_empty']){
			return false;
		} else {
			$c.= "<div class='convbox' >موردی یافت نشد.</div>";
		}
		$c.= $paging_c;
	} else {
		$c.= "<div class='listmaker_showcase".($list['name']?" ".$list['name']:"")."' >";
		if($list['head']){
			$c.= "<div class='head'>".$list['head']."</div>";
		}
		if($list['progressive']){
			$c.= $paging_c;
		}
		while($rw = dbf($rs)){
			#
			# put into exclude-queue
			if($list['exclude_in_query']){
				$GLOBALS['exclude_in_query'][] = $rw['id'];
			}
			#
			# bake the target url
			if($target_url = trim($list['target_url'])){
				eval("\$target_url = $target_url;");
			}
			#
			# bake the content
			$content = $list['pattern'];
			eval("\$content = $content;");
			
			$c.= "<a class='r' href='".$target_url."' ".($list['target_blank']?'target="_blank"':'').">\n";
			$c.= $content;
			$c.= "\n</a>\n\n";
		}
		$c.= "</div>";
		
		if($list['progressive']){
			if(dbn($rs) < $tdd){
				$end = "done";
			}
			if($end!="done"){
				$p++;
				$rand = rand(100000,999999);
				$id = "listmaker_showcase_inv_".$rand."_".$p;
				$c.= "<div id='".$id."' rel='".$p."' >
				<center><img style='margin: 20px 0 60px 0' src='".imgp("loading001.gif")."' /></center>
				</div>
				<script>$(document).ready(function(){
					$('#".$id."').one('inview', function() {
						var p = $(this).attr('rel');
						wget( './' , '".$id."' , 'do_action=".$list['name']."&".$page_number_field."='+p );
					});
				});
				</script>";
			}
		} else {
			$c.= $paging_c;
			#
			# paging
			if($paging_url){
				// e('__link: '.$paging_url);
				$c.= listmaker_paging($list['query'], $paging_url, $tdd);
			}
		}
	}
	
	return $c;
}









