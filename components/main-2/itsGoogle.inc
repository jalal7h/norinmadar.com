<?php

function itsGoogle(){
	$Robots = array('Googlebot', 'MSNBot', 'Googlebot-News', 'Googlebot-Image', 'Googlebot-Video', 'Googlebot-Mobile', 'Mediapartners-Google', 'Mediapartners-Google', 'AdsBot-Google', 'Bingbot','Yahoo Slurp','Yahoo! Slurp');
	$IsRobot = false;
	$MyUserAgent = $_SERVER['HTTP_USER_AGENT'];
	foreach($Robots as $Robot){
		if(@stristr($MyUserAgent, $Robot)){
			$IsRobot = true;
			break;
		}
	}

	return $IsRobot;
}



