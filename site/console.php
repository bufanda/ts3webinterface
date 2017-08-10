<?php 
if(isset($_POST['command']))
	{
	$data=strtr($_POST['command'], array("\r\n" => '\n', "\r" => '\n', "\n" => '\n'));
	$commands=explode('\n', $data);
	$getOutput='';
	$use_error=0;
	if($serverhost===true AND $hoststatus===false)
		{
		foreach($commands AS $key=>$value)
			{
			if(substr($value, 0, 3)=='use')
				{
				$use_error++;
				}
			}
		}
	if(empty($use_error))
		{
		foreach($commands AS $key=>$value)
			{
			if(!empty($value))
				{
				$getOutput.=$ts3->executeConsole($value);
				}
			}
		}
		else
		{
		$getOutput=$lang['nouse'];
		}
	}
?>
<table class="border" cellpadding="0" cellspacing="0">
<form method="post" action="index.php?site=console&amp;port=<?php echo $port; ?>">
	<tr>
		<td class="thead"><?php echo $lang['queryconsole']; ?></td>
	</tr>
	<tr>
		<td><?php echo $lang['inputbox']; ?></td>
	</tr>
	<tr>
		<td>
			<textarea name="command" cols="50" rows="10"></textarea>	
		</td>
	</tr>
	<tr>
		<td><input class="button" type="submit" name="execute" value="<?php echo $lang['execute']; ?>" /><br /><br /></td>
	</tr>
	</form>
	<tr>
		<td><?php echo $lang['outputbox']; ?></td>
	</tr>
	<tr>
		<td>
			<textarea name="output" cols="80" rows="20" readonly="readonly"><?php echo str_replace('<br>', "\n", $getOutput); ?></textarea>	
		</td>
	</tr>
</table>
