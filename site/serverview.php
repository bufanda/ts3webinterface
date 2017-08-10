<?php if(!defined("SECURECHECK")) {die($lang['error_file_alone']);}
if(isset($_POST['sendkick']))
	{
	$ts3->clientKick($_POST['clid'], 5, $_POST['kickmsg']);
	}

if(isset($_POST['sendban']))
	{
	$ts3->clientBanByClid($_POST['clid'], $_POST['bantime'], $_POST['banmsg']);
	}
	
if(isset($_POST['sendpoke']))
	{
	$ts3->clientPoke($_POST['clid'], $_POST['pokemsg']);
	}
	
if(isset($_POST['sendmove']))
	{
	$ts3->clientMove($_POST['clid'], $_POST['cid']);
	}
	
if(isset($_POST['sendmsg']))
	{
	$ts3->sendMessage('3', $_POST['sid'], $_POST['msgtoserver']);
	}
	
if(isset($_POST['start']))
	{
	$ts3->serverStart($_POST['sid']);
	echo $ts3->getDebugLog();
	}
	
if(isset($_POST['stop']))
	{
	$ts3->serverStop($_POST['sid']);
	$ts3->selectServerByPort($port);
	}
$serverinfo=$ts3->serverInfo();
$servergroups=$ts3->serverGroupList();
$channelgroups=$ts3->channelGroupList();
$newserverversion=check_server_version($serverinfo['virtualserver_version'], $seversionurl);?>
<table style="width:100%" cellpadding="1" cellspacing="0">
<?php
if($newserverversion!==true AND !empty($serverinfo['virtualserver_version']))
					{
					echo "<tr><td class=\"green1 warning center\" colspan=\"2\">".$lang['serverupdateav'].$newserverversion."</td></tr>";
					}
					
