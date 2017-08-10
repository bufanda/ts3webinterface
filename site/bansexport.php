<?php if(!defined("SECURECHECK")) {die($lang['error_file_alone']);}?>
<table class="border" style="width:100%" cellpadding="1" cellspacing="0">
<?php
if($port===false OR empty($port)) { echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?site=server\">";} else {
$banlist=$ts3->banList();
?>
	<tr>
		<td class="thead" colspan="9"><?php echo $lang['bansexport'];?></td>
	</tr>
	<tr>
		<td colspan="9"><?php echo $lang['bansexportdesc'];?></td>
	</tr>
<?php
if(!empty($banlist))
	{
	foreach($banlist AS $value)
		{
		if(isset($value['ip']))
			{
			$bantype="ip=".$value['ip'];
			}
		elseif(isset($value['name']))
			{
			$bantype="name=".$value['name'];
			}
		elseif(isset($value['uid']))
			{
			$bantype="uid=".$value['uid'];
			}
			
		if(!isset($value['duration']))
			{
			$banlength=0;
			}
			else
			{
			$banlength=$value['duration'];
			}
			
		$banexport.="banadd ".$bantype." time=".$banlength." banreason=".$value['reason']."\n";
		?>
	
<?php	}?>
	<tr>
			<td>
			<textarea rows="10" cols="70" readonly="readonly"><?php echo $banexport; ?></textarea>
			</td>
		</tr>
<?php	} ?>
</table>
<?php } ?>