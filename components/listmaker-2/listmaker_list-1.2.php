<?

# jalal7h@gmail.com
# 2015/10/15
# Version 1.2.8

/************

	$list['name'] = 'name-of-list-as-classname';
	$list['query'] = " SELECT * FROM `hotel` WHERE 1 ORDER BY `name` ASC ";
	$list['tdd'] = 12;

	$list['target_url'] = '_URL."/?page=".$_REQUEST["page"]."&cp=".$_REQUEST["cp"]."&func=".$_REQUEST["cp"]."_form&id=".$rw["id"]';
	
	$list['paging_url'] = '_URL."/?page=".$_REQUEST["page"]."&cp=".$_REQUEST["cp"]."&func=".$_REQUEST["func"]';
	$list['page_number_field'] = "p0";

	$list['remove_url'] = '_URL."/?page=".$_REQUEST["page"]."&cp=".$_REQUEST["cp"]."&func=".$_REQUEST["func"]."&do=remove&id=".$rw["id"]';
	$list['remove_prompt'] = '"آیا مایل به حذف مورد به نام ".$rw["name"]." هستید?"';

	$list['setflag_url'] = '_URL."/?page=".$_REQUEST["page"]."&cp=".$_REQUEST["cp"]."&func=".$_REQUEST["func"]."&do=active&id=".$rw["id"]';
	$list['tr_color_identifier'] = '$rw["active"]';

	$list['list_array'] = array (
		array("head"=>"عکس", "tag"=>"th", "picture" => '$rw[\'pic\']'),
		array("content" => '$rw[\'visit\']." بازدید"' ,"attr" => array("align" => 'center',"dir" => "rtl")),
	);
	
	$list['exclude_in_query'] = true;

	$list['linkTo'][] = array(
		'url' => '_URL."/?page=".$_REQUEST["page"]."&cp=".$_REQUEST["cp"]."&func=tour_management_list&p=".$_REQUEST["p"]."&do=setHotel&id=".$rw["id"]',
		'name' => 'هتلها',
		'width' => 35,
	);
	
	$list['paging_select'] = array(
		'cityId' => "<option value=''>استان » شهر</option>".city_options($array=false),
		'maghta' => "<option value=''>مقطع تحصیلی</option>".cat_display('maghta',$is_array=false,$parent=0,$optionPreStr=""),
		'group' => "<option value=''>گروه شغلی</option>".cat_display('group',$is_array=false,$parent=0,$optionPreStr=""),
		'jensiat' => "<option value=''>جنسیت</option>".cat_display('jensiat',$is_array=false,$parent=0,$optionPreStr=""),
		
	);
	
	$list['search'] = array("name");

	echo listmaker_list($list);

*************/

