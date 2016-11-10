<?


function cat_management_ordmove( $id , $operation ){
	if(!$rw = table("cat", $id)){
		e(__FILE__.__LINE__);
	} else {
		$cat = $rw['cat'];
		$parent = $rw['parent'];
		cat_ordfix( $cat, $parent );
		if($operation=="+"){
			$new_ord = $rw['ord'] + 1;
		} else {
			$new_ord = $rw['ord'] - 1;
		}
		$replacemetn_ord = $rw['ord'];
		#
		# check if its on edge
		if(!$rs0 = dbq(" SELECT COUNT(*) FROM `cat` WHERE `cat`='".$cat."' AND `parent`='$parent' AND `ord`='".$new_ord."' LIMIT 1 ")){
			e(__FILE__.__LINE__.dbe());
		} else if(dbr($rs0,0,0)==0){
			// its on edge
			return true;
		} else {
			#
			# havu
			dbq(" UPDATE `cat` SET `ord`='".$replacemetn_ord."' WHERE `cat`='".$cat."' AND `parent`='$parent' AND `ord`='".$new_ord."' LIMIT 1 ");
			#
			# the guy
			dbq(" UPDATE `cat` SET `ord`='".$new_ord."' WHERE `cat`='".$cat."' AND `parent`='$parent' AND `id`='".$id."' LIMIT 1 ");
		}
	}
}

function cat_ordfix( $cat, $parent=0 ){
	if(!$rs = dbq(" SELECT * FROM `cat` WHERE `cat`='$cat' AND `parent`='$parent' ORDER BY `ord` ")){
		e(__FILE__.__LINE__.dbe());
	} else {
		$ord = 1;
		while($rw = dbf($rs)){
			dbq(" UPDATE `cat` SET `ord`='$ord' WHERE `id`='".$rw['id']."' LIMIT 1 ");
			$ord++;
		}
	}
}






