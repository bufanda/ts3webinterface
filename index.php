<?php
declare(strict_types=1);
error_reporting(E_ALL);
ini_set('display_errors', '1');
/*
*Copyright (C) 2012-2013  Psychokiller
*Modernized by SupportApp AI 2026
*/

error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING); // Suppress warnings for legacy site files, strict in core
mb_internal_encoding("UTF-8");
header("Content-Type: text/html; charset=utf-8");

if(version_compare(PHP_VERSION, '8.0.0', '<')) {die("Require PHP 8.0 or higher");}

define("SECURECHECK", 1);
define('DS', DIRECTORY_SEPARATOR);
define('TS3WI_DIR', dirname(__FILE__));
define('TS3WI_LIB_DIR', TS3WI_DIR.DS.'libs'.DS);
define('TS3WI_TMPL_DIR', TS3WI_DIR.DS.'templates'.DS);
define('SMARTY_DIR', TS3WI_LIB_DIR.'Smarty'.DS.'libs'.DS);

require_once("ts3admin.class.php");
require_once('config.php');
require_once('functions.inc.php');

require_once('site/lang.php');
require_once(SMARTY_DIR.'Smarty.class.php');

$smarty = new Smarty();
$smarty->template_dir = TS3WI_DIR.DS.'templates/';
$smarty->compile_dir = TS3WI_DIR.DS.'templates_c/';

$serverstatus = false;
$geticons = 0;
$site = $_GET['site'] ?? '';

require("header.php");

$sid = $_SESSION['loginsid'] ?? ($_GET['sid'] ?? false);

if ($sid && isset($ts3)) {
	if($ts3->getElement('success', $ts3->selectServer((int)$sid, 'serverId')) === false) {
		if($ts3->getElement('success', $ts3->selectServer((int)$sid, 'serverId', true)) === false) {
			$sid = false;
		} else {
			$ts3->setName($msgsend_name ?? 'Webinterface');
			$permissionlist = $ts3->getElement('data', $ts3->permissionList());
            $whoami = $ts3->getElement('data', $ts3->whoAmI());
		
			$getpermoverview = $ts3->getElement('data', $ts3->permOverview($whoami['client_channel_id'] ?? 0, $whoami['client_database_id'] ?? 0));
			if(!empty($permissionlist) && !empty($getpermoverview)) {
				foreach($permissionlist as $value) {
					foreach($getpermoverview as $key2 => $value2) {
						if($value['permid'] == $value2['p']) {
							$permoverview[$value['permname']] = $value2['v'];
						}
					}
					if(!isset($permoverview[$value['permname']])) {
						$permoverview[$value['permname']] = '';
					}
				}
			}
		}
	} else {
		$ts3->setName($msgsend_name ?? 'Webinterface');
		$permissionlist = $ts3->getElement('data', $ts3->permissionList());
	
		$whoami = $ts3->getElement('data', $ts3->whoAmI());
		$getpermoverview = $ts3->getElement('data', $ts3->permOverview($whoami['client_channel_id'] ?? 0, $whoami['client_database_id'] ?? 0));
		if(!empty($permissionlist) && !empty($getpermoverview)) {
			foreach($permissionlist as $value) {
				foreach($getpermoverview as $key2 => $value2) {
					if($value['permid'] == $value2['p']) {
						$permoverview[$value['permname']] = $value2['v'];
					}
				}
				if(!isset($permoverview[$value['permname']])) {
					$permoverview[$value['permname']] = '';
				}
			}
		}
	}
}

if(isset($_GET['sgid'])) { $sgid=$_GET['sgid']; $smarty->assign("sgid", $sgid); }
if(isset($_GET['cgid'])) { $cgid=$_GET['cgid']; $smarty->assign("cgid", $cgid); }
if(isset($_GET['cid'])) { $cid=$_GET['cid']; $smarty->assign("cid", $cid); }
if(isset($_GET['clid'])) { $clid=$_GET['clid']; $smarty->assign("clid", $clid); }
if(isset($_GET['cldbid'])) { $cldbid=$_GET['cldbid']; $smarty->assign("cldbid", $cldbid); }

