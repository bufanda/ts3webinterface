<?php if(!defined("SECURECHECK")) {die($lang['error_file_alone']);}?>
<table class="border" style="width:100%" cellpadding="1" cellspacing="0">
<?php
if($port===false OR empty($port)) { echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?site=server\">";} else {
if (isset($_POST['unban']))
	{
	if($ts3->banDelete($_POST['banid']))
		{
		echo "<tr><td colspan=\"9\" class=\"green1\">".$lang['bandelok']."</td></tr>";
		}
	}

$banlist=$ts3->banList();
?>
	<tr>
		<td class="thead" colspan="9"><?php echo $lang['banlist']; ?></td>
	</tr>
	<tr>
		<td class="thead"><?php echo $lang['banid']; ?></td>
		<td class="thead"><?php echo $lang['ip']."/".$lang['name']."/".$lang['uniqueid']; ?></td>
		<td class="thead"><?php echo $lang['created']; ?></td>
		<td class="thead"><?php echo $lang['invokername']; ?></td>
		<td class="thead"><?php echo $lang['invokeruid']; ?></td>
		<td class="thead"><?php echo $lang['reason']; ?></td>
		<td class="thead"><?php echo $lang['length']; ?></td>
		<td class="thead"><?php echo $lang['enforcement']; ?></td>
		<td class="thead"><?php echo $lang['option']; ?></td>
	</tr>
<?php
if(!empty($banlist))
	{
	$change_col=1;
	if($change_col%2) { $td_col="green1";} else {$td_col="green2";}
	foreach($banlist AS $value)
		{?>
		<tr>
			<td class="<?php echo $td_col; ?> center"><?php echo $value['banid']; ?></td>
			<td class="<?php echo $td_col; ?> center"><?php echo $value['ip'].$value['name'].$value['uid']; ?></td>
			<td class="<?php echo $td_col; ?> center"><?php echo date("d.m.Y - H:i:s",$value['created']); ?></td>
			<td class="<?php echo $td_col; ?> center"><?php echo $value['invokername']; ?></td>
			<td class="<?php echo $td_col; ?> center"><?php echo $value['invokeruid']; ?></td>
			<td class="<?php echo $td_col; ?> center"><?php echo $value['reason']; ?></td>
			<td class="<?php echo $td_col; ?> center"><?php if(isset($value['duration'])) { echo $value['duration'];} else {echo "0";} ?></td>
			<td class="<?php echo $td_col; ?> center"><?php echo $value['enforcement']; ?></td>
			<td class="<?php echo $td_col; ?> center">
			<form method="post" action="index.php?site=banlist&amp;port=<?php echo $port; ?>">
			<input type="hidden" name="banid" value="<?php echo $value['banid']; ?>" />
			<input class="button" type="submit" name="unban" value="Unban" />
			</form>
			</td>
		</tr>
		<?php $change_col++;
		}
	} ?>
</table>
<?php } ?>