<?php if(!defined("SECURECHECK")) {die($lang['error_file_alone']);} 
if($port===false OR empty($port)) { echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?site=server\">";} else {
?>
<table style="width:100%" class="border" cellpadding="1" cellspacing="0">
<?php
if(isset($_POST['kickclient']))
	{
	if($ts3->serverGroupDeleteClient($sgid, $_POST['cldbid']))
		{
		echo "<tr><td class='green1' colspan='6'>".$lang['clientremoveok']."</td></tr>";
		}
		else
		{
		echo "<tr><td class='green1' colspan='6'>".$ts3->getDebugLog()."</td></tr>";
		}
	}
if(isset($_POST['addclient']))
	{
	if($ts3->serverGroupAddClient($sgid, $_POST['cldbid']))
		{
		echo "<tr><td class='green1' colspan='6'>".$lang['clientaddok']."</td></tr>";
		}
		else
		{
		echo "<tr><td class='green1' colspan='6'>".$ts3->getDebugLog()."</td></tr>";
		}
	}
$servergroups=$ts3->serverGroupList();

$groupclients=$ts3->serverGroupClientList($sgid, "-names");

foreach($servergroups AS $value)
	{
	if($sgid==$value['sgid'])
		{
		$sgroupid=$value['sgid'];
		$sgroupname=$value['name'];
		}
	}
$start_while=0;
$duration_while=100;
while($clientdblist=$ts3->clientDbList("start=".$start_while." duration=".$duration_while))
	{
	foreach($groupclients AS $key=>$value)
		{
		foreach($clientdblist AS $value2)	
			{
			if($value['cldbid']==$value2['cldbid'])
				{
				$groupclients[$key]['client_unique_identifier']=$value2['client_unique_identifier'];
				$groupclients[$key]['client_nickname']=$value2['client_nickname'];
				$groupclients[$key]['client_created']=$value2['client_created'];
				$groupclients[$key]['client_lastconnected']=$value2['client_lastconnected'];
				}
			}

		}
	$start_while=$start_while+$duration_while;
	}

if(isset($_POST['searchby']) AND $_POST['searchby']=='cldbid' AND  !empty($_POST['search']))
	{
	foreach ($groupclients AS $key => $value)
		{
		if($_POST['search']!=$value['cldbid'])
			{
			unset($groupclients[$key]);
			}
		}
	}
elseif(isset($_POST['searchby']) AND $_POST['searchby']=='name' AND !empty($_POST['search']))
	{
	foreach ($groupclients AS $key => $value)
		{
		if(strpos(strtolower($value['client_nickname']),strtolower($_POST['search']))===false)
			{
			unset($groupclients[$key]);
			}
		}
	}	

?>
	<tr>
		<td class="thead" colspan="7"><?php echo $lang['searchfor'].$lang['client']; ?></td>
	</tr>
	<tr>
		<form method="post" action="index.php?site=sgroupclients&amp;port=<?php echo $port; ?>&amp;sgid=<?php echo $sgid; ?>">
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
		<td class="thead" colspan="6"><?php echo "(".$sgroupid.")".$sgroupname." ".$lang['groupmember']; ?></td>
	</tr>
	<tr>
		<td class="thead"><?php echo $lang['uniqueid']; ?></td>
		<td class="thead"><?php echo $lang['dbid']; ?></td>
		<td class="thead"><?php echo $lang['name']; ?></td>
		<td class="thead"><?php echo $lang['created']; ?></td>
		<td class="thead"><?php echo $lang['lastonline']; ?></td>
		<td class="thead"><?php echo $lang['option']; ?></td>
	</tr>
	<?php
	if(!empty($groupclients))
		{
	$change_col=1;
	foreach($groupclients AS $value)
		{
		($change_col%2) ? $td_col="green1" : $td_col="green2"
		
		?>
		<form method="post" action="index.php?site=sgroupclients&amp;port=<?php echo $port; ?>&amp;sgid=<?php echo $sgid; ?>">
		<tr>
			<td class="<?php echo $td_col; ?> center"><?php echo $value['client_unique_identifier']; ?></td>
			<td class="<?php echo $td_col; ?> center"><?php echo $value['cldbid']; ?></td>
			<td class="<?php echo $td_col; ?> center"><?php echo $value['client_nickname']; ?></td>
			<td class="<?php echo $td_col; ?> center"><?php echo date("d.m.Y", $value['client_created']); ?></td>
			<td class="<?php echo $td_col; ?> center"><?php echo date("d.m.Y", $value['client_lastconnected']); ?></td>
			<td class="<?php echo $td_col; ?> center">
			<input type="hidden" name="cldbid" value="<?php echo $value['cldbid']; ?>" />
			<input type="submit" class="delete" name="kickclient" value="" title="kick"/>
			</td>
		</tr>
		</form>
	<?php 
		$change_col++;
		} }?>
		
</table>
<br />
<form method="post" action="index.php?site=sgroupclients&amp;port=<?php echo $port; ?>&amp;sgid=<?php echo $sgid; ?>">
<table class="border" cellpadding="1" cellspacing="0">
	<tr>
		<td colspan="2" class="thead"><?php echo $lang['addclient']; ?></td>
	</tr>
	<tr>
		<td class="green1"><?php echo $lang['cldbid']; ?></td>
		<td class="green1"><input type="text" name="cldbid" value="" /></td>
	</tr>
	<tr>
		<td class="green2"><?php echo $lang['options']; ?></td>
		<td class="green2"><input type="submit" name="addclient" value="<?php echo $lang['add']; ?>" /></td>
	</tr>
</table>
</form>
<?php } ?>