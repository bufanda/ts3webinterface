<?php
error_reporting(E_ALL & ~E_NOTICE);
define("SECURECHECK", 1);
require_once("ts3admin.class.php");
require('config.php');
require('updatecheck.php');
require('site/lang.php');
require('site/permlist.php');
function conv_traffic($bytes)
	{
	if ($bytes<1024)
		{
		$ret=$bytes."Bytes";
		}
	elseif($bytes<1048576)
		{
		$ret=round(($bytes/1024), 2)."KiB";
		}
	elseif($bytes<1073741824)
		{
		$ret=round(($bytes/1048576), 2)."MiB";
		}
	elseif($bytes<1099511627776)
		{
		$ret=round(($bytes/1073741824), 2)."GiB";
		}
	return $ret;
	}
$serverstatus='';
$site='';
$site=$_GET['site'];
require("header.php");
if(isset($_GET['port']))
		{
		if(isset($_SESSION['loginport']))
			{
			$port=$_SESSION['loginport'];
			}
			else
			{
			$port=$_GET['port'];
			}
		if(!$ts3->selectServerByPort($port))
			{
			$port=false;
			}
		}
if(isset($_GET['sgid']))
	{
	$sgid=$_GET['sgid'];
	}
if(isset($_GET['cgid']))
	{
	$cgid=$_GET['cgid'];
	}
if(isset($_GET['cid']))
	{
	$cid=$_GET['cid'];
	}
if(isset($_GET['clid']))
	{
	$clid=$_GET['clid'];
	}
if(isset($_GET['cldbid']))
	{
	$cldbid=$_GET['cldbid'];
	}


if($serverstatus===false)
	{
	$site="soffline";
	}
elseif($loginstatus===false AND $site!="hostlogin")
	{
	$site='login';
	}
elseif(empty($site))
	{
	$site='server';
	}
$page="site/".$site.".php";

$forbidden_signs=array(".", "/", "\\");
$forbidden_signs2=array(";", "'", "%");

foreach($forbidden_signs AS $value)
	{
	if(strpos($site, $value)!==false)
		{
		$page='site/error.php';
		break;
		}
	}
foreach($forbidden_signs2 AS $value)
	{
	if(strpos($_SERVER['REQUEST_URI'], $value)!==false)
		{
		$page='site/error.php';
		break;
		}
	}

if($page!='site/error.php' AND !file_exists($page))
	{
	$page='site/error.php';
	}


if(!file_exists("gfx/$style/style.css"))
	{
	$style="blue";
	}

$tmp_get = implode ("",file("gfx/index.html"));
$template=array('show:content' =>$page,
				'show:style' =>$style,
				'show:mainbar' =>'site/mainbar.php',
				'show:update' =>'site/showupdate.php',
				'show:header' =>'site/head.php',
				'show:switch' =>'site/fastswitch.php');
				
foreach($template AS $tmp_key => $tmp_value)
	{
if(file_exists($tmp_value))
	{
ob_start();
include($tmp_value);
$tmp_value=ob_get_contents();
ob_end_clean();
	}
$tmp_value=str_replace('{', "&#123;", $tmp_value);
$tmp_value=str_replace('}', "&#125;", $tmp_value);
$tmp_get=str_replace('{'.$tmp_key.'}', $tmp_value, $tmp_get);
	}
echo $tmp_get;
if($serverstatus===true)
	{
	$ts3->quit();
	}