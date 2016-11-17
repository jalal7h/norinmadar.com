<?
$GLOBALS['userpanel_item']['users_logout'] = 'خروج';

if( $_REQUEST['page'] == '14' and $_REQUEST['do'] == 'users_logout' ){
	$_REQUEST['do_action'] = 'users_logout';
}