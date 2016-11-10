<?

# jalal7h@gmail.com
# 2015/09/09
# Version 1.1.1

# print_r( cat_display('cat') );
# echo cat_display('cat', false );
# ff(array('گروه','n:cat*'=>$tapk,'option'=>cat_display('cat'),'inDiv')).

function cat_display( $cat , $is_array=true , $parent=0 , $str="" ){
	$query = " SELECT * FROM `cat` WHERE `cat`='$cat' AND `parent`='$parent' ORDER BY `ord` ";
	if(!$rs = dbq($query)){
		echo "err - ".__LINE__;
	} else if(!dbn($rs)){
		if($is_array){
			return array('id'=>$parent , 'str'=>$str);
		} else {
			return "<option value='$parent' >$str</option>";
		}
	} else while($rw = dbf($rs)){
		$c0 = cat_display($cat, $is_array, $rw['id'], ($str?$str." » ":"").$rw['name']);
#		if(!is_array($c0)){
#			continue;
#		} else 
		if(@ $c0['str']==''){
			continue;
		} else if($is_array){
			$GLOBALS['cat_display-array-'.$cat][$c0['id']] = $c0['str'];
		} else {
			$c.= $c0;
		}
	}
	
	if($parent==0 and $is_array){
		return $GLOBALS['cat_display-array-'.$cat];
	} else {
		return $c;
	}
}


