<table class="border" cellpadding="1" cellspacing="0">
<?php
if(isset($_POST['addgroup']))
	{
	if(!empty($_POST['name']))
		{
		if(!empty($_POST['copyfrom']))
			{
			$creategroup=$ts3->serverGroupAdd($_POST['name']);
			if($creategroup!==false)
				{
				$editperms='';
				$sgrouppermlist=$ts3->serverGroupPermList($_POST['copyfrom']);
				foreach($sgrouppermlist AS $key => $value)
					{
					$editperms[$value['permid']]['value']=$value['permvalue'];
					$editperms[$value['permid']]['skip']=$value['permskip'];
					$editperms[$value['permid']]['negated']=$value['permnegated'];
					}
				$ts3->serverGroupAddPerm($creategroup, $editperms);
				echo $ts3->getDebugLog();
				echo "<tr><td class='green1' colspan='2'>".$lang['groupcreatedok']."</td></tr>";
				}
				else
				{
				echo "<tr><td class='green1' colspan='2'>".$ts3->getDebugLog()."</td></tr>";
				}
			}
			else
			{
			if($ts3->serverGroupAdd($_POST['name']))
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

$servergroups=$ts3->serverGroupList();
foreach($servergroups AS $key => $value)
	{
	if ($hoststatus===false AND $serverhost===true AND $value['type']=='2' OR $hoststatus===false AND $serverhost===true AND $value['type']=='0')
		{
		unset($servergroups[$key]);
		}
	}
	
?>
<form method="post" action="index.php?site=sgroupadd&amp;port=<?php echo $port; ?>">
	<tr>
		<td colspan="2" class="thead"><?php echo $lang['addservergroup']; ?></td>
	</tr>
	<tr>
		<td class="green1"><?php echo $lang['name']; ?>:</td>
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
		foreach($servergroups AS $key=>$value)
			{?>
			<option value="<?php echo $value['sgid']; ?>"><?php echo $value['name']; ?></option>
<?php		}
		?>
		</select>
		</td>
	</tr>
	<tr>
		<td class="green2"><?php echo $lang['option']; ?>:</td>
		<td class="green2"><input class="button" type="submit" name="addgroup" value="<?php echo $lang['add']; ?>" /></td>
	</tr>
</table>
</form>