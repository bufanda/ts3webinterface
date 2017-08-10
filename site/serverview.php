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
$error = '';
$noerror = '';

if(isset($_POST['sendkick']))
	{
	$client_kick=$ts3->clientKick($_POST['clid'], 'server', $_POST['kickmsg']);
	if($client_kick['success']===false)
		{
		for($i=0; $i+1==count($client_kick['errors']); $i++)
			{
			$error .= $client_kick['errors'][$i]."<br />";
			}
		}
		else
		{
		$noerror .= $lang['clientkickok']."<br />";
		}
	}

if(isset($_POST['sendban']))
	{
	$client_ban=$ts3->banClient($_POST['clid'], $_POST['bantime'], $_POST['banmsg']);
	if($client_ban['success']===false)
		{
		for($i=0; $i+1==count($client_ban['errors']); $i++)
			{
			$error .= $client_ban['errors'][$i]."<br />";
			}
		}
		else
		{
		$noerror .= $lang['clientbanok']."<br />";
		}
	}
	
if(isset($_POST['sendpoke']))
	{
	$client_poke=$ts3->clientPoke($_POST['clid'], $_POST['pokemsg']);
	if($client_poke['success']===false)
		{
		for($i=0; $i+1==count($client_poke['errors']); $i++)
			{
			$error .= $client_poke['errors'][$i]."<br />";
			}
		}
		else
		{
		$noerror .= $lang['clientpokeok']."<br />";
		}
	}
	
if(isset($_POST['sendmove']))
	{
	$client_move=$ts3->clientMove($_POST['clid'], $_POST['cid']);
	if($client_move['success']===false)
		{
		for($i=0; $i+1==count($client_move['errors']); $i++)
			{
			$error .= $client_move['errors'][$i]."<br />";
			}
		}
		else
		{
		$noerror .= $lang['clientmoveok']."<br />";
		}
	}
	
if(isset($_POST['sendmsg']))
	{
	$send_message=$ts3->sendMessage('3', $_POST['sid'], $_POST['msgtoserver']);
	if($send_message['success']===false)
		{
		for($i=0; $i+1==count($send_message['errors']); $i++)
			{
			$error .= $send_message['errors'][$i]."<br />";
			}
		}
		else
		{
		$noerror .= $lang['msgsendok']."<br />";
		}
	}
	
if(isset($_POST['start']))
	{
	$server_start=$ts3->serverStart($_POST['sid']);
	if($server_start['success']===false)
		{
		for($i=0; $i+1==count($server_start['errors']); $i++)
			{
			$error .= $server_start['errors'][$i]."<br />";
			}
		}
		else
		{
		$noerror .= $lang['serverstartok']."<br />";
		}
	}
	
if(isset($_POST['stop']))
	{
	$server_stop=$ts3->serverStop($_POST['sid']);
	if($server_stop['success']===false)
		{
		for($i=0; $i+1==count($server_stop['errors']); $i++)
			{
			$error .= $server_stop['errors'][$i]."<br />";
			}
		}
		else
		{
		$noerror .= $lang['serverstopok']."<br />";
		}
	$ts3->selectServer($port, 'port', true);
	}

$serverinfo=$ts3->getElement('data', $ts3->serverInfo());
$servergroups=$ts3->getElement('data', $ts3->serverGroupList());
$channelgroups=$ts3->getElement('data', $ts3->channelGroupList());
$newserverversion=check_server_version($serverinfo['virtualserver_version'], $seversionurl);

$getpath=explode("index.php", $_SERVER['REQUEST_URI']);
				
if($_SERVER['SERVER_PORT']==443)
	{
	$gethttp="https://";
	}
	else
	{
	$gethttp="http://";
	}
$pubtsview=secure("<iframe allowtransparency=\"true\" src=\"".$gethttp.$_SERVER['HTTP_HOST'].$getpath[0]."tsviewpub.php?skey=".$_SESSION['skey']."&amp;port=".$port."&amp;showicons=right&amp;bgcolor=ffffff&amp;fontcolor=000000\" style=\"height:100%;width:100%\" scrolling=\"auto\" frameborder=\"0\">Your Browser will not show Iframes</iframe>");

//Bearbeitung der Ausgabe!
$serverinfo=secure($serverinfo);
$conv_time=$ts3->convertSecondsToArrayTime($serverinfo['virtualserver_uptime']);
$serverinfo['virtualserver_uptime']=$conv_time['days'].$lang['days']." ".$conv_time['hours'].$lang['hours']." ".$conv_time['minutes'].$lang['minutes']." ".$conv_time['seconds'].$lang['seconds'];
if($serverinfo['virtualserver_icon_id']<0)
		{
		$serverinfo['virtualserver_icon_id']=sprintf('%u', $serverinfo['virtualserver_icon_id'] & 0xffffffff);
		}		

include("site/tsview.php");

$smarty->assign("error", $error);
$smarty->assign("noerror", $noerror);
$smarty->assign("pubtsview", $pubtsview);
$smarty->assign("serverinfo", $serverinfo);
$smarty->assign("servergroups", $servergroups);
$smarty->assign("channelgroups", $channelgroups);
$smarty->assign("newserverversion", $newserverversion);
$smarty->assign("tree", $tree);

?>