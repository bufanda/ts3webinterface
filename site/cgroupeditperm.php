<?php if(!defined("SECURECHECK")) {die($lang['error_file_alone']);}
if($port===false OR empty($port)) { echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?site=server\">";} else {

if(isset($_POST['showmyperms']) AND $_POST['showmyperms']==1)
	{
	$showmyperms=1;
	}
	else
	{
	$showmyperms=0;
	}

if($showmyperms==1)
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

foreach($channelgroups AS $value)
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
		if(isset($value['delperm']) AND $value['delperm']==1)
			{
			$delperms[$key]=$key;
			}
		elseif(isset($value['grant']) AND $value['grant']==1 AND !isset($value['available']) AND $value['value']==0)
			{

			}
		elseif(isset($value['available']) OR !isset($value['available']) AND !empty($value['value']))
			{
			(!isset($value['value']) or empty($value['value'])) ? $editperms[$key]['value']='0' : $editperms[$key]['value']=$value['value'];
			}
		}
		
		$ts3->channelGroupAddPerm($cgid, $editperms);
		echo $ts3->getDebugLog();
		$ts3->channelGroupDeletePerm($cgid, $delperms);

	}	


$cgrouplist=$ts3->channelGroupPermList($cgid);

$getlist=$ts3->permissionList();
if($getlist!=false)
	{
	$allperms=$getlist;
	}
	
foreach($cgrouplist AS $key => $value)
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
					$allperms[$key2]['permvalue']='0';
					}
				}
			}


