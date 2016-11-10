<?

function orders_management_list( $list_type ){
	
	#
	# action
	switch($_REQUEST['do']){
		
		case 'view':
			return orders_management_viewitem();

		case 'remove' :
			orders_management_list_remove();
			break;
			
		case 'sent' :
			orders_management_list_sent();
			break;

		case 'payment' :
			orders_management_list_paymentform();
			return true;

		case 'save_payment':
			orders_management_list_paymentsave();
			break;
	}

	#
	# setting flags
	if( $list_type=='notsent-paid' ){
		$payment_link_flag = false;
		$sending_link_flag = true;
		$list['query'] = " SELECT * FROM `orders` WHERE `date_sent`=0 and `date_paid`>0 ORDER BY `date` ASC ";
	} else if( $list_type=='notsent-notpaid' ){
		$payment_link_flag = true;
		$sending_link_flag = true;
		$list['query'] = " SELECT * FROM `orders` WHERE `date_sent`=0 and `date_paid`=0 ORDER BY `date` ASC ";
	} else if( $list_type=='sent-notpaid' ){
		$payment_link_flag = true;
		$sending_link_flag = false;
		$list['query'] = " SELECT * FROM `orders` WHERE `date_sent`>0 and `date_paid`=0 ORDER BY `date` ASC ";
	} else if( $list_type=='sent-paid' ){
		$payment_link_flag = false;
		$sending_link_flag = false;
		$list['query'] = " SELECT * FROM `orders` WHERE `date_sent`>0 and `date_paid`>0 ORDER BY `date` DESC ";
	}

	# 
	# preparing variables for list
	$list['name'] = 'orders_management_list';
	$list['target_url'] = '_URL."/?page=".$_REQUEST["page"]."&cp=".$_REQUEST["cp"]."&func=".$_REQUEST["func"]."&do=view&id=".$rw["id"]';
	$list['paging_url'] = '_URL."/?page=".$_REQUEST["page"]."&cp=".$_REQUEST["cp"]."&func=".$_REQUEST["func"]';
	$list['remove_url'] = '_URL."/?page=".$_REQUEST["page"]."&cp=".$_REQUEST["cp"]."&func=".$_REQUEST["func"]."&do=remove&id=".$rw["id"]';
	$list['remove_prompt'] = '"آیا مایل به حذف این مورد هستید?"';
	
	$list['list_array'][] = array(	
		"head" => "#",
		"content" => '$rw[\'id\']',
		"attr" => array("align" => 'center',"dir" => "rtl")
	);
	$list['list_array'][] = array(	
		"head" => "نام مشتری",
		"content" => 'table("users", $rw[\'uid\'], "name")',
		"attr" => array("align" => 'right',"dir" => "rtl")
	);
	$list['list_array'][] = array(	
		"head" => "شماره تماس",
		"content" => '$rw[\'tell\']',
		"attr" => array("align" => 'center',"dir" => "ltr")
	);
	$list['list_array'][] = array(	
		"head" => "ثبت سفارش",
		"content" => 'substr(U2Vaght($rw[\'date\']),0,19)',
		"attr" => array("align" => 'center',"dir" => "ltr")
	);
	if(!$payment_link_flag){ // pardakht shode
		$list['list_array'][] = array(	
			"head" => "پرداخت",
			"content" => 'substr(U2Vaght($rw[\'date_paid\']),0,19)',
			"attr" => array("align" => 'center',"dir" => "ltr")
		);
	}
	if(!$sending_link_flag){
		$list['list_array'][] = array(	
			"head" => "ارسال",
			"content" => 'substr(U2Vaght($rw[\'date_sent\']),0,19)',
			"attr" => array("align" => 'center',"dir" => "ltr")
		);
	}
	$list['list_array'][] = array(	
		"head" => "میلغ فاکتور",
		"content" => 'number_format(dbr(dbq("SELECT SUM(`count` * `unitcost`) as sum0 FROM `orders_item` WHERE `order_id`=\'".$rw[\'id\']."\' "),0,0))." تومان"',
		"attr" => array("align" => 'center',"dir" => "rtl")
	);

	$list['list_array'][] = array(	
		"head" => "تعداد",
		"content" => 'number_format(dbr(dbq("SELECT SUM(`count`) as sum0 FROM `orders_item` WHERE `order_id`=\'".$rw[\'id\']."\' "),0,0))." قلم"',
			"attr" => array("align" => 'center',"dir" => "rtl")
	);
	
	if($payment_link_flag){ // pardakht nashode
		$list['linkTo'][] = array(
			'url' => '_URL."/?page=".$_REQUEST["page"]."&cp=".$_REQUEST["cp"]."&func=".$_REQUEST["func"]."&p=".$_REQUEST["p"]."&do=payment&id=".$rw["id"]',
			'name' => 'پرداخت',
			'width' => 86,
		);
	}

	if($sending_link_flag){ // ersal nashode
		$list['linkTo'][] = array(
			'url' => '_URL."/?page=".$_REQUEST["page"]."&cp=".$_REQUEST["cp"]."&func=".$_REQUEST["func"]."&p=".$_REQUEST["p"]."&do=sent&id=".$rw["id"]',
			'name' => 'ارسال',
			'width' => 70,
		);
	}
	
	echo listmaker_list($list);
}

