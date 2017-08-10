<?php if(!defined("SECURECHECK")) {die($lang['error_file_alone']);} 
if($port===false OR empty($port)) { echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?site=server\">";} else {

if(empty($duration))
	{
	$duration=25;
	}
if(isset($_GET['start']))
	{
	$start=$_GET['start'];
	}
	else
	{
	$start=0;
	}
if(($start-$duration)<0)
	{
	$start=0;
	}
?>
<table style="width:100%" class="border" cellpadding="1" cellspacing="0">
<?php
if(isset($_POST['clientdel']))
	{
	if($ts3->clientDbDelete($_POST['cldbid']))
		{
		echo "<tr><td class=\"green1\" colspan=\"8\">".$lang['clientdeletedok']."</td></tr>";
		}
		else
		{
		echo "<tr><td class=\"green1\" colspan=\"8\">".$ts3->getDebugLog()."</td></tr>";
		}
	}


$clientdblist=$ts3->clientDbList("start=".$start." duration=".$duration);
$clientlist=$ts3->clientList();
if(isset($_POST['searchby']) AND $_POST['searchby']=='cldbid' AND  !empty($_POST['search']))
	{
	foreach ($clientdblist AS $key => $value)
		{
		if($_POST['search']!=$value['cldbid'])
			{
			unset($clientdblist[$key]);
			}
		}
	}
elseif(isset($_POST['searchby']) AND $_POST['searchby']=='name' AND !empty($_POST['search']))
	{

	foreach ($clientdblist AS $key => $value)
		{
		if(strpos(strtolower($value['client_nickname']),strtolower($_POST['search']))===false)
			{
			unset($clientdblist[$key]);
			}
		}
	}
	
if(!empty($clientdblist))
	{
	
	foreach($clientdblist AS $key => $value)
		{
		if(!empty($clientlist))
			{
			foreach($clientlist AS $key2 => $value2)
				{
				if($value['cldbid'] == $value2['client_database_id'])
					{
					$clientdblist[$key]['clid']=$value2['clid'];
					$clientdblist[$key]['cid']=$value2['cid'];
					}
				}
			}
		}
	}
/**	
	<tr>
		<td class="thead" colspan="7"><?php echo $lang['searchfor'].$lang['client']; ?></td>
	</tr>
	<tr>
		<form method="post" action="index.php?site=clients&amp;&port=<?php echo $port; ?>">
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
**/ 
?>
	<tr>
		<td class="thead" colspan="8">
		<?php 
		if($start!=0 or !empty($start))
			{
			echo "<a class=\"paging\" href=\"index.php?site=clients&amp;port=".$port."&amp;start=".($start-$duration)."\">&lt;&lt;&lt;".$lang['last']."</a> ";
			}
			echo $lang['clients']; 
			if($ts3->clientDbList("start=".($start+$duration)." duration=".$duration)!==false)
				{
				echo " <a class=\"paging\" href=\"index.php?site=clients&amp;port=".$port."&amp;start=".($start+$duration)."\">".$lang['next']."&gt;&gt;&gt;</a>";
				}
			?></td>
	</tr>
	<tr>
		<td class="thead"><?php echo $lang['dbid']; ?></td>
		<td class="thead"><?php echo $lang['uniqueid']; ?></td>
		<td class="thead"><?php echo $lang['nickname']; ?></td>
		<td class="thead"><?php echo $lang['created']; ?></td>
		<td class="thead"><?php echo $lang['lastonline']; ?></td>
		<td class="thead"><?php echo $lang['status']; ?></td>
		<td class="thead"><?php echo $lang['option']; ?></td>
	</tr>
	<?php
	$change_col=1;
	if(!empty($clientdblist))
	{
	foreach($clientdblist AS $value)
		{
		($change_col%2) ? $td_col="green1":$td_col="green2";
		?>
		<tr>
			<td class="<?php echo $td_col; ?> center"><?php echo $value['cldbid']; ?></td>
			<td class="<?php echo $td_col; ?> center"><?php echo $value['client_unique_identifier']; ?></td>
			<td class="<?php echo $td_col; ?> center"><?php echo $value['client_nickname']; ?></td>
			<td class="<?php echo $td_col; ?> center"><?php echo date("d.m.Y", $value['client_created']); ?></td>
			<td class="<?php echo $td_col; ?> center"><?php echo date("d.m.Y", $value['client_lastconnected']); ?></td>
			<td class="<?php echo $td_col; ?> center">
			<?php
			if(isset($value['clid']))
				{
				echo "<span class=\"online\">".$lang['online']."</span>";
				}
				else
				{
				echo "<span class=\"offline\">".$lang['offline']."</span>";
				}
			?>
			</td>
			<td class="<?php echo $td_col; ?> center">
			<form method="post" action="index.php?site=cleditperm&amp;port=<?php echo $port; ?>&amp;cldbid=<?php echo $value['cldbid']; ?>">
			<input type="submit" class="eperms" name="editperms" value="" title="<?php echo $lang['editperms']; ?>" />
			</form>
			<form method="post" action="index.php?site=clients&amp;port=<?php echo $port; ?>">
			<input type="hidden" name="cldbid" value="<?php echo $value['cldbid']; ?>" />
			<input type="submit" class="delete" name="clientdel" value="" title="<?php echo $lang['delete']; ?>" onclick="return confirm('<?php echo $lang['deletemsgclient']; ?>')" />
			</form>
			</td>
		</tr>
		
<?php	$change_col++;
		}
		
	?>
	<tr>
		<td class="thead" colspan="8">
		<?php 
		if($start!=0 or !empty($start))
			{
			echo "<a class=\"paging\" href=\"index.php?site=clients&amp;port=".$port."&amp;start=".($start-$duration)."\">&lt;&lt;&lt;".$lang['last']."</a> ";
			}
			echo ' '; 
			if($ts3->clientDbList("start=".($start+$duration)." duration=".$duration)!==false)
				{
				echo " <a class=\"paging\" href=\"index.php?site=clients&amp;port=".$port."&amp;start=".($start+$duration)."\">".$lang['next']."&gt;&gt;&gt;</a>";
				}
			?></td>
	</tr>
</table>
<?php }} ?>