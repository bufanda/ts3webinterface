<?php if(!defined("SECURECHECK")) {die($lang['error_file_alone']);} 
if($hoststatus===false AND $serverhost===true) { echo $lang['nohoster']; } else {?>
<table class="border" cellpadding="1" cellspacing="0">
<?php
$error=0;
$e_msg='';
if(isset($_POST['createserver']))
	{
	$newsettings[]=array('port', $_POST['port']);
	$newsettings[]=array('min_client_version', $_POST['min_client_version']);
	$newsettings[]=array('name', $_POST['name']);
	$newsettings[]=array('welcomemessage', $_POST['welcomemessage']);
	$newsettings[]=array('maxclients', $_POST['maxclients']);
	$newsettings[]=array('password', $_POST['password']);
	$newsettings[]=array('needed_identity_security_level', $_POST['needed_identity_security_level']);
	$newsettings[]=array('min_clients_in_channel_before_forced_silence', $_POST['min_clients_in_channel_before_forced_silence']);
	$newsettings[]=array('hostmessage', $_POST['hostmessage']);
	$newsettings[]=array('hostmessage_mode', $_POST['hostmessage_mode']);
	$newsettings[]=array('hostbanner_url', $_POST['hostbanner_url']);
	$newsettings[]=array('hostbanner_gfx_url', $_POST['hostbanner_gfx_url']);
	$newsettings[]=array('hostbanner_gfx_interval', $_POST['hostbanner_gfx_interval']);
	$newsettings[]=array('hostbutton_tooltip', $_POST['hostbutton_tooltip']);
	$newsettings[]=array('hostbutton_url', $_POST['hostbutton_url']);
	$newsettings[]=array('complain_autoban_count', $_POST['complain_autoban_count']);
	$newsettings[]=array('complain_autoban_time', $_POST['complain_autoban_time']);
	$newsettings[]=array('complain_remove_time', $_POST['complain_remove_time']);
	$newsettings[]=array('antiflood_points_tick_reduce', $_POST['antiflood_points_tick_reduce']);
	$newsettings[]=array('antiflood_points_needed_warning', $_POST['antiflood_points_needed_warning']);
	$newsettings[]=array('antiflood_points_needed_kick', $_POST['antiflood_points_needed_kick']);
	$newsettings[]=array('antiflood_points_needed_ban', $_POST['antiflood_points_needed_ban']);
	$newsettings[]=array('antiflood_ban_time', $_POST['antiflood_ban_time']);
	$newsettings[]=array('max_upload_total_bandwidth', $_POST['max_upload_total_bandwidth']);
	$newsettings[]=array('upload_quota', $_POST['upload_quota']);
	$newsettings[]=array('max_download_total_bandwidth', $_POST['max_download_total_bandwidth']);
	$newsettings[]=array('download_quota', $_POST['download_quota']);
	
	$token=$ts3->serverCreate($newsettings);
	if($token!==false)
		{
		echo "<tr><td class=\"green1\" colspan=\"2\">Token: ".$token."</td></tr>";
		}
		else
		{
		$error++;
		echo $ts3->getDebugLog();
		}
	}

if(!isset($_POST['createserver']) OR !empty($error))
	{
?>
	<form method="post" action="index.php?site=createserver">
			<tr>
				<td colspan="2"><?php echo $lang['createserverdesc']; ?></td>
			</tr>
			<tr>
				<td class="thead" colspan="2"><?php echo $lang['createnewserver']; ?></td>
			</tr>
			<tr>
				<td class="green1"><?php echo $lang['name']; ?>:</td>
				<td class="green1"><input type="text" name="name" value=""/></td>
			</tr>
			<tr>
				<td class="green2" style="width:50%"><?php echo $lang['port']; ?>:</td>
				<td class="green2" style="width:50%"><input type="text" name="port" value=""/></td>
			</tr>
			<tr>
				<td class="green1" style="width:50%"><?php echo $lang['minclientversion']; ?>:</td>
				<td class="green1" style="width:50%"><input type="text" name="min_client_version" value=""/></td>
			</tr>
			<tr>
				<td class="green2"><?php echo $lang['welcomemsg']; ?>:</td>
				<td class="green2"><input type="text" name="welcomemessage" value=""/></td>
			</tr>
			<tr>
				<td class="green1"><?php echo $lang['maxclients']; ?>:</td>
				<td class="green1"><input type="text" name="maxclients" value=""/></td>
			</tr>
			<tr>
				<td class="green2"><?php echo $lang['password']; ?>:</td>
				<td class="green2">
				<input type="text" name="password" value=""/>
				</td>
			</tr>
			<tr>
				<td class="green1"><?php echo $lang['securitylevel']; ?>:</td>
				<td class="green1"><input type="text" name="needed_identity_security_level" value=""/></td>
			</tr>
			<tr>
				<td class="green2"><?php echo $lang['minclientschan']; ?>:</td>
				<td class="green2"><input type="text" name="min_clients_in_channel_before_forced_silence" value=""/></td>
			</tr>
			<tr>
				<td class="thead" colspan="2"><?php echo $lang['host']; ?></td>
			</tr>
			<tr>
				<td class="green1"><?php echo $lang['hostmessage']; ?>:</td>
				<td class="green1"><input type="text" name="hostmessage" value=""/></td>
			</tr>
			<tr>
				<td class="green2"><?php echo $lang['hostmessageshow']; ?>:</td>
				<td class="green2">
				<?php echo $lang['nomessage']; ?> <input type="radio" name="hostmessage_mode" value="0" /><br />
				<?php echo $lang['showmessagelog']; ?> <input type="radio" name="hostmessage_mode" value="1" /><br />
				<?php echo $lang['showmodalmessage']; ?> <input type="radio" name="hostmessage_mode" value="2" /><br />
				<?php echo $lang['modalandexit']; ?> <input type="radio" name="hostmessage_mode" value="3" />
				</td>
			</tr>
			<tr>
				<td class="green1" colspan="2">&nbsp;</td>
			</tr>
			<tr>
				<td class="green1"><?php echo $lang['hosturl']; ?>:</td>
				<td class="green1"><input type="text" name="hostbanner_url" value=""/></td>
			</tr>
			<tr>
				<td class="green2"><?php echo $lang['hostbannerurl']; ?>:</td>
				<td class="green2"><input type="text" name="hostbanner_gfx_url" value=""/></td>
			</tr>
			<tr>
				<td class="green1"><?php echo $lang['hostbannerintval']; ?>:</td>
				<td class="green1"><input type="text" name="hostbanner_gfx_interval" value=""/></td>
			</tr>
			<tr>
				<td class="green2" colspan="2">&nbsp;</td>
			</tr>
			<tr>
				<td class="green2"><?php echo $lang['hostbuttontooltip']; ?>:</td>
				<td class="green2"><input type="text" name="hostbutton_tooltip" value=""/></td>
			</tr>
			<tr>
				<td class="green1"><?php echo $lang['hostbuttonurl']; ?>:</td>
				<td class="green1"><input type="text" name="hostbutton_url" value=""/></td>
			</tr>
			<tr>
				<td class="thead" colspan="2"><?php echo $lang['autoban']; ?></td>
			</tr>
			<tr>
				<td class="green1"><?php echo $lang['autobancount']; ?>:</td>
				<td class="green1"><input type="text" name="complain_autoban_count" value=""/></td>
			</tr>
			<tr>
				<td class="green2"><?php echo $lang['autobantime']; ?>:</td>
				<td class="green2"><input type="text" name="complain_autoban_time" value=""/><?php echo $lang['seconds']; ?></td>
			</tr>
			<tr>
				<td class="green1"><?php echo $lang['removetime']; ?>:</td>
				<td class="green1"><input type="text" name="complain_remove_time" value=""/><?php echo $lang['seconds']; ?></td>
			</tr>
			<tr>
				<td class="thead" colspan="2"><?php echo $lang['antiflood']; ?></td>
			</tr>
			<tr>
				<td class="green1"><?php echo $lang['pointstickreduce']; ?>:</td>
				<td class="green1"><input type="text" name="antiflood_points_tick_reduce" value=""/></td>
			</tr>
			<tr>
				<td class="green2"><?php echo $lang['pointsneededwarning']; ?>:</td>
				<td class="green2"><input type="text" name="antiflood_points_needed_warning" value=""/></td>
			</tr>
			<tr>
				<td class="green1"><?php echo $lang['pointsneededkick']; ?>:</td>
				<td class="green1"><input type="text" name="antiflood_points_needed_kick" value=""/></td>
			</tr>
			<tr>
				<td class="green2"><?php echo $lang['pointsneededban']; ?>:</td>
				<td class="green2"><input type="text" name="antiflood_points_needed_ban" value=""/></td>
			</tr>
			<tr>
				<td class="green1"><?php echo $lang['pointsbantime']; ?>:</td>
				<td class="green1"><input type="text" name="antiflood_ban_time" value=""/></td>
			</tr>
			<tr>
				<td class="thead" colspan="2"><?php echo $lang['transfers']; ?></td>
			</tr>
			<tr>
				<td class="green1"><?php echo $lang['upbandlimit']; ?>:</td>
				<td class="green1"><input type="text" name="max_upload_total_bandwidth" value=""/>Byte/s</td>
			</tr>
			<tr>
				<td class="green2"><?php echo $lang['uploadquota']; ?>:</td>
				<td class="green2"><input type="text" name="upload_quota" value=""/>MiB</td>
			</tr>
			<tr>
				<td class="green1"><?php echo $lang['downbandlimit']; ?>:</td>
				<td class="green1"><input type="text" name="max_download_total_bandwidth" value=""/>Byte/s</td>
			</tr>
			<tr>
				<td class="green2"><?php echo $lang['downloadquota']; ?>:</td>
				<td class="green2"><input type="text" name="download_quota" value=""/>MiB</td>
			</tr>
	<tr>
		<td class="green1"><?php echo $lang['option']; ?></td>
		<td class="green1"><input class="button" type="submit" name="createserver" value="<?php echo $lang['create']; ?>" /></td>
	</tr>
	</form>
<?php } ?>
</table>
<?php } ?>