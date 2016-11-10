<?

// orders_basket_addbutton( $rw , $title="خرید کارت تخفیف" );

function orders_basket_addbutton( $rw , $title='خرید کالا' ){
	
	return '<a href="./orders-basket-'.$rw['id'].'" class="orders_basket_addbutton" '.(!$_SESSION['uid']?"onclick='hitbox(\"<center class=orders_basket_addbutton_hitbox ><img src=image.list/order-key.png /><div>برای ثبت درخواست باید ابتدا وارد محیط کاربری خود شوید</div><a href=./login >ورود به محیط کاربری</a></center>\",400,300);return false;'":"").'>
			<icon></icon>
			<span>'.$title.'</span>
		</a>';
}

