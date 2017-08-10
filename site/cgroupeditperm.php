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
if($sid===false OR empty($sid)) { echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?site=server\">";} else {

$serverinfo=$ts3->getElement('data', $ts3->serverInfo());
$get_build=explode(' ', $serverinfo['virtualserver_version']);
$get_build=str_replace(']', '', $get_build[2]);

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
	
$channelgroups=$ts3->channelGroupList();

foreach($channelgroups['data'] AS $value)
	{
	if($cgid==$value['cgid'])
		{
		$cgroupname=$value['name'];
		}
	}
	
if (isset($_POST['editall']))
	{
	$delperms=array();
	$editperms=array();
	$allpermsedit=$_POST['perm'];
	
	
	foreach($allpermsedit AS $key => $value)
		{
		if(isset($_POST['granttoall']) AND isset($value['grant']) AND $value['grant']==1 AND isset($value['available']))
			{
			if($_POST['granttoall']===0 OR $_POST['granttoall']>0)
				{
				$value['value']=$_POST['granttoall'];
				}
			}
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
		
	$cgrouplist=$ts3->getElement('data', $ts3->channelGroupPermList($cgid));
	foreach($cgrouplist AS $value)
		{
		foreach($editperms AS $key2=>$value2)
			{
			if($value['permid']==$key2 AND $value['permvalue']==$value2[0])
				{
				unset($editperms[$key2]);
				}
			}
		}
		
	if(!empty($editperms))
		{
		$ts3->channelGroupAddPerm($cgid, $editperms);
		}
	if(!empty($delperms))
		{	
		$ts3->channelGroupDelPerm($cgid, $delperms);
		}
	}	


$cgrouplist=$ts3->getElement('data', $ts3->channelGroupPermList($cgid));


if($permissionlist!=false)
	{
	$allperms=$permissionlist;
	}
	
if(!empty($cgrouplist))
	{
	foreach($cgrouplist AS $key => $value)
		{
		if(!empty($allperms))
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
	}
		
if(!empty($allperms))
	{
	foreach($allperms AS $key=>$value)
		{
		foreach($allperms AS $key2=>$value2)
			{
			if(substr($value2['permname'], 22) == substr($value['permname'], 2))
				{
				$allperms[$key]['grant']=$value2['permvalue'];
				$allperms[$key]['grantpermid']=$value2['permid'];
				$allperms[$key]['grantav']=$value2['available'];
				unset($allperms[$key2]);
				}
			}
		}
	foreach($allperms AS $key=>$value)
		{
		if(strpos($value['permid'], "43") === 0)
			{
			$allperms2[43][]=$value;
			}
		if(strpos($value['permid'], "46") === 0)
			{
			$allperms2[46][]=$value;
			}
		if(strpos($value['permid'], "48") === 0)
			{
			$allperms2[48][]=$value;
			}
		if(strpos($value['permid'], "51") === 0)
			{
			$allperms2[51][]=$value;
			}
		if(strpos($value['permid'], "84") === 0)
			{
			$allperms2[84][]=$value;
			}
		if(strpos($value['permid'], "87") === 0)
			{
			$allperms2[87][]=$value;
			}
		if(strpos($value['permid'], "90") === 0)
			{
			$allperms2[90][]=$value;
			}
		if(strpos($value['permid'], "123") === 0)
			{
			$allperms2[123][]=$value;
			}
		if(strpos($value['permid'], "126") === 0)
			{
			$allperms2[126][]=$value;
			}
		if(strpos($value['permid'], "128") === 0)
			{
			$allperms2[128][]=$value;
			}
		if(strpos($value['permid'], "131") === 0)
			{
			$allperms2[131][]=$value;
			}
		if(strpos($value['permid'], "134") === 0)
			{
			$allperms2[134][]=$value;
			}
		if(strpos($value['permid'], "136") === 0)
			{
			$allperms2[136][]=$value;
			}
		if(strpos($value['permid'], "165") === 0)
			{
			$allperms2[165][]=$value;
			}
		if(strpos($value['permid'], "167") === 0)
			{
			$allperms2[167][]=$value;
			}
		if(strpos($value['permid'], "170") === 0)
			{
			$allperms2[170][]=$value;
			}
		if(strpos($value['permid'], "173") === 0)
			{
			$allperms2[173][]=$value;
			}
		if(strpos($value['permid'], "175") === 0)
			{
			$allperms2[175][]=$value;
			}
		if(strpos($value['permid'], "206") === 0)
			{
			$allperms2[206][]=$value;
			}
		if(strpos($value['permid'], "209") === 0)
			{
			$allperms2[209][]=$value;
			}
		if(strpos($value['permid'], "211") === 0)
			{
			$allperms2[211][]=$value;
			}
		if(strpos($value['permid'], "214") === 0)
			{
			$allperms2[214][]=$value;
			}
		if(strpos($value['permid'], "217") === 0)
			{
			$allperms2[217][]=$value;
			}
		if(strpos($value['permid'], "24") === 0)
			{
			$allperms2[24][]=$value;
			}
		}
	unset($allperms);
	}
	else
	{
	$error="The permissions can't show complete because you don't have the permission to see the list!<br />Needed Permission: b_serverinstance_permission_list";
	}

if(isset($_POST['searchperms']))
	{
	$smarty->assign("searchperms", trim($_POST['searchperms']));
	}

$smarty->assign("error", $error);
$smarty->assign("showmyperms", $showmyperms);
$smarty->assign("display", $display);
$smarty->assign("disp_pic", $disp_pic);
$smarty->assign("cgroupname", secure($cgroupname));
$smarty->assign("allperms", $allperms2);
$smarty->assign("build", $get_build);
}
?>