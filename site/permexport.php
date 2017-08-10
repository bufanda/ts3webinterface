<?php 
if(isset($_POST['sourcemode']) AND $_POST['sourcemode']==1)
	{
	$permissions=$ts3->serverGroupPermList($_POST['sourceid']);
	}
	elseif(isset($_POST['sourcemode']) AND $_POST['sourcemode']==2)
	{
	$permissions=$ts3->channelGroupPermList($_POST['sourceid']);
	}
	elseif(isset($_POST['sourcemode']) AND $_POST['sourcemode']==3)
	{
	$permissions=$ts3->channelPermList($_POST['sourceid']);
	}
	elseif(isset($_POST['sourcemode']) AND $_POST['sourcemode']==4)
	{
	$permissions=$ts3->clientPermList($_POST['sourceid']);
	}
?>
	
<table  class="border" cellpadding="1" cellspacing="0">
	<tr>
		<td colspan="2" style="font-size:12px"><?php echo $lang['permexdesc']; ?></td>
	</tr>
	<tr>
		<td class="thead" colspan="2"><?php echo $lang['permexport']; ?></td>
	</tr>
	<form method="POST" action="index.php?site=permexport&amp;port=<?php echo $port; ?>">
	<tr>
		<td class="green1"><?php echo $lang['sourcetype']; ?></td>
		<td class="green1">
		<select name="sourcemode">
		<option value="1"><?php echo $lang['servergroup']; ?></option>
		<option value="2"><?php echo $lang['channelgroup']; ?></option>
		<option value="3"><?php echo $lang['channel']; ?></option>
		<option value="4"><?php echo $lang['client']; ?></option>
		</select> 
		</td>
	</tr>
	<tr>
		<td class="green2"><?php echo $lang['sourceid']; ?></td>
		<td class="green2"><input type="text" name="sourceid" value="" /></td>
	</tr>
	<tr>
		<td class="green1"><?php echo $lang['targettype']; ?></td>
		<td class="green1">
		<select name="targetmode">
		<option value="1"><?php echo $lang['servergroup']; ?></option>
		<option value="2"><?php echo $lang['channelgroup']; ?></option>
		<option value="3"><?php echo $lang['channel']; ?></option>
		<option value="4"><?php echo $lang['client']; ?></option>
		</select> 
		</td>
	</tr>
	<tr>
		<td class="green2"><?php echo $lang['targetid']; ?></td>
		<td class="green2"><input type="text" name="targetid" value="" /></td>
	</tr>
	<tr>
		<td class="green1"><?php echo $lang['option']; ?></td>
		<td class="green1">
		<input class="button" type="submit" name="showcommands" value="<?php echo $lang['view']; ?>" />
		</td>
	</tr>
	</form>
<?php
if($permissions===false)
	{
	echo 'Source target nicht gefunden';
	}
	else
	{
if (isset($_POST['showcommands']))
	{?>
	<tr>
		<td class="green2 center" colspan="2">
		<?php
		$editperms='';
		foreach($permissions AS $key => $value)
			{
			$editperms[$value['permid']]['value']=$value['permvalue'];
			$editperms[$value['permid']]['skip']=$value['permskip'];
			$editperms[$value['permid']]['negated']=$value['permnegated'];
			}?>
		
		<textarea name="showfield" cols="50" rows="10" readonly="readonly"><?php if(!empty($editperms)) { echo $ts3->getPermsCommand($_POST['targetmode'], $_POST['targetid'], $editperms);} else {echo $lang['nopermsfound'];} ?></textarea>
		</td>
	</tr>
<?php }} ?>
</table>