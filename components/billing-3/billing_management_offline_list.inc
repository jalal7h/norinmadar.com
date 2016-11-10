<?

function billing_management_offline_list(){
	
	switch ($_REQUEST['do']) {
		
		case 'remove':
			billing_management_offline_list_remove();
			break;
		
		case 'flag':
			billing_management_offline_list_flag();
			break;
		
		default:
			# code...
			break;
	}

	$list['name'] = 'name-of-list-as-classname';
	$list['query'] = " SELECT * FROM `billing_invoice` WHERE `method` LIKE 'manual%' AND `date`".($_REQUEST['archive']=='0' ?'=0' :'!=0' )." ORDER BY `id` ASC ";
	$list['tdd'] = 12;
	
	$list['paging_url'] = '_URL."/?page=admin&cp=".$_REQUEST["cp"]."&func=".$_REQUEST[\'func\']."&func2=".$_REQUEST[\'func2\']."&archive=".$_REQUEST[\'archive\']';

	$list['remove_url'] = '_URL."/?page=admin&cp=".$_REQUEST["cp"]."&func=".$_REQUEST["func"]."&func2=".$_REQUEST["func2"]."&archive=".$_REQUEST["archive"]."&do=remove&id=".$rw["id"]';
	$list['remove_prompt'] = '"آیا مایل به حذف این پرداخت هستید?"';

	$list['list_array'] = array (
		array("head"=>"کاربر", "content"=>'table("users",$rw["uid"], "name")'),
		array("head"=>"مبلغ", "content"=>'number_format($rw[\'cost\'])." ".tab__temp("money_unit")','attr'=>array('align'=>'center')),
		array("head"=>"بانک", "content"=>'table("billing_method",$rw["method"],"c1","method")'),
		array("head"=>"تاریخ", "content"=>'substr(U2Vaght( ($rw[\'date\']==0 ?_bmol_separate($rw[\'transaction\'],0) :$rw[\'date\']) ),0,10)','attr'=>array('align'=>'center','dir'=>'ltr')),
		array("head"=>"شماره تراکنش / سریال", "content"=>'( $rw[\'date\']==0 ?_bmol_separate($rw[\'transaction\'],1) :$rw[\'transaction\'] )','attr'=>array('align'=>'center','dir'=>'ltr')),
	);

	if($_REQUEST['archive']==0){
		$list['setflag_url'] = '_URL."/?page=admin&cp=".$_REQUEST["cp"]."&func=".$_REQUEST["func"]."&func2=".$_REQUEST["func2"]."&archive=".$_REQUEST["archive"]."&do=flag&id=".$rw["id"]';
	}
	// $list['linkTo'][] = array(
	// 	'url' => '_URL."/?page=".$_REQUEST["page"]."&cp=".$_REQUEST["cp"]."&func=tour_management_list&p=".$_REQUEST["p"]."&do=setHotel&id=".$rw["id"]',
	// 	'name' => 'هتلها',
	// 	'width' => 35,
	// );
	
	if(!$rs0 = dbq(" SELECT DISTINCT `method` FROM `billing_invoice` WHERE `method` LIKE 'manual%' ")){
		e(__FUNCTION__.__LINE__);
	} else if(!dbn($rs0)){
		//
	} else {
		while($rw0 = dbf($rs0)){
			$bank_str_offline_options.= "<option value='".$rw0['method']."'>".table('billing_method',$rw0['method'],'c1','method')."</option>";
		}
		$list['paging_select'] = array(
			'method' => "<option value=''>بانک</option>".$bank_str_offline_options,
		);
	}

	echo listmaker_list($list);
}




function _bmol_separate( $tr , $part_numb ){
	$part[0] = substr( strrchr($tr,":") , 1 ); // date
	$part[1] = substr( $tr, 0, -1*(strlen($part[0])+1) ); // transaction

	return $part[$part_numb];
}












