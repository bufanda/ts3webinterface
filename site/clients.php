<?php 
/*
*Copyright (C) 2012-2013  Psychokiller
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

// AJAX Handler fuer Rechte-Modal und Rechte-Entzug
if(isset($_REQUEST['ajax']))
	{
	header('Content-Type: application/json; charset=utf-8');
	if($_REQUEST['ajax'] == 'get_client_groups' && isset($_REQUEST['cldbid']))
		{
		$cldbid = intval($_REQUEST['cldbid']);
		$client_groups = $ts3->getElement('data', $ts3->serverGroupsByClientID($cldbid));
		if(empty($client_groups) || isset($client_groups[0]['']))
			{
			$client_groups = array();
			}
		echo json_encode(array('success' => true, 'cldbid' => $cldbid, 'groups' => $client_groups));
		exit;
		}
	elseif($_REQUEST['ajax'] == 'revoke_client_group' && isset($_REQUEST['cldbid']) && isset($_REQUEST['sgid']))
		{
		$cldbid = intval($_REQUEST['cldbid']);
		$sgid = intval($_REQUEST['sgid']);
		$sgroup_del_client = $ts3->serverGroupDeleteClient($sgid, $cldbid);
		if($sgroup_del_client['success'] !== false)
			{
			// Aktualisierte Gruppenliste zurueckgeben
			$updated_groups = $ts3->getElement('data', $ts3->serverGroupsByClientID($cldbid));
			if(empty($updated_groups) || isset($updated_groups[0]['']))
				{
				$updated_groups = array();
				}
			echo json_encode(array('success' => true, 'msg' => $lang['clientremoveok'] ?? 'Recht erfolgreich entzogen.', 'groups' => $updated_groups));
			}
		else
			{
			$err_msg = '';
			if(isset($sgroup_del_client['errors']) && is_array($sgroup_del_client['errors']))
				{
				$err_msg = implode(' ', $sgroup_del_client['errors']);
				}
			else
				{
				$err_msg = 'Das Recht konnte nicht entzogen werden.';
				}
			echo json_encode(array('success' => false, 'error' => $err_msg));
			}
		exit;
		}
	}

$sortby="cldbid";
$sorttype=SORT_ASC;

$sgfilter = (isset($_REQUEST['sgfilter']) && !empty($_REQUEST['sgfilter'])) ? intval($_REQUEST['sgfilter']) : 0;

if(empty($duration))
	{
	$duration=25;
	}
	
if(isset($_GET['start']))
	{
	$start=$_GET['start'];
	}
	else
	{
	$start=0;
	}
if(($start-$duration)<0)
	{
	$start=0;
	}
	
if(isset($_GET['sortby']))
	{
	if($_GET['sortby']=="cldbid")
		{
		$sortby="cldbid";
		}
		elseif($_GET['sortby']=="status")	
		{
		$sortby="clid";
		}
		elseif($_GET['sortby']=="name")
		{
		$sortby="client_nickname";
		}
		elseif($_GET['sortby']=="unique")
		{
		$sortby="client_unique_identifier";
		}
		elseif($_GET['sortby']=="created")
		{
		$sortby="client_created";
		}
		elseif($_GET['sortby']=="lastcon")
		{
		$sortby="client_lastconnected";
		}
		else
		{
		$sortby="cldbid";
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

// Servergruppen laden (fuer dynamischen Rechtefilter)
$all_servergroups = $ts3->getElement('data', $ts3->serverGroupList());
$servergroups = array();
if(!empty($all_servergroups) && !isset($all_servergroups[0]['']))
	{
	foreach($all_servergroups as $sg)
		{
		if(isset($sg['type']) && $sg['type'] == 1) // Reguläre Servergruppen
			{
			$servergroups[] = $sg;
			}
		elseif(!isset($sg['type']))
			{
			$servergroups[] = $sg;
			}
		}
	}

if(isset($_POST['clientdel']))
	{
	$client_delete=$ts3->clientDbDelete($_POST['cldbid']);
	if($client_delete['succes']!==false)
		{
		echo "<tr><td colspan=\"4\" class=\"green1\">".$lang['clientdeletedok']."</td></tr>";
		}
		else
		{
		echo "<tr><td colspan=\"4\" class=\"green1\">";
		for($i=0; $i+1==count($client_delete['errors']); $i++)
			{
			echo $client_delete['errors'][$i]."<br />";
			}
		echo "</td></tr>";
		}
	}

// Direkter Fallback fuer Recht-Entzug ueber Standard-POST
if(isset($_POST['revokegroup']) && isset($_POST['cldbid']) && isset($_POST['sgid']))
	{
	$sgroup_del_client = $ts3->serverGroupDeleteClient(intval($_POST['sgid']), intval($_POST['cldbid']));
	if($sgroup_del_client['success'] !== false)
		{
		echo "<div class=\"green1\" style=\"padding:10px; margin-bottom:10px; border-radius:8px;\">".$lang['clientremoveok']."</div>";
		}
	else
		{
		echo "<div class=\"error\" style=\"padding:10px; margin-bottom:10px; border-radius:8px;\">Das Recht konnte nicht entzogen werden.</div>";
		}
	}

$clientdblist=array();
while($getclientdblist=$ts3->getElement('data', $ts3->clientDbList($start, $duration)))
	{
	$clientdblist=array_merge($clientdblist, $getclientdblist);
	$start=$start+$duration;
	}

$clientlist=$ts3->getElement('data', $ts3->clientList());

// Optionaler Filter nach Servergruppe (sgfilter)
if($sgfilter > 0)
	{
	$groupclients = $ts3->getElement('data', $ts3->serverGroupClientList($sgfilter, true));
	$allowed_cldbids = array();
	if(!empty($groupclients) && !isset($groupclients[0]['']))
		{
		foreach($groupclients as $gc)
			{
			$allowed_cldbids[] = $gc['cldbid'];
			}
		}
	
	foreach ($clientdblist AS $key => $value)
		{
		if(!in_array($value['cldbid'], $allowed_cldbids))
			{
			unset($clientdblist[$key]);
			}
		}
	$clientdblist = array_values($clientdblist);
	}

$countclients=count($clientdblist);

$pages=$countclients/$duration;
if(floor($pages)!=0)
	{
	$pages=ceil($pages);
	}

if(isset($_POST['searchby']) AND $_POST['searchby']=='cldbid' AND  !empty($_POST['search']))
	{
	foreach ($clientdblist AS $key => $value)
		{
		if($_POST['search']!=$value['cldbid'])
			{
			unset($clientdblist[$key]);
			}
		}
	}
elseif(isset($_POST['searchby']) AND $_POST['searchby']=='name' AND !empty($_POST['search']))
	{
	foreach ($clientdblist AS $key => $value)
		{
		if(strpos(strtolower($value['client_nickname']),strtolower($_POST['search']))===false)
			{
			unset($clientdblist[$key]);
			}
		}
	}
elseif(isset($_POST['searchby']) AND $_POST['searchby']=='uniqueid' AND !empty($_POST['search']))
	{
	foreach ($clientdblist AS $key => $value)
		{
		if($value['client_unique_identifier']!=$_POST['search'])
			{
			unset($clientdblist[$key]);
			}
		}
	}
	
if(!empty($clientdblist))
	{
	foreach($clientdblist AS $key => $value)
		{
		if(!empty($clientlist))
			{
			foreach($clientlist AS $key2 => $value2)
				{
				if($value['cldbid'] == $value2['client_database_id'])
					{
					$clientdblist[$key]['clid']=$value2['clid'];
					$clientdblist[$key]['cid']=$value2['cid'];
					}
				}
			}
		}
	}

$countstarted=0;
$print_pages=1;
if(!isset($_GET['getstart']))
		{
		$getstart=0;
		}
		else
		{
		$getstart=$_GET['getstart'];
		}

$showclients=1;
if(!empty($clientdblist))
	{
	foreach($clientdblist AS $key=>$value)
		{
		$clientdblist[$key]=secure($clientdblist[$key]);
		
		$sort[]=$value[$sortby];
		}

	array_multisort($sort, $sorttype, $clientdblist);
	}
}

$smarty->assign("sortby", $sortby);
$smarty->assign("sorttype", $sorttype);
$smarty->assign("duration", $duration);
$smarty->assign("pages", $pages);
$smarty->assign("getstart", $getstart);
$smarty->assign("countstarted", $countstarted);
$smarty->assign("showclients", $showclients);
$smarty->assign("print_pages", $print_pages);
$smarty->assign("clientdblist", $clientdblist);
$smarty->assign("servergroups", $servergroups);
$smarty->assign("sgfilter", $sgfilter);
?>