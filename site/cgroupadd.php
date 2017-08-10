<table class="border" cellpadding="1" cellspacing="0">
<?php
if(isset($_POST['addgroup']))
	{
	if(!empty($_POST['name']))
		{
		if(!empty($_POST['copyfrom']))
			{
			$creategroup=$ts3->channelGroupAdd($_POST['name']);
			if($creategroup!==false)
				{
				$editperms='';
				$cgrouppermlist=$ts3->channelGroupPermList($_POST['copyfrom']);
				foreach($cgrouppermlist AS $key => $value)
					{
					$editperms[$value['permid']]['value']=$value['permvalue'];
					$editperms[$value['permid']]['skip']=$value['permskip'];
					$editperms[$value['permid']]['negated']=$value['permnegated'];
					}
				$ts3->channelGroupAddPerm($creategroup, $editperms);
				echo "<tr><td class='green1' colspan='2'>".$ts3->getDebugLog()."</td></tr>";
				echo "<tr><td class='green1' colspan='2'>".$lang['groupcreatedok']."</td></tr>";
				}
				else
				{
				echo "<tr><td class='green1' colspan='2'>".$ts3->getDebugLog()."</td></tr>";
				}
			}
			else
			{
			if($ts3->channelGroupAdd($_POST['name']))
				{
				echo "<tr><td class='green1' colspan='2'>".$lang['groupcreatedok']."</td></tr>";
				}
				else
				{
				echo "<tr><td class='green1' colspan='2'>".$ts3->getDebugLog()."</td></tr>";
				}
			}
		}
		else
		{
		echo "<tr><td class='green1' colspan='2'>".$lang['groupnameempty']."</td></tr>";
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
<form method="post" action="index.php?site=cgroupadd&amp;port=<?php echo $port; ?>">
	<tr>
		<td colspan="2" class="thead"><?php echo $lang['addchannelgroup']; ?></td>
	</tr>
	<tr>
		<td class="green1"><?php echo $lang['name']; ?></td>
		<td class="green1">
		<input type="text" name="name" value="" />
		</td>
	</tr>
	<tr>
		<td class="green1"><?php echo $lang['copypermsfrom']; ?>:</td>
		<td class="green1">
		<select name="copyfrom">
		<option value=""></option>
		<?php
		foreach($channelgroups AS $key=>$value)
			{?>
			<option value="<?php echo $value['cgid']; ?>"><?php echo $value['name']; ?></option>
<?php		}
		?>
		</select>
		</td>
	</tr>
	<tr>
		<td class="green2"><?php echo $lang['option']; ?></td>
		<td class="green2"><input class="button" type="submit" name="addgroup" value="<?php echo $lang['add']; ?>" /></td>
	</tr>
</table>
</form>