<?php if(!defined("SECURECHECK")) {die($lang['error_file_alone']);} 
if($port===false OR empty($port)) { echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?site=server\">";} else {
?>
<table style="width:100%" cellpadding="1" cellspacing="0">
<?php

if(isset($_POST['editserver']))
	{
	foreach($_POST['newsettings'] AS $key => $value)
		{
		$ts3->serverEdit($key, $value);
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
if(isset($_POST['editpw']))
	{
	foreach($_POST['newsettings'] AS $key => $value)
		{
		if($ts3->serverEdit($key, $value))
			{
			echo "<tr><td colspan='2' class='green1'>".$lang['passwordsetok']."</td></tr>";
			}
			else
			{
			echo "<tr><td colspan='2' class='green1'>".$ts3->getDebugLog()."</td></tr>";
			}
		}
	}

$serverinfo=$ts3->serverInfo();

$servergroups=$ts3->serverGroupList();
$channelgroups=$ts3->channelGroupList();

?>
	<tr valign="top">
		<td style="width:50%">
		<table  style="width:100%" class="border" cellpadding="1" cellspacing="0">
			<form method="post" action="index.php?site=serveredit&amp;port=<?php echo $port; ?>">
			<tr>
				<td class="thead" colspan="2"><?php echo $lang['virtualserver'];?> #<?php echo $serverinfo['virtualserver_id']; ?> <?php echo $lang['editor'];?> </td>
			</tr>
			<tr>
				<td class="green1" style="width:50%"><?php echo $lang['autostart']; ?>:</td>
				<td class="green1" style="width:50%">
				<?php echo $lang['yes']; ?><input type="radio" name="newsettings[autostart]" value="1" <?php if($serverinfo['virtualserver_autostart']==1) {echo "checked=\"checked\"";}?>/>
				<?php echo $lang['no']; ?><input type="radio" name="newsettings[autostart]" value="0" <?php if($serverinfo['virtualserver_autostart']==0) {echo "checked=\"checked\"";}?>/>
				</td>
			</tr>
			<tr>
				<td class="green2" style="width:50%"><?php echo $lang['port']; ?>:</td>
				<td class="green2" style="width:50%"><input type="text" name="newsettings[port]" value="<?php echo $serverinfo['virtualserver_port']; ?>"/></td>
			</tr>
			<tr>
				<td class="green1" style="width:50%"><?php echo $lang['minclientversion']; ?>:</td>
				<td class="green1" style="width:50%"><input type="text" name="newsettings[min_client_version]" value="<?php echo $serverinfo['virtualserver_min_client_version']; ?>"/></td>
			</tr>
			<tr>
				<td class="green2"><?php echo $lang['name']; ?>:</td>
				<td class="green2"><input type="text" name="newsettings[name]" value="<?php echo htmlentities($serverinfo['virtualserver_name'], ENT_QUOTES, "UTF-8"); ?>"/></td>
			</tr>
			<tr>
				<td class="green1"><?php echo $lang['welcomemsg']; ?>:</td>
				<td class="green1"><input type="text" name="newsettings[welcomemessage]" value="<?php echo htmlentities($serverinfo['virtualserver_welcomemessage'], ENT_QUOTES, "UTF-8"); ?>"/></td>
			</tr>
			<tr>
				<td class="green2"><?php echo $lang['maxclients']; ?>:</td>
				<td class="green2"><input type="text" name="newsettings[maxclients]" value="<?php echo $serverinfo['virtualserver_maxclients']; ?>"/></td>
			</tr>
			<tr>
				<td class="green1"><?php echo $lang['passwordset']; ?>:</td>
				<td class="green1">
				<?php if($serverinfo['virtualserver_flag_password']==1) {echo $lang['yes'];} else {echo $lang['no'];}?>
				</td>
			</tr>
			<tr>
				<td class="green2"><?php echo $lang['securitylevel']; ?>:</td>
				<td class="green2"><input type="text" name="newsettings[needed_identity_security_level]" value="<?php echo $serverinfo['virtualserver_needed_identity_security_level']; ?>"/></td>
			</tr>
			<tr>
				<td class="green1"><?php echo $lang['minclientschan']; ?>:</td>
				<td class="green1"><input type="text" name="newsettings[min_clients_in_channel_before_forced_silence]" value="<?php echo $serverinfo['virtualserver_min_clients_in_channel_before_forced_silence']; ?>"/></td>
			</tr>
			<tr>
				<td class="green2"><?php echo $lang['iconid']; ?>:</td>
				<td class="green2"><input id="iconid" type="text" name="newsettings[icon_id]" value="<?php echo $serverinfo['virtualserver_icon_id']; ?>"/><a href="javascript:oeffnefenster('site/showallicons.php');"><?php echo $lang['set']; ?></a></td>
			</tr>
			<tr>
				<td class="thead" colspan="2"><?php echo $lang['standardgroups']; ?></td>
			</tr>
			<tr>
				<td class="green1"><?php echo $lang['servergroup']; ?>:</td>
				<td class="green1">
				<select name="newsettings[default_server_group]">
				<?php
				foreach($servergroups AS $value)
					{
					$sel='';
					if($value['type']==1)
						{
						if ($value['sgid']==$serverinfo['virtualserver_default_server_group'])
							{
							$sel="selected='selected'";
							}
						echo "<option ".$sel." value='".$value['sgid']."'>(".$value['sgid'].") ".$value['name']."</option>";
						}
					}
				?>
				</select>
				</td>
			</tr>
			<tr>
				<td class="green2"><?php echo $lang['channelgroup']; ?>:</td>
				<td class="green2">
				<select name="newsettings[default_channel_group]">
				<?php
				foreach($channelgroups AS $value)
					{
					$sel='';
					if($value['type']==1)
						{
						if ($value['cgid']==$serverinfo['virtualserver_default_channel_group'])
							{
							$sel="selected='selected'";
							}
						echo "<option ".$sel." value='".$value['cgid']."'>(".$value['cgid'].") ".$value['name']."</option>";
						}
					}
				?>
				</select>
				</td>
			</tr>
			<tr>
				<td class="green1"><?php echo $lang['chanadmingroup']; ?>:</td>
				<td class="green1">
				<select name="newsettings[default_channel_admin_group]">
				<?php
				foreach($channelgroups AS $value)
					{
					$sel='';
					if($value['type']==1)
						{
						if ($value['cgid']==$serverinfo['virtualserver_default_channel_admin_group'])
							{
							$sel="selected='selected'";
							}
						echo "<option ".$sel." value='".$value['cgid']."'>(".$value['cgid'].") ".$value['name']."</option>";
						}
					}
				?>
				</select>
			</tr>
			<tr>
				<td class="thead" colspan="2"><?php echo $lang['host']; ?></td>
			</tr>
			<tr>
				<td class="green1"><?php echo $lang['hostmessage']; ?>:</td>
				<td class="green1"><input type="text" name="newsettings[hostmessage]" value="<?php echo htmlentities($serverinfo['virtualserver_hostmessage'], ENT_QUOTES, "UTF-8"); ?>"/></td>
			</tr>
			<tr>
				<td class="green2"><?php echo $lang['hostmessageshow']; ?>:</td>
				<td class="green2">
				<?php echo $lang['nomessage']; ?> <input type="radio" name="newsettings[hostmessage_mode]" value="0" <?php if($serverinfo['virtualserver_hostmessage_mode']==0) {echo "checked='checked'";}?>  /><br />
				<?php echo $lang['showmessagelog']; ?> <input type="radio" name="newsettings[hostmessage_mode]" value="1" <?php if($serverinfo['virtualserver_hostmessage_mode']==1) {echo "checked='checked'";}?>  /><br />
				<?php echo $lang['showmodalmessage']; ?> <input type="radio" name="newsettings[hostmessage_mode]" value="2" <?php if($serverinfo['virtualserver_hostmessage_mode']==2) {print "checked='checked'";}?>  /><br />
				<?php echo $lang['modalandexit']; ?> <input type="radio" name="newsettings[hostmessage_mode]" value="3" <?php if($serverinfo['virtualserver_hostmessage_mode']==3) {print "checked='checked'";}?>  />
				</td>
			</tr>
			<tr>
				<td class="green1" colspan="2">&nbsp;</td>
			</tr>
			<tr>
				<td class="green1"><?php echo $lang['hosturl']; ?>:</td>
				<td class="green1"><input type="text" name="newsettings[hostbanner_url]" value="<?php echo $serverinfo['virtualserver_hostbanner_url']; ?>"/></td>
			</tr>
			<tr>
				<td class="green2"><?php echo $lang['hostbannerurl']; ?>:</td>
				<td class="green2"><input type="text" name="newsettings[hostbanner_gfx_url]" value="<?php echo $serverinfo['virtualserver_hostbanner_gfx_url']; ?>"/></td>
			</tr>
			<tr>
				<td class="green1"><?php echo $lang['hostbannerintval']; ?>:</td>
				<td class="green1"><input type="text" name="newsettings[hostbanner_gfx_interval]" value="<?php echo $serverinfo['virtualserver_hostbanner_gfx_interval']; ?>"/></td>
			</tr>
			<tr>
				<td class="green2" colspan="2">&nbsp;</td>
			</tr>
			<tr>
				<td class="green2"><?php echo $lang['hostbuttontooltip']; ?>:</td>
				<td class="green2"><input type="text" name="newsettings[hostbutton_tooltip]" value="<?php echo $serverinfo['virtualserver_hostbutton_tooltip']; ?>"/></td>
			</tr>
			<tr>
				<td class="green1"><?php echo $lang['hostbuttonurl']; ?>:</td>
				<td class="green1"><input type="text" name="newsettings[hostbutton_url]" value="<?php echo $serverinfo['virtualserver_hostbutton_url']; ?>"/></td>
			</tr>
			<tr>
				<td class="thead" colspan="2"><?php echo $lang['autoban']; ?></td>
			</tr>
			<tr>
				<td class="green1"><?php echo $lang['autobancount']; ?>:</td>
				<td class="green1"><input type="text" name="newsettings[complain_autoban_count]" value="<?php echo $serverinfo['virtualserver_complain_autoban_count']; ?>"/></td>
			</tr>
			<tr>
				<td class="green2"><?php echo $lang['autobantime']; ?>:</td>
				<td class="green2"><input type="text" name="newsettings[complain_autoban_time]" value="<?php echo $serverinfo['virtualserver_complain_autoban_time']; ?>"/><?php echo $lang['seconds']; ?></td>
			</tr>
			<tr>
				<td class="green1"><?php echo $lang['removetime']; ?>:</td>
				<td class="green1"><input type="text" name="newsettings[complain_remove_time]" value="<?php echo $serverinfo['virtualserver_complain_remove_time']; ?>"/><?php echo $lang['seconds']; ?></td>
			</tr>
			<tr>
				<td class="thead" colspan="2"><?php echo $lang['antiflood']; ?></td>
			</tr>
			<tr>
				<td class="green1"><?php echo $lang['pointstickreduce']; ?>:</td>
				<td class="green1"><input type="text" name="newsettings[antiflood_points_tick_reduce]" value="<?php echo $serverinfo['virtualserver_antiflood_points_tick_reduce']; ?>"/></td>
			</tr>
			<tr>
				<td class="green2"><?php echo $lang['pointsneededwarning']; ?>:</td>
				<td class="green2"><input type="text" name="newsettings[antiflood_points_needed_warning]" value="<?php echo $serverinfo['virtualserver_antiflood_points_needed_warning']; ?>"/></td>
			</tr>
			<tr>
				<td class="green1"><?php echo $lang['pointsneededkick']; ?>:</td>
				<td class="green1"><input type="text" name="newsettings[antiflood_points_needed_kick]" value="<?php echo $serverinfo['virtualserver_antiflood_points_needed_kick']; ?>"/></td>
			</tr>
			<tr>
				<td class="green2"><?php echo $lang['pointsneededban']; ?>:</td>
				<td class="green2"><input type="text" name="newsettings[antiflood_points_needed_ban]" value="<?php echo $serverinfo['virtualserver_antiflood_points_needed_ban']; ?>"/></td>
			</tr>
			<tr>
				<td class="green1"><?php echo $lang['pointsbantime']; ?>:</td>
				<td class="green1"><input type="text" name="newsettings[antiflood_ban_time]" value="<?php echo $serverinfo['virtualserver_antiflood_ban_time']; ?>"/></td>
			</tr>
			<tr>
				<td class="thead" colspan="2"><?php echo $lang['transfers']; ?></td>
			</tr>
				<?php
				if($serverinfo['virtualserver_max_upload_total_bandwidth']=='18446744073709551615')
					{
					$serverinfo['virtualserver_max_upload_total_bandwidth']='-1';
					}
				?>
			<tr>
				<td class="green1"><?php echo $lang['upbandlimit']; ?>:</td>
				<td class="green1"><input type="text" name="newsettings[max_upload_total_bandwidth]" value="<?php echo $serverinfo['virtualserver_max_upload_total_bandwidth']; ?>"/>Byte/s</td>
			</tr>
			<tr>
				<td class="green2"><?php echo $lang['uploadquota']; ?>:</td>
				<?php
				if($serverinfo['virtualserver_upload_quota']=='18446744073709551615')
					{
					$serverinfo['virtualserver_upload_quota']='-1';
					}
				?>
				<td class="green2"><input type="text" name="newsettings[upload_quota]" value="<?php echo $serverinfo['virtualserver_upload_quota']; ?>"/>MiB</td>
			</tr>
			<tr>
				<?php
				if($serverinfo['virtualserver_max_download_total_bandwidth']=='18446744073709551615')
					{
					$serverinfo['virtualserver_max_download_total_bandwidth']='-1';
					}
				?>
				<td class="green1"><?php echo $lang['downbandlimit']; ?>:</td>
				<td class="green1"><input type="text" name="newsettings[max_download_total_bandwidth]" value="<?php echo $serverinfo['virtualserver_max_download_total_bandwidth']; ?>"/>Byte/s</td>
			</tr>
			<tr>
				<?php
				if($serverinfo['virtualserver_download_quota']=='18446744073709551615')
					{
					$serverinfo['virtualserver_download_quota']='-1';
					}
				?>
				<td class="green2"><?php echo $lang['downloadquota']; ?>:</td>
				<td class="green2"><input type="text" name="newsettings[download_quota]" value="<?php echo $serverinfo['virtualserver_download_quota']; ?>"/>MiB</td>
			</tr>
			<tr>
				<td class="green1"><?php echo $lang['option']; ?>:</td>
				<td class="green1"><input class="button" type="submit" name="editserver" value="Edit" /></td>
			</tr>
			</form>
		</table>
		</td>
		<td style="width:50%" align="center">
		<table class="border" cellpadding="1" cellspacing="0">
			<form method="post" action="index.php?site=serveredit&amp;port=<?php echo $port; ?>">
			<tr>
				<td class="thead" colspan="2"><?php echo $lang['serverpassword']; ?></td>
			</tr>
			<tr>
				<td class="green1"><?php echo $lang['newpassword']; ?>:</td>
				<td class="green1">
				<input type="text" name="newsettings[password]" value=""/>
				</td>
			</tr>
			<tr>
				<td class="green2"><?php echo $lang['option']; ?>:</td>
				<td class="green2"><input class="button" type="submit" name="editpw" value="Senden" /></td>
			</tr>
		</table>
		</td>
	</tr>
</table>
</form>
<?php } ?>