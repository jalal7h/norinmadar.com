<?

# jalal7h@gmail.com
# 2015/10/17
# Version 1.3.3

// $url = "./?page=admin&cp=".$_REQUEST['cp'];
// $menu = array(
// 	"ms_management_list" => "لیست موبایل ها",
// 	"ms_management_form" => "ثبت موبایل جدید",
// 	"cat_management&l=brand" => "برندها",
// 	"cat_management&l=stuff_status" => "وضعیت ها",
// 	"cat_management&l=mobile_sim" => "سیم ها",
// 	"cat_management&l=mobile_os" => "سیستم عامل ها",
// 	"cat_management&l=mobile_browser" => "مرورگر",
// );
// listmaker_tabmenu($menu,$url);

function listmaker_tabmenu( $menu , $url , $func_k="func" ){
	if(!$_REQUEST['do']){
		$_REQUEST['do']=2;
	}
	?>
	<div class="listmaker_tabmenu_line" ></div>
	<div class="listmaker_tabmenu" dir=rtl>
		<?
		foreach($menu as $func => $title){
			$func_list[] = $func;
			if(!$title){
				continue;
			}
			if(!$_REQUEST[$func_k]){
				$_REQUEST[$func_k] = $func;
			}
			#
			# what to do for func like : "ms_management_cat&cat=brand"
			$func_main_switch = substr($func,0,strlen($_REQUEST[$func_k]));
			if($func!=$func_main_switch){
				$func_sub_switch = substr($func, strlen($func_main_switch)+1);
				$func_sub_switch = explode("&", $func_sub_switch);
				$func_sub_switch = $func_sub_switch[0];
				$func_sub_switch = explode("=", $func_sub_switch);
				$func_sub_switch_k = $func_sub_switch[0];
				$func_sub_switch_v = $func_sub_switch[1];
			} else {
				$func_sub_switch_k = "";
				$func_sub_switch_v = "";
			}
			echo (
				($_REQUEST[$func_k]==$func_main_switch and $_REQUEST[$func_sub_switch_k]==$func_sub_switch_v)
					?'<a class="listmaker_tabmenu_current" '
					:'<a class="listmaker_tabmenu_normal" '
			).' href="'.$url.'&'.$func_k.'='.$func.'">'.$title.'</a>';
		}
		?>
	</div>
	<div class="listmaker_tabmenu_down"></div>
	<?
	if($func = $_REQUEST[$func_k]){
		if(strstr($func, "&")){
			$func = explode("&", $func);
			$func = $func[0];
		}
		if(function_exists($func)){
			call_user_func($func);
		} else {
			echo "invalid function ".$func;
		}
	}
}






