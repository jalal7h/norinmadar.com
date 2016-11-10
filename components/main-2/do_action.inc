<?

function do_action(){
	
	if($_REQUEST['covered']=='1'){
		f_front__f_html__header();
		echo "
		<style>
		body{
			background:#fff url('00');
		}
		</style>
		";
	}
	
	if(!$_REQUEST['do_action']){
		return false;
	} else foreach($GLOBALS['do_action'] as $k=>$do_action){
		if($do_action==$_REQUEST['do_action']){
			call_user_func($do_action);
			break;
		}
	}
	die();
	if($_REQUEST['covered']=='1'){
		f_front__f_html__footer();
	}
	die();
}

