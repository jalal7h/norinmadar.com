<?

function news_meta( $type ){

	if(!$id = $_REQUEST['id']){
		e(__FUNCTION__.__LINE__);

	} else if(!$rw = table("news", $id)){
		e(__FUNCTION__.__LINE__);

	} else {

		switch ( $type ) {

			case 'title':
				return $rw['name'];
			
			case 'kw':
				return $rw['tag'];
			
			case 'desc':
				$desc = $rw['text'];
				$desc = strip_tags( $desc );
				$desc = SUB_STRING( $desc, 0, 1000 );
				$desc = trim( $desc );
				return $desc;
				
		}
		
	}
}


