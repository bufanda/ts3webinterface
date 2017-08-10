<?php
$start_while=0;
$duration_while=1;
$i=0;
$clientlist=$ts3->clientList();

while($clientdblist=$ts3->clientDbList("start=".$start_while." duration=".$duration_while))
	{
	foreach($clientdblist AS $key=>$value)
		{
		if(!empty($clientlist))
			{
			foreach($clientlist AS $key2=>$value2)
				{
				if($value['cldbid']==$value2['client_database_id'])
					{
					$clientstatuslist[$i]['online']=1;
					}
				}
			}
		$clientstatuslist[$i]['cldbid']=$value['cldbid'];
		$clientstatuslist[$i]['client_lastconnected']=$value['client_lastconnected'];
		$i++;	
		}
	$start_while=$start_while+$duration_while;
	}
$totalclients=count($clientstatuslist);
$thisday=mktime(0,0,0,date("n"),date("d"),date("Y"));
if(date("w")==0)
	{
	$dayofweek=6;
	}
	else
	{
	$dayofweek=date("w")-1;
	}
$thisweek=mktime(0,0,0,date("n"),date("j")-$dayofweek,date("Y"));
$thismonth=mktime(0,0,0,date("n"),1,date("Y"));
?>
<table style="width:50%" align="center" class="border" cellpadding="1" cellspacing="0">
	<tr>
		<td style="width:100%" class="thead" colspan="2"><?php echo $lang['clientcounter']; ?></td>
	</tr>
	<tr>
		<td style="width:50%" class="green1"><?php echo $lang['total']; ?></td>
		<td style="width:50%" class="green1"><?php echo $totalclients." ".$lang['clients']; ?></td>
	</tr>
	<tr>
		<td class="green2"><?php echo $lang['online']; ?></td>
		<td class="green2">
		<?php
		$count_online=0;
		foreach($clientstatuslist AS $key => $value)
			{
			if(isset($value['online']))
				{
				$count_online++;
				}
			}
		$perc=round(100*$count_online/$totalclients);
		echo "<img src=\"gfx/images/stats.png\"  height=\"10\" width=\"".$perc."\" /> ";
		echo $count_online." ".$lang['clients']." | ".$perc."%"; ?>
		</td>
	</tr>
	<tr>
		<td class="green1"><?php echo $lang['today']; ?></td>
		<td class="green1">
		<?php
		$count_today=0;
		foreach($clientstatuslist AS $key => $value)
			{
			if($value['client_lastconnected']>=$thisday)
				{
				$count_today++;
				}
			}
		$perc=round(100*$count_today/$totalclients);
		echo "<img src=\"gfx/images/stats.png\"  height=\"10\" width=\"".$perc."\" /> ";
		echo $count_today." ".$lang['clients']." | ".$perc."%"; ?>
		</td>
	</tr>
	<tr>
		<td class="green2"><?php echo $lang['thisweek']; ?></td>
		<td class="green2">
		<?php
		$count_week=0;
		foreach($clientstatuslist AS $key => $value)
			{
			if($value['client_lastconnected']>=$thisweek)
				{
				$count_week++;
				}
			}
		$perc=round(100*$count_week/$totalclients);
		echo "<img src=\"gfx/images/stats.png\"  height=\"10\" width=\"".$perc."\" /> ";
		echo $count_week." ".$lang['clients']." | ".$perc."%"; ?>
		</td>
	</tr>
	<tr>
		<td class="green1"><?php echo $lang['thismonth']; ?></td>
		<td class="green1">
		<?php
		$count_month=0;
		foreach($clientstatuslist AS $key => $value)
			{
			if($value['client_lastconnected']>=$thismonth)
				{
				$count_month++;
				}
			}
		$perc=round(100*$count_month/$totalclients);
		echo "<img src=\"gfx/images/stats.png\"  height=\"10\" width=\"".$perc."\" /> ";
		echo $count_month." ".$lang['clients']." | ".$perc."%"; ?>
		</td>
	</tr>
</table>