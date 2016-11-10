<?

# jalal7h@gmail.com
# 2015/00/00
# Version 1.0.0

function is_management_import_save(){
	
	# 
	# the file
	$file_path = $_FILES['irtoya_staff']['tmp_name'][0];
	
	#
	# do import
	include 'modules/PHPExcel/Excel.php';
	$xl = ExcelImport( $file_path );

	if(sizeof($xl)==0){
		;//
	} else {
		dbq(" TRUNCATE TABLE `irtoya_staff` ");
		foreach ($xl as $i => $line) {
			if($i==0){
				continue;
			} else {

				#
				# variables
				foreach ($GLOBALS['irtoya_staff_order_of_columns'] as $k0 => $column) {
					$cols[ $column ] = $line[ $k0 ];
				}

				# 
				# fix null ones
				foreach ($cols as $kc => $rc) {
					if($cols[$kc]==null){
						$cols[$kc] = "";
					}
				}

				$array_of_inserting_codes[] = "0";
				if(!$cols['code']){
					continue;
				} else if(in_array($cols['code'] , $array_of_inserting_codes)){
					continue;
				} else {
					$array_of_inserting_codes[] = $cols['code'];
				}

				#
				# insert
				$q_values[] = " ( '".implode( "','" , $cols )."' ) ";
				$n++;
			}
		}
		foreach ($cols as $k => $r) {
			$fields[] = $k;
		}
		dbq(" INSERT INTO `irtoya_staff` ( `".implode( '`,`', $fields )."` ) VALUES ".implode(',', $q_values)." ");
	}

	echo "<div class='is_management_import_save'>تعداد ".number_format($n)." محصول با موفقیت ثبت شد</div>";
}










