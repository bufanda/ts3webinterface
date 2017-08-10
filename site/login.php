<?php 
/*
*Copyright (C) 2010-2011  Psychokiller
*
*This program is free software; you can redistribute it and/or modify it under the terms of 
*the GNU General Public License as published by the Free Software Foundation; either 
*version 3 of the License, or any later version.
*
*This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; 
*without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. 
*See the GNU General Public License for more details.
*
*You should have received a copy of the GNU General Public License along with this program; if not, see <http://www.gnu.org/licenses/>. 
*/
if(!defined("SECURECHECK")) {die($lang['error_file_alone']);} 

$error='';

if($serverstatus===false)	
	{
	$debuglog=$ts3->getDebugLog();
	foreach($debuglog AS $value)
		{
		$error .= $value."<br />";
		}
	}
elseif($loginstatus===true AND $serverhost===true AND isset($_POST['sendlogin']))
	{
	header("Location: index.php?site=serverview&port=".$_SESSION['loginport']);

    exit;
	}
elseif($loginstatus===true AND $serverhost===false AND isset($_POST['sendlogin']))
	{
	header("Location: index.php?site=server");

    exit;
	}
elseif($loginstatus===false AND !empty($port_err) AND isset($_POST['sendlogin']))
	{
	$error .= $lang['noserverport']."<br />";
	}
elseif($loginstatus===false AND isset($_POST['sendlogin']))
	{
	$debuglog=$ts3->getDebugLog();
	foreach($debuglog AS $value)
		{
		$error .= $value."<br />";
		}
	}
elseif($loginstatus===true AND !isset($_POST['sendlogin']))
	{
	$error .= $lang['alreadylogin']."<br />";
	}
	
if(!empty($error))
	{
	$smarty->assign("error", $error);
	}