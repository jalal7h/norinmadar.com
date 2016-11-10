<?

# jalal7h@gmail.com
# 2015/10/20
# Version 1.0.0

$GLOBALS['do_action'][] = 'is_management_export_save';

function is_management_export_save(){

	if(!admin_logged()){
		die();
	}

	// foreach( $GLOBALS['irtoya_staff_order_of_columns'] as $k => $column ){
	// 	$xl_head[] = lmtc("irtoya_staff:".$column);
	// }
	// $xl[] = $xl_head;

	if(!$rs = dbq(" SELECT * FROM `irtoya_staff` WHERE 1 ORDER BY `id` ASC ")){
		e(__FUNCTION__.__LINE__);
	} else if(!dbn($rs)){
		//
	} else while($rw = dbf($rs)){
		$xl_this = null;
		foreach( $GLOBALS['irtoya_staff_order_of_columns'] as $k0 => $column0 ){
			$xl_this[] = $rw[ $column0 ];
		}
		$xl[] = $xl_this;
	}

	include 'modules/PHPExcel/Excel.php';
	ExcelExport( $xl );
	die();
}

