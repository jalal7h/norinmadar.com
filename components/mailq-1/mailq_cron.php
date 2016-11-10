<?
$GLOBALS['do_action'][] = 'mailq_cron';

function mailq_cron(){
	$count = 1;
	if(!$rs = dbq(" SELECT * FROM `mailq` WHERE 1 ORDER BY `id` ASC LIMIT $count ")){
		e("error on mailq_cron - ".__LINE__);
	} else while($rw = dbf($rs)){
		xmail( $rw['to'] , $rw['subject'] , $rw['text'] , $rw['mail_from'] , ($rw['html']=='1'?true:false) );
		dbq(" DELETE FROM `mailq` WHERE `id`='".$rw['id']."' LIMIT 1 ");
	}
}

