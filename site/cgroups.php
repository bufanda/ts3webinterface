<?php if(!defined("SECURECHECK")) {die($lang['error_file_alone']);} 
if($port===false OR empty($port)) { echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?site=server\">";} else {
?>
<table style="width:100%" class="border" cellpadding="1" cellspacing="0">
<?php
if(isset($_POST['sendname']))
	{
	if(!empty($_POST['name']))
		{
		if($ts3->channelGroupRename($cgid, $_POST['name']))
			{
			echo "<tr><td class=\"green1\" colspan=\"6\">".$lang['groupnameedited']."</td></tr>";
			}
			else
			{
			echo "<tr><td class=\"green1\" colspan=\"6\">".$ts3->getDebugLog()."</td></tr>";
			}
		}
		else
		{
		echo "<tr><td class=\"green1\" colspan=\"6\">".$lang['groupnameempty']."</td></tr>";
		}
	}
if(isset($_POST['delgroup']))
	{
	if($ts3->channelGroupDelete($cgid, "1"))
		{
		echo "<tr><td class=\"green1\" colspan=\"6\">".$lang['groupremoveok']."</td></tr>";
		}
		else
		{
		echo "<tr><td class=\"green1\" colspan=\"6\">".$ts3->getDebugLog()."</td></tr>";
		}
	}

$channelgroups=$ts3->channelGroupList();
foreach($channelgroups AS $key => $value)
	{
	if ($hoststatus===false AND $serverhost===true AND $value['type']=='0')
		{
		unset($channelgroups[$key]);
		}
	}
?>

	<tr>
		<td class="thead" colspan="6"><?php echo $lang['channelgroups']; ?></td>
	</tr>
	<tr>
		<td class="thead"><?php echo $lang['id']; ?></td>
		<td class="thead"><?php echo $lang['name']; ?></td>
		<td class="thead"><?php echo $lang['type']; ?></td>
		<td class="thead"><?php echo $lang['iconid']; ?></td>
		<td class="thead"><?php echo $lang['savedb']; ?></td>
		<td class="thead"><?php echo $lang['options']; ?></td>
	</tr>
	<?php
	$change_col=1;
	foreach($channelgroups AS $value)
		{
		($change_col%2) ? $td_col="green1" : $td_col="green2";
		?>
		<tr>
			<td class="<?php echo $td_col; ?> center"><?php echo $value['cgid']; ?></td>
			<form method="post" action="index.php?site=cgroups&amp;port=<?php echo $port;?>&amp;cgid=<?php echo $value['cgid'];?>">
			<td class="<?php echo $td_col; ?>">
			<input type="text" name="name" value="<?php echo htmlentities($value['name'], ENT_QUOTES, "UTF-8"); ?>" /> <input class="button" type="submit" name="sendname" value="<?php echo $lang['rename']; ?>" />
			</td>
			</form>
			<td class="<?php echo $td_col; ?> center"><?php echo $value['type']; ?></td>
			<td class="<?php echo $td_col; ?> center"><?php echo $value['iconid']; ?></td>
			<td class="<?php echo $td_col; ?> center"><?php echo $value['savedb']; ?></td>
			<td class="<?php echo $td_col; ?> center">
			<?php
			if($value['type']!='0')
				{?>
			<form method="post" action="index.php?site=cgroupclients&amp;port=<?php echo $port;?>&amp;cgid=<?php echo $value['cgid'];?>">
			<input type="submit" class="clients" name="permedit" value="" title="<?php echo $lang['clients']; ?>" />
			</form>
			<?php } ?>
			<form method="post" action="index.php?site=cgroupeditperm&amp;port=<?php echo $port;?>&amp;cgid=<?php echo $value['cgid'];?>">
			<input type="submit" class="eperms" name="permedit" value="" title="<?php echo $lang['editperms']; ?>" />
			</form>
			<form method="post" action="index.php?site=cgroups&amp;port=<?php echo $port;?>&amp;cgid=<?php echo $value['cgid'];?>">
			<input type="submit" class="delete" name="delgroup" value="" title="<?php echo $lang['delete']; ?>"  onclick="return confirm('<?php echo $lang['deletemsgchannelgroup']; ?>')" />
			</form>
			</td>
		</tr>
	<?php
		$change_col++;
		}
		?>
</table>
<?php } ?>