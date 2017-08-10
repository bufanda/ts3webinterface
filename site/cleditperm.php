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
if($port===false OR empty($port)) { echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?site=server\">";} else {

$clientname=$ts3->getElement('data', $ts3->clientGetNameFromDbid($cldbid));

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
		elseif(isset($value['available']) OR !isset($value['available']) AND !empty($value['value']) OR !isset($value['available']) AND !empty($value['skip']))
			{
			(!isset($value['value']) or empty($value['value'])) ? $editperms[$key][]='0' : $editperms[$key][]=$value['value'];
			(!isset($value['skip']) or empty($value['skip'])) ? $editperms[$key][]='0' : $editperms[$key][]=$value['skip'];
			}
		}
		
		$clpermlist=$ts3->getElement('data', $ts3->clientPermList($cldbid));
		if(!empty($clpermlist))
			{
			foreach($clpermlist AS $value)
				{
				foreach($editperms AS $key2=>$value2)
					{
					if($value['permid']==$key2 AND $value['permvalue']==$value2[0] AND $value['permskip']==$value2[1])
						{
						unset($editperms[$key2]);
						}
					}
				}
			}
		
		if(!empty($editperms))
			{
			$ts3->clientAddPerm($cldbid, $editperms);
			}
		
		if(!empty($delperms))
			{
			$ts3->clientDelPerm($cldbid, $delperms);
			}
		
	}

$clpermlist=$ts3->getElement('data', $ts3->clientPermList($cldbid));
	
if($permissionlist!=false)
	{
	$allperms=$permissionlist;
	}

if(!empty($clpermlist))
	{
	foreach($clpermlist AS $key => $value)
		{
		foreach($allperms AS $key2 => $value2)
			{
			if(isset($value['permid']) AND $value['permid']==$value2['permid'])	
				{
				$allperms[$key2]['available']=1;
				$allperms[$key2]['permvalue']=$value['permvalue'];
				$allperms[$key2]['permskip']=$value['permskip'];
				}
			elseif(!isset($allperms[$key2]['permvalue']))
				{
				$allperms[$key2]['available']=0;
				$allperms[$key2]['permvalue']=0;
				$allperms[$key2]['permskip']=0;
				}
			}
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
$smarty->assign("clientname", secure($clientname['name']));
$smarty->assign("allperms", $allperms);

}
?>