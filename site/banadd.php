<table class="border" cellpadding="0" cellspacing="0">
<?php
if (isset($_POST['addban']))
	{
	if(isset($_POST['banip']) AND !empty($_POST['banip']))
		{
		if($ts3->BanAddByIp($_POST['banip'], $_POST['bantime'], $_POST['reason']))
			{
			echo "<tr><td colspan=\"2\" class=\"green1\">".$lang['banaddok']."</td></tr>";
			}
		}
	if(isset($_POST['banuid']) AND !empty($_POST['banuid']))
		{
		if($ts3->BanAddByUid($_POST['banuid'], $_POST['bantime'], $_POST['reason']))
			{
			echo "<tr><td colspan=\"2\" class=\"green1\">".$lang['banaddok']."</td></tr>";
			}
		}
	if(isset($_POST['banname']) AND !empty($_POST['banname']))
		{
		if($ts3->BanAddByName($_POST['banname'], $_POST['bantime'], $_POST['reason']))
			{
			echo "<tr><td colspan=\"2\" class=\"green1\">".$lang['banaddok']."</td></tr>";
			}
		}
	}
?>
<form method="post" action="index.php?site=banadd&amp;port=<?php echo $port; ?>">
	<tr>
		<td class="thead" colspan="2"><?php echo $lang['addban']; ?></td>
	</tr>
	<tr>
		<td class="green1"><?php echo $lang['ip']; ?></td>
		<td class="green1"><input type="text" name="banip" value="" /></td>
	</tr>
	<tr>
		<td class="green2"><?php echo $lang['name']; ?></td>
		<td class="green2"><input type="text" name="banname" value="" /></td>
	</tr>
	<tr>
		<td class="green1"><?php echo $lang['uniqueid']; ?></td>
		<td class="green1"><input type="text" name="banuid" value="" /></td>
	</tr>
	<tr>
		<td class="green2"><?php echo $lang['reason']; ?></td>
		<td class="green2"><input type="text" name="reason" value="" /></td>
	</tr>
	<tr>
		<td class="green1"><?php echo $lang['bantime']; ?></td>
		<td class="green1"><input type="text" name="bantime" value="" /><?php echo $lang['seconds']; ?></td>
	</tr>
	<tr>
		<td class="green2"><?php echo $lang['option']; ?></td>
		<td class="green2"><input class="button" type="submit" name="addban" value="<?php echo $lang['ban']; ?>" /></td>
	</tr>
</table>
</form>