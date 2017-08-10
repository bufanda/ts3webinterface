<?php if(!defined("SECURECHECK")) {die($lang['error_file_alone']);} 
if($port===false OR empty($port)) { echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?site=server\">";} else {?>

<table style="width:100%" class="border" cellpadding="1" cellspacing="0">
<?php	
if(isset($_POST['addclient']))
	{
	if($ts3->setClientChannelGroup($cgid, $_POST['cid'], $_POST['cldbid']))
		{
		echo "<tr><td class=\"green1\" colspan=\"7\">".$lang['clientaddok']."</td></tr>";
		}
		else
		{
		echo "<tr><td class=\"green1\" colspan=\"7\">".$ts3->getDebugLog()."</td></tr>";
		}
	}

if(isset($_POST['switchgroup']))
	{
	if($ts3->setClientChannelGroup($_POST['cgid'], $_POST['cid'], $_POST['cldbid']))
		{
		echo "<tr><td class=\"green1\" colspan=\"7\">".$lang['clientaddok']."</td></tr>";
		}
		else
		{
		echo "<tr><td class=\"green1\" colspan=\"7\">".$ts3->getDebugLog()."</td></tr>";
		}
	}
$channelgroups=$ts3->channelGroupList();

$groupclients=$ts3->channelGroupClientList($cgid);

$channellist=$ts3->channelList();

$start_while=0;
$duration_while=100;
while($clientdblist=$ts3->clientDbList("start=".$start_while." duration=".$duration_while))
	{
	if(!empty($groupclients))
		{
		foreach($groupclients AS $key => $value)
			{
			foreach($clientdblist AS $key2=>$value2)
				{
				if($value['cldbid']==$value2['cldbid'])
					{
					$groupclients[$key]['client_unique_identifier']=$value2['client_unique_identifier'];
					$groupclients[$key]['client_nickname']=$value2['client_nickname'];
					$groupclients[$key]['client_created']=$value2['client_created'];
					$groupclients[$key]['client_lastconnected']=$value2['client_lastconnected'];
					}
				}
				
			foreach($channellist AS $key3 => $value3)
				{
				if($value['cid'] == $value3['cid'])
					{
					$groupclients[$key]['channel_name']=$value3['channel_name'];
					}
				}
			}
		}
	$start_while=$start_while+$duration_while;
	}
if(isset($_POST['searchby']) AND $_POST['searchby']=='cldbid' AND  !empty($_POST['search']))
	{
	if(!empty($groupclients))
		{
		foreach ($groupclients AS $key => $value)
			{
			if($_POST['search']!=$value['cldbid'])
				{
				unset($groupclients[$key]);
				}
			}
		}
	}
elseif(isset($_POST['searchby']) AND $_POST['searchby']=='name' AND !empty($_POST['search']))
	{
	if(!empty($groupclients))
		{
		foreach ($groupclients AS $key => $value)
			{
			if(strpos(strtolower($value['client_nickname']),strtolower($_POST['search']))===false)
				{
				unset($groupclients[$key]);
				}
			}
		}
	}	

foreach($channelgroups AS $value)
	{
	if($cgid==$value['cgid'])
		{
		$cgroupid=$value['cgid'];
		$cgroupname=$value['name'];
		}
	}
?>
	<tr>
		<td class="thead" colspan="7"><?php echo $lang['searchfor'].$lang['client']; ?></td>
	</tr>
	<tr>
		<form method="post" action="index.php?site=cgroupclients&amp;port=<?php echo $port; ?>&amp;cgid=<?php echo $cgid; ?>">
		<td class="green1">
		<select name="searchby">
		<option value="cldbid"><?php echo $lang['cldbid']; ?></option>
		<option value="name"><?php echo $lang['name']; ?></option>
		</select>
		</td>
		<td class="green1" colspan="6">
		<input type="text" name="search" value="" />
		<input type="submit" name="sendsearch" value="<?php echo $lang['search']; ?>" />
		</td>
		</form>
	</tr>
	<tr>
		<td class="thead" colspan="7"><?php echo "(".$cgroupid.")".$cgroupname." ".$lang['groupmember']; ?></td>
	</tr>
	<tr>
		<td class="thead"><?php echo $lang['channelid']; ?></td>
		<td class="thead"><?php echo $lang['channelname']; ?></td>
		<td class="thead"><?php echo $lang['clientdbid']; ?></td>
		<td class="thead"><?php echo $lang['clientname']; ?></td>
		<td class="thead"><?php echo $lang['created']; ?></td>
		<td class="thead"><?php echo $lang['lastonline']; ?></td>
		<td class="thead"><?php echo $lang['option']; ?></td>
	</tr>
	<?php
	$change_col=1;
	if(!empty($groupclients))	
		{
		foreach($groupclients AS $value)
			{
			($change_col%2) ? $td_col="green1" : $td_col="green2"
			
			?>

			<tr>
				<td class="<?php echo $td_col; ?> center"><?php echo $value['cid']; ?></td>
				<td class="<?php echo $td_col; ?> center"><?php echo $value['channel_name']; ?></td>
				<td class="<?php echo $td_col; ?> center"><?php echo $value['cldbid']; ?></td>
				<td class="<?php echo $td_col; ?> center"><?php echo $value['client_nickname']; ?></td>
				<td class="<?php echo $td_col; ?> center"><?php echo date("d.m.Y", $value['client_created']); ?></td>
				<td class="<?php echo $td_col; ?> center"><?php echo date("d.m.Y", $value['client_lastconnected']); ?></td>
				<td class="<?php echo $td_col; ?> center">
				<form method="post" action="index.php?site=cgroupclients&amp;port=<?php echo $port; ?>&amp;cgid=<?php echo $cgid; ?>">
				<select name="cgid">
				<?php
				foreach($channelgroups AS $value2)
					{
					if($value2['cgid']!=$cgroupid AND $value2['type']!='0')
						{

					?>
					<option value="<?php echo $value2['cgid'] ?>"><?php echo "(".$value2['cgid'].")".$value2['name']; ?></option>
		<?php			}
					}
					?>
				</select>
				<input type="hidden" name="cid" value="<?php echo $value['cid']; ?>" />
				<input type="hidden" name="cldbid" value="<?php echo $value['cldbid']; ?>" />
				<input type="submit" name="switchgroup" value="<?php echo $lang['switch']; ?>" />
				</td>
				</form>
			</tr>

		<?php 
			$change_col++;
			} 
		} ?>
</table>
<br />
<form method="post" action="index.php?site=cgroupclients&amp;port=<?php echo $port; ?>&amp;cgid=<?php echo $cgid; ?>">
<table class="border" cellpadding="1" cellspacing="0">
	<tr>
		<td colspan="2" class="thead"><?php echo $lang['addclient']; ?></td>
	</tr>
	<tr>
		<td class="green1"><?php echo $lang['channel']; ?>:</td>
		<td class="green1">
		<select name="cid">
		<?php
		foreach($channellist AS $value)
			{?>
			
			<option value="<?php echo $value['cid']; ?>"><?php echo $value['channel_name']; ?></option>
		<?php } ?>
		</select>
		</td>
	</tr>
	<tr>
		<td class="green2"><?php echo $lang['cldbid']; ?>:</td>
		<td class="green2"><input type="text" name="cldbid" value="" /></td>
	</tr>
	<tr>
		<td class="green1"><?php echo $lang['option']; ?>:</td>
		<td class="green1"><input type="submit" name="addclient" value="<?php echo $lang['add']; ?>" /></td>
	</tr>
</table>
</form>
<?php } ?>