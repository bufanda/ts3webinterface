<?php
if(isset($_POST['editinstance']))
	{
	foreach($_POST['newsettings'] AS $key => $value)
		{
		$ts3->instanceEdit($key, $value);
		}
	
	$debug=$ts3->getDebugLog();
	if(empty($debug))
		{
		echo $lang['servereditok'];
		}
		else
		{
		echo $lang['editincomplete']."<br />".$debug;
		}
	}

$instanceinfo=$ts3->instanceInfo();
?>

<form method="post" action="index.php?site=instanceedit">
<table class="border" cellpadding="1" cellspacing="0">
	<tr>
		<td class="thead" colspan="2"><?php echo $lang['instanceedit']; ?></td>
	</tr>
	<tr>
		<td class="green1"><?php echo $lang['questsquerygroup']; ?></td>
		<td class="green1"><input type="text" name="newsettings[guest_serverquery_group]" value="<?php echo $instanceinfo['serverinstance_guest_serverquery_group']; ?>" /></td>
	</tr>
	<tr>
		<td class="green2"><?php echo $lang['tempsadmingroup']; ?></td>
		<td class="green2"><input type="text" name="newsettings[template_serveradmin_group]" value="<?php echo $instanceinfo['serverinstance_template_serveradmin_group']; ?>" /></td>
	</tr>
	<tr>
		<td class="green1"><?php echo $lang['tempcadmingroup']; ?></td>
		<td class="green1"><input type="text" name="newsettings[template_channeladmin_group]" value="<?php echo $instanceinfo['serverinstance_template_channeladmin_group']; ?>" /></td>
	</tr>
	<tr>
		<td class="green2"><?php echo $lang['tempsdefgroup']; ?></td>
		<td class="green2"><input type="text" name="newsettings[template_serverdefault_group]" value="<?php echo $instanceinfo['serverinstance_template_serverdefault_group']; ?>" /></td>
	</tr>
	<tr>
		<td class="green1"><?php echo $lang['tempcdefgroup']; ?></td>
		<td class="green1"><input type="text" name="newsettings[template_channeldefault_group]" value="<?php echo $instanceinfo['serverinstance_template_channeldefault_group']; ?>" /></td>
	</tr>
	<tr>
		<td class="green2"><?php echo $lang['filetransport']; ?></td>
		<td class="green2"><input type="text" name="newsettings[filetransfer_port]" value="<?php echo $instanceinfo['serverinstance_filetransfer_port']; ?>" /></td>
	</tr>
	<tr>
		<?php
		if($instanceinfo['serverinstance_max_download_total_bandwidth']=='18446744073709551615')
			{
			$instanceinfo['serverinstance_max_download_total_bandwidth']='-1';
			}
		?>
		<td class="green1"><?php echo $lang['maxdownbandwidth']; ?></td>
		<td class="green1"><input type="text" name="newsettings[max_download_total_bandwidth]" value="<?php echo $instanceinfo['serverinstance_max_download_total_bandwidth']; ?>" /></td>
	</tr>
	<tr>
		<?php
		if($instanceinfo['serverinstance_max_upload_total_bandwidth']=='18446744073709551615')
			{
			$instanceinfo['serverinstance_max_upload_total_bandwidth']='-1';
			}
		?>
		<td class="green2"><?php echo $lang['maxupbandwidth']; ?></td>
		<td class="green2"><input type="text" name="newsettings[max_upload_total_bandwidth]" value="<?php echo $instanceinfo['serverinstance_max_upload_total_bandwidth']; ?>" /></td>
	</tr>
	<tr>
		<td class="green1"><?php echo $lang['squeryfloodcmd']; ?></td>
		<td class="green1"><input type="text" name="newsettings[serverquery_flood_commands]" value="<?php echo $instanceinfo['serverinstance_serverquery_flood_commands']; ?>" /></td>
	</tr>
	<tr>
		<td class="green2"><?php echo $lang['squeryfloodtime']; ?></td>
		<td class="green2"><input type="text" name="newsettings[serverquery_flood_time]" value="<?php echo $instanceinfo['serverinstance_serverquery_flood_time']; ?>" /></td>
	</tr>
	<tr>
		<td class="green1"><?php echo $lang['squerybantime']; ?></td>
		<td class="green1"><input type="text" name="newsettings[serverquery_ban_time]" value="<?php echo $instanceinfo['serverinstance_serverquery_ban_time']; ?>" /></td>
	</tr>
	<tr>
		<td class="green2"><?php echo $lang['option']; ?>:</td>
		<td class="green2"><input class="button" type="submit" name="editinstance" value="<?php echo $lang['edit']; ?>" /></td>
</table>
</form>