?>
	<tr valign="top">
		<td style="width:50%">
		<table class="border" style="width:100%;" cellpadding="1" cellspacing="0">
			<tr>
				<td class="thead" colspan="7"><?php echo $lang['msgtoserver']; ?></td>
			</tr>
			<tr>
				<form method="post" action="index.php?site=serverview&amp;port=<?php echo $port; ?>">
				<td class="green1"><input type="text" name="msgtoserver" size="60" value=""/></td>
				<td class="green1">
				<input type="hidden" name="sid" value="<?php echo $serverinfo['virtualserver_id']; ?>" />
				<input class="button" type="submit" name="sendmsg" value="<?php echo $lang['send']; ?>" />
				</td>
				</form>
			</tr>
		</table>
		<br />
		<table style="width:100%" class="border" cellpadding="1" cellspacing="0">
		<?php 
		if($serverhost===true AND $hoststatus===false)
			{?>
			<tr>
				<td class="center">
				<form method="post" action="index.php?site=serverview&amp;port=<?php echo $port; ?>">
				<input type="hidden" name="sid" value="<?php echo $serverinfo['virtualserver_id']; ?>" />
				<input class="start" type="submit" name="start" value="" title="<?php echo $lang['start']; ?>" />
				</form>
				</td>
				<td class="center">
				<form method="post" action="index.php?site=serverview&amp;port=<?php echo $port; ?>">
				<input type="hidden" name="sid" value="<?php echo $serverinfo['virtualserver_id']; ?>" />
				<input class="stop" type="submit" name="stop" value="" title="<?php echo $lang['stop']; ?>" onclick="return confirm('<?php echo $lang['stopservermsg']; ?>')" />
				</form>
				</td>
			</tr>
	<?php	} ?>
			<tr>
				<td class="thead" colspan="2"><?php echo $lang['virtualserver'];?> #<?php echo $serverinfo['virtualserver_id']; ?></td>
			</tr>
			<tr>
				<td class="maincat left" colspan="2"><?php echo $lang['basics']; ?></td>
			</tr>
			<tr>
				<td class="green1"><?php echo $lang['autostart']; ?>:</td>
				<td class="green1">
				<?php 
				if($serverinfo['virtualserver_autostart']==1)
					{
					echo $lang['yes'];
					}
					else
					{
					echo $lang['no'];
					}
				?>
				</td>
			</tr>
			<tr>
				<td class="green2"><?php echo $lang['serveraddress']; ?>:</td>
				<td class="green2"><?php echo $_SESSION['server_ip'].":".$serverinfo['virtualserver_port']; ?></td>
			</tr>
			<tr>
				<td class="green1" style="width:50%"><?php echo $lang['minclientversion']; ?>:</td>
				<td class="green1" style="width:50%"><?php echo $serverinfo['virtualserver_min_client_version']; ?></td>
			</tr>
			<tr>
				<td class="green2"><?php echo $lang['uniqueid']; ?>:</td>
				<td class="green2"><?php echo $serverinfo['virtualserver_unique_identifier']; ?></td>
			</tr>
			<tr>
				<td class="green1"><?php echo $lang['name']; ?>:</td>
				<td class="green1"><?php echo $serverinfo['virtualserver_name']; ?></td>
			</tr>
			<tr>
				<td class="green2"><?php echo $lang['version']; ?>:</td>
				<td class="green2"><?php echo $serverinfo['virtualserver_version']; ?></td>
			</tr>
			<tr>
				<td class="green1"><?php echo $lang['platform']; ?>:</td>
				<td class="green1"><?php echo $serverinfo['virtualserver_platform']; ?></td>
			</tr>
			<tr>
				<td class="green2"><?php echo $lang['created']; ?>:</td>
				<td class="green2"><?php echo date("d.m.Y - H:i", $serverinfo['virtualserver_created']); ?></td>
			</tr>
			<tr>
				<td class="green1"><?php echo $lang['status']; ?></td>
				<td class="green1"><?php echo $serverinfo['virtualserver_status']; ?></td>
			</tr>
			<tr>
				<td class="green2"><?php echo $lang['runtime']; ?>:</td>
				<td class="green2">
				<?php 
				if($oldserver===true)
					{
					$conv_time=$ts3->convertMillisecondsToStrTime($serverinfo['virtualserver_uptime']);
					}
					else
					{
					$conv_time=$ts3->convertSecondsToStrTime($serverinfo['virtualserver_uptime']);
					}
				$time_string=$conv_time['days'].$lang['days']." ".$conv_time['hours'].$lang['hours']." ".$conv_time['mins'].$lang['minutes']." ".$conv_time['secs'].$lang['seconds'];
				echo $time_string; ?></td>
			</tr>
			<tr>
				<td class="green1"><?php echo $lang['clients']; ?>:</td>
				<td class="green1"><?php echo ($serverinfo['virtualserver_clientsonline'] - $serverinfo['virtualserver_queryclientsonline'])." / ".$serverinfo['virtualserver_maxclients']; ?></td>
			</tr>
			<tr>
				<td class="green2"><?php echo $lang['queryclients']; ?>:</td>
				<td class="green2"><?php echo $serverinfo['virtualserver_queryclientsonline']; ?></td>
			</tr>
			<tr>
				<td class="green1"><?php echo $lang['channel']; ?>:</td>
				<td class="green1"><?php echo $serverinfo['virtualserver_channelsonline']; ?></td>
			</tr>
			<tr>
				<td class="green2"><?php echo $lang['minclientschan']; ?>:</td>
				<td class="green2"><?php echo $serverinfo['virtualserver_min_clients_in_channel_before_forced_silence']; ?></td>
			</tr>
			<tr>
				<td class="green1"><?php echo $lang['clientsdimm']; ?>:</td>
				<td class="green1"><?php echo $serverinfo['virtualserver_priority_speaker_dimm_modificator']; ?></td>
			</tr>
			<tr>
				<td class="green2"><?php echo $lang['passwordset']; ?>:</td>
				<td class="green2">
				<?php 
				if($serverinfo['virtualserver_flag_password']==1)
					{
					echo $lang['yes'];
					}
					else
					{
					echo $lang['no'];
					}
				?>
				</td>
			</tr>
			<tr>
				<td class="green1"><?php echo $lang['securitylevel']; ?>:</td>
				<td class="green1"><?php echo $serverinfo['virtualserver_needed_identity_security_level']; ?></td>
			</tr>
			<tr>
				<td class="green2"><?php echo $lang['iconid']; ?>:</td>
				<td class="green2"><?php echo $serverinfo['virtualserver_icon_id']; ?></td>
			</tr>
			<tr>
				<td class="maincat left" colspan="2"><?php echo $lang['standardgroups']; ?></td>
			</tr>
			<tr>
				<td class="green1"><?php echo $lang['servergroup']; ?>:</td>
				<td class="green1">
				<?php
				foreach($servergroups AS $value)
					{
					if ($value['sgid']==$serverinfo['virtualserver_default_server_group'])
						{
						echo "(".$value['sgid'].")".$value['name'];
						}
					}
				?>
				</td>
			</tr>
			<tr>
				<td class="green2"><?php echo $lang['channelgroup']; ?>:</td>
				<td class="green2">
				<?php
				foreach($channelgroups AS $value)
					{
					if ($value['cgid']==$serverinfo['virtualserver_default_channel_group'])
						{
						echo "(".$value['cgid'].")".$value['name'];
						}
					}
				?>
				</td>
			</tr>
			<tr>
				<td class="green1"><?php echo $lang['chanadmingroup']; ?>:</td>
				<td class="green1">
				<?php
				foreach($channelgroups AS $value)
					{
					if ($value['cgid']==$serverinfo['virtualserver_default_channel_admin_group'])
						{
						echo "(".$value['cgid'].")".$value['name'];
						}
					}
				?>
				</td>
			</tr>
			<tr>
				<td class="maincat left" colspan="2"><?php echo $lang['host']; ?></td>
			</tr>
			<tr>
				<td class="green1"><?php echo $lang['hostmessage']; ?>:</td>
				<td class="green1"><?php echo $serverinfo['virtualserver_hostmessage']; ?></td>
			</tr>
			<tr>
				<td class="green2"><?php echo $lang['hostmessageshow']; ?>:</td>
				<td class="green2">
				<?php 
				if ($serverinfo['virtualserver_hostmessage_mode']=='0')
					{
					echo $lang['nomessage'];
					}
					elseif($serverinfo['virtualserver_hostmessage_mode']=='1')
					{
					echo $lang['showmessagelog'];
					}
					elseif($serverinfo['virtualserver_hostmessage_mode']=='2')
					{
					echo $lang['showmodalmessage'];;
					}
					elseif($serverinfo['virtualserver_hostmessage_mode']=='3')
					{
					echo $lang['modalandexit'];;
					}
				?>
			</tr>
			<tr>
				<td class="green1" colspan="2">&nbsp;</td>
			</tr>
			<tr>
				<td class="green1"><?php echo $lang['hosturl']; ?>:</td>
				<td class="green1"><?php echo $serverinfo['virtualserver_hostbanner_url']; ?></td>
			</tr>
			<tr>
				<td class="green2"><?php echo $lang['hostbannerurl']; ?>:</td>
				<td class="green2"><?php echo $serverinfo['virtualserver_hostbanner_gfx_url']; ?></td>
			</tr>
			<tr>
				<td class="green1"><?php echo $lang['hostbannerintval']; ?>:</td>
				<td class="green1"><?php echo $serverinfo['virtualserver_hostbanner_gfx_interval']; ?></td>
			</tr>
			<tr>
				<td class="green2" colspan="2">&nbsp;</td>
			</tr>
			<tr>
				<td class="green2"><?php echo $lang['hostbuttontooltip']; ?>:</td>
				<td class="green2"><?php echo $serverinfo['virtualserver_hostbutton_tooltip']; ?></td>
			</tr>
			<tr>
				<td class="green1"><?php echo $lang['hostbuttonurl']; ?>:</td>
				<td class="green1"><?php echo $serverinfo['virtualserver_hostbutton_url']; ?></td>
			</tr>
			<tr>
				<td class="maincat left" colspan="2"><?php echo $lang['autoban']; ?></td>
			</tr>
			<tr>
				<td class="green2"><?php echo $lang['autobancount']; ?>:</td>
				<td class="green2"><?php echo $serverinfo['virtualserver_complain_autoban_count']; ?></td>
			</tr>
			<tr>
				<td class="green1"><?php echo $lang['autobantime']; ?>:</td>
				<td class="green1"><?php echo $serverinfo['virtualserver_complain_autoban_time']; ?></td>
			</tr>
			<tr>
				<td class="green2"><?php echo $lang['removetime']; ?>:</td>
				<td class="green2"><?php echo $serverinfo['virtualserver_complain_remove_time']; ?></td>
			</tr>
			<tr>
				<td class="maincat left" colspan="2"><?php echo $lang['antiflood']; ?></td>
			</tr>
			<tr>
				<td class="green1"><?php echo $lang['pointstickreduce']; ?>:</td>
				<td class="green1"><?php echo $serverinfo['virtualserver_antiflood_points_tick_reduce']; ?></td>
			</tr>
			<tr>
				<td class="green2"><?php echo $lang['pointsneededwarning']; ?>:</td>
				<td class="green2"><?php echo $serverinfo['virtualserver_antiflood_points_needed_warning']; ?></td>
			</tr>
			<tr>
				<td class="green1"><?php echo $lang['pointsneededkick']; ?>:</td>
				<td class="green1"><?php echo $serverinfo['virtualserver_antiflood_points_needed_kick']; ?></td>
			</tr>
			<tr>
				<td class="green2"><?php echo $lang['pointsneededban']; ?>:</td>
				<td class="green2"><?php echo $serverinfo['virtualserver_antiflood_points_needed_ban']; ?></td>
			</tr>
			<tr>
				<td class="green1"><?php echo $lang['pointsbantime']; ?>:</td>
				<td class="green1"><?php echo $serverinfo['virtualserver_antiflood_ban_time']; ?></td>
			</tr>
			<tr>
				<td class="maincat left" colspan="2"><?php echo $lang['logs']; ?></td>
			</tr>
			<tr>
				<td class="green1"><?php echo $lang['logclient']; ?>:</td>
				<td class="green1"><?php echo $serverinfo['virtualserver_log_client']; ?></td>
			</tr>
			<tr>
				<td class="green2"><?php echo $lang['logquery']; ?>:</td>
				<td class="green2"><?php echo $serverinfo['virtualserver_log_query']; ?></td>
			</tr>
			<tr>
				<td class="green1"><?php echo $lang['logchannel']; ?>:</td>
				<td class="green1"><?php echo $serverinfo['virtualserver_log_channel']; ?></td>
			</tr>
			<tr>
				<td class="green2"><?php echo $lang['logpermissions']; ?>:</td>
				<td class="green2"><?php echo $serverinfo['virtualserver_log_permissions']; ?></td>
			</tr>
			<tr>
				<td class="green1"><?php echo $lang['logserver']; ?>:</td>
				<td class="green1"><?php echo $serverinfo['virtualserver_log_server']; ?></td>
			</tr>	
		</table>
		</td>
		<td style="width:50%" align="center">
		<?php
		include("tsview.php");
		?>
		</td>
	</tr>
</table>