<?php 
if(!defined("SECURECHECK")) {die($lang['error_file_alone']);} 
if($port===false OR empty($port)) { echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?site=server\">";} else {
$channellist=$ts3->channelList("-topic -flags -voice -limits");
function deploy_backup($pid, $backup, $newcid)
	{
	global $ts3;

	foreach($backup AS $key=>$value)
		{
		if ($pid==$value['pid'])
			{
			$settings[]=array('name', $value['channel_name']);
			if($value['pid']!=0)
				{
				$settings[]=array('cpid', $newcid);
				}
			$settings[]=array('topic', $value['channel_topic']);
			$settings[]=array('description', $value['channel_description']);
			$settings[]=array('codec', $value['channel_codec']);
			$settings[]=array('codec_quality', $value['channel_codec_quality']);
			$settings[]=array('maxclients', $value['channel_maxclients']);
			$settings[]=array('maxfamilyclients', $value['channel_maxfamilyclients']);
			$settings[]=array('flag_permanent', $value['channel_flag_permanent']);
			$settings[]=array('flag_semi_permanent', $value['channel_flag_semi_permanent']);
			$settings[]=array('flag_temporary', $value['channel_flag_temporary']);
			$settings[]=array('flag_default', $value['channel_flag_default']);
			$settings[]=array('flag_maxfamilyclients_inherited', $value['channel_flag_maxfamilyclients_inherited']);
			$settings[]=array('needed_talk_power', $value['channel_needed_talk_power']);
			$settings[]=array('name_phonetic', $value['channel_name_phonetic']);
			$cid=$ts3->channelCreate($settings);

			deploy_backup($value['cid'], $backup, $cid);
			}
		}
	}

if(isset($_POST['create']))
	{
	if(isset($_POST['hostbackup']))
		{
		$path="site/backups/channel/hostbackups/";
		}
		else
		{
		$path="site/backups/channel/";
		}
	$handler=fopen($path."channel_".time()."_".$_SESSION['server_ip']."-".$port.".txt", "a+");
	$count=1;
	$count_chans=count($channellist);
	foreach($channellist AS $key=>$value)
		{
		$settings='';
		$count2=1;
		foreach($value AS $key2=>$value2)
			{
			$count_settings=count($value);
			$settings.=$key2."=".str_replace(' ', '\s',$value2);
			if($count2!=$count_settings)
				{
				$settings.=" ";
				}
			$count2++;
			}
		if($count!=$count_chans)
			{
			$settings.="|";
			}
		fwrite($handler, $settings);
		$count++;
		}
	fclose($handler);
	}

if(isset($_POST['deploy']))
	{
	if(isset($_POST['hostbackup']))
		{
		$path="site/backups/channel/hostbackups/";
		}
		else
		{
		$path="site/backups/channel/";
		}
	$handler=file($path."channel_".$_POST['backupid']."_".$_POST['fileport'].".txt");
	$getdata=explode('|',$handler[0]);
	foreach($getdata AS $key=>$value)
		{
		$getsettings=explode(' ', $getdata[$key]);
		foreach($getsettings AS $key2=>$value2)
			{
			$equalCount = substr_count($value2, '=');
			if($equalCount > 1)
				{
				$settings = explode('=', $value2);
				for($i=2; $i<=$equalCount; $i++) 
					{
					if(!empty($settings[$i])) 
						{
						$settings[1].= '='.$settings[$i];
						}
					else
						{
						$settings[1].= '=';
						}
					}
				}
			else
				{
				$settings=explode('=', $value2);
				}
			
			if(!empty($settings[0]))
				{
				$backup[$key][$settings[0]]=$settings[1];
				}
			}
		}


	$rename_def=0;

	foreach($channellist AS $key => $value)
		{
		if($rename_def==0)
			{
			$settings[]=array('name', 'Auto delete after backup');
			$settings[]=array('flag_permanent', '1');
			$settings[]=array('flag_semi_permanent', '0');
			$settings[]=array('flag_default', '1');
			$ts3->channelEdit($value['cid'], $settings);
			$rename_def=1;
			}
			else
			{
			$ts3->channelDelete($value['cid']);
			}
		}
	deploy_backup('0', $backup, 0);
	$channellist=$ts3->channelList();
	foreach($channellist AS $key => $value)
		{
		if($value['channel_name']=='Auto delete after backup')
			{
			$ts3->channelDelete($value['cid']);
			}
		}
	}

if(isset($_POST['delete']))
	{
	if(isset($_POST['hostbackup']))
		{
		$path="site/backups/channel/hostbackups/";
		}
		else
		{
		$path="site/backups/channel/";
		}
	unlink($path."channel_".$_POST['backupid']."_".$_POST['fileport'].".txt");
	}


foreach($channellist AS $key=>$value)
	{
	$getinfo=$ts3->channelInfo($value['cid']);
	$channellist[$key]['channel_description']=isset($getinfo['channel_description']) ? $getinfo['channel_description']:'';
	$channellist[$key]['channel_flag_maxclients_unlimited']=$getinfo['channel_flag_maxclients_unlimited'];
	$channellist[$key]['channel_flag_maxfamilyclients_unlimited']=$getinfo['channel_flag_maxfamilyclients_unlimited'];
    $channellist[$key]['channel_flag_maxfamilyclients_inherited']=$getinfo['channel_flag_maxfamilyclients_inherited'];
	$channellist[$key]['channel_forced_silence']=$getinfo['channel_forced_silence'];
	}
?>
<table class="border" style="width:100%" cellpadding="1" cellspacing="0">
	<tr>
		<td class="center" colspan="3" style="font-size:12px;"><?php echo $lang['chanbackdesc']; ?></td>
	</tr>
	<tr>
		<td class="thead" colspan="3"><?php echo $lang['chanbackups']; ?></td>
	</tr>
	<tr>
		<td class="thead"><?php echo $lang['created']; ?></td>
		<td class="thead"><?php echo $lang['server']; ?></td>
		<td class="thead"><?php echo $lang['options']; ?></td>
	</tr>
<?php
$change_col=1;
$handler=opendir("site/backups/channel");
while($datei=readdir($handler))
	{
	if($datei!='.' AND $datei!='..' AND $datei!='hostbackups')
		{
		$datei=str_replace('.txt', '', $datei);
		$datei_info=explode('_', $datei);
		if($serverhost==true AND $hoststatus==true OR $serverhost==true AND $hoststatus==false AND $datei_info[2]==$_SESSION['server_ip']."-".$port or $serverhost==false)
			{
			if($change_col%2) { $td_col="green1";} else {$td_col="green2";}
			?>
			<tr>
				<td class="<?php echo $td_col; ?> center"><?php echo date("d.m.Y - H:i", $datei_info[1]); ?></td>
				<td class="<?php echo $td_col; ?> center"><?php echo $datei_info[2]; ?></td>
				<td class="<?php echo $td_col; ?> center">
				<input class="view" type="button" name="view" value="" title="<?php echo $lang['view']; ?>" onClick="oeffnefenster('site/chanbackupview.php?backupid=<?php echo $datei_info[1]; ?>&amp;fileport=<?php echo $datei_info[2]; ?>');"/>
				<form method="post" action="index.php?site=backup&amp;port=<?php echo $port; ?>">
				<input type="hidden" name="backupid" value="<?php echo $datei_info[1]; ?>" />
				<input type="hidden" name="fileport" value="<?php echo $datei_info[2]; ?>" />
				<input class="start" type="submit" name="deploy" value="" title="<?php echo $lang['deploy']; ?>" />
				</form>
				<form method="post" action="index.php?site=backup&amp;port=<?php echo $port; ?>">
				<input type="hidden" name="backupid" value="<?php echo $datei_info[1]; ?>" />
				<input type="hidden" name="fileport" value="<?php echo $datei_info[2]; ?>" />
				<input class="delete" type="submit" name="delete" value="" title="<?php echo $lang['delete']; ?>" />
				</form>
				</td>
			</tr>
		<?php
			$change_col++;
			}
		}
	}	
?>
</table>
<?php
if($serverhost==true AND $hoststatus==true OR $serverhost==false)
	{
	?>
<br />
<table class="border" style="width:100%" cellpadding="1" cellspacing="0">
	<tr>
		<td class="thead" colspan="3"><?php echo $lang['host']." ".$lang['chanbackups']; ?></td>
	</tr>
	<tr>
		<td class="thead"><?php echo $lang['created']; ?></td>
		<td class="thead"><?php echo $lang['server']; ?></td>
		<td class="thead"><?php echo $lang['options']; ?></td>
	</tr>
<?php
$change_col=1;
$handler=opendir("site/backups/channel/hostbackups");
while($datei=readdir($handler))
	{
	if($datei!='.' AND $datei!='..')
		{
		$datei=str_replace('.txt', '', $datei);
		$datei_info=explode('_', $datei);
		if($serverhost==true AND $hoststatus==true OR $serverhost==true AND $hoststatus==false AND $datei_info[2]==$_SESSION['server_ip']."-".$port or $serverhost==false)
			{
			if($change_col%2) { $td_col="green1";} else {$td_col="green2";}
			?>
			<tr>
				<td class="<?php echo $td_col; ?> center"><?php echo date("d.m.Y - H:i", $datei_info[1]); ?></td>
				<td class="<?php echo $td_col; ?> center"><?php echo $datei_info[2]; ?></td>
				<td class="<?php echo $td_col; ?> center">
				<input class="view" type="button" name="view" value="" title="<?php echo $lang['view']; ?>" onClick="oeffnefenster('site/chanbackupview.php?backupid=<?php echo $datei_info[1]; ?>&amp;fileport=<?php echo $datei_info[2]; ?>&amp;hostbackup=1');"/>
				<form method="post" action="index.php?site=backup&amp;port=<?php echo $port; ?>">
				<input type="hidden" name="hostbackup" value="1" />
				<input type="hidden" name="backupid" value="<?php echo $datei_info[1]; ?>" />
				<input type="hidden" name="fileport" value="<?php echo $datei_info[2]; ?>" />
				<input class="start" type="submit" name="deploy" value="" title="<?php echo $lang['deploy']; ?>" />
				</form>
				<form method="post" action="index.php?site=backup&amp;port=<?php echo $port; ?>">
				<input type="hidden" name="hostbackup" value="1" />
				<input type="hidden" name="backupid" value="<?php echo $datei_info[1]; ?>" />
				<input type="hidden" name="fileport" value="<?php echo $datei_info[2]; ?>" />
				<input class="delete" type="submit" name="delete" value="" title="<?php echo $lang['delete']; ?>" />
				</form>
				</td>
			</tr>
		<?php
			$change_col++;
			}
		}
	}	
?>
</table>
<?php } ?>
<br />
<table class="border" cellpadding="1" cellspacing="0">
<tr>
	<td class="thead"><?php echo $lang['createchanbackup']; ?></td>
</tr>
<tr>
	<td class="green1 center">
	<form method="post" action="index.php?site=backup&amp;port=<?php echo $port; ?>">
	<input class="button" type="submit" name="create" value="<?php echo $lang['create']; ?>" />
	</form>
	<form method="post" action="index.php?site=backup&amp;port=<?php echo $port; ?>">
	<input type="hidden" name="hostbackup" value="1" />
	<input class="button" type="submit" name="create" value="<?php echo $lang['host']." ".$lang['create']; ?>" />
	</form>
	</td>
</tr>
</table>
<?php } ?>