function listmaker_list($list){

	#
	# height
	if(!$list['height']){
		$list['height'] = 50;
	}

	#
	# the tag
	$tag = ($list['tag']=='th'?'th':'td');

	#
	# paging
	if($paging_url = trim($list['paging_url'])){
		
		#
		# bake the paging url
		eval("\$paging_url = $paging_url;");

		#
		# page number field and value of the `P`
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
		$p = intval($_REQUEST[$page_number_field]);
	}

	# 
	# fix initial query
	# when there is no WHERE and ORDER, but its needed
	if(!stristr($list['query'], " WHERE ")){
		if(stristr($list['query'], " ORDER ")){
			$list['query'] = explode(" ORDER ", $list['query']);
			$list['query'][0].= " WHERE 1 ";
			$list['query'] = implode(" ORDER ", $list['query']);
		} else {
			$list['query'].= " WHERE 1 ";
		}
	}
	// if(!stristr($list['query'], " ORDER ")){
	// 	$list['query'].= " ORDER BY `id` DESC ";
	// }
	
	#
	# exclude in query
	if($list['exclude_in_query'] and sizeof($GLOBALS['exclude_in_query'])){
		$list['query'] = explode(' WHERE ', $list['query']);
		$list['query'][1] = " `id` NOT IN (".implode(",", $GLOBALS['exclude_in_query']).") AND ".$list['query'][1];
		$list['query'] = implode(" WHERE ", $list['query']);
	}

	# 
	# make the limit stt tdd
	$tdd = ($list['tdd']>0?$list['tdd']:10);
	$stt = $tdd * $p;
	$list['query'].= " LIMIT $stt,$tdd ";
	$remove_prompt = "آیا مایل به حذف این ردیف هستید؟";
	
	#
	# add search parameter in QUERY, and also in URL
	if($list['search']){
		if($q = $_REQUEST['q']){
			$add_to_end_of_url.= "&q=".$q;
			$search_query.= "(";
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
	#  the select-boxes.
	if($list['paging_select']){
		#
		# processing paging-select parameters
		foreach($list['paging_select'] as $paging_select_name => $paging_select_value){
			#
			# add the paging select to URL
			$add_to_end_of_url.= "&".$paging_select_name."=".$_REQUEST[$paging_select_name];
			#
			# collect the paging select parameters for query
			if(intval($_REQUEST[$paging_select_name])!=0){
				$paging_select_query.=" `$paging_select_name`='".$_REQUEST[$paging_select_name]."' AND ";
			}
		}
		#
		# use paging select query parameters in QUERY
		$list['query'] = str_ireplace(" WHERE "," WHERE ".$paging_select_query." ", $list['query']); // *

		# 
		# adding the select-box params to end of paging-url
		# remembering the filters to page-links 
		if(strstr($paging_url, "?")){
			$paging_url = explode("?", $paging_url);
			$paging_url[1] = $add_to_end_of_url."&".$paging_url[1]; // *
			$paging_url = implode("?", $paging_url);
			$paging_url = str_replace("?&", "?", $paging_url);
			$paging_url = str_replace("&&", "&", $paging_url);
		} else {
			$paging_url.= "?".$add_to_end_of_url;
		}

		#
		# html content of paging-select tags
		# this will displaied in footer of list
		foreach($list['paging_select'] as $paging_select_name => $paging_select_value){
			$rand = rand(10000,99999);
			$select_url = $paging_url;
			$select_url = str_replace('&'.$paging_select_name.'=','&nt=',$select_url);
			$select_url = str_replace('&'.$page_number_field.'=','&nt=',$select_url);
			$paging_select_c.= "
			<div id='paging_select".$rand."' class='paging_select'>
			<select onchange=\"location.href='".$select_url."&".$paging_select_name."='+this.value;\" >
				".(strstr($paging_select_value," value=''")?"":"<option value=''></option>")."
				$paging_select_value
			</select>
			</div>
			<script>$('#paging_select".$rand." select').val('".$_REQUEST[$paging_select_name]."')</script>";
		}
	}

	#
	# try to query mysql
	if(!$rs = dbq($list['query'])){
		e(__FUNCTION__." : ".__LINE__);
		e($list['query']);
	} else if(!dbn($rs)){
		$c.= "<div class='listmaker_list-no-record-found' >موردی یافت نشد.</div>";
		$c.= $paging_select_c;
	} else {

		#
		# textbox for search if needed
		if($list['search']){
			$c.= "<form class='listmaker_list_search' action='".$paging_url."' method='post'><input placeholder='...' type='text' name='q' value='".$_REQUEST['q']."'></form>";
		}
		$c.= '<table class="listmaker_list boxborder'.($list['name']?" ".$list['name']:"").'" cellpadding="10" cellspacing="5" >';

		#
		# head
		foreach($list['list_array'] as $k => $th){
			if($th['head']){
				$display_head = true;
			}
		}
		if($display_head){
			$c.= "<tr class='listmaker_list_head' >";
			$clspan = 0;
			foreach($list['list_array'] as $k => $th){
				$c.= "<th>".$th['head']."</th>";
				$clspan++;
			}
			if($list['remove_url'] or $list['setflag_url']){
				$c.= "<th></th>";
				$clspan++;
			}
			$c.= "</tr>";
			$c.= "<tr class=listmaker_list_head_footer ><td colspan=$clspan ></td></tr>";
		}
		
		#
		# td
		while($rw = dbf($rs)){
			
			#
			# put into exclude-queue
			if($list['exclude_in_query']){
				$GLOBALS['exclude_in_query'][] = $rw['id'];
			}
			
			#
			# TR bgcolor
			if($list['tr_color_identifier']){
				$tr_color_identifier = $list['tr_color_identifier'];
				eval("\$tr_color_identifier = $tr_color_identifier;");
			} else {
				$tr_color_identifier = 1;
			}
			
			#
			# bake the target url
			if($target_url = trim($list['target_url'])){
				eval("\$target_url = $target_url;");
			}
			if(strstr($target_url, "?")){
				if(!strstr($target_url, "&".$page_number_field."=")){
					$target_url.= "&".$page_number_field."=".$p;
				}
				$target_url.= $add_to_end_of_url;
			} else {
				$target_url.= "?".substr($add_to_end_of_url,1);
			}
			
			#
			# bake the remove url
			if($remove_url = trim($list['remove_url'])){
				eval("\$remove_url = $remove_url;");
			}
			if(!strstr($remove_url, "&".$page_number_field."=")){
				$remove_url.= "&".$page_number_field."=".$p;
			}
			$remove_url.= $add_to_end_of_url;
			
			#
			# bake the setflag url
			if($setflag_url = trim($list['setflag_url'])){
				eval("\$setflag_url = $setflag_url;");
			}
			if(!strstr($setflag_url, "&".$page_number_field."=")){
				$setflag_url.= "&".$page_number_field."=".$p;
			}
			$setflag_url.= $add_to_end_of_url;
			
			#
			# opening new TR
			$c.= "<tr class='listmaker_list_record ".($tr_color_identifier==0?"listmaker_list_record_inactive":"")."' onc".($list['target_url']?"":"0")."lick='".($list['target_blank']?"location.target=\"_blank\";":"")."if(intoolstd!=\"in\")location.href=\"$target_url\";' >";

			$clspan0++;
			foreach($list['list_array'] as $k => $td){
				
				#
				# picture cell
				if($td['picture']){
					$picture = $td['picture'];
					eval("\$picture = ".$picture.";");
					$attr_str = "class='listmaker_list_picture' width=".$list['height']."px ";
				} else {
					$attr_str = "";
				}
				
				#
				# bake all values in td attr
				if(sizeof($td['attr']) > 0){
					foreach($td['attr'] as $attr => $value){
						if(!trim($value)){
							continue;
						} else {
							#
							# bake the attr value
							if(strstr(str_replace(array('$',')'),'$',$value),"$")){
								eval("\$value = ".$value.";");
							}
							$attr_str.= " ".$attr."='$value'";
						}
					}
				}

				#
				# tag display
				$c.= "<$tag $attr_str >";
				$td['content'] = trim($td['content']);
				if($td['content']){
					eval("\$content = ".$td['content'].";");
					$c.= $content;
				} else if($td['picture']){
					$c.= "<img src='$picture' style='height:".$list['height']."px; width:".$list['height']."px' />";
				}
				$c.= "</$tag>";
				$clspan0++;
			}

			#
			# tools TD width
			$url_td_width = 27;
			if($list['remove_url'] and $list['setflag_url']){
				// e(__LINE__);
				$url_td_width = 66;
			} else {
				// e(__LINE__);
				$url_td_width = 33;
			}
			if(sizeof($list['linkTo'])){
				foreach($list['linkTo'] as $linkTo){
					if($linkTo['width']){
						$url_td_width += $linkTo['width'];
					} else {
						$url_td_width += 25;
					}
				}
			}

			#
			# tools TD display
			if($list['remove_url'] or $list['setflag_url'] or sizeof($list['linkTo'])){
				$c.= "<td width=".$url_td_width."px class='tools-td' >";
				if($list['remove_url']){
					if($list['remove_prompt']){
						$remove_prompt = $list['remove_prompt'];
						eval("\$remove_prompt = $remove_prompt;");
					}
					$c.= "<a title='حذف' class='remove' onclick='if(!confirm(\"".$remove_prompt."\"))return false;' href='$remove_url' >x</a>";
				}
				if($list['setflag_url']){
					$c.= "<a class='setflag' href='$setflag_url' >
					<img src='image.list/listmaker_check59.png' /></a>";
				}
				if(sizeof($list['linkTo'])){
					foreach($list['linkTo'] as $linkTo){
						eval("\$linkTo_url = ".$linkTo['url'].";");
						$c.= "<a class='linkTo' href='$linkTo_url' >".$linkTo['name']."</a>";
					}
				}
				$c.= "</td>";
				$clspan0++;
			}

			#
			# closing this TR
			$c.= "</tr>";
		}

		#
		# closing the list
		$c.= "</table>";
		
		#
		# attaching the select-boxes
		$c.= $paging_select_c;
		
		#
		# paging
		if($paging_url){
			// e('__link: '.$paging_url);
			$c.= listmaker_paging($list['query'], $paging_url, $tdd);
		}

	}
	
	return $c;
}









