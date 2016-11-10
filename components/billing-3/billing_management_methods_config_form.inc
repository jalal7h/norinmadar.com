<?

function billing_management_methods_config_form(){
	if(!$method = $_REQUEST['method']){
		e(__FUNCTION__.__LINE__);
	} else if(!$rs = dbq(" SELECT * FROM `billing_method` WHERE `method`='$method' LIMIT 1 ")){
		e(__FUNCTION__.__LINE__);
	} else if(!dbn($rs)){
		e(__FUNCTION__.__LINE__);
	} else if(!$rw = dbf($rs)){
		e(__FUNCTION__.__LINE__);
	} else {
		echo "
		<form class='billing_management_methods_config_form' method='post' action='./?page=".$_REQUEST['page']."&cp=".$_REQUEST['cp']."&func=".$_REQUEST['func']."&do=save&method=".$_REQUEST['method']."' >

		<div>
			<span>ضریب واحد پولی</span>
			<input type='text' name='datafield[unit]' value='".$rw['unit']."' />
		</div>

		<div>
			<span>شناسه پایانه</span>
			<input type='text' name='datafield[terminal_id]' value='".$rw['terminal_id']."' />
		</div>
		
		<div>
			<span>نام کاربری</span>
			<input type='text' name='datafield[terminal_user]' value='".$rw['terminal_user']."' />
		</div>
		
		<div>
			<span>گذرواژه</span>
			<input type='text' name='datafield[terminal_pass]' value='".$rw['terminal_pass']."' />
		</div>
		
		<div>
			<span>کد ویژه ۱</span>
			<input type='text' name='datafield[c1]' value='".$rw['c1']."' />
		</div>
		
		<div>
			<span>کد ویژه ۲</span>
			<input type='text' name='datafield[c2]' value='".$rw['c2']."' />
		</div>
		
		<div>
			<span>کد ویژه ۳</span>
			<input type='text' name='datafield[c3]' value='".$rw['c3']."' />
		</div>
		
		<div>
			<span>کد ویژه ۴</span>
			<input type='text' name='datafield[c4]' value='".$rw['c4']."' />
		</div>

		<div>
			<span></span>
			<div style='border-bottom: 1px dotted #ccc; width: 80%; margin: 40px 0 10px 0'></div>
		</div>

		<div>
			<input type='submit' class='submit_button' value='ثبت تغییرات'/>
		</div>
		
		</form>";

		return true;
	}

	return false;
}




