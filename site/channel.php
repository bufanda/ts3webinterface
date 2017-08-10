<?php if(!defined("SECURECHECK")) {die($lang['error_file_alone']);} 
if($port===false OR empty($port)) { echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?site=server\">";} else {
?>
<table style="width:100%" class="border" cellpadding="1" cellspacing="0">
<?php
if(isset($_POST['delete']))
	{
	if($ts3->channelDelete($_POST['cid']))
		{
		echo "<tr><td colspan=\"4\" class=\"green1\">".$lang['channeldelok']."</td></tr>";
		}
		else
		{
		echo "<tr><td colspan=\"4\" class=\"green1\">".$ts3->getDebugLog()."</td></tr>";
		}
	}
$channellist=$ts3->channelList("-topic -flags -voice -limits");
?>
	<tr>
		<td class="thead" colspan="4"><?php echo $lang['channel']; ?></td>
	</tr>
	<tr>
		<td class="thead"><?php echo $lang['id']; ?></td>
		<td class="thead"><?php echo $lang['pid']; ?></td>
		<td class="thead"><?php echo $lang['name']; ?></td>
		<td class="thead"><?php echo $lang['option']; ?></td>
	</tr>
<?php
$change_col=1;
foreach ($channellist AS $key=>$value)
	{
	($change_col%2) ? $td_col="green1" : $td_col="green2"
	?>
	<tr>
		<td class="<?php echo $td_col; ?> center"><?php echo $value['cid']; ?></td>
		<td class="<?php echo $td_col; ?> center"><?php echo $value['pid']; ?></td>
		<td class="<?php echo $td_col; ?> center"><?php echo $value['channel_name']; ?></td>
		<td class="<?php echo $td_col; ?> center">
		<form method="post" action="index.php?site=channelview&amp;port=<?php echo $port ?>&amp;cid=<?php echo $value['cid']; ?>">
		<input type="submit" class="select" name="select" value="" title="<?php echo $lang['select']; ?>" />
		</form>
		<form method="post" action="index.php?site=channeleditperm&amp;port=<?php echo $port ?>&amp;cid=<?php echo $value['cid']; ?>">
		<input type="submit" class="eperms" name="editperms" value="" title="<?php echo $lang['editperms']; ?>" />
		</form>
		<form method="post" action="index.php?site=channel&amp;port=<?php echo $port ?>">
		<input type="hidden" name="cid" value="<?php echo $value['cid']; ?>" />
		<input type="submit" class="delete" name="delete" value="" title="<?php echo $lang['delete']; ?>" onclick="return confirm('<?php echo $lang['deletemsgchannel']; ?>')" />
		</form>
		</td>
	</tr>
	<?php 
	$change_col++;
	} ?>
</table>
<?php } ?>