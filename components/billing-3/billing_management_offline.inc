<?

function billing_management_offline(){
	$url = "./?page=admin&cp=".$_REQUEST['cp']."&func=".$_REQUEST['func'];
	$menu = array(
		$_REQUEST['func']."_list&archive=0" => "لیست پرداخت های تایید نشده" ,
		$_REQUEST['func']."_list&archive=1" => "آرشیو پرداخت ها" ,
		$_REQUEST['func']."_methods" => "روشهای پرداخت" ,
	);
	listmaker_tabmenu( $menu , $url, "func2" );
}