?>
<table  class="border" cellpadding="0" cellspacing="0" style="width:100%">
	<tr>
		<td class="thead" colspan="6" style="text-align:right">
		<form method="post" action="index.php?site=cgroupeditperm&amp;cgid=<?php echo $cgid; ?>&amp;port=<?php echo $port; ?>">
		<input type="checkbox" name="showmyperms" value="1" onChange="submit()" <?php $showmyperms==1 ? print "checked=\"checked\"":''; ?> /><?php echo $lang['showgrantedonly']; ?>
		</form>
		</td>
	</tr>
	<tr>
		<td class="thead" colspan="6"><?php echo "(".$cgid.")".$cgroupname." ".$lang['permissionlist'];?></td>
	</tr>
	<tr>
		<td class="thead" style="width:50px">&nbsp;</td>
		<td class="thead" style="width:45px"><?php echo $lang['permid']; ?></td>
		<td class="thead" style="width:410px"><?php echo $lang['permname']; ?></td>
		<td class="thead" style="width:50px"><?php echo $lang['value']; ?></td>
		<td class="thead" style="width:101px"><?php echo $lang['options']; ?></td>
		<td class="thead" style="width:100px"><?php echo $lang['grant']; ?></td>
	</tr>
	<?php
	$change_col=1;
	
	foreach($allperms AS $value)
		{
		if($change_col%2) { $td_col="green1";} else {$td_col="green2";}
		
		if($value['permname']=='b_serverinstance_help_view')
			{
			echo "<tr>",
					"<td class='maincat left' colspan='6'>",
					"&nbsp;<a href=\"javascript:Klappen(1)\"><img src=\"gfx/images/".$disp_pic.".png\" id=\"Pic1\" border=0 alt=\"aus/ein-klappen\"></a>&nbsp;".$lang['global'],
					"</td>",
				 "</tr>",
				 "<tr>",
					 "<td style=\"width:100%\" colspan=\"6\">",
					 "<div style=\"display:".$display."\" id=\"Lay1\">",
					 "<table style=\"width:100%;border-collapse:collapse;\" cellpadding=\"0\" cellspacing=\"0\">",
						 "<tr>",
							 "<td class='subcat' style='width:60px'>&nbsp;</td>",
							 "<td class='subcat' colspan='5'>&nbsp;<a href=\"javascript:Klappen(2)\"><img src=\"gfx/images/".$disp_pic.".png\" id=\"Pic2\" border=0 alt=\"aus/ein-klappen\"></a>&nbsp;".$lang['information']."</td>",
						 "</tr>",
						 "<tr>",
							 "<td colspan=\"6\">",
							 "<div style=\"display:".$display."\" id=\"Lay2\">",
							 "<table style=\"width:100%;border-collapse:collapse;border:0\" cellpadding=\"0\" cellspacing=\"0\">";
			}
		if($value['permname']=='b_virtualserver_create')
			{
				echo 		 "</table>",
							 "</div>",
							"</td>",
						 "</tr>",
						 "<tr>",
							 "<td class='subcat'>&nbsp;</td>",
							 "<td class='subcat' colspan='5'>&nbsp;<a href=\"javascript:Klappen(3)\"><img src=\"gfx/images/".$disp_pic.".png\" id=\"Pic3\" border=0 alt=\"aus/ein-klappen\"></a>&nbsp;".$lang['virtualservermanagement']."</td></tr>",
						 "<tr>",
							 "<td colspan=\"6\">",
							 "<div style=\"display:".$display."\" id=\"Lay3\">",
							 "<table style=\"width:100%;border-collapse:collapse;border:0\" cellpadding=\"0\" cellspacing=\"0\">";
			}
		if($value['permname']=='b_serverquery_login')
			{
			echo 			"</table>",
							"</div>",
							"</td>",
						"</tr>",
						"<tr>",
							"<td class='subcat'>&nbsp;</td>",
							"<td class='subcat' colspan='5'>&nbsp;<a href=\"javascript:Klappen(4)\"><img src=\"gfx/images/".$disp_pic.".png\" id=\"Pic4\" border=0 alt=\"aus/ein-klappen\"></a>&nbsp;".$lang['administration']."</td>",
						"</tr>",
						"<tr>",
							"<td colspan=\"6\">",
							 "<div style=\"display:".$display."\" id=\"Lay4\">",
							 "<table style=\"width:100%;border-collapse:collapse;border:0\" cellpadding=\"0\" cellspacing=\"0\">";
			}
		if($value['permname']=='b_serverinstance_modify_settings')
			{
			echo 			 "</table>",
							 "</div>",
							 "</td>",
						"</tr>",
						"<tr>",
							"<td class='subcat'>&nbsp;</td>",
							"<td class='subcat' colspan='5'>&nbsp;<a href=\"javascript:Klappen(5)\"><img src=\"gfx/images/".$disp_pic.".png\" id=\"Pic5\" border=0 alt=\"aus/ein-klappen\"></a>&nbsp;".$lang['settings']."</td>",
						"</tr>",
						"<tr>",
							"<td colspan=\"6\">",
							"<div style=\"display:".$display."\" id=\"Lay5\">",
							"<table style=\"width:100%;border-collapse:collapse;border:0\" cellpadding=\"0\" cellspacing=\"0\">";
			}
		if($value['permname']=='b_virtualserver_select')
			{
			echo 			"</table>",
							"</div>",
							"</td>",
						"</tr>",
					"</table>",
					"</div>",
					"</td>",
				 "</tr>",
				 "<tr>",
					"<td class='maincat left' colspan='6'>&nbsp;<a href=\"javascript:Klappen(6)\"><img src=\"gfx/images/".$disp_pic.".png\" id=\"Pic6\" border=0 alt=\"aus/ein-klappen\"></a>&nbsp;".$lang['virtualserver']."</td>",
				 "</tr>",
				 "<tr>",
					 "<td style=\"width:100%\" colspan=\"6\">",
					 "<div style=\"display:".$display."\" id=\"Lay6\">",
					 "<table style=\"width:100%;border-collapse:collapse;\" cellpadding=\"0\" cellspacing=\"0\">",
						"<tr>",
							"<td class='subcat' style='width:60px'>&nbsp;</td>",
							"<td class='subcat' colspan='5'>&nbsp;<a href=\"javascript:Klappen(7)\"><img src=\"gfx/images/".$disp_pic.".png\" id=\"Pic7\" border=0 alt=\"aus/ein-klappen\"></a>&nbsp;".$lang['information']."</td>",
						"</tr>",
						"<tr>",
							"<td colspan=\"6\">",
							"<div style=\"display:".$display."\" id=\"Lay7\">",
							"<table style=\"width:100%;border-collapse:collapse;border:0\" cellpadding=\"0\" cellspacing=\"0\">";
			}
		if($value['permname']=='b_virtualserver_start')
			{
			echo 			"</table>",
							"</div>",
							"</td>",
						"</tr>",
						"<tr>",
							"<td class='subcat'>&nbsp;</td>",
							"<td class='subcat' colspan='5'>&nbsp;<a href=\"javascript:Klappen(8)\"><img src=\"gfx/images/".$disp_pic.".png\" id=\"Pic8\" border=0 alt=\"aus/ein-klappen\"></a>&nbsp;".$lang['administration']."</td>",
						"</tr>",
						"<tr>",
							"<td colspan=\"6\">",
							"<div style=\"display:".$display."\" id=\"Lay8\">",
							"<table style=\"width:100%;border-collapse:collapse;border:0\" cellpadding=\"0\" cellspacing=\"0\">";
			}
		if($value['permname']=='b_virtualserver_modify_name')
			{
			echo 			"</table>",
							"</div>",
							"</td>",
						"</tr>",		
						"<tr>",
							"<td class='subcat'>&nbsp;</td>",
							"<td class='subcat' colspan='5'>&nbsp;<a href=\"javascript:Klappen(9)\"><img src=\"gfx/images/".$disp_pic.".png\" id=\"Pic9\" border=0 alt=\"aus/ein-klappen\"></a>&nbsp;".$lang['settings']."</td>",
						"</tr>",
						"<tr>",
							"<td colspan=\"6\">",
							"<div style=\"display:".$display."\" id=\"Lay9\">",
							"<table style=\"width:100%;border-collapse:collapse;border:0\" cellpadding=\"0\" cellspacing=\"0\">";
			}
		if($value['permname']=='i_channel_min_depth')
			{
			echo 			"</table>",
							"</div>",
							"</td>",
						"</tr>",
					"</table>",
					"</div>",
					"</td>",
				 "</tr>",
				 "<tr>",
					"<td class='maincat left' colspan='6'>&nbsp;<a href=\"javascript:Klappen(10)\"><img src=\"gfx/images/".$disp_pic.".png\" id=\"Pic10\" border=0 alt=\"aus/ein-klappen\"></a>&nbsp;".$lang['channel']."</td>",
				 "</tr>",
				 "<tr>",
					 "<td style=\"width:100%\" colspan=\"6\">",
					 "<div style=\"display:".$display."\" id=\"Lay10\">",
					 "<table style=\"width:100%;border-collapse:collapse;\" cellpadding=\"0\" cellspacing=\"0\">";
			}
		if($value['permname']=='b_channel_info_view')
			{
			echo 		"<tr>",
							"<td class='subcat' style='width:51px'>&nbsp;</td>",
							"<td class='subcat' colspan='5'>&nbsp;<a href=\"javascript:Klappen(11)\"><img src=\"gfx/images/".$disp_pic.".png\" id=\"Pic11\" border=0 alt=\"aus/ein-klappen\"></a>&nbsp;".$lang['information']."</td>",
						"</tr>",
						"<tr>",
							 "<td colspan=\"6\">",
							 "<div style=\"display:".$display."\" id=\"Lay11\">",
							 "<table style=\"width:100%;border-collapse:collapse;border:0\" cellpadding=\"0\" cellspacing=\"0\">";
			}
		if($value['permname']=='b_channel_create_child')
			{
			echo 			"</table>",
							"</div>",
							"</td>",
						"</tr>",
						"<tr>",
							"<td class='subcat'>&nbsp;</td>",
							"<td class='subcat' colspan='5'>&nbsp;<a href=\"javascript:Klappen(12)\"><img src=\"gfx/images/".$disp_pic.".png\" id=\"Pic12\" border=0 alt=\"aus/ein-klappen\"></a>&nbsp;".$lang['create']."</td>",
						"</tr>",
						"<tr>",
							"<td colspan=\"6\">",
							"<div style=\"display:".$display."\" id=\"Lay12\">",
							"<table style=\"width:100%;border-collapse:collapse;border:0\" cellpadding=\"0\" cellspacing=\"0\">";
			}
		if($value['permname']=='b_channel_modify_parent')
			{	
			echo 			"</table>",
							"</div>",
							"</td>",
						"</tr>",
						"<tr>",
							"<td class='subcat'>&nbsp;</td>",
							"<td class='subcat' colspan='5'>&nbsp;<a href=\"javascript:Klappen(13)\"><img src=\"gfx/images/".$disp_pic.".png\" id=\"Pic13\" border=0 alt=\"aus/ein-klappen\"></a>&nbsp;".$lang['modify']."</td>",
						"</tr>",
						"<tr>",
							"<td colspan=\"6\">",
							"<div style=\"display:".$display."\" id=\"Lay13\">",
							"<table style=\"width:100%;border-collapse:collapse;border:0\" cellpadding=\"0\" cellspacing=\"0\">";
			}
		if($value['permname']=='b_channel_delete_permanent')
			{
			echo 			"</table>",
							"</div>",
							"</td>",
						"</tr>",
						"<tr>",
							"<td class='subcat'>&nbsp;</td>",
							"<td class='subcat' colspan='5'>&nbsp;<a href=\"javascript:Klappen(14)\"><img src=\"gfx/images/".$disp_pic.".png\" id=\"Pic14\" border=0 alt=\"aus/ein-klappen\"></a>&nbsp;".$lang['delete']."</td>",
						"</tr>",
						"<tr>",
							"<td colspan=\"6\">",
							"<div style=\"display:".$display."\" id=\"Lay14\">",
							"<table style=\"width:100%;border-collapse:collapse;border:0\" cellpadding=\"0\" cellspacing=\"0\">";
			}
		if($value['permname']=='b_channel_join_permanent')
			{
			echo 			"</table>",
							"</div>",
							"</td>",
						"</tr>",
						"<tr>",
							"<td class='subcat'>&nbsp;</td>",
							"<td class='subcat' colspan='5'>&nbsp;<a href=\"javascript:Klappen(15)\"><img src=\"gfx/images/".$disp_pic.".png\" id=\"Pic15\" border=0 alt=\"aus/ein-klappen\"></a>&nbsp;".$lang['access']."</td>",
						"</tr>",
						"<tr>",
							"<td colspan=\"6\">",
							"<div style=\"display:".$display."\" id=\"Lay15\">",
							"<table style=\"width:100%;border-collapse:collapse;border:0\" cellpadding=\"0\" cellspacing=\"0\">";
			}
		if($value['permname']=='i_icon_id')
			{
			echo 			"</table>",
							"</div>",
							"</td>",
						"</tr>",
					"</table>",
					"</div>",
					"</td>",
				 "</tr>",
				 "<tr class='maincat left'>",
					"<td colspan='6'>&nbsp;<a href=\"javascript:Klappen(16)\"><img src=\"gfx/images/".$disp_pic.".png\" id=\"Pic16\" border=0 alt=\"aus/ein-klappen\"></a>&nbsp;".$lang['group']."</td>",
				 "</tr>",
				 "<tr>",
					 "<td style=\"width:100%\" colspan=\"6\">",
					 "<div style=\"display:".$display."\" id=\"Lay16\">",
					 "<table style=\"width:100%;border-collapse:collapse;\" cellpadding=\"0\" cellspacing=\"0\">";
			}
		if($value['permname']=='b_virtualserver_servergroup_list')
			{
			echo 		"<tr>",
							"<td class='subcat' style='width:51px'>&nbsp;</td>",
							"<td class='subcat' colspan='5'>&nbsp;<a href=\"javascript:Klappen(17)\"><img src=\"gfx/images/".$disp_pic.".png\" id=\"Pic17\" border=0 alt=\"aus/ein-klappen\"></a>&nbsp;".$lang['information']."</td>",
						"</tr>",
						"<tr>",
							"<td colspan=\"6\">",
							"<div style=\"display:".$display."\" id=\"Lay17\">",
							"<table style=\"width:100%;border-collapse:collapse;border:0\" cellpadding=\"0\" cellspacing=\"0\">";
			}
		if($value['permname']=='b_virtualserver_servergroup_create')
			{
			echo 			"</table>",
							"</div>",
							"</td>",
						"</tr>",
						"<tr>",
							"<td class='subcat'>&nbsp;</td>",
							"<td class='subcat' colspan='5'>&nbsp;<a href=\"javascript:Klappen(18)\"><img src=\"gfx/images/".$disp_pic.".png\" id=\"Pic18\" border=0 alt=\"aus/ein-klappen\"></a>&nbsp;".$lang['create']."</td>",
						"</tr>",
						"<tr>",
							"<td colspan=\"6\">",
							"<div style=\"display:".$display."\" id=\"Lay18\">",
							"<table style=\"width:100%;border-collapse:collapse;border:0\" cellpadding=\"0\" cellspacing=\"0\">";
			}
		if($value['permname']=='i_group_modify_power')
			{
			echo 			"</table>",
							"</div>",
							"</td>",
						"</tr>",
						"<tr>",
							"<td class='subcat'>&nbsp;</td>",
							"<td class='subcat' colspan='5'>&nbsp;<a href=\"javascript:Klappen(19)\"><img src=\"gfx/images/".$disp_pic.".png\" id=\"Pic19\" border=0 alt=\"aus/ein-klappen\"></a>&nbsp;".$lang['modify']."</td>",
						"</tr>",
						"<tr>",
							"<td colspan=\"6\">",
							"<div style=\"display:".$display."\" id=\"Lay19\">",
							"<table style=\"width:100%;border-collapse:collapse;border:0\" cellpadding=\"0\" cellspacing=\"0\">";
			}
		if($value['permname']=='b_virtualserver_servergroup_delete')
			{
			echo 			"</table>",
							"</div>",
							"</td>",
						"</tr>",
						"<tr>",
							 "<td class='subcat'>&nbsp;</td>",
							 "<td class='subcat' colspan='5'>&nbsp;<a href=\"javascript:Klappen(20)\"><img src=\"gfx/images/".$disp_pic.".png\" id=\"Pic20\" border=0 alt=\"aus/ein-klappen\"></a>&nbsp;".$lang['delete']."</td>",
						"</tr>",
						"<tr>",
							"<td colspan=\"6\">",
							"<div style=\"display:".$display."\" id=\"Lay20\">",
							"<table style=\"width:100%;border-collapse:collapse;border:0\" cellpadding=\"0\" cellspacing=\"0\">";
			}
		if($value['permname']=='i_client_max_clones')
			{
			echo 			"</table>",
							"</div>",
							"</td>",
						"</tr>",
					"</table>",
					"</div>",
					"</td>",
				 "</tr>",
				 "<tr class='maincat left'>",
					"<td colspan='6'>&nbsp;<a href=\"javascript:Klappen(21)\"><img src=\"gfx/images/".$disp_pic.".png\" id=\"Pic21\" border=0 alt=\"aus/ein-klappen\"></a>&nbsp;".$lang['client']."</td>",
				 "</tr>",
				 "<tr>",
					 "<td style=\"width:100%\" colspan=\"6\">",
					 "<div style=\"display:".$display."\" id=\"Lay21\">",
					 "<table style=\"width:100%;border-collapse:collapse;\" cellpadding=\"0\" cellspacing=\"0\">";
			}
		if($value['permname']=='b_client_info_view')
			{
			echo 		"<tr>",
							"<td class='subcat' style='width:51px'>&nbsp;</td>",
							"<td class='subcat' colspan='5'>&nbsp;<a href=\"javascript:Klappen(22)\"><img src=\"gfx/images/".$disp_pic.".png\" id=\"Pic22\" border=0 alt=\"aus/ein-klappen\"></a>&nbsp;".$lang['information']."</td>",
						"</tr>",
						"<tr>",
							"<td colspan=\"6\">",
							"<div style=\"display:".$display."\" id=\"Lay22\">",
							"<table style=\"width:100%;border-collapse:collapse;border:0\" cellpadding=\"0\" cellspacing=\"0\">";
			}
		if($value['permname']=='i_client_kick_power')
			{
			echo 			"</table>",
							"</div>",
							"</td>",
						"</tr>",
						"<tr>",
							 "<td class='subcat'>&nbsp;</td>",
							 "<td class='subcat' colspan='5'>&nbsp;<a href=\"javascript:Klappen(23)\"><img src=\"gfx/images/".$disp_pic.".png\" id=\"Pic23\" border=0 alt=\"aus/ein-klappen\"></a>&nbsp;".$lang['admin']."</td>",
						"</tr>",
						"<tr>",
							"<td colspan=\"6\">",
							"<div style=\"display:".$display."\" id=\"Lay23\">",
							"<table style=\"width:100%;border-collapse:collapse;border:0\" cellpadding=\"0\" cellspacing=\"0\">";
			}
		if($value['permname']=='i_client_private_textmessage_power')
			{
			echo 			"</table>",
							"</div>",
							"</td>",
						"</tr>",
						"<tr>",
							"<td class='subcat'>&nbsp;</td>",
							"<td class='subcat' colspan='5'>&nbsp;<a href=\"javascript:Klappen(24)\"><img src=\"gfx/images/".$disp_pic.".png\" id=\"Pic24\" border=0 alt=\"aus/ein-klappen\"></a>&nbsp;".$lang['basics']."</td>",
						"</tr>",
						"<tr>",
							"<td colspan=\"6\">",
							"<div style=\"display:".$display."\" id=\"Lay24\">",
							"<table style=\"width:100%;border-collapse:collapse;border:0\" cellpadding=\"0\" cellspacing=\"0\">";
			}
		if($value['permname']=='b_client_modify_description')
			{
			echo 			"</table>",
							"</div>",
							"</td>",
						"</tr>",
						"<tr>",
							"<td class='subcat'>&nbsp;</td>",
							"<td class='subcat' colspan='5'>&nbsp;<a href=\"javascript:Klappen(25)\"><img src=\"gfx/images/".$disp_pic.".png\" id=\"Pic25\" border=0 alt=\"aus/ein-klappen\"></a>&nbsp;".$lang['modify']."</td>",
						"</tr>",
						"<tr>",
							"<td colspan=\"6\">",
							"<div style=\"display:".$display."\" id=\"Lay25\">",
							"<table style=\"width:100%;border-collapse:collapse;border:0\" cellpadding=\"0\" cellspacing=\"0\">";
			}
		if($value['permname']=='b_ft_ignore_password')
			{
			echo 			"</table>",
							"</div>",
							"</td>",
						"</tr>",
					"</table>",
					"</div>",
					"</td>",
				 "</tr>",
				 "<tr class='maincat left'>",
					"<td colspan='6'>&nbsp;<a href=\"javascript:Klappen(26)\"><img src=\"gfx/images/".$disp_pic.".png\" id=\"Pic26\" border=0 alt=\"aus/ein-klappen\"></a>&nbsp;".$lang['filetransfer']."</td></tr>",
				 "<tr>",
					 "<td style=\"width:100%\" colspan=\"6\">",
					 "<div style=\"display:".$display."\" id=\"Lay26\">",
					 "<table style=\"width:100%;border-collapse:collapse;\" cellpadding=\"0\" cellspacing=\"0\">";
			}
		
		if(strpos($value['permname'], 'i_needed_modify_power_')===false)
			{
		foreach($allperms AS $value2)
			{
			if(substr($value2['permname'], 22) == substr($value['permname'], 2))
				{
				$value['grant']=$value2['permvalue'];
				$value['grantpermid']=$value2['permid'];
				$value['grantav']=$value2['available'];
				}
			}
		if($showmyperms==1 AND $value['available']==1 OR $showmyperms==0)
			{
		?>
		<tr>
		
		<form method="POST" action="index.php?site=cgroupeditperm&amp;port=<?php echo $port; ?>&amp;cgid=<?php echo $cgid; ?>" name="<?php echo $value['permid']; ?>">
			<td class="<?php echo $td_col;?>" style="width:50px">&nbsp;</td>
			<td class="<?php echo $td_col;?>" style="width:45px"><?php echo $value['permid']; ?></td>
			<td class="<?php echo $td_col;?>" style="width:410px"><?php echo $value['permname']; ?> <br />(<?php echo $value['permdesc']; ?>)</td>
			<td class="<?php echo $td_col;?>" style="width:50px">
			<?php
			if(substr($value['permname'], 0, 2)!='i_')
				{
				$check='';
				if($value['permvalue']==1)
					{
					$check="checked='checked'";
					}
				?>
				
				<input type='checkbox' name="perm[<?php echo $value['permid']; ?>][value]" value="1" <?php echo $check; ?> />
			<?php } else { ?>
			
				<input <?php if($value['permname']=='i_icon_id') {echo "id=\"iconid\"";} ?> type='text' size="1" name="perm[<?php echo $value['permid']; ?>][value]" value="<?php echo $value['permvalue']; ?>" />
				<?php if($value['permname']=='i_icon_id') {echo "<a href=\"javascript:oeffnefenster('site/showallicons.php');\">".$lang['set']."</a>";} 
				 } ?>
			</td>
			<td class="<?php echo $td_col;?>" style="width:100px">
			<?php
			if($value['available']==1)
				{
				echo "<input type='hidden' name='perm[".$value['permid']."][available]' value='1' /> ";
				echo "<input type='checkbox' name='perm[".$value['permid']."][delperm]' value='1' /> ".$lang['delete'];
				}
			?>
			</td>
			<td class="<?php echo $td_col;?>" style="width:100px">
			<input type='text' maxlength="3" size="1" name="perm[<?php echo $value['grantpermid']; ?>][value]" value="<?php echo $value['grant']; ?>" />
			<input type='hidden' name='perm[<?php echo $value['grantpermid']; ?>][grant]' value='1' /> 
			<?php
			if($value['grantav']==1)
				{
				echo "<input type='hidden' name='perm[".$value['grantpermid']."][available]' value='1' /> ";
				echo "<input type='checkbox' name='perm[".$value['grantpermid']."][delperm]' value='1' /> ".$lang['delete'];
				}
			?>
			</td>
		</tr>
	<?php 	}
			}
		$change_col++;
		} ?>
		</table>
		</div>
		</td>
		</tr>
		
		<tr>
			<td colspan="6" class="center">
			<input type="hidden" name="showmyperms" value="<?php echo $showmyperms; ?>" />
			<input type="submit" name="editall" value="Edit" />
			</td>
		</tr>
		</form>
</table>
<?php } ?>