<?php if(!defined("SECURECHECK")) {die($lang['error_file_alone']);}
if($hoststatus===false AND $serverhost===true) { echo $lang['nohoster']; } else {
if(isset($_GET['action']) AND $_GET['action'] == 'start')
	{
	$ts3->serverStart($_POST['sid']);
	}
	
if(isset($_GET['action']) AND $_GET['action'] == 'stop')
	{
	$ts3->serverStop($_POST['sid']);
	}
	
if(isset($_GET['action']) AND $_GET['action'] == 'del')
	{
	$ts3->serverDelete($_POST['sid']);
	}
	
$server=$ts3->serverList();

if(!empty($server))
	{
	foreach($server AS $key => $value)
		{
		$allslots=$allslots+$value['virtualserver_maxclients'];
		$allusedslots=$allusedslots+$value['virtualserver_clientsonline'];
		}
	}

if(isset($_POST['sendmsg']))
	{
	$ts3->gm($_POST['msgtoall']);
	}
?>
<table class="border" style="width:100%;" cellpadding="1" cellspacing="0">
	<tr>
		<td class="thead" colspan="7"><?php echo $lang['msgtoall']; ?></td>
	</tr>
	<tr>
		<form method="post" action="index.php?site=server">
		<td class="green1"><input type="text" name="msgtoall" size="100" value=""/></td>
		<td class="green1"><input class="button" type="submit" name="sendmsg" value="<?php echo $lang['send']; ?>" /></td>
		</form>
	</tr>
</table>
<br />
<table class="border" style="width:100%;" cellpadding="1" cellspacing="0">
	<tr>
		<td colspan="7" class="thead"><?php echo $lang['server']; ?></td>
	</tr>
	<?php
	if(!empty($server))
		{?>
	<tr>
		<td colspan="7"><?php echo sprintf($lang['serverstats'], count($server), $allslots, $allusedslots); ?></td>
	</tr>
	<?php } ?>
	<tr>
		<td class="thead"><?php echo $lang['id']; ?></td>
		<td class="thead"><?php echo $lang['name']; ?></td>
		<td class="thead"><?php echo $lang['port']; ?></td>
		<td class="thead"><?php echo $lang['status']; ?></td>
		<td class="thead"><?php echo $lang['runtime']; ?></td>
		<td class="thead"><?php echo $lang['clients']; ?></td>
		<td class="thead"><?php echo $lang['options']; ?></td>
	</tr>
	<?php
	if(!empty($server))
		{
		$change_col=1;
		foreach($server AS $value)
			{
			if($oldserver===true)
					{
					$conv_time=$ts3->convertMillisecondsToStrTime($value['virtualserver_uptime']);
					}
					else
					{
					$conv_time=$ts3->convertSecondsToStrTime($value['virtualserver_uptime']);
					}
			$time_string=$conv_time['days'].$lang['days']." ".$conv_time['hours'].$lang['hours']." ".$conv_time['mins'].$lang['minutes']." ".$conv_time['secs'].$lang['seconds'];
			if($change_col%2) { $td_col="green1";} else {$td_col="green2";}
			?>
			<tr>
				<td class="<?php echo $td_col;?> center"><?php echo $value['virtualserver_id']; ?></td>
				<td class="<?php echo $td_col;?> center"><?php echo $value['virtualserver_name']; ?></td>
				<td class="<?php echo $td_col;?> center"><?php echo $value['virtualserver_port']; ?></td>
				<td class="<?php echo $td_col;?> center"><?php echo $value['virtualserver_status']; ?></td>
				<td class="<?php echo $td_col;?> center"><?php echo  $time_string; ?></td>
				<td class="<?php echo $td_col;?> center"><?php echo $value['virtualserver_clientsonline']." / ". $value['virtualserver_maxclients']; ?></td>
				<td class="<?php echo $td_col;?> center">
				<form method="post" action="index.php?site=server&amp;action=start">
				<input type="hidden" name="sid" value="<?php echo $value['virtualserver_id']; ?>" />
				<input class="start" type="submit" name="start" value="" title="<?php echo $lang['start']; ?>" />
				</form>
				<form method="post" action="index.php?site=server&amp;action=stop">
				<input type="hidden" name="sid" value="<?php echo $value['virtualserver_id']; ?>" />
				<input class="stop" type="submit" name="stop" value="" onclick="return confirm('<?php echo $lang['stopservermsg']; ?>')" title="<?php echo $lang['stop']; ?>" />
				</form>
				<form method="post" action="index.php?site=serverview&amp;port=<?php echo $value['virtualserver_port']; ?>">
				<input class="select" type="submit" name="edit" value="" title="<?php echo $lang['select']; ?>" />
				</form>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<form method="post" action="index.php?site=server&amp;action=del">
				<input type="hidden" name="sid" value="<?php echo $value['virtualserver_id']; ?>" />
				<input class="delete" type="submit" name="del" value="" onclick="return confirm('<?php echo $lang['deletemsgserver']; ?>')" title="<?php echo $lang['delete']; ?>" />
				</form>
				</td>
			</tr>
		<?php 
			$change_col++;
			}
		}
		else
		{
		echo "<tr><td class='green1' colspan='7'>".$lang['noserver']."</td></tr>";
		}?>
</table>
<?php } ?>