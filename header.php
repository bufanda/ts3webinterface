<?php 
/*
*Copyright (C) 2012-2013  Psychokiller
*Modernized by SupportApp AI 2026
*/
if(!defined("SECURECHECK")) {die("Error: The file can not be executed alone");} 
session_name('ts3wi_v2');
session_start();

$serverstatus = false;

if(isset($_POST['skey']) || (isset($_SESSION['server_ip']) && isset($_SESSION['server_tport']))) {
	if(!isset($_SESSION['server_ip']) && !isset($_SESSION['server_tport']) || isset($_POST['skey'])) {
		$_SESSION['skey'] = $_POST['skey'] ?? '';
		$_SESSION['server_ip'] = $server[$_POST['skey']]['ip'] ?? '';
		$_SESSION['server_tport'] = $server[$_POST['skey']]['tport'] ?? '';
	}
	
	$ts3 = new ts3admin($_SESSION['server_ip'], $_SESSION['server_tport']);
	if($ts3->getElement('success', $ts3->connect()) === true) {
		$serverstatus = true;
	} else {
		$serverstatus = false;
	}
}


$uip = $_SERVER['REMOTE_ADDR'] ?? '';
$lg_user = $_POST['loginUser'] ?? '';
$lg_pw = $_POST['loginPw'] ?? '';

$loginstatus = false;
$hoststatus = false;
$site = $site ?? '';

if(!empty($lg_user) && !empty($lg_pw) && isset($ts3)) {
	if($ts3->getElement('success', $ts3->login($lg_user, $lg_pw)) === true) {
		$loginstatus = true;
		$_SESSION['logged'] = true;
		$_SESSION['userip'] = $uip;
		$_SESSION['loginuser'] = $lg_user;
		$_SESSION['loginpw'] = base64_encode(serialize($lg_pw));
		$whoami = $ts3->getElement('data', $ts3->whoAmI());
		check_version_consistency($neededversionkey ?? '');
		if(($whoami['client_origin_server_id'] ?? 0) != 0) {
			$_SESSION['loginsid'] = $whoami['client_origin_server_id'];
		} else {
			$hoststatus = true;
		}
	}
}


if(isset($_SESSION['logged']) && $_SESSION['logged'] === true && ($_SESSION['userip'] ?? '') == $uip && $serverstatus === true && isset($ts3)) {
	if($ts3->getElement('success', $ts3->login($_SESSION['loginuser'], unserialize(base64_decode($_SESSION['loginpw'])))) === false) {
		$loginstatus = false;
		$hoststatus = false;
		$ts3->logout();
		session_destroy();
	} else {
		$loginstatus = true;
		$whoami = $ts3->getElement('data', $ts3->whoAmI());
		check_version_consistency($neededversionkey ?? '');
		if(($whoami['client_origin_server_id'] ?? 0) == 0) {
			$hoststatus = true;
		}
	}
}
	
if(isset($_SESSION['logged']) && $_SESSION['logged'] === true && ($_SESSION['userip'] ?? '') != $uip && isset($ts3)) {
	$loginstatus = false;
	$hoststatus = false;
	$ts3->logout();
	session_destroy();
}
	
if($site == 'logout' && $loginstatus === true && isset($ts3)) {
	$hoststatus = false;
	$loginstatus = false;
	$ts3->logout();
	session_destroy();
}
	
require_once('site/footer.php');
?>