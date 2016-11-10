<?

# jalal7h@gmail.com
# 2015/10/22
# Version 1.2.1

function userpanel_menu(){
	
	if(!$_SESSION['uid']){
		return true;
	}

	?>
	<style>
		.userpanel_menu > a.current ,
		.userpanel_menu > a:hover {
			background-image: url(<?=imgp('menu-inner-bg.png')?>);
		}
	</style>
	<?

	echo '<div class="userpanel_menu">';
	if(!$_REQUEST['do']){
		foreach($GLOBALS['userpanel_item'] as $_REQUEST['do'] => $name){
			break;
		}
	}
	foreach($GLOBALS['userpanel_item'] as $func => $name){
		echo '<a href="'._URL.'/?page='.$_REQUEST['page'].'&do='.$func.'"'.($_REQUEST['do']==$func?" class=current ":"").'>
			<icon></icon>
			<span>'.$name.'</span>
		</a>';
	}
	echo "</div>";
}

