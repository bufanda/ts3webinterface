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
if($hoststatus===true AND $serverhost===true OR $serverhost===false) {
$error = '';
$noerror = '';

$sortby="virtualserver_id";
$sorttype=SORT_ASC;

if(isset($_GET['sortby']))
	{
	if($_GET['sortby']=="id")
		{
		$sortby="virtualserver_id";
		}
		elseif($_GET['sortby']=="uptime")	
		{
		$sortby="virtualserver_uptime";
		}
		elseif($_GET['sortby']=="name")
		{
		$sortby="virtualserver_name";
		}
		elseif($_GET['sortby']=="status")
		{
		$sortby="virtualserver_status";
		}
		elseif($_GET['sortby']=="port")
		{
		$sortby="virtualserver_port";
		}
		elseif($_GET['sortby']=="clients")
		{
		$sortby="virtualserver_clientsonline";
		}
		else
		{
		$sortby="virtualserver_id";
		}
	}

if(isset($_GET['sorttype']))
	{
	if($_GET['sorttype']=="asc")
		{
		$sorttype=SORT_ASC;
		}
	elseif($_GET['sorttype']=="desc")
		{
		$sorttype=SORT_DESC;
		}
	}
	
if(isset($_GET['action']) AND $_GET['action'] == 'start')
	{
	$server_start=$ts3->serverStart($_POST['sid']);
	if($server_start['success']===false)
		{
		for($i=0; $i+1==count($server_start['errors']); $i++)
			{
			$error .= $server_start['errors'][$i]."<br />";
			}
		}
		elseif($server_start['success']===true)
		{
		$noerror = $lang['serverstartok']."<br />";
		}
	}
	
if(isset($_GET['action']) AND $_GET['action'] == 'stop')
	{
	$server_stop=$ts3->serverStop($_POST['sid']);
	if($server_stop['success']===false)
		{
		for($i=0; $i+1==count($server_stop['errors']); $i++)
			{
			$error .= $server_stop['errors'][$i]."<br />";
			}
		}
		elseif($server_stop['success']===true)
		{
		$noerror = $lang['serverstopok']."<br />";
		}
	}
	
if(isset($_GET['action']) AND $_GET['action'] == 'del')
	{
	$server_delete=$ts3->serverDelete($_POST['sid']);
	if($server_delete['success']===false)
		{
		for($i=0; $i+1==count($server_delete['errors']); $i++)
			{
			$error .= $server_delete['errors'][$i]."<br />";
			}
		}
		elseif($server_delete['success']===true)
		{
		$noerror = $lang['serverdelok']."<br />";
		}
	}
	
if(isset($_POST['sendmsg']))
	{
	$gm=$ts3->gm($_POST['msgtoall']);
	if($gm['success']===false)
		{
		for($i=0; $i+1==count($gm['errors']); $i++)
			{
			$error .= $gm['errors'][$i];
			}
		}
		elseif($gm['success']===true)
		{
		$noerror = $lang['msgsendok']."<br />";
		}
	}
	
$serverlist=$ts3->getElement('data', $ts3->serverList());
$allslots='';
$allusedslots='';
if(!empty($serverlist))
	{
	foreach($serverlist AS $key => $value)
		{
		$allslots=$allslots+$value['virtualserver_maxclients'];
		$allusedslots=$allusedslots+$value['virtualserver_clientsonline'];
		$conv_time=$ts3->convertSecondsToArrayTime($value['virtualserver_uptime']);
		$serverlist[$key]['virtualserver_uptime']=$conv_time['days'].$lang['days']." ".$conv_time['hours'].$lang['hours']." ".$conv_time['minutes'].$lang['minutes']." ".$conv_time['seconds'].$lang['seconds'];
		$serverlist[$key]=secure($serverlist[$key]);
		}
	}

if(!empty($serverlist))
	{
	foreach($serverlist AS $key=>$value)
		{
		
		$sort[]=$value[$sortby];
		}

	array_multisort($sort, $sorttype, $serverlist);
	}

$smarty->assign("sortby", $sortby);
$smarty->assign("sorttype", $sorttype);
$smarty->assign("serverstats", sprintf($lang['serverstats'], count($serverlist), $allslots, $allusedslots));
$smarty->assign("serverlist", $serverlist);
$smarty->assign("error", $error);
$smarty->assign("noerror", $noerror);
} ?>