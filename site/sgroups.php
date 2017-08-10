<?php if(!defined("SECURECHECK")) {die($lang['error_file_alone']);} 
if($port===false OR empty($port)) { echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?site=server\">";} else {
?>
<table style="width:100%" class="border" cellpadding="1" cellspacing="0">
<?php
if(isset($_POST['sendname']))
	{
	if(!empty($_POST['name']))
		{
		if($ts3->serverGroupRename($sgid, $_POST['name']))
			{
			echo "<tr><td class='green1' colspan='6'>".$lang['groupnameeditok']."<br /></td></tr>";
			}
			else
			{
			echo "<tr><td class='green1' colspan='6'>".$ts3->getDebugLog()."</td></tr>";
			}
		}
		else
		{
		echo "<tr><td class='green1' colspan='6'>".$lang['groupnameempty']."</td></tr>";
		}
	}
if(isset($_POST['delgroup']))
	{
	if($ts3->serverGroupDelete($sgid, "1"))
		{
		echo "<tr><td class='green1' colspan='6'>".$lang['groupremoveok']."</td></tr>";
		}
		else
		{
		echo "<tr><td class='green1' colspan='6'>".$ts3->getDebugLog()."</td></tr>";
		}
	}


$servergroups=$ts3->serverGroupList();
foreach($servergroups AS $key => $value)
	{
	if ($hoststatus===false AND $serverhost===true AND $value['type']=='2' OR $hoststatus===false AND $serverhost===true AND $value['type']=='0')
		{
		unset($servergroups[$key]);
		}
	}
?>

	<tr>
		<td class="thead" colspan="6"><?php echo $lang['servergroups']; ?></td>
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
	
	foreach($servergroups AS $value)
		{
		($change_col%2) ? $td_col="green1" : $td_col="green2";
		?>
		<tr>
			<td class="<?php echo $td_col; ?> center"><?php echo $value['sgid']; ?></td>
			<form method="post" action="index.php?site=sgroups&amp;port=<?php echo $port;?>&amp;sgid=<?php echo $value['sgid'];?>">
			<td class="<?php echo $td_col; ?>">
			<input type="text" name="name" value="<?php echo htmlentities($value['name'], ENT_QUOTES, "UTF-8"); ?>" /> <input class="button" type="submit" name="sendname" value="<?php echo $lang['rename']; ?>" />
			</td>
			</form>
			<td class="<?php echo $td_col; ?> center"><?php echo $value['type']; ?></td>
			<td class="<?php echo $td_col; ?> center"><?php echo sprintf('%u', $value['iconid'] & 0xffffffff); ?></td>
			<td class="<?php echo $td_col; ?> center"><?php echo $value['savedb']; ?></td>
			<td class="<?php echo $td_col; ?> center">
			<?php
			if($value['type']!='0')
				{?>
			<form method="post" action="index.php?site=sgroupclients&amp;port=<?php echo $port;?>&amp;sgid=<?php echo $value['sgid'];?>">
			<input type="submit" class="clients" name="groupclients" value="" title="<?php echo $lang['clients']; ?>" />
			</form>
			<?php } ?>
			<form method="post" action="index.php?site=sgroupeditperm&amp;port=<?php echo $port;?>&amp;sgid=<?php echo $value['sgid'];?>">
			<input type="submit" class="eperms" name="permedit" value="" title="<?php echo $lang['editperms']; ?>" />
			</form>
			<form method="post" action="index.php?site=sgroups&amp;port=<?php echo $port;?>&amp;sgid=<?php echo $value['sgid'];?>">
			<input type="submit" class="delete" name="delgroup" value="" title="<?php echo $lang['delete']; ?>"  onclick="return confirm('<?php echo $lang['deletemsgservergroup']; ?>')" />
			</form>
			</td>
		</tr>
	<?php
		$change_col++;
		}
		?>
</table>
<?php } ?>