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

if(isset($_POST['cid']) AND isset($_POST['cldbid']))
	{

	$channelinfo=$ts3->getElement('data', $ts3->channelInfo($_POST['cid']));
	$channelname=$channelinfo['channel_name'];
	
	$clientname=$ts3->getElement('data', $ts3->clientGetNameFromDbid($_POST['cldbid']));
	$clientname=$clientname['name'];
	
	if(isset($_POST['showmyperms']) AND $_POST['showmyperms']==1)
		{
		$showmyperms=1;
		}
		else
		{
		$showmyperms=0;
		}

	if($showmyperms==1 or !empty($_POST['searchperms']))
		{
		$display="block";
		$disp_pic="minus";
		}
		else
		{
		$display="none";
		$disp_pic="plus";
		}
	
	if (isset($_POST['editall']))
		{
		$delperms=array();
		$editperms=array();
		$allpermsedit=$_POST['perm'];
		
		foreach($allpermsedit AS $key => $value)
			{
			if(isset($value['delperm']) AND $value['delperm']==1)
				{
				$delperms[]=$key;
				}
			elseif(isset($value['grant']) AND $value['grant']==1 AND !isset($value['available']) AND $value['value']==0)
				{

				}
			elseif(isset($value['available']) OR !isset($value['available']) AND !empty($value['value']))
				{
				(!isset($value['value']) or empty($value['value'])) ? $editperms[$key]='0' : $editperms[$key]=$value['value'];
				}
			}
			
		$chanclientpermlist=$ts3->getElement('data', $ts3->channelClientPermList($_POST['cid'], $_POST['cldbid']));
		if(!empty($chanclientpermlist))
			{
			foreach($chanclientpermlist AS $value)
				{
				foreach($editperms AS $key2=>$value2)
					{
					if($value['permid']==$key2 AND $value['permvalue']==$value2[0])
						{
						unset($editperms[$key2]);
						}
					}
				}
			}
		
		if(!empty($editperms))
			{
			$ts3->channelClientAddPerm($_POST['cid'], $_POST['cldbid'], $editperms);
			}
		if(!empty($delperms))
			{
			$ts3->channelClientDelPerm($_POST['cid'], $_POST['cldbid'], $delperms);
			}
		}
	
	$chanclientpermlist=$ts3->channelClientPermList($_POST['cid'], $_POST['cldbid']);

	if($permissionlist!=false)
		{
		$allperms=$permissionlist;
		}
		
	if($chanclientpermlist['success']===true)
		{
		foreach($chanclientpermlist['data'] AS $key => $value)
			{
			foreach($allperms AS $key2 => $value2)
				{
				if($value['permid']==$value2['permid'])	
					{
					$allperms[$key2]['available']=1;
					$allperms[$key2]['permvalue']=$value['permvalue'];
					}
				elseif(!isset($allperms[$key2]['permvalue']))
					{
					$allperms[$key2]['available']=0;
					$allperms[$key2]['permvalue']=0;
					}
				}
			}
		}
		elseif($chanclientpermlist['errors'][0]=='ErrorID: 1281 | Message: database empty result set')
		{
		foreach($allperms AS $key => $value)
			{
			$allperms[$key]['available']=0;
			$allperms[$key]['permvalue']=0;
			}
		}
		
foreach($allperms AS $key=>$value)
	{
	foreach($allperms AS $key2=>$value2)
		{
		if(substr($value2['permname'], 22) == substr($value['permname'], 2))
			{
			$allperms[$key]['grant']=$value2['permvalue'];
			$allperms[$key]['grantpermid']=$value2['permid'];
			$allperms[$key]['grantav']=$value2['available'];
			}
		}
	}
		
	if(isset($_POST['searchperms']))
		{
		$smarty->assign("searchperms", trim($_POST['searchperms']));
		}
	
	$smarty->assign("showmyperms", $showmyperms);
	$smarty->assign("display", $display);
	$smarty->assign("disp_pic", $disp_pic);
	$smarty->assign("channelname", secure($channelname));
	$smarty->assign("clientname", secure($clientname));
	$smarty->assign("allperms", $allperms);
	}