<?php if(!defined("SECURECHECK")) {die($lang['error_file_alone']);} 
if($port===false OR empty($port)) { echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?site=server\">";} else {
?>
<table class="border" style="width:100%" cellpadding="1" cellspacing="0">
<?php
$sgrouplist=$ts3->serverGroupList();
$cgrouplist=$ts3->channelGroupList();
$channellist=$ts3->channelList();

if(isset($_POST['deltoken']))
	{
	if($ts3->tokenDelete($_POST['token']))
		{
		echo "<tr><td class='green1' colspan='7'>".$lang['tokendeleteok']."</td></tr>";
		}
		else
		{
		echo "<tr><td class='green1' colspan='7'>".$ts3->getDebugLog()."</td></tr>";
		}
	}
	
if(isset($_POST['addtoken']))
	{
	if($_POST['tokentype']==0 AND $_POST['tokenid2']!=0)
		{
		$_POST['tokenid2']=0;
		}
	if($_POST['tokentype']==1 AND $_POST['tokenid2']==0)
		{
		echo "<tr><td class='green1' colspan='7'>".$lang['nochannel']."</td></tr>";
		}
		else
		{
		$_POST['tokentype']==0 ? $tokenid1=$_POST['tokenid1_1']:$tokenid1=$_POST['tokenid1_2'];
		if($ts3->tokenAdd($_POST['tokentype'], $tokenid1, $_POST['tokenid2'], $_POST['description']))
			{
			echo "<tr><td class='green1' colspan='7'>".$lang['tokencreatedok']."</td></tr>";
			}
			else
			{
			echo "<tr><td class='green1' colspan='7'>".$ts3->getDebugLog()."</td></tr>";
			}
		}
	}
$tokenlist=$ts3->tokenList();
?>

	<tr>
		<td class="thead" colspan="7"><?php echo $lang['tokenlist']; ?></td>
	</tr>
	<tr>
		<td class="thead"><?php echo $lang['token']; ?></td>
		<td class="thead"><?php echo $lang['type']; ?></td>
		<td class="thead"><?php echo $lang['id1']; ?></td>
		<td class="thead"><?php echo $lang['id2']; ?></td>
		<td class="thead"><?php echo $lang['created']; ?></td>
		<td class="thead"><?php echo $lang['description']; ?></td>
		<td class="thead"><?php echo $lang['option']; ?></td>
	</tr>
	<?php 
	if(!empty($tokenlist))
		{
		$change_col=1;
		foreach($tokenlist AS $value)
			{
			($change_col%2) ? $td_col="green1":$td_col="green2";
			?>
			<tr>
				<td class="<?php echo $td_col; ?> center"><?php echo $value['token']; ?></td>
				<td class="<?php echo $td_col; ?> center">
				<?php 
				if($value['token_type']==0)
					{
					echo $lang['servergroup'];
					}
					elseif($value['token_type']==1)
					{
					echo $lang['channelgroup'];
					}
				?>
				</td>
				<td class="<?php echo $td_col; ?> center">
				<?php 
				if($value['token_type']==0)
					{
					foreach($sgrouplist AS $value2)
						{
						if($value2['sgid']==$value['token_id1'])
							{
							
							echo $value2['name']; 
							}
						}
					}
				elseif($value['token_type']==1)
					{
					foreach($cgrouplist AS $value2)
						{
						if($value2['cgid']==$value['token_id1'])
							{
							echo $value2['name']; 
							}
						}
					}
				?>
				</td>
				<td class="<?php echo $td_col; ?> center">
				<?php
				if($value['token_type']==1)
					{
					foreach($channellist AS $value2)
						{
						if($value2['cid']==$value['token_id2'])
							{
							echo $value2['channel_name']; 
							}
						}
					}
				?>
				</td>
				<td class="<?php echo $td_col; ?> center"><?php echo date("d.m.Y - H:i", $value['token_created']); ?></td>
				<td class="<?php echo $td_col; ?> center"><?php echo $value['token_description']; ?></td>
				<td class="<?php echo $td_col; ?> center">
				<form method="post" action="index.php?site=token&port=<?php echo $port; ?>">
				<input type="hidden" name="token" value="<?php echo $value['token']; ?>" />
				<input class="delete" type="submit" name="deltoken" value="" title="<?php echo $lang['delete']; ?>" />
				</form>
				</td>
			</tr>
			<?php
			$change_col++;
			} 
		}?>
</table>
<br />
<form method="post" action="index.php?site=token&port=<?php echo $port; ?>">
<table class="border" style="width:100%" cellpadding="1" cellspacing="0">
	<tr>
		<td class="thead" colspan="5"><?php echo $lang['createtoken']; ?></td>
	</tr>
	<tr>
		<td class="thead"><?php echo $lang['type']; ?></td>
		<td class="thead"><?php echo $lang['groups']; ?></td>
		<td class="thead"><?php echo $lang['channel']; ?></td>
		<td class="thead"><?php echo $lang['description']; ?></td>
		<td class="thead"><?php echo $lang['option']; ?></td>
	</tr>
	<tr>
		<td class="green1 center">
		<select name="tokentype" onChange="hide_select(this.value)">
			<option value=""><?php echo $lang['type']; ?></option>
			<option value="0">(0)<?php echo $lang['servergroup']; ?></option>
			<option value="1">(1)<?php echo $lang['channelgroup']; ?></option>
		</select>
		</td>
		<td class="green1 center">
		<div id="groups">
		<select id="servergroups" style="display:none" name="tokenid1_1">
		<optgroup label="<?php echo $lang['servergroups']; ?>">
		<?php
		foreach($sgrouplist AS $value)
			{
			if($value['type']!=0)
				{?>
				<option value="<?php echo $value['sgid']; ?>"><?php echo "(".$value['sgid'].")".$value['name']; ?></option>
		<?php } }?>
		</optgroup>
		</select>
		<select id="channelgroups" style="display:none" name="tokenid1_2">
		<optgroup label="<?php echo $lang['channelgroups']; ?>">
		<?php
		foreach($cgrouplist AS $value)
			{
			if($value['type']!=0)
				{?>
				<option value="<?php echo $value['cgid']; ?>"><?php echo "(".$value['cgid'].")".$value['name']; ?></option>
		<?php 	}
			} ?>
		</optgroup>
		</select>
		</div>
		</td>
		<td class="green1 center">
		<select id="channel" style="display:none" name="tokenid2">
		<option value="0"><?php echo $lang['channel']; ?></option>
		<?php
		foreach($channellist AS $value)
			{?>
			<option value="<?php echo $value['cid']; ?>"><?php echo $value['channel_name']; ?></option>
		<?php } ?>
		</select>
		</td>
		<td class="green1 center">
		<input type="text" name="description" value="" />
		</td>
		<td class="green1 center">
		<input class="button" type="submit" name="addtoken" value="<?php echo $lang['create']; ?>" />
		</td>
	</tr>
</table>
</form>
<?php } ?>