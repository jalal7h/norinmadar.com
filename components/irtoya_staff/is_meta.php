<?

function is_meta( $type ){

	if(!$id = $_REQUEST['id']){
		e(__FUNCTION__.__LINE__);

	} else if(!$rw = table("irtoya_staff", $id)){
		e(__FUNCTION__.__LINE__);

	} else {

		switch ( $type ) {

			case 'title':
				return $rw['name']." ".$rw['brand_fa'].",".$rw['model_fa'];
			
			case 'kw':
				foreach ($GLOBALS['irtoya_staff_order_of_columns'] as $k => $column){
					if($rw[$column] = trim($rw[$column])){
						if( $column=="desc" or $column=="price" ){
							continue;
						}
						$c[] = $rw[ $column ];
					}
				}
				return implode(',', $c);
			
			case 'desc':
				return $rw['desc'];
				
		}
		
	}
}


