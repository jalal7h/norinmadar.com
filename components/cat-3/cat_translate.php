<?

function cat_translate($id){
	if(!$rs = dbq(" SELECT `name` FROM `cat` WHERE `id`='$id' LIMIT 1 ")){
		echo "err".__LINE__;
	} else if(dbn($rs)!=1){
		;//echo "Err - ".__LINE__;
		return "NuN:$id";
	} else {
		return dbr($rs,0,0);
	}
}