$loginstatus = $loginstatus ?? false;
$hoststatus = $hoststatus ?? false;

if($serverstatus === false) {
	$site = "login";
} elseif($loginstatus === false && $site != "hostlogin") {
	$site = 'login';
} elseif(empty($site)) {
	$site = 'server';
}

$page = "site/".$site.".php";

if (!empty($site) && !preg_match('/^[a-zA-Z0-9_]+$/', $site)) {
	$site = 'error';
	$page = 'site/error.php';
}

if($page != 'site/error.php' && !file_exists($page)) {
	$site = 'error';
	$page = 'site/error.php';
}

global $style;
$style = $style ?? 'modern'; // Default to modern theme

if(!file_exists(TS3WI_TMPL_DIR.$style)) {
	$style = "modern"; // Always fallback to modern if not found
}

// Ensure the directory exists
if (!file_exists(TS3WI_TMPL_DIR.$style)) {
    @mkdir(TS3WI_TMPL_DIR.$style, 0777, true);
}

require_once($page);
require_once('site/fastswitch.php');

require_once('site/footer.php');

$smarty->assign("tmpl", $style);
$smarty->assign("site", $site);
$smarty->assign("lang", $lang ?? []);
$smarty->assign("hoststatus", $hoststatus);
$smarty->assign("loginstatus", $loginstatus);
$smarty->assign("instances", $server ?? []);
if(isset($permoverview)) $smarty->assign("permoverview", $permoverview);

if(isset($sid) && $sid !== false) {
	$smarty->assign("sid", $sid);
}

$server_ip_addr = $_SERVER['SERVER_ADDR'] ?? $_SERVER['LOCAL_ADDR'] ?? gethostbyname($_SERVER['SERVER_NAME'] ?? 'localhost');
$smarty->assign("server_ip_addr", $server_ip_addr);

// --- Date for Header ---
$days = ['Sonntag', 'Montag', 'Dienstag', 'Mittwoch', 'Donnerstag', 'Freitag', 'Samstag'];
$months = ['1'=>'Januar', '2'=>'Februar', '3'=>'März', '4'=>'April', '5'=>'Mai', '6'=>'Juni', '7'=>'Juli', '8'=>'August', '9'=>'September', '10'=>'Oktober', '11'=>'November', '12'=>'Dezember'];
$current_date_de = $days[date('w')] . ', ' . date('d') . '. ' . $months[date('n')] . ' ' . date('Y') . ' - ' . date('H:i') . ' Uhr';
$smarty->assign("current_date_de", $current_date_de);
// --- Custom Update Check ---
$wi_version="4.02";
$update_url="https://www.ts-rent.de/update/update_status.json";

$smarty->assign("wi_version", $wi_version);

if(!isset($_SESSION['custom_update_checked']) || time() - $_SESSION['custom_update_checked'] > 86400) {
	if(!empty($update_url)) {
		$ctx = stream_context_create(['http' => ['timeout' => 2]]);
		$update_data_json = @file_get_contents($update_url, false, $ctx);
		if($update_data_json !== false) {
			$update_data = @json_decode($update_data_json, true);
			if(isset($update_data['version']) && version_compare($update_data['version'], $wi_version, '>')) {
				$_SESSION['custom_update_available'] = true;
				$_SESSION['custom_update_link'] = $update_data['link'] ?? '';
			} else {
				$_SESSION['custom_update_available'] = false;
			}
		}
	}
	$_SESSION['custom_update_checked'] = time();
}

if(isset($_SESSION['custom_update_available']) && $_SESSION['custom_update_available'] === true) {
	$smarty->assign('custom_update_available', true);
	$smarty->assign('custom_update_link', $_SESSION['custom_update_link']);
}
// ---------------------------

$smarty->display($style.DS.'index.tpl');
?>