<?php

function f_admin__a_html__header(){
	?>
	<html>
	<head>
		<title>.:: <?=tab__temp('main_title')?> - Administrator ::.</title>
		<link rel="shortcut icon" href="image.list/favicon.ico" >
		<META http-equiv=Content-Type content="text/html; charset=utf-8">
		
		<script type="text/javascript" src="modules/jquery/jquery-1.7.1.min.js"></script>

		<!-- jqueryUI -->
		<script src="modules/jqueryUI/jquery-ui-1.11.4/jquery-ui.min.js"></script>
		<link rel="stylesheet" href="modules/jqueryUI/jquery-ui-1.11.4/jquery-ui.min.css">
		<!---->
		
		<!-- datepicker -->
		<script type="text/javascript" src="modules/jqueryUI/datepicker.fa/jquery.ui.datepicker-cc.all.min.js"></script>
		<!---->
			
		<!-- font-awesome -->
		<link rel="stylesheet" href="modules/font-awesome-4.6.1/css/font-awesome.min.css">
		<!---->
		
		<link href="templates/<?=_THEME?>/css/template-admin.css" rel="stylesheet" type="text/css" />
		<link href="./styles-admin.css" rel="stylesheet" type="text/css" />
		<script src="./scripts-admin.js"></script>

	</head>
	<body leftmargin="0" topmargin="0" rightmargin="0" downmargin="0" marginheight="0" marginwidth="0">
	<?
}

function f_admin__a_html__top(){
	?>
	<table height="100%" width="100%" cellpadding="0" cellspacing="0" >
	<tr><td>
		<div class="logo-container"></div>
	</td></tr>
	<tr height="100%"><td valign=top >
	<?
}

function f_admin__a_html__down(){
	?>
	</td></tr>
	<tr><td>
		<center>
		<table cellpadding="0" cellspacing="0" width="80%">
			<tr height="1" bgcolor="#bdbdbd"><td></td></tr>
			<tr height="20"><td align="left" class="tx1">&copy; <a target="_blank" href="http://parsunix.com">Parsunix</a> <?=date("Y")?></td></tr>
			<tr height="10"><td></td></tr>
		</table>
		</center>
	</td></tr>
	</table>
	<?
}

function f_admin__a_html__footer(){
	?>
	</body>
	</html>
	<?
}

function f_admin__a_html__copyright(){
	;//
}






