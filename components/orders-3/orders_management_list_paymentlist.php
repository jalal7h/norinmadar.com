<?

function orders_management_list_paymentlist($order_id){
	switch($_REQUEST['do2']){
		case 'remove':
			dbq(" UPDATE `orders` SET `date_paid`='0' WHERE `id`='$order_id' LIMIT 1 ");
			dbq(" DELETE FROM `billing_invoice` WHERE `id`='".intval($_REQUEST['id'])."' AND `order_id`='$order_id' LIMIT 1 ");
			break;
	}
	$list['remove_url'] = '_URL."/?page=".$_REQUEST["page"]."&cp=".$_REQUEST["cp"]."&func=".$_REQUEST["func"]."&do=".$_REQUEST["do"]."&id=".$_REQUEST["id"]."&do2=remove&payment_id=".$rw["id"]';
	$list['remove_prompt'] = '"آیا مایل به حذف این پرداخت هستید?"';
	$list['query'] = " SELECT * FROM `billing_invoice` WHERE `order_id`='$order_id' AND `date`>'0' ";
	$list['list_array'][] = array(	
		"head" => "تاریخ",
		"content" => 'substr(U2Vaght($rw[\'date\']),0,19)',
		"attr" => array("align" => 'center',"dir" => "ltr")
	);
	$list['list_array'][] = array(	
		"head" => "مبلغ",
		"content" => 'number_format($rw[\'cost\'])." تومان"',
		"attr" => array("align" => 'left',"dir" => "rtl")
	);
	$list['list_array'][] = array(	
		"head" => "نوع پرداخت",
		"content" => 'cat_translate($rw[\'method\'])',
		"attr" => array("align" => 'center',"dir" => "rtl")
	);
	$list['list_array'][] = array(	
		"head" => "شماره سریال",
		"content" => '$rw[\'transaction\']',
		"attr" => array("dir" => "rtl")
	);

	echo listmaker_list($list);
}

