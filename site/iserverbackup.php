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
if(!defined('SECURECHECK')) {die($lang['error_file_alone']);} 
if($hoststatus===false AND $serverhost===true) { echo $lang['nohoster']; } else {

if(!is_dir('site/backups/server/'.$_SESSION['server_ip'].'-'.$_SESSION['server_tport'].'/'))
	{
	mkdir('site/backups/server/'.$_SESSION['server_ip'].'-'.$_SESSION['server_tport'].'/',0777);
	}
if(!is_dir('site/backups/server/hostbackups/'.$_SESSION['server_ip'].'-'.$_SESSION['server_tport'].'/'))
	{
	mkdir('site/backups/server/hostbackups/'.$_SESSION['server_ip'].'-'.$_SESSION['server_tport'].'/',0777);
	}
 
$error = '';
$noerror = '';
$files='';
$serverlist=$ts3->serverList();

if(isset($_POST['hostbackup']))
		{
		$path='site/backups/server/hostbackups/';
		}
		else
		{
		$path='site/backups/server/';
		}

if(isset($_POST['create']))
	{
	if($serverlist['success']===true)
		{
		foreach($serverlist['data'] AS $key=>$value)
			{
			$selectserver=$ts3->selectServer($value['virtualserver_port'], 'port', true);
			if($selectserver['success']===true)
				{
				$snapshotcreate=$ts3->serverSnapshotCreate();
				if($snapshotcreate['success']===true)
					{
					$handler=fopen($path.$_SESSION['server_ip'].'-'.$_SESSION['server_tport'].'/'.'server_'.time().'_'.$_SESSION['server_ip'].'-'.$value['virtualserver_port'].'.txt', 'a+');
					fwrite($handler, $snapshotcreate['data']);
					fclose($handler);
					$noerror .= sprintf($lang['serverbackupok'], $_SESSION['server_ip'], $value['virtualserver_port']).'<br />';
					}
					else
					{
					$error .= sprintf($lang['serverbackuperr'], $_SESSION['server_ip'], $value['virtualserver_port']).'<br />';
					}
				}
				else
				{
				$error .= sprintf($lang['serverbackuperr'], $_SESSION['server_ip'], $value['virtualserver_port']).'<br />';
				}
				
			}
		}
		else
		{
		$error .= $lang['serverlistcallerr'].'<br />';
		}
	}
	
if(isset($_POST['deploy']))
	{
	$handler=file($path.$_SESSION['server_ip'].'-'.$_SESSION['server_tport'].'/'.'server_'.$_POST['backupid'].'_'.$_POST['fileport'].'.txt');
	$selectserver=$ts3->selectServer($_POST['deployon'], 'port', true);
	if($selectserver['success']===true)
		{
		$snapshot_deploy=$ts3->serverSnapshotDeploy($handler[0]);
		if($snapshot_deploy['success']===false)
			{
			for($i=0; $i+1==count($snapshot_deploy['errors']); $i++)
				{
				$error .= $snapshot_deploy['errors'][$i].'<br />';
				}
			}
			else
			{
			$noerror .= $lang['serverbackdeployok'].'<br />';
			}
		}
		else
		{
		for($i=0; $i+1==count($selectserver['errors']); $i++)
			{
			$error .= $selectserver['errors'][$i].'<br />';
			}
		}
	}
	
if(isset($_POST['delete']))
	{
	if(@unlink($path.$_SESSION['server_ip'].'-'.$_SESSION['server_tport'].'/'.'server_'.$_POST['backupid'].'_'.$_POST['fileport'].'.txt'))
		{
		$noerror .= $lang['serverbackdelok'].'<br />';
		}
		else
		{
		$error .= $lang['serverbackdelerr'].'<br />';
		}
	}	

$handler=opendir('site/backups/server/'.$_SESSION['server_ip'].'-'.$_SESSION['server_tport'].'/');
while($datei=readdir($handler))
	{
	if($datei!='.' AND $datei!='..' AND $datei!='hostbackups')
		{
		$datei=str_replace('.txt', '', $datei);
		$datei_info=explode('_', $datei);
		$files[0][]=array('timestamp'=>$datei_info[1], 'server'=>$datei_info[2]);
		}
	}	

$handler=opendir('site/backups/server/hostbackups/'.$_SESSION['server_ip'].'-'.$_SESSION['server_tport'].'/');
while($datei=readdir($handler))
	{
	if($datei!='.' AND $datei!='..')
		{
		$datei=str_replace('.txt', '', $datei);
		$datei_info=explode('_', $datei);
		$files[1][]=array('timestamp'=>$datei_info[1], 'server'=>$datei_info[2]);
		}
	}
	
if(!empty($serverlist['data']))
	{
	foreach($serverlist['data'] AS $key=>$value)
		{
		$serverlist['data'][$key]=secure($serverlist['data'][$key]);
		}
	}

$smarty->assign('error', $error);
$smarty->assign('noerror', $noerror);
$smarty->assign('serverlist', $serverlist['data']);
$smarty->assign('files', $files);
}
?>