<?php
if(isset($_POST['delall']))
	{
	if($ts3->complainDeleteAll($_POST['tcldbid']))
		{
		echo $lang['complaindel'];
		}
		else
		{
		echo $ts3->getDebugLog();
		}
	}
if(isset($_POST['delete']))
	{
	if($ts3->complainDelete($_POST['tcldbid'], $_POST['fcldbid']))
		{
		echo $lang['complainsdel'];
		}
		else
		{
		echo $ts3->getDebugLog();
		}
	}
$complainlist=$ts3->complainList();
$newcomplainlist=array();
if(!empty($complainlist))
	{
	foreach($complainlist AS $key=>$value)
		{
		$newcomplainlist[$value['tcldbid']][$value['tname']][$value['fcldbid']]['fname']=$value['fname'];
		$newcomplainlist[$value['tcldbid']][$value['tname']][$value['fcldbid']]['message']=$value['message'];
		$newcomplainlist[$value['tcldbid']][$value['tname']][$value['fcldbid']]['timestamp']=$value['timestamp'];
		}
	}
?>

<table style="width:892px" class="border" cellpadding="1" cellspacing="0">
	<tr>
		<td class="thead" colspan="4"><?php echo $lang['complainlist']; ?></td>
	</tr>
	<tr>
		<td class="thead" style="width:223px"><?php echo $lang['targetnick']; ?></td>
		<td class="thead" style="width:223px"><?php echo $lang['sourcenick']; ?></td>
		<td class="thead" style="width:223px"><?php echo $lang['reason']; ?></td>
		<td class="thead" style="width:223px"><?php echo $lang['option']; ?></td>
	</tr>
	<?php
		$i=1;
		foreach($newcomplainlist AS $key => $value)
			{
			foreach($value AS $key2=>$value2)
				{?>
				<tr>
					<td class="green1"><a href="javascript:Klappen(<?php echo $i; ?>)"><img src="gfx/images/plus.png" id="Pic<?php echo $i; ?>" border=0 alt="aus/ein-klappen"></a> <?php echo $key2; ?></td>
					<td class="green1">&nbsp;</td>
					<td class="green1"><?php echo sprintf($lang['countcomplain'], count($value2)); ?></td>
					<td class="green1">
					<form method="post" action="index.php?site=complainlist&port=<?php echo $port; ?>">
					<input type="hidden" name="tcldbid" value="<?php echo $key; ?>" />
					<input class="delete" type="submit" name="delall" value="" title="<?php echo $lang['delall']; ?>" />
					</form>
					</td>
				</tr>
				<tr>
					<td class="green1" colspan="4">
				<table id="Lay<?php echo $i; ?>" style="width:892px;display:none;border-collapse:collapse;border:0" cellpadding="0" cellspacing="0">
					<?php
					foreach($value2 AS $key3=>$value3)
						{?>
						
							<tr>
								<td class="green1" style="width:223px;border:0">&nbsp;<?php echo date("d.m.Y - H:i", $value3['timestamp']); ?></td>
								<td class="green1" style="width:223px;border:0"><?php echo $value3['fname']; ?></td>
								<td class="green1" style="width:223px;border:0"><?php echo $value3['message']; ?></td>
								<td class="green1" style="width:223px;border:0">
								<form method="post" action="index.php?site=complainlist&port=<?php echo $port; ?>">
								<input type="hidden" name="tcldbid" value="<?php echo $key; ?>" />
								<input type="hidden" name="fcldbid" value="<?php echo $key3; ?>" />
								<input class="delete" type="submit" name="delete" value="" title="<?php echo $lang['delete']; ?>" />
								</form>
								</td>
							</tr>
						
				<?php   } ?>
				</table>
					</td>
				</tr>
			<?php
				}
			$i++;
			}
	?>
</table>

