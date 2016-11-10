<?

function texty( $name , $content=null ){
	if($content){
		if(!$rs0 = dbq(" SELECT * FROM `texty` WHERE `name`='".$name."' LIMIT 1 ")){
			e(__FUNCTION__." : ".__LINE__);
		} else if(dbn($rs0)==1){ // update
			if(!dbq(" UPDATE `texty` SET `content`='".$content."' WHERE `name`='".$name."' LIMIT 1 ")){
				e(__FUNCTION__." : ".__LINE__);
			}
		} else { // insert
			if(!dbq(" INSERT INTO `texty` (`name`,`content`) VALUES ('".$name."','".$content."') ")){
				e(__FUNCTION__." : ".__LINE__);
			}
		}
	}
	if(!$rs = dbq(" SELECT `content` FROM `texty` WHERE `name`='".$name."' LIMIT 1 ")){
		e(__FUNCTION__." : ".__LINE__);
	} else if(dbn($rs)!=1){
		e(__FUNCTION__." : ".__LINE__);
	} else {
		return dbr($rs,0,0);
	}

	return false;
}
