<?php
if(isset($_POST['create']))
	{
	if(isset($_POST['hostbackup']))
		{
		$path="site/backups/server/hostbackups/";
		}
		else
		{
		$path="site/backups/server/";
		}
	$serverinfo=$ts3->serverInfo();
	$handler=fopen($path."server_".time()."_".$_SESSION['server_ip']."-".$port.".txt", "a+");
	$serversnapshot=$ts3->serverSnapshotCreate();
	fwrite($handler, $serversnapshot);
	fclose($handler);
	}
	
if(isset($_POST['deploy']))
	{
	if(isset($_POST['hostbackup']))
		{
		$path="site/backups/server/hostbackups/";
		}
		else
		{
		$path="site/backups/server/";
		}
	$handler=file($path."server_".$_POST['backupid']."_".$_POST['fileport'].".txt");
	$ts3->serverSnapshotDeploy($handler[0]);
	echo $ts3->getDebugLog();
	}
	
if(isset($_POST['delete']))
	{
	if(isset($_POST['hostbackup']))
		{
		$path="site/backups/server/hostbackups/";
		}
		else
		{
		$path="site/backups/server/";
		}
	@unlink($path."server_".$_POST['backupid']."_".$_POST['fileport'].".txt");
	}
?>
<table class="border" cellpadding="1" cellspacing="0">
	<tr>
		<td style="font-size:12px" colspan="3"><?php echo $lang['servbackdesc']; ?></td>
	</tr>
	<tr>
		<td class="warning" style="font-size:12px" colspan="3"><?php echo $lang['snapwarning']; ?></td>
	</tr>
	<tr>
		<td class="thead" colspan="3"><?php echo $lang['serverbackups']; ?></td>
	</tr>
	<tr>
		<td class="thead"><?php echo $lang['created']; ?></td>
		<td class="thead"><?php echo $lang['server']; ?></td>
		<td class="thead"><?php echo $lang['options']; ?></td>
	</tr>
<?php
$change_col=1;
$handler=opendir("site/backups/server");
while($datei=readdir($handler))
	{
	if($datei!='.' AND $datei!='..' AND $datei!='hostbackups')
		{
		$datei=str_replace('.txt', '', $datei);
		$datei_info=explode('_', $datei);
		if($serverhost===true AND $hoststatus===false AND $datei_info[2]==$_SESSION['server_ip']."-".$port OR $serverhost===false OR $hoststatus===true)
			{
			if($change_col%2) { $td_col="green1";} else {$td_col="green2";}
			?>
			<tr>
				<td class="<?php echo $td_col; ?> center"><?php echo date("d.m.Y - H:i", $datei_info[1]); ?></td>
				<td class="<?php echo $td_col; ?> center"><?php echo $datei_info[2]; ?></td>
				<td class="<?php echo $td_col; ?> center">
				<form method="post" action="index.php?site=serverbackup&amp;port=<?php echo $port; ?>">
				<input type="hidden" name="backupid" value="<?php echo $datei_info[1]; ?>" />
				<input type="hidden" name="fileport" value="<?php echo $datei_info[2]; ?>" />
				<input class="start" type="submit" name="deploy" value="" title="<?php echo $lang['deploy']; ?>" />
				</form>
				<form method="post" action="index.php?site=serverbackup&amp;port=<?php echo $port; ?>">
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
<br />
<table style="width:100%" class="border" cellpadding="1" cellspacing="0">
	<tr>
		<td class="thead" colspan="3"><?php echo $lang['host']." ".$lang['serverbackups']; ?></td>
	</tr>
	<tr>
		<td class="thead"><?php echo $lang['created']; ?></td>
		<td class="thead"><?php echo $lang['server']; ?></td>
		<td class="thead"><?php echo $lang['options']; ?></td>
	</tr>
<?php
$change_col=1;
$handler=opendir("site/backups/server/hostbackups");
while($datei=readdir($handler))
	{
	if($datei!='.' AND $datei!='..')
		{
		$datei=str_replace('.txt', '', $datei);
		$datei_info=explode('_', $datei);
		if($serverhost===true AND $hoststatus===false AND $datei_info[2]==$_SESSION['server_ip']."-".$port OR $serverhost===false OR $hoststatus===true)
			{
			if($change_col%2) { $td_col="green1";} else {$td_col="green2";}
			?>
			<tr>
				<td class="<?php echo $td_col; ?> center"><?php echo date("d.m.Y - H:i", $datei_info[1]); ?></td>
				<td class="<?php echo $td_col; ?> center"><?php echo $datei_info[2]; ?></td>
				<td class="<?php echo $td_col; ?> center">
				<form method="post" action="index.php?site=serverbackup&amp;port=<?php echo $port; ?>">
				<input type="hidden" name="hostbackup" value="1" />
				<input type="hidden" name="backupid" value="<?php echo $datei_info[1]; ?>" />
				<input type="hidden" name="fileport" value="<?php echo $datei_info[2]; ?>" />
				<input class="start" type="submit" name="deploy" value="" title="<?php echo $lang['deploy']; ?>" />
				</form>
				<form method="post" action="index.php?site=serverbackup&amp;port=<?php echo $port; ?>">
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
<br />
<table class="border" cellpadding="1" cellspacing="0">
<tr>
	<td class="thead" colspan="2"><?php echo $lang['createserverbackup']; ?></td>
</tr>
<tr>
	<td class="green1 center">
	<form method="post" action="index.php?site=serverbackup&amp;port=<?php echo $port; ?>">
	<input class="button" type="submit" name="create" value="<?php echo $lang['create']; ?>" />
	</form>
	</td>
	<td class="green1 center">
	<form method="post" action="index.php?site=serverbackup&amp;port=<?php echo $port; ?>">
	<input type="hidden" name="hostbackup" value="1" />
	<input class="button" type="submit" name="create" value="<?php echo $lang['host']." ".$lang['create']; ?>" />
	</form>
	</td>
</tr>
</table>